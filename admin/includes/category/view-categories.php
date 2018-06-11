                        <!--AVAILABLE & INSERTED CATEGORIES-->
                        <div class="col-xs-12">
                           
                           
                           
                        <!-- MODAL -->
                        <form class="modal fade" id="updateCreditCard">

                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
        
                                   
                                    <div class="modal-header">
                                        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>Delete Category</h4>
                                    </div>     
                           
                                   
                                    <div class="modal-body">
                                       <h2>ARE YOU SURE YOU WANT TO DELETE</h2> 
                                    </div>   
                           
                                  
                                   
                                   <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                   </div>
                           
                                </div>
                                
                            </div>
                                   
                        </form>    
                           
                       
                           
                           
                           
                           
                           
                           
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                                <tbody>
            <?php   
                    $query = "SELECT * FROM categories";  
                    $select_all_categories_query = mysqli_query($connection,$query);        //it will keep alll the rows
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){         
                        echo "<tr>";
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];         //this is used fot getting the title from db
                        echo "<td>$cat_id</td>";
                        echo "<td>$cat_title</td>";
                        echo "<td><a class='btn btn-danger del-tooltip' data-toggle='tooltip' title='Delete' href = 'categories.php?delete=$cat_id'><span class = 'fa fa-times'></a></td>";
                        echo "<td><a class='btn btn-primary edit-tooltip' data-toggle='tooltip' title='Edit' data-target='#updateCreditCard' data-toggle='modal' href = 'categories.php?edit=$cat_id'><span class = 'fa fa-pencil'></a></td>";
                        echo"</tr>";
                    }

                    if(isset($_GET['delete'])){
                        $delete_id = $_GET['delete'];
                        $query = "DELETE FROM categories WHERE cat_id = $delete_id";
                        $delete_query = mysqli_query($connection,$query);
                        header("Location: categories.php");

                    }                
            ?>

                                </tbody>
                            </table>
                        </div>
                        
                       
                      
<script>
        $('#updateCreditCard').on('hide.bs.modal', function(event){
            window.alert("hiding");
        });
</script>