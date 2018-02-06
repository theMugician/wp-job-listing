 <?php
 /**
 * Plugin Name:       Job Listing
 * Plugin URI:        https://github.com/theMugician
 * Description:       A plugin for creating and displaying job opportunities
 * Author:            Greg Slonina
 * Author URI:        redbrickreative.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-cbf
 * Domain Path:       /languages
 */

if( ! defined( 'ABSPATH' ) ) {
  exit;
}

function rbkwp_register_post_type() {

  $singular = 'Job Listing';
  $plural = 'Job Listings';

  $labels = array(
    'name'      => $plural,
    'singular_name'   => $singular,
    'add_new'     => 'Add New',
    'add_new_item'    => 'Add New ' . $singular,
    'edit'            => 'Edit',
    'edit_item'         => 'Edit ' . $singular,
    'new_item'          => 'New ' . $singular,
    'view'      => 'View ' . $singular,
    'view_item'     => 'View ' . $singular,
    'search_term'     => 'Search ' . $plural,
    'parent'    => 'Parent ' . $singular,
    'not_found'     => 'No ' . $plural .' found',
    'not_found_in_trash'  => 'No ' . $plural .' in Trash'
  );
  //Add a filter to our cpt's $args variable.
  $args = apply_filters( 'rbkwp_post_type_args',array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'menu_icon'          => 'dashicons-businessman',
    'query_var'          => true,
    'rewrite'            => array( 'slug' => $plural ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 10,
    'supports'           => array( 'title', 'editor', 'author', 'custom-fields' )
  ) );
  register_post_type( $singular, $args );

}
add_action( 'init', 'rbkwp_register_post_type' );

function rbkwp_register_taxonomy() {
  register_taxonomy(
    'peoples_people',
    'post_posts',
    array(
      'public' => true,
      'hierarchical' => true,
      'show_ui' => true,
      'label' => __( 'People' ),
      'rewrite' => array( 'slug' => 'person' ),
      'capabilities' => array(
        'assign_terms' => 'edit_guides',
        'edit_terms' => 'publish_guides'
      )
    )
  );
  /*
  $singular = 'Location';
  $plural = 'Locations';
  //$slug = str_replace( ' ', '_', strtolower( $singular ) );
  $labels = array(
    'name' => $plural,
    'singular_name' => $singular,
    'search_items' => 'Search ' . $plural,
    'popular_items' => 'Popular ' . $plural,
    'all_items' => 'All ' . $plural,
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => 'Edit ' . $singular,
    'update_item' => 'Update ' . $singular,
    'add_new_item' => 'Add New ' . $singular,
    'new_item_name' => 'New ' . $singular . ' Name',
    'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
    'add_or_remove_items' => 'Add or remove ' . $plural,
    'choose_from_most_used' => 'Choose from the most used ' . $plural,
    'not_found' => 'No ' . $plural . ' found.',
    'menu_name' => $plural,
  );
  $args = array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => location ),
  );
  register_taxonomy( 'location', 'job', $args );
  */
}

add_action( 'init', 'rbkwp_register_taxonomy' );

