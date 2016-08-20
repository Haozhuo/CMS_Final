<?php
    include "includes/admin_header.php";

    global $connection;
    if(isset($_SESSION['user_name'])){
        $user_name=$_SESSION['user_name'];

        $user_profile_query="SELECT * FROM users WHERE user_name='$user_name'";
        $user_profile_result=mysqli_query($connection,$user_profile_query);

        while($row=mysqli_fetch_assoc($user_profile_result)){
            $user_id=$row['user_id'];
            $user_name=$row['user_name'];
            $user_password=$row['user_password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_email=$row['user_email'];
            $user_role=$row['user_role'];
        }
    }
?>

<?php
if(isset($_POST['edit_user'])){
    //global $connection;
    global $connection;
    $edit_user_id=$_GET['edit_user'];

    $user_name=mysqli_real_escape_string($connection,$_POST['user_name']);
    $user_firstname=mysqli_real_escape_string($connection,$_POST['user_firstname']);
    //$post_category_id=$_POST['post_category_id'];
    $user_lastname=mysqli_real_escape_string($connection,$_POST['user_lastname']);
    $user_role=mysqli_real_escape_string($connection,$_POST['user_role']);
/*
    //get the name of the uploaded file
    $post_image=$_FILES['image']['name'];
    //get the temporary location of the uploaded file on server
    $post_image_temp=$_FILES['image']['tmp_name'];
*/
    $user_email=mysqli_real_escape_string($connection,$_POST['user_email']);
    $user_password=mysqli_real_escape_string($connection,$_POST['user_password']);

    //formatted the date to day,month and year
    //$post_date=date('d-m-y');
    //$post_comment_counts=4;


    //move the uploaded file to a designated location on the server
    //move_uploaded_file($post_image_temp, "../images/$post_image");

    $edit_user_query="UPDATE users SET user_name='$user_name',user_firstname='$user_firstname',user_lastname='$user_lastname',user_role='$user_role',user_email='$user_email',user_password='$user_password' WHERE user_name='$user_name'";

    $edit_user_result=mysqli_query($connection,$edit_user_query);
    
    confirm_query($edit_user_result);   
}
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

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>">
                            </div>

                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>">
                            </div>

                            <div clas="form-group">
                                <select name="user_role">
                                    <option value="subscriber">Select Options</option>
                                    <?php
                                        if($user_role=='admin'){
                                            echo "<option value='admin' selected>Admin</option>";
                                            echo "<option value='subscriber'>Subscriber</option>";
                                        }else{
                                            echo "<option value='admin'>Admin</option>";
                                            echo "<option value='subscriber' selected>Subscriber</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input type="text" class="form-control" name="user_name" value="<?php echo $user_name;?>">
                            </div>

                        <!--
                            <div class="form-group">
                                <label for="post_image">Post Image</label>
                                <input type="file" name="image">
                            </div>
                        -->
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;?>">
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" class="form-control" name="user_password" value="<?php echo $user_password;?>">
                            </div>  

                            <div>
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                            </div>

                        </form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
<?php include "includes/admin_footer.php";?>