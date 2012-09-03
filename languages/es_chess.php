<?php //	belong to:	board, display, displayMinimal, move, king, queen, bishop, knight, rook, pawn
define('errorDBStr', 'ERROR problema conectando a la Base de Datos');

$infoBoxStr[0]	= 'Movimientos de la partida';
$infoBoxStr[1]	= 'Rendir';
$infoBoxStr[2]	= 'Tablas';
$infoBoxStr[3]	= 'Fin';
$infoBoxStr[4]	= 'Deshaz';
$infoBoxStr[5]	= 'Exportar';
$infoBoxStr[6]	= 'Est&aacute;s jaque!';
$infoBoxStr[7]	= 'Tablas propuestas';
$infoBoxStr[8]	= 'Esperando respuesta de tablas';
$infoBoxStr[9]	= 'Deshacer propuesto';
$infoBoxStr[10]	= 'Esperando respuesta de deshacer';
$infoBoxStr[11]	= ' ha ganado esta partida';
$infoBoxStr[14]	= 'Inicio';
$infoBoxStr[15]	= 'movimiento ';
$infoBoxStr[16]	= ' a&hellip;';

$boardStr[0]	= 'Es <b>tu</b> turno';
$boardStr[1]	= 'Es el turno de <b>';
$boardStr[2]	= '</b>';

$movesStr[0]	= '<h3>Error</h3> Falta informacion, por favor vuelve a intentarlo';
$movesStr[1]	= '<h3>Movimiento ilegal</h3> You are in checkmate';	//requires translation
$movesStr[2]	= '<h3>Movimiento ilegal</h3> El cuadro al que quieres moverte no existe';
$movesStr[3]	= '<h3>Movimiento ilegal</h3> El cuadro desde el que quieres moverte no existe';
$movesStr[5]	= '<h3>Movimiento ilegal</h3> Intentas mover una pieza del otro jugador';
$movesStr[6]	= '<h3>Movimiento ilegal</h3> Tienes que mover la pieza a un nuevo cuadro';
$movesStr[7]	= '<h3>Movimiento ilegal</h3> Intentas capturar una de tus propias piezas';
$movesStr[8]	= '<h3>Movimiento ilegal</h3> No puedes mover tu rey a jaque';

$kingStr[0]		= '<h3>Movimiento ilegal</h3> No puedes enrocarte despues de mover tu rey';
$kingStr[1]		= '<h3>Movimiento ilegal</h3> No puedes enrocarte bajo jaque';
$kingStr[2]		= '<h3>Movimiento ilegal</h3> No puedes enrocarte a ese lado si la torre ya se ha movido';
$kingStr[3]		= '<h3>Movimiento ilegal</h3> S&oacute;lo puedes enrocarte si el espacio est&aacute; libre';
$kingStr[4]		= '<h3>Movimiento ilegal</h3> No puedes enrocarte a trav&eacute;s de una l&iacute;nea de jaque';
$kingStr[5]		= '<h3>Movimiento ilegal</h3> iEl rey s&oacute;lo se mueve un cuadro (menos al enrocarse)';

$queenStr[0]	= '<h3>Movimiento ilegal</h3> La reina no puede saltar sobre una pieza';
$queenStr[1]	= '<h3>Movimiento ilegal</h3> La reina s&oacute;lo se mueve sobre filas, columnas y diagonales';

$bishopStr[0]	= '<h3>Movimiento ilegal</h3> El alfil no puede saltar sobre una pieza';
$bishopStr[1]	= '<h3>Movimiento ilegal</h3> Los alfiles s&oacute;lo se mueven sobre las diagonales';

$knightStr[0]	= '<h3>Movimiento ilegal</h3> El caballo s&oacute;lo se mueve dos alante y una al lado o una alante y dos al lado';

$rookStr[0]		= '<h3>Movimiento ilegal</h3> La torre no puede saltar sobre una pieza';
$rookStr[1]		= '<h3>Movimiento ilegal</h3> La torre s&oacute;lo se mueve en filas y columnas';

$pawnStr[0]		= '<h3>Movimiento ilegal</h3> El pe&oacute;n no puede saltar sobre una pieza';
$pawnStr[1]		= '<h3>Movimiento ilegal</h3> El pe&oacute;n s&oacute;lo puede capturar diagonalmente';
$pawnStr[2]		= '<h3>Movimiento ilegal</h3> El p&eoacute; s&oacute;lo se puede mover un cuadro alante (excepto en su primer movimiento)';

$gameOverStr[0]	= 'Mate';
$gameOverStr[1]	= 'Tu Ganas!';

$emailStr[0]	= 'Some Chess: it is your move';	//requires translation
$emailStr[1]	= 'Hola ';
$emailStr[2]	= ',

This is an email to let you know that the move: ';  //requires translation
$emailStr[3]	= ' has moved ';  //requires translation
$emailStr[4]	= ' in one of your games (game number: ';  //requires translation

$viewStr[0]		= 'Last Move:';  //requires translation
?>
