<?php

function vypis($prispevek, $b){
				
		echo '<div class="a'.$b.'" style="position: relative; left:'.$b.'px;">';
		echo "<br><b>".$prispevek['jmeno'] . "</b><br>";
		if($prispevek['email'] != "") {echo $prispevek['email'] . "<br>";}
		echo '<p class="datum">'.$prispevek['datum'].'</p>';
		echo $prispevek['obsah'] . "<br>";
		echo '<a href="index.php?id='.$prispevek['id'].'">Reagovat</a>';
		echo '</div>';
	
}

$msg = "SELECT * FROM Prispevky WHERE reakce=0 ORDER BY datum DESC";
$result = $mysql->query($msg);
if ($result->num_rows > 0) {

	foreach($result as $prispevek){

		$left = 10;
		vypis($prispevek, $left);

		up:
		$reply = 0;
		$slide = 1;
		$msg = "SELECT * FROM Prispevky WHERE reakce=".$prispevek['id']." ORDER BY datum";
		$react = $mysql->query($msg);
		if ($react->num_rows > 0) {
			
			reactto:
			foreach($react as $reakce){
				if(!isset($said[$reakce['id']])) {
					$left = $slide*10;
					$left = $left + 30;
					vypis($reakce, $left);

					$msg = "SELECT * FROM Prispevky WHERE reakce=" . $reakce['id'] . " ORDER BY datum";

					$react2 = $mysql->query($msg);

					$said[$reakce['id']] = true;
					if ($react2->num_rows > 0) {
						$reply = 1;
						$react = $react2;
						$slide = $slide + 2;
						goto reactto;
					}
				}
			}
			if($reply == 1){
				goto up;
			}
		}
	}
} else {
	echo "0 results";
}
$mysql->close();