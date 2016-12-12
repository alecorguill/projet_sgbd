<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Le classement fin des ingrédients</title>
</head>
<body>
  <h1>Les recettes gourmandes - Le classement fin des ingrédients</h1>   
  <div>

    <?php
    include('seconnecter.php');
    $sql = 'SELECT
    I.NOM_INGREDIENT,
    (
      SELECT
      AVG(N.VALEUR_NOTE)
      FROM
      NOTE N,
      CONTENU C
      WHERE
      I.NUMERO_INGREDIENT = C.NUMERO_INGREDIENT AND C.NUMERO_RECETTE = N.NUMERO_RECETTE
      ) *(
      SELECT
      D.VALEUR /(
        SELECT
        SUM(VALEUR)
        FROM
        DEFINITION
        WHERE
        NUMERO_CARACTERISTIQUE = 1
        )
FROM
DEFINITION D
WHERE
I.NUMERO_INGREDIENT = D.NUMERO_INGREDIENT AND D.NUMERO_CARACTERISTIQUE = 1
) *(
SELECT
SUM(
  IF(
    @NBCOM :=(
      SELECT
      COUNT(C.NUMERO_COMMENTAIRE)
      FROM
      COMMENTAIRE C,
      CONTENU CT
      WHERE
      I.NUMERO_INGREDIENT = CT.NUMERO_INGREDIENT AND CT.NUMERO_RECETTE = C.NUMERO_RECETTE
      ) <= 3,
1,
IF(@NBCOM <= 10,
  2,
  3)
)
)
) RES
FROM
INGREDIENT I
GROUP BY
I.NUMERO_INGREDIENT
ORDER BY
RES
DESC';
$reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
?>   
<table>
  <tr>
    <th>Classement</th>
    <th>Nom ingrédient</th>
    <th>Note</th>        
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