<?php session_start();?>

<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Modifier</title>
</head>
<body>
  <h1>Modification d'une recette</h1>
  <div>

    <form name="change_recette" method="post" action="">
      Nom de la recette à modifier: <input type="text" name="NOM_MODIF_RECETTE"/> <br/>
      <input type="submit" name="valider_modif_recette" value="OK"/>       
    </form>

    <?php

    if (isset ($_POST['valider_modif_recette'])){

      include('seconnecter.php');

     $modif = $_POST['NOM_MODIF_RECETTE'];

     $nb_sql = 'SELECT NUMERO_RECETTE FROM RECETTE where NOM_RECETTE="'.$modif.'";';
     $result = mysql_query($nb_sql);

     $cur_nb = mysql_fetch_array($result);

     if (!$cur_nb[0]) {
      die('Cette recette n\'existe pas');
    }
    else 
        header("Location: modif.php?toto=$modif&titi=$cur_nb[0]");
   //mysql_query ($result) or die ('Erreur SQL !'.$result.'<br/>'.mysql_error());

    mysql_close();
  }
    ?>
  </div>
</body>
</html>