<html>
  <head>
    <meta charset="utf-8">
    <title>Les recettes gourmandes - Données de la base</title>
  </head>
  <body>
    <h1>Les recettes gourmandes</h1>   
    <div>

      <!--INTERNAUTE-->

    <?php
      include('seconnecter.php');
       $sql = 'SELECT * FROM INTERNAUTE;';
       $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
       ?>   
    <table>
      <tr>
        <th>Numéro Internaute</th>
        <th>Pseudo</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_INTERNAUTE'];?></th>
        <th><?php echo $donnees['PSEUDO'];?></th>
      </tr>
     
      <?php
         }
         ?>
    </table></br>

    <!--RECETTE-->

    <?php
    $sql = 'SELECT * FROM RECETTE;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Recette</th>
        <th>Nom Recette</th>
        <th>Date de Création</th>
        <th>Temps de Préparation</th>
        <th>Temps de Cuisson</th>
        <th>Nombre de Personne(s)</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_RECETTE'];?></th>
        <th><?php echo $donnees['NOM_RECETTE'];?></th>
	<th><?php echo $donnees['DATE_CREATION_RECETTE'];?></th>
        <th><?php echo $donnees['TEMPS_PREPARATION_RECETTE'];?></th>
        <th><?php echo $donnees['TEMPS_CUISSON_RECETTE'];?></th>
        <th><?php echo $donnees['NOMBRE_DE_PERSONNES'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--MENU-->

    <?php
    $sql = 'SELECT * FROM MENU;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>

    <table>
      <tr>
        <th>Numéro Menu</th>
        <th>Nom Menu</th>
        <th>Numéro Internaute</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_MENU'];?></th>
        <th><?php echo $donnees['NOM_MENU'];?></th>
	<th><?php echo $donnees['NUMERO_INTERNAUTE'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--MODIFICATION-->

    <?php
    $sql = 'SELECT * FROM MODIFICATION;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Modification</th>
        <th>Descritpion Modification</th>
        <th>Date de Modification</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_MODIFICATION'];?></th>
        <th><?php echo $donnees['DESCRIPTION_MODIFICATION'];?></th>
	<th><?php echo $donnees['DATE_MODIFICATION'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--COMMENTAIRE-->

    <?php
    $sql = 'SELECT * FROM COMMENTAIRE;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Commentaire</th>
        <th>Numéro Internaute</th>
        <th>Numéro Recette</th>
        <th>Description Commentaire</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_COMMENTAIRE'];?></th>
        <th><?php echo $donnees['NUMERO_INTERNAUTE'];?></th>
	<th><?php echo $donnees['NUMERO_RECETTE'];?></th>
        <th><?php echo $donnees['DESCRIPTION_COMMENTAIRE'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--NOTE-->

    <?php
    $sql = 'SELECT * FROM NOTE;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Valeur Note</th>
        <th>Numéro Recette</th>
        <th>Numéro Internaute</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['VALEUR_NOTE'];?></th>
        <th><?php echo $donnees['NUMERO_RECETTE'];?></th>
	<th><?php echo $donnees['NUMERO_INTERNAUTE'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--INGREDIENT-->

    <?php
    $sql = 'SELECT * FROM INGREDIENT;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Ingrédient</th>
        <th>Nom Ingrédient</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_INGREDIENT'];?></th>
        <th><?php echo $donnees['NOM_INGREDIENT'];?></th>
      </tr>
 
      <?php
         }
         ?>
    </table></br>

    <!--CARACTERISTIQUE_NUTRITIONELLE-->

    <?php
    $sql = 'SELECT * FROM CARACTERISTIQUE_NUTRITIONNELLE;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Caractéristique</th>
        <th>Nom Caractéristique</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_CARACTERISTIQUE'];?></th>
        <th><?php echo $donnees['NOM_CARACTERISTIQUE'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--ACTION-->

    <?php
    $sql = 'SELECT * FROM ACTION;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Internaute</th>
        <th>Numéro Modification</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_INTERNAUTE'];?></th>
        <th><?php echo $donnees['NUMERO_MODIFICATION'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--SOUMISSION-->

    <?php
    $sql = 'SELECT * FROM SOUMISSION;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Modification</th>
        <th>Numéro Recette</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_MODIFICATION'];?></th>
        <th><?php echo $donnees['NUMERO_RECETTE'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--CONTENU-->

    <?php
    $sql = 'SELECT * FROM CONTENU;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Recette</th>
        <th>Numéro Ingrédient</th>
	<th>Quantité</th>
	<th>Unité</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_RECETTE'];?></th>
        <th><?php echo $donnees['NUMERO_INGREDIENT'];?></th>
	<th><?php echo $donnees['QUANTITE'];?></th>
	<th><?php echo $donnees['UNITE'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--COMPOSITION-->

    <?php
    $sql = 'SELECT * FROM COMPOSITION;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Recette</th>
        <th>Numéro Menu</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_RECETTE'];?></th>
        <th><?php echo $donnees['NUMERO_MENU'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <!--DEFINITION-->

        <?php
    $sql = 'SELECT * FROM DEFINITION;';
    $reponse = mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());   
       ?>
    <table>
      <tr>
        <th>Numéro Ingrédient</th>
        <th>Numéro Caractéristique</th>
      </tr>
      <?php
	 while($donnees = mysql_fetch_array($reponse))
	 {
	 ?>
      <tr>
        <th><?php echo $donnees['NUMERO_INGREDIENT'];?></th>
        <th><?php echo $donnees['NUMERO_CARACTERISTIQUE'];?></th>
      </tr>
      
      <?php
         }
         ?>
    </table></br>

    <?php  mysql_close(); ?>
    </div>
</body>
</html>
