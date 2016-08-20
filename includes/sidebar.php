            <div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <!-- form for search -->
                    <form action="./search.php" method="post">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>



                <div class="well">
                    <h4>Login</h4>
                    <!-- form for search -->
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter username">
                        </div>

                         <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter password">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                                </span>
                        </div>
                    </form>
                        <!-- /.input-group -->
                </div>


                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                    <?php
                        $query="SELECT * FROM categories";
                        $select_categories_sidebar=mysqli_query($connection,$query);

                        while($row=mysqli_fetch_assoc($select_categories_sidebar)){
                            $cat_id=$row['cat_id'];
                            $cat_title=$row['cat_title'];

                            //use query string to send category id
                            echo  "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                        }
                    ?>
                            </ul>
                        </div>
                    </div>
                </div>
                    
                 
                        <!-- /.col-lg-6 --><!--
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>-->
                        <!-- /.col-lg-6 -->
                    <!--</div>-->
                    <!-- /.row -->
                <!--</div>-->

                <!-- Side Widget Well -->
                <?php
                    include "wiget.php";
                ?>

            </div>