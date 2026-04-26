<?php ?>
<!DOCTYPE html>
<html>
<head>
	<style>
		.main  {
			display: flex;
			flex-direction: row;
			background-color: aliceblue;
			justify-content: space-between;
			width: 100%;
		}
		.main > * {
			display: flex;
			align-items: center;
			justify-content: center;
			border: 1px solid black;
		}
		.left {
			flex: 1;
			flex-direction: column;
		}
		.center {
			flex: 4;
		}
	</style>
</head>
<body
	style="font-family:monospace;display:flex;flex-direction:column;align-items:center;justify-content:center;height:100vh;margin:0;gap:1rem">
	<div class="main">
		<div class="left">
			<?php
				$conn = mysqli_connect("localhost", "root", "");
				$result = mysqli_query($conn, "SHOW DATABASES");
				$ignoreDBs = ["information_schema", "mysql", "performance_schema", "phpmyadmin"];
				$found = false;

				while ($row = mysqli_fetch_array($result)) {
					if (in_array($row[0], $ignoreDBs)) continue;
					$found = true;
					echo "<div>{$row[0]}</div>";
				}

				if (!$found) echo "<div>no dbs found</div>";
			?>
			<button>create new db</button>
		</div>
		<div class="center">no dbs selected</div>
	</div>
</body>
</html>