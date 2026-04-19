<?php
$pdo_server = new PDO('mysql:host=localhost', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$view = $_GET['view'] ?? 'dbs';
$db = $_GET['db'] ?? '';
$table = $_GET['table'] ?? '';

if ($view === 'dbs' && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$pdo_server->exec('CREATE DATABASE `' . $_POST['db_name'] . '`');
	header('Location: ?view=dbs');
	exit;
}

if ($view === 'tables' && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$pdo = new PDO('mysql:host=localhost;dbname=' . $db, 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	$table_name = $_POST['table_name'];
	$pdo->exec("CREATE TABLE `$table_name` (`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
	header('Location: ?view=columns&db=' . $db . '&table=' . $table_name);
	exit;
}

if ($view === 'columns' && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$pdo = new PDO('mysql:host=localhost;dbname=' . $db, 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	$col = $_POST['column_name'];
	$type = $_POST['column_type'];
	$pdo->exec("ALTER TABLE `$table` ADD `$col` $type");
	header('Location: ?view=columns&db=' . $db . '&table=' . $table);
	exit;
}

$ignoredDBs = ['information_schema', 'mysql', 'performance_schema', 'phpmyadmin'];
?>
<!DOCTYPE html>
<html>

<body
	style="font-family:monospace;display:flex;flex-direction:column;align-items:center;justify-content:center;height:100vh;margin:0;gap:1rem">

	<?php if ($view === 'dbs'): ?>
		<?php $dbs = array_filter($pdo_server->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN), fn($d) => !in_array($d, $ignoredDBs)) ?>
		<?php if (empty($dbs)): ?>
			<p>no databases found</p>
		<?php else: ?>
			<ul>
				<?php foreach ($dbs as $d): ?>
					<li><a href="?view=tables&db=<?= $d ?>"><?= $d ?></a></li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
		<form method="POST">
			<input type="text" name="db_name" placeholder="database name" required>
			<button type="submit">create db</button>
		</form>

	<?php elseif ($view === 'tables'): ?>
		<?php $pdo = new PDO('mysql:host=localhost;dbname=' . $db, 'root', ''); ?>
		<?php $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN) ?>
		<p><?= $db ?></p>
		<?php if (empty($tables)): ?>
			<p>no tables found</p>
		<?php else: ?>
			<ul>
				<?php foreach ($tables as $t): ?>
					<li><a href="?view=columns&db=<?= $db ?>&table=<?= $t ?>"><?= $t ?></a></li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
		<form method="POST">
			<input type="text" name="table_name" placeholder="table name" required>
			<button type="submit">create table</button>
		</form>
		<a href="?view=dbs">back</a>

	<?php elseif ($view === 'columns'): ?>
		<?php $pdo = new PDO('mysql:host=localhost;dbname=' . $db, 'root', ''); ?>
		<?php $columns = $pdo->query("SHOW COLUMNS FROM `$table`")->fetchAll(PDO::FETCH_ASSOC) ?>
		<p><?= $db ?> / <?= $table ?></p>
		<?php if (!empty($columns)): ?>
			<table border="1" cellpadding="6">
				<tr><?php foreach ($columns as $col): ?>
						<th><?= $col['Field'] ?> (<?= $col['Type'] ?>)</th><?php endforeach ?>
				</tr>
			</table>
		<?php endif ?>
		<form method="POST">
			<input type="text" name="column_name" placeholder="column name" required>
			<select name="column_type">
				<option value="INT">INT</option>
				<option value="TEXT">TEXT</option>
				<option value="BOOLEAN">BOOLEAN</option>
			</select>
			<button type="submit">add column</button>
		</form>
		<a href="?view=tables&db=<?= $db ?>">back</a>

	<?php endif ?>

</body>

</html>