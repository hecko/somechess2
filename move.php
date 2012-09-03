<?php
//		Some Chess, a PHP multi-player chess server.
//		Copyright (C) 2007 Jon Link
include_once('rules/threat.php');
function moveIt($locations,$oldSpot,$newSpot,$moveNum,$gameID,$canCastle,$playerColor,$lastMove,$promote,$lang,$oppID,$emailMove){	
	require('languages/'.$lang.'_chess.php');
	//--catch errors
	//----do we have all the vars
	if(!$locations) $spRules['error']	= $movesStr[0];
	if(!$gameID) 	$spRules['error']	= $movesStr[0];
	//--if no errors are caught
	if(!$message){
		//--go through the old array and make the changes from the move in an new array
		$playerColor	= ($playerColor == 'white')? 'l' : 'd';
		$defColor	= ($playerColor == 'd')? 'l' : 'd';
		$movingPiece	= $locations[$oldSpot];
		//--check for illegal moves
		echo "Last move: ".$lastMove['move']."<br>";
		if(strpos($lastMove['move'],'#') !== false){
			$spRules['error']	= $movesStr[1];
		}elseif(ord($newSpot{0}) < 97 || ord($newSpot{0}) > 104 || $newSpot{1} > 8 || $newSpot{1} < 1){
			$spRules['error']	= $movesStr[2];
		}elseif(ord($oldSpot{0}) < 97 || ord($oldSpot{0}) > 104 || $oldSpot{1} > 8 || $oldSpot{1} < 1){
			$spRules['error']	= $movesStr[3];
		}elseif($playerColor != $movingPiece{1}){
			$spRules['error']	= $movesStr[5];
		}elseif($oldSpot == $newSpot){	
			$_SESSION['oldSpot'.$gameID] = $newSpot;
			return 'redo';
		}elseif($playerColor == ($locations[$newSpot]{1})){	
			$_SESSION['oldSpot'.$gameID] = $newSpot;
			return 'redo';
		}else{
			//----check with rules
			if($movingPiece{0} == 'k'){include_once('rules/king.php'); 		$spRules	= kingRules($locations,$newSpot,$oldSpot,$movingPiece,$canCastle,$lastMove,$kingStr);}
			if($movingPiece{0} == 'q'){include_once('rules/queen.php'); 	$spRules 	= queenRules($locations,$newSpot,$oldSpot,$movingPiece,$queenStr);}
			if($movingPiece{0} == 'r'){include_once('rules/rook.php');		$spRules 	= rookRules($locations,$newSpot,$oldSpot,$movingPiece,$rookStr);}
			if($movingPiece{0} == 'b'){include_once('rules/bishop.php'); 	$spRules 	= bishopRules($locations,$newSpot,$oldSpot,$movingPiece,$bishopStr);}
			if($movingPiece{0} == 'n'){include_once('rules/knight.php'); 	$spRules 	= knightRules($locations,$newSpot,$oldSpot,$movingPiece,$knightStr);}
			if($movingPiece{0} == 'p'){include_once('rules/pawn.php'); 		$spRules 	= pawnRules($locations,$newSpot,$oldSpot,$movingPiece,$lastMove,$pawnStr);}
		}
		//----if rules aren't followed don't move & let the player know
		if($spRules['error']){
			echo '<div id="info" class="badmove">'.$spRules['error'].'</div>';
			return $locations;
		//--continue			
		}else{		
			for($row=1;$row<=8;++$row){ 
				for($col=1;$col<=8;++$col){
					$square 	= chr(ord('a')-1+$col).(9-$row);
					$piece		= $locations[$square];
					if($square == $oldSpot) $piece = '';
					if($square == $newSpot){
						$piece 		= $movingPiece;
						$capture	= $locations[$newSpot];
						if($capture) $capNote = 'x';
					}
					$newLocations[$square] = $piece;
				}
			}
			// anytime the king moves turn off castling
			if($movingPiece{0} == 'k' && $canCastle['k'] == 1){$canCastle['k'] = 0; $canCastle['km'] = $moveNum;}
			// anytime the rook moves turn off castling to that side
			if($movingPiece{0} == 'r' && $oldSpot{0} == 'a' && $canCastle['a'] == 1){$canCastle['a'] = 0; $canCastle['am'] = $moveNum;}
			if($movingPiece{0} == 'r' && $oldSpot{0} == 'h' && $canCastle['h'] == 1){$canCastle['h'] = 0; $canCastle['hm'] = $moveNum;}
			$canCastle = serialize($canCastle);				
			//--move the rook if castled & set castling variable 			
			if($spRules['castled']){
				$moveNote				= $spRules['castled'];
				$rookSqF				= $spRules['rookSqF'];
				$rookSqT				= $spRules['rookSqT'];
				$newLocations[$rookSqF] = ''; 			// empty the rook's old spot
				$newLocations[$rookSqT] = 'r'.$playerColor;	
				$notePiece 				= $spRules['castled'];
				unset($newSpot);
			}
			//--promote the pawn
			if($promote){
				$newLocations[$newSpot] = ($promote).$playerColor;
				$pawnPromo				= '='.strtoupper($promote);
			}
			if($spRules['promo'] && !$promote){
				$_SESSION['oldSpot'.$gameID] = $oldSpot;
				echo '<div class="opt" style="position:absolute;top:13em;left:8em;width:17em;height:6.5em;padding:1em;z-index:99;">
					Promote to:<br /><br />
					<form action=board.php method=post style="float:left;margin:2px">
						<input type="hidden" name="do" value="move" />
						<input type="hidden" name="promote" value="q" />
						<input type="hidden" name="newSpot" value="',$newSpot,'" />
						<input type="hidden" name="gameID" value="',$gameID,'" />
						<input type="image" value="submit" src="img/queenB.png" alt="Queen" style="border:1px #999 solid" />
					</form>
					<form action=board.php method=post style="float:left;margin:2px">
						<input type="hidden" name="do" value="move" />
						<input type="hidden" name="promote" value="b" />
						<input type="hidden" name="newSpot" value="',$newSpot,'" />
						<input type="hidden" name="gameID" value="',$gameID,'" />
						<input type="image" value="submit" src="img/bishopB.png" alt="bishop" style="border:1px #999 solid" />
					</form>
					<form action=board.php method=post style="float:left;margin:2px">
						<input type="hidden" name="do" value="move" />
						<input type="hidden" name="promote" value="r" />
						<input type="hidden" name="newSpot" value="',$newSpot,'" />
						<input type="hidden" name="gameID" value="',$gameID,'" />
						<input type="image" value="submit" src="img/rookB.png" alt="rook" style="border:1px #999 solid" />
					</form>
					<form action=board.php method=post style="float:left;margin:2px">
						<input type="hidden" name="do" value="move" />
						<input type="hidden" name="promote" value="n" />
						<input type="hidden" name="newSpot" value="',$newSpot,'" />
						<input type="hidden" name="gameID" value="',$gameID,'" />
						<input type="image" value="submit" src="img/knightB.png" alt="knight" style="border:1px #999 solid" />
					</form>
				</div>';
				return $locations;
			}
			//--en passant
			$thisMove['twoSpaces'] = $spRules['twoSpaces'];
			if($spRules['cap']){
				$capSq					= $spRules['cap'];
				$newLocations[$capSq]	= '';
			}
			//--did the player put the opponent in check
			if($playerColor == 'd'){$kingSq = array_search('kl',$newLocations); }else{ $kingSq = array_search('kd',$newLocations); }
			$check = aThreat($kingSq,$newLocations,$playerColor);
			if($check) $checkNote = '+';
			if($check){
				include_once('rules/mate.php');
				if($checkmate) $checkNote = $checkmate;
			}	
			//--write the notation
			if(!$notePiece) $notePiece	= strtoupper($movingPiece{0});
			if($notePiece == 'P'){
				$notePiece = '';
				if($capNote) $notePiece = $oldSpot{0};
			}
			if(isset($spRules['notePiece'])) $notePiece = $spRules['notePiece'];  //if we need to be specific ex Rea3
			$moveNote	= $notePiece.$capNote.$newSpot.$pawnPromo.$checkNote;
			$thisMove['move'] = $moveNote;
			//--discover if the player is putting him/herself into check
			$kingSq = array_search('k'.$playerColor,$newLocations);
			$selfCheck 	= aThreat($kingSq,$newLocations,$defColor);
			if($selfCheck) $spRules['error']	= $movesStr[8];
			//one last illegal move check (to see if player puts her/himself into check -- can only be done once we see what the new board looks like)
			if($spRules['error']){
				echo '<div id="info" class="badMove">'.($spRules['error']).'</div>';
				return $locations;
			}else{		
				//--throw the notation into the moves DB
				if($playerColor == 'l'){
					$queryNote		= 'INSERT INTO '.dbPre.'moves (gameID,moveNum,whiteMove) VALUES ("'.$gameID.'","'.$moveNum.'","'.$moveNote.'")';
					$nextMoveNum	= $moveNum;
					$nextTurnColor	= 'black';
				}else{
					$queryNote		= 'UPDATE '.dbPre.'moves SET blackMove="'.$moveNote.'" WHERE gameID="'.$gameID.'" AND moveNum="'.$moveNum.'"';
					$nextMoveNum	= $moveNum + 1;
					$nextTurnColor	= 'white';
				}
				mysql_query($queryNote)or die('<div class="error">'.errorDBStr.' (mv-1)</div>');	
				//--format the array and throw it into the DB, then send out the new array
				$newLocationsDB 	= serialize($newLocations);
				$thisMove			= serialize($thisMove);				
				$now			 	= date(YmdHis);
				$color				= ($playerColor == 'd')? 'b' : 'w';
				$queryMove 			= 'UPDATE '.dbPre.'games SET setup=\''.$newLocationsDB.'\', nextMoveNum="'.$nextMoveNum.'", nextTurnColor="'.$nextTurnColor.'", '.$color.'Castle=\''.$canCastle.'\', lastMove=\''.$thisMove.'\', gameDate="'.$now.'", reqDraw="0", reqUndo="0" WHERE gameID="'.$gameID.'"';
				mysql_query($queryMove)or die('<div class="error">'.errorDBStr.' (mv-2)</div>');
				if(isset($checkmate)){
					include('gameFunc.php');
					mated($oppID,$gameID,$matedStr);
				}
				if($emailMove){
					//--email move
					include('config.php');				
					$queryemail		= 'SELECT '.dbPre.'email FROM players WHERE id="'.$oppID.'" LIMIT 1';
					$resultemail	= mysql_query($queryemail)or die('<div class="error">'.errorDBStr.' (mv-3)</div>');
					$addr			= mysql_result($resultemail,0,'email');
					$message		= $emailStr[1].$_SESSION['vs'.$gameID].$emailStr[2].$_SESSION['name'].$emailStr[3].$moveNote.$emailStr[4].$gameID.')';
					$headers  	= 'MIME-Version: 1.0
Content-type: text/plain; charset=iso-8859-1
Date: '.date("r").'
X-Priority: 3
X-Mailer: Some Chess
';
					$headers 	.= 'From: "Some Chess" <somechess@'.$domain.'>';
					if($addr) mail($addr,$emailStr[0],$message,$headers);
				}
				return $newLocations;
			}
		}
	}else{
		echo '<div id="info" class="badMove">',$message,'</div>';
		return $locations;
	}
}
?>
