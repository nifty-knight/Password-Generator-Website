<!DOCTYPE html>
<html>
<head>
	<title style = "text-align: center">Password Generator</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css">
	<script src="pg.js"></script>
</head>

<body>
<h1><?php echo "Password Generator" ?></h1>
<hr>
<p>
	This site generates passwords by combining words related to random topics of your choice with random symbols and/or numbers.
	The idea is to create passwords that may be longer to type, but are more memorable and more secure.
	The passwords are mostly in the pattern of topic-word - verb - topic-word or adj - topic-word - topic-word.
	Feel free to edit or change them however you like; they are meant mainly to be inspiration.
	Test your password strength here: https://www.passwordmonster.com/
</p>
	<div>
		<form method="POST" action="add.php" class="wrapper">
			<label><?php echo "Topic:" ?></label><input type="text" name="topic">
			<input type="submit" name="add">
		</form>
	</div>
	<br>
	<div>
		<table border="1" class="table">
			<thead>
				<th>Topic</th>
				<th></th>
			</thead>
			<tbody>
				<?php
					include('conn.php');
					$query=mysqli_query($conn,"select * from `topics`");
					while($row=mysqli_fetch_array($query)){
						?>
						<tr>
							<td><?php echo $row['topic']; ?></td>
							<td>
								<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
							</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<br>
	</div>
	
<div class="wrapper">
	<form method="POST" action="generate.php">
		<button class="btn btn-primary">Generate!</button>
	</form>
	<br>
</div>

	<table border="2" margin-left: class="centered table">
		<thead>
			<th>Generated</th>
			<th>
				<a href="delete_table.php">Delete Table</a>
			</th>
		</thead>
		<tbody>
			<?php
				include('conn.php');
				$query=mysqli_query($conn,"select * from `generated_passwords`");
				while($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $row['password']; ?></td>
						<td>
							<a href="delete_generated.php?id=<?php echo $row['id']; ?>">Delete</a>
						</td>
					</tr>
					<?php
				}
			?>
		</tbody>
</body>
</html>