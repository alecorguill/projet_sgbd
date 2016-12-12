<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<title>Les recettes gourmandes - Ajout</title>
</head>
<body>
	<h1>Ajout de la catégorie pour une recette</h1>
	<div>

		<form name="add_cate" method="post" action="">
			Nom de la recette : <input type="text" name="NOM_recette"/> <br/>
			Nom de la categorie : <input type="text" name="NOM_CATE"/> <br/>
			<input type="submit" name="valider_cate" value="OK"/>	     
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

		if(isset ($_POST['valider_cate'])){
			include('seconnecter.php');
			$nom_r=mysql_real_escape_string($_POST['NOM_recette']);
			$nom_c=mysql_real_escape_string($_POST['NOM_CATE']);
			$numero_internaute = $_SESSION['id'];


		//On verifie que la recette existe
			$nb_sql = 'SELECT NUMERO_RECETTE FROM RECETTE where NOM_RECETTE="'.$nom_r.'";';
			$result = mysql_query($nb_sql) or die ('Erreur SQL !'.$nb_sql.'<br/>'.mysql_error());
			if ((mysql_num_rows($result) == 0)) {
				die('Cette recette n\'existe pas');
			}
			else{

				$nb_sql = 'SELECT NUMERO_CATEGORIE FROM CATEGORIE where NOM_CATEGORIE="'.$nom_c.'";';
				$result = mysql_query($nb_sql);
	//On ajoute la categorie si elle n'existe pas
				if(mysql_num_rows($result) == 0)
				{
					$max_nb_cate = 'SELECT MAX(NUMERO_categorie) FROM categorie;';
					$result = mysql_query($max_nb_cate);
					$cur_nb = mysql_fetch_array($result);
					$cur_nb[0]++;
	//Ajout de la caractéristique
					$sql = 'insert into CATEGORIE(NUMERO_CATEGORIE, NUMERO_INTERNAUTE, NOM_CATEGORIE) values('.$cur_nb[0].', '.$numero_internaute.', "'.$nom_c.'")';
					mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
				}

//Ajout dans la table assosciation appartient
//On recupere les eux clef etrangères
				$nb_cate           = 'SELECT NUMERO_CATEGORIE FROM CATEGORIE where NOM_CATEGORIE="'.$nom_c.'";';
				$nb_recette        = 'SELECT NUMERO_RECETTE FROM RECETTE where NOM_RECETTE="'.$nom_r.'"';
				$res_cate          = mysql_fetch_array(mysql_query($nb_cate)) or die ('Erreur SQL !'.$nb_cate.'<br/>'.mysql_error());
				$res_recette       = mysql_fetch_array(mysql_query($nb_recette)) or die ('Erreur SQL !'.$nb_recette.'<br/>'.mysql_error());
				$categorie_of_recette = 'SELECT * from APPARTIENT where NUMERO_RECETTE='.$res_recette[0].' and NUMERO_CATEGORIE='.$res_cate[0].'';
				$res_categorie_of_recette        = mysql_query($categorie_of_recette) or die ('Erreur SQL !'.$categorie_recette.'<br/>'.mysql_error());
				if((mysql_num_rows($res_categorie_of_recette) > 0)){
					echo('Cette recette est deja dans cette catégorie');
					exit();
				}
				else{
				$sql               = 'insert into APPARTIENT(numero_recette,numero_categorie) values('.$res_recette[0].','.$res_cate[0].');';
				$result            = mysql_query($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
				}
			}
			mysql_close();
		}

		?>

	</div>
</body>
</html>
