<!---SEARCH PAGE-->


<!DOCTYPE html>
<html lang="en">

<?php
    $title = "SEARCH PAGE";
    include_once("includes/header.php");            //bring once if & already brought wont bring
    include_once("includes/db.php");
?>

    <body>
        <?php
        include_once("includes/navigation.php");
    ?>




            <!-- Page Content -->
            <div class="container">

                <div class="row">

                    <!-- Blog Entries Column -->
                    <div class="col-md-8">

                        <h1 class="page-header">
                            Search Results
                        </h1>



                        <?php 
 
        if(isset($_POST['submit'])){
        $search =  $_POST['search'];
        
        $query = "SELECT * FROM posts WHERE post_tags like '%$search%' AND post_status = 'published'";  //for searching related we  require '' coz if we                                                                        use = it will give the exact result bt we want related
        $search_query = mysqli_query($connection,$query);   //it is a () which takes 2 argument connection n other the query
                                                            //query ke result ko search query mei store karega
        
        if(!$search_query){
            //there was some error in procssing the query
            die("QUERY FAILED:".mysqli_error($connection));  //woh pure page ie sidebar display hi nhi karega like a return in c
        }
        //wen in if statement return is used no need of writing it is understood that it is else only
        //some result was returned
        $count = mysqli_num_rows($search_query);
        if($count == 0){
            echo "<h2>NO RESULT FOUND!!</h2";
        }
        else{
            while($row = mysqli_fetch_assoc($search_query)){         
                    //row is now 1 dimensional n assoc array n we use assoc[] usiing key ie cat_id n cat_title
                    //by def table points to -1

                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                
                   ?>
                                   
                    
                <h2>
                    <a href="#"><?php echo $post_title;?>
                        </a>
                        </h2>
                        <p class="lead">
                            by
                            <a href="index.php">
                                <?php echo $post_author;?>
                            </a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on
                            <?php echo $post_date;?>
                        </p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="<?php echo $post_title;?>">
                        <hr>
                        <p>
                            <?php  echo $post_content?>
                        </p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
<?php        
                        } //end of while which loads all posts
                        //Instead of echoing all the above line we use this way ie by closing the brace of while loop here

                
        }//end of else
    
    }//end of isset
?>






                    </div>
                    <!--END OF BLOG POST-->

                    <!-- Blog Sidebar Widgets Column -->
                    <?php
            include_once("includes/sidebar.php");
        ?>

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
