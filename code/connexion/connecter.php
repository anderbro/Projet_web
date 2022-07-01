<html>
<head>
<meta http-equiv="Content-Type"
content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
<img src=../img/background.png id=fondecran class=fondecran alt=/>
<title>Se connecter</title>
</head>
<body>

<?php
$mail=$_POST['mail'];

$mdp=$_POST['mdp'];




include('../bd.php');
	$bdd =getBD();
	$sql = $bdd->query('SELECT * from utilisateur where mail="'.$mail.'"');
	while ($ligne = $sql ->fetch()) {
	$id_utilisateur=$ligne['id_utilisateur'];
	$pseudo=$ligne['pseudo'];
	#$id_pp=$ligne['id_photo_de_profil'];
	$mdptest=$ligne['mdp'];
	}  
	$sql-> closeCursor();
	
if($mail=="" || $mdp=="" || !isset($id_utilisateur) || $id_utilisateur=="" || !isset($pseudo) || $pseudo=="" || !password_verify($mdp,$mdptest)  ) {      
	echo 'Erreur de saisie, retour à la page de connexion';
	echo '<meta http-equiv="Refresh" content="3; 
	url=connexion.php?mail='.$mail.'"/>' ;
		
	} 
	
else {


session_start();
$_SESSION['utilisateur']=array();
$_SESSION['utilisateur']['id_utilisateur']=$id_utilisateur;
$_SESSION['utilisateur']['pseudo']=$pseudo;




echo '<meta http-equiv="Refresh" content="0; 
	url=../index.php"/>' ;	
}	


	?>


</body>
</html>