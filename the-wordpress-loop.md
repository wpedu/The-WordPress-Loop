The WordPress Loop
====================

### [WP Definition](http://codex.wordpress.org/The_Loop)

The Loop is PHP code used by WordPress to display posts. Using The Loop, WordPress processes each post to be displayed on the current page, and formats it according to how it matches specified criteria within The Loop tags. Any HTML or PHP code in the Loop will be processed on each post.

### Functions

We will be covering the following functions and variables.

- [have_posts()](http://codex.wordpress.org/Function_Reference/have_posts)
- [the_post()](http://codex.wordpress.org/Function_Reference/the_post)
- [WordPress Globals](http://codex.wordpress.org/Global_Variables)
- $wp_query (object) The global instance of the Class_Reference/WP_Query class.
- $post The whole post object.
- [get_template_part()](http://codex.wordpress.org/Function_Reference/get_template_part)

The Loop
------------------

### What is a loop

A loop is a repeating cycle which runs a block of code for a set number of cycles or each item in an array. The [WordPress loop](http://codex.wordpress.org/The_Loop) is a "[while](http://www.php.net/manual/en/control-structures.while.php)" loop so it is set to run a set number of cycles, which is set by the [posts_per_page](http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters) parameter. 

### WordPress version of a loop

The WordPress version of the loop can be a little confusing at first due to their use of functions with in the loops "while()" statement and the fact that the same function is previously used in the "if()" statement as well.



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

- Accessing loop variables
- $wp_query global
- $post global