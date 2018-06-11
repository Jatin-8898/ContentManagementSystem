<!--ADD CATEGORY FORM-->
    <div class="col-xs-6">
      <h3>Add Category</h3>


        <?php
                addCategory();      //call to a func    
        ?>
        <form action="" method="post">
            
            <div class="form-group">
                <label for="cat_title">Category Title</label>
                <input id="cat_title" class="form-control" type="text" name="cat_title">
            </div>
            
               
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
            </div>
            
            
        </form>
    </div>

    <!--END OF ADD CATEGORY FORM-->