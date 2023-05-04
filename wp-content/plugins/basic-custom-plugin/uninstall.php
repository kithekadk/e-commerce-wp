<?php 

/**
 * Trigget this file on plugin uninstallation
 * 
 * @package CustomPlugin
 */

//security check
if(!defined('WP_UNINSTALL_PLUGIN')){
    die;
}

// $books = get_posts(['posts_type'=> 'book', 'numberposts'=>-1]);

// foreach($books as $book){
//     wp_delete_post($book->ID, false);
// }

global $wpdb;
$wpdb->query("DELETE FROM p1_posts WHERE post_type='book'");
$wpdb->query("DELETE FROM p1_postmeta WHERE post_id NOT IN (SELECT id from p1_posts)");
$wpdb->query("DELETE FROM p1_term_relationships WHERE object_id NOT IN(SELECT id FROM p1_posts)");