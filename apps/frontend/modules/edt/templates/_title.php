<?php slot('title'); 
if(isset($categorie)) echo $categorie;

if(isset($promotion)) echo ' - '.$promotion;

if(isset($erreur)) echo $erreur;

end_slot();
?>
