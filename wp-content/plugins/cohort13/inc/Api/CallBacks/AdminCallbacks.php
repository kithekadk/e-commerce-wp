<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Api\CallBacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController{

    public function viewMembers(){
        return require_once $this->plugin_path.'templates/viewMembers.php'; 
    }

    public function registerMembers(){
        return require_once $this->plugin_path.'templates/registerMembers.php';
    }

    public function updateMembers(){
        return require_once $this->plugin_path.'templates/updateMembers.php';
    }

    // CUSTOM FIELD METHODS
    public function c13OptionsGroup($input){
        return $input;
    }

    public function c13AdminIndex(){
        // echo 'Check out this section';
    }

    public function c13InputText(){
        $value = esc_attr(get_option('first_name'));

        echo '<input type="text" class="regular-text" name="first_name" value="'.$value.'" placeholder = "Input your first name">';
    }

    public function c13SecondName(){
        $value = esc_attr(get_option('second_name'));

        echo '<input type="text" class="regular-text" name="second_name" value="'.$value.'" placeholder = "Input your first name">';
    }
    public function c13CohortName(){
        $value = esc_attr(get_option('cohort_name'));

        echo '<select name="cohort_name" value="'.$value.'">
                <option value="WordPress">WordPress</option>
                <option value="Angular">Angular</option>
             </select>';
    }

}