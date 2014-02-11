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

A loop is a repeating cycle which runs a block of code for a set number of cycles or each item in an array. The [WordPress loop](http://codex.wordpress.org/The_Loop) is a "[while](http://www.php.net/manual/en/control-structures.while.php)" loop so it is set to run a set number of cycles, which is set by the [posts_per_page](http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters) parameter. 

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

The wordpress loop works in conjunction with a few globals, but the $post global is the one we will be talking about. _read more about wordpress global at [WordPress Globals](http://codex.wordpress.org/Global_Variables)_

The reason that **loop** functions only work with in the loop is that they are tied to the current iteration of **$post**. The current iteration of $post is set by the function [the_post()](http://codex.wordpress.org/Function_Reference/the_post). 

_See the code that powers the_post() on [core.trac.wordpress](https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/query.php#L3120)_

ChangeLog
====================

### 02.11.14 - 1.0.1
- continuation of loop explination

### 02.09.14 - 1.0.0
- initial commit
- added single template and loop-single