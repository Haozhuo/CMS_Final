<?php

if(isset($_POST['create_post'])){
	//global $connection;
	global $connection;
	$post_title=mysqli_real_escape_string($connection,$_POST['title']);
	$post_author=mysqli_real_escape_string($connection,$_POST['author']);
	//$post_category_id=$_POST['post_category_id'];
	$post_category_id=$_POST['post_category'];
	$post_status=$_POST['post_status'];

	//get the name of the uploaded file
	$post_image=$_FILES['image']['name'];
	//get the temporary location of the uploaded file on server
	$post_image_temp=$_FILES['image']['tmp_name'];

	$post_tags=mysqli_real_escape_string($connection,$_POST['post_tags']);
	$post_content=mysqli_real_escape_string($connection,$_POST['post_content']);
	//formatted the date to day,month and year
	$post_date=date('d-m-y');
	//$post_comment_counts=4;

	//move the uploaded file to a designated location on the server
	move_uploaded_file($post_image_temp, "../images/$post_image");

	//insert data into database
	$insert_query="INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,post_comment_counts,
	post_status,post_view_counts) VALUES('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags',0,'$post_status',0)";
	
	$result=mysqli_query($connection,$insert_query);
	confirm_query($result);
	//get the lastest inserted id
	$id=mysqli_insert_id($connection);

	/*
	if(!$result){
		die("Query failed".mysqli_error($connection));
	}
	*/

	echo "<p class='bg-success'>Post Created: <a href='../post.php?p_id={$id}'>View Post</a></p>";
}

?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title">
	</div>

	<div class="form-group">
		<label for="post_category">Post Category</label>
		<select name="post_category">
			<?php
				//a dropdown list to select category
				//make a selection element which contains all cat_title in "categories"
				$select_category_query="SELECT * FROM categories";
				$select_category_result=mysqli_query($connection,$select_category_query);

				confirm_query($select_category_result);

				
				while($row=mysqli_fetch_assoc($select_category_result)){
					$cat_id=$row['cat_id'];
					$cat_title=$row['cat_title'];
					
					echo "<option value={$cat_id}>{$cat_title}</option>";
				}
			?>
		</select>
	</div>

	<div class="form-group">
		<label for="title">Author</label>
		<input type="text" class="form-control" name="author">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<select name="post_status">
			<option value="draft">Select Optionss</option>
			<option value="draft">Draft</option>
			<option value="published">Publish</option>
		</select>
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="30">
		</textarea>
	</div>

	<div>
		<input class="btn btn-primary" type="submit" name="create_post" value="Post">
	</div>

</form>