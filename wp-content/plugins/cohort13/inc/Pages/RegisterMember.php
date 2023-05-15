<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;

class RegisterMember{
    public function register(){
        $this->create_table_to_db();
        $this->add_member_to_db();
    }

    function create_table_to_db(){
        global $wpdb;

        $table_name = $wpdb->prefix.'members';

        $member_details = "CREATE TABLE IF NOT EXISTS ".$table_name."(
            name text NOT NULL,
            email text NOT NULL,
            cohort text NOT NULL,
            groupname text NOT NULL
        );";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($member_details);
    }

    function add_member_to_db(){
        if(isset($_POST['submitMemberbtn'])){
            $data =[
                'name'=> $_POST['name'],
                'email'=> $_POST['email'],
                'cohort'=> $_POST['cohort'],
                'groupname'=> $_POST['group']
            ];

            global $wpdb;

            global $successmessage;
            global $errormessage;

            $successmessage = false;
            $errormessage = false;

            $table_name = $wpdb->prefix.'members';

            $result = $wpdb->insert($table_name, $data, $format=NULL);

            if($result == true){
                $successmessage = true;
                // echo "<script> alert('Book Registered successfully'); </script>";
            }else{
                $errormessage = true;
                // echo "<script> alert('Unable to Register'); </script>";
            }
        }
    }
}