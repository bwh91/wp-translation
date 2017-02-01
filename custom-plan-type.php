<?php
/**
* Plugin Name: Custom Plan Types
* Plugin URI:
* Description: Custom plan type for posts.
* Version: 1.0
* Author: Brent Hand
*
**/

function register_cpt_plan_type() {
  $labels = array(
    'name' => _x( 'Plan Types', 'plan_type' ),
    'singular_name' => _x('Plan Type', 'plan_type'),
    'add_new' => _x('Add New', 'plan_type'),
    'add_new_item' => _x( 'Add New Plan Type', 'plan_type'),
    'edit_item' => _x( 'Edit Plan Type', 'plan_type'),
    'new_item' => _x( 'New Plan Type', 'plan_type'),
    'view_items' => _x('View Plan Type', 'plan_tpye'),
    'search_items' => _x('Search Plan Types', 'plan_types'),
    'not_found' => _x('No Plan Types Found', 'plan_types'),
    'not_found_in_trash' => _x('No Plan Types Found In Trash', 'plan_types'),
    'parent_item_colon' => _x('Parent Plan Type', 'plan_type'),
    'menu_name' => _x('Plan Types', 'plan_type'),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'description' => 'Plan Types',
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
    'taxonomies' => array('plans'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-building',
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_serach' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post',
  );

  register_post_type('plan_type', $args);
}

add_action('init', 'register_cpt_plan_type');

function plans_taxonomy() {
  register_taxonomy(
    'plans',
    'plan_type',
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
