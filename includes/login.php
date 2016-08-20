<?php include "db.php"; ?>
<?php session_start(); ?>

<?php
//TODO: Try other encryption algorithms
if(isset($_POST['login'])){
	global $connection;
	$username=mysqli_real_escape_string($connection,$_POST['username']);
	$password=mysqli_real_escape_string($connection,$_POST['password']);

	$user_query="SELECT * FROM users WHERE user_name='$username'";
	$user_result=mysqli_query($connection,$user_query);

	if(!$user_result){
		die('Query failed '.mysqli_error($connection));
	}
	//fetch user information
	while($row=mysqli_fetch_assoc($user_result)){
		$db_user_id=$row['user_id'];
		$db_user_password=$row['user_password'];
		$db_user_name=$row['user_name'];
		$db_user_firstname=$row['user_firstname'];
		$db_user_lastname=$row['user_lastname'];
		$db_user_role=$row['user_role'];
		$db_user_randSalt=$row['user_randSalt'];
	}

	//encrypt the password again to compare
	$password=crypt($password,$db_user_randSalt);

	//if no user is found or password does not match
	if(mysqli_num_rows($user_result)==0 || $password != $db_user_password){
		header("Location: ../index.php");
	}else{
		//set session data
		$_SESSION['user_name']=$db_user_name;
		$_SESSION['user_firstname']=$db_user_firstname;
		$_SESSION['user_lastname']=$db_user_lastname;
		$_SESSION['user_role']=$db_user_role;


		header("Location: ../admin/index.php");
	}


}
?>