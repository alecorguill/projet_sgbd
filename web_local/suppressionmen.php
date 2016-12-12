<head>
  <title>Les recettes gourmandes</title>
  <meta charset="UTF-8">
</head>
<body>
  <h1>Les recettes gourmandes</h1>
  <div>

    <form name="sup_men" method="post" action="">
      Menu à supprimer: <input type="text" name="NOM_MEN"/> <br/>
      <input type="submit" name="valider_sup_men" value="OK"/>       
    </form>

		<form name="accueil" method="post" action="">
			<input type="submit" name="aller_acceuil" value="Accueil"/>	  
		</form>
		<?php
		if (isset ($_POST['aller_acceuil'])){
			header("Location: index_admin.html");
			exit(); 
		}
		
	if (isset ($_POST['valider_sup_men'])){

		include('seconnecter.php');
		$nom_men=mysql_real_escape_string($_POST['NOM_MEN']);
		$sql = 'delete from MENU where NOM_MENU="'.$nom_men.'";';
		mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br/>'.mysql_error());
		
		mysql_close();
	}
	?>
		
</body>
</html>
