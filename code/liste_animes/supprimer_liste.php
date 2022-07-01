<?php
session_start();


$id_anime=$_POST['id_anime'];

$id_utilisateur=$_SESSION['utilisateur']['id_utilisateur'];


include('../bd.php');
	$bdd =getBD();
	
	if($_POST['a']=='2') {
	$verif = $bdd->query('SELECT id_anime from liste_a_voir where id_anime='.$id_anime.' and id_utilisateur='.$id_utilisateur);
	$ligne = $verif->fetch();
	$test_anime=$ligne['id_anime'];
	$verif -> closeCursor();


if(!empty($test_anime) || $test_anime!=""){
	$ajout=$bdd->query('DELETE from liste_a_voir where id_anime='.$id_anime.' and id_utilisateur='.$id_utilisateur);
	$ajout -> closeCursor();

echo '<meta http-equiv="Refresh" content="0; url=../fiche_anime.php?id_anime='.$id_anime.'"/>';

														}

else {

echo 'Anime déjà non présent dans la liste ! Retour à la fiche anime';
echo '<meta http-equiv="Refresh" content="2; url=../fiche_anime.php?id_anime='.$id_anime.'"/>';

	  }

							}
elseif($_POST['a']=='1') {
$verif = $bdd->query('SELECT id_anime from liste_vus where id_anime='.$id_anime.' and id_utilisateur='.$id_utilisateur);
	$ligne = $verif->fetch();
	$test_anime=$ligne['id_anime'];
	$verif -> closeCursor();


if(!empty($test_anime) || $test_anime!=""){
	$ajout=$bdd->query('DELETE from liste_vus where id_anime='.$id_anime.' and id_utilisateur='.$id_utilisateur);
	$ajout -> closeCursor();

echo '<meta http-equiv="Refresh" content="0; url=../fiche_anime.php?id_anime='.$id_anime.'"/>';

														}

else {

echo 'Anime déjà non présent dans la liste ! Retour à la fiche anime';
echo '<meta http-equiv="Refresh" content="2; url=../fiche_anime.php?id_anime='.$id_anime.'"/>';

	  }
							  }

else {
	echo 'Erreur, retour index';
	echo '<meta http-equiv="Refresh" content="2; url=../index.php"/>';
}

?>