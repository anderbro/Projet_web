<?php
session_start();
?>
<html>
<head>

  <link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>

		  
<title>Profil d'un ami</title>
	     <?php
        include('../bd.php') ;
        $bdd = getBD();
        ?>
<style>
a{
					margin:10px;
					bordfer:1px blue dotted;
					width: 225px;
					height: 300px;
					position: relative;
					display: inline-block;
				}
				.note_anime{
display: none;				
				}
				.image1:hover div{
		display:block;
		}
</style>        
        
</head>

<body>

<?php 

		if(isset($_SESSION['utilisateur'])&&isset($_GET['id'])) {
		
		$id=$_SESSION['utilisateur']['id_utilisateur'];
		$id_ami=$_GET['id'];
	 	$estami = $bdd->query('SELECT * from etre_ami where (id_utilisateur='.$id.' and id_utilisateur1='.$id_ami.') OR (id_utilisateur1='.$id.' and id_utilisateur='.$id_ami.')  '); 
			$i=0;		
			while($ligne =$estami->fetch()){
			$i=$i+1;	
			}	
				
		if($i==2) {
		
		
		?>



<div id="profil_ami">

 <?php  $utilisateur = $bdd->query('SELECT id_utilisateur, pseudo, url_pp  FROM utilisateur, photo_de_profil WHERE id_utilisateur='.$id_ami.' and utilisateur.id_photo_de_profil=photo_de_profil.id_photo_de_profil');
		
		$ligne2 =$utilisateur->fetch();
 		echo "<img class='pp' src='../".$ligne2['url_pp']."' width='150' height='200' ><br>";
 		echo $ligne2['pseudo'];
		$utilisateur->closeCursor();?>
</div>



<?php $avoir = $bdd->query('SELECT liste_a_voir.id_anime, image_url_anime from liste_a_voir, anime where liste_a_voir.id_anime=anime.id_anime and id_utilisateur='.$id_ami);
?>
Liste animes à voir : <br />
<div class="liste">

	<?php
	$non_vide1=FALSE;
while($ligne1 =$avoir->fetch()) {	

echo "<a href=../fiche_anime.php?id_anime=".$ligne1['id_anime']."><img style='box-shadow:-5px -5px 5px 0 rgba(0,0,0,0.5);' src='".$ligne1['image_url_anime']."'></a>";
 

 #$id_anime_a_voir=$ligne1['id.anime']; 
 #$image_anime_a_voir=$ligne1['image_url_anime']; 
 $non_vide1=TRUE;
}

if(empty($non_vide1)){ 
	echo "Liste vide <br />";

 }
$avoir-> closeCursor();




$avu = $bdd->query('SELECT liste_vus.id_anime, image_url_anime,note_utilisateur from liste_vus, anime where liste_vus.id_anime=anime.id_anime and id_utilisateur='.$id_ami);

?> </div><br> 
Liste animes vus : <br /> 
<div class="liste">
	
	<?php
	
$non_vide2=FALSE;
while($ligne2 =$avu->fetch()) {	
$note=$ligne2['note_utilisateur'];
echo "<a class='image1' style='position:relative;width=250px;' href=../fiche_anime.php?id_anime=".$ligne2['id_anime']."><img style='box-shadow:-5px -5px 5px 0 rgba(0,0,0,0.5);' src='".$ligne2['image_url_anime']."'><div class='note_anime' style='left:60px;top:80px;' >".$note."</div></a>";
if($note!=NULL) {
echo "<div class='note_anime' style='left:20px;top:50px;border:2px yellow solid;' >".$note."</div>";
	}
#$id_anime_vus=$ligne2['id.anime']; 
#$image_anime_vus=$ligne2['image_url_anime']; 
$non_vide2=TRUE;
}

if(empty($non_vide2)){ 
	echo "Liste vide <br />";

 }

#echo 'utilisateur  :';
#print_r($_SESSION['liste_a_voir']);

$avu-> closeCursor();


?> </div>
 
<?php 						}	else {
						echo "Vous n'êtes pas amis, retour index";
						echo '<meta http-equiv="Refresh" content="2; url=../index.php"/>';	
							}
														}
														else{
															
															echo '<meta http-equiv="Refresh" content="2; url=../index.php"/>';
															}
?>

<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>
</body>

</html>


