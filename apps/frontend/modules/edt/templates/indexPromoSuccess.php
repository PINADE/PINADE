<?php include_partial('title', array('categorie' => $categorie)) ?>

<h1><?php include_slot('title') ?></h1>

<h2>
  Selectionnez votre emploi du temps&nbsp;:
</h2>

<ul>
<?php foreach($categorie->getPromotions() as $promo): ?>
  <li><?php echo link_to($promo, "@image?categorie=".$categorie->getUrl()."&promo=".$promo->getUrl()."&semaine=".$sf_request->getParameter('semaine')) ?></li>
<?php endforeach ?>
</ul>

  
