<?php 
    
    include_once("includes/db.php");
    include_once("admin/functions.php");
    $title = "Forgot Password";

?>


<?php 

/*IF THE USER HAS CAME FROM localhost/cms/forgot.php THEN HE SHOULDN'T BE ALLOWED TO CHANGE PASS SO REDIRECTIING HIM TO INDEX.php*/
if(!isset($_GET['forgot'])){                    /*THIS IS FROM URL COMING*/
    header("Location:index.php");
}


/*IF THE REQUEST METHOD IS FROM THE FORGET BUTTON IE THROUGH POST REQUEST THEN ONLY GO INSIDE*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $length = 100;               /*THIS IS FOR LENGTH MAKE IT 500 FOR LESS VULNERABILITY*/
        $token = bin2hex(openssl_random_pseudo_bytes($length));         /*BUILT IN FUN TO CREATE A RANDOM NUM*/
        
        
        /*CHECK WHETHER THE EMAIL EXISTS OR NOT*/
        $query = "SELECT * FROM users WHERE user_email = '$email'";
        $user = mysqli_query($connection,$query);
        
        if(mysqli_num_rows($user) == 1){
            /*YOU CAN SAY USER THAT EMAIL EXIST*/
            /*NOW IF THE EMAIL EXISTS THEN JUST UPDATE THE TOKEN*/
            
            $query = "UPDATE users SET token = '$token' WHERE user_email='$email'";
            $updateToken = mysqli_query($connection,$query);
            confirmQuery($updateToken);
            
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'From: Jatin Varlyani <enquiry@jatinvarlyaniblog.com>' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            $to = $email;
            $subject = "JV BLOG FORGOT PASSWORD";

            $body = "Please Click the below link to reset your password:<br/>
            <a href='http://localhost/cms/reset.php?email=$email&token=$token'>http://localhost/cms/reset.php?email=$email&token=$token</a>";

            $sentStatus = mail($to, $subject, $body, $headers);
            if(!$sentStatus){
                echo $error_get_last()['message'];
            }else{
                echo "SENT";
            }
            //header("Location:contact.php");
            
            
            
        }else{
            echo "SOME ISSUE WITH THE EMAIL ID OR NO SUCH USER FOUND";
        }
        
        
    }
}





?>








<html>
<?php 
        include_once("includes/header.php");
    ?>

<body>
    <?php 
            include_once("includes/navigation.php");
        ?>
    <div class="container">

        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <div class="panel panel-default">

                    <div class="panel-body">

                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here!</p>

                            <div class="panel-body">
                                <form action="" role="form" id="forgot-password" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input class="form-control" type="email" id="email" name="email" placeholder="Enter your email here">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" name="reset-submit" value="submit">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
