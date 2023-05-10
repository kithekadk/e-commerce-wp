<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc;
use Cohort13;
class RegisterBook{
    static function registerBook(){
        $cohort13Instance = new Cohort13();

        $cohort13Instance->registerPage();
    }
}