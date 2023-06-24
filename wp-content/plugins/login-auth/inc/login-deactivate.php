<?php
/**
 * @package LoginAuth
 */

class LoginDeactivate{
    static function deactivatePlugin(){
        flush_rewrite_rules();
    }
}