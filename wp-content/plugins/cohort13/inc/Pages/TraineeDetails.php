<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Pages;

class TraineeDetails{
    public function register(){
        $this->createMarksEntryTable();
        $this->InsertMarks();
        $this->UpdateTrainee();
        $this->DeleteTrainee();
    }

    static function createMarksEntryTable(){
        global $wpdb;

        $table_name = $wpdb->prefix.'marks';

        $marks_details = "CREATE TABLE IF NOT EXISTS ".$table_name. "(
            name text NOT NULL,
            email text NOT NULL,
            attendance int NOT NULL,
            project int NOT NULL
        );";

        require_once(ABSPATH. 'wp-admin/includes/upgrade.php');
        dbDelta($marks_details);
    }

    function InsertMarks(){
        if(isset($_POST['regtrainee'])){
            $trainee_details=[
                'name'=>$_POST['name'],
                'email'=>$_POST['email'],
                'attendance'=>$_POST['attendance'],
                'project'=>$_POST['project']
            ];

            global $wpdb;

            $table_name = $wpdb->prefix.'marks';

            $result = $wpdb->insert($table_name, $trainee_details);

            if($result){
                echo "<script> alert('Marks submitted successfully'); </script>";
            }else{
                echo "<script> alert('Marks submission failed'); </script>";
            }
        }
    }

    function UpdateTrainee(){
        if (isset($_POST['updatetrainee'])){
            global $wpdb;

            $newdetails =[
                'name'=>$_POST['nameUpt'],
                'email'=>$_POST['emailUpt'],
                'attendance'=>$_POST['attendanceUpt'],
                'project'=>$_POST['projectUpt']
            ];

            $table_name = $wpdb->prefix.'marks';

            $user_email = $_GET['user_email'];

            $condition = [
                'email'=>$user_email
            ];

            $result = $wpdb->update($table_name, $newdetails, $condition);

            if($result){
                echo "<script> alert('Marks update successfully'); </script>";
            }else{
                echo "<script> alert('Update failed'); </script>";
            }
        }
    }

    function DeleteTrainee(){
        if (isset($_POST['deleteTrainee'])){
            global $wpdb;

            $table_name = $wpdb->prefix.'marks';

            $trainee_email= $_POST['traineeEmail'];

            $result = $wpdb->delete($table_name, ['email'=>$trainee_email]);

            if($result){
                echo "<script> alert('Trainee deleted successfully'); </script>";
            }else{
                echo "<script> alert('Deletion failed'); </script>";
            }
        }
    }
}