<?php

$saved_style = 'a:4:{s:6:"action";s:5:"style";s:10:"distMiddle";s:3:"580";s:7:"distTop";s:3:"140";s:11:"distFadeout";s:3:"140";}';

$saved_items = 'a:8:{i:0;a:4:{s:2:"id";s:14:"scrolltop3bfcd";s:4:"type";s:9:"scrolltop";s:4:"link";s:0:"";s:4:"rank";s:2:"10";}i:1;a:4:{s:2:"id";s:9:"link4a8d6";s:4:"type";s:5:"popup";s:4:"link";s:38:"http://www.facebook.com/share.php?u=%s";s:4:"rank";s:2:"20";}i:2;a:4:{s:2:"id";s:9:"linkd87e1";s:4:"type";s:5:"popup";s:4:"link";s:39:"http://twitter.com/intent/tweet?text=%s";s:4:"rank";s:2:"30";}i:3;a:4:{s:2:"id";s:10:"share2ffd1";s:4:"type";s:4:"link";s:4:"link";s:53:"http://www.linkedin.com/shareArticle?mini=true&url=%s";s:4:"rank";s:2:"40";}i:4;a:4:{s:2:"id";s:10:"shareeedc7";s:4:"type";s:4:"link";s:4:"link";s:44:"http://www.blogger.com/blog_this.pyra?t&u=%s";s:4:"rank";s:2:"50";}i:5;a:4:{s:2:"id";s:10:"sharefc9e8";s:4:"type";s:5:"popup";s:4:"link";s:45:"http://www.delicious.com/save?jump=yes&url=%s";s:4:"rank";s:2:"60";}i:6;a:4:{s:2:"id";s:9:"link47f27";s:4:"type";s:4:"link";s:4:"link";s:7:"%sfeed/";s:4:"rank";s:2:"70";}i:7;a:4:{s:2:"id";s:11:"mailto65714";s:4:"type";s:6:"mailto";s:4:"link";s:20:"my_email@website.com";s:4:"rank";s:2:"80";}}';

$about = Array(
	       "Author" => "Franck Kosellek",
	       "Website" => "<a href='http://www.watchmymind.com' target='blank'>www.watchmymind.com</a>",
	       "E-mail" => "franck@kosellek.fr",
	       "Version" => "0.4.2 - beta"
);

$pluginDirName = str_replace("php/".basename( __FILE__),"",plugin_basename(__FILE__));
$pluginPath = WP_PLUGIN_URL."/".$pluginDirName;
$curImagesPath = "../wp-content/plugins/".$pluginDirName."images/current/";

$display = get_option("st_display");
$st_style = unserialize(get_option("st_style"));
$st_advanced = unserialize(get_option("st_advanced"));
$st_items = unserialize(get_option("st_items"));








?>