 <!--ADD of EDIT CATEGORY-->
    <div class="col-xs-6">

       <?php

        editCategory();             //call to a func
        $edit_cat_title = fetchCategoryForEdit();      //call to a func

        ?>

        <?php
            if(isset($edit_cat_title)){     //this is will be visible wen edit btn is pressed
        ?>        
        <h3>Edit Category</h3>                    <!--this title will also come on page-->
            <form action="" method="post">
                <div class="form-group">
                    <label for="cat_title">Category Title</label>
                    <input id="cat_title" class="form-control" type="text" name="cat_title" value="<?php 
                        echo $edit_cat_title;
                    ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="edit_submit" value="Edit Category">
                </div>
            </form>
        <?php
                }// end of if
        ?>
    </div>

    <!--END OF EDIT CATEGORY FORM-->