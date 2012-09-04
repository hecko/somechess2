<?php // belongs to: endgame, menuFunc, admin, chat, export, game, index, standard, menu, login, logout, stats, statsFunc

define('errorDBStr', 'ERROR problem connecting to database');

$mainMenuStr[0]	= 'menu';
$mainMenuStr[1]	= '?';
$mainMenuStr[2]	= 'sign out';

$chatStr[0]	= 'Chat';

$buttStr[0]	= 'Go';
$buttStr[1]	= 'Update';
$buttStr[2]	= 'Invite';
$buttStr[3]	= 'Delete';
$buttStr[4]	= 'Resign';
$buttStr[5]	= 'Draw';
$buttStr[6]	= 'End';
$buttStr[7]	= $chatStr[0];
$buttStr[8]	= 'Export';
$buttStr[9]	= 'Upload';
$buttStr[10]= 'Undo';
$buttStr[11]= 'Back';
$buttStr[12]= 'Import';

$adminStr[0]	= 'Admin Options';
$adminStr[1]	= 'Delete Player';
$adminStr[2]	= 'Change Privilege Level';
$adminStr[3]	= 'The player has been deleted';
$adminStr[4]	= 'Error: You need to pick a name and a privilege level';
$adminStr[5]	= 'The player\'s Privilege Level has been changed';
$adminStr[6]	= 'Are you sure you want to delete';
$adminStr[7]	= 'Are you sure you want to change the Privilege Level for: ';
$adminStr[8]	= 'Check for Updates';
$adminStr[9]	= $buttStr[3];
$adminStr[10]	= $buttStr[1];
$adminStr[11]	= $buttStr[0];
$adminStr[12]	= 'An update is available';
$adminStr[13]	= 'click here';
$adminStr[14]	= 'You have the newest version';
$adminStr[15]	= 'Backup Database';
$adminStr[16]	= 'Options';
$adminStr[17]	= 'The options were updated.';
$adminStr[18]	= 'The options were NOT updated. Check the config.php file permissions.';
$adminStr[19]	= 'Sorry your config.php file is <b>not</b> writable, to use this function you will need to change the permissions manually to rw-rw-rw or 666';
$adminStr[20]	= 'Some Chess Options';  //NEW FOR 2.0b4

$gameFuncStr[1]	= 'You have resigned from the game';
$gameFuncStr[2]	= 'You have proposed a draw<p>Your friend can reject the request by making a move</p>';
$gameFuncStr[3]	= 'You have agreed to a draw';
$gameFuncStr[4]	= 'You have already proposed a draw, please wait for the other player to respond';
$gameFuncStr[5]	= 'You have forfeited the game';
$gameFuncStr[6]	= 'You\'re friend has forfeited the game';
$gameFuncStr[7]	= 'The game has been ended';
$gameFuncStr[8]	= '<h2>Are you sure you want to resign?</h2><p>This game will be counted as a loss</p>';
$gameFuncStr[9]	= '<h2>Are you sure you want to draw?</h2>';
$gameFuncStr[10]	= '<h2>Are you sure you want to end this game?</h2><p>If there have been more than 2 moves the player who moved last gets the win</p>';
$gameFuncStr[11]	= '<h2>Are you sure you want <u>request</u> an undo from your friend?</h2><p>Your friend can reject the request by making a move</p>';
$gameFuncStr[12]	= '<h2>Are you sure you want give your friend an undo?</h2>';
$gameFuncStr[13]	= '<h2>Undo has been allowed</h2>';
$gameFuncStr[14]	= 'You have requested an undo, please wait for the other player to respond';
$gameFuncStr[15]	= '<h2>Sorry, you can not undo</h2><p>You must make your request within 30 seconds of your move, the undo button is meant slip-ups only</p>';
$gameFuncStr[16]	= '<h2>Are you sure you want to accept a draw?</h2>';
$gameFuncStr[17]	= 'A new game has been created';
$gameFuncStr[18]	= 'Please select a person to play with';
$gameFuncStr[19]	= 'The game has been imported, and is available under "View Games"';
$gameFuncStr[20]	= 'Please paste the entire PNG text into the field';

$menuStr[0]	= 'Start New Game';
$menuStr[1]	= 'Against';
$menuStr[2]	= 'Your Color';
$menuStr[3]	= 'Update Your Info';
$menuStr[4]	= 'Player Image';
$menuStr[5]	= 'Invite Friend';
$menuStr[6]	= 'Name';
$menuStr[7]	= 'Email';
$menuStr[8]	= 'Players Online Now';
$menuStr[9]	= '\'s Games';
$menuStr[10]	= 'Won';
$menuStr[11]	= 'Lost';
$menuStr[12]	= 'Drawn';
$menuStr[13]	= 'Players';
$menuStr[14]	= 'Your record is';
$menuStr[15]	= 'In-Progress';
$menuStr[16]	= 'Profile';
$menuStr[17]	= 'Invite';
$menuStr[18]	= 'Import';
$menuStr[19]	= 'Name';
$menuStr[20]	= 'Username';
$menuStr[21]	= 'Password';
$menuStr[22]	= 'Retype';
$menuStr[23]	= 'Location';
$menuStr[24]	= 'Email';
$menuStr[25]	= 'Import PGN';
$menuStr[26]	= 'Your Move';
$menuStr[27]	= 'End Game?';
$menuStr[28]	= 'Draw?';
$menuStr[29]	= 'Undo?';
$menuStr[30]	= 'All Games';	//MODIFIED FOR 2.0b5
$menuStr[31]	= 'Games In-Progress';
$menuStr[32]	= 'Games Completed';
$menuStr[33]	= 'Your Games';
$menuStr[34]	= 'View Games';
$menuStr[35]	= 'Chess';	//NEW TO 2.0b5
$menuStr[36]	= 'Security Question';	//NEW TO 2.0b5
$menuStr[37]	= 'Security Answer';	//NEW TO 2.0b5
$menuStr[38]	= 'Paste PGN below';	//NEW TO 2.0b5
$menuStr[39]	= 'Welcome to Some Chess, ';	//NEW TO 2.0b5

$menuFuncStr[1]	= 'Please fill in both fields';
$menuFuncStr[2]	= 'The passwords didn\'t match, please retype them';
$menuFuncStr[3]	= 'Your password has been updated';
$menuFuncStr[4]	= 'Your profile has been updated';
$menuFuncStr[5]	= 'Please enter some info to update';
$menuFuncStr[6]	= 'Please fill in both fields, email addresses are <b>not</b> stored in anyway';
$menuFuncStr[7]	= 'This doesn\'t appear to be a valid email address, please try again<br /> email addresses are <b>not</b> stored in anyway';
$menuFuncStr[8]	= 'Sorry, that name is already taken please try a different name';
$menuFuncStr[9]	= "You've been invited to play Some Chess";
$menuFuncStr[10]	= 'A friend has invited you to play Some Chess. His or her name on Some Chess is ';
$menuFuncStr[11]	= '. Some Chess is a new internet chess program that you can play in real time or over a prolonged period (like correspondence chess). Some Chess does not require javascript so it works on pretty much any computer with an internet connection. Your account has already been created, you can use the info below to log in at:
				
	http://';
$menuFuncStr[12]	= '
	Password:	';
$menuFuncStr[13]	= "
	(you can change these once you login)\n\r\n\r
If you have any questions please take a minute once you log in to read the about page (located in the top menu).\n\r\n\r\n\r\n\r
Best wishes,
Some Chess Automaton\n\r\n\r
ps- in case you're wondering, your email address is immediately discarded, so unless someone invites you again you'll never hear from Some Chess again";
$menuFuncStr[14]	= 'Your friend has been invited';
$menuFuncStr[15]	= 'You need to choose a file';
$menuFuncStr[16]	= 'The file appears to be empty size:';
$menuFuncStr[17]	= 'The file is too large, make sure it is less than 500kb';
$menuFuncStr[18]	= 'There was an error with your file';
$menuFuncStr[19]	= 'Sorry, that type of file can\'t be used:';
$menuFuncStr[20]	= 'Success! The file has been uploaded';
$menuFuncStr[21]	= 'Sorry, there was an unexpected error please try again';
$menuFuncStr[22]	= '
	Username:	';
$menuFuncStr[23]	= 'Passwords must be 6 to 15 characters long';	//NEW TO 2.0b5
$menuFuncStr[24]	= 'Username must be 4 to 20 characters long';	//NEW TO 2.0b5
$menuFuncStr[25]	= 'Security Questions can not be more than 90 characters long';	//NEW TO 2.0b5
$menuFuncStr[26]	= 'Password and Username can not be the same';	//NEW TO 2.0b5

$gameStr[0]	= 'Some Chess uses an iframe, if you see this your browser doesn\'t support iframes';
$gameStr[1]	= 'Some Chess uses an objects, if you see this your browser doesn\'t support objects';

$loginStr[0]	= 'Login';
$loginStr[1]	= $menuStr[6];
$loginStr[2]	= $menuStr[21];
$loginStr[3]	= $menuFuncStr[1];
$loginStr[4]	= 'The system has encountered an error Please contact the site admin';
$loginStr[5]	= 'You could not be logged in, please try again';
$loginStr[6]	= 'You have been signed off';
$loginStr[7]	= 'Click Here to Sign Back on';
$loginStr[8]	= 'forgot password';	//NEW TO 2.0b5
$loginStr[9]	= 'Answer';	//NEW TO 2.0b5
$loginStr[10]	= 'No record found';	//NEW TO 2.0b5
$loginStr[11]	= 'New Password (change this when you login)<br />';	//NEW TO 2.0b5

$statsStr[0]	= 'Stats';
$statsStr[1]	= $menuStr[13];
$statsStr[2]	= 'W';
$statsStr[3]	= 'L';
$statsStr[4]	= 'D';
$statsStr[5]	= 'no one';
$statsStr[6]	= 'Most Games In-Progress';
$statsStr[7]	= 'Most Played';
$statsStr[8]	= 'Most Wins';
$statsStr[9]	= 'Most Losses';
$statsStr[10]	= 'Most Draws';
$statsStr[11]	= 'Best Win %';
$statsStr[12]	= 'Individual Stats';
$statsStr[13]	= 'real name';
$statsStr[14]	= $menuStr[23];
$statsStr[15]	= 'User Since';
$statsStr[16]	= 'Invited By';
$statsStr[17]	= 'Points';	//NEW TO 2.0b5
$statsStr[18]	= 'Most Points';	//NEW TO 2.0b5
$statsStr[19]	= 'Last Online';	//NEW TO 2.0b5
$statsStr[20]	= 'Win Avg';	//NEW TO 2.0b5
$statsStr[21]	= 'Loss Avg';	//NEW TO 2.0b5
$statsStr[22]	= 'Draw Avg';	//NEW TO 2.0b5
$statsStr[23]	= 'Games Played';	//NEW TO 2.0b5
$statsStr[24]	= 'Games IP';	//NEW TO 2.0b5
$statsStr[25]	= 'Fodder';	//NEW TO 2.0b5
$statsStr[26]	= 'Nemisis';	//NEW TO 2.0b5
$statsStr[27]	= 'Wins';	//NEW TO 2.0b5
$statsStr[28]	= 'Losses';	//NEW TO 2.0b5
$statsStr[29]	= 'Draws';	//NEW TO 2.0b5
$statsStr[30]	= 'Games Played';	//NEW TO 2.0b5
$statsStr[31]	= 'Personal Stats';	//NEW TO 2.0b5

$regStr[0]	= 'Register';
$regStr[1]	= 'Sign Up';
$regStr[2]	= 'Please go back and pick a username and password';
$regStr[3]	= $menuFuncStr[8];
$regStr[4]	= 'You are now registered, please enjoy Some Chess<br /><br /> username: ';	//MODIFIED FOR 2.0b5
$regStr[5]	= 'The registration code doesn\'t match, please go back and try again';
$regStr[6]	= 'There was an error, please go back and try again';
$regStr[7]	= $menuFuncStr[23];
$regStr[8]	= $menuFuncStr[24];
$regStr[9]	= $menuFuncStr[26];

$indexStr[0]	= 'There was a problem creating the database, please try to create it manually';
$indexStr[1]	= 'There was a problem installing the Some Chess tables, please try to install them manually';
$indexStr[2]	= 'Installation of Some Chess was Successful!<br /><br /> Username: admin<br /> password: admin <br />(change these once you log in)';
$indexStr[3]	= 'There was a problem updating the Some Chess tables, please try to update manually';
$indexStr[4]	= 'Some Chess was successfully updated!';

$colorStr[0]	= 'white';	//NEW TO 2.0b4
$colorStr[1]	= 'black';	//NEW TO 2.0b4
?>