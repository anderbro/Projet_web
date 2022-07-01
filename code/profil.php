<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>
        <img src=img/background.png id=fondecran class=fondecran alt=""/>
        <title>Bienvenue sur list'animes</title>
        <?php
        include("bd.php") ;
        $bdd = getBD();
        ?>
        <style>
            #profil{
            	font-size: 100%;
            }
            #photo{
            	position: absolute;
            	left: 70%;
            	top: 25%;
					text-align: center;
            }
        </style>
    </head>



    <body>
        <p id='profil'>
            li
        <?php
     //   echo 'Nom : '.$_SESSION['utilisateur']['n'].'<br /> Prenom : '$_SESSION['utilisateur']['p'].'<br /> Adresse e-mail : '$_SESSION['utilisateur']['mail2'].'<br /> Mot de passe : '$_SESSION['utilisateur']['mdp1'].'<br />';
        ?>
        </p>
        <p> <a href="liste_amis.php"> Liste d'amis </a> </p>
        <p> <a href="demandes_amis.php"> Demandes d'amis </a> </p>
        <p id="photo"> <a href="pp.php"> Changer de pp </a></p>

    </body>

</html>