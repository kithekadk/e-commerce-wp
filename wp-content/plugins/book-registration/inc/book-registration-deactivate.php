<?php
/**
 * @package BookRegistration
 */

class BookRegDeactivate{
    static function deactivatePlugin(){
        flush_rewrite_rules();
    }
}