<?php session_start(); ?>

<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Modifier</title>
</head>
<body>
  <?php $name=$_GET['toto'];
  $cur_nb=$_GET['titi'];
  $pseudo=$_SESSION['pseudo'];
  $id=$_SESSION['id'];?>
  <h1>Modification de la recette <?php echo$name;?></h1>

  <form name="add_recette" method="post" action="">
    Modifier le nom de la recette : <input type="text" name="NOM_RECETTE"/> <br/>
    Temps de préparation (en min) : <input type="text" name="TEMPS_PREPARATION_RECETTE"/> <br/>
    Temps de cuisson (en min) : <input type="text" name="TEMPS_CUISSON_RECETTE"/> <br/>
    Nombre de personne(s) : <input type="text" name="NOMBRE_DE_PERSONNES"/> <br/>
    Note :  <select name="NOTE">
    <option value="0">Choose a note</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select><br/>
Commentaire : <input type="text" name="COMMENTAIRE"/> <br/>
Description : <input type="text" name="DESCRIPTION"/> <br/>

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

  $note=(int) $_POST['NOTE'];
  if(!($note == 0))
  {
      $note_test=mysql_query('SELECT VALEUR_NOTE from NOTE WHERE NUMERO_RECETTE='.$cur_nb[0].' AND NUMERO_INTERNAUTE='.$id.';');
      if (mysql_num_rows($note_test) == 0){
        $sql = mysql_query('INSERT INTO NOTE values ('.$note.','.$cur_nb[0].','.$id.')') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
    } else 
    $sql = mysql_query('UPDATE NOTE SET VALEUR_NOTE='.$note.' WHERE NUMERO_RECETTE='.$cur_nb[0].' AND NUMERO_INTERNAUTE='.$id.'') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
}

$comment=$_POST['COMMENTAIRE'];
if(!(!isset($comment) || trim($comment) == ''))
{
  $comment=mysql_real_escape_string($_POST['COMMENTAIRE']);
  $comment_test=mysql_query('SELECT DESCRIPTION_COMMENTAIRE FROM COMMENTAIRE WHERE NUMERO_INTERNAUTE='.$id.' AND NUMERO_RECETTE='.$cur_nb[0].';') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
  if (mysql_num_rows($comment_test) == 0) 
  {
    $nb_com=mysql_query('SELECT MAX(NUMERO_COMMENTAIRE) FROM COMMENTAIRE');
    $nb_com=mysql_fetch_array($nb_com);
    if ($nb_com[0]==NULL)
        $nb_com=1;
    else
        $nb_com=$nb_com[0];
    $sql = mysql_query('INSERT INTO COMMENTAIRE values ('.$nb_com.','.$id.','.$cur_nb[0].',"'.$comment.'")') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error()); 
} else {
    mysql_query('UPDATE COMMENTAIRE SET DESCRIPTION_COMMENTAIRE="'.$comment.'" WHERE NUMERO_RECETTE='.$cur_nb[0].' AND NUMERO_INTERNAUTE='.$id.' AND NUMERO_COMMENTAIRE='.$nb_com.';') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
}
}

$desc=$_POST['DESCRIPTION'];
if(!(!isset($desc) || trim($desc) == ''))
{
  $desc = mysql_real_escape_string($_POST['DESCRIPTION']);
  $nb_desc = mysql_query('SELECT MAX(NUMERO_MODIFICATION) FROM MODIFICATION');
  $nb_desc = mysql_fetch_array($nb_desc);
  if ($nb_desc[0] == NULL)
    $nb_desc = 1;
  else {
    $nb_desc = $nb_desc[0];
    $nb_desc++;}
  $date=date('Y-n-d');
  $date=mysql_real_escape_string($date);
  $sql = mysql_query('INSERT INTO MODIFICATION values ('.$nb_desc.',"'.$desc.'","'.$date.'");') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
  $sql2 = mysql_query('INSERT INTO ACTION values ('.$id.','.$nb_desc.');') or die ('Erreur SQL !'.$sql2.'<br/>'.mysql_error());
  $sql3 = mysql_query('INSERT INTO SOUMISSION values ('.$nb_desc.','.$cur_nb[0].');') or die ('Erreur SQL !'.$sql3.'<br/>'.mysql_error());
}



   //Ajout de la recette
$sql = 'UPDATE RECETTE set  NOM_RECETTE="'.$nom.'", TEMPS_PREPARATION_RECETTE='.$temps_prep.', TEMPS_CUISSON_RECETTE='.$temps_cuis.', NOMBRE_DE_PERSONNES='.$nb_p.' WHERE NUMERO_RECETTE='.$cur_nb[0].';';
mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());

header("Location: index_client.html");

mysql_close();

}
?>

</div>
</body>
</html>
