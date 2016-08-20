<?php

if(isset($_GET['p_id'])){
	global $connection;
	//use p_id to get the id to be edited
	$edit_id=$_GET['p_id'];

	//select id need to be edit
	$edit_query="SELECT * FROM posts WHERE post_id={$edit_id}";
	$edit_result=mysqli_query($connection,$edit_query);

	confirm_query($edit_result);

	while($row=mysqli_fetch_assoc($edit_result)){
		//cache that id information
		$title=$row['post_title'];
		$category_id=$row['post_category_id'];
		$author=$row['post_author'];
		$status=$row['post_status'];
		$image=$row['post_image'];
		$tags=$row['post_tags'];
		$content=$row['post_content'];
	}

	if(isset($_POST['update_post'])){
		global $connection;
		//cache the values that are edited
		$post_title=mysqli_real_escape_string($connection,$_POST['title']);
		$post_author=mysqli_real_escape_string($connection,$_POST['author']);
		$post_category_id=$_POST['post_category_id'];
		$post_status=$_POST['post_status'];

		//get the name of the uploaded file
		$post_image=$_FILES['image']['name'];
		//get the temporary location of the uploaded file on server
		$post_image_temp=$_FILES['image']['tmp_name'];

		$post_tags=$_POST['post_tags'];
		$post_content=mysqli_real_escape_string($connection,$_POST['post_content']);

		//upload the new file
		move_uploaded_file($post_image_temp, '../images/{$post_image}');

		//make sure we have image when we do not update image
		if(empty($post_image)){
			$image_query="SELECT * FROM posts WHERE post_id='$edit_id'";
			$image_result=mysqli_query($connection,$image_query);

			while($row=mysqli_fetch_assoc($image_result)){
				$post_image=$row['post_image'];
			}
		}
		
		//mkae the update query and update
		/*
		$update_query="UPDATE posts SET post_category_id='$post_category_id', post_title='$post_title', post_author='$post_author', post_date=now(), post_image='$post_image', post_content='$post_content', post_tags='$post_tags', post_status='$post_status' WHERE post_id='$edit_id'";
		*/

		
		$update_query="UPDATE posts SET ";
		$update_query.="post_category_id='$post_category_id', ";
		$update_query.="post_title='$post_title', ";
		$update_query.="post_author='$post_author', ";
		$update_query.="post_date=now(), ";
		$update_query.="post_image='$post_image', ";
		$update_query.="post_content='$post_content', ";
		$update_query.="post_tags='$post_tags', ";
		$update_query.="post_status='$post_status' WHERE post_id='$edit_id'";


		$update_result=mysqli_query($connection,$update_query);

		//echo "Post Updated:" . " ". "<a href='posts.php'>View Posts</a>";

		//give users information after they complete update
		//and give them options to view that post or edit more posts
		echo "<p class='bg-success'>Post Updated: <a href='../post.php?p_id={$edit_id}'>View Post</a> | <a href='posts.php'>Edit More Posts</a></p>";

		confirm_query($update_result);
	}
}

?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
	</div>

	<div class="form-group">
		<label for="post_category">Post Category ID</label>
			<select name="post_category_id">
			<?php
				//make a selection element which contains all cat_title in "categories"
				$select_category_query="SELECT * FROM categories";
				$select_category_result=mysqli_query($connection,$select_category_query);

				confirm_query($select_category_result);

				
				while($row=mysqli_fetch_assoc($select_category_result)){
					$cat_id=$row['cat_id'];
					$cat_title=$row['cat_title'];
					//determine whether certain cat_id should be seleted or not
					//In other words, select category id that this element belongs to
					if($cat_id==$category_id){
						echo "<option value={$cat_id} selected>{$cat_title}</option>";
					}else{
						echo "<option value={$cat_id}>{$cat_title}</option>";
					}
				}
			?>
			</select>
	</div>

	<div class="form-group">
		<label for="title">Author</label>
		<input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<select name="post_status">
			<option value="<?php echo $status; ?>"><?php echo $status;?></option>
			<?php
				//a conditional statement to display the status
				//of a post first
				if($status=='published'){
					echo "<option value='draft'>draft</option>";
				}else{
					echo "<option value='published'>published</option>";
				}
			?>
		</select>
	</div>

	<div class="form-group">
		<img width='100' src="../images/<?php echo $image; ?>" alt="image">
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags" value="<?php echo $tags; ?>">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="30"><?php echo $content;?>
		</textarea>
	</div>

	<div>
		<input class="btn btn-primary" type="submit" name="update_post" value="Update">
	</div>

</form>