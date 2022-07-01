<?php
function getBD(){
$bdd = new PDO('mysql:host=localhost;dbname=projet_animes;charset=utf8',
'root', 'root');
return $bdd;
}
?>
