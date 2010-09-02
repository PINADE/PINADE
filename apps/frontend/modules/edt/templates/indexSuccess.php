<h1>
  Bienvenue sur l'emploi du temps de l'Ensisa.
</h1>

<h2>
  Selectionnez votre filière:
</h2>

<ul>
<?php foreach(array(
  "info" => "Informatique",
  "auto" => "Automatique",
  "text" => "Textile",
  "meca" => "Mécanique",
  "prod" => "Système de Production") as $id_f => $filiere): ?>
  <li><?php echo image_tag("logos/$id_f.png", "alt='logo $id_f'") ?>
      <?php echo link_to($filiere, '/'.$id_f) ?>
  </li>
<?php endforeach ?>
</ul>

