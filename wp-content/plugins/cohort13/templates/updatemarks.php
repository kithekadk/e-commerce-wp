<h1>Update Trainee Marks</h1>
<?php

$user_email= $_GET['user_email'];
global $wpdb;

$table_name = $wpdb->prefix.'marks';


$user = $wpdb->get_row("SELECT * FROM $table_name WHERE email='$user_email'");


?>

<!-- <pre> -->
    <?php //var_dump($user->email); ?>
<!-- </pre> -->


<form action="" method="post">

    <div class="form-group">
        <input type="text" name="nameUpt" id="nameUpt" value="<?php echo $user->name ?>" class="form-control input-sm mb-3" placeholder="Input Trainee Name" required>
    </div>
    <div class="form-group">
        <input type="email" name="emailUpt" id="emailUpt" value="<?php echo $user->email ?>" class="form-control input-sm mb-3" placeholder="Input Trainee Email" required>
    </div>
    <div class="form-group">
        <input type="text" name="attendanceUpt" id="attendanceUpt" value="<?php echo $user->attendance ?>" class="form-control input-sm mb-3" placeholder="Attendance out of 10" required>
    </div>
    <div class="form-group">
        <input type="text" name="projectUpt" id="projectUpt" class="form-control input-sm mb-3" value="<?php echo $user->project ?>" placeholder="Project out of 10" required>
    </div>

    <div class="row justify-content-center">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <input type="submit" value="Update Trainee Details" name="updatetrainee" class="btn btn-primary">
        </div>
    </div>

</form>