	<div class="sidebar">
		<?php 	/* Widgetized sidebar, if you have the plugin installed. */
				if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>


		<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
		<li><h2><?php _e('Author', 'laschool'); ?></h2>
		<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
		</li>
		-->

		<?php if ( is_404() || is_category() || is_day() || is_month() ||
					is_year() || is_search() || is_paged() ) {
		?>

		<?php /* If this is a 404 page */ if (is_404()) { ?>
		<?php /* If this is a category archive */ } elseif (is_category()) { ?>
		<p><?php printf(__('You are currently browsing the archives for the %s category.', 'laschool'), single_cat_title('', false)); ?></p>

		<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
		<p><?php printf(__('You are currently browsing the <a href="%1$s/">%2$s</a> blog archives for the day %3$s.', 'laschool'), get_bloginfo('url'), get_bloginfo('name'), get_the_time(__('l, F jS, Y', 'laschool'))); ?></p>

		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<p><?php printf(__('You are currently browsing the <a href="%1$s/">%2$s</a> blog archives for %3$s.', 'laschool'), get_bloginfo('url'), get_bloginfo('name'), get_the_time(__('F, Y', 'laschool'))); ?></p>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<p><?php printf(__('You are currently browsing the <a href="%1$s/">%2$s</a> blog archives for the year %3$s.', 'laschool'), get_bloginfo('url'), get_bloginfo('name'), get_the_time('Y')); ?></p>

		<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<p><?php printf(__('You are currently browsing the <a href="%1$s/">%2$s</a> blog archives.', 'laschool'), get_bloginfo('url'), get_bloginfo('name')); ?></p>

		<?php } ?>

		<?php }?>

		<h2 class="first"><?php _e('Pages', 'laschool'); ?></h2>
		<ul>
			<?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
		</ul>
		
		<h2><?php _e('Search', 'laschool'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		
		<?php /* If this is the frontpage */ if ( !is_page() ) { ?>
		
		<?php /* Plugin installed? */ if (function_exists('get_flickrRSS')) : ?>
		<h2><?php _e('Photostream', 'laschool'); ?></h2>
		<ul class="photostream">
			<?php get_flickrRSS(); ?>
		</ul>
		<?php endif; ?>
				
		<h2><?php _e('Archives', 'laschool'); ?></h2>
		<ul>
			<?php wp_get_archives('type=monthly&limit=13'); ?>
		</ul>

		<h2><?php _e('Categories', 'laschool'); ?></h2>
		<ul>
			<?php wp_list_categories('show_count=1&title_li='); ?>
		</ul>
		<?php } ?>
		
		<?php /* If this is archives page */ if ( is_page('archives') ) { ?>
		<h2><?php _e('Categories', 'laschool'); ?></h2>
		<ul>
			<?php wp_list_categories('show_count=1&title_li='); ?>
		</ul>
		<?php } ?>
		
		<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
		<!--<h2><?php _e('Bookmarks', 'laschool'); ?></h2>
		<ul>
			<?php wp_list_bookmarks('categorize=0&title_li='); ?>
		</ul>-->
		<?php } ?>

		<?php endif; ?>
	</div>

