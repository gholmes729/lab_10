<?php

$valid = TRUE;
$valid_user = FALSE;
$empty = FALSE;

$connect_error = FALSE;

$username = $_POST["user"];
$post = $_POST["post"];

if ($post == "")
{
	$valid = FALSE;
	$empty = TRUE;
}

if ($valid == TRUE)
{
	$mysqli = new mysqli("mysql.eecs.ku.edu", "grantholmes", "anooL9uu", "grantholmes");
	/* check connection */
	$connect_error = $mysqli->connect_errno;
	if ($connect_error == TRUE)
	{
		exit();
	}

	$query = "SELECT user_id FROM Users";
	if ($result = $mysqli->query($query))
	{
		/* fetch associative array */
		while ($row = $result->fetch_assoc())
		{
			if ($row["user_id"]==$username)
			{
				$valid_user = TRUE;
			}
		}
		if (!$valid_user)
		{
			$valid = FALSE;
		}
	 /* free result set */
	 $result->free();
	}
	
	/* if still valid add to data base */
	if ($valid == TRUE)
	{
		$cmd = "INSERT INTO Posts (content, author_id) VALUES ('".addslashes($post)."', '".addslashes($username)."')";
		$added = $mysqli->query($cmd);
	}
	
	/* close connection */
	$mysqli->close();
}

$empty = $empty ? 'True' : 'False';
$valid_user = $valid_user ? 'True' : 'False';
$connect_error = $connect_error ? 'True' : 'False';
$added = $added ? 'True' : 'False';

?>
<!DOCTYPE html>

<html>
	<head>
	  <title>Results</title>
	  <style>
		body {
			background-color: black;
		}
		body * {
			font-size: 1.05em;
			color: #000;
			font-family: "Arial", monospace;
			text-align: center;
		}
		table {
			width: 40%;
			margin-left: auto;
			margin-right: auto;
			padding-top: 7.5%;
		}
		th {
			background-color: LightBlue;
			height: 50px;
			padding: 5px;
		}

		td {
			background-color: LightBlue;
			padding: 15px;
		}
	  </style>
	</head>
	<body>
		  
	  <table>
		<tr>
		<th><h1> SUMMARY </h1></th>
		</tr>
		<tr>
			<td>
				<b>Post Empty:</b> <?php echo $empty ?>
			</td>
	   </tr>
		<tr>
			<td>
				<b>Valid Username:</b> <?php echo $valid_user ?>
			</td>
	   </tr>
	   <tr>
			<td>
				<b>Connection Error:</b> <?php echo $connect_error ?>
			</td>
	   </tr>
		<tr>
			<td>
				<b>Added Successfully:</b> <?php echo $added ?>
			</td>
	   </tr>
	   
	   <tr>
			<td style="border: none; padding: 5px;">
				<form action="https://people.eecs.ku.edu/~g569h991/lab_10/CreatePosts.html">
					<input style="padding: 5px; padding-left: 10px; padding-right: 10px;" type="submit" value="Back">
				</form>
			</td>
	   </tr>
	   
	 </table>
	</body>
</html>
