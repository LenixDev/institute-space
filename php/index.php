<?php
$pdo = new PDO('mysql:host=localhost', 'root', '');
$dbs = $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN);
$ignoredDBs = ['information_schema', 'mysql', 'performance_schema', 'phpmyadmin'];
?>
<!DOCTYPE html>
<html>
<body style="font-family:monospace;display:flex;justify-content:center;align-items:center;height:100vh;margin:0">
  <?php if (empty($dbs)): ?>
    <p>no databases found</p>
  <?php else: ?>
    <ul>
      <?php foreach ($dbs as $db): ?>
        <?php if (!in_array($db, $ignoredDBs)): ?>
					<li><a href="db.php?db=<?= $db ?>"><?= $db ?></a></li>
				<?php endif ?>
      <?php endforeach ?>
    </ul>
		<button onclick="window.location.href='create.php'">create new db</button>
  <?php endif ?>
</body>
</html>