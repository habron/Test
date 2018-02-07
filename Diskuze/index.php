<?php 
		$mysql = new mysqli("localhost", "root", "", "diskuze");
		
		if ($mysql->connect_error) {
			die("Connection failed: " . $mysql->connect_error);
		} 
		
		if($_POST){
			include 'send.php'; //načtení scriptu pro odeslání příspěvku
		}
?>



<!Doctype HTML>
<html>
  <head>
    <title>Title of the document</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="diskuze.css">
  </head>
  <body>
    <header>
    	<h1>Diskuze</h1>
    </header>
   <?php 
   
   if(isset($_GET['id'])){
   	echo '<a id="rek" href="index.php" title="Zpět na přidání příspěvku">Reakce na příspěvek</a>';
   }
   
   ?>
   
   
    <form method="post">
    	<label for="jmeno">Jméno*:</label>
    	<input type="text" id="jmeno" name ="jmeno" required>
    	<br>
    	<label for="email">Email:</label>
    	<input type="email" id="email" name ="email">
    	<br>
    	<textarea rows="3" cols="50" id="textar" name ="textar" placeholder="Zde napište příspěvek*"></textarea>
    	<input type="submit" id="tlacitko" value="Odeslat">
    </form>
    <p id="mezera"> </p>
    
    <?php 
    	include 'load.php'; //načtení příspěvků
    
    ?>
    <br>
   <footer>
  	 <p>Copyright © Ondřej Habr 2018</p>
   </footer>
  </body>
</html>