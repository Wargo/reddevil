

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<p><input type="text" name="s" id="s" value="<?php _e('Searchterm...', 'laschool'); ?>" class="input_search"
	 onfocus="if(this.value=='<?php _e('Searchterm...', 'laschool'); ?>'){this.value=''}" onblur="if(this.value==''){this.value='<?php _e('Searchterm...', 'laschool'); ?>'}" />
	 <!--<input type="submit" id="searchsubmit" value="<?php _e('Search', 'laschool'); ?>" />--></p>
</form>