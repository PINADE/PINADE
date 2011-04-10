<?php slot('title'); 
if(isset($filiere)) echo $filiere;

if(isset($promotion)) echo ' - '.$promotion;

if(isset($erreur)) echo $erreur;

end_slot();
?>
