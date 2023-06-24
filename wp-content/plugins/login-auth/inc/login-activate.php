<?php
/**
 * @package LoginAuth
 */

class LoginActivate{
    static function activatePlugin(){
        flush_rewrite_rules();
    }
}