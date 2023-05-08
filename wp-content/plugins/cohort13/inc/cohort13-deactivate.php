<?php
/**
 * @package Cohort13Plugin
 */

class Cohort13Deactivate{
    static function deactivate(){
        flush_rewrite_rules();
    }
}