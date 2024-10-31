<?php

function refreshPage() {
  header("location: ".curPageURL());
}

function curPageURL() {
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}

function cpDirectory($Directory, $target){

  $MyDirectory = opendir($Directory) or die('Erreur');
  while($Entry = @readdir($MyDirectory)) {
    if($Entry != '.' && $Entry != '..')
      @copy($Directory.$Entry, $target.$Entry);
  }
  closedir($MyDirectory);
}


?>