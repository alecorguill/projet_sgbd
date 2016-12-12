<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - La moyenne des notes des recettes pour les menus d'un internaute</title>
</head>
<body>
  <h1>Les recettes gourmandes - La moyenne des notes des recettes pour les menus d'un internaute</h1>   
  <div>

    <?php
    include('seconnecter.php');
    $sql = 'SELECT
    i.PSEUDO,
    m.NOM_MENU,
    AVG(n.VALEUR_NOTE) "Note moyenne"
    FROM
    NOTE n,
    INTERNAUTE i,
    MENU m,
    COMPOSITION c
    WHERE
    m.NUMERO_INTERNAUTE = i.NUMERO_INTERNAUTE AND c.NUMERO_MENU = m.NUMERO_MENU AND c.NUMERO_RECETTE = n.NUMERO_RECETTE
    GROUP BY
    i.NUMERO_INTERNAUTE
    ORDER BY
    AVG(n.VALEUR_NOTE)
    DESC';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
    ?>   
    <table>
      <tr>
        <th>Pseudo Internaute</th>
        <th>Nom menu</th>
        <th>Note Moyenne</th>        
      </tr>
      <?php
      while($donnees = mysql_fetch_array($reponse))
      {
        ?>
        <tr>
          <th><?php echo $donnees[0]?></th>
          <th><?php echo $donnees[1];?></th>
          <th><?php echo $donnees[2];?></th>
        </tr>

        <?php
      }
      ?>
    </table></br>

    <?php  mysql_close(); ?>
  </div>
</body>
</html>