<?php
/*
  Plugin Name: pekar
  Plugin URI:
  Description: Custom post type
  Version: 1.0.0
  Author: Salmedin Hamzic
  License: GPLv2
 */

/*
  Copyright (C) 2017 Salmedin Hamzic

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// Register Custom Post Type
function custom_post_type() {
    $labels = array(
        'name' => _x('pekar', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('pekar', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Pekar', 'text_domain'),
        'name_admin_bar' => __('Pekar', 'text_domain'),
        'archives' => __('Item Archives', 'text_domain'),
        'attributes' => __('Item Attributes', 'text_domain'),
        'parent_item_colon' => __('Parent Item:', 'text_domain'),
        'all_items' => __('All Items', 'text_domain'),
        'add_new_item' => __('Add New Item', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'new_item' => __('New Item', 'text_domain'),
        'edit_item' => __('Edit Item', 'text_domain'),
        'update_item' => __('Update Item', 'text_domain'),
        'view_item' => __('View Item', 'text_domain'),
        'view_items' => __('View Items', 'text_domain'),
        'search_items' => __('Search Item', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        'featured_image' => __('Featured Image', 'text_domain'),
        'set_featured_image' => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image' => __('Use as featured image', 'text_domain'),
        'insert_into_item' => __('Insert into item', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
        'items_list' => __('Items list', 'text_domain'),
        'items_list_navigation' => __('Items list navigation', 'text_domain'),
        'filter_items_list' => __('Filter items list', 'text_domain'),
    );
    $args = array(
        'label' => __('Pekar', 'text_domain'),
        'description' => __('Post Type Description', 'text_domain'),
        'labels' => $labels,
        'supports' => array(),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('Pekar', $args);
}

add_action('init', 'custom_post_type', 0);

//Create shortcode form and insert post in custom post type
function form_creation() {
    if (isset($_POST['new_post']) == '1') {
        $post_title = filter_input(INPUT_POST, 'post_title');
        $post_content = filter_input(INPUT_POST, 'post_content');

        $new_post = array(
            'ID' => '',
            'post_author' => $user->ID,
            'post_content' => $post_content,
            'post_title' => $post_title,
            'post_type' => 'pekar',
            'post_status' => 'publish'
        );
        $post_id = wp_insert_post($new_post);
    }
    ob_start(); //This function will turn output buffering on. While output buffering is active no output is sent from the script (other than headers), instead the output is stored in an internal buffer.
    ?>      
    <form method="post" action=""> 
        <input type="text" name="post_title" size="45" id="input-title"/>
        <textarea rows="5" name="post_content" cols="66" id="text-desc"></textarea> 
        <input type="hidden" name="new_post" value="1"/> 
        <input class="subput round" type="submit" name="submit" value="Post"/>
    </form>
    <?php
    return ob_get_clean(); //Clean (erase) the output buffer and turn off output buffering
}

add_shortcode('form', 'form_creation');
