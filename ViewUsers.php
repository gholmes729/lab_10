<?php

echo '<title>View Users</title>';
echo '<style>body {background-color: black;}</style>';

echo '<table cellpadding="10" cellspacing="7.5" style="text-align:center; background-color:LightBlue; margin:auto; margin-top: 5%; width:30%;" border="1px solid black" border-collapse="collapse"><tbody><tr>';
echo '<tr style="background-color: white;"><th>USERS</th></tr>';
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
	$c = 1;
	while ($row = $result->fetch_assoc())
	{
		echo '<td style="background-color:white;">'.$c.") ".$row["user_id"].'</td>';
		echo '</tr><tr>';
		$c++;
	}
	if (!$valid_user)
	{
		$valid = FALSE;
	}
 /* free result set */
 $result->free();
}

/* close connection */
$mysqli->close();
echo '</tr>';
echo '<tr><td style="border: none; padding: 0px;"><form action="https://people.eecs.ku.edu/~g569h991/lab_10/AdminHome.html"><input style="padding: 5px; padding-left: 10px; padding-right: 10px;" type="submit" value="Home"></form></td></tr>';
echo '</tbody></table>';

?>