<?php
/**
 * File Name single.php
 * Is Template Overwrite
 * @package the-wp-loop-demystified
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0.0
 * @updated 00.00.00
 **/
#################################################################################################### */

get_header();

echo "<div id=\"primary\" class=\"content-area\">";
	echo "<div id=\"content\" class=\"site-content\" role=\"main\">";

		// Start the Loop.
		while ( have_posts() ) {
			the_post();
			
			
			get_template_part( 'loop-single' );
			
			
			// Previous/next post navigation.
			// Don't print empty markup if there's nowhere to navigate.
			if ( get_adjacent_post( false, '', true ) AND get_adjacent_post( false, '', false ) ) {
				
				echo "<nav class=\"navigation post-navigation\" role=\"navigation\">";
				
					echo "<h1 class=\"screen-reader-text\">"; 
						_e( 'Post navigation', 'twentyfourteen' ); 
					echo "</h1>";
					
					echo "<div class=\"nav-links\">";
						previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span>%title', 'twentyfourteen' ) );
						next_post_link( '%link', __( '<span class="meta-nav">Next Post</span>%title', 'twentyfourteen' ) );
					echo "</div><!-- .nav-links -->";
					
				echo "</nav><!-- .navigation -->";
			} // end if ( $next && $previous )
			
			
			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() OR get_comments_number() ) {
				comments_template();
			}
			
			
		} // end while ( have_posts() )
		
	echo "</div><!-- #content -->";
	
echo "</div><!-- #primary -->";

get_sidebar( 'content' );
get_sidebar();
get_footer();