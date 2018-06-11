<?php 
    

    if(isset($_GET['onlineusers'])){
        session_start();                    /*STARTING THE SESSION*/
        include_once("../includes/db.php");     /*INCLUDING DB.PHP*/
        checkUserSession();                 /*CALLING BELOW FUNC*/

    }


/*FUNCTION FOR CHECKING THE USER SESSION*/
function checkUserSession(){
    
        global $connection;
        if(!$connection)
            echo "CONN NOT FOUND";
        
        /*MANAGING USERS ONLINE FEATURE*/
        $session = session_id();
        $user_id = $_SESSION['user_id'];

        $time_out_in_seconds = 600;      //time out duration of inactive user
        $time = time();                     //GETTING CURRENT TIMME
        $time_out = $time - $time_out_in_seconds;   

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $user_exists = mysqli_query($connection,$query);

        //Wen he comes first time so we need to puthim online in db
        if(mysqli_num_rows($user_exists) == 0){
            $query = "INSERT INTO users_online (session, time, user_id) VALUES('$session', '$time', $user_id)"; //INSERT INTO DB
            $insert_query = mysqli_query($connection,$query);

        }
//    else{
//            /*MAKING PROVISION TO AUTO LOGOUT IF NO ACTIVITY CONDUCTED*/
//            //eg if he logs in at 3pm then at 3.5 he will be auto logout //if came at 3.2 then logout at 3.7 
//
//            /*this checks the last access time*/
//            $query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
//            $update_query = mysqli_query($connection,$query);
//        }


        $query = "SELECT * FROM users_online WHERE time > $time_out";
        $online_user_query = mysqli_query($connection,$query);

        $online_user_count = mysqli_num_rows($online_user_query);           //GIVES COUNT
        echo $online_user_count;
}








/*FUNCTION FOR CONFIRM QUERY*/
function confirmQuery($result){
    global $connection;                 ///this we have to tell php that $connection is now globa
    
    if(!$result){
        die("QUERY FAILED :" .mysqli_error($connection));
    }
}

/*FUNCTION FOR ADD CATEGORY*/
function addCategory(){
    
    global $connection;      //this we have to tell php that $connection is now global bt scope is in this () only
    
    if(isset($_POST['submit'])){
        $input_cat_title = $_POST['cat_title'];

        if($input_cat_title == "" || empty($input_cat_title)){
            echo "Please insert category title and then try";
        }else{
            
            $query = "SELECT cat_title FROM categories WHERE cat_title = '$input_cat_title'";
            $checkquery = mysqli_query($connection,$query);
                
            if(mysqli_num_rows($checkquery)>0){
               echo "ALREADY PRESENT"; 
            }else{
            
            $query = "INSERT INTO categories(cat_title) ";    
            $query .= "VALUE('$input_cat_title')";              //this willtake title from $input_cat_title
                                                                //n put in col of db
            $add_cat_query = mysqli_query($connection,$query);

            if(!$add_cat_query){
                die('QUERY FAILED' .mysqli_error($connection));
            }
                header("Location: categories.php");    
            }
        }
    }
}


/*FUNCTION FOR EDIT CATEGORY*/
function editCategory(){
    
    global $connection;                     //this we have to tell php that $connection is now global
        
    if(isset($_POST['edit_submit'])){           //on btn click if some value is der
        $input_cat_title = $_POST['cat_title']; //for title from db
        $input_cat_id = $_GET['edit'];          //this will bring eg edit=5 using get from url 

        if($input_cat_title == "" || empty($input_cat_title)){
            echo "Please insert category title and then try";
        }else{

            $query = "UPDATE categories SET cat_title = '$input_cat_title'  /*syntax update tablename*/
            WHERE cat_id = $input_cat_id";

            $update_cat_query = mysqli_query($connection,$query);

            if(!$update_cat_query){
                die('QUERY FAILED' .mysqli_error($connection));
            }
            header("Location: categories.php");
        }
    }
}






/*FUNCTION FOR FETCHING THE CATEGORY FOR EDITING*/
function fetchCategoryForEdit(){
    
    global $connection;
     //used to fetch cat_title a/c to the edit GET request
    if(isset($_GET['edit'])){
        $edit_cat_id = $_GET['edit'];           //get the cat_id
        $query = "SELECT * FROM categories WHERE cat_id = $edit_cat_id";//this will bring the selected id

        $edit_category_title_query = mysqli_query($connection,$query);//make ResultSet 
        if($row = mysqli_fetch_assoc($edit_category_title_query)){  //bring the row
            return $row['cat_title'];
        }
    }
}





/*FUNCTION FOR VALIDATIONS*/
function validateAddPost(){
    
    global $connection;  
    
    if(isset($_POST['create_post'])){
        
        /*DEFINING THE CONSTANTS IF ERRORS COME*/
        $post_title_Error =  $post_tags_Error =  $post_content_Error =  $post_image_Error =  $post_category_id_Error = $post_author_Error = $post_status_Error =  $post_comment_count_Error =  "";
        
        
        /*DEFINING THE VARIABLES FOR ALL THE FIELDS*/
        $input_post_title = $_POST['title'];
        $input_post_author = $_POST['author'];
        $input_post_tags = $_POST['post_tags'];
        $input_post_content = $_POST['post_content'];
        $input_post_image = $_FILES['image']['name'];
        $input_post_image_temp = $_FILES['image']['tmp_name'];
        
        $input_post_category_id = $_POST['post_category_id'];
        $input_post_status = $_POST['status'];

        $input_post_comment_count = 0;
        
        move_uploaded_file($input_post_image_temp,"../images/$input_post_image");
        
        
        
        if($input_post_title == "" && $input_post_author == "" && $input_post_tags =="" && $input_post_content =="" && $input_post_image =="" && $input_post_category_id == "" && $input_post_status ==""){
                
            echo "PLEASE INSERT ALL THE FIELD<br>";

        }else{
         
                /*CODE TO CHECK IF EMPTY*/
                if($input_post_title == "" || empty($input_post_title)){
                    echo "PLEASE INSERT POST TITLE AND THEN TRY<br>";
                }else{
                    /*CODE TO CHECK WEN SOMETHING IS DER SO BRING FROM DB TO SEE IT IS ALREADY PRESENT OR NOT*/
                    $query = "SELECT post_title FROM posts WHERE post_title = '$input_post_title'";
                    $check_post_title_query = mysqli_query($connection,$query);

                    if(mysqli_num_rows($check_post_title_query) > 0){
                       echo "TITLE ALREADY PRESENT<br>";    
                    }else{
                        //insert();
                    }
                }
                if($input_post_author == "" || empty($input_post_author)){
                    echo "PLEASE INSERT POST AUTHOR AND THEN TRY<br>";
                }else{
                    /*CODE TO CHECK WEN SOMETHING IS DER SO BRING FROM DB TO SEE IT IS ALREADY PRESENT OR NOT*/
                    $query = "SELECT post_author FROM posts WHERE post_author = '$input_post_author'";
                    $check_post_author_query = mysqli_query($connection,$query);

                    if(mysqli_num_rows($check_post_author_query) > 0){
                       echo "AUTHOR ALREADY PRESENT<br>"; 
                    }else{
                        //insert();
                    }
                    
                }
                if($input_post_tags == "" || empty($input_post_tags)){
                    echo "PLEASE INSERT POST TAGS AND THEN TRY<br>";
                }else{
                    /*CODE TO CHECK WEN SOMETHING IS DER SO BRING FROM DB TO SEE IT IS ALREADY PRESENT OR NOT*/
                    $query = "SELECT post_tags FROM posts WHERE post_tags = '$input_post_tags'";
                    $check_post_tags_query = mysqli_query($connection,$query);

                    if(mysqli_num_rows($check_post_tags_query) > 0){
                       echo "TAGS ALREADY PRESENT<br>"; 
                    }else{
                        //insert();
                    }    
                }
                if($input_post_content == "" || empty($input_post_content)){
                    echo "PLEASE INSERT POST CONTENT AND THEN TRY<br>";
                }else{
                    /*CODE TO CHECK WEN SOMETHING IS DER SO BRING FROM DB TO SEE IT IS ALREADY PRESENT OR NOT*/
                    $query = "SELECT post_content FROM posts WHERE post_content = '$input_post_content'";
                    $check_post_content_query = mysqli_query($connection,$query);

                    if(mysqli_num_rows($check_post_content_query) > 0){
                       echo "CONTENTS ALREADY PRESENT<br>"; 
                    }else{
                        //insert();
                    }        
                }
                if($input_post_image == "" || empty($input_post_image)){
                    echo "PLEASE INSERT POST IMAGE AND THEN TRY<br>";
                }else{
                    /*CODE TO CHECK WEN SOMETHING IS DER SO BRING FROM DB TO SEE IT IS ALREADY PRESENT OR NOT*/
                    $query = "SELECT post_image FROM posts WHERE post_image = '$input_post_image'";
                    $check_post_image_query = mysqli_query($connection,$query);

                    if(mysqli_num_rows($check_post_image_query) > 0){
                       echo "IMAGE ALREADY PRESENT<br>"; 
                    }else{
                        //insert();
                    }        
                }
            if(!$input_post_title == "" && !$input_post_author == "" && !$input_post_tags =="" && !$input_post_content =="" && !$input_post_image =="" && !$input_post_category_id == "" && !$input_post_status ==""){
            
                /*INSERT INTO DB SUCCESSFULLY*/
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($input_post_category_id, '$input_post_title', '$input_post_author', now(), '$input_post_image', '$input_post_content', '$input_post_tags', '$input_post_comment_count', '$input_post_status')";         

                $create_post_query = mysqli_query($connection,$query);
                confirmQuery($create_post_query); 
            }
        
        }//end of imp else
        
    }//end of isset
    
}   //end of function





/*FUNCTION FOR VALIDATING FORM DATA*/
function validateFormData($formData){
        $formData = trim(stripslashes(htmlspecialchars($formData)));    
        return $formData;
}



function checkUser(){
    
/*IF NOT PROPER USER IT SHOULD REDIRECT TO LOGIN PAGE HERE ITS INDEX.php*/
        if(!isset($_SESSION['user_name'])){
            die("<h2 style = 'color:white'> You have not Logged In,Please Login from  <a href = '../index.php'>here</a></h2>");
            
        }else{
            
            $username = $_SESSION['user_name']; 
            return $username;
        }
}












?>
