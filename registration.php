 <?php  include "includes/header.php"; ?>

 <?php
    if(isset($_POST['submit'])){
       global $connection;
       $user_name=mysqli_real_escape_string($connection,$_POST['user_name']);
       $user_email=mysqli_real_escape_string($connection,$_POST['user_email']);
       $user_password=mysqli_real_escape_string($connection,$_POST['user_password']);

       if(!empty($user_name)&&!empty($user_email)&&!empty($user_password)){
            $rand_salt_query="SELECT user_randSalt FROM users";
            $rand_salt_result=mysqli_query($connection,$rand_salt_query);

             if(!$rand_salt_result){
                  die("Query failed ". mysqli_error($connection));     
             }

             while($row=mysqli_fetch_assoc($rand_salt_result)){
                $salt=$row['user_randSalt'];
                if($salt)
                    break;
             }

             $user_password=crypt($user_password,$salt);

             $registration_query="INSERT INTO users(user_name,user_email,user_password,user_role) VALUES('{$user_name}','{$user_email}','{$user_password}','subscriber')";
             $registration_result=mysqli_query($connection,$registration_query);

             if(!$registration_result){
                die("Query failed ". mysqli_error($connection)); 
             }

             $message="Your registration is completed";

       }else{
           $message="Fields cannot be empty";
       }


    }
 ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    <h6 class="text-center"><?php if(isset($_POST['submit'])){
                                echo $message;
                        }?></h6>
                        <div class="form-group">
                            <label for="user_name" class="sr-only">username</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="user_email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="user_email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="user_password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
