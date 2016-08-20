<?php

if(isset($_POST['create_user'])){
	//global $connection;
	global $connection;
	$user_name=mysqli_real_escape_string($connection,$_POST['user_name']);
	$user_firstname=mysqli_real_escape_string($connection,$_POST['user_firstname']);
	//$post_category_id=$_POST['post_category_id'];
	$user_lastname=mysqli_real_escape_string($connection,$_POST['user_lastname']);
	$user_role=$_POST['user_role'];
/*
	//get the name of the uploaded file
	$post_image=$_FILES['image']['name'];
	//get the temporary location of the uploaded file on server
	$post_image_temp=$_FILES['image']['tmp_name'];
*/
	$user_email=mysqli_real_escape_string($connection,$_POST['user_email']);
	$user_password=mysqli_real_escape_string($connection,$_POST['user_password']);

	//get randSalt
	$select_user_query="SELECT user_randSalt FROM users";
	$select_user_result=mysqli_query($connection,$select_user_query);

	while($row=mysqli_fetch_assoc($select_user_result)){
		$salt=$row['user_randSalt'];
	}
	//encrypt the password
	$user_password=crypt($user_password,$salt);

	//formatted the date to day,month and year
	//$post_date=date('d-m-y');
	//$post_comment_counts=4;


	//move the uploaded file to a designated location on the server
	//move_uploaded_file($post_image_temp, "../images/$post_image");

	$create_user_query="INSERT INTO users(user_name,user_password,user_firstname,user_lastname,user_email,user_role)";

	$create_user_query .= " VALUES('$user_name','$user_password','$user_firstname','$user_lastname','$user_email','$user_role')";

	$create_user_result=mysqli_query($connection,$create_user_query);
	
	if(!$create_user_result){
		die("Query failed".mysqli_error($connection));
	}
	
	
	echo "User Created:" . " ". "<a href='users.php'>View Users</a>";

	confirm_query($create_user_result);
}

?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="user_lastname">Last Name</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<div clas="form-group">
		<select name="user_role">
			<option value="subscriber">Select Options</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subscriber</option>
		</select>
	</div>

	<div class="form-group">
		<label for="user_name">Username</label>
		<input type="text" class="form-control" name="user_name">
	</div>

<!--
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>
-->
	<div class="form-group">
		<label for="user_email">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>

	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>	

	<div>
		<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
	</div>

</form>