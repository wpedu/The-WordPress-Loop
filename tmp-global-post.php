<?php
/* Template Name: See Globall $post Variable */
/**
 * File Name tmp-global-post.php
 * @package the-wp-loop-demystified
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0.0
 * @updated 00.00.00
 **/
#################################################################################################### */


if ( ! is_user_logged_in() OR ! current_user_can('install_themes') ) {
	wp_die('Sorry no go!');
}

the_post();
print_r($post);