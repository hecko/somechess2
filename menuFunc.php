<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
function chngInfo($username,$pass1,$pass2,$realname,$location,$email,$secQuestion,$secAnswer,$menuFuncStr){
	$queryPlayers		= 'SELECT name FROM '.dbPre.'players WHERE name="'.$username.'" && id !="'.$_SESSION['id'].'"';
	$resultPlayers		= mysql_query($queryPlayers)or die('<div class="error">'.errorDBStr.' (ci-1)</div>');	
	$namedPlayers		= mysql_num_rows($resultPlayers);	
	if($secQuestion && strlen($secQuestion) > 90){ 
		return '<div class="error">'.$menuFuncStr[25].'</div>';
	}elseif(strlen($username)>20 || strlen($username)<5){
		return '<div class="error">'.$menuFuncStr[24].'</div>';
	}elseif($namedPlayers>0){
		return '<div class="error">'.$menuFuncStr[8].'</div>';	
	}
	
	if(($pass1 && !$pass2) || (!$pass1 && $pass2)){
		return '<div class="error">'.$menuFuncStr[1].'</div>';
	}elseif($pass1 !== $pass2){
		return '<div class="error">'.$menuFuncStr[2].'</div>';
	}elseif($pass1 && (strlen($pass1)>15 || strlen($pass1)<6)){
		return '<div class="error">'.$menuFuncStr[23].'</div>';
	}elseif($username == $pass1){
		return '<div class="error">'.$menuFuncStr[26].'</div>';
	}elseif($pass1){
		$newPass	= md5($pass1);
		$queryPass 	= 'UPDATE '.dbPre.'players SET pword="'.$newPass.'" WHERE id="'.$_SESSION['id'].'"';
		mysql_query($queryPass)or die('<div class="error">'.errorDBStr.' (ci-2)</div>');
		$done = $menuFuncStr[3];
	}
	if($email) 		$email		= ' email="'.$email.'",';
	if($location) 	$location	= ' location="'.$location.'",';
	if($realname) 	$realname	= ' realname="'.$realname.'",';
	if($username) 	$usernameDB	= ' name="'.str_replace('-','_',$username).'",';
	if($secQuestion) $secQuestionDB	= ' secQuestion="'.$secQuestion.'",';
	if($secAnswer) 	$secAnswerDB	= ' secAnswer="'.$secAnswer.'",';
	$setDB	= substr(($email.$location.$realname.$usernameDB.$secQuestionDB.$secAnswerDB),'0',-1);
	if(!$username && !$pass1 && !$pass2 && !$realname && !$location && !$email && !$secQuestion && !$secAnswer){
		return '<div class="error">'.$menuFuncStr[5].'</div>';
	}else{
		$queryProfile 	= 'UPDATE '.dbPre.'players SET '.$setDB.' WHERE id="'.$_SESSION['id'].'" LIMIT 1';
		mysql_query($queryProfile)or die('<div class="error">'.errorDBStr.' (ci-3)</div>');
		if($done) $done .= ' &amp; ';
		$done .= $menuFuncStr[4];
		$_SESSION['name'] = $username;
	}
	return $done;
}
function invite($name,$email,$friend,$domain,$homeFolder,$startPower,$menuFuncStr){
	$queryPlayers		= 'SELECT name FROM '.dbPre.'players WHERE name="'.$name.'"';
	$resultPlayers		= mysql_query($queryPlayers)or die('<div class="error">'.errorDBStr.' (iv-1)</div>');	
	$namedPlayers		= mysql_num_rows($resultPlayers);
	$invDate			= date("Y-m-d");
	if(!$name || !$email){
		return '<div class="error">'.$menuFuncStr[6].'</div>';
	}elseif(strpos($email,'@') === false || strpos($email,'.') === false){
		return '<div class="error">'.$menuFuncStr[7].'</div>';
	}elseif($namedPlayers>0){
		return '<div class="error">'.$menuFuncStr[8].'</div>';
	}else{
		$rPassword	= randomPassword('tkmF#w8EcRzW6GvOPfcgNsQD1hArU4Y$Lx2a7Mu0jT3B!q5SyXJCheInpKZbHV9'); 
		$password	= md5($rPassword); 	
		$subject	= $menuFuncStr[9];
		$headers  	= 'MIME-Version: 1.0
Content-type: text/plain; charset=iso-8859-1
X-Priority: 3
X-Mailer: Some Chess
';
		$headers 	.= 'From: "Some Chess" <somechess@'.$domain.'>';
		$message	= $menuFuncStr[10].$friend.$menuFuncStr[11].$domain.$homeFolder.$menuFuncStr[22].$name.$menuFuncStr[12].$rPassword.$menuFuncStr[13];
		$message = wordwrap($message,100);
		mail($email,$subject,$message,$headers);
		$queryInvite 	= 'INSERT INTO '.dbPre.'players (name,pword,power,invitedBy,addDate,pic) VALUES ("'.$name.'","'.$password.'","'.$startPower.'","'.$_SESSION['id'].'","'.$invDate.'","default.png")';
		mysql_query($queryInvite)or die('<div class=error>'.errorDBStr.' (iv-2)</div>');
		return $menuFuncStr[14];
	}
}
function randomPassword($group){ 
	for($p=0;$p<10;++$p){ 
		$rNum 	= rand(0,((double) microtime()* 1000000)) % 67;
		if($rNum>58) $p = $p - 1;
		$letter	= substr ($group ,$rNum ,1); 
		$pass 	= $pass.$letter;
	}
	return $pass;
}
function upload($file,$playerImgDir,$menuFuncStr){
	$folder 	= $playerImgDir.'/';	
	$maxSize 	= 4100000;
	$goodExts 	= array('jpeg','png','gif','jpg','JPEG','PNG','GIF','JPG',);
	if(!$file['name']) return '<div class="error">'.$menuFuncStr[15].'</div>';
	if($file['size']<1){
		return '<div class="error">'.$menuFuncStr[16].' '.$file['size'].'</div>';
	}elseif($file['size'] > $maxSize){
		return '<div class="error">'.$menuFuncStr[17].'</div>';
	}elseif(!getimagesize($file['tmpName'])){
		return '<div class="error">'.$menuFuncStr[18].'</div>';
	}	
	$fileExt	= substr($file['name'],(strrpos($file['name'],'.')+1));	
	$fileName	= $_SESSION['id'].'.png';
	if(!is_uploaded_file($file['tmpName'])) return '<div class="error">'.$menuFuncStr[18].'</div>';
	if(!in_array($fileExt,$goodExts)) return'<div class="error">'.$menuFuncStr[19].' '.$fileExt.'</div>';
	if($file['error']) return '<div class="error">'.$menuFuncStr[18].'</div>';
	if(move_uploaded_file($file['tmpName'],$folder.$fileName)){
		resizeImg($fileName,$playerImgDir,$fileExt);
		$queryPic	='UPDATE '.dbPre.'players SET pic="'.$_SESSION['id'].'.png" WHERE id="'.$_SESSION['id'].'" LIMIT 1';
		mysql_query($queryPic)or die('<div class="error">'.errorDBStr.' (pi-1)</div>');
		return $menuFuncStr[20];
	}else{
		return'<div class="error">'.$menuFuncStr[21].'</div>';
	}
}
function resizeImg($fileName,$playerImgDir,$fileExt,$size=85){
	if($fileExt == 'jpg' || $fileExt == 'JPG' || $fileExt == 'JPEG' || $fileExt == 'jpeg'){ 
		$oldImg = imagecreatefromjpeg($playerImgDir.'/'.$fileName);
	}elseif($fileExt == 'gif' || $fileExt == 'GIF'){
		$oldImg = imagecreatefromgif($playerImgDir.'/'.$fileName);
	}elseif($fileExt == 'png' || $fileExt == 'PNG'){
		$oldImg = imagecreatefrompng($playerImgDir.'/'.$fileName);
	}
	$newImg 	= imagecreatetruecolor($size,$size);
	$newName	= preg_replace('/\.\w*/','.png',$fileName);
	imagecopyresized($newImg,$oldImg,0,0,0,0,$size,$size,imagesx($oldImg),imagesy($oldImg));
	unlink($playerImgDir.'/'.$fileName);
	imagepng($newImg,($playerImgDir.'/'.$newName));
}
function importPGN($pgn){
	$pgn 	= trim(preg_replace('/\[.*\]/','',$pgn));
	$moves	= preg_split('/\d*\./',$pgn);
	$movesNum = count($moves);
	for($i=1;$i<$movesNum;++$i){
		$moveSet 	= explode(' ',$moves[$i]);
		$queryMove	='INSERT INTO '.dbPre.'moves (gameID,moveNum,whiteMove,blackMove) VALUES ("'.$newGameID.'","'.$i.'","'.$moveSet[0].'","'.$moveSet[1].'")';
		mysql_query($queryMove)or die('<div class="error">'.errorDBStr.' (pg-1)</div>');
	}
	if($moveSet[1] == ''){
		$nextMoveNum 	= $i;
		$nTC 			= 'black';
		$lastMove		= $moveSet[0];
	}else{
		$nextMoveNum 	= ++$i;
		$nTC 			= 'white';
		$lastMove		= $moveSet[1];
	}
	$queryGame	='INSERT INTO '.dbPre.'games (whitePlayerID,blackPlayerID,nextMoveNum,nextTurnColor,lastMove) VALUES (998,999,"'.$nextMoveNum.'","'.$nTC.'","'.$lastMove.'")';
	mysql_query($queryMove)or die('<div class="error">'.errorDBStr.' (pg-2)</div>');
}
?>