<html>
<head>
	<meta charset="utf-8">
	<title>Les recettes gourmandes - Ajout</title>
</head>
<body>
	<?php
	$nb_ing      = $_GET['nb_ing'];
	$nom_recette = $_GET['nom_recette'];
	echo("<form name=\"add_ingredients\" method=\"post\" action=\"\">");
	for($i = 1; $i<=$nb_ing; $i++){
		echo("Ingredient $i: <input type=\"text\" name=\"NOM_INGREDIENT_$i\"/> <br/>");
		echo("Quantité:        <input type='int'' name=\"QUANTITE_INGREDIENT_$i\"/> <br/>");
		echo("Unité:           <input type=\"text\" name=\"UNITE_INGREDIENT_$i\"/> <br/>");
	}
	echo("<input type=\"submit\" name=\"valider_ingredients\" value=\"OK\"/>");
	echo("</form>");
	//Ajout dans la table contenu
	$base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
	mysql_select_db ('recettes', $base) ;
	if(isset($_POST['valider_ingredients'])){
	for($i = 1; $i <=$nb_ing; $i++){
		//Recupere clef etrangère 	
		echo($nom_recette);
		$nb_recette       = 'SELECT NUMERO_RECETTE FROM recette where NOM_RECETTE="'.$nom_recette.'";';
		$nom_ingredient_i = mysql_real_escape_string($_POST["NOM_INGREDIENT_$i"]);
		echo($nom_ingredient_i);
		$nb_ingredient    = 'SELECT NUMERO_INGREDIENT FROM ingredient where NOM_ingredient="'.$nom_ingredient_i.'";';
		$res_recette      = mysql_fetch_array(mysql_query($nb_recette)) or die ('Erreur SQL !'.$nb_recette.'<br/>'.mysql_error());
		$res_ingre        = mysql_fetch_array(mysql_query($nb_ingredient)) or die ('Erreur SQL !'.$nb_ing.'<br/>'.mysql_error());
		$unite            = mysql_real_escape_string($_POST["UNITE_INGREDIENT_$i"]);
		$quantite         = (int) $_POST["QUANTITE_INGREDIENT_$i"];
		$sql              = 'insert into contenu(NUMERO_RECETTE,NUMERO_ingredient, QUANTITE, UNITE) values('.$res_recette[0].','.$res_ingre[0].','.$quantite.', "'.$unite.'");';
		$result = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());

		}
	}
		mysql_close();
		?>
	}
</div>
</body>
</html>