<?php
/**
* Plugin Name: Custom Plan Types
* Plugin URI:
* Description: Custom plan type for posts.
* Version: 1.0
* Author: Brent Hand
*
**/

function register_cpt_translation_type() {
  $labels = array(
    'name' => _x( 'Translation Types', 'translation_type' ),
    'singular_name' => _x('Translation Type', 'translation_type'),
    'add_new' => _x('Add New', 'translation_type'),
    'add_new_item' => _x( 'Add New Translation', ''),
    'edit_item' => _x( 'Edit Translation', 'translation_type'),
    'new_item' => _x( 'New Translation', 'translation_type'),
    'view_items' => _x('View Translation', 'plan_tpye'),
    'search_items' => _x('Search Translations', 'translation_types'),
    'not_found' => _x('No Translations Types Found', 'translation_types'),
    'not_found_in_trash' => _x('No Translation Types Found In Trash', 'translation_types'),
    'parent_item_colon' => _x('Parent Translation', 'translation_type'),
    'menu_name' => _x('Translations', 'translation_type'),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'description' => 'Translation',
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
    'taxonomies' => array('translation'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-translation',
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_serach' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',
  );

  register_post_type('translation_type', $args);
}

add_action('init', 'register_cpt_translation_type');

function translation_taxonomy() {
  register_taxonomy(
    'translation',
    'translation_type',
    array(
      'hierarchical' => true,
      'label' => 'Plans',
      'query_var' => true,
      'rewrite' => array(
        'slug' => 'plan',
        'with_front' => false,
      )
    )
  );
}

add_action('init', 'plans_taxonomy');
