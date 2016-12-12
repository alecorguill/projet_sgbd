<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Les recettes sucrées-salées</title>
</head>
<body>
  <h1>Les recettes gourmandes - Les recettes sucrées-salées</h1>   
  <div>

    <?php
    include('seconnecter.php');
    $sql = 'SELECT
    R.NOM_RECETTE
    FROM
    RECETTE R,
    CONTENU C,
    CONTENU C2,
    INGREDIENT I,
    INGREDIENT I2
    WHERE
    R.NUMERO_RECETTE = C.NUMERO_RECETTE 
    AND C.NUMERO_INGREDIENT = I.NUMERO_INGREDIENT 
    AND I.NOM_INGREDIENT = "MIEL" 
    AND R.NUMERO_RECETTE = C2.NUMERO_RECETTE 
    AND C2.NUMERO_INGREDIENT = I2.NUMERO_INGREDIENT 
    AND I2.NOM_INGREDIENT = "SEL";';
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