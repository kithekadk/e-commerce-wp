<?php
/**
 * @package CreateNewUser
 */

/*
    Plugin Name: Create New User
    Plugin URI: http://github.com/kithekadk
    Description: A plugin implimenting the wp-users logic flow
    Version: 1.0.0
    Author: Daniel Kitheka
    Author URI: http://github.com/kithekadk
    Licence: GPLv2 or later
    Text Domain: sreate-new-user
*/


defined('ABSPATH') or die('Someone bypassed the security check');

class RegisterUser{

    function __construct(){
        // $this->new_user_table_creation();
        $this->create_new_user();
        add_action('init', [$this, 'create_new_user']);
    }
    
    function Activate(){
        flush_rewrite_rules();
    }
    function Deactivate(){
        flush_rewrite_rules();
    }

    function new_user_table_creation(){
        global $wpdb;

        $table_name = $wpdb->prefix.'users_new';

        $new_user_tbl = "CREATE TABLE IF NOT EXISTS ".$table_name."(
            username text NOT NULL,
            useremail text NOT NULL,
            phone int NOT NULL,
            password text NOT NULL
        );";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($new_user_tbl);
    }

    function create_new_user(){
        global $wpdb;
        $table_name = $wpdb->prefix.'users_new';

        if (isset($_POST['submitnewUserbtn'])){
            $pwd = $_POST['password'];
            $hashed_pwd = wp_hash_password($pwd);
            $user_data =[
                'username' => $_POST['username'],
                'useremail' => $_POST['useremail'],
                'phone' => $_POST['phone'],
                'password' => $hashed_pwd
            ];

            $result = $wpdb->insert($table_name, $user_data);

            if($result == true){
                // $successmessage = true;
                echo "<script> alert('Book Registered successfully'); </script>";
            }else{
                // $errormessage = true;
                echo "<script> alert('Unable to Register'); </script>";
            }
        }
    }
}

if (class_exists('RegisterUser')){
    $ClassInstance = new RegisterUser();
}

// $ClassInstance->new_user_table_creation();