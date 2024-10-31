<?php
/*
Plugin Name: Scrolling Tools
Plugin URI: http://watchmymind.com/2011-05/scrolling-tools-a-wordpress-plugin-using-jquery/
Description: Add a scrolling box to your WordPress website. You can include in this box items like sharing button or go to top.
Version:0.4.2 (beta)
Author:Franck Kosellek - Nephila
Author URI: http://watchmymind.com
Licence: GPL
*/

require_once("php/display.php");
require_once("php/funcs.php");
require_once("php/data.php");

register_activation_hook(__FILE__, 'stInstall');
register_deactivation_hook(__FILE__, 'stRemove');

function stInstall() {
 $saved_style = 'a:4:{s:6:"action";s:5:"style";s:10:"distMiddle";s:3:"580";s:7:"distTop";s:3:"140";s:11:"distFadeout";s:3:"140";}';
$saved_items = 'a:8:{i:0;a:4:{s:2:"id";s:14:"scrolltop3bfcd";s:4:"type";s:9:"scrolltop";s:4:"link";s:0:"";s:4:"rank";s:2:"10";}i:1;a:4:{s:2:"id";s:9:"link4a8d6";s:4:"type";s:5:"popup";s:4:"link";s:38:"http://www.facebook.com/share.php?u=%s";s:4:"rank";s:2:"20";}i:2;a:4:{s:2:"id";s:9:"linkd87e1";s:4:"type";s:5:"popup";s:4:"link";s:39:"http://twitter.com/intent/tweet?text=%s";s:4:"rank";s:2:"30";}i:3;a:4:{s:2:"id";s:10:"share2ffd1";s:4:"type";s:4:"link";s:4:"link";s:53:"http://www.linkedin.com/shareArticle?mini=true&url=%s";s:4:"rank";s:2:"40";}i:4;a:4:{s:2:"id";s:10:"shareeedc7";s:4:"type";s:4:"link";s:4:"link";s:44:"http://www.blogger.com/blog_this.pyra?t&u=%s";s:4:"rank";s:2:"50";}i:5;a:4:{s:2:"id";s:10:"sharefc9e8";s:4:"type";s:5:"popup";s:4:"link";s:45:"http://www.delicious.com/save?jump=yes&url=%s";s:4:"rank";s:2:"60";}i:6;a:4:{s:2:"id";s:9:"link47f27";s:4:"type";s:4:"link";s:4:"link";s:7:"%sfeed/";s:4:"rank";s:2:"70";}i:7;a:4:{s:2:"id";s:11:"mailto65714";s:4:"type";s:6:"mailto";s:4:"link";s:20:"my_email@website.com";s:4:"rank";s:2:"80";}}';
 add_option("st_style", $saved_style, "", "yes");
  add_option("st_items", $saved_items, "", "yes");
  add_option("st_display", "ko", "", "yes");
  add_option("st_advanced", "", "", "yes");
}

function stRemove() {
}


if ( is_admin() )
  require_once("php/admin.php");
else {
  if ($display == "ok") {
    add_action("wp_print_scripts", "stAddLinks", "3");
    add_action("get_footer", "stFrontendDisplay", 10, 1);
  }
}

?>
