<?php
/**
 * @package Cohort13Plugin
 */
namespace Inc\Base;
class Deactivate{
    static function deactivate(){
        flush_rewrite_rules();
    }
}