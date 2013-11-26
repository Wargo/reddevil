<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div class="content">

<h2><?php _e('Archives', 'laschool'); ?></h2>

<h3><?php _e('Tags:', 'laschool'); ?></h3>
<div class="tag_cloud">
<?php wp_tag_cloud(''); ?>
</div>

<p>&nbsp;</p>

<h3><?php _e('The last 30 Posts:', 'laschool'); ?></h3>

<?php
$default = 30;
$number = $default + $_GET['more'];
$counter = 0;
?>

<?php $my_query = new WP_Query('showposts='.$number); ?>

<?php if (have_posts()) : ?>
<ul class="archives">

<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

<?php $counter++; ?>
<?php if ($counter == $number-30) : ?>
<a name="new"></a>
<?php endif; ?> 

<li>
	<span><?php the_time('d.m.') ?></span> <a href="<?php the_permalink() ?>"><?php the_title(); ?></a> <span><small><?php _e('with', 'laschool'); ?> <?php comments_number(__('0 Comments', 'laschool'), __('1 Comment', 'laschool'), __('% Comments', 'laschool')); ?></small></span>
</li>

<?php endwhile; ?>
</ul>

<?php if($number == 30) : ?>
<p><a href="?more=30#new"><?php _e('Show 30 Posts more', 'laschool'); ?></a></p>
<?php endif; ?>

<?php endif; ?>


</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
