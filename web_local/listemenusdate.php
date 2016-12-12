<?php session_start();?>

<html>
<head>
  <title>Les recettes gourmandes</title>
  <meta charset="UTF-8">
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="charge_menu" method="post" action="">
      Date :  <select name="jour">
      <option value="0">Choose a date</option>
      <?php for($i=01;$i<32;$i++)
      echo"<option value=\"$i\">$i</option>";
      ?>
    </select>

    <select name="mois">
      <option value="0">Choose a month</option>
      <?php for($i=1;$i<13;$i++)
      echo"<option value=\"$i\">$i</option>";
      ?>
    </select>

    <select name="annee">
      <option value="0">Choose a year</option>
      <?php for($i=2000;$i<2018;$i++)
      echo"<option value=\"$i\">$i</option>";
      ?>
    </select><br/>

    <input type="submit" name="consulter_menu_date" value="OK"/>       
  </form>

  <?php 

  if (isset ($_POST['consulter_menu_date'])){

    include('seconnecter.php');

    $jour = $_POST['jour'];
    $mois = $_POST['mois'];
    $annee = $_POST['annee'];
    $date = "$annee-$mois-$jour";


    $sql_date = 'SELECT distinct NOM_MENU from MENU M, COMPOSITION C, RECETTE R WHERE M.NUMERO_MENU=C.NUMERO_MENU AND C.NUMERO_RECETTE=R.NUMERO_RECETTE AND R.DATE_CREATION_RECETTE>="'.$date.'";';
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
