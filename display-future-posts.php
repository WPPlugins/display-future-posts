<?php
/*
Plugin Name: Display Future Posts
Plugin URI: http://wordpress.org/extend/plugins/display-future-posts/
Description: Small Plugin to display future posts as a list. You can use the sidebar widget or you call the method display_future_posts() to display the future posts where ever you want. 
Version: 0.2.3
Author: Stefan Brandt
Author URI: http://blog.brandt-net.de
Min WP Version: 2.1.*
Max WP Version: 3.8.0
*/

/*  Copyright 2008-2013 stefan Brandt  (email : blog@brandt-net.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once(dirname(__FILE__).'/includes/const.php');


// Pre-2.6 compatibility
if ( !defined('WP_CONTENT_URL') )
	define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if ( !defined('WP_CONTENT_DIR') )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );

/**
 * load language file
 */
function sbrandt_textdomain() {
	if (function_exists('load_plugin_textdomain')) {
		if ( !defined('WP_PLUGIN_DIR') ) {
			load_plugin_textdomain(DispFuturePosts_DOMAIN, str_replace( ABSPATH, '', dirname(__FILE__) ) . '/languages');
		} else {
			load_plugin_textdomain(DispFuturePosts_DOMAIN, false, dirname( plugin_basename(__FILE__) ) . '/languages');
		}
	}
}


///////////////////////////////////////////////////////////////////////////////
// Display Future Posts - Stefan Brandt 22.12.2007
///////////////////////////////////////////////////////////////////////////////
function display_future_posts(){
	global $wpdb;
	$fb_date_today = current_time('mysql'); //today date GMT
  	if ( $scheduled = $wpdb->get_results("SELECT ID, post_title, post_date_gmt FROM $wpdb->posts WHERE post_status = 'future' AND post_date_gmt > '$fb_date_today' ORDER BY post_date ASC") ) 
	{
	  	$isShowTimeInfo = get_option('display_future_posts_showTimeInfo');	
		$isDisplayTitle = get_option('display_future_posts_displaytitle');	
	  	$title = get_option('display_future_posts_title');
	  	
    	echo '<div class="display_future_posts">';
			if ($isDisplayTitle=="1" && $title!="")	{ echo $title; }
		    echo '<ul>';
		    foreach ($scheduled as $post) {
		      if ($post->post_title == '')
		  			 $post->post_title = sprintf(__('Post #%s'), $post->ID);
		      
		  	  if ($isShowTimeInfo=="1") {
		  	  	$timeshift = human_time_diff( current_time('timestamp', 1), strtotime($post->post_date_gmt. ' GMT') );
			  	echo '<li>' . sprintf(__('%1$s (in %2$s)'), $post->post_title, $timeshift)  . '</li>';
		  	  } else {
		  	  	echo '<li>' . $post->post_title . '</li>';
		  	  }
		  			 
			} //end for loop
		    echo '</ul>';
	    echo '</div>';
	} //end if
} //end [display_future_posts]

//initial the plugin
function display_future_posts_init() {
	if ( !function_exists('register_sidebar_widget') )
		return;

	// Register widget for use
	register_sidebar_widget(array('Future Posts', 'widgets'), 'display_future_posts');
}

// Run code and init
function display_future_posts_options() {
	if($_POST['display_future_posts_save']){
		$displaytitle = $_POST['display_future_posts_displaytitle'];
		$showTimeInfo = $_POST['display_future_posts_showTimeInfo'];
		
		update_option('display_future_posts_displaytitle', $displaytitle);
		update_option('display_future_posts_showTimeInfo', $showTimeInfo);
		update_option('display_future_posts_title', $_POST['display_future_posts_title']);
		
		echo '<div class="updated"><p>';
		_e('Settings are saved successfully!', DispFuturePosts_DOMAIN);
		echo '</p></div>';
	}
?>

<!-- -------------------------------- -->
<!-- start plugin admin settings page --> 
<!-- -------------------------------- -->
<div class="wrap">
	<h2>Display Future Posts</h2>
	<p><?php _e('This small plugin display future posts as a list. You can use the sidebar widget or you call the method display_future_posts() to display the future posts where ever you want.', DispFuturePosts_DOMAIN) ?></p>
	<h3><?php _e('General Settings', DispFuturePosts_DOMAIN) ?></h3>
	
	<form method="post" id="dfp_future_posts_options">
		<table class="form-table" summary="submit">
		<tbody>
		<tr valign="top">
			<th scope="row"><label for="display_future_posts_displaytitle"><?php _e('Display Title', DispFuturePosts_DOMAIN); ?></label></th>
			<td><input id="display_future_posts_displaytitle" name="display_future_posts_displaytitle" type="checkbox" value="<?php $displaytitle=get_option('display_future_posts_displaytitle'); if($displaytitle=="" || $displaytitle==0){ echo "1";} if($displaytitle=="1") { echo $displaytitle;}?>" size="1" maxlength="1" <? if ($displaytitle=="1"){echo "checked";}?> /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="display_future_posts_title"><?php _e('Title', DispFuturePosts_DOMAIN); echo ': '; ?></label></th>
			<td>
				<input name="display_future_posts_title" type="text" id="display_future_posts_title" value="<?php echo get_option('display_future_posts_title') ;?>" class="regular-text" type="text" />
				<br/><span class="setting-description">(<?php _e('Just enter the title you want for the display section.', DispFuturePosts_DOMAIN); ?>)</span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="display_future_posts_showTimeInfo"><?php _e('Show time info', DispFuturePosts_DOMAIN); ?></label></th>
			<td><input id="display_future_posts_showTimeInfo" name="display_future_posts_showTimeInfo" type="checkbox" value="<?php $showTimeInfo=get_option('display_future_posts_showTimeInfo'); if($showTimeInfo=="" || $showTimeInfo==0){ echo "1";} if($showTimeInfo=="1") { echo $showTimeInfo;}?>" size="1" maxlength="1" <? if ($showTimeInfo=="1"){echo "checked";}?> /></td>
		</tr>
		</tbody>
		</table>
		
		<p class="submit">
          <input class="button" type="submit" name="display_future_posts_save" value="<?php _e('Save Changes', DispFuturePosts_DOMAIN); ?> &raquo;" />
        </p>

	</form>
</div>
<!-- finished plugin settings page --> 

<?php
}

/* Init Admin Menu */
function display_future_posts_adminmenu(){
	add_options_page('Display Future Posts Options', 'Display Future Posts', 9, 'display-future-posts.php', 'display_future_posts_options');
}


/* ---------------------------------------------------------------------------- */
/* start main */
/* ---------------------------------------------------------------------------- */
{
	sbrandt_textdomain();
		
	add_action('admin_menu','display_future_posts_adminmenu', 1);
	add_action('widgets_init', 'display_future_posts_init');
		
} // end main

?>