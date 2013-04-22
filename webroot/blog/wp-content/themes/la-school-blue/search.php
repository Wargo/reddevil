<?php get_header(); ?>

	<div class="content">

	<?php if (have_posts()) : ?>

		<h3><?php _e('Search Results', 'laschool'); ?></h3>

		<p><?php printf(__('You have searched the <a href="%1$s/">%2$s</a> blog archives for <strong>&#8216;%3$s&#8217;</strong>.', 'laschool'), get_bloginfo('url'), get_bloginfo('name'), get_search_query()); ?></p>
		
		<p>&nbsp;</p>
		<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class(); ?>>
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'laschool'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a> <small>&ndash; <?php the_time(__('j. F, Y', 'laschool')) ?> <!-- by <?php the_author() ?> --></small></h2>

				<div class="entry">
					<?php the_content() ?>
				</div>

				<div class="comments-nr"><?php comments_popup_link(__('0<span> Comments</span>', 'laschool'), __('1<span> Comment</span>', 'laschool'), __('%<span> Comments</span>', 'laschool')); ?></div>
				<div class="postdata"><?php printf(__('Posted in %s', 'laschool'), get_the_category_list(', ')); ?></div>

		</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'laschool')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'laschool')) ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('No posts found. Try a different search?', 'laschool'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
