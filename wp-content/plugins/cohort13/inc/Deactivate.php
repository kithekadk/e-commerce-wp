<?php
/**
 * @package Cohort13Plugin
 */
namespace Inc;
class Deactivate{
    static function deactivate(){
        flush_rewrite_rules();
    }
}