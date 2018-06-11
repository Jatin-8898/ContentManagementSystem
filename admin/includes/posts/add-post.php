<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $post_author = $_SESSION['user_id'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['status'];
        
        if($post_status == "" || !isset($post_status)){      //if blank it wil take draft as default
            $post_status = "draft";
        }
        
        $post_image = $_FILES['image']['name'];               //multi dimensional
        $post_image_temp = $_FILES['image']['tmp_name'];       //temp name coz our browser internally gives name HENCE each img has 2 name
            
            
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        //$post_date = date('d-m-y');                       //we dont need date if we r using now()
        $post_comment_count = 0;

        move_uploaded_file($post_image_temp,"../images/$post_image");     //2 argu 1st temporary file name 2nd Paths of img to be uploaded
        
        /*A FUNCTION TO VALIDATE THE FIELDS PRESENT*/
        //validateAddPost();//remember blank values r inserted so we pasted the insert code in else of validate
        /*INSERT CODE WHICH IS HERE IN COMMENTS IS NOW IN VALIDATE FUNCTION  */
        
        
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";         //even in INT it requires ' '
        
        $create_post_query = mysqli_query($connection,$query);
        
        confirmQuery($create_post_query);

    }
    
?>
  

<form id="addPost" action="" method="post" enctype="multipart/form-data">   
   <!--enc type is multipart/form-data for uploading data (too)-->
    <!--encryption type means data ko chhod ke kuch rahega aur files ko divide kkrat h parts mei especially for image-->
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="title" id="post_title">
    </div>
    
    
    
    <div class="form-group">
        <label for="post_category">Post Category ID</label>
        <select class="form-control" name="post_category_id" id="post_category">
             <?php   
                    $query = "SELECT * FROM categories";  
                    $select_all_categories_query = mysqli_query($connection,$query);        //it will keep alll the rows
            
                    confirmQuery($select_all_categories_query);

                    while($row = mysqli_fetch_assoc($select_all_categories_query)){         
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];         //this is used fot getting the title from db
                        
                        /*BELOW CODE iS FOR GIVING CATEGORY NAME INSTEAD OF ID*/
                            if($post_category_id == $cat_id)
                                echo "<option value='$cat_id' selected>$cat_title</option>";       //--a b c d is label-->
                            else                                                          //value is setting the actionCommand like in java-->
                                echo "<option value='$cat_id'>$cat_title</option>";
                    }
            ?>            
        </select>
    </div>
    
    
    
    
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="status" id="post_status" class="form-control">
        
            <option value="draft" selected >Draft</option>
            <option value="published" >Published</option>
            
        </select>
    </div>
    
    
    
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image" id="post_image">
    </div>

   
   
   
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

   
   
    <div class="form-group">
        <label for="post_content">Post Content</label>
            <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"></textarea> 
    </div>
    
    
    
    
    <!--FOR DISPLAYING THE ERROR WE R MAKING A DIV-->    
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <div class="messages"></div>
        </div> 
    </div>
    
    
    
    <div class="form-group">
    <button class="btn btn-primary">Preview Post</button>
    <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
    
</form>


