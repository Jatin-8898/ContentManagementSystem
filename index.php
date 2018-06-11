<!DOCTYPE html>
<html lang="en">

<?php
    $title = "JV BLOG";
    include_once("includes/header.php");            //bring once if & already brought wont bring
    include_once("includes/db.php");
    $posts_per_page = 3;                            //good pratice could be definig constants n then using here
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
                    Blog Website
               <small>Welcome to PHP</small>
                </h1>
                
                
                
        <?php
                /*FOR PAGINATION*/
            if(isset($_GET['page'])){               //wen by def nothing is selected ie wen page is loaded firstt time          
                $page = $_GET['page'];              //we set the page to 1
            }else{
                $page = 1;
            }    
            if($page == "" || $page == 1){
                $limit_start = 0;
                
            }else{
                $limit_start = ($page * $posts_per_page) - $posts_per_page;
            }    
                $query = "SELECT * FROM posts,users WHERE posts.post_author = users.user_id and posts.post_status = 'published'";
                $total_post_query = mysqli_query($connection,$query);
                $total_post_count = mysqli_num_rows($total_post_query);
                    //echo "$total_post_count";     //for test
                
                /*VERY IMP QUERY THIS QUERY DOES WORK OF 2 QUERIES posts,user BRING DATA FROM 2 TABLE when posts table ka author and users ke user_id aur jo posts published h woh leke aayega*/
                $query = "SELECT * FROM posts,users WHERE posts.post_author = users.user_id and posts.post_status = 'published' LIMIT $limit_start,$posts_per_page";
                //We have added limit here ie start n how many posts we want to be displayed
        
                $select_all_posts_query = mysqli_query($connection,$query);        //it will keep alll the rows
            
                $count = ceil($total_post_count / $posts_per_page);     //this will round off ie 3.5 toh 4
                    
                while($row = mysqli_fetch_assoc($select_all_posts_query)){         
                    //row is now 1 dimensional n assoc array n we use assoc[] usiing key ie cat_id n cat_title
                    //by def table points to -1

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    
                    /*FOR GIVING POST AUTHOR COZ FIRST ID WAS COMING SO CONCATENING FNAME N LNAME*/
                    $post_author = $row['user_firstname'] . " " . $row['user_lastname'];
                    
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,100)."...";
                
        ?>
                    <!--START OF BLOG POST-->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" width="500px" src="images/<?php echo $post_image;?>"  alt="<?php echo $post_title;?>">
                <hr>
                <p><?php  echo $post_content?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               
                <?php
                        } //end of while which loads all posts
                        //Instead of echoing all the above line we use this way ie by closing the brace of while loop here
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

        <!--FOR DISPLAYING PAGINATION-->        
        <ul class="pager">
        <?php
            for($i=1; $i <= $count; $i++){    //just a simppple for looop
                if($i == $page){
                    echo "<li><a class='active-page' href='index.php?page=$i'>$i</a></li>";     //for active page css also we made
                    
                }else{
                    echo  "<li><a href='index.php?page=$i'>$i</a></li>";
                }
            }    
        ?>
        </ul>
           
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
