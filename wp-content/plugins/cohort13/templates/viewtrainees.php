<h2>View Marks</h2>

<?php

    global $wpdb;
    $table_name = $wpdb->prefix.'marks';

    $trainees = $wpdb->get_results("SELECT * FROM $table_name");

    
?>
<!-- <pre> -->
<?php //var_dump($trainees); ?>
<!-- </pre> -->

<table class="table table-striped" border>

    <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Attendance Marks</th>
            <th>Project Marks</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php 
        foreach($trainees as $key => $trainee){
    ?>
        <tr>
            <td><?php echo $key+1 ?></td>
            <td><?php echo $trainee->name ?></td>
            <td><?php echo $trainee->email ?></td>
            <td><?php echo $trainee->attendance ?></td>
            <td><?php echo $trainee->project ?></td>
            <td>
                <form action="" method="post">
                    <a href="<?php echo esc_url(add_query_arg('user_email', $trainee->email, 'admin.php?page=update_trainee')) ?>">UPDATE</a>
                    <input type="hidden" name="traineeEmail" value="<?php echo $trainee->email; ?>">
                    <input type="submit" name="deleteTrainee" value="DELETE TRAINEE">
                </form>
            </td>

        </tr>

    <?php
        }
    ?>
</table>