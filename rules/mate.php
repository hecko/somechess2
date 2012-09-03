<?php
function pawnBlock($threatSq,$locations,$defColor){
	if($threatSq{1} == 5 && $defColor == 'd'){
	//--black block from 2 sq's away
		$isPawnSpot = $threatSq{0}.($threatSq{1}+2);
	}elseif($threatSq{1} == 4 && $defColor == 'l'){
	//--white block from 2 sq's away
		$isPawnSpot = $threatSq{0}.($threatSq{1}-2);
	}
	if($locations[$isPawnSpot]{0} == 'p') $pawnBlocked = true;
	if($defColor == 'd'){
		$isPawnSpot = $threatSq{0}.($threatSq{1}+1);
	}elseif($defColor == 'l'){
		$isPawnSpot = $threatSq{0}.($threatSq{1}-1);
	}
	if($locations[$isPawnSpot]{0} == 'p') $pawnBlocked = true;
	return $pawnBlocked;
}
function legalMove($possLocations,$possPiece,$possSq,$currSq){
	if($possPiece{0} == 'q'){include_once('rules/queen.php'); 	$legal 	= queenRules($possLocations,$possSq,$currSq,$possPiece);}
	if($possPiece{0} == 'r'){include_once('rules/rook.php');	$legal 	= rookRules($possLocations,$possSq,$currSq,$possPiece);}
	if($possPiece{0} == 'b'){include_once('rules/bishop.php'); 	$legal 	= bishopRules($possLocations,$possSq,$currSq,$possPiece);}
	if($possPiece{0} == 'n'){include_once('rules/knight.php'); 	$legal 	= knightRules($possLocations,$possSq,$currSq,$possPiece);}
	if(is_array($legal)) if(array_key_exists('error', $legal)) return false;
	return true;
}
//can the king move out of check
$square			= $kingSq{0}.($kingSq{1}+1);
if($square{1}<=8) $newKingSq[] = $square;
$square			= $kingSq{0}.($kingSq{1}-1);
if($square{1}>=1) $newKingSq[] = $square;
$square			= (chr(ord($kingSq{0})+1)).$kingSq{1};
if(ord($square{0})<=104) $newKingSq[] = $square;
$square			= (chr(ord($kingSq{0})-1)).$kingSq{1};
if(ord($square{0})>=97) $newKingSq[] = $square;
$square			= (chr(ord($kingSq{0})+1)).($kingSq{1}+1);
if(ord($square{0})<=104 && $square{1}<=8) $newKingSq[] = $square;
$square			= (chr(ord($kingSq{0})+1)).($kingSq{1}-1);
if(ord($square{0})<=104 && $square{1}>=1) $newKingSq[] = $square;
$square			= (chr(ord($kingSq{0})-1)).($kingSq{1}-1);
if(ord($square{0})>=97 && $square{1}>=1) $newKingSq[] = $square;
$square			= (chr(ord($kingSq{0})-1)).($kingSq{1}+1);
if(ord($square{0})>=97 && $square{1}<=8) $newKingSq[] = $square;
$kingPiece	= ($playerColor == 'd')? 'kl' : 'kd';
$num = count($newKingSq);
for($x=0;$x<$num;++$x){
	unset($mate,$illegal);
	if($newLocations[$newKingSq[$x]]{1} == $kingPiece{1}) $illegal = true;
	$possLocations					= $newLocations;
	$possLocations[$kingSq] 		= '';
	$possLocations[$newKingSq[$x]] 	= $kingPiece;	
	if(!$illegal){
		$mate	= aThreat($newKingSq[$x],$possLocations,$playerColor);
		$moves[$x]	= ($mate)? '+' : '';
	}
}
if(in_array('',$moves) === false){
//-- can the threat be captured
	$checkNum	= count($check);	
	$canCapture	= aThreat($check[0],$locations,$defColor);
	$capNum		= count($canCapture);
	for($x=0;$x<$capNum;++$x){
		$possLocations					= $locations;
		$possLocations[$canCapture[$x]]	= '';
		$possPiece						= $locations[$canCapture[$x]];
		$possLocations[$check[0]]		= $possPiece;
		$newKingSq 	= ($playerColor == 'd')? array_search('kl',$possLocations) : array_search('kd',$possLocations);
		$mate		= aThreat($newKingSq,$possLocations,$playerColor);
		if(!$mate && legalMove($possLocations,$possPiece,$check[0],$canCapture[$x])) $legalCap = true;
	}
	if($legalCap !== true) unset($canCapture);
//-- if the threat can't be captured, can it be blocked
	if(!$canCapture){
		$checkPiece = $newLocations[$check[0]];
		if($checkPiece{0} == 'r' || $checkPiece{0} == 'q'){
			if($check[0]{0} == $kingSq{0}){
				if($kingSq{1} < $check[0]{1}){
				//--check up
					$num			= $check[0]{1} - $kingSq{1};
					$legalBlock		= false;
					//is there a piece that can move to threatSQ to block
					for($y=1;$y<$num;++$y){
						$threatSq 	= $kingSq{0}.($kingSq{1}+$y);
						$blocker 	= aThreat($threatSq,$newLocations,$kingPiece{1});
						$blockCount = count($blocker);
						//if the piece moves to block will it create a new line of check?
						for($w=0;$w<$blockCount;++$w){
							$possLocations					= $newLocations;
							$possPiece						= $possLocations[$blocker[$w]];
							if($possPiece{0} !== 'k' && $possPiece{0} !== 'p'){
								$possLocations[$blocker[$w]]	='';
								$possLocations[$threatSq]		= $possPiece;
								$possKingSq = array_search('k'.$defColor,$possLocations);
								$newThreat	= aThreat($possKingSq,$possLocations,$playerColor); //would moving this piece create a new threat?
								if(!$newThreat && legalMove($possLocations,$threatSq,$blocker[$w],$possPiece)){$legalBlock = true;break;}
							}else{
								$legalBlock = false;
							}
						}
						if($blocker && $legalBlock) $blocked[] = $threatSq;
					}
				}else{
				//--check down			
					$num			= $kingSq{1} - $check[0]{1};
					$legalBlock 	= false;
					for($y=1;$y<$num;++$y){
						$threatSq 	= $kingSq{0}.($kingSq{1}-$y);
						$blocker 	= aThreat($threatSq,$newLocations,$kingPiece{1});
						$blockCount = count($blocker);
						for($w=0;$w<$blockCount;++$w){
							$possLocations					= $newLocations;
							$possPiece						= $possLocations[$blocker[$w]];
							if($possPiece{0} !== 'k' && $possPiece{0} !== 'p'){
								$possLocations[$blocker[$w]]	='';
								$possLocations[$threatSq]		= $possPiece;
								$possKingSq = array_search('k'.$defColor,$possLocations);
								$newThreat	= aThreat($possKingSq,$possLocations,$playerColor);
								if(!$newThreat && legalMove($possLocations,$threatSq,$blocker[$w],$possPiece)){$legalBlock = true;break;}
							}else{
								$legalBlock = false;
							}
						}
						if($blocker && $legalBlock) $blocked[] = $threatSq;
					}					
				}
			}else{
				if(ord($kingSq{0}) < ord($check[0]{0})){
				//--check left 
					$num			= ord($check[0]{0}) - ord($kingSq{0});
					$legalBlock 	= false;
					for($y=1;$y<$num;++$y){
						$threatSq 	= (chr(ord($kingSq{0})+$y)).$kingSq{1};
						$blocker 	= aThreat($threatSq,$newLocations,$kingPiece{1});
						$blockCount = count($blocker);
						for($w=0;$w<$blockCount;++$w){
							$possLocations					= $newLocations;
							$possPiece						= $possLocations[$blocker[$w]];
							if($possPiece{0} !== 'k' && $possPiece{0} !== 'p'){
								$possLocations[$blocker[$w]]	='';
								$possLocations[$threatSq]		= $possPiece;
								$possKingSq = array_search('k'.$defColor,$possLocations);								
								$newThreat	= aThreat($possKingSq,$possLocations,$playerColor);
								if(!$newThreat && legalMove($possLocations,$threatSq,$blocker[$w],$possPiece)){$legalBlock = true;break;}
							}else{
								$legalBlock = false;
							}
						}
						if($blocker && $legalBlock) $blocked[] = $threatSq;
					}
				}else{
				//--check right
					$num			= ord($kingSq{0}) - ord($check[0]{0});
					$legalBlock 	= false;
					for($y=1;$y<$num;++$y){
						$threatSq 	= (chr(ord($kingSq{0})-$y)).$kingSq{1};
						$blocker 	= aThreat($threatSq,$newLocations,$kingPiece{1});
						$blockCount = count($blocker);
						for($w=0;$w<$blockCount;++$w){
							$possLocations					= $newLocations;
							$possPiece						= $possLocations[$blocker[$w]];
							if($possPiece{0} !== 'k' && $possPiece{0} !== 'p'){
								$possLocations[$blocker[$w]]	='';
								$possLocations[$threatSq]		= $possPiece;
								$possKingSq = array_search('k'.$defColor,$possLocations);								
								$newThreat	= aThreat($possKingSq,$possLocations,$playerColor);
								if(!$newThreat && legalMove($possLocations,$threatSq,$blocker[$w],$possPiece)){$legalBlock = true;break;}
							}else{
								$legalBlock = false;
							}
						}
						if($blocker && $legalBlock) $blocked[] = $threatSq;
					}
				}
			}
		}
		if($checkPiece{0} == 'b' || $checkPiece{0} == 'q'){
			if(ord($kingSq{0}) > ord($check[0]{0}) && $kingSq{1} > $check[0]{1}){
			//--up & right
				$num				= ($kingSq{1} - $check[0]{1}) -1;
				for($y=1;$y<=$num;++$y){
					$squareFile		= chr(ord($check[0]{0}) + $y);
					$squareRank		= $check[0]{1} + $y;
					$threatSq 		= $squareFile.$squareRank;
					$blocker 		= aThreat($threatSq,$newLocations,$playerColor);
					$pawnBlocker	= pawnBlock($threatSq,$newLocations,$playerColor);	
					if(($blocker && !in_array($kingSq,$blocker)) || $pawnBlocker){ $blocked[] = $threatSq; break; }
				}
			}elseif(ord($kingSq{0}) > ord($check[0]{0}) && $kingSq{1} < $check[0]{1}){
			//--up & left
				$num				= ($check[0]{1} - $kingSq{1}) -1;
				for($y=1;$y<=$num;++$y){
					$squareFile		= chr(ord($check[0]{0}) + $y);
					$squareRank		= $check[0]{1} - $y;
					$threatSq 		= $squareFile.$squareRank;
					$blocker 		= aThreat($threatSq,$newLocations,$playerColor);
					$pawnBlocker	= pawnBlock($threatSq,$newLocations,$playerColor);								
					if(($blocker && !in_array($kingSq,$blocker)) || $pawnBlocker){ $blocked[] = $threatSq; break; }
				}	
			}elseif(ord($kingSq{0}) < ord($check[0]{0}) && $kingSq{1} < $check[0]{1}){
			//--up & right (from white side)
				$num				= ($check[0]{1} - $kingSq{1}) -1;
				for($y=1;$y<=$num;++$y){
					$squareFile		= chr(ord($check[0]{0}) - $y);
					$squareRank		= $check[0]{1} - $y;
					$threatSq 		= $squareFile.$squareRank;
					$blocker 		= aThreat($threatSq,$newLocations,$playerColor);
					$pawnBlocker	= pawnBlock($threatSq,$newLocations,$playerColor);				
					if(($blocker && !in_array($kingSq,$blocker)) || $pawnBlocker){ $blocked[] = $threatSq; break; }
				}	
			}elseif(ord($kingSq{0}) < ord($check[0]{0}) && $kingSq{1} > $check[0]{1}){
			//--up & left
				$num				= ($kingSq{1} - $check[0]{1}) -1;
				for($y=1;$y<=$num;++$y){
					$squareFile		= chr(ord($check[0]{0}) - $y);
					$squareRank		= $check[0]{1} + $y;
					$threatSq 		= $squareFile.$squareRank;
					$blocker 		= aThreat($threatSq,$newLocations,$playerColor);
					$pawnBlocker	= pawnBlock($threatSq,$newLocations,$playerColor);
					if(($blocker && !in_array($kingSq,$blocker)) || $pawnBlocker){ $blocked[] = $threatSq; break; }
				}
			}
		}
		if(empty($blocked)) $checkmate = '#';
	}	
}