<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Pages;

class ShortCode{
    public function register(){
        add_shortcode('cohort13', [$this,'ContactUsForm']);
    }

    public function ContactUsForm($atts){
        $defaults = [
            'title'=> 'Edit This To Fit You Title Name',
            'company_name'=> 'Enter Company Name Here'
        ];

        $atts = shortcode_atts(
            $defaults, $atts, 'cohort13'
        );

        $html = '';
        $html = '<div class="w-100 d-flex justify-content-center">';
        $html .= '<form class="w-25">';
        $html .= '<h2>'.$atts['title'].'</h2>';
        $html .= '<h3>' .$atts['company_name']. '</h3>';
        $html .= '<input type="text" class="form-control " name="firstname" placeholder="Input your first name here">';
        $html .= '<input type="text" class="form-control " name="lastname" placeholder="Input your last name here">';
        $html .= '<input type="email" class="form-control " name="email" placeholder="Input your email here">';
        $html .= '<input type="number" class="form-control " name="phone_no" placeholder="Input your Phone number here">';
        $html .= '<input type="text" class="form-control " name="subject" placeholder="Enter the subject here">';
        $html .= '<textarea cols="60" row="3" placeholder="Enter your message"></textarea>';
        $html .= '<br/>';
        $html .= '<input type="submit" class="btn btn-primary " value="Submit Request">';
        $html .= '</form>';
        $html .= '</div>';


        return $html;
    }
}