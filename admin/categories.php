<!DOCTYPE html>
<?php
    ob_start();             //this should be the first line n it clears the buffer wen it crosses 4096 or it has sent the page 
?>

<html lang="en">

<?php
    $page  = "categories";
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
                                        <small><?php echo "$username"; ?></small>
                                        <!-- jo bhi admin hoga woh aayega-->
                                    </h1>
                                    
                                   <?php
                                        include_once("includes/category/add-category.php");
                                    ?>
                                    
                                    <?php
                                        include_once("includes/category/edit-category.php");
                                    ?>
                                    
                                    <?php
                                        include_once("includes/category/view-categories.php");
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

           
            <!-- jQuery -->
            <script src="js/jquery.js"></script>

            <!--BOOTSTRAP VALIDATOR-->
            <script src="js/bootstrapValidator.min.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>
            
            <!--CUSTOM SCRIPT BY JV-->
            <script src="js/scripts.js"></script>
            
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    </body>
</html>
