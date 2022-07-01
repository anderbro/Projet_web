<?php
session_start();
?>








<html>
<head>

  <link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>



<title>Demande en ami</title>
</head>


<body>
<?php 
if(isset($_SESSION['utilisateur'])) {
	$id=$_SESSION['utilisateur']['id_utilisateur'];
	$id_ami=$_POST['id_utilisateur'];
	
	if(isset($_POST['recherche_ami'])){$recherche=$_POST['recherche_ami'];}
	
	include('../bd.php');
	$bdd =getBD();
	$rep = $bdd->query('INSERT INTO etre_ami (id_utilisateur, id_utilisateur1, date_ajout) VALUES ('.$id.','.$id_ami.', NOW())');
	
	
#echo '<meta http-equiv="Refresh" content="5; url=profil.php"/>';
?>

<?php
}
if(isset($recherche)) { echo '<meta http-equiv="Refresh" content="0; url=../recherche.php?recherche='.$recherche.'"/>'; }
else {
	echo '<meta http-equiv="Refresh" content="0; url=demandes_amis.php"/>';
}
?>
<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>
</body>

</html>
