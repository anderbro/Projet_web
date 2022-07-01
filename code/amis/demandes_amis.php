<?php
session_start();
?>
<html>
<head>

  <link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>


<title>Demandes d'amis</title>
		  <?php
        include('../bd.php') ;
        $bdd = getBD();
        ?>
</head>
<style>


  a:hover{
            colfor:white;
            bordder-color:orange;
            bafckground-color: #1d3557;}
</style>
<body>

<?php 

		if(isset($_SESSION['utilisateur'])) {
		$id=$_SESSION['utilisateur']['id_utilisateur'];
		?><table class="tableau-style">
			<thead>
<th colspan="4"> Demandes d'amis </th>	
		</thead>
		<tbody>
		<?php
		$demande = $bdd->query('SELECT * from etre_ami where id_utilisateur1='.$id); 
				 									
		while($ligne=$demande->fetch()) {		
					
		$ami=$bdd->query('SELECT * from etre_ami where id_utilisateur1='.$ligne['id_utilisateur'].' and id_utilisateur='.$id); 		
 		$isami=$ami->fetch();		
 			if(empty($isami)) {	
 			
 		$profil=$bdd->query('SELECT id_utilisateur, pseudo, url_pp  FROM utilisateur, photo_de_profil WHERE id_utilisateur='.$ligne['id_utilisateur'].' and utilisateur.id_photo_de_profil=photo_de_profil.id_photo_de_profil');
 		$ligneprofil=$profil->fetch();	
 		?> <tr><td><?php echo "<img class='pp' src='../".$ligneprofil['url_pp']."' width='150' height='200'";?></td>
 		<td><?php echo $ligneprofil['pseudo'];?></td>
<td>
<form  action="ajout_ami.php" method="post" autocomplete="off">
<p>
<input type="hidden" name="id_utilisateur" value="<?php echo $ligneprofil['id_utilisateur'] ?>"/>
</p>

<p>
<input class='bouton_amis' style='text-decoration: none;' type="submit" value="Accepter">

</p>
</form>
</td> 		
 		
 		<td>
<form  action="rejet_ami.php" method="post" autocomplete="off">
<p>
<input type="hidden" name="id_utilisateur" value="<?php echo $ligneprofil['id_utilisateur'] ?>"/>
</p>

<p>
<input class='bouton_amis' type="submit" value="Rejeter">

</p>
</form>
</td>

 							
 							<?php }
 			$ami->closeCursor();
 												  }
 				  $demande -> closeCursor();

?> </tbody></table> <?php
														}
?>


<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>
</body>

</html>






