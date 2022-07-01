<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../styles/connexion.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type"
content="text/html; charset=UTF-8" />
<img src=../img/background.png id=fondecran class=fondecran alt=/>


<title>Connexion</title>




</head>

<body> 
<!-- <div class="acceudilhaut">
<div class="homepage"> <a href="index.php"> <i class="fa-solid fa-house"></i> </a>
 </div>
</div>
-->



<div class="conteneur_connexion">
 
<div class="connexion"> 
<p> Connexion </p>
<form  action ="connecter.php" method="post" autocomplete="off">
<p>
Adresse e-mail :
<input type="string" name="mail" value="<?php if(isset($_GET['mail'])){ echo $_GET['mail'] ;}  ?>" placeholder="Adresse e-mail"/>
</p>

<p>
Mot de passe :
<input type="password" name="mdp" value="<?php if(isset($_GET['mdp'])){ echo $_GET['mdp'] ;}  ?>" placeholder="Mot de passe"/>
</p>

<p>
<input id="bouton" type="submit" value="Valider">
</form>

</div>






<div class="inscription"> 
<p> Inscription </p> 
<form action="enregistrement.php" method="post" autocomplete="off">
<p>
Nom :
<input type="string" name="n" value="<?php if(isset($_GET['n'])){ echo $_GET['n'] ;}  ?>" placeholder="Nom" />
</p>

<p>
Prénom :
<input type="string" name="p" value="<?php if(isset($_GET['p'])){ echo $_GET['p'] ;}  ?>" placeholder="Prénom"/>
</p>

<p>
Pseudo : 
<input type="string" name="pseudo" value="<?php if(isset($_GET['pseudo'])){ echo $_GET['pseudo'] ;}  ?>" placeholder="Pseudo"/>
</p>

<p>
Adresse mail :
<input type="string" name="mail2" value="<?php if(isset($_GET['mail2'])){ echo $_GET['mail2'] ;}  ?>" placeholder="Adresse e-mail"/>
</p>

<p>
Mot de passe :
<input type="password" name="mdp1" value="<?php if(isset($_GET['mdp1'])){ echo $_GET['mdp1'] ;}  ?>" placeholder="Mot de passe"/>
</p>

<p>
Confirmer mot de passe : 
<input type="password" name="mdp2" value="<?php if(isset($_GET['mdp2'])){ echo $_GET['mdp2'] ;}  ?>" placeholder="Confirmer mot de passe"/>
</p>

<p>
<input id="bouton" type="submit" value="Valider">
</form>
</p>
</div>

</div>



</body>
</html>
