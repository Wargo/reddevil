<?php get_header(); ?>

	<div class="content">

<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="pagetitle"><?php printf(__('Archive for the &#8216;%s&#8217; Category', 'laschool'), single_cat_title('', false)); ?></h3>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3 class="pagetitle"><?php printf(__('Posts Tagged &#8216;%s&#8217;', 'laschool'), single_tag_title('', false) ); ?></h3>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3 class="pagetitle"><?php printf(_c('Archive for %s|Daily archive page', 'laschool'), get_the_time(__('F jS, Y', 'laschool'))); ?></h3>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3 class="pagetitle"><?php printf(_c('Archive for %s|Monthly archive page', 'laschool'), get_the_time(__('F, Y', 'laschool'))); ?></h3>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3 class="pagetitle"><?php printf(_c('Archive for %s|Yearly archive page', 'laschool'), get_the_time(__('Y', 'laschool'))); ?></h3>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3 class="pagetitle"><?php _e('Author Archive', 'laschool'); ?></h3>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3 class="pagetitle"><?php _e('Blog Archives', 'laschool'); ?></h3>
 	  <?php } ?>

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
			<div class="alignleft"><?php posts_nav_link('','',__('&laquo; Older Entries', 'laschool')) ?></div>
			<div class="alignright"><?php posts_nav_link('',__('Newer Entries &raquo;', 'laschool'),'') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'laschool'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
