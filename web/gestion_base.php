<html>
  <head>
    <meta charset="utf-8">
    <title>Les recettes gourmandes - Gestion</title>
  </head>
  <body>
    <form name="suppression" method="post" action="gestion_base.php">
      Supprimer un pseudo : <input type="text" name="pseudo"/> <br/>
      <input type="submit" name="valider" value="OK"/>	     
    </form>
    <?php
       $base = mysql_connect ('localhost', 'lchaumartin', 'vivi86ga');  
       mysql_select_db ('lchaumartin', $base) ;
       
       if (isset ($_POST['valider'])){	
       $pseudo=$_POST['valider'];
       $pseudo = mysql_real_escape_string($pseudo);
       $nb_sql = 'SELECT count(*) FROM INTERNAUTE;';
       $result = mysql_query($nb_sql);
       $cur_nb = mysql_fetch_array($result);

       //echo('le nombre avant suppression' . $cur_nb[0]);
       $sql = "delete from INTERNAUTE where INTERNAUTE.PSEUDO = '$pseudo'";
       //$result = mysql_query($nb_sql);
       //$cur_nb = mysql_fetch_array($result);
       //echo('le nombre après suppression' . $cur_nb[0]);
       mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
       mysql_close();
       }
       ?>

  </body>
</html>
