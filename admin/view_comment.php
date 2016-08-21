<?php
    include "includes/admin_header.php";
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php
            include "includes/admin_navigation.php"; 
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Comment
                        </h1>

<?php
if(isset($_POST['checkBoxArray'])){
    global $connection;
    $bulk_option=$_POST['bulk_option'];
    foreach($_POST['checkBoxArray'] as $comment_id_value){
        switch($bulk_option){
            case 'approve':
                $update_query="UPDATE comments SET comment_status='approved' WHERE comment_id='$comment_id_value'";
                $update_result=mysqli_query($connection,$update_query);

                confirm_query($update_result);
                break;
            case 'unapprove':
                $update_query="UPDATE comments SET comment_status='unapproved' WHERE comment_id='$comment_id_value'";
                $update_result=mysqli_query($connection,$update_query);

                confirm_query($update_result);
                break;
            case 'delete':
                $delete_query="DELETE FROM comments WHERE comment_id='$comment_id_value'";
                $delete_result=mysqli_query($connection,$delete_query);

                confirm_query($delete_result);
                break;
            default:
                break;
        }
    }
}



?>

<form action="" method="post">
<table class="table table-bordered table-hover">
  <div id="bulkOptionContainer" class="col-xs-4">
        <select name="bulk_option" id="" class="form-control">
            <option value="">Select Options</option>
            <option value="approve">Approve</option>
             <option value="unapprove">Unapprove</option>
            <option value="delete">Delete</option>
        </select>
    </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
        </div>


                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>   
                            </thead>

                            <tbody>
                            <?php
                                if(isset($_GET['id'])){
                                    global $connection;
                                    $post_id=$_GET['id'];
                                    //select comments specific to post thst has post_id
                                    $select_all_query="SELECT * FROM comments WHERE comment_post_id=$post_id";
                                    $select_posts=mysqli_query($connection,$select_all_query);

                                    while($row=mysqli_fetch_assoc($select_posts)){
                                        //cahe comment results
                                        $comment_id=$row['comment_id'];
                                        $comment_post_id=$row['comment_post_id'];
                                        $comment_author=$row['comment_author'];
                                        $comment_email=$row['comment_email'];
                                        $comment_content=$row['comment_content'];
                                        $comment_status=$row['comment_status'];
                                        $comment_date=$row['comment_date'];
                                       
                                        //consruct the table
                                        echo "<tr>";
                            ?>
                             <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td>

                            <?php
                                        echo "<td>{$comment_id}</td>";
                                        echo "<td>{$comment_author}</td>";
                                        echo "<td>{$comment_content}</td>";
                                        //get the category title from categories database by using
                                        //cpost_category_id in posts table
                                        //limit the selectin to 1

                                        /*
                                        $find_category_id_query="SELECT * FROM categories WHERE cat_id={$post_category_id} LIMIT 1";
                                        $find_category_id_result=mysqli_query($connection,$find_category_id_query);

                                        confirm_query($find_category_id_result);

                                        while($row=mysqli_fetch_assoc($find_category_id_result)){
                                            //print_r($find_category_id_result);
                                            $cat_id=$row['cat_id'];
                                            $cat_title=$row['cat_title'];

                                            echo "<td>{$cat_title}</td>";
                                        }*/

                                        echo "<td>{$comment_email}</td>";
                                        echo "<td>{$comment_status}</td>";

                                        $select_post_title_query="SELECT * FROM posts WHERE post_id='$comment_post_id'";

                                        $select_post_title_result=mysqli_query($connection,$select_post_title_query);

                                        if(!$select_post_title_query){
                                            die(mysqli_error($connection));
                                        }

                                        while($row=mysqli_fetch_assoc($select_post_title_result)){
                                            $post_id=$row['post_id'];
                                            $post_title=$row['post_title'];
                                            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                        }

                                        //echo "<td>Some title</td>";
                                        echo "<td>{$comment_date}</td>";

                                    /*
                                        //construct an associative array
                                        $post['post_id']=$row['post_id'];
                                        $post['post_author']=$row['post_author'];
                                        $post['post_title']=$row['post_title'];
                                        $post['post_category_id']=$row['post_category_id'];
                                        $post['post_status']=$row['post_status'];
                                        $post['post_image']=$row['post_image'];
                                        $post['post_tags']=$row['post_tags'];
                                        $post['post_comment_counts']=$row['post_comment_counts'];
                                        $post['post_date']=$row['post_date'];

                                        $post_id=$post['post_id'];

                                        $find_category_id_query="SELECT * FROM categories WHERE cat_id={$post['post_category_id']} LIMIT 1";
                                        $find_category_id_result=mysqli_query($connection,$find_category_id_result);

                                        confirm_query($find_category_id_result);

                                        while($row=mysqli_fetch_assoc($find_category_id_result)){
                                            $cat_id=$row['cat_id'];
                                            $cat_title=$row['cat_title'];
                                        }

                                        $post['category_title']=$cat_title;

                                        echo "<tr>";

                                        //build the table by iterating the array
                                        foreach($post as $key=>$value){
                                            if($key != 'post_image'){
                                                echo "<td>{$value}</td>";
                                            }else{
                                                echo "<td><img width='100' src='../images/{$value}' alt='image'></td>";
                                            }
                                        }
                                    */

                                        
                                        echo "<td><a href='view_comment.php?approve={$comment_id}'>Approve</a></td>";
                                        //use unapporve parameter to unapporve a comment
                                        echo "<td><a href='view_comment.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                        //use delete parameter to approve a comment and a p_id to decrease the 
                                        //comment_counts by 1
                                        echo "<td><a id='con' href='view_comment.php?delete={$comment_id}&p_id={$comment_post_id}'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                            }
                            ?>
                            </tbody>
                                
                        </table>
                    </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
<?php include "includes/admin_footer.php";
?>

<?php
//delete comment by its id
if(isset($_GET['delete']) && isset($_GET['p_id'])){
    global $connection;
    $delete_comment_id=$_GET['delete'];
    $delete_comment_post_id=$_GET['p_id'];
    //delete a specific comment
    $delete_query="DELETE FROM comments WHERE comment_id={$delete_comment_id}";
    $delete_result=mysqli_query($connection,$delete_query);

    confirm_query($delete_result);
    //decrease the comment count of that comment
    $decrease_comment_count_query="UPDATE posts SET post_comment_counts=post_comment_counts-1 WHERE post_id={$delete_comment_post_id}";
    $decrease_comment_count_result=mysqli_query($connection,$decrease_comment_count_query);

    confirm_query($decrease_comment_count_result);

    //redirect to the page with id
    header("Location: view_comment.php?id={$delete_comment_post_id}");
}

//approve a comment
if(isset($_GET['approve'])){
    global $connection;
    $approve_comment_id=$_GET['approve'];
    //get the post id
    $select_query="SELECT * FROM comments WHERE comment_id='$approve_comment_id'";
    $select_result=mysqli_query($connection,$select_query);

    while($row=mysqli_fetch_assoc($select_result)){
        $post_id=$row['comment_post_id'];
    }

    //approve a specific comment
    $approve_query="UPDATE comments SET comment_status='approved' WHERE comment_id='$approve_comment_id'";
    $approve_result=mysqli_query($connection,$approve_query);

    confirm_query($approve_result);

    header("Location: view_comment.php?id={$post_id}");
}



//unapproce a comment
if(isset($_GET['unapprove'])){
    global $connection;
    $unapprove_comment_id=$_GET['unapprove'];
    //get the post id
    $select_query="SELECT * FROM comments WHERE comment_id='$unapprove_comment_id'";
    $select_result=mysqli_query($connection,$select_query);

    while($row=mysqli_fetch_assoc($select_result)){
        $post_id=$row['comment_post_id'];
    }
    //unapprove s specific comment
    $unapprove_query="UPDATE comments SET comment_status='unapproved' WHERE comment_id='$unapprove_comment_id'";
    $unapprove_result=mysqli_query($connection,$unapprove_query);

    confirm_query($unapprove_result);

    header("Location: view_comment.php?id={$post_id}");
}

?>


