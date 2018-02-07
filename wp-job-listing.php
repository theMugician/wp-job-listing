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

