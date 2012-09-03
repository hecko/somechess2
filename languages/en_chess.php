<?php
//	files:	board, display, displayMinimal, move, king, queen, bishop, knight, rook, pawn
define('errorDBStr', 'ERROR problem connecting to database');

$infoBoxStr[0]	= 'Move History';
$infoBoxStr[1]	= 'Resign';
$infoBoxStr[2]	= 'Draw';
$infoBoxStr[3]	= 'End';
$infoBoxStr[4]	= 'Undo';
$infoBoxStr[5]	= 'Export';
$infoBoxStr[6]	= 'You are in check!';
$infoBoxStr[7]	= 'Draw Proposed';
$infoBoxStr[8]	= 'Wait for draw response';
$infoBoxStr[9]	= 'Undo Requested';
$infoBoxStr[10]	= 'Wait for undo response';
$infoBoxStr[11]	= ' won this game';
$infoBoxStr[14]	= 'Start';
$infoBoxStr[15]	= 'move ';
$infoBoxStr[16]	= ' to&hellip;';

$boardStr[0]	= 'It\'s <b>your</b> turn';
$boardStr[1]	= 'It\'s <b>';
$boardStr[2]	= '\'s</b> turn';

$movesStr[0]	= '<h3>Error</h3> Some information is missing, please try again';
$movesStr[1]	= '<h3>Illegal move</h3> You are in checkmate';	//MODIFIED FOR 2.0b5
$movesStr[2]	= '<h3>Illegal move</h3> That square you want to move to doesn\'t exist';
$movesStr[3]	= '<h3>Illegal move</h3> That square you want to move from doesn\'t exist';
$movesStr[5]	= '<h3>Illegal move</h3> You can not move the other player\'s pieces';   //MODIFIED FOR 2.0b4
$movesStr[6]	= '<h3>Illegal move</h3> You must move a piece to a new square';
$movesStr[7]	= '<h3>Illegal move</h3> You have tried to capture one of your own pieces';
$movesStr[8]	= '<h3>Illegal move</h3> You can not move your King into check';

$kingStr[0]		= '<h3>Illegal move</h3> You can not castle after moving the king';
$kingStr[1]		= '<h3>Illegal move</h3> You can not castle when in check';
$kingStr[2]		= '<h3>Illegal move</h3> You can not castle  to that side if the rook has already moved';
$kingStr[3]		= '<h3>Illegal move</h3> You can only castle when the lane is clear';
$kingStr[4]		= '<h3>Illegal move</h3> You can not castle through a line of check';
$kingStr[5]		= '<h3>Illegal move</h3> 1 The king can only move one space (except when castling)';

$queenStr[0]	= '<h3>Illegal move</h3> Queens can not jump over a piece';
$queenStr[1]	= '<h3>Illegal move</h3> The Queen can only move along diagonals, ranks (rows), and files (columns)';

$bishopStr[0]	= '<h3>Illegal move</h3> Bishops can not jump over a piece';
$bishopStr[1]	= '<h3>Illegal move</h3> Bishops can only move along diagonals';

$knightStr[0]	= '<h3>Illegal move</h3> Knights can only move up two and over one or up one and over two';

$rookStr[0]		= '<h3>Illegal move</h3> Rooks can not jump over a piece';
$rookStr[1]		= '<h3>Illegal move</h3> Rooks can only move along ranks (rows) and files (columns)';

$pawnStr[0]		= '<h3>Illegal move</h3> Pawns can not jump over a piece';
$pawnStr[1]		= '<h3>Illegal move</h3> Pawns can only capture one space diagonally';
$pawnStr[2]		= '<h3>Illegal move</h3> Pawns can only move one space forward (except for their first move)';

$gameOverStr[0]	= 'Checkmate';
$gameOverStr[1]	= 'You Won!';

$emailStr[0]	= 'Some Chess: it is your move';	//NEW FOR 2.0b4
$emailStr[1]	= 'Hello ';	//NEW FOR 2.0b4
$emailStr[2]	= ',

This is an email to let you know that ';
$emailStr[3]	= ' has moved ';  //MODIFIED FOR 2.0b5
$emailStr[4]	= ' in one of your games (game number: ';  //NEW FOR 2.0b5

$viewStr[0]		= 'Last Move:';  //NEW FOR 2.0b4
?>