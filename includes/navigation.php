<?php
    include_once("db.php");
?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">JV Blog!</a>
                
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

    <?php
            $query = "SELECT * FROM categories";  
            $select_all_categories_query = mysqli_query($connection,$query);        //it will keep alll the rows
            while($row = mysqli_fetch_assoc($select_all_categories_query)){         
                //row is now 1 dimensional n assoc array n we use assoc[] usiing key ie cat_id n cat_title
                //by def table points to -1
                //A good pratice to keep the variables name same in db n php Both.

                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];         //this is used fot getting the title from db
                echo "<li>
                        <a href='categories.php?c_id=$cat_id'>$cat_title</a>
                    </li>";
                //this will automatically fetch all the details from the db n display here
                //this is semi Dynamic
        }               
    ?>

                <li>
                    <a href="admin/index.php">ADMIN</a>
                </li>

                <ul class="nav navbar-nav navbar-right">
                    <li><a class="a-right" href="register.php" >Register</a></li>
                </ul>
                

                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
