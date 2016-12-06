<html>
<head>
	<meta charset="utf-8">
	<title>Les recettes gourmandes - Ajout</title>
</head>
<body>
	<h1>Ajout de la caracteristique pour un ingredient</h1>
	<div>

		<form name="add_carac" method="post" action="">
			Nom de l'ingredient : <input type="text" name="NOM_INGREDIENT_C"/> <br/>
			Nom de la caracteristique : <input type="text" name="NOM_CARAC"/> <br/>
			Valeur de la caracteristique : <input type="text" name="VALEUR_CARAC"/> <br/>
			<input type="submit" name="valider_carac" value="OK"/>	     
		</form>

		<form name="accueil" method="post" action="">
			<input type="submit" name="aller_acceuil" value="accueil"/>	  
		</form>
		<?php
		if (isset ($_POST['aller_acceuil'])){
			header("Location: index_client.html");
			exit(); 
		}
		?>
		<?php
		//Ajout de la caracteristique

		if(isset ($_POST['valider_carac'])){
			$base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
			mysql_select_db ('recettes', $base) ;
			$nom_ingredient_c=mysql_real_escape_string($_POST['NOM_INGREDIENT_C']);
			$nom_carac=mysql_real_escape_string($_POST['NOM_CARAC']);


		//On verifie que l'ingrédient existe
			$nb_sql = 'SELECT NUMERO_INGREDIENT FROM ingredient where NOM_INGREDIENT="'.$nom_ingredient_c.'";';
			$result = mysql_query($nb_sql) or die ('Erreur SQL !'.$nb_sql.'<br/>'.mysql_error());
			$tab = mysql_fetch_array($result);
			if (!$tab[0]) {
				die('Cette ingredient n\'existe pas');
			}
			else{

				$nb_sql = 'SELECT NUMERO_CARACTERISTIQUE FROM caracteristique_nutritionnelle where NOM_CARACTERISTIQUE="'.$nom_carac.'";';
				$result = mysql_query($nb_sql);
	//On ajoute la caractéristique si elle n'existe pas
				if(mysql_num_rows($result) == 0)
				{
					$max_nb_carac = 'SELECT MAX(NUMERO_CARACTERISTIQUE) FROM caracteristique_nutritionnelle;';
					$result = mysql_query($max_nb_carac);
					$cur_nb = mysql_fetch_array($result);
					$cur_nb[0]++;
	//Ajout de la caractéristique
					$sql = 'insert into caracteristique_nutritionnelle(numero_caracteristique,nom_caracteristique) values('.$cur_nb[0].',"'.$nom_carac.'")';
					mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
				}

//Ajout dans la table assosciation definition
//On recupere les eux clef etrangères
				$nb_carac = 'SELECT NUMERO_CARACTERISTIQUE FROM caracteristique_nutritionnelle where NOM_CARACTERISTIQUE="'.$nom_carac.'";';
				$nb_ingre = 'SELECT NUMERO_ingredient FROM ingredient where NOM_ingredient="'.$nom_ingredient_c.'";';
				$res_carac = mysql_fetch_array(mysql_query($nb_carac)) or die ('Erreur SQL !'.$nb_carac.'<br/>'.mysql_error());
				$res_ingre = mysql_fetch_array(mysql_query($nb_ingre)) or die ('Erreur SQL !'.$nb_ingre.'<br/>'.mysql_error());
				$valeur_carac= (int) $_POST['VALEUR_CARAC'];
				$sql = 'insert into definition(numero_ingredient,numero_caracteristique,valeur) values('.$res_ingre[0].','.$res_carac[0].','.$valeur_carac.');';
				$result = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());

			}
			mysql_close();
		}

		?>

	</div>
</body>
</html>