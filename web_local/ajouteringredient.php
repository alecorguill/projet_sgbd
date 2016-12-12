<html>
<head>
	<meta charset="utf-8">
	<title>Les recettes gourmandes - Ajout</title>
</head>
<body>
	<h1>Les recettes gourmandes</h1>
	<div>

		<form name="add_ingredient" method="post" action="">
			Nom de l'ingredient : <input type="text" name="NOM_INGREDIENT"/> <br/>
			<input type="submit" name="valider_ingredient" value="OK"/>	     
		</form>
		<form name="add_carac" method="post" action="">
			Pour ajouter une caracteristique à un ingrédient<input type="submit" name="ajouter_carac" value="OK"/>	  
		</form>
		<form name="accueil" method="post" action="">
			<input type="submit" name="aller_acceuil" value="Accueil"/>	  
		</form>
		<?php
		if (isset ($_POST['aller_acceuil'])){
			header("Location: index_client.html");
			exit(); 
		}
		if (isset ($_POST['ajouter_carac'])){
			header("Location: ajoutercaracteristique.php");
			exit(); 
		}
		if (isset ($_POST['valider_ingredient'])){

		include('seconnecter.php');

		//Ajout de l'ingredient
			$nom_ingredient=mysql_real_escape_string($_POST['NOM_INGREDIENT']);
			$nb_sql = 'SELECT NUMERO_INGREDIENT FROM INGREDIENT where NOM_INGREDIENT="'.$nom_ingredient.'";';
			$result = mysql_query($nb_sql);
			if(mysql_num_rows($result) == 0)
			{

				$max_nb_ingredient = 'SELECT MAX(NUMERO_INGREDIENT) FROM INGREDIENT;';
				$result = mysql_query($max_nb_ingredient);
				$cur_nb = mysql_fetch_array($result);
				$cur_nb[0]++;
		//Ajout de l'ingredient
				$sql = 'insert into INGREDIENT(NUMERO_INGREDIENT,NOM_INGREDIENT) values('.$cur_nb[0].',"'.$nom_ingredient.'")';
				mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
			}
			else {
				echo('Cet ingredient existe deja');
			}
			mysql_close();
		}
		?>

	</div>
</body>
</html>
