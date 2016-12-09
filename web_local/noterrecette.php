<?php session_start(); ?>

<html>
<head>
  <meta charset="utf-8">
  <title>Les recettes gourmandes - Noter</title>
</head>
<body>
  <?php $cur_nb=$_GET['titi'];
  $pseudo=$_SESSION['pseudo'];
  $id=$_SESSION['id'];?>
  <h1>Notation de la recette</h1>

  <form name="add_recette" method="post" action="">
    Note :  <select name="NOTE_r">
    <option value="0">Choose a note</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
</select><br/>

<input type="submit" name="noter_recette" value="OK"/>       
</form>

<?php

if (isset ($_POST['noter_recette'])){

   $base = mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
   mysql_select_db ('recettes', $base) ;

  $note=(int) $_POST['NOTE_r'];
  if(!($note == 0))
  {
      $note_test=mysql_query('SELECT VALEUR_NOTE from NOTE WHERE NUMERO_RECETTE='.$cur_nb[0].' AND NUMERO_INTERNAUTE='.$id.';');
      if (mysql_num_rows($note_test) == 0){
        $sql = mysql_query('INSERT INTO NOTE values ('.$note.','.$cur_nb[0].','.$id.')') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
    } else 
    $sql = mysql_query('UPDATE NOTE SET VALEUR_NOTE='.$note.' WHERE NUMERO_RECETTE='.$cur_nb[0].' AND NUMERO_INTERNAUTE='.$id.'') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
}


header("Location: index_client.html");

mysql_close();

}
?>

</div>
</body>
</html>
