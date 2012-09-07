<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
function login($userName,$password,$loginStr){
	$userName	= validate($userName);
	$password	= validate($password);
	if(!$userName || !$password){ 	//--are both fields filled in
		return'<div class="error">'.$loginStr[3].'</div>';
	}else{
		$userPassword	= md5($password); 
		$queryPlayers	= 'SELECT id,name,power,pic FROM '.dbPre.'players WHERE name="'.$userName.'" && pword="'.$userPassword.'" && invitedBy > -1';
		$resultPlayers	= mysql_query($queryPlayers)or die(errorDBStr.' (si-1)');
		$numPlayers		= mysql_numrows($resultPlayers);
		if($numUsers > 1){			//--if account name isn't unique
			return'<div class="error">'.$loginStr[4].'</div>';
		}elseif($numPlayers == 0){ 	//--if username isn't found
			return'<div class="error">'.$loginStr[5].'</div>';
		}elseif($numPlayers == 1){ 	//--if login is good
			$id 		= mysql_result($resultPlayers,0,'id');
			$name 		= mysql_result($resultPlayers,0,'name');
			$power 		= mysql_result($resultPlayers,0,'power');
			$pic 		= mysql_result($resultPlayers,0,'pic');
			//session_register('on'); 
			session_start();
			$_SESSION['on'] 	= true;	
			$_SESSION['id'] 	= $id;	
			$_SESSION['name'] 	= $name;
			$_SESSION['power'] 	= $power;	
			$_SESSION['pic'] 	= $pic;	
			return $_SESSION['on'];
		}
	}	
}
function requestQuestion($userName,$loginStr){
	include_once('standard.php');
	$userName	= validate($userName);
	$queryPlayers	= 'SELECT '.dbPre.'secQuestion FROM players WHERE name="'.$userName.'"';
	$resultPlayers	= mysql_query($queryPlayers)or die(errorDBStr.' (rq-1)');
	$numPlayers		= mysql_numrows($resultPlayers);
	if($numUsers > 1){			//--if account name isn't unique
		return false;
	}elseif($numPlayers == 0){ 	//--if username isn't found
		return false;
	}elseif(!mysql_result($resultPlayers,0,'secQuestion')){
		return false;
	}else{	//-- if everything looks good
		return mysql_result($resultPlayers,0,'secQuestion');
	}
}
function requestPass($userName,$answer,$loginStr){
	include_once('standard.php');
	$userName	= validate($userName);
	$answer		= validate($answer);
	if(!$userName || !$answer){ 	//--are both fields filled in
		return'<div class="error reset">'.$loginStr[3].'</div>';
	}else{
		$answer			= md5($answer);	
		$queryPlayers	= 'SELECT id FROM '.dbPre.'players WHERE name="'.$userName.'" && secAnswer="'.$answer.'" && invitedBy > -1';
		$resultPlayers	= mysql_query($queryPlayers)or die(errorDBStr.' (rp-1)');
		$numPlayers		= mysql_numrows($resultPlayers);
		if($numUsers > 1){			//--if account name isn't unique
			return'<div class="error reset">'.$loginStr[4].'</div>';
		}elseif($numPlayers == 0){ 	//--if info doesnt match
			return'<div class="error reset">'.$loginStr[10].'</div>';
		}else{	//-- if everything looks good
			include('menuFunc.php');
			$newPass 	= randomPassword('uVkG!cygExedDItr7#Oj0Pp9MeXwAzF8J4vTmK&qRZSfs5BL3CNhiYlaQnbW6$1HoU2');
			$queryPass	= 'UPDATE '.dbPre.'players SET pword="'.md5($newPass).'" WHERE name="'.$userName.'"';
			$resultPass	= mysql_query($queryPass)or die(errorDBStr.' (rp-2)');
			return '<div class="message">'.$loginStr[11].$newPass.'</div>';
		}
	}
}
?>
