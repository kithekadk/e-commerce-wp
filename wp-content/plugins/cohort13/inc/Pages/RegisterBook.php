<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Pages;

class RegisterBook{
    public function register(){
        $this->create_table_to_db();
        $this->add_book_to_db();
    }

    function create_table_to_db(){
        global $wpdb;

        $table_name = $wpdb->prefix.'books';

        $book_details = "CREATE TABLE IF NOT EXISTS ".$table_name."(
            title text NOT NULL,
            author text NOT NULL,
            publisher text NOT NULL
        );";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($book_details);
    }

    function add_book_to_db(){
        if(isset($_POST['submitbtn'])){
            $data =[
                'title'=> $_POST['title'],
                'author'=> $_POST['author'],
                'publisher'=> $_POST['publisher']
            ];

            global $wpdb;
            global $successmessage;
            global $errormessage;

            $successmessage = false;
            $errormessage = false;

            $table_name = $wpdb->prefix.'books';

            $result = $wpdb->insert($table_name, $data, $format=NULL);

            if($result == true){
                $successmessage = true;
                echo "<script> alert('Book Registered successfully'); </script>";
            }else{
                $errormessage = true;
                echo "<script> alert('Unable to Register'); </script>";
            }
        }
    }
}