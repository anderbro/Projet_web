<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>      

		<title>Bienvenue sur list'animes</title>
        <?php
        include("../bd.php") ;
        $bdd = getBD();
        ?>
     
	</head>

<style>



p{
    background-color:#4C7DC3;
    height:100px;
    text-align:center;
    margin-left:400px;
    margin-right:400px;
    font-family: tahoma; 
    color: white;
}
form{
    
    color:#4C7DC3;
}
#bouton_env{
    width: 200px;
    height: 40px;
    margin-right:40px;
	position:relative;
    float:right; 
	font-family: tahoma;
    border: white 2px solid;
    border-radius: 2px;
    color:white;
	background-color:#4C7DC3;
    font-size:20px;
	
}
#pres{ 
    padding-top:20px;
    font-size:30px ;
    padding-bottom:20px;
}


.infos{
    
    font-size:25px;

}
</style>



<body>


<p id="pres">
    Bonjour, voici les informations nécessaires pour créer un commentaire : </br>
</p>

<p class="infos">
            Titre de la discussion : 
            <?php 
            #on récupere le titre grace à une requête sql
            $_GET['id_discussion'];

            $popo =$_GET['id_discussion'] ;
            $rep = $bdd -> query("select * from discussion where discussion.id_discussion='$popo'");
            
            $mat1 =  $rep -> fetch();
            echo $mat1['titre_discussion'];
            ?>
</p>

    <!-- formulaire permettant de récuperer un nouveau commentaire -->
    <form action="valider_commentaire.php" method="post" autocomplete="off" >
        <p class="infos">
            Contenu du commentaire :
            <textarea type="text" name="adr" value="" size="250" id="discussion"></textarea>
        </p>
       
        <p class="infos">
            <input type="hidden" name="id_discussion" value="<?php echo $_GET['id_discussion'];?>" >
        </p>

        <p>
            <input type="submit" value="Envoyer" id="bouton_env">
        </p>
    </form></br>

  

<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>

</body>



</html>

    