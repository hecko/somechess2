<?php
include_once('standard.php');
define('dbPre',$dbPre);
define('deleteChat',$deleteChat);
define('deleteMoves',$deleteMoves);
$menu = '<div style="position:absolute;top:0.5em;right:0.7em;">
<a href="menu.php?do=menu" class="menuHeadLink">[ '.$mainMenuStr[0].' ]&nbsp;</a>
<a href="menu.php?do=logout" class="menuHeadLink">[ '.$mainMenuStr[2].' ]&nbsp;</a>
<a href="menu.php?do=about" class="menuHeadLink">[ '.$mainMenuStr[1].' ]&nbsp;</a>
</div>';
define('imgDir','img/');
define('imgExt','.png');
online(); //update this persons online status
?>
