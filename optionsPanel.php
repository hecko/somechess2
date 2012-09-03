<?PHP
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
//--OPTION PANEL
	echo'<div class="menuBox" style="height:31em;">
		<div class="submenu">
			<a href="menu.php?do=menu&amp;sub=profile" class="subItem">'.$menuStr[16].'</a>';
			if($_SESSION['power']>0)echo'<a href="menu.php?do=menu&amp;sub=invitation" class="subItem">'.$menuStr[17].'</a>';
			echo'<a href="menu.php?do=menu&amp;sub=importPNG" class="subItem">'.$menuStr[18].'</a>
		</div>';
	if($_GET['sub'] == 'profile' || !$_GET['sub']){
//--NAME & PASSWORD CHANGE FORM
		echo'<form action="menu.php" method="post">
			<h2>'.$menuStr[3].'</h2>
			<p>'.$menuStr[19].'<input type="text" name="realname" value="'.$realname.'" /></p>
			<p>'.$menuStr[20].'<input type="text" name="username" value="'.$name.'" /></p>
			<p>'.$menuStr[23].'<input type="text" name="location" value="'.$location.'" /></p>
			<p>'.$menuStr[24].'<input type="text" name="email" value="'.$email.'" /></p>
			<p>'.$menuStr[21].'<input type="password" name="pass1" /></p>
			<p>'.$menuStr[22].'<input type="password" name="pass2" /></p>
			<input type="hidden" name="do" value="chngInfo" />
			<input type="submit" value="'.$buttStr[1].'" class="butt" />
		</form>';
//--UPLOAD USER IMAGE
		if($showPlayerImg)echo'<form action="menu.php" method="post" enctype="multipart/form-data" style="margin-top:2em">
			<h2>'.$menuStr[4].'</h2>
			<input type="hidden" name="MAX_FILE_SIZE" value="512500" />
			<p style="text-align:left;"><input type="file" name="image" id="upimage" /></p>
			<input type="hidden" name="do" value="upload" />
			<input type="submit" value="'.$buttStr[9].'" class="butt" />
		</form>';	
	}elseif($_GET['sub'] == 'importPNG' || !$_GET['sub']){
//--IMPORT PGN
	echo'<form action="menu.php" method="post">
		<h2>'.$menuStr[25].'</h2><br />
		<p>Paste PGN below</p>
		<textarea class="input" name="pgn"></textarea>
		<input type="hidden" name="do" value="importPGN" />
		<input type="submit" value="'.$buttStr[12].'" class="butt" />
	</form>';
	}elseif($_SESSION['power']>0 && $_GET['sub'] == 'invitation'){
//--INVITE A USER
	echo'<form action="menu.php" method="post">
		<h2>'.$menuStr[5].'</h2>
		<p>'.$menuStr[6].'<input type="text" name="name" /></p>
		<p>'.$menuStr[7].'<input type="text" name="email" /></p>
		<input type="hidden" name="friend" value='.$name.' />
		<input type="hidden" name="do" value="invite" />
		<input type="submit" value="'.$buttStr[2].'" class="butt" />
	</form>';
	}
echo'</div>'; //--close extra options div
?>