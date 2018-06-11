
    <?php 
        /*FOR DISPLAYING 3 POSTS PER PAGE*/
        $posts_per_page = 3;

            /***************************************************************
            THIS IS USED FOR THE CHECKBOXES TO SELECT ALL THE DATA
            ******************************************************************/
        if(isset($_POST['checkBoxArray'])){

            $bulk_options = $_POST['bulk_options'];
            foreach($_POST['checkBoxArray'] as $postValueId){
                switch($bulk_options){
                    case 'published':
                    case 'draft':
                        $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postValueId";
                        $update_status = mysqli_query($connection,$query);
                        header("Location: posts.php");
                        break;

                    case 'delete':
                        $query = "DELETE FROM posts WHERE post_id = $postValueId";
                        $delete_posts = mysqli_query($connection,$query);
                        header("Location: posts.php");
                        break;  
                }    
            }
        }
    ?>



        <!--VIEW ALL POSTS SECTION -->
             <div class="col-xs-12">
                <form action="" method="post">
                    <table class="table table-bordered table-hover">
                        <div class="col-xs-4" id="bulkOptionsContainer">

                            <select class="form-control" name="bulk_options" id="">
                                <option value="">Select Option</option>
                                <option value="published">Publish</option>
                                <option value="draft">Draft</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>

                        <div class="col-xs-4">
                            <input type="submit" name="submit_bulk_option" class="btn btn-primary" value="Apply">
                            <a class="btn btn-warning" href="posts.php?source=add_post">Add New</a>
                        </div>

                       
        
                        <!--/***************************************
                            FOR THE COLUMNS  TO BE DISLPAYED IN TABLE FORMAT
                            ***********************************/-->
                       
                        <tr>
                            <th><input type="checkbox" class="form-control" id="selectAllBoxes"></th>    <!--FOR CHECKBOX TO SELECTALL-->
                            <th>ID</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Images</th>
                            <th>Tags</th>
                            <th>Comments</th>
                            <th>Date</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    <tbody>
            <?php   

                /***************************************************************
                                THIS IS FOR THE PAGE NUMBERS
                ******************************************************************/
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    
                }else{
                    $page=1;
                    
                }
                if($page=="" || $page == 1){
                    $limit_start = 0;
                    
                }else{
                    $limit_start = ($page * $posts_per_page) - $posts_per_page;
                    
                }
        
                
                $user_role = $_SESSION['user_role'];

                if($user_role == "admin"){ 
                    /*WE DID post_author with user_id so that it wont allow duplicacy or redundacny*/
                    $query = "SELECT * FROM posts,users WHERE posts.post_author = users.user_id ORDER BY posts.post_date DESC";  

                    /*FOR POSTS TO BE DISPLAYED TO ADMIN A/C TO PAGINATION*/
                    $total_post_query = mysqli_query($connection, $query);
                    $total_post_count = mysqli_num_rows($total_post_query);
                    $query = "SELECT * FROM posts, users WHERE posts.post_author = users.user_id ORDER BY posts.post_date DESC LIMIT $limit_start, $posts_per_page";

                }else{
                    
                    /*IF ITS A SUBSCRIBER THEN HE SHOULD ONLY SEE POSTS BY HIM*/
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM posts,users WHERE posts.post_author = users.user_id and posts.post_author = $user_id ORDER BY posts.post_date DESC";  

                    /*FOR POSTS TO BE DISPLAYED TO ADMIN A/C TO PAGINATION*/
                    $total_post_query = mysqli_query($connection, $query);
                    $total_post_count = mysqli_num_rows($total_post_query);
                    $query = "SELECT * FROM posts, users WHERE posts.post_author = users.user_id and posts.post_author = $user_id ORDER BY posts.post_date DESC LIMIT $limit_start, $posts_per_page";
                    
                }

                $select_all_posts_query = mysqli_query($connection,$query); 
                
                /*FOR COUNT VARIABLE TO ROUND OFF THE POSTS IF 3.5 THEN 4*/        
                $count = ceil($total_post_count/$posts_per_page);


                /*WHILE DB HAS SOME DATA KEEPING FETCHING IT */            
                while($row = mysqli_fetch_assoc($select_all_posts_query)){                       //fetching the detail from the db row

                    $post_id = $row['post_id'];          
                    /*FOR GIVING POST AUTHOR COZ FIRST ID WAS COMING SO CONCATENING FNAME N LNAME*/
                    $post_author = $row['user_firstname'] . " " . $row['user_lastname'];

                    $post_title = $row['post_title'];                   //note variable name should be same as in db
                    $post_category_id = $row['post_category_id'];       //thanks
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];

                    /*displaying al the details from the db in the tr ie table row*/
                    echo "<tr>";               
                    
                    echo "<td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='$post_id'></td>";
                    
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>";

                    
                    /********************************************************
                    USED TO PUT THE POST CATEGORY NAME  INSTEAD OF THE ID
                    ********************************************************/
                    $query = "SELECT * FROM categories WHERE cat_id =$post_category_id";  
                    $select_all_categories_query = mysqli_query($connection,$query);        //it will keep alll the rows

                    confirmQuery($select_all_categories_query);
                    if($row = mysqli_fetch_assoc($select_all_categories_query)){  
                        $post_category_title = $row['cat_title'];
                    }
                    echo "<td>$post_category_title</td>";
                    
                    echo "<td>$post_status</td>";
                    
                    //giving dynamic path for img
                    echo "<td><img class='img-responsive' src = '../images/$post_image' width='100px' alt='post image'></td>"; 
                    
                    echo "<td>$post_tags</td>";
                    echo "<td>$post_comment_count</td>";
                    echo "<td>$post_date</td>";
                    echo "<td><a data-toggle='tooltip' title='Delete' class='btn btn-danger del-tooltip' href = 'posts.php?delete=$post_id'><span class = 'fa fa-times'></a></td>";
                    echo "<td><a data-toggle='tooltip' title='Edit' class='btn btn-primary edit-tooltip' href = 'posts.php?source=edit_post&p_id=$post_id'><span class = 'fa fa-pencil'></a></td>";

                    echo "</tr>";
                }      
            ?>
                    </tbody><!--end of tbody-->
                    </table>
                    <!--END OF TABLE-->
                    
                    <!--FOR DISPLAYING PAGINATION-->        
                        <ul class="pager">
                            <?php
                                for($i=1;$i<=$count;$i++){    //just a simppple for looop
                                    if($i == $page){
                                        echo"<li><a class='active-page' href='posts.php?page=$i'>$i</a></li>"; //for active page css also we made

                                    }else{
                                        echo  "<li><a href='posts.php?page=$i'>$i</a></li>";
                                    }
                                }    
                            ?>
                        </ul>

                    </form>
                    
                    
                    
            <!--FOR DELETING-->    
            <?php

                if(isset($_GET['delete'])){
                    $delete_post_id = $_GET['delete'];
                    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
                    $delete_query = mysqli_query($connection,$query);
                    confirmQuery($delete_query);
                    header("Location: posts.php");
                }

             ?>
    </div>
    <!--END OF VIEW ALL POSTS SECTION -->
        
       
      
     
    
   
  
 










