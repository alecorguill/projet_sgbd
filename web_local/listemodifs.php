<?php session_start();
  $ok=$_GET['toto'];
  $recette=$_GET['titi'];
  ?>

<html>
<head>
  <title>Les recettes gourmandes</title>
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="charge_modifs" method="post" action="">
      Consulter les modifications d'une recette: <input type="text" name="consult_recette"/> <br/>
      <input type="submit" name="consulter_modifs" value="OK"/>       
    </form>
    <?php 

    if (isset ($_POST['consulter_modifs']) || $ok){

      $base = @mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
      mysql_select_db ('recettes', $base) ;


      if (!($recette))
        $recette = mysql_real_escape_string($_POST['consult_recette']);

      $sql = mysql_query('SELECT * from RECETTE where NOM_RECETTE="'.$recette.'";');
      $sql=mysql_fetch_array($sql);

      if (!$sql[0]) {
        die('Cette recette n\'existe pas');
      }

      $id = mysql_query('SELECT PSEUDO FROM internaute where NUMERO_INTERNAUTE = '.$sql[0].';');
      $id = mysql_fetch_array($id);

      $num_rec = mysql_query('SELECT NUMERO_RECETTE FROM RECETTE WHERE NOM_RECETTE = "'.$sql[1].'";') or die ('Erreur SQL !'.$num_rec.'<br/>'.mysql_error());
      if(mysql_num_rows($num_rec) == 0){
        $num_rec=0;
      } else {
        $num_rec = mysql_fetch_array($num_rec);
        $num_rec = $num_rec[0];
      }
      $sql[1] = strtolower($sql[1]);
      $sql[1][0] = strtoupper($sql[1][0]);

      echo "La recette $sql[1] a été ajouté par l'internaute $id[0] le $sql[2]. </br></br>";

      
/*
      $nb_menu=mysql_query('SELECT count(*) from COMPOSITION WHERE NUMERO_RECETTE='.$num_rec.';') or die ('Erreur SQL !'.$nb_menu.'<br/>'.mysql_error());
      if (mysql_num_rows($nb_menu)==0){
        $nb_menu=0;
      } else {
        $nb_menu=mysql_fetch_array($nb_menu);
        $nb_menu=$nb_menu[0];
      }

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


     $nb_cat=mysql_query('SELECT count(*) from APPARTIENT WHERE NUMERO_RECETTE='.$num_rec.';') or die ('Erreur SQL !'.$nb_cat.'<br/>'.mysql_error());
     if (mysql_num_rows($nb_cat)==0){
      $nb_cat=0;
    } else {
      $nb_cat=mysql_fetch_array($nb_cat);
      $nb_cat=$nb_cat[0];
    }

    echo "$sql[1] fait partie de $nb_cat catégorie";

    if($nb_cat == 0)
      echo ".</br></br>";
    else if ($nb_cat >1)
      echo "s :</br>";
    else 
      echo " :</br>";

    if($nb_cat){
     $sql3 = 'SELECT NOM_CATEGORIE FROM CATEGORIE C, APPARTIENT A WHERE C.NUMERO_CATEGORIE=A.NUMERO_CATEGORIE AND A.NUMERO_RECETTE='.$num_rec.';';
     $reponse = mysql_query ($sql3) or die ('Erreur SQL !'.$sql3.'<br/>'.mysql_error());

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
   $sql3 = 'SELECT NOM_INGREDIENT, QUANTITE, UNITE FROM INGREDIENT I, CONTENU C WHERE I.NUMERO_INGREDIENT=C.NUMERO_INGREDIENT AND C.NUMERO_RECETTE='.$num_rec.';';
   $reponse = mysql_query ($sql3) or die ('Erreur SQL !'.$sql3.'<br/>'.mysql_error());

   while($donnees = mysql_fetch_array($reponse))
   {
     echo"<ul>
     <li>$donnees[1] $donnees[2] de $donnees[0]</li>
     </ul>";
   }

 }

 $max_date = mysql_fetch_array(mysql_query('SELECT MAX(DATE_MODIFICATION),MAX(M.NUMERO_MODIFICATION) FROM MODIFICATION M, SOUMISSION S WHERE M.NUMERO_MODIFICATION=S.NUMERO_MODIFICATION AND S.NUMERO_RECETTE='.$num_rec.'')) or die ('Erreur SQL !'.$max_date.'<br/>'.mysql_error());
 $id = mysql_fetch_array(mysql_query('SELECT PSEUDO FROM INTERNAUTE I, ACTION A WHERE I.NUMERO_INTERNAUTE=A.NUMERO_INTERNAUTE AND A.NUMERO_MODIFICATION='.$max_date[1].';')) or die ('Erreur SQL !'.$id.'<br/>'.mysql_error());
 echo "Préparation : (dernière modification par $id[0] le $max_date[0])</br>";
 $sql4 = 'SELECT DESCRIPTION_MODIFICATION FROM MODIFICATION M, SOUMISSION S WHERE M.NUMERO_MODIFICATION='.$max_date[1].' AND S.NUMERO_MODIFICATION='.$max_date[1].' AND S.NUMERO_RECETTE='.$num_rec.';';
 $reponse = mysql_query ($sql4) or die ('Erreur SQL !'.$sql4.'<br/>'.mysql_error());

 $donnees = mysql_fetch_array($reponse);
 echo"<ul>
 <li>$donnees[0]</li>
 </ul>";

 $avg_note=mysql_fetch_array(mysql_query('SELECT AVG(n.VALEUR_NOTE) FROM note n WHERE n.NUMERO_RECETTE='.$num_rec.';'));
 $votant=mysql_fetch_array(mysql_query('SELECT count(*) FROM NOTE WHERE NUMERO_RECETTE='.$num_rec.';'));
 if ($votant[0])
   echo "Note moyenne : $avg_note[0] (Parmis $votant[0] votes)</br><a href=noterrecette.php?toto=$recette&titi=$num_rec>Notez la recette !</a></br></br>";
 else
   echo "Pas de note pour cette recette ! <a href=noterrecette.php?toto=$recette&titi=$num_rec>Notez la recette !</a></br></br>";
*/
 $sql5 = 'SELECT I.PSEUDO, M.DATE_MODIFICATION, M.DESCRIPTION_MODIFICATION FROM INTERNAUTE I, ACTION A, MODIFICATION M, SOUMISSION S WHERE I.NUMERO_INTERNAUTE=A.NUMERO_INTERNAUTE AND A.NUMERO_MODIFICATION=M.NUMERO_MODIFICATION AND M.NUMERO_MODIFICATION=S.NUMERO_MODIFICATION AND S.NUMERO_RECETTE='.$num_rec.';';
 $reponse = mysql_query ($sql5) or die ('Erreur SQL !'.$sql5.'<br/>'.mysql_error());

 if (mysql_num_rows($reponse)){
   echo " Historique : </br>";

   while($donnees = mysql_fetch_array($reponse))
   {
     echo"<ul>
     <li>$donnees[0] le $donnees[1] : $donnees[2]</li>
     </ul>";
   }
   echo "<a href=modif.php?toto=$recette&titi=$num_rec>Modifiez la !</a>";
 } else {
  echo "Pas de description ! <a href=modif.php?toto=$recette&titi=$num_rec>Ecrivez la !</a>";
}
mysql_close();

}
?> </br> </br>
    <form name="accueil" method="post" action="">
      <input type="submit" name="aller_acceuil" value="Accueil"/>   
    </form>
    <?php
    if (isset ($_POST['aller_acceuil'])){
      header("Location: index_client.html");
      exit(); 
    }
    ?>

</div>
</body>
</html>
