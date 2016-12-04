<html>
  <head>
    <meta charset="utf-8">
    <title>ADMIN</title>
  </head>
  <body>
    <h1>ADMIN</h1>
    <div>
      <h1>Connectez-vous !</h1>
      <form name="connexion" method="post" action="gestion_base.php">
	Password : <input type="text" name="password"/> <br/>
	<input type="submit" name="valider" value="OK"/>	     
      </form>
      <?php
	 if (isset ($_POST['valider']) && $_POST['password'] == 'admin'){
	 }
	 ?>
     
    </div>
  </body>
</html>
