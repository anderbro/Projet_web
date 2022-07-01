<html>
<head>

  <link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>
        <img src=../img/background.png id=fondecran class=fondecran alt=/>

  
 <?php 
 
function enregistrer(string $nom,string $prenom,string $pseudo,string $mail, string $mdp1) {
	$sql='INSERT INTO utilisateur (nom, prenom, pseudo, mail, mdp) VALUES ('.$nom.','.$prenom.','.$pseudo.','.$mail.','.$mdp1.')';
	return $sql;
} ;
  
if($_POST['n']=="" || $_POST['p']=="" || $_POST['pseudo']=="" || $_POST['mail2']=="" || 
	$_POST['mdp1']=="" || $_POST['mdp1']!=$_POST['mdp2']) {

	echo '<meta http-equiv="Refresh" content="0; 
	url=connexion.php?n='.$_POST["n"].'&p='.$_POST["p"].'&pseudo='.$_POST["pseudo"].'&mail2='.$_POST["mail2"]. '"/>' ;
	
}

else {

$pass_hash = password_hash($_POST['mdp1'], PASSWORD_DEFAULT);
echo $pass_hash;
	include('../bd.php');
	$bdd =getBD();
	$rep = $bdd->query(enregistrer('"'.$_POST['n'].'"','"'.$_POST['p'].'"','"'.$_POST['pseudo'].'"','"'.$_POST['mail2'].
	'"','"'.$pass_hash.'"' ));
	/* $rep-> closeCursor(); */
	$ad = enregistrer($_POST['n'].'"','"'.$_POST['p'].'"','"'.$_POST['pseudo'].'"','"'.$_POST['mail2'].
	'"','"'.$pass_hash.'"' );

 	echo '<meta http-equiv="Refresh" content="0; url=../index.php"/>';
}
?>

<title>Enregistrement</title>
</head>


<body>


</body>

</html>
