<?php include "./includes/header.php";
?>

    <!-- Navigation -->
   <?php 
   include "./includes/navigation.php";
   ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


                <?php
                    if(isset($_POST['submit'])){
                        //get the search value
                        $search=$_POST['search'];

                        //a query that select all documents
                        //from "posts" that contains $search
                        $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                        $search_query=mysqli_query($connection,$query);

                        //check if query succeed
                        if(!$search_query){
                            die("Query Failed".mysqli_error($connection));
                        }

                        //count the number of result
                        $count=mysqli_num_rows($search_query);

                        //if no searching result
                        if($count===0){
                            echo "<h1>No results</h1>";
                        }else{
                            //loop through the result and get 
                            //the value of posts
                            while($row=mysqli_fetch_assoc($search_query)){
                                //save values from "posts" table
                                $post_title=$row['post_title'];
                                $post_author=$row['post_author'];
                                $post_date=$row['post_date'];
                                $post_image=$row['post_image'];
                                $post_content=$row['post_content'];

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
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


                        <?php
                            //close the while loop
                            }

                                }
                            }
                        ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php
            include "./includes/sidebar.php";
            ?>

        </div>
        <!-- /.row -->

        <hr>

<?php
include "./includes/footer.php";
?>

