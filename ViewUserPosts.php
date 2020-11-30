<?php
$user = $_POST["user"];
echo '<title>User Post</title>';
echo '<style>body {background-color: black;}</style>';

echo '<table cellpadding="10" cellspacing="7.5" style="text-align:center; background-color:LightBlue; margin:auto; margin-top: 5%; width:50%;" border="1px solid black" border-collapse="collapse"><tbody><tr>';
echo '<tr style="background-color: white;"><th>USER: '.$user.'</th></tr>';

$mysqli = new mysqli("mysql.eecs.ku.edu", "grantholmes", "anooL9uu", "grantholmes");

$query = 'SELECT content, post_id FROM Posts WHERE author_id="'.$user.'"';

if ($result = $mysqli->query($query)) {
	while ($row = $result->fetch_assoc()) {
		echo '<td style="background-color:white;">'.$row["post_id"].') '.$row["content"].'</td>';
		echo '</tr><tr>';
	}
	$result->free();
}


$mysqli->close();
echo '</tr>';
echo '<tr><td colspan="2" style="border: none; padding: 0px;"><form action="https://people.eecs.ku.edu/~g569h991/lab_10/ViewUserPosts.html"><input style="padding: 5px; padding-left: 10px; padding-right: 10px;" type="submit" value="Re-select User"></form></td></tr>';
echo '</tbody></table>';

?>