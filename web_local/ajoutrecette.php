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
	<input type="submit" name="valider_recette" value="OK"/>	     
	</form>
	 

	  <?php
 
	 if (isset ($_POST['valider_recette'])){

	 $base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
	 mysql_select_db ('recettes', $base) ;
 
	 $nb_sql = 'SELECT count(*) FROM recette;';
	 $result = mysql_query($nb_sql);
   if (!$result) {
    die('Requête invalide : ' . mysql_error());
   }
   //mysql_query ($result) or die ('Erreur SQL !'.$result.'<br/>'.mysql_error());

	 $cur_nb = mysql_fetch_array($result);

   $cur_nb[0]++;

	 //Affectation des valeurs donner par le client
	 $nom=mysql_real_escape_string($_POST['NOM_RECETTE']);
	 $date=date('Y-n-d');
	 $date=mysql_real_escape_string($date);
	 $temps_prep=(int) $_POST['TEMPS_PREPARATION_RECETTE'];
	 $temps_cuis=(int) $_POST['TEMPS_CUISSON_RECETTE'];
	 $nb_p=(int) $_POST['NOMBRE_DE_PERSONNES'];

	 $max_nb_recette = 'SELECT MAX(NUMERO_RECETTE) FROM RECETTE;';
	 $result = mysql_query($max_nb_recette);
	 $cur_nb = mysql_fetch_array($result);
	 $cur_nb[0]++;
	 //Ajout de la recette
	 $sql = 'insert into RECETTE(NUMERO_RECETTE,NOM_RECETTE,DATE_CREATION_RECETTE,TEMPS_PREPARATION_RECETTE,TEMPS_CUISSON_RECETTE,NOMBRE_DE_PERSONNES) values ('.$cur_nb[0].', "'.$nom.'", "'.$date.'", '.$temps_prep.', '.$temps_cuis.', '.$nb_p.')';
		 mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
	 }
	 mysql_close();
	 ?>

	 </div>
	 </body>
	 </html>