<?php
session_start();
?>
<html>
<head>
       <!-- <img src=img/background.png id=fondecran class=fondecran alt=""/> -->
       <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>
<meta charset="UTF-8"/>
<style>
.profil{
font-family: verdana,Arial,'Helvetica Neue',Helvetica,sans-serif;
	margin-right: 250px;
	margin-left: auto;
	width: 150px;
	margin-top: -145px;
	margin-bottom: 30px;
color:white;

text-align: center;
bordefr:1px red dotted;
}
ul {
	height: 50px;
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    backgrgound-color: #333;
    position: absolute;
    top:208px;
    borfder:1px red dotted;
    right:0;
    left:0;
    font-family:Avenir;
}

li {
    float: left;

}

li a {
	    font-family:verdana;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    widfth: 50px;
    height: 25px;
    font-size: 120%;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
    background-color: #e1e7f5;
    color:#111;
}



#barre_recherche{
    position:relative; 
    widtfh:200px;
    height:30px; 
    floaft:top;
	font-size: 18px;
	text-align: center;
	top:9px;
	right:50px;
	font-family: verdana;
	 border: white 2px solid;
    border-radius: 2px;

    
}
#bouton_valide{
	 position:relative; 
    width:80px;
    height:30px; 
    floaft:top;
	fonft-size: 20px;
	top:7.2px;
	right: 50px;
	font-family: tahoma;
 border: white 2px solid;
    border-radius: 2px;
    color:white;
	background-color:#1d3557;
	font-size: 14px;
    font-weight: 700;
    line-height: 100%;
    cursor: pointer;
    
}
#bouton_valide:hover{
color:orange;
border-color: orange;
}

.titre { padding-left: 10px;
display: inline-block;
margin-bottom: 30px;

}

h2 {
font-size: 50px;
width:300px ;
height:80px;
borfder:1px dotted red;
padding:0;
padding-left: 100px;
}

#Se_connecter{
	    border: white 2px solid;
    border-radius: 2px;
    display: inline-block;
 bro:verdana,Avenir,lucida grande,tahoma,verdana,arial,sans-serif;
    font-family: tahoma;
    font-size: 14px;
    font-weight: 700;
    line-height: 100%;
    margin-left: 8px;
    padding: 4px 0;
    text-align: center;
    text-decoration: none;
    width: 90px;
    color: white;

}

#Se_connecter:hover{
color:orange;
border-color: orange;
}


#fondecran {
		/* Fixe l'image en haut à gauche de la page */
		position: fixed; 
		z-index: -4;
		top: 0; 
		left: 0; 
		/* Préserve le ratio de l'image */
		min-width: 100%;
		min-height: 100%;
	   }	
*{
	margin-left:0;
	margin-right: 0;
	padding:0;
	
	}
body{
backgrofund-color: blue;

widtdh:1000px;
left:0;
right: 0;}

</style>
</head>
<body>
<div class="titre">
<h2>
<img src="img/list_anim_blanc_nul.png" width="320px" height="80px" alt=""/>
</h2>
</div>
<div class="profil" >
			<?php
			include ("bd.php");
            $bdd=getBD();
        
				if(!isset($_SESSION['utilisateur'])){ ?>
			   <pid="Se_connecter"> <a href="connexion/connexion.php" id="Se_connecter" style="margin-top: 40px;"target="_parent" > Se connecter </a> </p>
    			<?php }
    			else {
	echo  '<br />';
					    echo "Bonjour ";
    echo $_SESSION['utilisateur']['pseudo']; 
	
    			
				?>	
		
	<p> <a href="connexion/deconnexion.php" id="Se_connecter" target="_parent"> Se déconnecter </a> </p>

	

    <?php 
echo  '<br />';$pp=$bdd->query('SELECT url_pp FROM utilisateur, photo_de_profil WHERE id_utilisateur='.$_SESSION['utilisateur']['id_utilisateur'].' and utilisateur.id_photo_de_profil=photo_de_profil.id_photo_de_profil');
 			$lignepp=$pp->fetch();
   ?> 
   <a href="profil/profil.php" style="position: absolute;top:30px;right:50px;" target="_parent"><?php echo "<img class='pp' src='".$lignepp['url_pp']."' width='150' height='150'";?></a>   
	<?php $pp->closeCursor();    
    }?>
</div>



<ul>

<li>
			<a href="index.php" target="_parent"> <i class="fa-solid fa-house"></i> </a>
			</li> 

			<li>
			<a href="forum/forum.php" target="_parent">Forum</a>
			</li>
	<?php 
		if(isset($_SESSION['utilisateur'])) {		?>	
			<li>
			<a href="liste_animes/liste_animes.php" target="_parent">Liste animes</a>
			</li>
		 	
			<li>
			<a href="profil/profil.php" target="_parent"> Profil</a>
			</li>
			
			
			<li>
			<a href="amis/liste_amis.php" target="_parent">Liste d'amis</a>
			</li>
			
			<li>
			<a href="amis/demandes_amis.php" target="_parent">Demandes d'amis</a>
			</li>
			<li>
			<a href="reco.php" target="_parent">Recommandation</a>
			</li>
 <?php } ?>

 <li style="float:right">
<form method="GET" action="recherche.php" target="_parent" autocomplete="on">
    
    <input type="search" name="recherche"  placeholder="Recherche anime.." id="barre_recherche"  />
    <input type="submit" value="Valider" id="bouton_valide" />
</form>
 </li>
</ul>

</body>
</html>