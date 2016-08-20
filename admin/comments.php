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
                            <small>Author</small>
                        </h1>

                        <?php
                            $source="";
                            if(isset($_GET['source'])){
                                $source=$_GET['source'];
                            }

                            switch($source){
                                case 'add_comment':
                                        include "includes/add_comment.php";
                                        break;
                                case 'edit_comment':
                                        include "includes/edit_comment.php";
                                        break;
                                case '30':
                                        break;
                                case '40':
                                        break;
                                case '50':
                                        break;
                                default:
                                        include "includes/view_all_comments.php";
                                        break;
                            }
                        ?>

                        

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
<?php include "includes/admin_footer.php";?>