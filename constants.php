<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
define('dbPre',$dbPre);
define('deleteChat',$deleteChat);
define('deleteMoves',$deleteMoves);
define('version','2.0 (release candidate 1)');
define('shortVer','2.0rc1');
$menu = '<div style="position:absolute;top:0.5em;right:0.7em;">
<a href="menu.php?do=menu" class="menuHeadLink">[ '.$mainMenuStr[0].' ]&nbsp;</a>
<a href="menu.php?do=logout" class="menuHeadLink">[ '.$mainMenuStr[2].' ]&nbsp;</a>
<a href="menu.php?do=about" class="menuHeadLink">[ '.$mainMenuStr[1].' ]&nbsp;</a>
</div>';
define('imgDir','img/');
define('imgExt','.png');
?>