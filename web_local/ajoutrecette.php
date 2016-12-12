	<?php session_start();
	$id=$_SESSION['id'];?>

	<html>
	<head>
		<meta charset="utf-8">
		<title>Les recettes gourmandes - Ajout</title>
	</head>
	<body>
		<h1>Les recettes gourmandes</h1>
		<div>

			<form name="add_recette" method="post" action="">
				Nom de recette : <input type="text" name="NOM_RECETTE"/> <br/>
				Temps de préparation (en min) : <input type="text" name="TEMPS_PREPARATION_RECETTE"/> <br/>
				Temps de cuisson (en min) : <input type="text" name="TEMPS_CUISSON_RECETTE"/> <br/>
				Nombre de personne(s) : <input type="text" name="NOMBRE_DE_PERSONNES"/> <br/>
				Nombre d'ingredient(s) : <input type='int' name="nb_ingredient"/> <br/>
				Description de la préparation : <input type='text' name="desc_prep"/> <br/>
				<input type="submit" name="valider_recette" value="OK"/>	     
			</form>


			<?php

			if (isset ($_POST['valider_recette'])){

				include('seconnecter.php');

				$nb_sql = 'SELECT MAX(NUMERO_RECETTE) FROM RECETTE;';
				$result = mysql_query($nb_sql);
				if (!$result) {
					die('Requête invalide : ' . mysql_error());
				}
   //mysql_query ($result) or die ('Erreur SQL !'.$result.'<br/>'.mysql_error());

				$cur_nb = mysql_fetch_array($result);

				$cur_nb[0]++;

	 //Affectation des valeurs donner par le client
				$nom=mysql_real_escape_string($_POST['NOM_RECETTE']);
		        $nb_sql = 'SELECT NUMERO_recette FROM RECETTE where NOM_recette="'.$nom.'";';
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


				$desc=$_POST['desc_prep'];
				if(!(!isset($desc) || trim($desc) == ''))
				{
  					$desc = mysql_real_escape_string($_POST['desc_prep']);
  					$nb_desc = mysql_query('SELECT MAX(NUMERO_MODIFICATION) FROM MODIFICATION');
  					$nb_desc = mysql_fetch_array($nb_desc);
  					if ($nb_desc[0] == NULL)
    					$nb_desc = 1;
  					else{
    					$nb_desc = $nb_desc[0];
    					$nb_desc++;}
  					$date=date('Y-n-d');
  					$date=mysql_real_escape_string($date);
  					$sql = mysql_query('INSERT INTO MODIFICATION values ('.$nb_desc.',"'.$desc.'","'.$date.'");') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
  					$sql2 = mysql_query('INSERT INTO ACTION values ('.$id.','.$nb_desc.');') or die ('Erreur SQL !'.$sql2.'<br/>'.mysql_error());
  					$sql3 = mysql_query('INSERT INTO SOUMISSION values ('.$nb_desc.','.$cur_nb[0].');') or die ('Erreur SQL !'.$sql3.'<br/>'.mysql_error());
				}


				$nb_ing = $_POST['nb_ingredient'];
				if($nb_ing <= 0){
					echo('Votre recette ne contient pas d\'ingredient' );
				}
				else{
					header("Location: ajouteringredientrecette.php?nb_ing=$nb_ing&nom_recette=$nom");
				}
				mysql_close();
			}			

			?>

		</div>
	</body>
	</html>
