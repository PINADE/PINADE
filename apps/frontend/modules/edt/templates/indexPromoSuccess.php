<?php include_partial('title', array('nom_filiere' => $nom_filiere)) ?>

<h1>
  <?php include_slot('title') ?>
</h1>

<h2>
  Selectionnez votre promotion:
</h2>

<?php $filieres = sfConfig::get('sf_filieres') ?>

<ul>
<?php foreach($filieres[$filiere]['promotions'] as $id_p => $promo): ?>
  <li><?php echo link_to($promo['nom'], "@image?filiere=$filiere&promo=$id_p&semaine=".$sf_request->getParameter('semaine')) ?></li>
<?php endforeach ?>
</ul>

  
