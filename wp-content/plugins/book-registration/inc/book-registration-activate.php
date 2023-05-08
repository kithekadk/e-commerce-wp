<?php
/**
 * @package BookRegistration
 */

class BookRegActivate{
    static function activatePlugin(){
        // echo 'Invoked';
        BookReg::create_table_to_db();
        flush_rewrite_rules();
    }
}