<html>

    <head>
        <title>LOGIN PAGE</title>
    </head>

<body>   
   <!--MAIN DIV-->
   <div id="container">
       
       
       <div id="center-div">
           <form action="" method="post" enctype="multipart/form-data">   
        <!--encryption type means data ko chhod ke kuch rahega aur files ko divide kkrat h parts mei especially for image-->
   
          
          <div class="form-group">
                <label for="user_name">Username</label>
                <input name="user_name" id="user_name" type="text" class="form-control" placeholder="Enter Username">
            </div> 
               
                  
            <div class="form-group">
                <label for="user_password">Password</label>
                <input name="password" id="user_password" type="password" class="form-control" placeholder="Enter Password">
            </div>
             
             
              <div class="form-group">
                  <button name="login" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-user"></span> Login</button>
              </div>
          
           </form>
       </div>
       
       
   </div>
   <!--END OF MAIN DIV-->
</body>
 </html>