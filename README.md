The WordPress Loop Presentation
==================

This repository is a ChildTheme for twentyfourteen, and a presentation tool for an explanation of the WordPress loop. You may download and install this theme to see it in action.

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

##### [WordPress Definition](http://codex.wordpress.org/The_Loop)

The Loop is PHP code used by WordPress to display posts. Using The Loop, WordPress processes each post to be displayed on the current page, and formats it according to how it matches specified criteria within The Loop tags. Any HTML or PHP code in the Loop will be processed on each post.

The Loop
------------------

### 01. What is a loop

A loop is a repeating process which runs a block of code for each item in an array. The [WordPress loop](http://codex.wordpress.org/The_Loop) is a **[while](http://www.php.net/manual/en/control-structures.while.php)** loop so it is set to run a set number of cycles, which is set by the [posts_per_page](http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters) parameter. 

### 02. Real world examples of a loop

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

### 03. WordPress version of a loop

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

### 04. Accessing loop variables

The purpose of the WordPress style loop is to make it easy to display the most basic content for each post or page in a standardized method. This method allows all themes to retain relative similarities.

WordPress does this with a handful of functions that only work with in the loop. 

- [the_title()](http://codex.wordpress.org/Function_Reference/the_title)
- [the_category()](http://codex.wordpress.org/Function_Reference/the_category)
- [the_content()](http://codex.wordpress.org/Function_Reference/the_content)
- [the_excerpt()](http://codex.wordpress.org/Function_Reference/the_excerpt)
- [the_tags()](http://codex.wordpress.org/Function_Reference/the_tags)
- [more related functions](http://codex.wordpress.org/Function_Reference/post_class#Related)

### 05. Why do these functions only work with in the loop?

The wordpress loop works in conjunction with a few globals, but the $post global is the one we will be talking about. Read more about wordpress global at [WordPress Globals](http://codex.wordpress.org/Global_Variables)

The reason loop functions only work with in the loop is that they are tied to the current iteration of **$post**, and using them outside the loop will produce unexpected results. The global **$post** variable is only guarnteed to be populated properly within the cycle of the loop.

See the code that powers **the_post()** on [core.trac.wordpress](https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/query.php#L3120)

### 06. How do functions like the_title() receive their values?

Functions like **[the_title()](https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/post-template.php#L42)** get their values from a combination of other WordPress functions that reference the global variable **$post**.

With in each function such as **the_title()** you be able to trace it's roots back to a global version of the **$post**. If you were to look at a raw version of the **$post** variable you will see raw post data in an array format.

##### Global what? 

Variable Scope and Globals is completely separate topic so lets not get derailed. If you would like more reading please see these links below.

- Check out php [Variable Scope](http://www.php.net/manual/en/language.variables.scope.php)
- Check out [WordPress Global Variables](http://codex.wordpress.org/Global_Variables)

### 07. Do not access the $post variable directly

Once you find that you have access to the $post variable it may be tempting to access it directly. You may think, why don't I just **echo $post->post_title;** and be done with it. Why use **the\_title()** at all?

Loop functions are designed to maintain standardization and access. Using loop functions will guarantee that plugins can hook into your theme properly. You may not think that is important, but your theme users will thank you when their favorite plugin continues to work flawlessly.

An example of a single post template file
----------

These files are pulled directly from this presentation / repository.

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

Other resources
====================
- Browse the WordPress core: [phpxref.ftwr.co.uk/wordpress](http://phpxref.ftwr.co.uk/wordpress/)
- Custom loops will require: [wp_reset_postdata()](http://codex.wordpress.org/Function_Reference/wp_reset_postdata)
- Custom loops will require: [wp_reset_query()](http://codex.wordpress.org/Function_Reference/wp_reset_query)

ChangeLog
====================

### 02.17.14 - 1.0.2
- added link resources to global variables

### 02.11.14 - 1.0.1
- continuation of loop explanation

### 02.09.14 - 1.0.0
- initial commit
- added single template and loop-single