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

			if (isset ($_POST['valider_menu'])){

				include('seconnecter.php');
				$nb_rec = $_POST['nb_recette'];
				if($nb_rec <= 0){
					die('votre menu ne contient aucune recette');
				}
				else{
				$nb_sql = 'SELECT MAX(NUMERO_MENU) FROM MENU;';
				$result = mysql_query($nb_sql);
				if (!$result) {
					die('Requête invalide : ' . mysql_error());
				}
   //mysql_query ($result) or die ('Erreur SQL !'.$result.'<br/>'.mysql_error())
				$cur_nb = mysql_fetch_array($result);

				$cur_nb[0]++;

	 //Affectation des valeurs donner par le client
				$nom=mysql_real_escape_string($_POST['NOM_MENUS']);
				$numero_internaute=$_SESSION['id'];
		        $nb_sql = 'SELECT NUMERO_MENU FROM MENU where NOM_MENU="'.$nom.'" and NUMERO_INTERNAUTE='.$numero_internaute.';';
		        $result = mysql_query($nb_sql) or die ('Erreur SQL !'.$nb_sql.'<br/>'.mysql_error());
		        if(mysql_num_rows($result) > 0){
		        	echo("Vous avez deja ajouté ce menu");
		        	exit();
		        }

				$max_nb_menu = 'SELECT MAX(NUMERO_MENU) FROM MENU;';
				$result = mysql_query($max_nb_menu);
				$cur_nb = mysql_fetch_array($result);
				$cur_nb[0]++;
	 //Ajout de la recette
				$sql = 'insert into MENU(NUMERO_MENU, NOM_MENU, NUMERO_INTERNAUTE) values ('.$cur_nb[0].', "'.$nom.'", '.$numero_internaute.')';
				mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
				header("Location: ajouterrecettemenu.php?nb_rec=$nb_rec&nom_menu=$nom");
				mysql_close();
				}
			}			

			?>

		</div>
	</body>
	</html>
