<?php
//	files:	board, display, displayMinimal, move, king, queen, bishop, knight, rook, pawn
define('errorDBStr', 'ERROR problem connecting to database');

$infoBoxStr[0]	= 'Historico de Movimentos';
$infoBoxStr[1]	= 'Desistir';
$infoBoxStr[2]	= 'Empatar';
$infoBoxStr[3]	= 'Fim';
$infoBoxStr[4]	= 'Desfazer';
$infoBoxStr[5]	= 'Exportar';
$infoBoxStr[6]	= 'Voce esta em Check!';
$infoBoxStr[7]	= 'Proposta de Empate';
$infoBoxStr[8]	= 'Esperando por resposta para empate';
$infoBoxStr[9]	= 'Desfazer Requisitado';
$infoBoxStr[10]	= 'Esperando resposta para desfazer';
$infoBoxStr[11]	= ' ganhou este jogo';
$infoBoxStr[14]	= 'Iniciar';
$infoBoxStr[15]	= 'mover ';
$infoBoxStr[16]	= ' to&hellip;';

$boardStr[0]	= 'Esta e <b>sua</b> vez';
$boardStr[1]	= 'Esta e <b>';
$boardStr[2]	= '\'s</b> turn';

$movesStr[0]	= '<h3>Erro</h3> Algumas informacoes estao faltando, por favor tente novamente';
$movesStr[1]	= '<h3>Movimento Ilegal</h3> You are in checkmate';	//MODIFIED FOR 2.0b5
$movesStr[2]	= '<h3>Movimento Ilegal</h3> Aquele quadrante que voce quer mover nao existe';
$movesStr[3]	= '<h3>Movimento Ilegal</h3> Aquele quadrante que voce quer mover nao existe';
$movesStr[5]	= '<h3>Movimento Ilegal</h3> Voce esta tentando mover as pecas de outro jogador';
$movesStr[6]	= '<h3>Movimento Ilegal</h3> Voce deve mover uma peca para um novo quadrante';
$movesStr[7]	= '<h3>Movimento Ilegal</h3> Voce esta tentando capturar uma de suas proprias pecas';
$movesStr[8]	= '<h3>Movimento Ilegal</h3> Voce nao pode mover o seu Rei para o check';

$kingStr[0]		= '<h3>Movimento Ilegal</h3> Voce nao pode montar castelo se ja moveu o rei';
$kingStr[1]		= '<h3>Movimento Ilegal</h3> Voce nao pode montar castelo enquanto estiver em check';
$kingStr[2]		= '<h3>Movimento Ilegal</h3> Voce nao pode montar castelo se a torre ja tiver sido movida';
$kingStr[3]		= '<h3>Movimento Ilegal</h3> Voce so pode montar castelo quando a pista estiver limpa';
$kingStr[4]		= '<h3>Movimento Ilegal</h3> Voce nao pode montar castelo em uma linha de check';
$kingStr[5]		= '<h3>Movimento Ilegal</h3> 1 O rei pode mover apenas em um quadrante (Exceto ao montar castelo)';

$queenStr[0]	= '<h3>Movimento Ilegal</h3> Rainhas nao podem pular sobre uma peca';
$queenStr[1]	= '<h3>Movimento Ilegal</h3> A rainha apenas pode mover-se em diagonais, linhas e colunas';

$bishopStr[0]	= '<h3>Movimento Ilegal</h3> Bispos nao podem pular sobre uma peca';
$bishopStr[1]	= '<h3>Movimento Ilegal</h3> Bispos movimentam-se apenas na diagonal';

$knightStr[0]	= '<h3>Movimento Ilegal</h3> Cavaleiros somente podem mover-se a 2 acima e um ao lado ou 1 ao lado e 2 acima';

$rookStr[0]		= '<h3>Movimento Ilegal</h3> Torres nao podem mover-se sobre pecas';
$rookStr[1]		= '<h3>Movimento Ilegal</h3> Torres somente movimentam-se em linhas ou colunas';

$pawnStr[0]		= '<h3>Movimento Ilegal</h3> Pioes nao pulam sobre pecas';
$pawnStr[1]		= '<h3>Movimento Ilegal</h3> Peoes so capturam na diagonal';
$pawnStr[2]		= '<h3>Movimento Ilegal</h3> Peoes so podem movimentar um espaco a frente (exceto na primeira jogada)';

$gameOverStr[0]	= 'Checkmate';
$gameOverStr[1]	= 'Voce Ganhou!';

$emailStr[0]	= 'Some Chess: it is your move';	//requires translation
$emailStr[1]	= 'Hello ';	//requires translation
$emailStr[2]	= ',

This is an email to let you know that ';
$emailStr[3]	= ' has moved ';  //requires translation
$emailStr[4]	= ' in one of your games (game number: ';  //requires translation

$viewStr[0]		= 'Last Move:';  //requires translation
?>