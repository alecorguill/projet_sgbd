<html>
  <head>
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
    </div>
  </body>
</html>
