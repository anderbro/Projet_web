<?php
session_start();


$id_anime=$_POST['id_anime'];

$id_utilisateur=$_SESSION['utilisateur']['id_utilisateur'];

$note=$_POST['note'];
include('../bd.php');
	$bdd =getBD();
	$verif = $bdd->query('SELECT id_anime from liste_vus where id_anime='.$id_anime.' and id_utilisateur='.$id_utilisateur);
	$ligne = $verif->fetch();
	$test_anime=$ligne['id_anime'];
	$verif -> closeCursor();
	


if(empty($test_anime) || $test_anime==""){
	echo 'Erreur, ne peut pas modifier la note';
	echo $test_anime.'2';
echo '<meta http-equiv="Refresh" content="3; url=../fiche_anime.php?id_anime='.$id_anime.'"/>';

}

else {
		$modif=$bdd->query('UPDATE liste_vus SET note_utilisateur='.$note.' WHERE id_anime='.$id_anime.' and id_utilisateur='.$id_utilisateur);
		$modif -> closeCursor();
echo '<meta http-equiv="Refresh" content="0; url=../fiche_anime.php?id_anime='.$id_anime.'"/>';

}

?>