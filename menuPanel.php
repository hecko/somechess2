<?PHP
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
//--OPTION PANEL
	echo'<div class="menubox" style="height:36em;">
		<div class="submenu">
			<a href="menu.php?do=menu&amp;sub=new_game" class="subitem">'.$menuStr[35].'</a><a href="menu.php?do=menu&amp;sub=profile" class="subitem">'.$menuStr[16].'</a>';
			if($_SESSION['power']>0)echo'<a href="menu.php?do=menu&amp;sub=invitation" class="subitem">'.$menuStr[17].'</a>';
			echo'<a href="menu.php?do=menu&amp;sub=importPNG" class="subitem">'.$menuStr[18].'</a>
		</div>
		';
	if($_GET['sub'] == 'new_game' || !$_GET['sub']){
//--START NEW GAME & USERS ONLINE
	echo'<form action="menu.php" method="post" class="small_window">
		<h2>'.$menuStr[0].'</h2>
		<p>'.$menuStr[1].'<select name="vs"><option value=""></option>';
	for($i=0;$i<$numVS;++$i){
		$key	= $VSid[$i];
		if($_SESSION['id'] != $key){
			echo'<option value="'.$key.'">'.$VSname[$key].'</option>';
		}
	}
	echo'</select></p>
		<p>'.$menuStr[2].'<select name="color">
			<option value="white">'.$colorStr[0].'</option>
			<option value="black">'.$colorStr[1].'</option>
		</select></p>
		<input type="hidden" name="do" value="newGame" />
		<input type="submit" value="'.$buttStr[0].'" class="butt" />
	</form>';
	//--SHOW PLAYER QUICK STATS	
		$wins	= mysql_result($resultPlayer,0,'wins');
		$loses	= mysql_result($resultPlayer,0,'loses');
		$draws	= mysql_result($resultPlayer,0,'draws');
		$points	= round(mysql_result($resultPlayer,0,'points'));
		$played	= $wins + $loses + $draws;
		echo'<div class="small_window">
			<h3>',$statsStr[31],'</h3>
			<img src="',$playerImgDir,'/',$_SESSION['pic'],'" style="margin-right:1em;float:right;border:1px solid #999" />
			<p><span class="left_column">'.$statsStr[27].':</span>'.$wins.'</p>
			<p><span class="left_column">'.$statsStr[28].':</span>'.$loses.'</p>
			<p><span class="left_column">'.$statsStr[29].':</span>'.$draws.'</p>
			<p><span class="left_column">'.$statsStr[17].':</span>'.$points.'</p>
			<p><span class="left_column">'.$statsStr[30].':</span>'.$played.'</p>
		</div>';
	//--SHOW PLAYERS THAT ARE ONLINE
		$onNum = 0;
		for($i=0;$i<$numVS;++$i){
			if ((mysql_result($resultVS,$i,'lastOnline') + 900) >= time()) {
				$onliners .= '<a href="players.php?statID='.mysql_result($resultVS,$i,'id').'">'.mysql_result($resultVS,$i,'name').'</a> &bull; ';
				++$onNum;
			}
		}
		echo'<div class="small_window" style="height:10em;overflow:auto">
		<h3>'.$menuStr[8].' ('.$onNum.')</h3>
		<p>',(substr($onliners,0,-8)),'</p>
		</div>';
	}elseif($_GET['sub'] == 'profile'){
//--PROFILE DETAILS
		echo'<form action="menu.php" method="post" class="small_window">
			<h2>'.$menuStr[3].'</h2>
			<p>'.$menuStr[19].'<input type="text" name="realname" value="'.$realname.'" /></p>
			<p>'.$menuStr[20].'<input type="text" name="username" value="'.$name.'" /></p>
			<p>'.$menuStr[23].'<input type="text" name="location" value="'.$location.'" /></p>
			<p>'.$menuStr[24].'<input type="text" name="email" value="'.$email.'" /></p>
			<p>'.$menuStr[21].'<input type="password" name="pass1" /></p>
			<p>'.$menuStr[22].'<input type="password" name="pass2" /></p>
			<p>'.$menuStr[36].'<input type="text" name="sec_question" /></p>
			<p>'.$menuStr[37].'<input type="password" name="sec_answer" /></p>
			<input type="hidden" name="do" value="chngInfo" />
			<input type="submit" value="'.$buttStr[1].'" class="butt" />
		</form>
		';
//--UPLOAD USER IMAGE
		if($showPlayerImg)echo'<form action="menu.php" method="post" enctype="multipart/form-data" class="small_window">
			<h2>'.$menuStr[4].'</h2>
			<input type="hidden" name="MAX_FILE_SIZE" value="512500" />
			<p style="text-align:left;"><input type="file" name="image" id="upimage" /></p>
			<input type="hidden" name="do" value="upload" />
			<input type="submit" value="'.$buttStr[9].'" class="butt" />
		</form>';	
	}elseif($_GET['sub'] == 'importPNG' || !$_GET['sub']){
//--IMPORT PGN
	echo'<form action="menu.php" method="post" class="small_window">
		<h2>'.$menuStr[25].'</h2><br />
		<h3>'.$menuStr[38].'</h3>
		<textarea class="input" name="pgn"></textarea>
		<input type="hidden" name="do" value="importPGN" />
		<input type="submit" value="'.$buttStr[12].'" class="butt" />
	</form>';
	}elseif($_SESSION['power']>0 && $_GET['sub'] == 'invitation'){
//--INVITE A USER
	echo'<form action="menu.php" method="post" class="small_window">
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
