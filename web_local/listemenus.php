<?php session_start();?>

<html>
<head>
  <title>Les recettes gourmandes</title>
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="charge_menu" method="post" action="">
      Consulter un menu: <input type="text" name="consult_menu"/> <br/>
      <input type="submit" name="consulter_menu" value="OK"/>       
    </form>
    <?php 

    if (isset ($_POST['consulter_menu'])){

      $base = @mysql_connect ('localhost', 'root', '')or die("Impossible de se connecter : " . mysql_error());  
      mysql_select_db ('recettes', $base) ;

      $menu = mysql_real_escape_string($_POST['consult_menu']);

      $sql = mysql_query('SELECT * from menu where NOM_MENU="'.$menu.'";');
      $sql=mysql_fetch_array($sql);

      if (!$sql[0]) {
        die('Ce menu n\'existe pas');
      }

      $id = mysql_query('SELECT PSEUDO FROM internaute where NUMERO_INTERNAUTE = '.$sql[2].';');
      $id = mysql_fetch_array($id);

      $num_menu = $sql[0];

      $sql[1] = strtolower($sql[1]);
      $sql[1][0] = strtoupper($sql[1][0]);

      echo "Le menu $sql[1] a été ajouté par l'internaute $id[0]. </br></br>";


      $nb_menu=mysql_query('SELECT count(*) from COMPOSITION WHERE NUMERO_MENU='.$num_menu.';') or die ('Erreur SQL !'.$nb_menu.'<br/>'.mysql_error());
      if (mysql_num_rows($nb_menu)==0){
        $nb_menu=0;
      } else {
        $nb_menu=mysql_fetch_array($nb_menu);
        $nb_menu=$nb_menu[0];
      }

      echo "Le menu $sql[1] comprend $nb_menu recette";

      if($nb_menu == 0)
        echo ".</br></br>";
      else if ($nb_menu >1)
        echo "s :</br>";
      else 
        echo " :</br>";


      if($nb_menu){
       $sql2 = 'SELECT NOM_RECETTE FROM RECETTE R, COMPOSITION C WHERE R.NUMERO_RECETTE=C.NUMERO_RECETTE AND C.NUMERO_MENU='.$num_menu.';';
       $reponse = mysql_query ($sql2) or die ('Erreur SQL !'.$sql2.'<br/>'.mysql_error());

       while($donnees = mysql_fetch_array($reponse))
       {
         echo"<ul>
         <li><a href=listerecettes.php?toto=1&titi=$donnees[0]>$donnees[0]</li>
         </ul>";
       }

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