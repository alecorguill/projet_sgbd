<head>
  <title>Les recettes gourmandes</title>
  <meta charset="UTF-8">
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="sup_cat" method="post" action="">
      Categorie à supprimer: <input type="text" name="NOM_CAT"/> <br/>
      <input type="submit" name="valider_sup_cat" value="OK"/>       
    </form>

		<form name="accueil" method="post" action="">
			<input type="submit" name="aller_acceuil" value="Accueil"/>	  
		</form>
		<?php
		if (isset ($_POST['aller_acceuil'])){
			header("Location: index_admin.html");
			exit(); 
		}
		
	if (isset ($_POST['valider_sup_cat'])){

		include('seconnecter.php');
		$nom_cat=mysql_real_escape_string($_POST['NOM_CAT']);
		$sql = 'delete from CATEGORIE where NOM_CATEGORIE="'.$nom_cat.'";';
		mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
		
		mysql_close();
	}
	?>
		
</body>
</html>
