<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Le classement des recettes</title>
</head>
<body>
  <h1>Les recettes gourmandes - Le classement des recettes</h1>   
  <div>

    <?php
    include('seconnecter.php');
    $sql = 'SELECT
    R.NOM_RECETTE,
    AVG(N.VALEUR_NOTE) "NOTE MOYENNE"
    FROM
    RECETTE R,
    NOTE N
    WHERE
    R.NUMERO_RECETTE = N.NUMERO_RECETTE
    GROUP BY
    R.NOM_RECETTE
    ORDER BY
    AVG(N.VALEUR_NOTE)
    DESC;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
    ?>   
    <table>
      <tr>
        <th>Classement</th>
        <th>Nom recette</th>
        <th>Note Moyenne</th>        
      </tr>
      <?php $i = 1;
      while($donnees = mysql_fetch_array($reponse))
      {
        ?>
        <tr>
          <th><?php echo $i;?></th>
          <th><?php echo $donnees[0];?></th>
          <th><?php echo $donnees[1];?></th>
        </tr>

        <?php
      $i++;}
      ?>
    </table></br>

    <?php  mysql_close(); ?>
  </div>
</body>
</html>
