<?php 
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
session_start();
include_once('config.php');
include_once('languages/'.$lang.'_main.php');
include_once('constants.php');
include_once('standard.php');
$name	= validate($_POST['username']);
$pass	= validate($_POST['password']);
if($verifyReg){
	$code 	= validate($_POST['code']);
	$theCode= $_SESSION['theCode'];
	unset($_SESSION['theCode']);
}
if(!$verifyReg || $code === $theCode){
	echo joinChess($name,$pass,$startPower,$regStr);
}elseif($verifyReg || $code !== $theCode){
	$error	= '<div class="error">'.$regStr[5].'</div>';
}else{
	$error	= '<div class="error">'.$regStr[6].'</div>';
}
include_once('index.php');
function joinChess($name,$pass,$startPower,$regStr){
	$name 				= str_replace('-','_',$name);
	$queryPlayers		= 'SELECT id FROM '.dbPre.'players WHERE name="'.$name.'" LIMIT 1';
	$resultPlayers		= mysql_query($queryPlayers)or die('<div class="error">'.errorDBStr.' (rg-1)</div>');	
	$numPlayers			= mysql_num_rows($resultPlayers);
	if($name == $pass){
		return '<div class="error">'.$regStr[9].'</div>';
	}elseif(!$name || !$pass){
		return '<div class="error">'.$regStr[2].'</div>';
	}elseif($numPlayers > 0){
		return '<div class="error">'.$regStr[3].'</div>';
	}elseif(strlen($pass)>15 || strlen($pass) < 6){
		return '<div class="error">'.$regStr[7].'</div>';
	}elseif(strlen($name)>20 || strlen($name) < 5){
		return '<div class="error">'.$regStr[8].'</div>';
	}else{
		$password	= md5($pass);
		$queryJoin 	= 'INSERT INTO '.dbPre.'players (name,pword,power,invitedBy,addDate,pic) VALUES ("'.$name.'","'.$password.'","'.$startPower.'","X","'.time().'","default.png")';
		mysql_query($queryJoin)or die('<div class=error>'.errorDBStr.' (rg-2)</div>');
		return '<div class="message"  style="top:420px;">'.$regStr[4].$name.'</div>';
	}
}
?>
