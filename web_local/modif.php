<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Modifier</title>
</head>
<body>

    <?php $name=$_GET['toto'];
          $cur_nb=$_GET['titi'];?>
    <h1>Modification de la recette <?php echo$name;?></h1>

    <form name="add_recette" method="post" action="">
    Modifier le nom de la recette : <input type="text" name="NOM_RECETTE"/> <br/>
    Temps de préparation (en min) : <input type="text" name="TEMPS_PREPARATION_RECETTE"/> <br/>
    Temps de cuisson (en min) : <input type="text" name="TEMPS_CUISSON_RECETTE"/> <br/>
    Nombre de personne(s) : <input type="text" name="NOMBRE_DE_PERSONNES"/> <br/>
    <input type="submit" name="valider_modif" value="OK"/>       
  </form>

<?php

  if (isset ($_POST['valider_modif'])){


     $base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
     mysql_select_db ('recettes', $base) ;

   $nom=$_POST['NOM_RECETTE'];
   if(!isset($nom) || trim($nom) == '')
   {
      $nm=mysql_query('SELECT NOM_RECETTE from RECETTE WHERE NUMERO_RECETTE='.$cur_nb[0].';');
      $nm = mysql_fetch_array($nm);
      $nom=$nm[0];
   } else
      $nom=mysql_real_escape_string($_POST['NOM_RECETTE']);


   $temps_prep=$_POST['TEMPS_PREPARATION_RECETTE'];
   if(!isset($temps_prep) || trim($temps_prep) == '')
   {
      $tp=mysql_query('SELECT TEMPS_PREPARATION_RECETTE from RECETTE WHERE NUMERO_RECETTE='.$cur_nb[0].';');
      $tp = mysql_fetch_array($tp);
      $temps_prep=$tp[0];
   } else 
       $temps_prep=(int) $_POST['TEMPS_PREPARATION_RECETTE'];

   
   $temps_cuis=$_POST['TEMPS_CUISSON_RECETTE'];
   if(!isset($temps_cuis) || trim($temps_cuis) == '')
   {
      $tc=mysql_query('SELECT TEMPS_CUISSON_RECETTE from RECETTE WHERE NUMERO_RECETTE='.$cur_nb[0].';');
      $tc = mysql_fetch_array($tc);
      $temps_cuis=$tc[0];
   } else 
      $temps_cuis=(int) $_POST['TEMPS_CUISSON_RECETTE'];

   $nb_p=$_POST['NOMBRE_DE_PERSONNES'];
   if(!isset($nb_p) || trim($nb_p) == '')
   {
      $nbp=mysql_query('SELECT NOMBRE_DE_PERSONNES from RECETTE WHERE NUMERO_RECETTE='.$cur_nb[0].';');
      $nbp = mysql_fetch_array($nbp);
      $nb_p=$nbp[0];
   } else 
      $nb_p=(int) $_POST['NOMBRE_DE_PERSONNES'];

   //Ajout de la recette
   $sql = 'UPDATE RECETTE set  NOM_RECETTE="'.$nom.'", TEMPS_PREPARATION_RECETTE='.$temps_prep.', TEMPS_CUISSON_RECETTE='.$temps_cuis.', NOMBRE_DE_PERSONNES='.$nb_p.' WHERE NUMERO_RECETTE='.$cur_nb[0].';';
     mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
   
   mysql_close();

}
?>

</div>
</body>
</html>