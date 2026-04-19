<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$newDB = $_POST['db_name'];
	$pdo = new PDO('mysql:host=localhost', 'root', '');
	$pdo->exec('CREATE DATABASE '.$newDB);
}
?>
<!DOCTYPE html>
<html>
<body style="font-family:monospace;display:flex;justify-content:center;align-items:center;height:100vh;margin:0">
	<button onclick="window.location.href='index.php'">< back</button>
	<form method="POST">
		<input type="text" name="db_name" placeholder="database name" required>
		<button type="submit">create new db</button>
	</form>
</body>
</html>