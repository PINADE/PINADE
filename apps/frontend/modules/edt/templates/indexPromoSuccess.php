<?php include_partial('title', array('filiere' => $filiere)) ?>

<h1><?php include_slot('title') ?></h1>

<h2>
  Selectionnez votre promotion:
</h2>

<ul>
<?php foreach($filiere->getPromotions() as $promo): ?>
  <li><?php echo link_to($promo, "@image?filiere=".$filiere->getUrl()."&promo=".$promo->getUrl()."&semaine=".$sf_request->getParameter('semaine')) ?></li>
<?php endforeach ?>
</ul>

  
