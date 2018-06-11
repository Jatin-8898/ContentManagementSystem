//window.alert("HELLO");



/*FOR SELECT ALL IN THE VIEW ALL POSTS SECTION*/
$('#selectAllBoxes').click(function(event){ //select the main checkbox
   
    if(this.checked){                       //make all selected
        $('.checkBoxes').each(function(){
            this.checked = true;  
            
        });
    }else{
        $('.checkBoxes').each(function(){   //make all unselected
            this.checked = false;    
        });
    }
});

$('#selectAllBoxes').click(function(event){
    if(this.checked){
        $('.checkBoxes').each(function(){
            this.checked = true;
        });
    }else{
        $('.checkBoxes').each(function(){
            this.checked = false;
        });
    }
});





/*FOR THE EDIT AND DELETE TOOLTIP*/
$(document).ready(function(){
    $('.del-tooltip').tooltip(); 
});

$(document).ready(function(){
    $('.edit-tooltip').tooltip(); 
});







/*VALIDATION FOR ADD POST FORM*/
$(document).ready(function() {              //id of the form
    $('#addPost').bootstrapValidator({              //options of validator
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',            //icons
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        title: {
            validators: {
                notEmpty: {
                    message: 'The title is required and cannot be empty'
                },
                stringLength: {
                    max: 100,
                    message: 'The title must be less than 100 characters long'
                }
            }
        },
        post_category_id: {
            validators: {
                    notEmpty: {
                    message: 'Please select some category'
                }
            }
        },
        status: {
            validators: {
                    notEmpty: {
                    message: 'Please select post status'
                }
            }
        },
        image: {
            validators: {
                notEmpty: {
                    message: 'Image cannot be empty'
                }
            }
        },
        post_tags: {
            validators: {
                notEmpty: {
                        message: 'Please insert some tag related to the post'
                    }
            }
        },
        post_content: {
            validators: {
                notEmpty: {
                    message: 'Post content cannot be empty'
                },
                stringLength: {
                    min: 10,
                    max: 200,
                    message: 'Post content cannot be greater than 200 characters'
                }
            }
        },
        }
    });
});





/*AJAX CALL, WE R USING JS GET METHOD N RUNS THE FILE IN BACKGROUND AND UPDATES ONLY THAT PARTS OF DATA    */ 
function loadUsersOnline(){
    $.get("functions.php?onlineusers=result",function(data){//whateva coming from 1st file ne echo kiya woh 2nd ke input ei jaayega data ban ke
        $('.usersonline').text(data);
        
    });
}


/*TO CALL IT REPEADETLY AFTER 500 MILLISECONDS*/
setInterval(function(){
    
    loadUsersOnline();
    
},500);









/*VALIDATION FOR ADD USER FORM*/
$(document).ready(function() {              //id of the form
    $('#addUser').bootstrapValidator({              //options of validator
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',            //icons
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        user_firstname: {                               /*WE R APPLYING REGEX FIRSTNAME & LASTNAME SHOULDNT BE SAME AND PASS ALSO*/
            validators: {
                notEmpty: {
                    message: 'The firstname is required and cannot be empty'
                },
                stringLength: {
                    min: 3,
                    max: 20,
                    message: 'The firstname must be less minimun 3 and less than 20 characters long'
                },
                regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'The username can only consist of alphabets and number'
                },
                different: {
                        field: 'user_password',
                        message: 'The username and password cannot be the same as each other'
                },
                
            }
        },
        user_lastname: {
            validators: {
                    notEmpty: {
                    message: 'The lastname is required and cannot be empty'
                },
                stringLength: {
                    max: 20,
                    message: 'The firstname must be less than 20 characters long'
                },
                regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'The username can only consist of alphabets and number'
                },
                different: {
                        field: 'user_firstname',
                        message: 'The First name and Last Name should not be the same as each other'
                },
                different: {
                        field: 'user_password',
                        message: 'The username and password cannot be the same as each other'
                }

            }
        },
        user_email: {
            validators: {
                    notEmpty: {
                        message: 'The email address is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The email address is not a valid email address'
                    }
                }
        },
        user_role: {
            validators: {
                    notEmpty: {
                    message: 'Please select the Role'
                }
            }
        },
        user_name: {
            validators: {
                notEmpty: {
                    message: 'UserName cannot be empty'
                },
                regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'The username can only consist of alphabets and number'
                }
                
            }
        },
        user_password: {
            validators: {
                notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                    different: {
                        field: 'user_name',
                        message: 'The password cannot be the same as UserName'
                    },
                    stringLength: {
                        min: 5,
                        message: 'The password must have at least 5 characters just for testing'
                    }
            }
        },
        user_password_confirm: {
            validators: {
                notEmpty: {
                    message: 'Confirm Password cannot be empty'
                }
            }
        },
        user_image: {
            validators: {
                file: {
                        extension: 'jpeg,jpg,png,jfif',
                        type: 'image/jpeg,image/png',
                        maxSize: 2048 * 1024,
                        message: 'The selected file is not valid'
                    },
                notEmpty: {
                    message: 'User Image cannot be empty'
                }
            }
        },    
            
        } 
    });
});




