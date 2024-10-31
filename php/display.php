<?php

function stDisplay($flag) {
  global $pluginDirName;
  global $pluginPath;
  global $st_style;
  global $st_advanced;
  global $st_items;

  $items = Array();
  for ($i = 0; $st_items[$i]; $i++) {
    if ($st_items[$i]['rank'] != "0" && $st_items[$i]['rank'] != "") {
      $items[$st_items[$i]['rank']] = $st_items[$i];
    }
  }
  ksort($items);



  $val = '';

  if ($flag == "frontend") {
    $style = "";
    $relativePath = "./wp-content/plugins/".$pluginDirName."/images/current/";
  } else {
    $style = 'style="display:block; margin-left:100px; position:absolute;; "';
    $relativePath = "../wp-content/plugins/".$pluginDirName."/images/current/";
  }

  $val .= '<div id="scrollingTools" '.$style.' >';


  /*   TOP OF THE BOX */
  $val .= '<div class="stTop"><img src="'.$pluginPath.'images/current/bgTop.png" alt="top image scrolling tools" /></div>';

  /*   MIDDLE OF THE BOX : DISPLAY ITEMS */
  $val .= '<div class="stMiddle">';

  $flag = 0;
  foreach($items as $key => $value) {
    $value['link'] = str_replace("%s", curPageURL(), $value['link']);
    $target="";
    if (file_exists($relativePath.$value['id'].".png"))
      $image = $pluginPath."images/current/".$value['id'].".png";
    else
      $image = $pluginPath."images/saved/noimage.png";
    if ($value['type'] == "scrolltop")
      $link = "javascript:void(0);";
    else if ($value['type'] == "mailto")
      $link = "mailto:".$value['link'];
    else if ($value['type'] == "link") {
      $link = $value['link'];
      $target="target='blank'";
    }
    else if ($value['type'] == "popup") {
      $link = "javascript:void(0);";
      $val .= "<div style='display:none;' id='link-".$value['id']."'>".$value['link']."</div>";
/*       $val .= "<input type='hidden' id='link-".$value['id']."' value='".$value['link']."' />"; */
    }

    if ($flag != 0)
      $val .= "<br />";
    $val .= "<a href='".$link."' class='".$value['type']."' ".$target." >";
    $val .= "<img src='".$image."' alt='".$value['id']."'  id='but-".$value['id']."' />";
    $val .= "</a>";
    $flag++;
  }

  $val .= '</div>'; /* end of the middle */

  /*      BOTTOM OF THE BOX */
  $val .= '<div class="stBottom"><img src="'.$pluginPath.'images/current/bgBottom.png" alt="bottom image scrolling tools" /></div>';


  $val .= '</div>'; /* end of the scrollingTools div */

  echo $val;

}

function stFrontendDisplay() {
  stDisplay("frontend");
}


function stAddLinks() {
  global $st_style;
  global $pluginPath;
  global $st_advanced;

  $val = '';
  $val .= '<script type="text/javascript">';
  $val .= 'var distFadeout = "'.$st_style['distFadeout'].'"; ';
  $val .= 'var distMiddle = "'.$st_style['distMiddle'].'"; ';
  $val .= 'var side = "'.$st_style['side'].'"; ';
  $val .= '</script>';

  $val .= '<script type="text/javascript" src="'.$pluginPath.'js/jquery-1.4.2.js"></script>';
  $val .= '<script type="text/javascript" src="'.$pluginPath.'js/stScripts.js"></script>';
  $val .= '<link rel="stylesheet" href="'.$pluginPath.'css/stStyles.css" />';

  $val .= '<style type="text/css">';
  $val .= '#scrollingTools { top:'.$st_style['distTop'].'px; width:'.$st_advanced['width'].'px; }';
  $val .= '</style>';

  echo $val;
}

?>