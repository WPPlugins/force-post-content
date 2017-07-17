<?php
/*
Plugin Name: Force Post Content
Description: Forces user to assign a Content to a post before publishing 
Author: Germain Guglielmetti
Version: 0.3
Author URI: http://www.italic.fr
*/ 

// Based on Jatinder Pal Singh's "Force Post Title" plugin
function force_post_content_init() {
	wp_enqueue_script('jquery');
}

function force_post_content() {
	?><script type="text/javascript">
		jQuery('#publish').click(function(){
			var testervar = jQuery('#wp-content-wrap').find('#content');
			var editorContent = (typeof(tinyMCE.get('content')) != 'undefined') ? tinyMCE.get('content').getContent() : '';

			if (testervar.val().length < 1 && editorContent.length < 1)	{
				jQuery('#wp-content-wrap').css('border', '1px #F00 solid');
				setTimeout(function() { jQuery('#ajax-loading').css('visibility', 'hidden'); }, 100);

				// Customize your alert message below
				alert("<?php echo __('Please write some content before publishing.') ?>");

				setTimeout(function() { jQuery('#publish').removeClass('button-primary-disabled'); }, 100);
				return false;
			} else {
				jQuery('#wp-content-wrap').css('border', 'none');
			}
		});
	</script><?php
}

add_action('admin_init', 'force_post_content_init');
add_action('edit_form_advanced', 'force_post_content');

?>