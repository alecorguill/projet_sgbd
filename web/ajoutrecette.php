
      <?php
 
	 if (isset ($_POST['valider_recette'])){
	 //Affectation des valeurs donner par le client
	 $nom=mysql_real_escape_string($_POST['NOM_RECETTE']);
	 $date=date('j-M-y');
	 $temps_prep=(int) $_POST['TEMPS_PREPARATION_RECETTE'];
	 $temps_cuis=(int) $_POST['TEMPS_CUISSON_RECETTE'];
	 $nb_p=(int) $_POST['NOMBRE_PERSONNES'];

	 $max_nb_recette = 'SELECT MAX(R.NUMERO_RECETTE) FROM RECETTE R;';
	 $result = mysql_query($max_nb_recette);
	 $cur_nb = mysql_fetch_array($result);
	 $cur_nb[0]++;
	 //Ajout de la recette
	 $sql = 'insert into 
	 INTERNAUTE(
	 NUMERO_RECETTE,
	 NOM_RECETTE, 
	 DATE_CREATION_RECETTE,
	 TEMPS_PREPARATION_RECETTE,
	 TEMPS_CUISSON_RECETTE,
	 NOMBRE_DE_PERSONNES
	 ) values('$cur_nb[0]', "'$nom'", $date, $temps_prep, $temps_cuis, $nb_p)';
     	 mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
	 }
	 }
	 mysql_close();
	 ?>
