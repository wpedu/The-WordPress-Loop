<?php
/* Template Name: Append three latest posts */

/**
 * File Name tmp-three-latest-posts.php
 * @package the-wp-loop-demystified
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0.0
 * @updated 00.00.00
 **/
#################################################################################################### */

get_header();

if ( have_posts() ) {
	
	echo "<div id=\"primary\" class=\"content-area\">";
		echo "<div id=\"content\" class=\"site-content\" role=\"main\">";

			// Start the Loop.
			while ( have_posts() ) {
				the_post();
				
				echo "<article id=\"post-"; the_ID(); echo "\""; post_class(); echo ">";

					echo "<header class=\"entry-header\">";

                        // The title
						the_title( '<h1 class="entry-title">', '</h1>' );
						
					echo "</header><!-- .entry-header -->";


					// Post content
					echo "<div class=\"entry-content\">";
						the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
						
						// custom post loop
						$query = array(
							'posts_per_page' => 3,
							'post_type' => 'post',
						);
						$wp_query = new WP_Query();
						$wp_query->query( $query );
						if ( have_posts() ) {
							
							echo "<strong>Recent Posts</strong>";
							echo "<ul>";

								while ( have_posts() ) {
									the_post();

									the_title( '<li><a href="' . esc_url( get_permalink() ) . '">', '</a></li>' );

								} // end while ( have_posts() )
								wp_reset_postdata();

							echo "</ul>";

						} // end if ( have_posts() )
						wp_reset_query();
						
					echo "</div><!-- .entry-content -->";
					

				echo "</article><!-- #post-## -->";

			} // end while ( have_posts() )

		echo "</div><!-- #content -->";

	echo "</div><!-- #primary -->";
	
}

get_sidebar( 'content' );
get_sidebar();
get_footer();