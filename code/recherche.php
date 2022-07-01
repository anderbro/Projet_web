<?php
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>

        <style>
        
			body {
			font-size: 20px;


			}         
			
		#tab1, #tab2, #tab3{	 width: 100px;
  height: 25px;
  border-color: red;
  background-color: white;
  border-radius: 7px;
 
}



button:hover {
color: red;
}

#buttons{
	text-align: center;
	dispflay: block;
	width: 800px;
margin:0 auto;
margin-left: 200px;
}
#animes, #utilisateurs, #forums{
mardgin-left: auto;
margfin-right: auto;
widthf: 800px;
marginf-left: 200px;
}
        </style>
      
        
        <title>Bienvenue sur list'animes</title>
        <?php
        include('bd.php') ;
        $bdd = getBD();
        ?>
    </head>

<body>

<div class= "tableau" >
<?php

# $rep = $bdd->query('select * from anime');
# $rep -> closeCursor(); 
$id=300000;
if(isset($_SESSION['utilisateur'])){
    $id=$_SESSION['utilisateur']['id_utilisateur'];
}


 if(isset($_GET['recherche']) AND !empty($_GET['recherche'])) {
    $q = htmlspecialchars($_GET['recherche']);
    
   ?> <div id="buttons">
  <button id="tab1"><b>Animes</b></button>
  <button id="tab2"><b>Utilisateurs</b></button>
  <button id="tab3"><b>Forums</b></button>
<br> <br> <br> 
 
</div>
<?php
    ### Animes ###
    $articles = $bdd->query('SELECT id_anime,titre_anime,type_anime,note_generale_anime,image_url_anime FROM anime WHERE titre_anime LIKE "%'.$q.'%" ORDER BY popularite_anime ASC ,note_generale_anime DESC, id_anime DESC LIMIT 10');
    if($articles->rowCount() == 0) {
       $articles = $bdd->query('SELECT id_anime,titre_anime,type_anime,note_generale_anime,image_url_anime FROM anime WHERE CONCAT(titre_anime, contexte_anime) LIKE "%'.$q.'%" ORDER BY popularite_anime ASC,note_generale_anime,id_anime DESC LIMIT 10');
    }
    ?> 
<div id="animes">    
    <table class="tableau-style" style="margin-left: auto;margin-right: auto;width: 800px;margin-left: 200px;">
   
     <?php  
    while($ligne1 =$articles->fetch()) { ?>
    
    	<tr><td><?php echo "<img src='".$ligne1['image_url_anime']."'"?></td>
 		<td><?php echo $ligne1['titre_anime'].'<br> <br>'; 
 		echo $ligne1['type_anime'].'<br> <br>';
 		echo 'note : '.$ligne1['note_generale_anime']; ?></td>
 		<td><?php echo '<a href ="fiche_anime.php?id_anime='.$ligne1['id_anime'].'">Voir la fiche</a>' ?></td></tr>
 		<?php    
    }
       $articles -> closeCursor();   
 ?>
	</table>
	</div>
	
	<!-- ### Utilisateurs ### -->
	<div id="utilisateurs">
	<table class="tableau-style" style="margin-left: auto;margin-right: auto;width: 800px;margin-left: 200px;">
	  <?php  $utilisateurs = $bdd->query('SELECT id_utilisateur, pseudo, url_pp  FROM utilisateur, photo_de_profil WHERE pseudo LIKE "%'.$q.'%" and utilisateur.id_photo_de_profil=photo_de_profil.id_photo_de_profil ORDER BY pseudo LIMIT 10');
	
		while($ligne2 =$utilisateurs->fetch()) { 
if($ligne2['id_utilisateur']!=$id) {		
		?>
      	<tr><td><?php echo "<img class='pp' src='".$ligne2['url_pp']."' width='150' height='200' >";?></td>
 		<td><?php echo $ligne2['pseudo'];?></td>
		<?php if(isset($_SESSION['utilisateur'])){  		
 		
 	  $ami = $bdd->query('SELECT * from etre_ami where (id_utilisateur='.$id.' and id_utilisateur1='.$ligne2['id_utilisateur'].') OR (id_utilisateur1='.$id.' and id_utilisateur='.$ligne2['id_utilisateur'].')  '); 
		$i=0;		
		while($ligne3 =$ami->fetch()){
		$i=$i+1;	
		}
		#echo $i;
		if($i!==2) {		 		
		
		$demande=$bdd->query('SELECT * from etre_ami where id_utilisateur='.$id.' and id_utilisateur1='.$ligne2['id_utilisateur']); 		
 		$lignedemande=$demande->fetch();
 			if(empty($lignedemande)) {
 				
 				?>
 		
 		<td>
<form  action="amis/ajout_ami.php" method="post" autocomplete="off">
<p>
<input type="hidden" name="id_utilisateur" value="<?php echo $ligne2['id_utilisateur'] ?>"/>
</p>

<p>
<input type="hidden" name="recherche_ami" value="<?php echo $q ?>"/>
</p>

<p>
<input type="submit" value="Ajouter en ami">

</p>
</form>
</td>
<?php
 											}
 			else { 
 			?>
 			<td><?php echo "Demande d'ami déjà envoyée"?></td></tr>
 		<?php 
 				  }
 				  $demande -> closeCursor();
 	}
 	
 	else {
 		?>
 		
 		<td><?php echo '<a href ="amis/profil_ami.php?id='.$ligne2['id_utilisateur'].'">Voir le profil</a>'?></td></tr>
 		<?php 
 		  }
 		  $ami -> closeCursor(); 
    }
 	  
    											}			}
       $utilisateurs -> closeCursor();   
 ?>
	
		
	</table>
	</div>
	
	<!-- ### Forum ### -->
	<div id="forums">
	<table class="tableau-style" style="margin-left: auto;margin-right: auto;width: 800px;margin-left: 200px;">
	  <?php  $forum = $bdd->query('SELECT id_discussion, titre_discussion, pseudo, discussion.id_utilisateur FROM discussion,utilisateur WHERE CONCAT(titre_discussion, pseudo) LIKE "%'.$q.'%" and discussion.id_utilisateur=utilisateur.id_utilisateur ORDER BY titre_discussion ASC, id_discussion DESC LIMIT 10');
		#echo 
		while($ligne4 =$forum->fetch()) { ?>  
    	<tr><td><?php echo $ligne4['titre_discussion'];?></td>
 		<td><?php echo $ligne4['pseudo'];?></td>
 		<td><?php echo '<a href ="forum/discussions.php?id_discussion='.$ligne4['id_discussion'].'">Voir la discussion</a><br>';
 		$messages = $bdd->query('SELECT COUNT(message) as msg from discussion,commentaires where discussion.id_discussion=commentaires.id_discussion and discussion.id_discussion='.$ligne4['id_discussion']); 
		$ligne5 =$messages->fetch();
		echo $ligne5['msg'].'  messages';
		$messages -> closeCursor();   
		?></td>
	
 	  <?php
    }	
		
		$utilisateurs -> closeCursor();   
 ?>
	
		
	</table>
	</div>
<?php  }  

    ?>
    
</div>


<div class="bandeau"> 
<object data="bandeau.php" width="100%" height="100%">
</object>
</div>

<script language="javascript"> 

document.getElementById("tab1").className = "highlight";
document.getElementById("tab2").className = "none";
  document.getElementById("tab3").className = "none";
  document.getElementById("animes").style.display = "";
    document.getElementById("utilisateurs").style.display = "none";
      document.getElementById("forums").style.display = "none";
	
document.getElementById("tab1").addEventListener("click", highlight1);
document.getElementById("tab2").addEventListener("click", highlight2);
document.getElementById("tab3").addEventListener("click", highlight3);

//What happens when you click on tab 1:
function highlight1() {
console.log("Bonjour");
  document.getElementById("tab1").className = "highlight";
  document.getElementById("tab2").className = "none";
  document.getElementById("tab3").className = "none";
  document.getElementById("animes").style.display = "";
    document.getElementById("utilisateurs").style.display = "none";
      document.getElementById("forums").style.display = "none";
}
//What happens when you click on tab 2:
function highlight2() {

  document.getElementById("tab2").className = "highlight";
  document.getElementById("tab1").className = "none";
  document.getElementById("tab3").className = "none";
   document.getElementById("utilisateurs").style.display = "";
     document.getElementById("animes").style.display = "none";
  document.getElementById("forums").style.display = "none";
}
//What happens when you click on tab 3:
function highlight3() {
    document.getElementById("tab2").className = "highlight";
  document.getElementById("tab1").className = "none";
  document.getElementById("tab3").className = "none";
   document.getElementById("forums").style.display = "";
  document.getElementById("animes").style.display = "none";
    document.getElementById("utilisateurs").style.display = "none";
}



</script>  
</body>

</html>
