
<?php
    ob_start();             //this should be the first line n it clears the buffer wen it crosses 4096 or it has sent the page 
?>

<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    $title = "Individual Post";
    include_once("includes/header.php");
    include_once("includes/db.php");
    include_once("admin/functions.php");
?>
    
<body>

    <!-- Navigation -->
    <?php 
        include_once("includes/navigation.php");
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
        <?php
                if(isset($_GET['p_id'])){
                    
                $post_id = $_GET['p_id'];                    
                $query = "SELECT * FROM posts,users WHERE posts.post_author = users.user_id and posts.post_id = $post_id";  
                $select_all_posts_query = mysqli_query($connection,$query);     //it will keep alll the rows
                    
                if($row = mysqli_fetch_assoc($select_all_posts_query)){         
                    //row is now 1 dimensional n assoc array n we use assoc[] usiing key ie cat_id n cat_title
                    //by def table points to -1
                    
                $post_title = $row['post_title'];
                $post_author = $row['user_firstname']. " " .$row['user_lastname'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_author_id = $row['post_author'];    
                    
                
        ?>
                <!-- Title -->
                <div class="post-title">
                <h1 class="post-title"><?php echo $post_title;?></h1>
                <?php 
                    if(isset($_SESSION['user_id'])){
                        $user_id = $_SESSION['user_id'];
                        
                        if($user_id == $post_author_id){
                ?>          
                       
                <a class="fa fa-pencil btn btn-warning" href="admin/posts.php?source=edit_post&p_id=<?php echo $post_id;?>"> Edit Post</a>          <?php 
                        }
                    }    
                ?>
                </div>
                <!-- Author -->
                <p class="lead">
                    <a href="#"><?php echo $post_author;?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">

                <hr>

                <!-- Post Content -->
                <p><?php echo $post_content;?></p>

                <hr>
        <?php
                }//end of while
            }//end of if
                
            include_once("comments.php");    
            
                
        ?>    
        <!--COMMENT SECTION SHOULD GO HERE-->
               
            </div>
                
            <!-- Blog Sidebar Widgets Column -->
            <?php
                include_once("includes/sidebar.php");
            ?>
            
            </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
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
