<html>
  <head>
    <meta charset="utf-8">
    <title>Les recettes gourmandes - Gestion</title>
  </head>
  <body>
    <form name="suppression" method="post" action="gestion_base.php">
      Supprimer un pseudo : <input type="text" name="pseudo"/> <br/>
      <input type="submit" name="valider_2" value="OK"/>	     
    </form>
    <?php
      include('seconnecter.php');
       
       if (isset ($_POST['valider_2'])){	
       $pseudo=$_POST['pseudo'];
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
