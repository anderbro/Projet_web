<?php 
session_start();
?>

<!DOCTYPE html>

	<html>
	<head>
		<link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>      
	<!--	<img src="../img/background.png" id=fondecran class=fondecran alt=""/> -->
		<title>Bienvenue sur list'animes</title>
		<style>
			body{
font-size: 24px;
pofsition: relative;
codlor:white;
font-weight: bold;
}

h3{
font-size:35px;
margin-left: auto;
margin-right: auto;
text-align: center;
}	

#id1 {
width: 300px;
top:550px;
left:180px;
position: absolute;
text-align: center;
}

#id2 {
width: 300px;
top:850px;
position: absolute;
left:870px;
text-align: center;
}

#id3 {
width: 300px;
top:1150px;
position: absolute;
text-align: center;
left:180px;
}

#img1 {
width: 250px;
top:450px;
position: absolute;
left:500px;
}
#img2 {
width: 250px;
top:750px;
position: absolute;
left:1200px;
}
#img3 {
width: 250px;
top:1050px;
position: absolute;
left:500px;
}
		</style>		
		
		
	</head>


<body>

<?php
include("bd.php");
$bdd =getBD();
$id_utilisateur=$_SESSION['utilisateur']['id_utilisateur'];

//enregistrer l'identifiant le plus élevé
$nb=$bdd->query('SELECT id_utilisateur FROM utilisateur ORDER BY id_utilisateur DESC LIMIT 1');
$id=0;
$ligne =$nb->fetch()	;
	$id+=$ligne['id_utilisateur'];

 $vus=array();
$j=0;
while($j<=$id) {
	$liste=$bdd->query('SELECT id_anime FROM liste_vus where liste_vus.id_utilisateur='.$j.' ORDER BY id_anime ASC');	# liste vus de l'utilisateur $j
	$maliste=array();
while($ligneliste=$liste->fetch()) {
			array_push($maliste, $ligneliste['id_anime']);
}	
	
	$vus[$j]=array();
	$rep = $bdd->query('select id_anime from anime');
	$i=1;

		while($i<=13211){ //13211
		array_push($vus[$j], 0);
					$i=$i+1;
		}
		
		$a=0;
		$b=0;
		while($a<count($maliste)) {
		$b=$maliste[$a];
		$vus[$j][$b-1]=$b;
		$a=$a+1;
		}
		

	$j+=1;
	}

$f=0;
$sim=array();//table de la taille du nombre d'utilisateur 
while($f<$id) {
	$cmp[$f]=array_diff($vus[$id_utilisateur],$vus[$f]);
	array_push($sim, count($cmp[$f])); //ajout de la différence du nb d'anime vu entre l'utilisateur connecté et l'utilisateur f

	$f+=1;
	}
$rep ->closeCursor();


//Trouver le minimum de différence dans le tableau
$min = $sim[0];
for($i=0; $i < count($sim); $i++){	
	if ($sim[$i] < $min && $sim[$i]!=0){
   	$min = $sim[$i];
   	$ind=$i;
	}
}

$yo=$bdd->query('Select id_utilisateur from utilisateur where id_utilisateur='.$ind);						

while($ligne20 =$yo->fetch()) {	


}
$simi = $bdd->query('SELECT liste_vus.id_anime, image_url_anime from liste_vus, anime where liste_vus.id_anime=anime.id_anime and id_utilisateur='.$ind);

//$moi = $bdd->query('SELECT liste_vus.id_anime, image_url_anime from liste_vus, anime where liste_vus.id_anime=anime.id_anime and id_utilisateur='.$id_utilisateur);
?> 

<br><br> 
	<h3> Recommandation de la liste d'un utilisateur similaire à vous <br><br> </h3> 
	<?php
	
$non_vide2=FALSE;
$reco=array();
while($ligne2 =$simi->fetch()) {	

$an=$ligne2['id_anime'];
	$demande=$bdd->query('SELECT * from liste_vus where id_utilisateur='.$id_utilisateur.' and id_anime='.$an); 		
 		$lignedemande=$demande->fetch();
 			if(empty($lignedemande)) {
 								array_push($reco, $an);	

	
}

} 

//print_r($reco);
$non_vide2=TRUE;

################## RECO NOTE GENERALE ######################
$maxnote=0;
$i=0;
while($i<count($reco)) {

$anime=$reco[$i];

$note=$bdd->query('Select note_generale_anime from anime where id_anime='.$anime);
$lignenote=$note->fetch();
if ($lignenote['note_generale_anime']>$maxnote){
$maxnote=$lignenote['note_generale_anime'];
$id_note=$anime;
$enlever_i=$i;
}


$i+=1;
}
if(isset($id_note)){
echo "<p id='id1'>Anime de l'utilisateur ayant la meilleure note generale : <br></p>";
$result_note=$bdd->query('select id_anime,image_url_anime from anime where id_anime='.$id_note);
$ligne_r_note=$result_note->fetch();
echo "<a id='img1' href=fiche_anime.php?id_anime=".$ligne_r_note['id_anime']."><img src='".$ligne_r_note['image_url_anime']."'></a><br>";
}


################## RECO POPULAIRE ######################
array_splice($reco, $enlever_i,1);
// print_r($reco);

$maxpop=14000;
$j=0;
while($j<count($reco)) {

$anime=$reco[$j];

$pop=$bdd->query('Select popularite_anime from anime where id_anime='.$anime);
$lignepop=$pop->fetch();

if ($lignepop['popularite_anime']<$maxpop){
	
$maxpop=$lignepop['popularite_anime'];
$id_pop=$anime;
$enlever_j=$j;
}


$j+=1;
}
if(isset($id_pop)){
echo "<p id='id2'>Anime le plus populaire dans la liste de l'utilisateur : <br></p>";
$result_note=$bdd->query('select id_anime,image_url_anime from anime where id_anime='.$id_pop);
$ligne_r_note=$result_note->fetch();
echo "<a id='img2' href=fiche_anime.php?id_anime=".$ligne_r_note['id_anime']."><img src='".$ligne_r_note['image_url_anime']."'></a><br>";
}



################## RECO NOTE UTILISATEUR ######################
array_splice($reco, $enlever_j,1);
 //print_r($reco);

$maxnoteperso=null;

$k=0;
while($k<count($reco)) {

$anime=$reco[$k];

$noteperso=$bdd->query('Select note_utilisateur from liste_vus where id_anime='.$anime.' and id_utilisateur='.$ind);
$lignenoteperso=$noteperso->fetch();

if ($lignenoteperso['note_utilisateur']>$maxnoteperso){
	
$maxnoteperso=$lignenoteperso['note_utilisateur'];
$id_noteperso=$anime;
$enlever_k=$k;
}


$k+=1;
}
if(isset($id_noteperso)){
echo "<p id='id3'>Anime le mieux noté par l'utilisateur : <br></p>";
$result_note=$bdd->query('select id_anime,image_url_anime from anime where id_anime='.$id_noteperso);
$ligne_r_note=$result_note->fetch();
echo "<a id='img3' href=fiche_anime.php?id_anime=".$ligne_r_note['id_anime']."><img src='".$ligne_r_note['image_url_anime']."'></a><br>";
}

?>

<div class="bandeau"> 
<object data="bandeau.php" width="100%" height="100%">
</object>
</div>

</body>







</html>



    