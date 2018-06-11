<?php
if(isset($_POST['submit'])){
    
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: Jatin Varlyani <enquiry@JatinVarlyaniBlog.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
    $to = $_POST['emailid'];
    $subject = $_POST['subject'];
    
    $body = $_POST['comments'];
    
    $sentStatus = mail($to, $subject, $body, $headers);
    if(!sentStatus){
        echo $error_get_last()['message'];
        
    }else{
        echo "SENT";
        
    }
    header("Location:contact.php");
}
?>


<!DOCTYPE html>
<?php
    ob_start(); //this should be the first line n it clears the buffer wen it crosses 4096 or it has sent the page 
?>

<html lang="en">

<?php
    $page ="contact";
    include_once("../includes/db.php");
    include_once("includes/header.php");
    include_once("functions.php");
    $title = "Contact Us";
    $username = checkUser();

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
                                        Contact us
                                    </h1>
                                    
                                <form action="" method="POST" role="form">
                                <legend>Contact us!</legend>


                                <div class="form-group">
                                    <label for="emailid">Email ID</label>
                                    <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Your email">
                                </div>

                                <div class="form-group">
                                    <label for="subject">Subjects</label>
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Your subject">
                                </div>

                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <textarea name="comments" class="form-control" id="comments" rows="10" placeholder="Your Comments"></textarea>
                                </div>


                                <button type="submit" name="submit" class="btn btn-primary btn-block btn">Submit</button>
                                </form>

                                </div>
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->

            
            
            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>
        
            <!--BOOTSTRAP VALIDATOR-->
            <script src="js/bootstrapValidator.min.js"></script>

            <!--CUSTOM SCRIPT BY JV-->
            <script src="js/scripts.js"></script>

    </body>
</html>

   

   
   
   
   
   
   
   
   
   




  
  



