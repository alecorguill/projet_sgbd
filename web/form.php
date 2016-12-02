<html>
  <head>
    <meta charset="utf-8">
    <title>Les recettes gourmandes - Inscription</title>
  </head>
  <body>
    <h1>Les recettes gourmandes</h1>
    <div>
      <h1>Inscrivez-vous !</h1>
      <h2>Entrez les données demandées :</h2>
      <form name="inscription" method="post" action="form.php">
	Entrez un pseudo : <input type="text" name="pseudo"/> <br/>
	<input type="submit" name="valider" value="OK"/>	     
      </form>
      <?php
	 $base = mysql_connect ('localhost', 'lchaumartin', 'vivi86ga');  
	 mysql_select_db ('lchaumartin', $base) ;
 
	 if (isset ($_POST['valider'])){	
	 $pseudo=$_POST['pseudo'];
	 $nb_sql = 'SELECT count(*) FROM INTERNAUTE;';
	 $result = mysql_query($nb_sql);
	 $cur_nb = mysql_fetch_array($result);

	 $sql = 'insert into INTERNAUTE(NUMERO_INTERNAUTE,PSEUDO) values('.$cur_nb[0].',"'.$pseudo.'")';
     	 mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
     	 mysql_close();
	 }
	 ?>

      <h2>Ajouter une recette :</h2>
      <form name="add_recette" method="post" action="form.php">
	Nom de recette : <input type="text" name="NOM_RECETTE"/> <br/>
	Temps de préparation (en min) : <input type="text" name="TEMPS_PREPARATION_RECETTE"/> <br/>
	Temps de cuisson (en min) : <input type="text" name="TEMPS_CUISSON_RECETTE"/> <br/>
	Nombre de personne(s) : <input type="text" name="NOMBRE_DE_PERSONNES"/> <br/>
	<input type="submit" name="valider_recette" value="OK"/>	     
      </form>
      
      <?php include("ajoutrecette.php"); ?>

    </div>
  </body>
</html>
