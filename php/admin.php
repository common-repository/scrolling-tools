<?php
  add_action('admin_menu', 'st_admin_menu');

  function st_admin_menu() {
    add_options_page('Scrolling Tools', 'Scrolling Tools', 'administrator',
		     'scrollingtools', 'stSettings_html_page');
  }

if ($_POST['action'] == "bg") {
    if (isset($_FILES['bgtop']) AND $_FILES['bgtop']['error'] == 0)
      if ($_FILES['bgtop']['size'] <= 1000000)
	move_uploaded_file($_FILES['bgtop']['tmp_name'], $curImagesPath.'bgTop.png') or die("st_error 43");

    if (isset($_FILES['bgmiddle']) AND $_FILES['bgmiddle']['error'] == 0)
      if ($_FILES['bgmiddle']['size'] <= 1000000)
	move_uploaded_file($_FILES['bgmiddle']['tmp_name'], $curImagesPath.'bgMiddle.png') or die("st_error 43");

    if (isset($_FILES['bgbottom']) AND $_FILES['bgbottom']['error'] == 0)
      if ($_FILES['bgbottom']['size'] <= 1000000)
	move_uploaded_file($_FILES['bgbottom']['tmp_name'], $curImagesPath.'bgBottom.png') or die("st_error 43");
}

if ($_POST['action'] == "display") {
  update_option("st_display", $_POST['value']);
  $display = $_POST['value'];
}

if ($_POST['action'] == "bgReseting") {
  @copy('../wp-content/plugins/'.$pluginDirName.'images/saved/bgTop.png', $curImagesPath.'bgTop.png') or die("st_error 44");
  @copy('../wp-content/plugins/'.$pluginDirName.'images/saved/bgMiddle.png', $curImagesPath.'bgMiddle.png') or die("st_error 44");
  @copy('../wp-content/plugins/'.$pluginDirName.'images/saved/bgBottom.png', $curImagesPath.'bgBottom.png') or die("st_error 44");
}

if ($_POST['action'] == "allReseting") {
  cpDirectory('../wp-content/plugins/'.$pluginDirName.'images/saved/', $curImagesPath);
  update_option("st_style", $saved_style);
  update_option("st_items", $saved_items);
  refreshPage();
}

if ($_POST['action'] == "advanced") {
  $str = serialize($_POST);
  update_option("st_advanced", $str);
  refreshPage();
}

if ($_POST['action'] == "style") {
  $str = serialize($_POST);
  update_option("st_style", $str);
  refreshPage();
}

if ($_POST['action'] == "delitem") {
  $items = unserialize(get_option("st_items"));
  if (file_exists($curImagesPath.$items[$_POST['id']]['id'].'.png')) {
    // delete image
    unlink($curImagesPath.$items[$_POST['id']]['id'].'.png');
  }

  for ($i = ($_POST['id']+1); $items[$i]; $i++)
    $items[$i-1] = $items[$i];
  unset($items[$i-1]);

  update_option("st_items", serialize($items));
  refreshPage();
}

if ($_POST['action'] == "edititem") {
  $items = unserialize(get_option("st_items"));
  $items[$_POST['id']]['type'] = $_POST['type'];
  $items[$_POST['id']]['link'] = $_POST['link'];
  $items[$_POST['id']]['rank'] = $_POST['rank'];

  if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0)
    if ($_FILES['image']['size'] <= 100000)
      move_uploaded_file($_FILES['image']['tmp_name'], $curImagesPath.$items[$_POST['id']]['id'].'.png') or die("st_error 42");

  update_option("st_items", serialize($items));
  refreshPage();
}


if ($_POST['action'] == "additem") {
  $items = unserialize(get_option("st_items"));
  $id = $_POST['type'].substr(sha1(date("U")), 3, 5);
  $items[] = Array("id" => $id, "type" => $_POST['type'], "link" => "", "rank" => "0");
  update_option("st_items", serialize($items));
  refreshPage();
}



function stSettings_html_page() {
  global $pluginPath;
  global $st_advanced;
  global $st_style;
  global $st_items;
  global $display;
  global $about;
  global $curImagesPath;
  global $pluginDirName;

  $writable = "ko";
  if (is_writable($curImagesPath))
    $writable = "ok";
  else {
    // chmod...
  }

  $types = Array("scrolltop", "mailto", "popup", "link");

  ?>


  <link rel="stylesheet" href="<?php echo $pluginPath; ?>css/stStyles.css" />
     <script type="text/javascript" src="<?php echo $pluginPath; ?>js/adminStScripts.js"></script>

     <h1>Scrolling Tools - Settings</h1>


     <div id="preview">
     <div id="help">
     &middot; You have a question ? You need help ? <a href="http://www.watchmymind.com/2011-05/scrolling-tools-a-wordpress-plugin-using-jquery/">Check out the english documentation.</a><br />
		&middot; Une question ? Besoin d'aide ? <a href="http://www.watchmymind.com/2011-05/scrolling-tools-un-plugin-wordpress-sous-jquery/">Visitez la documentation en français.</a>
</div>
     <h2>Preview</h2>
     <br /><br />
    <?php stDisplay("backend"); ?>
     </div>

     <form id="enabling" method="post">
<input type="hidden" name="action" value="display" />
<?php     if ($display == "ko") { ?>
<input type="hidden" name="value" value="ok" />
<span class="notenabled">The plugin is currently not displayed in your website</span> - <input type="submit" value="Enable scrolling Tools !" />
    <?php } else { ?>
<input type="hidden" name="value" value="ko" />
<span class="enabled">The plugin is currently displayed in your website</span> - <input type="submit" value="Disable scrolling Tools !" />
    <?php } ?>
<?php
if ($writable != "ok") { ?>
<br /><span class="notenabled">The '/plugins/<?php echo $pluginDirName; ?>images/current/' repository and its content is not writable, please change permissions recursively on the folder.</span>
<?php } ?>


</form>


     <div class="fieldContainer">

     <a><h2 id="distancesH2">Position</h2></a>
     <div id="distancesContent" class="fieldContent">
     <form method="post">
     <input type="hidden" name="action" value="style" />
     <div class="formRow" id="distMiddle">
     <div class="label">Distance from middle</div>
     <div class="input"><input type="text" name="distMiddle" value="<?php echo $st_style['distMiddle']; ?>"> px, 
to the <select name="side"><option value="left" <?php if ($st_style['side'] == "left") { echo "selected"; }?> >left</option><option value="right" <?php if ($st_style['side'] == "right") { echo "selected"; }?>>right</option></select>
</div>
     </div>

     <div class="formRow" id="distTop">
     <div class="label">Distance from Top</div>
     <div class="input"><input type="text" name="distTop" value="<?php echo $st_style['distTop']; ?>"> px</div>
     </div>

     <div class="formRow" id="distFadeout">
     <div class="label">FadeOut Distance</div>
     <div class="input"><input type="text" name="distFadeout" value="<?php echo $st_style['distFadeout']; ?>"> px</div>
     </div>

     <br />
     <input type="submit" value="Submit">
     </form>
     </div>

     </div>





     <div class="fieldContainer">

     <a><h2 id="bgH2">Background</h2></a>
     <div class="fieldContent" id="bgContent">

<?php if ($writable != "ok") { ?>
<br /><br /><span class="notenabled">The '/plugins/<?php echo $pluginDirName; ?>images/current/' repository and its content is not writable. You can not change backgrounds</span><br /><br />
<?php } else { ?>
     <form method="post"  id="bgReseting">
<input type="hidden" name="action" value="bgReseting" />
</form>
     <form method="post"  enctype="multipart/form-data" >
     <input type="hidden" name="action" value="bg" />

     <div class="formRow" id="bgTop">
     <div class="label">Background Top</div>
     <div class="input"><input type="file" name="bgtop" /></div>
     </div>

     <div class="formRow" id="bgMiddle">
     <div class="label">Background Middle</div>
     <div class="input"><input type="file" name="bgmiddle" /></div>
     </div>

     <div class="formRow" id="bgBottom">
     <div class="label">Background Bottom</div>
     <div class="input"><input type="file" name="bgbottom" /></div>
     </div>

     <br />
<a id="bgReset" href="javascript:void(0);">Reset background</a>
     <input type="submit" value="Submit">
     </form>
<?php } ?>
     </div>

     </div>





     <div class="fieldContainer">

     <a><h2 id="itemsH2">Items</h2></a>
     <div class="fieldContent" id="itemsContent">


     <div class="itemRow" style="font-weight:bold;">
     <div class="itemImg">Logo</div>
     <div class="itemType">Type</div>
     <div class="itemLink" style="font-size:12px;">Link / E-mail</div>
     <div class="itemRank">Rank</div>
     <div class="itemAction"></div>
     </div>

     <?php
     for ($i = 0; $st_items[$i]; $i++) {
       if (file_exists($curImagesPath.$st_items[$i]['id'].".png"))
	 $image = $pluginPath."images/current/".$st_items[$i]['id'].".png";
       else
	 $image = $pluginPath."images/saved/noimage.png";

       ?>

       <div class="itemRow">
       <div class="itemImg"><img src="<?php echo $image; ?>" alt="scrolling Item" /></div>
       <div class="itemType"><?php echo $st_items[$i]['type']; ?></div>
       <div class="itemLink"><?php echo $st_items[$i]['link']; ?></div>
       <div class="itemRank"><?php echo $st_items[$i]['rank']; ?></div>
       <div class="itemAction"><button class="editItem" id="editItem-<?php echo $i; ?>">Edit</button></div>
       </div>

       <form id="deletingItem-<?php echo $i; ?>" method="post"><input type="hidden" name="id" value="<?php echo $i; ?>" /><input type="hidden" name="action" value="delitem" /></form>

       <form class="editItemRow" id="editItemRow-<?php echo $i; ?>" method="post"  enctype="multipart/form-data" >
       <input type="hidden" name="action" value="edititem" />
       <input type="hidden" name="id" value="<?php echo $i; ?>" />
       <div class="editLabel">Logo</div> <input type="file" name="image" /><br />
       <div class="editLabel">Type</div> <select name="type">
       <?php for ($j = 0; $types[$j]; $j++) {
       echo "<option id='".$types[$j]."' ";
       if ($types[$j] == $st_items[$i]['type'])
	 echo "selected";
       echo " >".$types[$j]."</option>";
       } ?>
       </select><br />
	   <div class="editLabel">Link / E-mail</div> <input type="text" name="link" value="<?php echo $st_items[$i]['link']; ?>" /><br />
	   <div class="editLabel">Rank</div> <input type="text" name="rank" value="<?php echo $st_items[$i]['rank']; ?>" /><br /><br />

	   <a href="javascript:void(0);" class="delItem" id="delItem-<?php echo $i; ?>">Delete this item</a>
	   <input type="submit" value="Edit" />
	   </form>


	   <?php  } ?>

  <br /><hr />
     <br />

     <form method="post">
     <input type="hidden" name="action" value="additem">
     <b>Add a new item</b> ------>

     Type : <select name="type">
     <?php for ($j = 0; $types[$j]; $j++) {
     echo "<option id='".$types[$j]."' ";
     if ($types[$j] == $st_items[$i]['type'])
       echo "selected";
     echo " >".$types[$j]."</option>";
} ?>
  </select>
  - <input type="submit" value="add" />
    </form>

<div class="infos">
<b>Informations.</b><br />
<span>The <b>rank</b> field determines the order of the item. If you put 0 as rank, the item will be hidden.<br /><br />
If you add a social network sharing item (as facebook, twitter, ...) you may need to indicate the current URL. A <b>%s</b> in your link will do that.<br />
Ex. "http://www.facebook.com/share.php?u=%s" could become "http://www.facebook.com/share.php?u=www.watchmymind.com"
</span>
</div>
    </div>

    </div> <!-- .fieldContainer -->












     <div class="fieldContainer">

     <a href="#advancedH2"><h2 id="advancedH2">Advanced</h2></a>
     <div id="advancedContent" class="fieldContent">
<form method="post" id="allReseting"><input type="hidden" name="action" value="allReseting"></form>
     <form method="post">
     <input type="hidden" name="action" value="advanced" />
     <div class="formRow" id="distMiddle">
     <div class="label">Width</div>
     <div class="input"><input type="text" name="width" value="<?php echo $st_advanced['width']; ?>"> px</div>
     </div>


     <br />
<?php if ($writable != "ok") { ?>
<br /><br /><span class="notenabled">The '/plugins/<?php echo $pluginDirName; ?>images/current/' repository and its content is not writable. You can not reset data.</span><br /><br />
<?php } else { ?>
<a id="allReset" href="javascript:void(0);">Reset all data</a>
<?php } ?>
     <input type="submit" value="Submit">
     </form>
     </div>

     </div>








     <div class="fieldContainer">

     <a href="#aboutH2"><h2 id="aboutH2">About</h2></a>
     <div id="aboutContent" class="fieldContent">
<?php
 foreach ($about as $key => $value) {
echo '<b>'.$key.'. </b> '.$value.'<br />';
}
?>

     </div>
     </div>





    <?php  } ?>