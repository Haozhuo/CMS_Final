<?php

function escape_injection($string){
    global $connection;
    return mysqli_real_escape_string($connection,$string);
}

function insert_categories(){
	if(isset($_POST['submit'])){
		global $connection;

        $cat_title=$_POST['cat_title'];

        //check whether the input is empty
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty.";
        }else{
            //insert into categories
            $query="INSERT INTO categories(cat_title) VALUES('$cat_title')";
            //insert
            $create_category=mysqli_query($connection,$query);

            //error checking when insertion failed
			if(!$create_category){
                die('Query failed'.mysqli_error($connection));
            }
        }
    }
}


function find_all_categories(){
    //find all categories and display in a table
    global $connection;

    $query="SELECT * FROM categories";
    $select_categories=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_categories)){
    $cat_id=$row['cat_id'];
    $cat_title=$row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";

    //Make query string to delete and edit specific element
    echo "<td><a href='category.php?delete={$cat_id}'>Delete</a></td>";
    echo "<td><a href='category.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
    }
}


function delete_categories(){
	global $connection;
  	if(isset($_GET['delete'])){
    	//get id to be delete
    	$cat_id_to_delete=$_GET['delete'];
		$delete_query="DELETE FROM categories WHERE cat_id='$cat_id_to_delete'";

		//delete the result
    	$delete_result=mysqli_query($connection,$delete_query);

	    header("Location: category.php");	
    }
}

function confirm_query($query_result){
    global $connection;
    
    if(!$query_result){
        die("Query failed".mysqli_error($connection));
    }
}

function user_online(){
    //if we get the request from ajax
    if(isset($_GET['onlineuser'])){
        global $connection;

        if(!$connection){
            session_start();
            include "../includes/db.php";
        }

        //create a session data
        $session=session_id();
        $time=time();
        $time_out_in_second=1;
        $time_out=$time-$time_out_in_second;

        $session_query="SELECT * FROM users_online WHERE session='$session'";
        $session_result=mysqli_query($connection,$session_query);
        if(!$session_result){
            die("Query failed" . mysqli_error($connection));
        }

        $count=mysqli_num_rows($session_result);

        //if there is no matching session
        if($count==NULL){
            //this mean there is a new user logged in
            mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time')");
        }

        //count the # of users that logged in 1 second
        $user_online_result=mysqli_query($connection,"SELECT * FROM users_online WHERE time < '$time_out'");
        $user_online_count=mysqli_num_rows($user_online_result);
        echo $user_online_count;

        }
    }

 user_online();  

?>
