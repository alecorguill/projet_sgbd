<?php session_start();
  $ok=$_GET['titi'];
  $base = @mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
      mysql_select_db ('recettes', $base) ;
  $recette = mysql_fetch_array(mysql_query('SELECT NOM_RECETTE FROM RECETTE WHERE NUMERO_RECETTE='.$ok.';'));
  $recette = $recette[0];
  mysql_close();
  ?>

<html>
<head>
  <title>Les recettes gourmandes</title>
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="charge_modifs" method="post" action="">
      Consulter les modifications d'une recette: <input type="text" name="consult_recette"/> <br/>
      <input type="submit" name="consulter_modifs" value="OK"/>       
    </form>
    <?php 

    if (isset ($_POST['consulter_modifs']) || $ok){

      $base = @mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
      mysql_select_db ('recettes', $base) ;


      if (!($recette))
        $recette = mysql_real_escape_string($_POST['consult_recette']);

      $sql = mysql_query('SELECT * from RECETTE where NOM_RECETTE="'.$recette.'";');
      $sql=mysql_fetch_array($sql);

      if (!$sql[0]) {
        die('Cette recette n\'existe pas');
      }

      $id = mysql_query('SELECT PSEUDO FROM internaute where NUMERO_INTERNAUTE = '.$sql[0].';');
      $id = mysql_fetch_array($id);

      $num_rec = mysql_query('SELECT NUMERO_RECETTE FROM RECETTE WHERE NOM_RECETTE = "'.$sql[1].'";') or die ('Erreur SQL !'.$num_rec.'<br/>'.mysql_error());
      if(mysql_num_rows($num_rec) == 0){
        $num_rec=0;
      } else {
        $num_rec = mysql_fetch_array($num_rec);
        $num_rec = $num_rec[0];
      }
      $sql[1] = strtolower($sql[1]);
      $sql[1][0] = strtoupper($sql[1][0]);

      echo "La recette $sql[1] a été ajouté par l'internaute $id[0] le $sql[2]. </br></br>";

      

 $sql5 = 'SELECT I.PSEUDO, M.DATE_MODIFICATION, M.DESCRIPTION_MODIFICATION FROM INTERNAUTE I, ACTION A, MODIFICATION M, SOUMISSION S WHERE I.NUMERO_INTERNAUTE=A.NUMERO_INTERNAUTE AND A.NUMERO_MODIFICATION=M.NUMERO_MODIFICATION AND M.NUMERO_MODIFICATION=S.NUMERO_MODIFICATION AND S.NUMERO_RECETTE='.$num_rec.';';
 $reponse = mysql_query ($sql5) or die ('Erreur SQL !'.$sql5.'<br/>'.mysql_error());

 if (mysql_num_rows($reponse)){
   echo " Historique : </br>";

   while($donnees = mysql_fetch_array($reponse))
   {
     echo"<ul>
     <li>$donnees[0] le $donnees[1] : $donnees[2]</li>
     </ul>";
   }
   echo "<a href=modif.php?&titi=$num_rec>Modifiez la !</a>";
 } else {
  echo "Pas de description ! <a href=modif.php?titi=$num_rec>Ecrivez la !</a>";
}
mysql_close();

}
?> </br> </br>
    <form name="accueil" method="post" action="">
      <input type="submit" name="aller_acceuil" value="Accueil"/>   
    </form>
    <?php
    if (isset ($_POST['aller_acceuil'])){
      header("Location: index_client.html");
      exit(); 
    }
    ?>

</div>
</body>
</html>
