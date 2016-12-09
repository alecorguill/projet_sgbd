<?php session_start(); ?>

<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Commenter</title>
</head>
<body>
  <?php $cur_nb=$_GET['titi'];
  $pseudo=$_SESSION['pseudo'];
  $id=$_SESSION['id'];?>
  <h1>Commentaire de la recette</h1>

  <form name="add_recette" method="post" action="">
  Commentaire : <input type="text" name="COMMENTAIRE_r"/> <br/>


<input type="submit" name="comment_recette" value="OK"/>       
</form>

<?php

if (isset ($_POST['comment_recette'])){

  include('seconnecter.php');

$comment=$_POST['COMMENTAIRE_r'];
if(!(!isset($comment) || trim($comment) == ''))
{
  $comment=mysql_real_escape_string($_POST['COMMENTAIRE_r']);
  $comment_test=mysql_query('SELECT DESCRIPTION_COMMENTAIRE FROM COMMENTAIRE WHERE NUMERO_INTERNAUTE='.$id.' AND NUMERO_RECETTE='.$cur_nb[0].';') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
  if (mysql_num_rows($comment_test) == 0) 
  {
    $nb_com=mysql_query('SELECT MAX(NUMERO_COMMENTAIRE) FROM COMMENTAIRE');
    $nb_com=mysql_fetch_array($nb_com);
    if ($nb_com[0]==NULL)
        $nb_com=1;
    else{
        $nb_com  = $nb_com[0];
        $nb_com++;}
    $sql = mysql_query('INSERT INTO COMMENTAIRE values ('.$nb_com.','.$id.','.$cur_nb[0].',"'.$comment.'")') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error()); 
} else {
    $nb_com=mysql_query('SELECT NUMERO_COMMENTAIRE FROM COMMENTAIRE WHERE NUMERO_INTERNAUTE='.$id.';');
    $nb_com=mysql_fetch_array($nb_com);
    $nb_com=$nb_com[0];
    mysql_query('UPDATE COMMENTAIRE SET DESCRIPTION_COMMENTAIRE="'.$comment.'" WHERE NUMERO_RECETTE='.$cur_nb[0].' AND NUMERO_INTERNAUTE='.$id.' AND NUMERO_COMMENTAIRE='.$nb_com.';') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
}
}


header("Location: index_client.html");

mysql_close();

}
?>

</div>
</body>
</html>
