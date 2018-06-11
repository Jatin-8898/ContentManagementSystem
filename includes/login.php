<?php

    session_start();
    include_once("db.php");
    include_once("../admin/functions.php");
    if(isset($_POST['login'])){

        $username = $_POST['user_name'];         //HERE THE NAME WILL GIVE WHICH IS GIVEN IN DIV OF SIDEBAR
        $password = $_POST['password'];         //HERE THE NAME WILL GIVE WHICH IS GIVEN IN DIV OF SIDEBAR
        
        
        $username = mysqli_real_escape_string($connection,$username);   //THIS WILL REMOVE THE '/'
        $password = mysqli_real_escape_string($connection,$password);   //THIS WILL REMOVE THE '/'

        
    
        $query = "SELECT * FROM users WHERE user_name = '$username' and token=''";   //ALWAYS FETCHH THE USERNAME NOT THE PASS
        
        $select_user_details = mysqli_query($connection,$query);
        confirmQuery($select_user_details);
        
        
        /*FOR MORE SECURE*/
        if(mysqli_num_rows($select_user_details) > 1){
            header("Location: index.php");    
        }
        
        
        if($row = mysqli_fetch_assoc($select_user_details)){
            $user_id = $row['user_id'];                         //GET THE USER ID FROM DB VERY IMP
            $db_username = $row['user_name'];
            $db_hashed_password = $row['user_password'];
            $db_role = $row['user_role'];                       //FOR ROLE WEN LOGGED IN SAFER SIDE
            
            
        }else{
            $db_password = "";          //so error nikal jayee intialised $db_password with blank
        }
        if(password_verify($password,$db_hashed_password) && $username === $db_username){  //ENTER ONLY WEN PASS N USER MATCH THAT ALSO ===
            
            $_SESSION['user_name'] = $db_username;
            $_SESSION['user_role'] = $db_role;
            $_SESSION['user_id'] = $user_id;
            
            header("Location: ../admin/");
            //echo "<br>LOGGED IN SUCCESSFULY";
            
            
        }else{
            header("Location: ../index.php");
            //echo "<br>WHO ARE YOU???";
        }
    }


/*You have not Logged In,Please Login from here*/
/*THIS IS WRITTEN IN FUNCTIONS.php*/




/* 'anything' or 1=1 # coz # gives comments thats y all the ahead ones are commented */
?>