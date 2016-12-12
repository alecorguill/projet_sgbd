<?php session_start();?>
<html>
<head>
	<title>Les recettes gourmandes - Inscription</title>
</head>
<body>
	<h1>Les recettes gourmandes</h1>
	<div>
		<h2>Entrez votre pseudo </h2>
		<form name="inscription" method="post" action="">
			Entrez un pseudo : <input type="text" name="pseudo"/> <br/>
			<input type="submit" name="valider_pseudo" value="OK"/>	     
		</form>
		<?php
		if (isset ($_POST['valider_pseudo'])){
			$pseudo=$_POST['pseudo'];
			//Si c'est l'admin on le redirige vers la page admin
			if($pseudo=='admin'){
				$_SESSION['pseudo']=$pseudo;
				header("Location: index_admin.html");
				exit();
			}
			//Sinon on regarde si le pseudo existe
			include('seconnecter.php');
			$pseudo=mysql_real_escape_string($pseudo);
			$pseudo_sql = 'SELECT NUMERO_INTERNAUTE FROM INTERNAUTE where pseudo="'.$pseudo.'";';
			$result = mysql_query($pseudo_sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
			//Si le pseudo n'existe pas on le rajoute
			if(mysql_num_rows($result) == 0 ){
				$max_nb_internaute = 'SELECT MAX(NUMERO_internaute) FROM INTERNAUTE;';
				$max_nb_internaute = mysql_query($max_nb_internaute);
				$cur_nb = mysql_fetch_array($max_nb_internaute);
				$cur_nb[0]++;
				$sql = 'insert into INTERNAUTE(NUMERO_INTERNAUTE,pseudo) values ('.$cur_nb[0].',"'.$pseudo.'");';
				mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
			}
			//On redirige le client vers la page client
			$_SESSION['pseudo']=$pseudo;
			$nb_internaute = 'SELECT NUMERO_internaute FROM INTERNAUTE where pseudo="'.$pseudo.'";';
			$nb_internaute = mysql_query($nb_internaute);
			$cur_nb = mysql_fetch_array($nb_internaute);
			$_SESSION['id']    =$cur_nb[0];
			header("Location: index_client.html");
			mysql_close();

			exit();
		}
		?>
	</div>
</body>
</html>
