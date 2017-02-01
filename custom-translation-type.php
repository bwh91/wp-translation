<?php
/**
* Plugin Name: Translations
* Plugin URI:
* Description: Custom translation types.
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
    'view_items' => _x('View Translation', 'translation_tpye'),
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
    'taxonomies' => array('translation', 'category', 'acf_spanish'),
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
    'show_in_rest' => true,
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
      'label' => 'Translations',
      'query_var' => true,
      'rewrite' => array(
        'slug' => 'translation',
        'with_front' => false,
      'acf-spanish-2' => true,
      )
    )
  );
}

add_action('init', 'translation_taxonomy');

function my_custom_post_type_rest_support() {
  global $wp_post_types;
 
  //be sure to set this to the name of your post type!
  $post_type_name = 'translation_type';
  if( isset( $wp_post_types[ $post_type_name ] ) ) {
    $wp_post_types[$post_type_name]->show_in_rest = true;
  }
}

add_action( 'init', 'my_custom_post_type_rest_support', 25 );

function my_custom_taxonomy_rest_support() {
  global $wp_taxonomies;
 
  //be sure to set this to the name of your taxonomy!
  $taxonomy_name = 'acf_spanish-2';
 
  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
 
    // Optionally customize the rest_base or controller class
    $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
    $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  }
}

add_action( 'init', 'my_custom_taxonomy_rest_support', 25 );


function json_api_prepare_post( $post_response, $post, $context ) {

  $field = get_field( "acf_spanish", $post['ID'] );

  $post_response['acf_spanish'] = $field;

  return $post_response;
}
add_filter( 'json_prepare_post', 'json_api_prepare_post', 10, 3 );



