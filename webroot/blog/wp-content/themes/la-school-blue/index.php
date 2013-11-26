<?php get_header(); ?>

	<div class="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'laschool'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a> <small>&ndash; <?php the_time(__('F jS, Y', 'laschool')) ?> <!-- by <?php the_author() ?> --></small></h2>
				
				<div class="entry">
					<?php the_content(__('Read the rest of this entry &raquo;', 'laschool')); ?>
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

		<h2><?php _e('Not Found', 'laschool'); ?></h2>
		<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'laschool'); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
