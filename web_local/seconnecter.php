<?php 
//Fonction pour se connecter
	$base = @mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
	mysql_select_db ('recettes', $base) ;
?>