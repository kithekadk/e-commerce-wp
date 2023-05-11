<div class="d-flex justify-content-center align-items-center w-100 h-100 overall">

<?php
    global $successmessage;
    $successmessage;

    global $errormessage;
?>

<div class="d-flex flex-column justify-content-center align-items-center">
    <!-- Success message popup -->
    <?php
        echo '<div class="alert alert-success" role="alert" id="successmsg">
                Book Registered Successfully
             </div>';

        echo '<script> document.getElementById("successmsg").style.display = "none"; </script>';

        // var_dump($successmessage);

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
        <form action="" method="post" style="margin-top:20vh; width:40vw; box-shadow: 3px 3px 3px 3px grey; padding:30px; ">
            <div class="form-group">
                <input type="text" name="title" id="title" class="form-control input-sm mb-3" placeholder="Input Book Title" required>
            </div>
            <div class="form-group">
                <input type="text" name="author" id="author" class="form-control input-sm mb-3" placeholder="Input Book Author Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="publisher" id="publisher" class="form-control input-sm mb-3" placeholder="Input Book Publisher" required>
            </div>

            <div class="row justify-content-center">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <input type="submit" value="Register Book" name="submitbtn" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
</div>