<?php

/*
    Template Name: Register User
*/

?>

<div>
    <div>
        <form action="" method="post" style="box-shadow: 2px 2px 2px 2px grey; padding:25px; width:30vw;">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Input Name" style="padding:5px; width:27vw; margin-bottom:5px;">
            </div>
            <div>
                <input type="email" name="useremail" id="useremail" placeholder="Input Email" style="padding:5px; width:27vw; margin-bottom:5px;">
            </div>
            <div>
                <input type="number" name="phoneno" id="phoneno" placeholder="Input phone number" style="padding:5px; width:27vw; margin-bottom:5px;">
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="*******" style="padding:5px; width:27vw; margin-bottom:5px;">
            </div>

            <div>
                <input type="submit" value="Create User" name="btnSubmitUser" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>