<?php session_start(); ?>


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
   $base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());;  
	 mysql_select_db ('recettes', $base) ;
 
	 if (isset ($_POST['valider'])){	
	 $pseudo=$_POST['pseudo'];
   //$_SESSION['pseudo'] = $pseudo;
	 $nb_sql = 'SELECT count(*) FROM internaute;';
	 $result = mysql_query($nb_sql);
   if (!$result) {
    die('Requête invalide : ' . mysql_error());
   }
   //mysql_query ($result) or die ('Erreur SQL !'.$result.'<br/>'.mysql_error());

	 $cur_nb = mysql_fetch_array($result);

   $cur_nb[0]++;

   $sql = 'insert into internaute(numero_internaute,pseudo) values('.$cur_nb[0].',"'.$pseudo.'")';
           mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());

   mysql_close();
	 }
	 ?>

    </div>
  </body>
</html>
