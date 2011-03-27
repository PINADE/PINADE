<?php slot('title'); ?>Accueil<?php end_slot() ?>
<h1>
  Bienvenue sur l'emploi du temps de l'ENSISA.
</h1>

<h2>
  Selectionnez votre filière:
</h2>



<ul >
<?php foreach($filieres as $filiere): ?>
  <li><?php echo image_tag("logos/".$filiere->getLogo(), "alt='logo ".$filiere."'") ?>
      <?php echo link_to($filiere, '@filiere_index?filiere='.$filiere->getUrl()) ?>
  </li>
<?php endforeach ?>
</ul>

