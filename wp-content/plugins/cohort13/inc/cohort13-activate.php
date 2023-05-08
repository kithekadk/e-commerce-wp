<?php
/**
 * @package Cohort13Plugin
 */

 class Cohort13Activate{
    static function activate(){
        // $instanceRegisterMembers = new RegisterMembers();

        // $instanceRegisterMembers->
        flush_rewrite_rules();
    }
 }