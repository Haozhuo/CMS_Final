<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>   
                            </thead>

                            <tbody>
                            <?php
                                global $connection;
                                $select_all_query="SELECT * FROM users";
                                $select_posts=mysqli_query($connection,$select_all_query);

                                while($row=mysqli_fetch_assoc($select_posts)){
                                    //cahe comment results
                                    $user_id=$row['user_id'];
                                    $user_name=$row['user_name'];
                                    $user_password=$row['user_password'];
                                    $user_firstname=$row['user_firstname'];
                                    $user_lastname=$row['user_lastname'];
                                    $user_email=$row['user_email'];
                                    $user_role=$row['user_role'];
                                   
                                    //consruct the table
                                    echo "<tr>";
                                    echo "<td>{$user_id}</td>";
                                    echo "<td>{$user_name}</td>";
                                    echo "<td>{$user_firstname}</td>";
                                    echo "<td>{$user_lastname}</td>";
                                    echo "<td>{$user_email}</td>";
                                    echo "<td>{$user_role}</td>";

                                    /*
                                    $select_post_title_query="SELECT * FROM posts WHERE post_id='$comment_post_id'";

                                    $select_post_title_result=mysqli_query($connection,$select_post_title_query);

                                    if(!$select_post_title_query){
                                        die(mysqli_error($connection));
                                    }

                                    while($row=mysqli_fetch_assoc($select_post_title_result)){
                                        $post_id=$row['post_id'];
                                        $post_title=$row['post_title'];
                                        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                    }*/

                                    //echo "<td>Some title</td>";
            
                                    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                                    //use unapporve parameter to unapporve a comment
                                    echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                                    //use delete parameter to approve a comment and a p_id to decrease the 
                                    //comment_counts by 1
                                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                                    echo "<td><a id='con' href='users.php?delete={$user_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                                
                        </table>

<?php
//delete user by its id
if(isset($_GET['delete'])){
    global $connection;
    $delete_user_id=$_GET['delete'];

    $delete_user_query="DELETE FROM users WHERE user_id='$delete_user_id'";
    $delete_user_result=mysqli_query($connection,$delete_user_query);

    confirm_query($delete_user_result);

    header("Location: users.php");
}

//change user to admin
if(isset($_GET['change_to_admin'])){
    global $connection;
    $change_user_admin_id=$_GET['change_to_admin'];
    //change s user to admin
    $change_user_admin_query="UPDATE users SET user_role='admin' WHERE user_id='$change_user_admin_id'";
    $change_user_admin_result=mysqli_query($connection,$change_user_admin_query);

    confirm_query($change_user_admin_result);

    header("Location: users.php");
}



//change a user to subscriber
if(isset($_GET['change_to_sub'])){
    global $connection;
    $change_user_sub_id=$_GET['change_to_sub'];
    //change a user tp subscriber
    $change_user_sub_query="UPDATE users SET user_role='subscriber' WHERE user_id='$change_user_sub_id'";
    $change_user_sub_result=mysqli_query($connection,$change_user_sub_query);

    confirm_query($change_user_sub_result);

    header("Location: users.php");
}

?>