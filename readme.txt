=== Display Future Posts ===
Contributors: brandt-net
Donate link:
Tags: display-future-posts, post, posts, sidebar, future, draft, scheduled
Requires at least: 2.1.0
Tested up to: 3.8.0
Stable tag: 0.2.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Small Plugin to display future posts as a widget on a sidebar or direct on any page you want. 

== Description ==

Small Plugin to display future posts as a list. 
You can use the sidebar widget or you call the method display_future_posts() 
to display the future posts where ever you want.

== Installation ==

This section describes how to install the plugin and get it working.

 1. Upload all files from the zip-file in the seperate plugin folder: `/wp-content/plugins/display-future-posts`.
 2. Activate the plugin through the "Plugins" menu in WordPress
 3. Go to "Options" administration menu, select "Display Future Posts" from the submenu. Change some options.
 4. Place `<?php display_future_posts(); ?>` in your sidebar template or use the simple sidebar widget for your template.
 4. Done :-)

== Upgrade Notice ==

Upgrading

   1. Delete old file(s)
   2. Upload new file(s)

= 0.2.1 and later =
Simple installation. Nothing to do. You can update this with the new WordPress update site.

== Screenshots ==

1. screenshot-1.jpg
1. screenshot-2.jpg


== Changelog ==

* Version 0.2.3
	* Test with WordPress new version 3.8.0

* Version 0.2.2
	* Update only Version and Plugin Informations. No code changed.
	* Test with WordPress 2.6, 2.7 and new Version 3.7.x

* Version 0.2.1a
	* Test with WordPress 2.6, 2.7 and new Version 3.7.x

* Version 0.2.1
	* Bigfix: The german language files now reading correct in WP 2.6 and 2.7
	
* Version 0.2.0
	* Add new option: 'Show time info?'. Default the time info (when the post published) is not visible in the outcoming list.
	* Tested with WordPress Version 2.7.x
	* Update the notes
	
* Version 0.1.5
	* Remove fix <h2> HTML tag from Widget Title. Now you should set the Title with <h3 class=your_title>Your Title</h3>
	* Remove maxlength 50 from the title input field of the admin interface
	  
* Version 0.1.4
	* Working also with flexible Plugin directory in WP Version 2.6
	
* Version 0.1.3
	* Tested with WordPress Version 2.6
	
* Version 0.1.2
	* include german language files
	* change the plugin folder structure
	 
* Version 0.1.1
	* Tested with WordPress Version 2.5
	* Change the admin panel tab to the new design of WordPress 2.5.
	
* Version 0.1.0
	* The first public beta version
	
== Other Notes ==

= Info =

I used this plugin for several month now and it works fine so far. If you find any bugs please send me a mail to blog@brandt-net.de or use the comments on the plugin's homepage. 
Please also contact me for feature requests and ideas how to improve this plugin. Any other reactions are welcome too of course.

= Licence =

Good news, this plugin is free for everyone! Since it's released under the GPL, you can use it free of charge on your personal or commercial blog.
But if you enjoy this plugin, you can thank me and leave a small PayPal [donation] for the time I have spent writing and supporting this wordpress plugin.
