<?php session_start();?>

<html>
<head>
  <title>Les recettes gourmandes</title>
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="charge_cal" method="post" action="">
      Calories par ingrédient max: <input type="int" name="calorie"/> <br/>
    <input type="submit" name="consulter_cal" value="OK"/>       
  </form>

  <?php 

  if (isset ($_POST['consulter_cal'])){

    $base = @mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
    mysql_select_db ('recettes', $base) ;

    $calorie = $_POST['calorie'];

    $sql_date = 'SELECT distinct NOM_MENU from MENU M, COMPOSITION CP, RECETTE R, CONTENU C, INGREDIENT I, DEFINITION D, CARACTERISTIQUE_NUTRITIONNELLE CN
    WHERE M.NUMERO_MENU=CP.NUMERO_MENU AND CP.NUMERO_RECETTE=R.NUMERO_RECETTE AND R.NUMERO_RECETTE=C.NUMERO_RECETTE AND C.NUMERO_INGREDIENT=I.NUMERO_INGREDIENT AND I.NUMERO_INGREDIENT=D.NUMERO_INGREDIENT AND D.NUMERO_CARACTERISTIQUE=CN.NUMERO_CARACTERISTIQUE AND CN.NOM_CARACTERISTIQUE="Cal" AND D.VALEUR<='.$calorie.';';
    $nb_date=mysql_query($sql_date) or die ('Erreur SQL !'.$nb_date.'<br/>'.mysql_error());


    if($nb_date){
     while($donnees = mysql_fetch_array($nb_date))
     {
       echo"<ul>
       <li>$donnees[0]</li>
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
