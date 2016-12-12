<head>
  <title>Les recettes gourmandes</title>
  <meta charset="UTF-8">
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="sup_rec" method="post" action="">
      Recette à supprimer: <input type="text" name="NOM_REC"/> <br/>
      <input type="submit" name="valider_sup_rec" value="OK"/>       
    </form>

		<form name="accueil" method="post" action="">
			<input type="submit" name="aller_acceuil" value="Accueil"/>	  
		</form>
		<?php
		if (isset ($_POST['aller_acceuil'])){
			header("Location: index_admin.html");
			exit(); 
		}
		
	if (isset ($_POST['valider_sup_c'])){

		include('seconnecter.php');
		$nom_rec=mysql_real_escape_string($_POST['NOM_REC']);
		$sql = 'delete from RECETTE where NOM_RECETTE="'.$nom_rec.'";';
		mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
		
		mysql_close();
	}
	?>
		
</body>
</html>
