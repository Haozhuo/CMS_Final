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
                    //create a query that select all 
                    //elements from "posts" table
                    $query="SELECT * FROM posts WHERE post_status='published'";

                    //query the database to get all the documenta
                    $select_all_published_post=mysqli_query($connection,$query);


                    //loop through the result and get 
                    //all the value of posts and
                    //echo them by "anchor" tag
                    if(mysqli_num_rows($select_all_published_post)==0){
                        echo "<h1>No post</h1>";
                    } else{
                        while($row=mysqli_fetch_assoc($select_all_published_post)){
                            //save values from "posts" table
                            $post_id=$row['post_id'];
                            $post_title=$row['post_title'];
                            $post_author=$row['post_author'];
                            $post_date=$row['post_date'];
                            $post_image=$row['post_image'];
                            //excerpt
                            //$post_content=substr($row['post_content'],0,150);
                            $post_content=substr($row['post_content'],0,300);


                            //interrupt the php to save those variables for later use
                ?>

                 <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id;?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href='post.php?p_id=<?php echo $post_id;?>'>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


                <?php
                        }
                    //close the while loop
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

      