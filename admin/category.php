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

                        <div class="col-xs-6">
                            <?php
                                //insert category
                                insert_categories();
                            ?>
                            <form action="category.php" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php
                                //update and include update
                                if(isset($_GET['edit'])){
                                    $cat_id=$_GET['edit'];

                                    include "includes/update_category.php";
                                }
                            ?>

                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Titles</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        //find all categories and display in a table
                                        find_all_categories();
                                    ?>


                                    <?php
                                        //delete certain categoriesÍ
                                        delete_categories();
                                    ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
<?php include "includes/admin_footer.php";?>