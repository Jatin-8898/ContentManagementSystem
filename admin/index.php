<!DOCTYPE html>
<html lang="en">

<?php
    $page  = "dashboard";
    include_once("includes/header.php");
    include_once("functions.php");                    /*CALL TO CheckUserSession() IS GIVEN FIRST THEN INSERTING N DELETE IN DB IN BELOW LINNES*/
    $username = checkUser();
    
    /*WE COULD CREATE A FUNC ALSO AND PUT THE BELOW CODE IN THAT FUNCTION*/
    $time_out = time() - 600;       //after 10 mintutes it will timeout
    $session = session_id();        //getting session id which is unique
    $query = "SELECT * FROM users_online WHERE time > $time_out and session = '$session'";  
    
    $check_active_session = mysqli_query($connection,$query);
    if(mysqli_num_rows($check_active_session) == 0){            /*IF SESSION NOT ACTIVE THEN DELETE FROM DB*/
        
        mysqli_query($connection,"DELETE FROM users_online WHERE session = '$session'");    /*DIRECT () OF USING QUERY*/
        
        include_once("../includes/logout.php");                                         /*INCLUDING LOGOUT PAGE*/
        die("YOU HAVE BEEN LOGGED OUT");                                         /*THE PAGE WILL DIE IMMDATIELY*/
        
    }
    
    
?>

    <body>
        <div id="wrapper">
            <!--NAVIGATION-->
            <?php
                    include_once("includes/navigation.php");
            ?>
                <!--END OF NAVIGATION-->
                <div id="page-wrapper">
            
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">
                                    Welcome to CPanel
                                    <small><?php echo "$username"; ?></small>                <!-- jo bhi admin hoga woh aayega-->

                                </h1>
                            </div>
                        </div>
                        <!-- /.row -->


                        <?php
                            include_once('includes/dashboard.php');
                        ?>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

           
        <!-- jQuery -->
        <script src="js/jquery.js"></script>

      <!--CUSTOM SCRIPT-->
       <script src="js/scripts.js"></script>
       
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
