<?php
/**
 * @package Cohort13Plugin
 */

 namespace Inc;
 class Activate{
    static function activate(){
        RegisterBook::registerBook();
        flush_rewrite_rules();
    }
 }