<!DOCTYPE html>
<html lang="en">
<?php
    $title = "Register Yourself";
    include_once("includes/header.php");            //bring once if & already brought wont bring
    include_once("includes/db.php");
    include_once("admin/functions.php");

    if(isset($_POST['register'])){
        //echo "hello";
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $emailid = $_POST['emailid'];
        
        $reg_image = $_FILES['image']['name'];               //multi dimensional
        $reg_image_temp = $_FILES['image']['tmp_name'];
        
        //CLEANING ALL INPUTS
        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $password = mysqli_real_escape_string($connection, $password);
        $emailid = mysqli_real_escape_string($connection, $emailid);
        
        $query = "SELECT * FROM users WHERE user_name = '$username'";
        $checkusername = mysqli_query($connection,$query);
        
        if($row  = mysqli_fetch_assoc($checkusername)){
            echo "USER ALREADY EXIST";
            
        }else{
            
            //echo "VALID";
            $options = [
                'cost' => 10,       //this depends of server usually it should be between 7-13
                'salt' => mcrypt_create_iv(22,MCRYPT_DEV_URANDOM),  //this creates a randomised salt ie hashed password

            ];        

                $hashedpass =  password_hash("$password",PASSWORD_BCRYPT,$options);       //3 argu ie plain password,technique,options
                //echo $hashedpass;
                
                move_uploaded_file($reg_image_temp,"images/$reg_image"); 
            
                $query = "INSERT INTO users (user_name, user_password, user_firstname, user_lastname, user_email, user_image, user_role) VALUES ('$username', '$hashedpass', '$firstname', '$lastname', '$emailid', '$reg_image', 'admin')";
            
                $insert_user_query = mysqli_query($connection,$query);
                confirmQuery($insert_user_query);
                echo "USER REGISTERED SUCCESSFULLY";
            
            }
        
        /* FOR DEBUGGING THIS IS A GOOD PRACTICE TO ECHO ALL THE INPUTS TAKEN */
        //echo $username ." " . $firstname . " " . $lastname . " " . $password . " " . $emailid;
        
    }
?>

    <body>
            <!-- Page Content -->
            <div class="container">

                <div class="row">


                    <div class="col-md-6 col-md-offset-3">
                        <form action="" method="POST" role="form">
                            <legend>Register</legend>

                           
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname">
                            </div>

                           
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="emailid">Email</label>
                                <input type="email" class="form-control" id="emailid" placeholder="someone@exmpale.com" name="emailid">
                            </div>

                            
                           
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter your desired Username" name="username">
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Please provide a Strong password"  name="password">
                            </div>

                            <div class="form-group">
                                <label for="reg_image">Image</label>
                                <input type="file" class="form-control" id="reg_image"  name="image">
                            </div>



                            <button name="register" type="submit" class="btn btn-lg btn-primary">Submit</button>
                        </form>

                    </div>


                </div>
                <!-- /.row -->

                <hr>

        <?php
            include_once("includes/footer.php");
        ?>
            </div>
            <!-- /.container -->

            <!-- jQuery -->
            <script src="js/jquery.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

    </body>

</html>
