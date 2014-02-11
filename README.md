The WordPress Loop Presentation
==================

### Title: The WordPress Loop Demystified

##### Description
The WordPress loop is only magical until you grasp the moving parts. In this presentation we'll uncover the gears that keep the loop running and how to access it mystical powers. Here are a few functions and variable we'll cover: 

- [have_posts()](http://codex.wordpress.org/Function_Reference/have_posts)
- [the_post()](http://codex.wordpress.org/Function_Reference/the_post)
- [post_class()](http://codex.wordpress.org/Function_Reference/post_class)
- [the_title()](http://codex.wordpress.org/Function_Reference/the_title)
- [the_category()](http://codex.wordpress.org/Function_Reference/the_category)
- [the_content()](http://codex.wordpress.org/Function_Reference/the_content)
- [the_excerpt()](http://codex.wordpress.org/Function_Reference/the_excerpt)
- [the_tags()](http://codex.wordpress.org/Function_Reference/the_tags)
- [get_template_part()](http://codex.wordpress.org/Function_Reference/get_template_part)
- [WordPress Globals](http://codex.wordpress.org/Global_Variables)
- $wp_query (object) The global instance of the Class_Reference/WP_Query class.
- $post The whole post object.

### [The Loop: WP Definition](http://codex.wordpress.org/The_Loop)

The Loop is PHP code used by WordPress to display posts. Using The Loop, WordPress processes each post to be displayed on the current page, and formats it according to how it matches specified criteria within The Loop tags. Any HTML or PHP code in the Loop will be processed on each post.

The Loop
------------------

### What is a loop

A loop is a repeating cycle which runs a block of code for a set number of cycles or each item in an array. The [WordPress loop](http://codex.wordpress.org/The_Loop) is a **[while](http://www.php.net/manual/en/control-structures.while.php)** loop so it is set to run a set number of cycles, which is set by the [posts_per_page](http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters) parameter. 

### Real world examples of a loop

Real world examples of a loop can been see everywhere. The easiest one to explain would be making drinks for people in line at a coffee shop.

```
<?php
$peopleInLine = array(
	'John' => 'Coffee',
	'Mary' => 'Americano',
	'Todd' => 'Hot Chocolate',
	'Sally' => 'Coffee',
	'Wilber' => 'Tea'
);

// Foreach loop
foreach ( $peopleInLine as $customer => $drink ) {
	echo "Make $customer a $drink.";
}

?>
```

### WordPress version of a loop

The WordPress version of the loop can be a little confusing at first due to the use of the function [have_posts()](http://codex.wordpress.org/Function_Reference/have_posts) with in the loops **while()** statement, and the fact that the same function is previously used in the **if()** statement.

In short **have_posts()** iterates the loop one post at a time by returning true if there is post to display.

See the actual code to see how little this function actually does. **have_posts()** on [core.trac.wordpress](https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/query.php#L3142)

```
<?php

if ( have_posts() ) {
	
	while ( have_posts() ) {
		the_post();
		
		// ..loop code here
		the_title();
		the_content();
		
	}
	
}

?>
```

### Accessing loop variables

The purpose of the WordPress style loop is to make it easy to display the most basic content for each post or page in a standardized method. This method allows all theme to retain relative similarities. 

WordPress does this with a handful of functions that only work with in the loop. 

- [the_title()](http://codex.wordpress.org/Function_Reference/the_title)
- [the_category()](http://codex.wordpress.org/Function_Reference/the_category)
- [the_content()](http://codex.wordpress.org/Function_Reference/the_content)
- [the_excerpt()](http://codex.wordpress.org/Function_Reference/the_excerpt)
- [the_tags()](http://codex.wordpress.org/Function_Reference/the_tags)
- [more related functions](http://codex.wordpress.org/Function_Reference/post_class#Related)

### Why do these only work with in the loop?

The wordpress loop works in conjunction with a few globals, but the $post global is the one we will be talking about. Read more about wordpress global at [WordPress Globals](http://codex.wordpress.org/Global_Variables)

The reason that loop functions only work with in the loop is that they are tied to the current iteration of **$post**. The current iteration of **$post** is set by the function **[the_post()](http://codex.wordpress.org/Function_Reference/the_post)**. The function **the\_post()**, in a rather convoluted way, references a larger more comprehensive global named **$wp\_query**. 

The reason loop functions only work with in the loop is that the global **$post** variable is only populated within the cycle of the loop. Out side of the loop the **$post** variable can not be trusted to give you accurate results.

See the code that powers **the_post()** on [core.trac.wordpress](https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/query.php#L3120)

### How does the_title() and other loop functions get their values?

Functions like **[the_title()](https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/post-template.php#L42)** get their values from a combination of other WordPress functions that reference the global variable **$post**.

With in each function like **the_title()** you be able to follow it back to a function that references a global version of the **$post**. 

### Don't access the $post variable directly

Once you find that you have access to the $post variable it will be tempting to access it directly. You may think, why don't I just **echo $post->post_title;** and be done with it. Why use **the\_title()** at all?

Loop functions are designed so plugin authors can hook into them and filter their contents. You may not think that is important, but your theme users will when a plugin they use can not perform it's desired action because you've shortcut the theming process.

An example of a single.php template file and it loop counter part.
----------

### single.php

```
<?php
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
?>
```

### loop-single.php

```
<?php
echo "<article id=\"post-"; the_ID(); echo "\""; post_class(); echo ">";
	
	if ( has_post_thumbnail() ) {
		echo "<div class=\"post-thumbnail\">";
			the_post_thumbnail();
		echo "</div>";
	}

	echo "<header class=\"entry-header\">";
		
		// Add Category list
		if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) AND twentyfourteen_categorized_blog() ) {
			echo "<div class=\"entry-meta\">";
				echo "<span class=\"cat-links\">" . get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ) . "</span>";
			echo "</div>";
		}
		
		
		// The title
		the_title( '<h1 class="entry-title">', '</h1>' );
		
		
		// post meta data
		echo "<div class=\"entry-meta\">";
			
			// Set up and print post meta information.
			echo "<span class=\"entry-date\">";
				echo "<a href=\"" . esc_url( get_permalink() ) . "\" rel=\"bookmark\">";
					echo "<time class=\"entry-date\" datetime=\"" . esc_attr( get_the_date( 'c' ) ) . "\">" . esc_attr( get_the_date() ) . "</time>";
				echo "</a>";
			echo "</span>";
			echo "<span class=\"byline\">";
				echo "<span class=\"author vcard\">";
					echo "<a class=\"url fn n\" href=\"" . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . "\" rel=\"author\">" . get_the_author() . "</a>";
				echo "</span>";
			echo "</span>";
			
			
			// Comments
			if ( ! post_password_required() AND ( comments_open() OR get_comments_number() ) ) {
				
				echo "<span class=\"comments-link\">";
					comments_popup_link( __( 'Leave a comment', 'twentyfourteen' ), __( '1 Comment', 'twentyfourteen' ), __( '% Comments', 'twentyfourteen' ) );
				echo "</span>";
				
			} // end comments
			
			
			// Edit post
			edit_post_link( __( 'Edit', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
			
		echo "</div><!-- .entry-meta -->";
	echo "</header><!-- .entry-header -->";
	
	
	// Post content
	echo "<div class=\"entry-content\">";
		the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) );
	echo "</div><!-- .entry-content -->";
	
	
	// Display Tags
	the_tags( '<footer class="entry-meta"><span class="tag-links">', '', '</span></footer>' );
	
	
echo "</article><!-- #post-## -->";
?>
```

ChangeLog
====================

### 02.11.14 - 1.0.1
- continuation of loop explanation

### 02.09.14 - 1.0.0
- initial commit
- added single template and loop-single