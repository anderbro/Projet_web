<?php 
session_start();
?>
<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>      

		<title>Bienvenue sur list'animes</title>
		<style>
		body{
			
			min-height: 850px;
			}
		</style>
		<script>



function NotationSystem() {
	for (i=1;i<NbStar+1;i++) {
		var img			=document.getElementById('Star'+i);
			
		img.onclick		=function() {
var monPar = document.getElementById("monPar");
/*	<?=
		"var id_anime = \"$id_anime\";"
			?> */
			
		/*	var id_anime = '<?php echo $id_anime; ?>' ; 
		var id_anime=1; */
monPar.innerHTML ='<form name="f" method="post" action="liste_animes/modifier_note.php"><input type="hidden" name="note" value="'+Name2Nb(this.id)+'" /><input type="hidden" name="id_anime" value="'+id_anime+'" /></form>';
		
	document.f.submit(); };
		//Réaction lors du clic sur une étoile
		//Evidemment, il faudrait compléter cette fonction pour la rendre vraiment utile.
		//Par exemple, envoyer la note dans une base de donnée via un XMLHttpRequest.
		
		img.alt			='Donner la note de '+i;
		//Texte au survol
		StarOutUrl0=Tableau[i-1];
		img.src=StarOutUrl0;
		img.onmouseover	=function() {StarOver(this.id);};
		img.onmouseout	=function() {StarOut(this.id);};
	}
}

function StarOver(Star) {
	StarNb=Name2Nb(Star);
	for (i=1;i<(StarNb*1)+1;i++) {

		document.getElementById('Star'+i).src=StarOverUrl;
	}
}

function StarOut(Star) {
	StarNb=Name2Nb(Star);
	for (i=1;i<(StarNb*1)+1;i++) {
				StarOutUrltest=Tableau[i-1];
		document.getElementById('Star'+i).src=StarOutUrltest;
	}
}

function Name2Nb(Star) {
	//Le survol d'une étoile ne nous permet pas de connaître directement son numéro
	//Cette fonction extrait donc ce numéro à partir de l'Id
	StarNb=Star.slice(LgtStarBaseId);
	return(StarNb);
} 

</script>
	</head>

<body onload="NotationSystem();">

<?php
include("bd.php");
$bdd =getBD();
if(isset($_SESSION['utilisateur'])) {
$id=$_SESSION['utilisateur']['id_utilisateur'];
}
$id_anime=$_GET["id_anime"];


$rep = $bdd->query('SELECT * from anime where id_anime='.$id_anime);

$ligne = $rep ->fetch();

?>

<div class="titre_anime">
<?php
echo $ligne['titre_anime']."<br /> <br />"; 
?>
</div>

<div class="titre_anime_anglais">
<?php
if($ligne['titre_anime']!=$ligne['titre_anglais_anime']){
	echo $ligne['titre_anglais_anime']."<br /> <br />"; 
}
?>
</div>

<div class="type_anime">
<?php
if($ligne['type_anime']!=""){
	echo 'Type : '.$ligne['type_anime']."<br /> <br />";
}
?>
</div>

<div class="note_anime">
<?php
if($ligne['note_generale_anime']!=0 & $ligne['nb_notes_anime']>=25){
	echo $ligne['note_generale_anime']."<br /> <br />";
}
?>
</div>

<div class="nb_anime">
<?php
if($ligne['nb_episodes_anime']>1){
	echo "Nombre d'épisodes : ".$ligne['nb_episodes_anime']."<br /> <br />"; 
}
if($ligne['nb_episodes_anime']==1) {
	echo "Durée (film) : ".$ligne['duree_anime']."<br /> <br />";
}
?>
</div>

<div class="rang_anime">
<?php
if($ligne['rang_anime']!=15000) {
	echo 'Rang : '.$ligne['rang_anime']."<br /> <br />"; 
}
?>
</div>

<div class="date_anime">
<?php
if($ligne['date_anime']!="" & $ligne['type_anime']!="Movie") {
	echo 'Date de début et de fin : '.$ligne['date_anime']."<br /> <br />"; 
}
if($ligne['date_anime']!="" & $ligne['type_anime']=="Movie") {
	echo 'Date de sortie : '.$ligne['date_anime']."<br /> <br />"; 
}
?>
</div>

<div  class="genre_anime">
<?php
if($ligne['genre_anime']!="") {
	echo 'Genres : '.$ligne['genre_anime']."<br /> <br />"; 
}
?>
</div>


<div class="img_anime">
<?php
$a="";
echo "<img src=".$ligne["image_url_anime"]." ' width='225' height='350' alt='".$a."'/>";
?>
</div>

<div class="img_defaut">
<?php
echo "<img src=https://i.pinimg.com/originals/03/8a/c3/038ac3da59e4b3d9416367d15119f2a7.png ' width='225' height='350' alt='".$a."'/>";
?>
</div>

<div class="ajout_liste">
<?php
$rep-> closeCursor(); 

if(isset($id)) {
############################# AJOUT LISTES #################################
?>
<div>

<?php
	$verif_vu = $bdd->query('SELECT id_anime,note_utilisateur from liste_vus where id_anime='.$id_anime.' and id_utilisateur='.$id);
	$ligne_vu = $verif_vu->fetch();
	$test_anime=$ligne_vu['id_anime'];
	$note=$ligne_vu['note_utilisateur'];
	$verif_vu -> closeCursor();
if(empty($test_anime) || $test_anime==""){
?>
<p style="display: inline-block;">Liste des animes vus :</p>

<form  action="liste_animes/ajouter_anime_vu.php" method="post" autocomplete="off">

<input type="hidden" name="id_anime" value="<?php echo $id_anime ?>"/>

<input class="bouton" type="submit" value="Ajouter">

</form> 
<?php } 

else{ 
/* echo 'Ma note : '.$note.'/10 <br><br>';
echo '<p class="texte_ajout">Anime déjà ajouté à la liste des animes vus</p> <br>';
?>
<form  action="liste_animes/modifier_note.php" method="post" autocomplete="off">
<p>
<input type="hidden" name="id_anime" value="<?php echo $id_anime ?>"/>
</p>
<p>
Modifier ma note : 
<input type="number" name="note" step="0.5" min="0" max="10"/>
</p>

<p>
<input class="bouton" type="submit" value="Valider la modification">

</p>
</form> */
 ?>
 
<div id="etoiles_fiche_anime">
<?php if($note>=1) {

echo '<img id="Star1" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star1" src="img/etoilenoire.png" width="50px" height="50px" />';
}

if($note>=2) {
echo '<img id="Star2" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star2" src="img/etoilenoire.png" width="50px" height="50px" />';
}

if($note>=3) {
echo '<img id="Star3" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star3" src="img/etoilenoire.png" width="50px" height="50px" />';
}

if($note>=4) {
echo '<img id="Star4" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star4" src="img/etoilenoire.png" width="50px" height="50px" />';
}

if($note>=5) {
echo '<img id="Star5" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star5" src="img/etoilenoire.png" width="50px" height="50px" />';
}

if($note>=6) {
echo '<img id="Star6" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star6" src="img/etoilenoire.png" width="50px" height="50px" />';
}

if($note>=7) {
echo '<img id="Star7" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star7" src="img/etoilenoire.png" width="50px" height="50px" />';
}

if($note>=8) {
echo '<img id="Star8" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star8" src="img/etoilenoire.png" width="50px" height="50px" />';
}
if($note>=9) {
echo '<img id="Star9" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star9" src="img/etoilenoire.png" width="50px" height="50px" />';
}
if($note>=10) {
echo '<img id="Star10" src="img/etoilejaune.png" width="50px" height="50px" />';
}
else{
echo '<img id="Star10" src="img/etoilenoire.png" width="50px" height="50px" />';
}
?>
</div><br>
<p style="display: inline-block;">Liste des animes vus :</p>
<img style="display: inline-block;margin-bottom: -20px;" src="img/v.webp" alt="validé" width="50px" height="50px" >
<div style="display: inline-block;">
<form  action="liste_animes/supprimer_liste.php" method="post" autocomplete="off">

<input type="hidden" name="id_anime" value="<?php echo $id_anime ?>"/>

<input type="hidden" name="a" value="1"/>


<input class="bouton" type="submit" value="Supprimer">

</form>

</div>



<?php
}
?>
</div>
<br> 

<div>
<p style="display: inline-block;">Liste des animes à voir :</p>
<?php

$verif_a_voir = $bdd->query('SELECT id_anime from liste_a_voir where id_anime='.$id_anime.' and id_utilisateur='.$id);
	$ligne_a_voir = $verif_a_voir->fetch();
	$test_anime1=$ligne_a_voir['id_anime'];
	$verif_a_voir -> closeCursor();
	
if(empty($test_anime1) || $test_anime1==""){
?>

<form  action="liste_animes/ajouter_anime_a_voir.php" method="post" autocomplete="off">

<input type="hidden" name="id_anime" value="<?php echo $id_anime ?>"/>

<input class="bouton" type="submit" value="Ajouter">

</form>


<?php } 
else{
	
#echo '<br><p class="texte_ajout">Anime déjà ajouté à la liste des animes à voir</p>';

?>


<img style="display: inline-block;margin-bottom: -20px;" src="img/v.webp" alt="validé" width="50px" height="50px" >
<div style="display: inline-block;">

<form  action="liste_animes/supprimer_liste.php" method="post" autocomplete="off">

<input type="hidden" name="id_anime" value="<?php echo $id_anime ?>"/>

<input type="hidden" name="a" value="2"/>

<input class="bouton" type="submit" value="Supprimer">

</form>
</div>

<?php 
}

}
?>

</div>
</div>

<div class="bandeau"> 
<object data="bandeau.php" width="100%" height="100%">
</object>
</div>

<p id="monPar"></p>
<script>
var StarBaseId='Star';
var StarOutUrl='img/etoilenoire.png';		//image par défaut

var StarOutUrl1=document.getElementById('Star1').src;
var StarOutUrl2=document.getElementById('Star2').src;
var StarOutUrl3=document.getElementById('Star3').src;
var StarOutUrl4=document.getElementById('Star4').src;
var StarOutUrl5=document.getElementById('Star5').src;
var StarOutUrl6=document.getElementById('Star6').src;
var StarOutUrl7=document.getElementById('Star7').src;
var StarOutUrl8=document.getElementById('Star8').src;
var StarOutUrl9=document.getElementById('Star9').src;
var StarOutUrl10=document.getElementById('Star10').src;

var Tableau= [
StarOutUrl1,StarOutUrl2,StarOutUrl3,StarOutUrl4,StarOutUrl5,StarOutUrl6,StarOutUrl7,StarOutUrl8,StarOutUrl9,StarOutUrl10
];

StarOverUrl='img/etoilejaune.png';		//image d'une étoile sélectionnée
			//id de base des étoiles
var NbStar=10;			//nombre d'étoiles

LgtStarBaseId=StarBaseId.lastIndexOf('');

var id_anime = '<?php echo $id_anime; ?>' ;
</script>
</body>



</html>