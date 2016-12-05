    <?php session_start(); ?>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Les recettes gourmandes - Ajout menus</title>
	</head>
	<body>
		<h1>Les recettes gourmandes</h1>
		<div>

			<form name="add_menus" method="post" action="">
				Nom du menu : <input type="text" name="NOM_MENUS"/> <br/>
				Nombre de recettes dans le menu(s) : <input type='int' name="nb_recette"/> <br/>
				<input type="submit" name="valider_menu" value="OK"/>	     
			</form>


			<?php

			if (isset ($_POST['valider_recette'])){

				$base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
				mysql_select_db ('recettes', $base) ;

				$nb_sql = 'SELECT MAX(NOM_RECETTE) FROM recette;';
				$result = mysql_query($nb_sql);
				if (!$result) {
					die('Requête invalide : ' . mysql_error());
				}
   //mysql_query ($result) or die ('Erreur SQL !'.$result.'<br/>'.mysql_error());

				$cur_nb = mysql_fetch_array($result);

				$cur_nb[0]++;

	 //Affectation des valeurs donner par le client
				$nom=mysql_real_escape_string($_POST['NOM_RECETTE']);
		        $nb_sql = 'SELECT NUMERO_recette FROM recette where NOM_recette="'.$nom.'";';
		        $result = mysql_query($nb_sql);
		        if(mysql_num_rows($result) > 0){
		        	echo("cette recette existe deja");
		        	exit();
		        }
				$date=date('Y-n-d');
				$date=mysql_real_escape_string($date);

				$temps_prep=$_POST['TEMPS_PREPARATION_RECETTE'];
				if(!isset($temps_prep) || trim($temps_prep) == '')
				{
					echo "You did not fill out the required fields.";
					exit;
				} else 
				$temps_prep=(int) $_POST['TEMPS_PREPARATION_RECETTE'];



				$temps_cuis=$_POST['TEMPS_CUISSON_RECETTE'];
				if(!isset($temps_cuis) || trim($temps_cuis) == '') {
					echo "You did not fill out the required fields.";
					exit;
				} else
				$temps_cuis=(int) $_POST['TEMPS_CUISSON_RECETTE'];

				$nb_p= $_POST['NOMBRE_DE_PERSONNES'];
				if(!isset($nb_p) || trim($nb_p) == '') {
					echo "You did not fill out the required fields.";
					exit;
				} else
				$nb_p=(int) $_POST['NOMBRE_DE_PERSONNES'];



				$max_nb_recette = 'SELECT MAX(NUMERO_RECETTE) FROM RECETTE;';
				$result = mysql_query($max_nb_recette);
				$cur_nb = mysql_fetch_array($result);
				$cur_nb[0]++;
	 //Ajout de la recette
				$sql = 'insert into RECETTE(NUMERO_RECETTE,NOM_RECETTE,DATE_CREATION_RECETTE,TEMPS_PREPARATION_RECETTE,TEMPS_CUISSON_RECETTE,NOMBRE_DE_PERSONNES) values ('.$cur_nb[0].', "'.$nom.'", "'.$date.'", '.$temps_prep.', '.$temps_cuis.', '.$nb_p.')';
				mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
				$nb_ing = $_POST['nb_ingredient'];
				header("Location: ajouteringredientrecette.php?nb_ing=$nb_ing&nom_recette=$nom");
				mysql_close();
			}			

			?>

		</div>
	</body>
	</html>