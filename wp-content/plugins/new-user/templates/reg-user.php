<?php

/*
    Template Name: Register User
*/
/**
 * @package Cohort13Plugin
 */
?>

<div class="d-flex flex-column justify-content-center align-items-center">
    <!-- Success message popup -->
    <?php
        echo '<div class="alert alert-success" role="alert" id="successmsg">
                Book Registered Successfully
             </div>';

        echo '<script> document.getElementById("successmsg").style.display = "none"; </script>';

        // var_dump($successmessage);
        // $instance = new BaseController();

        global $successmessage;

        if ($successmessage == true){
            echo '<script> document.getElementById("successmsg").style.display = "flex"; </script>';

            echo    '<script> 
                        setTimeout(function(){
                            document.getElementById("successmsg").style.display ="none";
                        }, 3000);
                    </script>';

            // $successmessage = false;
        }

    ?>

    <!-- Error message popup -->
    <?php
        echo '<div class="alert alert-danger" role="alert" id="errormsg">
                Book not registered, an error occured
             </div>';

        echo '<script> document.getElementById("errormsg").style.display = "none"; </script>';

        global $errormessage;

        if($errormessage == true){
            echo '<script> document.getElementById("errormsg").style.display = "flex"; </script>';

            echo    '<script> 
                        setTimeout(function(){
                            document.getElementById("errormsg").style.display ="none";
                        }, 3000);
                    </script>';
        }
    ?>

    <div class="row justify-content-center">
        <form action="" method="post" style="width:40vw; box-shadow: 3px 3px 3px 3px grey; padding:30px; ">
            <div class="form-group">
                <input type="text" name="username" id="name" class="form-control input-sm mb-3" placeholder="Input Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="useremail" id="email" class="form-control input-sm mb-3" placeholder="Input Email" required>
            </div>
            <div class="form-group">
                <input type="number" name="phone" id="phoneno" class="form-control input-sm mb-3" placeholder="Input Cohort" required>
            </div>
            <div class="form-group">
                <input type="text" name="password" id="password" class="form-control input-sm mb-3" placeholder="Input Group" required>
            </div>

            <div class="row justify-content-center">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <input type="submit" value="Submit Member" name="submitnewUserbtn" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>