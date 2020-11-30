<?php
echo '<title>Delete Results</title>';
echo '<style>body {background-color: black;}</style>';

echo '<table cellpadding="10" cellspacing="7.5" style="text-align:center; background-color:LightBlue; margin:auto; margin-top: 5%; width:30%;" border="1px solid black" border-collapse="collapse"><tbody><tr>';
echo '<tr style="background-color: white;"><th>Post ID</th><th>Delete Operation</th></tr>';
$mysqli = new mysqli("mysql.eecs.ku.edu", "grantholmes", "anooL9uu", "grantholmes");

$query = "SELECT content, author_id, post_id FROM Posts";
if ($result = $mysqli->query($query)) {
	$to_remove = array();
	while ($row = $result->fetch_assoc()) {
		$id = $row["post_id"];
		if ($_POST[$id]=="on") {
			array_push($to_remove, $id);
		}
	}
	$result->free();
}

foreach ($to_remove as $id) {
	$cmd = 'DELETE FROM Posts WHERE post_id="'.addslashes($id).'"';
	$success = $mysqli->query($cmd);
	$success = $success ? 'Successful' : 'Failed';
	echo '<td style="background-color:white;">'.$id.'</td><td style="background-color:white;">'.$success.'</td>';
	echo '</tr><tr>';
}

$mysqli->close();
echo '</tr>';
echo '<tr><td colspan="2" style="border: none; padding: 0px;"><form action="https://people.eecs.ku.edu/~g569h991/lab_10/DeletePost.html"><input style="padding: 5px; padding-left: 10px; padding-right: 10px;" type="submit" value="Back to Delete"></form></td></tr>';
echo '</tbody></table>';

?>