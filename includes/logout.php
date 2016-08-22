
<?php 
include "db.php";
session_start(); 
?>

<?php
	global $connection;
	//delete that data
	$session=session_id();
	$delete_session_query="DELETE FROM users_online WHERE session='$session'";
	$delete_session_result=mysqli_query($connection,$delete_session_query);

	if(!$delete_session_result){
		die("Query failed " . mysqli_error($connection));
	}
	//destroy session
	session_destroy();

	header("Location: ../index.php");
?>