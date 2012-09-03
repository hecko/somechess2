<?php
//	Some Chess, a PHP multi-player chess server.
//    Copyright (C) 2007 Jon Link
function mostStat($most,$stats,$numPlayer,$statsStr,$orderLink=null,$spChar=null){
	for($i=0;$i<$numPlayer;++$i){
		if($stats[$i][$most] >= $top) $top = $stats[$i][$most];
	}
	if($top > 0){	
		for($j=0;$j<$numPlayer;++$j){
			if($stats[$j][$most] == $top) $list	.= '<a href="players.php?statID='.$stats[$j]['id'].$orderLink.'">'.$stats[$j]['name'].'</a>, ';
		}
	}else{
		$top = $statsStr[5];
	}
	return substr($list,0,-2).' ('.$top.$spChar.')';
}
function randomStat($stats,$numPlayer,$num){
	if($numPlayer > 5){
		$label	= array('Closest to Bodhi','Best Haricut','Most Soulful','Best Dentist','Most Angry','Most Cynical','Hardest to Catch','Best in Blue','Probably a Nudist',
		'Best in Pink','Fastest Runner','Best Dancer','Best Dressed','Funniest','Best Tuba Player','Holy Spirit','Best Spelunker','Most Statuesque','Most Harlequin',
		'Most Indie','Most Emo','Best Ferret Racer','Smallest Juggler','Worst Gypsum','Most Scientific','Most Gastronomic','Best Fan','Worst Telephone','Most Telekenetic',
		'Most Industrious','Best Hussar','Entirely Believable','Most Itinerant','Most Forthwith','Best Gardyloo','Nicest Ilke','Most Iwis','Most Puissant','Best Sweven',
		'Heaviest Ducats','Most Rantipole','Best Whitesmith','Cleanest Sofa','Best Cannonball','Best Mind Reader','Most Cat-Like','Tidiest','Toughest','Explosivest',
		'Most Likely','Best Astrologist','Most Sensible','Hungriest','Best Pickler','Most Serious','Loudest','Worst Umbrella','Best Economist','Compactest','Clearly Insane',	
		'Slightly Tan','Worst Meteorologist','Best Geode','Most General','Worst Magician','Most Church-Like','Worst Ninja','Made of Bees','Nicest Nationalist','Most Transportable');
		$labelArray = array();
		$nameArray = array();
		for($x=0;$x<$num;++$x){
			$n	= rand(0,($numPlayer-1));
			$l	= rand(0,(count($label)-1));
			if(array_search($l,$labelArray) === false && array_search($n,$nameArray) === false){
				$theStats .= '<p><h5>'.$label[$l].'</h5>'.$stats[$n]['name'].'</p>';
			}else{
				--$x;
			}
			$labelArray[] 	= $l;
			$nameArray[] 	= $n;
		}
	}
	return $theStats;
}
function noEmpty($string){
	if($string === '') $string = '---';
	return $string;
}
function barWidth($numP,$numA,$bar){
	while($numP > 100 || $numA > 100){ $numP = $numP/2; $numA = $numA/2; }
	$num	= ($bar == 'p')? $numP : $numA;
	return ($num/100)*100;
}
function average($field,$stats,$numPlayer){
	for($z=0;$z<$numPlayer;++$z) if($stats[$z]['games']>0) $total	= $stats[$z][$field] + $total;
	$average	= number_format($total/$numPlayer,2);
	return $average;
}
function formatDate($date){
	$date	= ereg_replace('[^0-9]','',$date);
	return substr($date,0,4).'.'.substr($date,4,2).'.'.substr($date,6,2);
}
?>