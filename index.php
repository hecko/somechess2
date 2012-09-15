<?php 
include('header.php');

if ($_GET['u']!='') {
	$username = $_GET['u'];
}

include_once('config.php');
if(!$host || !$dbUser || !$dbPass || !$database){ echo '<div style="background:#ccc;line-height:2em">please enter MySQL connection info in the config.php file<br />	
veuillez écrire l\'information de raccordement de MySQL dans le dossier de config.php <br />
MySQL Anschlußinfo in die config.php Akte bitte eintragen<br />
fornire prego il collegamento Info di MySQL nella lima di config.php<br />
incorporar por favor la conexión Info de MySQL al archivo de config.php <br />
введите соединение информация в файле config.php<br />
incorporar por favor a conexão info de MySQL à lima de config.php<br />
config.php 파일에 있는 MySQL 연결 정보에 들어가십시오<br />
config.phpファイルにMySQLの関係インフォメーションを書き入れなさい<br />
进入MySQL的连接信息,请在config.php文件</div>'; die;} 
include_once('languages/'.$lang.'_main.php');
include_once('constants.php');
//--LOGIN FORM
$loginForm = '<form action="menu.php" method="post">
	<div>
		<p>'.$loginStr[1].' <input type="text" name="username" value="'.$username.'"/></p>
		<p>'.$loginStr[2].' <input type="password" name="password" /></p>
		<input type="submit" value="'.$loginStr[0].'" class="butt" />
		<input type="hidden" name="do" value="login" />
	</div>
	<a href="index.php?help=lost" id="lostpass">'.$loginStr[8].'</a>
</form>
';
//--INSTALL OR UPDATE
if(file_exists('install.php')){
	include('install.php');
	$installed 	= installCheck();
	$updated	= updateCheck();
	if(!$installed){
		$install = install($database,$indexStr);
		if($install) echo '<div class="message">'.$install.'</div>';
	}elseif(!$updated){
		$udpate = update($indexStr);
		if($udpate) echo '<div class="message">'.$udpate.'</div>';
	}
}
//--RESET PASSWORD
$help = ($_POST['help']) ? $_POST['help'] : $_GET['help'];
if($help === 'lost'){
echo'<form action="index.php" method="post" id="lost">
	<div>
		<p>'.$loginStr[1].' <input type="text" name="username" /></p>
		<input type="submit" value="'.$buttStr[0].'" class="butt" />
		<input type="hidden" name="help" value="lost2" />
	</div>
</form>';
}elseif($help === 'lost2'){
	include_once('login.php');
	$name 		= $_POST['username'];
	$question	= requestQuestion($name,$loginStr);
	if(!$question){
		echo $loginForm.'
		<div class="error">'.$loginStr[10].'</div>';
	}else{
echo'<form action="index.php" method="post" id="lost">
	<div>
		<p style="margin-left:2em;text-align:left">'.$question.'</p>
		<p>'.$loginStr[9].' <input type="password" name="answer" /></p>
		<input type="submit" value="'.$buttStr[0].'" class="butt" />
		<input type="hidden" name="name" value="'.$name.'" />
		<input type="hidden" name="help" value="lost3" />
	</div>
</form>';
	}
}elseif($help === 'lost3'){
	include('login.php');
	echo requestPass($_POST['name'],$_POST['answer'],$loginStr);
}
if(!$help || $help == 'lost3'){
//--ECHO STANDARD LOGIN FORM
	echo $loginForm;
}
//--REGISTER FORM
if($allowRegister){ 
	echo'<form action="register.php" method="post" id="regBox">
	<h3>'.$regStr[0].'</h3>
	<div>
		<p>'.$loginStr[1].' <input type="text" name="username" /></p>
		<p>'.$loginStr[2].' <input type="password" name="password" /></p>
	';
	if($verifyReg) echo'	<p>Verification <input type="text" name="code" class="input" /></p>
		<img src="image.php" />';
	echo'
		<input type="submit" value="'.$regStr[1].'" class="butt" />
	</div>
</form>';
}
echo'
<div id="ver">
	 <a href="https://github.com/hecko/somechess2" target=new>Some Chess Homepage</a>
</div>
';
echo $error;
?>

</body>
</html>
