<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Les recettes récentes</title>
</head>
<body>
  <h1>Les recettes gourmandes - Les recettes récentes</h1>   
  <div>

    <?php
    include('seconnecter.php');
    $sql = 'SELECT
    COUNT(*) AS NOMBRE
    FROM
    RECETTE R,
    APPARTIENT A,
    CATEGORIE C
    WHERE
    R.NUMERO_RECETTE = A.NUMERO_RECETTE AND A.NUMERO_CATEGORIE = C.NUMERO_CATEGORIE AND R.DATE_CREATION_RECETTE > 2016 -01 -01;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
    ?>   
    <table>
      <tr>
        <th>Nombre de recettes</th>
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