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
   
		<?php
		if (isset ($_POST['ajouter_carac'])){
		header("Location: ajoutercaracteristique.php");
		exit(); 
		}
		if (isset ($_POST['valider_ingredient'])){

		$base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
		mysql_select_db ('recettes', $base) ;

		//Ajout de l'ingredient
		$nom_ingredient=mysql_real_escape_string($_POST['NOM_INGREDIENT']);
		$nb_sql = 'SELECT NUMERO_INGREDIENT FROM ingredient where NOM_INGREDIENT="'.$nom_ingredient.'";';
		$result = mysql_query($nb_sql);
		if(mysql_num_rows($result) == 0)
		{

		$max_nb_ingredient = 'SELECT MAX(NUMERO_INGREDIENT) FROM INGREDIENT;';
		$result = mysql_query($max_nb_ingredient);
		$cur_nb = mysql_fetch_array($result);
		$cur_nb[0]++;
		//Ajout de l'ingredient
		$sql = 'insert into ingredient(numero_ingredient,nom_ingredient) values('.$cur_nb[0].',"'.$nom_ingredient.'")';
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