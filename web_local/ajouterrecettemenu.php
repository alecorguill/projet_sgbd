<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Les recettes gourmandes - Ajout</title>
</head>
<body>
	<?php
	$nb_rec      = $_GET['nb_rec'];
	$nom_menu = $_GET['nom_menu'];
	echo("<form name=\"add_recette\" method=\"post\" action=\"\">");
	for($i = 1; $i<=$nb_rec; $i++){
		echo("Recette $i: <input type=\"text\" name=\"NOM_RECETTE_$i\"/> <br/>");
			}
	echo("<input type=\"submit\" name=\"valider_recettes\" value=\"OK\"/>");
	echo("</form>");
	//Ajout dans la table contenu
	$base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
	mysql_select_db ('recettes', $base) ;
	if(isset($_POST['valider_recettes'])){
	$nb_menu       = 'SELECT NUMERO_menu FROM menu where NOM_MENU="'.$nom_menu.'";';
	$res_menu      = mysql_fetch_array(mysql_query($nb_menu)) or die ('Erreur SQL !'.$nb_menu.'<br/>'.mysql_error());
	for($i = 1; $i <=$nb_rec; $i++){
		//Recupere clef etrangère 	
		$nom_recette_i = mysql_real_escape_string($_POST["NOM_RECETTE_$i"]);
		$numero_recette    = 'SELECT NUMERO_recette FROM recette where NOM_recette="'.$nom_recette_i.'";';
		$res_recette        = mysql_fetch_array(mysql_query($numero_recette)) or die ('Erreur SQL !'.$numero_recette.'<br/>'.mysql_error());
		$sql              = 'insert into composition(NUMERO_RECETTE,NUMERO_menu) values('.$res_recette[0].','.$res_menu[0].');';
		$result = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
		header("Location: index_client.html");
		}
	}
		mysql_close();
		?>
	}
</div>
</body>
</html>