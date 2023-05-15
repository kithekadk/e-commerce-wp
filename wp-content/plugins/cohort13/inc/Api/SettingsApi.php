<?php
/**
 * @package Cohort13Plugin
 */

namespace Inc\Api;

class SettingsApi{

    public $admin_pages = array();

    public $admin_subpages = array();
    public function register(){

        if(!empty($this->admin_pages)){
            add_action('admin_menu', [$this, 'addAdminMenu']);
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
}