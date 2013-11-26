<?php get_header(); ?>

	<div class="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			
			<div class="entry">
				<?php the_content('<p>' . __('Read the rest of this page &raquo;', 'laschool') . '</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'laschool') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
			
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link(__('Edit this entry.', 'laschool'), '<p class=edit>', '</p>'); ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
