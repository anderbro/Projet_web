<?php
session_start();
?>
<html>
<head>

  <link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>


  
 <?php 
 
	include('../bd.php');
	$bdd =getBD();
	$id_pp=$_GET['id_photo_de_profil'];
	$id=$_SESSION['utilisateur']['id_utilisateur'];
	$rep = $bdd->query('UPDATE utilisateur SET id_photo_de_profil='.$id_pp.' WHERE id_utilisateur='.$id);

 	echo '<meta http-equiv="Refresh" content="0; url=profil.php"/>';

?>

<title>Enregistrement</title>
</head>


<body>

<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>
</body>

</html>
