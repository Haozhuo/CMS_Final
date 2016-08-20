<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
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
                                global $connection;
                                $select_all_query="SELECT * FROM comments";
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

                                    
                                    echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                                    //use unapporve parameter to unapporve a comment
                                    echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                                    //use delete parameter to approve a comment and a p_id to decrease the 
                                    //comment_counts by 1
                                    echo "<td><a href='comments.php?delete={$comment_id}&p_id={$comment_post_id}'>Delete</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                                
                        </table>

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


    header("Location: comments.php");
}

//approve a comment
if(isset($_GET['approve'])){
    global $connection;
    $approve_comment_id=$_GET['approve'];
    //approve a specific comment
    $approve_query="UPDATE comments SET comment_status='approved' WHERE comment_id='$approve_comment_id'";
    $approve_result=mysqli_query($connection,$approve_query);

    confirm_query($approve_result);

    header("Location: comments.php");
}



//unapproce a comment
if(isset($_GET['unapprove'])){
    global $connection;
    $unapprove_comment_id=$_GET['unapprove'];
    //unapprove s specific comment
    $unapprove_query="UPDATE comments SET comment_status='unapproved' WHERE comment_id='$unapprove_comment_id'";
    $unapprove_result=mysqli_query($connection,$unapprove_query);

    confirm_query($unapprove_result);

    header("Location: comments.php");
}

?>