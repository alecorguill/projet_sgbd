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
	include('seconnecter.php');
	if(isset($_POST['valider_recettes'])){
		for($i = 1; $i <=$nb_rec; $i++){
			$nom_recette_i = mysql_real_escape_string($_POST["NOM_RECETTE_$i"]);
			$numero_recette    = 'SELECT NUMERO_RECETTE FROM RECETTE where NOM_RECETTE="'.$nom_recette_i.'";';
			$res_recette        = mysql_query($numero_recette) or die ('Erreur SQL !'.$numero_recette.'<br/>'.mysql_error());
			if(mysql_num_rows($res_recette) <= 0){
				die('La recette ' . $i . ' n\'existe pas');
			}
		}
		$nb_menu       = 'SELECT NUMERO_MENU FROM MENU where NOM_MENU="'.$nom_menu.'";';
		$res_menu      = mysql_fetch_array(mysql_query($nb_menu)) or die ('Erreur SQL !'.$nb_menu.'<br/>'.mysql_error());
		for($i = 1; $i <=$nb_rec; $i++){
		//Recupere clef etrangère 	
			$nom_recette_i = mysql_real_escape_string($_POST["NOM_RECETTE_$i"]);
			$numero_recette    = 'SELECT NUMERO_RECETTE FROM RECETTE where NOM_RECETTE="'.$nom_recette_i.'";';
			$res_recette        = mysql_query($numero_recette) or die ('Erreur SQL !'.$numero_recette.'<br/>'.mysql_error());
			$res_recette = mysql_fetch_array($res_recette);
			$sql              = 'insert into COMPOSITION(NUMERO_RECETTE,NUMERO_MENU) values('.$res_recette[0].','.$res_menu[0].');';
			$result = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
		}
		header("Location: index_client.html");
	}
	mysql_close();
	?>
</div>
</body>
</html>
