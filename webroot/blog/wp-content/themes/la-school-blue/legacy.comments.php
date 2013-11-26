<?php // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'laschool'); ?></p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<?php if ($comments) : ?>
	<h2 id="comments"><?php comments_number(__('No Responses', 'laschool'), __('One Response', 'laschool'), __('% Responses', 'laschool'));?> <?php printf(__('to &#8220;%s&#8221;', 'laschool'), the_title('', '', false)); ?></h2>

	<ol class="comments">

	<?php foreach ($comments as $comment) : ?>
	
		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 32 ); ?>
			<p class="data"><?php comment_author_link(); ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<small class="approve"><?php _e('Your comment is awaiting moderation.', 'laschool'); ?></small>
			<?php endif; ?>
			<br /><small><?php printf(__('%1$s at %2$s', 'laschool'), get_comment_date(__('F jS, Y', 'laschool')), get_comment_time()); ?> <?php edit_comment_link(__('edit', 'laschool'),'&nbsp;',''); ?></small></p>
		
			<?php comment_text() ?>
		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'laschool'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<h2 id="respond"><?php _e('Leave a Reply', 'laschool'); ?></h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'laschool'), get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode(get_permalink())); ?></p>
<?php else : ?>

<fieldset>
<legend><?php _e('Leave a Reply', 'laschool'); ?></legend>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'laschool'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'laschool'); ?>"><?php _e('Log out &raquo;', 'laschool'); ?></a></p>

<?php else : ?>

<p><label for="author"><?php _e('Name', 'laschool'); ?> <?php if ($req) _e("<small>required</small>", "laschool"); ?></label>
<input type="text" id="author" name="author" value="<?php echo $comment_author; ?>" class="input" tabindex="1" /></p>

<p><label for="email"><?php _e('Mail <small>will not be published</small>', 'laschool'); ?><?php if ($req) _e("<small>, required</small>", "laschool"); ?></label>
<input type="text" id="email" name="email" value="<?php echo $comment_author_email; ?>" class="input" tabindex="2" /></p>

<p><label for="url"><?php _e('Website', 'laschool'); ?></label>
<input type="text" id="url" name="url" value="<?php echo $comment_author_url; ?>" class="input" tabindex="3" /></p>

<?php endif; ?>

<p><label for="comment"><?php _e('Comment', 'laschool'); ?> <?php _e('<small>no spam</small>', 'laschool'); ?></label>
<textarea id="comment" name="comment" class="textarea" cols="45" rows="8" tabindex="4"></textarea>
</p>

<p><input type="submit" id="submit" name="submit" value="<?php _e('Submit Comment', 'laschool'); ?>" class="submit" tabindex="5" /> <?php _e('or', 'laschool'); ?> <a href="" tabindex="6"><?php _e('chancel', 'laschool'); ?></a>
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>

<?php do_action('comment_form', $post->ID); ?>

</form>
</fieldset>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
