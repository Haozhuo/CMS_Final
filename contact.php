 <?php  include "includes/header.php"; ?>

 <?php
 $message="";

 if(isset($_POST['submit'])){
    //send email
   $to="vichuang@haozhuohuang.com";
   $subject=$_POST['contact_subject'];
   $body=$_POST['content'];
   $header="From:".$_POST['email_address'];

   mail($to,$subject,$body,$header);
 }

 ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact admin</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                    <h6 class="text-center"><?php if(isset($_POST['submit'])){
                                echo $message;
                        }?></h6>
                        <div class="form-group">
                            <label for="email" class="sr-only">Your email</label>
                            <input type="email" name="email_address" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="contact_subject" id="subject" class="form-control" placeholder="Enter subject" required>
                        </div>
                         <div class="form-group">
                            <label for="user_password" class="sr-only">Content</label>
                            <textarea name="content" id="content" class="form-control" required></textarea>
                        </div>

                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
