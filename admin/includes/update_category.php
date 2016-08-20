<form action="category.php" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Edit Category</label>

                                    <?php
                                        if(isset($_GET['edit'])){
                                            //get the id to edit
                                            $cat_id_to_edit=$_GET['edit'];

                                            $edit_query="SELECT * FROM categories WHERE cat_id='$cat_id_to_edit'";

                                            //edit
                                            $edit_result=mysqli_query($connection,$edit_query);

                                            //dynamically add searching result
                                            while($row=mysqli_fetch_assoc($edit_result)){ 
                                                $cat_title_to_edit=$row['cat_title'];
                                    ?>

                                    <input type="text" class="form-control" name="cat_title" value="<?php if(isset($_GET['edit'])){echo $cat_title_to_edit;} ?>">

                                    <?php
                                            }                                        
                                        }
                                    ?>

                                    <?php
                                        if(isset($_POST['update'])){
                                            //get the title to be updated
                                            $cat_title_to_edit=$_POST['update'];
                                            //update query
                                            $update_query="UPDATE categories SET cat_title='$cat_title_to_edit' WHERE cat_id='$cat_id_to_edit'";
                                            //update
                                            $update_result=mysqli_query($connection,$update_query);

                                            //error checking
                                            if(!$update_result){
                                                die("Quey failed".mysqli_error($connection));
                                            }

                                        }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="update" value="Add Category">
                                </div>
                            </form>