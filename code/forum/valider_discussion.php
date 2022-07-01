<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>      

		<title>Bienvenue sur list'animes</title>
        <?php
        //include("bd.php") ;
        //$bdd = getBD();
        ?>
     
	</head>

<body>



<?php 
        include ("../bd.php");
        session_start();
            function enregistrerdiscu($titre_discussion,$id_utilisateur){
                #fonction permetant d'ajouter une discussion a la base de donnée
                $bdd=getBD();
                $toto = 'INSERT INTO `discussion`(`titre_discussion`, `date_discussion`, `id_utilisateur`) VALUES ("'.$titre_discussion.'",NOW(),"'.$id_utilisateur.'")';
                
                $bdd -> query($toto);
                
                
               
            }


            function enregistrercom($message,$id_discussion,$id_utilisateur){
                #fonction permetant d'ajouter un commentaire a la base de donnée
                $bdd1=getBD();
                $totol = 'INSERT INTO `commentaires`(`message`, `id_discussion`, `id_utilisateur`) VALUES ("'.$message.'","'.$id_discussion.'","'.$id_utilisateur.'")';
                
                $bdd1 -> query($totol);
                
            }
            
            $titre= $_POST['titre'];
            $id_util=$_SESSION['utilisateur']['id_utilisateur'];
            //$date=$_POST['date'];
            $texte=$_POST['adr'];
            
            
            $bdd3 = getBD();
            enregistrerdiscu($titre,$id_util);
            
            
            $id_discu = $bdd3 -> query('select id_discussion from discussion where titre_discussion ="'.$titre.'"');
            $ligne3 = $id_discu -> fetch();
            $id_discu=$ligne3['id_discussion'];
            
            enregistrercom($texte,$id_discu,$id_util);
            
            
 ?>            

<p>
Votre discussion a bien été enregistrée, vous allez être redirigé vers le forum.
</p>

<?php
echo '<meta http-equiv="refresh" content="3; url=forum.php"/>';
?>

<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>
</body>



</html>

    