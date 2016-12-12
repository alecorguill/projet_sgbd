<?php 
//Fonction pour se connecter
	$base = @mysql_connect ('localhost', 'lchaumartin', 'vivi86ga')or die("Impossible de se connecter : " . mysql_error());;  
	mysql_select_db ('lchaumartin', $base) ;
?>