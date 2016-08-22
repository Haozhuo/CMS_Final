<?php
ob_start();
session_start();
?>
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Front Page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">


                <?php
                //select all documents from "categories" table
                $query="SELECT * FROM categories";

                //query the database to get all the documenta
                $select_all_categories=mysqli_query($connection,$query);


                //loop through the result and get 
                //all the value of category and
                //echo them by "anchor" tag
                while($row=mysqli_fetch_assoc($select_all_categories)){
                    $cat_id=$row['cat_id'];
                    $cat_title=$row['cat_title'];
                    echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                }

                ?>

                <li>
                    <a href="admin/index.php">Admin</a>
                </li>

                <?php
                    //if user is logged in, display the edit link
                    //that links to the edit post page of that specific post
                    if(isset($_SESSION['user_name'])){
                        if(isset($_GET['p_id'])){
                            $id=$_GET['p_id'];
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$id}'>Edit Post</a></li>";
                        }
                    }

                ?>

                <li>
                    <a href="registration.php">Register</a>
                </li>

                <li>
                    <a href="contact.php">Contact</a>
                </li>

                <!--
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>