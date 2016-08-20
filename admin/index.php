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
                            Welcome to admin
                            <small> <?php echo $_SESSION['user_name'];?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        global $connection;
                                        $select_all_post_query="SELECT * FROM posts";
                                        $select_all_post_result=mysqli_query($connection,$select_all_post_query);
                                        $post_counts=mysqli_num_rows($select_all_post_result);

                                        echo "<div class='huge'>{$post_counts}</div>";
                                    ?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        global $connection;
                                        $select_all_comment_query="SELECT * FROM comments";
                                        $select_all_comment_result=mysqli_query($connection,$select_all_comment_query);
                                        $comment_counts=mysqli_num_rows($select_all_comment_result);

                                        echo "<div class='huge'>{$comment_counts}</div>";
                                    ?>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        global $connection;
                                        $select_all_user_query="SELECT * FROM users";
                                        $select_all_user_result=mysqli_query($connection,$select_all_user_query);
                                        $user_counts=mysqli_num_rows($select_all_user_result);

                                        echo "<div class='huge'>{$user_counts}</div>";
                                    ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                        global $connection;
                                        $select_all_category_query="SELECT * FROM categories";
                                        $select_all_category_result=mysqli_query($connection,$select_all_category_query);
                                        $category_counts=mysqli_num_rows($select_all_category_result);

                                        echo "<div class='huge'>{$category_counts}</div>";
                                    ?>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="./category.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                    global $connection;
                    //select published posts
                    $select_published_post_query="SELECT * FROM posts WHERE post_status='published'";
                    $select_published_post_result=mysqli_query($connection,$select_published_post_query);
                    $published_post_counts=mysqli_num_rows($select_published_post_result);

                    //select draft posts
                    $select_draft_post_query="SELECT * FROM posts WHERE post_status='draft'";
                    $select_draft_post_result=mysqli_query($connection,$select_draft_post_query);
                    $draft_post_counts=mysqli_num_rows($select_draft_post_result);

                    //select unapproved comments
                    $select_unapp_comm_query="SELECT * FROM comments WHERE comment_status='unapproved'";
                    $select_unapp_comm_result=mysqli_query($connection,$select_unapp_comm_query);
                    $unapp_comm_counts=mysqli_num_rows($select_unapp_comm_result);
                    
                    //select subscribers
                    $select_sub_query="SELECT * FROM users WHERE user_role='subscriber'";
                    $select_sub_result=mysqli_query($connection,$select_sub_query);
                    $sub_counts=mysqli_num_rows($select_sub_result);
                ?>


                <div class="row">
                    <script type="text/javascript">
                          //code for google chart
                          google.charts.load('current', {'packages':['bar']});
                          google.charts.setOnLoadCallback(drawChart);
                          function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                              ['Data','Count'],

                              <?php
                                //use two arrays
                                $element_text=['Active Posts','Published Post','Draft Post','Categories','Users','Subscriber','Comments','Pending Comment'];
                                //number for each category above
                                $element_count=[$post_counts,$published_post_counts,$draft_post_counts,$category_counts,$user_counts,$sub_counts,$comment_counts,$unapp_comm_counts];
                                
                                for($i=0;$i<count($element_text);$i++){
                                    //establish ['Data','Count'] pairs to display the chart
                                    echo "['{$element_text[$i]}'" . ","."{$element_count[$i]}],";
                                }


                              ?>

                             // ['Post',1000]
                       
                            ]);

                            var options = {
                              chart: {
                                title: '',
                                subtitle: '',
                              }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                          }
                    </script>

                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
<?php include "includes/admin_footer.php";?>