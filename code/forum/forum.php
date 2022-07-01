<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" href="../styles/main.css" type="text/css" media="screen" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>      

		<title>Bienvenue sur list'animes</title>
        <?php
        session_start();
        include("../bd.php") ;
        $bdd = getBD();
        ?>
     
	</head>

<body>
<style>


</style>

<table class="tableau-style">
    
    <thead> 
        <tr id="titre">
            <th>FORUM : toutes les discussions </th>
        </tr>
    </thead>    

    <tbody>
        
        
       
        <?php
        
        #on affiche toutes les discussions qui ont été commencées
        $rep = $bdd->query('select * from discussion');


        
        
        while( $ligne = $rep -> fetch() ){ 
        
        echo "<tr><td> <a href ="."discussions.php?id_discussion=".$ligne['id_discussion'].">".$ligne['titre_discussion']."</a></td></tr>";
        } 
      
        $rep -> closeCursor();
        ?> 
        
        
        
    <?php
    if(isset($_SESSION['utilisateur']))
    { ?>
    <tr>

    <td>

    vous pouvez créer une discussion <a href="creation_discussion.php">  ici </a>
    </td>
    </tr>
    <?php } ?>

    </tbody>
</table>
<div class="bandeau"> 
<object data="../bandeau.php" width="100%" height="100%">
</object>
</div>
</body>


</html>

    