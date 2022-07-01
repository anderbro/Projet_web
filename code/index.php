<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles/main.css" type="text/css" media="screen" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
        <script src="https://kit.fontawesome.com/c6c76fd424.js" crossorigin="anonymous"></script>
        <title>Bienvenue sur list'animes</title>
        <?php
        include("bd.php") ;
        $bdd = getBD();
        ?>
        
        <style>
        
        
.edito{
margin-bottom: 0;
padding-bottom: 0;


right:0;
left:0;
top:0;
width: 100%;
}        

*{
bocrder:1px red dotted;
}

.image_bandeau{   
    padding: 0 15px 24%;
    position: relative;
    width: 100%;
    height: 0px;
    bordfer-bottom: 1px solid grey;
 }
 
 
.img_index{
    background-size: contain;
    min-height: 300px;
    background-position: top center;
    background-repeat: no-repeat;
    box-sizing: border-box;
}       



::before, ::after{
    box-sizing:border-box;
    margin:0;
    padding:0;

}    

.tableau-style{
    width:600px;
    border-collapse: collapse;
    box-shadow: 0 5px 50px rgba(0,0,0,0.15);
    cursor: pointer;
    margin: 0px auto;
    border: 1px solid #1d3557;
    border-spacing: 15px;
    
}

thead tr {

    
    background-color: #4C7DC3;
    border: 2px solid #4C7DC3;

    
    text-align: left;
}


th, td {
    padding: 15px 20px;
    text-align: center;
    color:white;
}
td{
    color:#4C7DC3;
}

tbody tr, td, th {
    font-family: tahoma;    
    
    border: 1px solid #4C7DC3;
}
tbody tr:nth-child(odd){
    background-color: #E3E9F7;

}

@media screen and (max-width: 550px) {
  body {
    
    align-items: flex-start;
  }
  .table-style  {
    width: 100%;
    margin: 0px;
    font-size: 10px;
  }
  th, td {
    padding: 10px 7px;
    
}

}

a{
	text-decoration: none;
    coflor:#4C7DC3;
    color:#1d3557;
    font-weight: 700;
}

a:hover{
	text-decoration: underline;
	
}
        </style>
    </head>



    <body>
    <div class="edito"> 
    <div class="image_bandeau">
  <div class="img_index" style="background-image: url(img/sword_art_online.png);">
  
  </div>
  </div>
</div>
 



<div class= "tableau" >
<table class="tableau-style">
    
        <thead>
            <tr>
            <th> Top 3 animes</th>
            <th> Notes </th>
            <th> Titre </th>
            </tr>
        </thead>
        <tbody>
        
        
        
        <?php
        
        
        $rep = $bdd->query('select * from anime');


        
        $i=0;
        while( $i<3 && $ligne = $rep -> fetch() ){ 
        echo "<tr> <td> <img src='".$ligne['image_url_anime']."'</td>
        <td>".$ligne['note_generale_anime']."</td><td>"
        ."<a href ="."fiche_anime.php?id_anime=".$ligne['id_anime'].">".$ligne['titre_anime']."</a>"."</td></tr>";
        $i=$i+1;
        }   
        
     $rep ->closeCursor();
    

            ?>
        
        
        <tbody>
      
    
</table>
</div>

<div class= "tableau">
<table class="tableau-style">
    
        <thead>
        <tr>
            <th><a style="color:white;font-family: tahoma;" href="forum/forum.php">FORUM : discussions récentes</a></th>
        </tr>
        </thead>

       <tbody> 
       
        <?php
        
        
        $rep = $bdd->query('select * from discussion ORDER BY id_discussion DESC');


        $i1=0;
        
        while( $i1<4     && $ligne = $rep -> fetch() ){ 
            
        echo "<tr><td> <a href ="."forum/discussions.php?id_discussion=".$ligne['id_discussion'].">".$ligne['titre_discussion']."</a></td></tr>";
        $i1=$i1+1;
        } 

        $rep -> closeCursor();
        ?> 
        
        
         
        <?php
        if(isset($_SESSION['utilisateur'])){
        ?> <tr>

        <td>
        <?php 
        echo 'Vous pouvez créer une discussion <a href="forum/creation_discussion.php">ici</a>'
        ?>
         </td>
        </tr>
        <?php } ?>
        
      
        
    </tbody>
</table>
</div>



<div class="bandeau"> 
<object data="bandeau.php" width="100%" height="100%">
</object>
</div>

</body>


</html>

