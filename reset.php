<?php 
    
    include_once("includes/db.php");
    include_once("admin/functions.php");
    $title = "Reset Password";

?>


<?php 

/*IF THE TOKEN AND THE VALID EMAIL DOESN'T MATCH THEN GO TO INDEX.php*/
if(!isset($_GET['token']) || !isset($_GET['email'])){
    header("Location: index.php");
    
}else{
    
    /*TAKE ALL THE DETAILS IE TOKEN N EMAIL FROM THE URL*/
    $token = $_GET['token'];
    $email = $_GET['email'];
    
    /*SELECT THAT USER WHOSE TOKEN MATCHES IN THE DB IE THE VALID USER ONLY WILL COME HERE*/
    $query = "SELECT * FROM users WHERE token='$token'";
    $updatePasswordUser =  mysqli_query($connection,$query);
    if(mysqli_num_rows($updatePasswordUser) == 0){
        header("Location: index.php");
    }
}


/*WHEN CLICKED ON THE RESET BUTTON*/
if(isset($_POST['submit'])){
    if(isset($_POST['password']) && isset($_POST['password2'])){
        $password  = $_POST['password'];
        $password2 = $_POST['password2'];
        if($password === $password2){
            
             $options = [
                'cost' => 10,       //this depends of server usually it should be between 7-13
                'salt' => mcrypt_create_iv(22,MCRYPT_DEV_URANDOM),  //this creates a randomised salt ie hashed password

            ];  
            $hashedPassword =  password_hash("$password",PASSWORD_BCRYPT,$options);       //3 argu ie plain password,technique,options
            
            $query = "UPDATE users SET token='', user_password='$hashedPassword' WHERE token='$token' and user_email='$email'";
            $updatePassword = mysqli_query($connection,$query);
            confirmQuery($updatePassword);
            echo "PASSWORD CHANGED SUCCESSFULLY";
            echo "SO PLEASE LOGIN N VERIFY";
            
        }else{
            echo "BOTH PASS DONT MATCH";
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
                            <h3><i class="fa fa-unlock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>

                            <div class="panel-body">
                                <form action="" role="form" id="forgot-password" method="POST">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Enter your new password">
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input class="form-control" type="password" id="password2" name="password2" placeholder="Please repeat your new password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="submit">
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
