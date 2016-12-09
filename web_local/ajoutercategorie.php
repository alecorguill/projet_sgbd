<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Les recettes gourmandes - Ajout catégorie</title>
</head>
<body>
	<h1>Les recettes gourmandes</h1>
	<div>

		<form name="add_categorie" method="post" action="">
			Nom de la catégorie : <input type="text" name="NOM_CATEGORIE"/> <br/>
			<input type="submit" name="valider_categorie" value="OK"/>	     
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
		if (isset ($_POST['valider_categorie'])){

			include('seconnecter.php');
			$numero_internaute=$_SESSION['id'];
			$nom_categorie=mysql_real_escape_string($_POST['NOM_CATEGORIE']);
			$nb_sql = 'SELECT NUMERO_categorie FROM categorie where NOM_categorie="'.$nom_categorie.'" and numero_internaute='.$numero_internaute.';';
			$result = mysql_query($nb_sql);
			if(mysql_num_rows($result) == 0)
			{

				$max_nb_categorie = 'SELECT MAX(NUMERO_categorie) FROM categorie;';
				$result = mysql_query($max_nb_categorie);
				$cur_nb = mysql_fetch_array($result);
				$cur_nb[0]++;
		//Ajout de la categorie
				$sql = 'insert into categorie(numero_categorie,numero_internaute,nom_categorie) values('.$cur_nb[0].', '.$numero_internaute.', "'.$nom_categorie.'")';
				mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
			}
			else {
				echo('Cette Catégorie existe déja');
			}
			mysql_close();
		}
		?>

	</div>
</body>
</html>