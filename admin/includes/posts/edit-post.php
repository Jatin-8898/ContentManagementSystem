
<?php
if(isset($_POST['edit_post'])){
        
    if(isset($_GET['p_id'])){
        
        $post_id = $_GET['p_id'];           //getting the post_id from url

        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['status'];

        $post_image = $_FILES['image']['name'];               //multi dimensional
        $post_image_temp = $_FILES['image']['tmp_name'];       //temp name coz our browser internally gives name HENCE each img has 2 name
        //THIS HELPS TO RETAIN THE IMAGE & below is for avoiding broken img wen edit is clicked without chnaging the img
        if(empty($post_image)){
            $image_query = "SELECT * from posts WHERE post_id = '$post_id'";       
            $select_image_query = mysqli_query($connection,$image_query);   //query connection p fire karega & will return all rows this will                                                                     hold rows that is returned by mysqli_query,* returns ResultSet
            if($row = mysqli_fetch_assoc($select_image_query)){          //row is one dimensional array
                $post_image = $row['post_image'];
            }
        }
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        //$post_date = date('d-m-y');                       //we dont need date if we r using now()

        move_uploaded_file($post_image_temp,"../images/$post_image");       //2 argu 1st temporary file name 2nd Paths of img to be uploaded

        /*$query = "UPDATE posts SET post_title='sometitle',post_category_id = 'someid' WHEWE soem conditons";*/

        $query = "UPDATE posts SET ";        //update query
        $query .= "post_title = '$post_title', ";
        $query .= "post_category_id = '$post_category_id', ";

        $query .= "post_image = '$post_image', ";
        $query .= "post_content = '$post_content', ";
        $query .= "post_tags = '$post_tags', ";
        $query .= "post_status = '$post_status' ";
        $query .= "WHERE post_id = $post_id";

        $update_post_query = mysqli_query($connection,$query);

        confirmQuery($update_post_query);               //call to a () & passing $create_post_query
    }
    
}
?>


    <?php

        if(isset($_GET['p_id'])){       //query string ie the param passed in url
            $edit_post_id = $_GET['p_id'];

            $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
            $edit_post_query = mysqli_query($connection,$query);

            if($row = mysqli_fetch_assoc($edit_post_query)){
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_author = $row['post_author'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
            }
        }
?>
          
<!--the only change is that value is putted rest is copy paste from add post-->
<form action="" method="post" enctype="multipart/form-data">          <!--for img to be updated--> 
    <!--encryption type means data ko chhod ke kuch rahega aur files ko divide kkrat h parts mei especially for image-->
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="title" id="post_title">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class="form-control" name="post_category_id" id="post_category">
            
             <?php   
                    $query = "SELECT * FROM categories";  
                    $select_all_categories_query = mysqli_query($connection,$query);        //it will keep alll the rows
            
                    confirmQuery($select_all_categories_query);
                
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){         
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];         //this is used fot getting the title from db
                        
                        /*BELOW CODE iS FOR GIVING CATEGORY INSTEAD OF ID*/
                            if($post_category_id == $cat_id)
                                echo "<option value='$cat_id' selected>$cat_title</option>";             //--a b c d is label-->
                            else                                                          //value is setting the actionCommand like in java-->
                                echo "<option value='$cat_id'>$cat_title</option>";
                    }
            ?>            
        </select>
        <!--
        <input value=<?php echo $post_category_id;?> type="text" class="form-control" name="post_category_id" id="post_category">
        -->
    </div>
    
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="status" id="post_status" class="form-control">
        <?php
           /* if($post_status=="draft"){
                echo "<option value='draft' selected>Draft</option>";
                echo "<option value='published' >Published</option>";
            }else{
                echo "<option value='published' selected>Published</option>";
                echo "<option value='draft' selected>Draft</option>";
            }*/
        ?>
           
            <option value="draft" <?php if($post_status == "draft") echo "selected"; ?>>Draft</option>
            <option value="published"<?php if($post_status == "published") echo "selected"; ?>>Published</option>
            
        </select>
        
<!--
        <input value=<?php echo $post_status;?> type="text" class="form-control" name="status" id="post_status">
-->
    </div>
   
    
      
    <div class="form-group">
        <label for="">Current Image</label>
        <img src="../images/<?php echo $post_image;?>"  width="200px" class="img-responsive"alt=""><!--to bring img from db which is inserted-->
        </div>
    <div class="form-group">   
           <label for="post_image">Post Image</label>                                    <!--id n for should be same-->
            <input class="form-control" type="file" class="form-control" name="image" id="post_image">
    </div>

   
   
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value=<?php echo $post_tags;?> type="text" class="form-control" name="post_tags" id="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"><?php echo $post_content;?></textarea> 
    </div>
    
    
    
    
    <div class="form-group">
    <input type="submit" class="btn btn-primary" name="edit_post" value="Edit Post">
    </div>

</form>




























