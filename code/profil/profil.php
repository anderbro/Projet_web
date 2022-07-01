<?php 
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>

        <title>Profil</title>
        <?php
        include("../bd.php") ;
        $bdd = getBD();
        ?>
        <style>
            #profil{
            	font-size: 100%;
            }
            #photo{
            	position: fixed;
            	left: 70%;
            	top: 25%;
					text-align: center;
            }
            a:hover{
            color:white;
            bordder-color:orange;
            background-color: #1d3557;}

            
        </style>
        
        
    </head>



    <body>
     
 <div class="edito"> 
    <div class="image_bandeau">
  <div class="img_index" style="background-image: url(../img/les_meilleurs_animes_de_2022.jpg);">
	<div class="texte_img_bandeau">
	  Profil
	</div>  

  </div>
  </div>
</div>     
     
<div id="page_profil">
        <?php if(isset($_SESSION['utilisateur'])) {
		
		$id=$_SESSION['utilisateur']['id_utilisateur'];
	 	$profil = $bdd->query('SELECT * from utilisateur where id_utilisateur='.$id); 		
			$ligne =$profil->fetch();
				echo '<strong style="font-size: 30px;"> Nom : </strong>'.$ligne['nom'].'<br>';				
				echo '<strong style="font-size: 30px;"> Prénom : </strong>'.$ligne['prenom'].'<br>';	
				echo '<strong style="font-size: 30px;"> Pseudo : </strong>'.$ligne['pseudo'].'<br>';	
				echo '<strong style="font-size: 30px;"> Adresse mail : </strong>'.$ligne['mail'].'<br>';	
				
				$profil->closeCursor();
		//border-color:#1d3557;color:#1d3557;		?>
				</div>
				<div id="bouton_profil">
        <p> <a class='b_profil' style='text-decoration: none;' href="../amis/liste_amis.php"> Liste d'amis </a> </p>
        <p> <a  class='b_profil' style='text-decoration: none;'  href="../amis/demandes_amis.php"> Demandes d'amis </a> </p>
        <p> <a  class='b_profil' style='text-decoration: none;' href="pp.php"> Changer de pp </a></p> 
<?php } ?>


</div>
<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>
    </body>

</html>