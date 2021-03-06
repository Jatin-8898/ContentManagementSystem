
<!DOCTYPE html>
<?php
    ob_start();             //this should be the first line n it clears the buffer wen it crosses 4096 or it has sent the page 
?>

<html lang="en">

<?php
    $page  = "posts";
    include_once("includes/header.php");
    include_once("functions.php");
    $username = checkUser();

?>
   
   
    <body>
<?php
    if($connection)
        echo "hello";
?>
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
                                        <small><?php echo "$username"; ?></small><!-- jo bhi admin hoga woh aayega-->
                                    </h1>
                                    
                                <?php                   //Conditional routing
                                    $source = "";                                   //Intialsiing to blank else gives error
                                    if(isset($_GET['source'])){                        //bringing from URL
                                        $source = $_GET['source'];                  //putting in variable
                                    }
                                    switch($source){        
                                        case 'add_post':            //we can define constants n do this also
                                            include_once("includes/posts/add-post.php");
                                            break;
                                            
                                        case 'edit_post':
                                            include_once("includes/posts/edit-post.php");
                                            break;
                                            
                                        case '200':             //sample
                                            echo "200";
                                            break;    
                                        default:                    //if nothing is passed in GET() it will execute view all posts
                                            
                                            include_once("includes/posts/view-all-posts.php");
                                            break;
                                    }
                                ?>
                                       
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
