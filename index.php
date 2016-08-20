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

                    $num_published=mysqli_num_rows($select_all_published_post);

                    $num_per_page=10;

                    $num_page=ceil($num_published/10);

                    //processing the page number
                    if(isset($_GET['page'])){
                        $page=($_GET['page']);
                    }else{
                        $page=1;
                    }
                    //get the start page number
                    if($page=="" || $page==1){
                        $page_start=0;
                    }else{
                        //get the starting page number
                        $page_start=($page*$num_per_page)-$num_per_page;
                    }

                    //query specific page by page_start number and number of posts per page
                    $page_published_query="SELECT * FROM posts LIMIT $page_start,$num_per_page";
                    $page_published_post=mysqli_query($connection,$page_published_query);

                    if(!$page_published_post){
                        die("Query failed".mysqli_error($connection));
                    }

                    //loop through the result and get 
                    //all the value of posts and
                    //echo them by "anchor" tag
                    if($num_published==0){
                        echo "<h1>No post</h1>";
                    } else{
                        while($row=mysqli_fetch_assoc($page_published_post)){
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

        <!-- Pagination -->
        <ul class="pager">
        <?php

            for($i=1;$i<=$num_page;$i++){
                if($i==$page)
                    echo "<li><a class='active_link' href='index.php?page={$i}'>$i</a></li>";
                else
                    echo "<li><a href='index.php?page={$i}'>$i</a></li>"; 
            }
        ?>
        </ul>

<?php
include "./includes/footer.php";
?>

      