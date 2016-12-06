<?php session_start();?>

<html>
<head>
  <title>Les recettes gourmandes</title>
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="change_recette" method="post" action="">
      Consulter une recette: <input type="text" name="consult_recette"/> <br/>
      <input type="submit" name="consulter_recette" value="OK"/>       
    </form>
    <?php 

    if (isset ($_POST['consulter_recette'])){

      $base = @mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
      mysql_select_db ('recettes', $base) ;

      $recette = mysql_real_escape_string($_POST['consult_recette']);

      $sql = mysql_query('SELECT * from RECETTE where NOM_RECETTE="'.$recette.'";');
      $sql=mysql_fetch_array($sql);

      if (!$sql[0]) {
        die('Cette recette n\'existe pas');
      }

      $id = mysql_query('SELECT PSEUDO FROM internaute where NUMERO_INTERNAUTE = '.$sql[0].';');
      $id = mysql_fetch_array($id);

      $num_rec = mysql_query('SELECT NUMERO_RECETTE FROM RECETTE WHERE NOM_RECETTE = "'.$sql[1].'";') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
      if(mysql_num_rows($num_rec) == 0){
        $num_rec=0;
      } else {
        $num_rec = mysql_fetch_array($num_rec);
        $num_rec = $num_rec[0];
      }

      echo "La recette $sql[1] a été ajouté par l'internaute $id[0] le $sql[2]. </br></br>";

      $nb_menu=mysql_query('SELECT count(*) from COMPOSITION WHERE NUMERO_RECETTE='.$num_rec.';') or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
      if (mysql_num_rows($nb_menu)==0){
        $nb_menu=0;
      } else {
        $nb_menu=mysql_fetch_array($nb_menu);
        $nb_menu=$nb_menu[0];
      }
      $sql[1] = strtolower($sql[1]);
      $sql[1][0] = strtoupper($sql[1][0]);
      echo "$sql[1] fait partie de $nb_menu menu";

      if($nb_menu == 0)
        echo ".</br></br>";
      else if ($nb_menu >1)
        echo "s :</br>";
      else 
        echo " :</br>";


      if($nb_menu){
       $sql2 = 'SELECT NOM_MENU FROM MENU M, COMPOSITION C WHERE M.NUMERO_MENU=C.NUMERO_MENU AND C.NUMERO_RECETTE='.$num_rec.';';
       $reponse = mysql_query ($sql2) or die ('Erreur SQL !'.$sql2.'<br/>'.mysql_error());

       while($donnees = mysql_fetch_array($reponse))
       {
         echo"<ul>
         <li>$donnees[0]</li>
         </ul>";
       }

     }


     $nb_ingre=mysql_query('SELECT count(*) from CONTENU WHERE NUMERO_RECETTE='.$num_rec.';') or die ('Erreur SQL !'.$nb_ingre.'<br/>'.mysql_error());
     if (mysql_num_rows($nb_ingre)==0){
      $nb_ingre=0;
    } else {
      $nb_ingre=mysql_fetch_array($nb_ingre);
      $nb_ingre=$nb_ingre[0];
    }

    echo "$sql[1] a besoin de $nb_ingre ingrédient";

    if($nb_ingre == 0)
      echo ".</br></br>";
    else if ($nb_ingre >1)
      echo "s :</br>";
    else 
      echo " :</br>";

    if($nb_ingre){
     $sql3 = 'SELECT NOM_INGREDIENT FROM INGREDIENT I, CONTENU C WHERE I.NUMERO_INGREDIENT=C.NUMERO_INGREDIENT AND C.NUMERO_RECETTE='.$num_rec.';';
     $reponse = mysql_query ($sql3) or die ('Erreur SQL !'.$sql3.'<br/>'.mysql_error());

     while($donnees = mysql_fetch_array($reponse))
     {
       echo"<ul>
       <li>$donnees[0]</li>
       </ul>";
     }

   }

   mysql_close();

 }

 ?>
</div>
</body>
</html>
