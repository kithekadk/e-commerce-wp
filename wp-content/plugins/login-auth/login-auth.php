<?php 
/**
 * @package LoginAuth
 */

 /*
    Plugin Name: Login Authentication
    Plugin URI: http://..............
    Description: This is a plugin to login
    Version: 1.0.0
    Author: Kithekadk
    Author URI: http://github.com/kithekadk
    Licence: GPLv2 or later
    Text Domain: login-auth
 */

//  Security Check
defined('ABSPATH') or die('Hey you hacker, got you!');

class Login{
    function __construct(){
        $this->login();
    }

    function activateExternally(){
        require_once plugin_dir_path(__FILE__). 'inc/login-activate.php';
        LoginActivate::activatePlugin();
    }

    function deactivateExternally(){
        require_once plugin_dir_path(__FILE__). 'inc/login-deactivate.php';
        LoginDeactivate::deactivatePlugin();
    }

    function login(){
        if(isset($_POST['submitlogin'])){

            $args = [
                'method'=>'POST',
                'body'=>[
                    'username'=>$_POST['username'],
                    'password'=>$_POST['password']
                ]
                ];

            $result = wp_remote_post('http://localhost/customtheme/wp-json/jwt-auth/v1/token', $args);

            echo '<pre>';
                $token =(json_decode(wp_remote_retrieve_body($result)));
                // var_dump($token->token);
                setcookie('token', $token->token, time() + (86400 * 30), '/', 'localhost');
            echo '</pre>';
        }
    }
}

if(class_exists('Login')){
    $login = new Login();
}

//Activate Plugin
// register_activation_hook (__FILE__, [$bookRegInstance, 'activateExternally']);
$login->activateExternally();

//Deactivate Plugin
// register_deactivation_hook (__FILE__, [$bookRegInstance, 'deactivateExternally']);
$login->deactivateExternally();