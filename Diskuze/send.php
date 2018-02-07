<?php
if($_POST['jmeno']==""){
	echo "Zadejte jméno!";
}
elseif($_POST['email']!="" && strpos($_POST['email'], '@') === false){
	echo "Zadejte email ve správném tvaru!";
}
elseif($_POST['textar']==""){
	echo "Zpráva nemůže být prázdná!";
}
elseif(!isset($_GET['id'])){
	$datum = Date("Y-m-d H:i:s");
	$msg = "INSERT INTO Prispevky (jmeno, email, obsah, datum)
						VALUES ('". $_POST['jmeno']."','". $_POST['email']."','". $_POST['textar']."','".$datum."')";

	$call = $mysql->prepare($msg);

	if (!$call->execute()) {
		echo "Error: " . $msg . "<br>" . $mysql->error;
	} else {
		echo "Zpráva byla odeslána";
	}
	
}
else{
	$datum = Date("Y-m-d H:i:s");
	$msg = "INSERT INTO Prispevky (jmeno, email, obsah, datum, reakce)
						VALUES ('". $_POST['jmeno']."','". $_POST['email']."','". $_POST['textar']."','".$datum."','".$_GET['id']."')";

	$call = $mysql->prepare($msg);

	if (!$call->execute()) {
		echo "Error: " . $msg . "<br>" . $call->error;
	} else {
		echo 'Reakce byla odeslána';
	}
	header('Location: index.php');
}
