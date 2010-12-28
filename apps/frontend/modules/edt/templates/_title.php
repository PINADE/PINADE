<?php slot('title'); 
if(isset($nom_filiere)) echo $nom_filiere;

if(isset($nom_promo)) echo ' - '.$nom_promo;

if(isset($erreur)) echo $erreur;

end_slot();
?>
