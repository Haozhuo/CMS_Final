<?php include "./includes/header.php";
?>

    <!-- Navigation -->
   <?php 
   include "./includes/navigation.php"
   ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                    if(isset($_GET['p_id'])){
                        global $connection;
                        $post_id=$_GET['p_id'];
                        //auto-increment post_counts
                        $post_view_count_query="UPDATE posts SET post_view_counts=post_view_counts+1 WHERE post_id='$post_id'";
                        $post_view_count_result=mysqli_query($connection,$post_view_count_query);

                        if(!$post_view_count_result){
                            die("Query failed".mysqli_error($connection));
                        }

                        //create a query that select all 
                        //elements from "posts" table
                        $query="SELECT * FROM posts WHERE post_id='$post_id'";

                        //query the database to get all the documenta
                        $select_all_post=mysqli_query($connection,$query);


                        //loop through the result and get 
                        //all the value of posts and
                        //echo them by "anchor" tag
                        while($row=mysqli_fetch_assoc($select_all_post)){
                            //save values from "posts" table
                            $post_title=$row['post_title'];
                            $post_author=$row['post_author'];
                            $post_date=$row['post_date'];
                            $post_image=$row['post_image'];
                            $post_content=$row['post_content'];
                            $post_view=$row['post_view_counts'];

                        //interrupt the php to save those variables for later use

                ?>


                 <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author; ?></a>
                </p>
                <p class='lead'>Views: <? echo $post_view; ?></p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>


                <?php
                    //close the while loop
                    }
                }else{
                    header("Location: index.php");
                }
                ?>


                <?php
                    if(isset($_POST['create_comment'])){
                        global $connection;
                        $post_id=$_GET['p_id'];
                        $comment_author=$_POST['comment_author'];
                        $comment_email=$_POST['comment_email'];
                        $comment_content=$_POST['comment_content'];


                        if(!empty($comment_author)&&!empty($comment_email&&!empty($comment_content))){
                                $insert_comment_query="INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
                                $insert_comment_query .= "VALUES('$post_id','$comment_author','$comment_email','$comment_content', 'unapproved',now())";

                                $insert_comment_result=mysqli_query($connection,$insert_comment_query);

                                if(!$insert_comment_result){
                                    die(mysqli_error($connection));
                                }

                                //auto-increment comment counts each time when a comment is created
                                
                                $comment_count_query="UPDATE posts SET post_comment_counts=post_comment_counts+1 WHERE post_id='$post_id'";
                                $comment_count_result=mysqli_query($connection,$comment_count_query);
                                
                                if(!$comment_count_result){
                                    die(mysqli_error($connection));
                                }
                        } else{
                            echo "<script>alert('Fields cannot be empty');</script>";
                        }

                    }
                ?>
                 <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="Author">Author:</label>
                            <input type="text" class="form-control" name="comment_author"></input>
                        </div>

                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input type="email" class="form-control" name="comment_email"></input>
                        </div>

                        <div class="form-group">
                            <label for="Comment">Comment:</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                    //select comments specific to that post
                    global $connection;
                    $select_comment_query="SELECT * FROM comments WHERE comment_post_id='$post_id' AND comment_status='approved' ORDER BY comment_id DESC";
                    $select_comment_result=mysqli_query($connection,$select_comment_query);

                    if(!$select_comment_result){
                        die(mysqli_error($connection));
                    }

                    while($row=mysqli_fetch_assoc($select_comment_result)){
                        $comment_date=$row['comment_date'];
                        $comment_content=$row['comment_content'];
                        $comment_author=$row['comment_author'];
                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <? echo $comment_content; ?>
                    </div>
                </div>

                <?php
                    }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
            include "./includes/sidebar.php"
            ?>

        </div>
        <!-- /.row -->

        <hr>

<?php
include "./includes/footer.php";
?>

      