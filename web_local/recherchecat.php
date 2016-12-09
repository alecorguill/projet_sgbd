<?php session_start();?>

<html>
<head>
  <title>Les recettes gourmandes</title>
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="charge_cat" method="post" action="">
      Consulter une catégorie: <input type="text" name="consult_cat"/> <br/>
      Pour un nombre de personne: <input type="int" name="consult_nb_cat"/> <br/>
      <input type="submit" name="consulter_cat" value="OK"/>       
    </form>
    <?php 

    if (isset ($_POST['consulter_cat'])){

      include('seconnecter.php');

      $cat = mysql_real_escape_string($_POST['consult_cat']);

      if ((!isset($temps_prep) || trim($temps_prep) == ''))
        $nb_pers = $_POST['consult_nb_cat'];
      else {
        echo "You did not fill out the required fields.";
        exit;
      }

      $sql = mysql_query('SELECT * from CATEGORIE where NOM_CATEGORIE="'.$cat.'";');
      $sql=mysql_fetch_array($sql);

      if (!$sql[0]) {
        die('Cette catégorie n\'existe pas');
      }

      $num_cat = $sql[0];

      $sql[2] = strtolower($sql[2]);
      $sql[2][0] = strtoupper($sql[2][0]);



      if($num_cat){
       $sql2 = 'SELECT NOM_RECETTE FROM APPARTIENT A, RECETTE R WHERE R.NUMERO_RECETTE=A.NUMERO_RECETTE AND A.NUMERO_CATEGORIE='.$num_cat.' AND R.NOMBRE_DE_PERSONNES='.$nb_pers.';';
       $reponse = mysql_query ($sql2) or die ('Erreur SQL !'.$sql2.'<br/>'.mysql_error());

       if(mysql_num_rows($reponse) == 0) {
        echo "Aucune recette dans cette catégorie pour ce nombre de personnes.";
        exit();
      }

      echo "Les recettes de la catégorie $sql[2] pour $nb_pers personne";

      if($nb_pers == 0)
        echo ".</br></br>";
      else if ($nb_pers >1)
        echo "s :</br>";
      else 
        echo " :</br>";
      while($donnees = mysql_fetch_array($reponse))
      {
       echo"<ul>
       <li><a href=listerecettes.php?toto=1&titi=$donnees[0]>$donnees[0]</li>
       </ul>";
     }

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
