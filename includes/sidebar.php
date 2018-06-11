<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">



    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>

        <form action="search.php" method="post">
            <div class="input-group">

                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                            <button name ="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>

            </div>
            <!-- /.input-group -->
        </form>
    </div>


    <!-- LOGIN  CODE-->
    <div class="well">
        <h4>Login</h4>

        <form action="includes/login.php" method="post">        <!--*************IMP LINE FORM ACTION***********-->
            <div class="form-group">
                <input name="user_name" type="text" class="form-control" placeholder="Enter Username">
            </div> 
               
                  
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
            </div>
             
             
            <div class="form-group">
              <button name="login" class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-user"></span>
               Login
               </button>
            </div>
               
               <!--UNIQID MEANS ONLY THE REGISTERED USER CAN ACCESS THIS LINK-->
               <div class="form-group"><a href="forgot.php?forgot=<?php echo uniqid(true);?>">Forgot Password</a></div>
                

            <!-- /.input-group -->
        </form>
    </div>
    <!--END OF LOGIN -->
   
   
   
   
    <?php   
        $query = "SELECT * FROM categories";  
        $select_all_categories_query = mysqli_query($connection,$query);        //it will keep alll the rows
    ?>


        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled">
                        <?php   
                            while($row = mysqli_fetch_assoc($select_all_categories_query)){         //row is now 1 dimensional n       assoc array n we use assoc[] usiing key ie cat_id n cat_title
                                //by def table points to -1
                                //A good pratice to keep the variables name same in db n php Both.

                                $cat_title = $row['cat_title'];         //this is used fot getting the title from db
                                $cat_id = $row['cat_id'];
                                echo "<li>
                                        <a href='categories.php?c_id=$cat_id'>$cat_title</a>
                                    </li>";
                            }               
                        ?>
                    </ul>
                </div>
                
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->
        <div class="well">
            <h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
        </div>

</div>
