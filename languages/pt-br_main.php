<?php //belongs to endgame, menuFunc, admin, chat, export, game, index, standard, menu, login, logout, stats, statsFunc

define('errorDBStr', 'ERROR problem connecting to database: ');	//requires translation

$mainMenuStr[0]	= 'opcoes';
$mainMenuStr[1]	= 'sobre';
$mainMenuStr[2]	= 'Sair';

$chatStr[0]	= 'Chat';

$buttStr[0]	= 'Ir';
$buttStr[1]	= 'Atualizar';
$buttStr[2]	= 'Convidar';
$buttStr[3]	= 'Apagar';
$buttStr[4]	= 'Desistir';
$buttStr[5]	= 'Empatar';
$buttStr[6]	= 'Fim';
$buttStr[7]	= 'Chat';
$buttStr[8]	= 'Exportar';
$buttStr[9]	= 'Upload';
$buttStr[10]= 'Desfazer';
$buttStr[11]= 'Voltar';
$buttStr[12]= 'Importar';

$adminStr[0]	= 'Opcoes do Administrador';
$adminStr[1]	= 'Apagar Jogador';
$adminStr[2]	= 'Mudar nivel de privilegio';
$adminStr[3]	= 'O jogador foi Apagado';
$adminStr[4]	= 'Error: Voce precisa escolher um nome e privilegio';
$adminStr[5]	= 'O privilegio do jogador foi alterado';
$adminStr[6]	= 'Voce tem certeza que deseja apagar';
$adminStr[7]	= 'Voce tem certeza que deseja alterar o nivel de privilegio para: ';
$adminStr[8]	= 'Verificar Atualizacoes';
$adminStr[9]	= $buttStr[3];
$adminStr[10]	= $buttStr[1];
$adminStr[11]	= $buttStr[0];
$adminStr[12]	= 'Uma atualizacao esta disponivel';
$adminStr[13]	= 'Clique Aqui';
$adminStr[14]	= 'Voce ja tem a ultima versao';
$adminStr[15]	= 'Copia de Seguranca do Banco de Dados';
$adminStr[16]	= 'Opcoes';
$adminStr[17]	= 'As opcoes foram atualizadas.';
$adminStr[18]	= 'As opcoes nao foram atualizadas. Cheque as permicoes do config.php.';
$adminStr[19]	= 'Desculpe o arquivo: config.php <b>NAO</b> esta com permissao de escrita, para usar esta funcao voce deve alterar as permicoes manualmente para: rw-rw-rw or 666';
$adminStr[20]	= 'Some Chess Opcoes';

$gameFuncStr[1]	= 'Voce tem deserdado de um jogo';
$gameFuncStr[2]	= 'Voce propos um empate <p>Seu amigo pode rejeitar esta requisicao se mover alguma peca</p>';
$gameFuncStr[3]	= 'Voce concordou com o empate';
$gameFuncStr[4]	= 'Voce esta propondo um empate, por favor espere pela resposta do adversario';
$gameFuncStr[5]	= 'Você perdeu o jogo';
$gameFuncStr[6]	= 'Seu amigo perdeu o jogo';
$gameFuncStr[7]	= 'O jogo foi finalizado';
$gameFuncStr[8]	= '<h2>Voce tem certeza que vai bundar?</h2><p>Este jogo sera contado como perdido</p>';
$gameFuncStr[9]	= '<h2>Voce tem certeza que deseja empatar?</h2>';
$gameFuncStr[10]	= '<h2>Voce tem certeza que deseja finalizar esta partida?</h2><p>Se existir mais de dois movimento o jogador que moveu por ultimo sera o vencedor</p>';
$gameFuncStr[11]	= '<h2>Voce tem certeza que deseja <u>pedir</u> para desfazer ao seu amigo?</h2><p>Seu amigo pode rejeitar caso mova uma peca</p>';
$gameFuncStr[12]	= '<h2>Voce tem certeza que deseja [dar para o seu amigo] a chance de desfazer?</h2>';
$gameFuncStr[13]	= '<h2>Desfazer foi permitido</h2>';
$gameFuncStr[14]	= 'Voce pediu para desfazer, por favor espero o adversario responder';
$gameFuncStr[15]	= '<h2>Desculpe, voce nao pode desfazer</h2><p>Voce deve pedir com ate 30 segundo depois do movimento</p>';
$gameFuncStr[16]	= '<h2>Voce tem certeza que deseja aceitar o empate?</h2>';
$gameFuncStr[17]	= 'Um novo jogo foi criado';
$gameFuncStr[18]	= 'Por favor selecione um personagem para jogar';
$gameFuncStr[19]	= 'O jogo foi importado, e agora esta avaliavel em: "Ver Jogos"';
$gameFuncStr[20]	= 'Por favor cole o PNG texto no campo';

$menuStr[0]	= 'Comecar Novo Jogo';
$menuStr[1]	= 'Contra';
$menuStr[2]	= 'Sua Cor';
$menuStr[3]	= 'Atualizar suas Informacoes';
$menuStr[4]	= 'Imagem do Jogador';
$menuStr[5]	= 'Convidar seu Amigo';
$menuStr[6]	= 'Nome';
$menuStr[7]	= 'Email';
$menuStr[8]	= 'Jogadores Online Agora';
$menuStr[9]	= '\'s Jogos';
$menuStr[10]	= 'Ganhou';
$menuStr[11]	= 'Perdeu';
$menuStr[12]	= 'Empate';
$menuStr[13]	= 'Jogadores';
$menuStr[14]	= 'Seu record e';
$menuStr[15]	= 'Em progresso';
$menuStr[16]	= 'Perfil';
$menuStr[17]	= 'Convidar';
$menuStr[18]	= 'Importar Jogo';
$menuStr[19]	= 'Nome';
$menuStr[20]	= 'Usuario';
$menuStr[21]	= 'Senha';
$menuStr[22]	= 'Redigite';
$menuStr[23]	= 'Localizacao';
$menuStr[24]	= 'Email';
$menuStr[25]	= 'Importar PGN';
$menuStr[26]	= 'Seu Movimento';
$menuStr[27]	= 'Finalizar jogo?';
$menuStr[28]	= 'Empatar?';
$menuStr[29]	= 'Desfazer?';
$menuStr[30]	= 'All Jogos';	//requires translation
$menuStr[31]	= 'Jogos em Progresso';
$menuStr[32]	= 'Jogos Completos';
$menuStr[33]	= 'Seus Jogos';
$menuStr[34]	= 'Ver Jogos';
$menuStr[35]	= 'Chess';	//requires translation
$menuStr[36]	= 'Security Question';	//requires translation
$menuStr[37]	= 'Security Answer';	//requires translation
$menuStr[38]	= 'Paste PGN below';	//requires translation
$menuStr[39]	= 'Welcome to Some Chess, ';	//requires translation

$menuFuncStr[1]	= 'Por favor preencha ambos os campos';
$menuFuncStr[2]	= 'Senhas nao conferem, por favor redigite';
$menuFuncStr[3]	= 'Sua senha foi atualizada';
$menuFuncStr[4]	= 'Seu perfil foi atualizado';
$menuFuncStr[5]	= 'Por favor entre com alguma informacao para atualizar';
$menuFuncStr[6]	= 'Por favor preencha ambos os campos, enderecos de email <b>nao</b> salvo';
$menuFuncStr[7]	= 'Nao parece ser um email valido, por favor tente novamente<br />';
$menuFuncStr[8]	= 'Desculpe, o nome ja esta em uso<br><br>Por favor tente um nome diferente';
$menuFuncStr[9]	= "Voce foi convidado para jogar xadrez";
$menuFuncStr[10]	= 'Um amigo te convidou para jogar xadrez. O nome dele e: ';
$menuFuncStr[11]	= '. Voce pode jogar xadrez online por um periodo muito prolongado. Nosso sistema nao requer uma conexao muito rapida com a internet nem javascript instalado, basta voce efetuar login com essas informacoes:
				
	http://';
$menuFuncStr[11]	= '
	Usuario:	';
$menuFuncStr[12]	= '
	Senha:	';
$menuFuncStr[13]	= "
	(Voce podera alterar depois que efetuar login)\n\r\n\r
Se voce tiver alguma duvida, logue no sistema e procure a secao : SOBRE (Localizada no topo do menu).\n\r\n\r\n\r\n\r
Obrigado,
";
$menuFuncStr[14]	= 'Seu amigo foi convidado';
$menuFuncStr[15]	= 'Voce precisa escolher um arquivo';
$menuFuncStr[16]	= 'O arquivo aparenta esta vazio:';
$menuFuncStr[17]	= 'O arquivo e muito grande, deve ter ate: 500kb';
$menuFuncStr[18]	= 'Existe um erro com o seu arquivo';
$menuFuncStr[19]	= 'O arquivo que voce descreveu nao pode ser usado:';
$menuFuncStr[20]	= 'Sucesso! O arquivo foi enviado';
$menuFuncStr[21]	= 'Erro inexperado, tente novamente';
$menuFuncStr[22]	= '
	Username:	';	//requires translation
$menuFuncStr[23]	= 'Passwords must be 6 to 15 characters long';	//requires translation
$menuFuncStr[24]	= 'Username must be 5 to 20 characters long';	//requires translation
$menuFuncStr[25]	= 'Security Questions can not be more than 90 characters long';	//requires translation
$menuFuncStr[26]	= 'Password and Username can not be the same';	//requires translation

$gameStr[0]	= 'Some Chess utiliza um iframe, se voce esta vendo essa mensagem, entao o seu navegador nao suporta iframes';
$gameStr[1]	= 'Some Chess utiliza objetos, se voce esta vendo essa mensagem, entao o seu navegador nao suporta objetos';

$loginStr[0]	= 'Login';
$loginStr[1]	= $menuStr[6];
$loginStr[2]	= $menuStr[21];
$loginStr[3]	= $menuFuncStr[1];
$loginStr[4]	= 'O sistema encontrou um erro<br />Por favor entre em contato com o administrador';
$loginStr[5]	= 'Voce nao pode logar<br /> Tente novamente';
$loginStr[6]	= 'Voce saiu';
$loginStr[7]	= 'Clique aqui para entrar novamente';
$loginStr[8]	= 'forgot password';	//requires translation
$loginStr[9]	= 'Answer';	//requires translation
$loginStr[10]	= 'No record found';	//requires translation
$loginStr[11]	= 'New Password (change this when you login)<br />';	//requires translation

$statsStr[0]	= 'Estatus';
$statsStr[1]	= $menuStr[13];
$statsStr[2]	= 'W';
$statsStr[3]	= 'L';
$statsStr[4]	= 'D';
$statsStr[5]	= 'ninguem';
$statsStr[6]	= 'Mais Jogados <br />em progresso';
$statsStr[7]	= 'Mais Jogados';
$statsStr[8]	= 'Mais Vencidos';
$statsStr[9]	= 'Mais Perdidos';
$statsStr[10]	= 'Mais Empatados';
$statsStr[11]	= 'Melhores dos Melhores %';
$statsStr[12]	= 'Estatus Individual';
$statsStr[13]	= 'nome real';
$statsStr[14]	= $menuStr[23];
$statsStr[15]	= 'Usuario desde';
$statsStr[16]	= 'Convidado por';
$statsStr[17]	= 'Points';	//requires translation
$statsStr[18]	= 'Most Points';	//requires translation
$statsStr[19]	= 'Last Online';	//requires translation
$statsStr[20]	= 'Win Avg';	//requires translation
$statsStr[21]	= 'Loss Avg';	//requires translation
$statsStr[22]	= 'Draw Avg';	//requires translation
$statsStr[23]	= 'Games Played';	//requires translation
$statsStr[24]	= 'Games IP';	//requires translation
$statsStr[25]	= 'Fodder';	//requires translation
$statsStr[26]	= 'Nemisis';	//requires translation
$statsStr[27]	= 'Wins';	//requires translation
$statsStr[28]	= 'Losses';	//requires translation
$statsStr[29]	= 'Draws';	//requires translation
$statsStr[30]	= 'Games Played';	//requires translation
$statsStr[31]	= 'Personal Stats';	//requires translation

$regStr[0]	= 'Registrar';
$regStr[1]	= 'Assinar';
$regStr[2]	= 'Por favor volte e forneca um nome para usuario e senha';
$regStr[3]	= $menuFuncStr[8];
$regStr[4]	= 'Voce foi registra, GOZE do Some Chess';
$regStr[5]	= 'O codigo de registro nao confere, tente novamente';
$regStr[6]	= 'Ocorreu um erro, volte e tente novamente';
$regStr[7]	= $menuFuncStr[23];
$regStr[8]	= $menuFuncStr[24];
$regStr[9]	= $menuFuncStr[26];

$indexStr[0]	= 'Ocorreu um erro ao criar o banco de dados, volte e crie manualmente';
$indexStr[1]	= 'Ocorreu um erro ao criar tabelas para o Some Chess, tente manualmente';
$indexStr[2]	= 'Instalacao do Some Chess Completa!<br /> Usuario: admin senha: admin (Mude depois que efetuar login)';
$indexStr[3]	= 'Ocorreu um erro ao atualizar as tabelas, tente manualmente';
$indexStr[4]	= 'Some Chess foi atualizado com sucesso!';

$colorStr[0]	= 'branco';	//requires verification
$colorStr[1]	= 'preto';	//requires verification
?>