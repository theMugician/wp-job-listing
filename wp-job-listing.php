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

require ( plugin_dir_path(__FILE__) . 'wp-job-cpt.php' );
require ( plugin_dir_path(__FILE__) . 'wp-job-fields.php' );
require ( plugin_dir_path(__FILE__) . 'wp-job-render-admin.php' );
require ( plugin_dir_path(__FILE__) . 'wp-job-settings.php' );

/**
* Set Jobs WP_Query
**/
function rbkwp_get_jobs_posts() {
  $args = array(
    'post_type' => 'job',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_per_page' => 100, /* add a reasonable max # rows */
    'no_found_rows' => true, /* don't generate a count as part of query */
  );
  $jobs = new WP_Query( $args );
  return $jobs;
}

function rbkwp_admin_enqueue_scripts() {
  //These varibales allow us to target the post type and the post edit screen.
  //global $pagenow, $typenow;
  $screen = get_current_screen();
  //if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'job' ) {
  if ( is_object($screen) && 'job' == $screen->post_type ) {

    //Plugin Main CSS File.
    wp_enqueue_style( 'rbkwp-admin-css', plugins_url( 'css/admin-jobs.css', __FILE__ ) );
    //Plugin Main js File.
    wp_enqueue_script( 'rbkwp-job-js', plugins_url( 'js/admin-jobs.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker' ), '20150204', true );
    //Quicktags js file.
    wp_enqueue_script( 'rbkwp-custom-quicktags', plugins_url( 'js/rbkwp-quicktags.js', __FILE__ ), array( 'quicktags' ), false, true );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'reorder-js', plugins_url( '/js/reorder.js', __FILE__), array( 'jquery' ), '', true );
    wp_localize_script( 'reorder-js', 'rbk_options', array(
    'security' => wp_create_nonce( 'rbk-reorder-nonce' ),
  ) );
    //Datepicker Styles
    wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
  }


}
//This hook ensures our scripts and styles are only loaded in the admin.
add_action( 'admin_enqueue_scripts', 'rbkwp_admin_enqueue_scripts' );
