<?php include('../database/server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<!-- meta import -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

	<noscript><link rel="stylesheet" href="..assets/css/noscript.css" /></noscript>

<!-- tab icon import -->
	<link rel="shortcut icon" type="image/x-icon" href="../../blog2/images/icon.ico" />

	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
</head>
<body>
	<div class="table-wrapper">
		<h1 style="text-align: center;">Welcome to ADMIN Panel</h1>
		<?php if (isset($_SESSION['msg'])): ?>
			<body onload = "setTimeout()">
			<div style="margin: 30px auto; padding: 10px; border-radius: 5px; color: #3c763d; background: #dff0d8; border: 1px solid #3c763d; width: 50%;text-align: center;" id="msg">
				<?php
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				?>
			</div>
		<?php endif ?>

		<table class="alt">
			<thread>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Messages</th>
					<th colspan="2">Action</th>
				</tr>
			</thread>
			<tbody>
				<?php while ($row = mysqli_fetch_array($results)) { ?>
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['message']; ?></td>
						<td>
							<a class="edit_btn" href="boss.php?edit=<?php echo $row['id']; ?>">Edit</a>
						</td>
						<td>
							<a class="del_btn" href="../database/server.php?del=<?php echo $row['id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<!-- Message Hider -->
			<script src="../assets/js/js.js"></script>
</body>
</html>