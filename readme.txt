=== Scrolling Tools ===
Contributors: Franck Kosellek
Donate link: no donate link (not yet)
Tags: social network share, scrollbox
Requires at least: 2.0.2
Tested up to: 3.1.2
Stable tag: 0.4.2

Add a scrolling box to your WordPress website. You can include in this box items like sharing button or go to top.

== Description ==

This is the first distribution of this WordPress plugin. Still in beta, I didn't notice any bug
and I am expecting comments, ideas or suggestions for the next versions.


== Installation ==

This section describes how to install the plugin and get it working.

A- WITHOUT FTP
1. Upload `Scrolling Tools` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. That's it !

B- WITH FTP
1. Go to plugins page on the WP backoffice
2. Click "Add New", then "Upload"
3. Choose the zipped plugin, and follow authentication instructions.

== Frequently Asked Questions ==

= I added new images, but they don’t appear. =

The problem might comme from your browser’s cache, which keeps the last image in its memory. Once you make change any image, and it does not appear, empty your browser’s cache.
Also, if it doesn't work, check permission. Php should be able to write on the /images/current/ directory and erase existing files. Change permission recursively on this folder.

= How can I change the background? =

The bar’s background is made out of 3 parts. The upper and lower parts are optional, used only to give original shapes. The middle is a vertically repeated picture.

= I want the bar to always show up =

If you do not want for it to disappear when the page reaches the top, you have to change the “FadeOut distance” in the parameters. Putting this value to 0 means the bar will never disappear.

= I get an error message looking like 'st_error **' =

This indicates that a server-sided problem occurred. I still have no documentation on this matter (I am waiting v1). If you stumble upon an error like this, tell me in the comments and I will try to resolve it.

== Screenshots ==

1. This is how the default scrolling tools bar appears in a WordPress sample page. Take a look at the box, in the left side.
2. An other kind of scrolling tools bar, using a personnalized background.
3. This is how the scrolling tools settings page looks like.

== Changelog ==

= 0.4.2 =
- Removing some superfluous images
- Change the bad permissions message
- refactoring some code
- Correcting the plugin directory name issue (now dynamic)

= 0.4.1 =
First distribution - Beta.

== Upgrade Notice ==

= 0.4.1 =
First distribution - Beta.


