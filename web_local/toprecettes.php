<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Le top recettes</title>
</head>
<body>
  <h1>Les recettes gourmandes - Le top recettes</h1>   
  <div>

    <?php
    include('seconnecter.php');
    $sql = 'SELECT
    R.NOM_RECETTE
    FROM
    RECETTE R,
    NOTE N
    HAVING
    COUNT(
      R.NUMERO_RECETTE = N.NUMERO_RECETTE AND N.VALEUR_NOTE = 3
      ) >= 5;';
$reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
?>   
<table>
  <tr>
    <th>Nom recette</th>
  </tr>
  <?php
  while($donnees = mysql_fetch_array($reponse))
  {
    ?>
    <tr>
      <th><?php echo $donnees[0];?></th>
    </tr>

    <?php
  }
  ?>
</table></br>

<?php  mysql_close(); ?>
</div>
</body>
</html>