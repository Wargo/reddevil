<?php get_header(); ?>

	<div class="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?> <small>&ndash; <?php the_time(__('F jS, Y', 'laschool')) ?> <!-- by <?php the_author() ?> --></small></h2>

			<div class="entry">
				<?php the_content('<p>' . __('Read the rest of this entry &raquo;', 'laschool') . '</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'laschool') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>' . __('Tags:', 'laschool') . ' ', ', ', '</p>'); ?>
			</div>
			
			<?php edit_post_link(__('Edit this entry.', 'laschool'), '<p class=edit>', '</p>'); ?>
			
			<div class="comments-nr"><?php comments_number(__('0<span> Comments</span>', 'laschool'), __('1<span> Comment</span>', 'laschool'), __('%<span> Comments</span>', 'laschool')); ?></div>
			<div class="postdata"><?php printf(__('Posted in %s', 'laschool'), get_the_category_list(', ')); ?></div>

		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'laschool'); ?></p>

<?php endif; ?>

	</div>
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
