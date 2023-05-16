<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Api;

class SettingsApi{

    public $admin_pages = array();

    public $admin_subpages = array();

    public $settings = array();

    public $sections = array();

    public $fields = array();
    public function register(){

        if(!empty($this->admin_pages)){
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }

        if(!empty($this->settings)){
            add_action('admin_init', [$this, 'registerCustomFields']);
        }

    }

    public function AddPages(array $pages){
        $this->admin_pages = $pages;

        return $this;
    }

    public function HasSubPage(string $title = null){
        if(empty($this->admin_pages)){
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $firstsubpage = [
            [
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => $admin_page['page_title'],
                'menu_title'=> ($title) ? $title : $admin_page['menu_title'],
                'capability' => $admin_page['capability'],
                'menu_slug' => $admin_page['menu_slug'],
                // 'callback' => function(){
                //     echo '<h1> Cohort 13 Books Menu </h1>';
                // }
                'callback'=> $admin_page['callback']

            ]
        ];

        $this->admin_subpages = $firstsubpage;

        return $this;
    }

    public function addSubPages(array $subpages){
        $this->admin_subpages = array_merge($this->admin_subpages, $subpages);

        return $this;
    }
    public function addAdminMenu(){
        foreach($this->admin_pages as $page){
            add_menu_page(
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
                $page['icon_url'],
                $page['position']
            );
        }

        foreach($this->admin_subpages as $subpage){
            add_submenu_page(
                $subpage['parent_slug'],
                $subpage['page_title'],
                $subpage['menu_title'],
                $subpage['capability'],
                $subpage['menu_slug'],
                $subpage['callback']
            );
        }
    }

    public function setSettings(array $settings){
        $this->settings = $settings;

        return $this;
    }

    public function setSections(array $sections){
        $this->sections = $sections;

        return $this;
    }

    public function setFields(array $fields){
        $this->fields = $fields;

        return $this;
    }

    public function registerCustomFields(){

        foreach ($this->settings as $setting){
            register_setting(
                $setting['option_group'],
                $setting["option_name"],
                (isset($setting["callback"]) ? $setting["callback"]: '')
            );
        }

        foreach($this->sections as $section){
            add_settings_section(
                $section["id"],
                $section["title"],
                (isset($section["callback"]) ? $section["callback"] : ''),
                $section["page"]
            );
        }


        foreach ($this->fields as $field){
            add_settings_field(
                $field["id"],
                $field["title"],
                (isset($field["callback"]) ? $field["callback"] : ''),
                $field["page"],
                $field["section"],
                (isset($field["args"]) ? $field["args"] : '')
            );
        }
    }
}