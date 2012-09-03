<?php //	belongs to:	board, display, displayMinimal, move, king, queen, bishop, knight, rook, pawn


//requires verification

define('errorDBStr', 'ERRUER problem connecting to database: ');

$infoBoxStr[0]	= 'Mouvement l\'histoire';
$infoBoxStr[1]	= 'D&#233;missionner';
$infoBoxStr[2]	= '&#201;galit&#233;';
$infoBoxStr[3]	= 'Renoncer';
$infoBoxStr[4]	= 'D&#233;faire';
$infoBoxStr[5]	= 'Export';
$infoBoxStr[6]	= 'Vous &#234;tes en check!';
$infoBoxStr[7]	= '&#201;galit&#233; Propos&#233;';
$infoBoxStr[8]	= 'Attendre une r&#233;ponse &#224; la demande d\'une &#233;galit&#233;';
$infoBoxStr[9]	= 'D&#233;faire Requested';
$infoBoxStr[10]	= 'Attendre une r&#233;ponse &#224; la demande d\'une d&#233;faire';
$infoBoxStr[11]	= ' a gagn&#233; ce jeu';
$infoBoxStr[14]	= 'Commencer';
$infoBoxStr[15]	= 'd&#233;placer ';
$infoBoxStr[16]	= ' &#224;&hellip;';

$boardStr[0]	= 'il est <b>vous</b> tour';
$boardStr[1]	= 'il est <b>';
$boardStr[2]	= '\'s</b> tour';

$movesStr[0]	= '<h3>erreur</h3> De l\'information est absente, essayent svp encore';
$movesStr[1]	= '<h3>mouvement ill&#233;gal</h3> You are in checkmate';	//MODIFIED FOR 2.0b5
$movesStr[2]	= '<h3>mouvement ill&#233;gal</h3> La place que vous voulez se d&#233;placer n\'existe pas';
$movesStr[3]	= '<h3>mouvement ill&#233;gal</h3> La place que vous voulez se d&#233;placer de n\'existe pas';
$movesStr[5]	= '<h3>mouvement ill&#233;gal</h3> Vous avez essay&#233; de d&#233;placer de l\'autre le morceau joueur';
$movesStr[6]	= '<h3>mouvement ill&#233;gal</h3> Vous devez d&#233;placer un morceau &#224; une nouvelle place';
$movesStr[7]	= '<h3>mouvement ill&#233;gal</h3> Vous avez essay&#233; de capturer un de vos propres morceaux';
$movesStr[8]	= '<h3>mouvement ill&#233;gal</h3> Vous ne pouvez pas entrer votre roi dans le contr&#244;le';

$kingStr[0]		= '<h3>mouvement ill&#233;gal</h3> Vous ne pouvez pas se retrancher apr&#232;s avoir d&#233;plac&#233; le roi';
$kingStr[1]		= '<h3>mouvement ill&#233;gal</h3> Vous ne pouvez pas se retrancher quand en test';
$kingStr[2]		= '<h3>mouvement ill&#233;gal</h3> Vous ne pouvez pas se retrancher &#224; ce c&#244;t&#233; si le freux s\'est d&#233;j&#224; d&#233;plac&#233;';
$kingStr[3]		= '<h3>mouvement ill&#233;gal</h3> Vous pouvez seulement se retrancher quand la ruelle est claire';
$kingStr[4]		= '<h3>mouvement ill&#233;gal</h3> Vous ne pouvez pas se retrancher par une ligne de contr&#244;le';
$kingStr[5]		= '<h3>mouvement ill&#233;gal</h3> Le roi peut seulement d&#233;placer l\'un espace (except&#233; en se retranchant)';

$queenStr[0]	= '<h3>mouvement ill&#233;gal</h3> Les reines ne peuvent pas sauter par-dessus un morceau';
$queenStr[1]	= '<h3>mouvement ill&#233;gal</h3> La reine peut seulement se d&#233;placer le long des diagonales, des grades (rang&#233;es), et des dossiers (les colonnes)';

$bishopStr[0]	= '<h3>mouvement ill&#233;gal</h3> Les &#233;v&#234;ques ne peuvent pas sauter par-dessus un morceau';
$bishopStr[1]	= '<h3>mouvement ill&#233;gal</h3> Les &#233;v&#234;ques peuvent seulement se d&#233;placer le long des diagonales';

$knightStr[0]	= '<h3>mouvement ill&#233;gal</h3> Les chevaliers peuvent seulement relever deux et plus d\'un ou lever un et plus de deux';

$rookStr[0]		= '<h3>mouvement ill&#233;gal</h3> Les freux ne peuvent pas sauter par-dessus un morceau';
$rookStr[1]		= '<h3>mouvement ill&#233;gal</h3> Les freux peuvent seulement se d&#233;placer le long des grades (rang&#233;es) et des dossiers (les colonnes)';

$pawnStr[0]		= '<h3>mouvement ill&#233;gal</h3> Les gages ne peuvent pas sauter par-dessus un morceau';
$pawnStr[1]		= '<h3>mouvement ill&#233;gal</h3> Les gages peuvent seulement capturer l\'un espace diagonalement';
$pawnStr[2]		= '<h3>mouvement ill&#233;gal</h3> Les gages peuvent seulement faire avancer l\'un espace (except&#233; leur premier mouvement)';

$gameOverStr[0]	= '&#233;chec et mat';
$gameOverStr[1]	= 'Vous Gagner!';

$emailStr[0]	= 'Some Chess: it is your move';	//NEW FOR 2.0b4
$emailStr[1]	= 'Hello ';	//NEW FOR 2.0b4
$emailStr[2]	= ',

This is an email to let you know that ';
$emailStr[3]	= ' has moved ';  //MODIFIED FOR 2.0b5
$emailStr[4]	= ' in one of your games (game number: ';  //NEW FOR 2.0b5

$viewStr[0]		= 'Last Move:';  //NEW FOR 2.0b4
?>