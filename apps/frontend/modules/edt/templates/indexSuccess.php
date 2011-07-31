<?php slot('title'); ?>Accueil<?php end_slot() ?>
<h1>
  Emplois du temps <?php include_partial('global/nom_edt') ?>
</h1>
<span class="note-accueil">Ce site n'est <b>pas</b> officiel et donne les emplois du temps à titre indicatif. Plus d'informations sur <a href="http://www.pinade.org/">pinade.org</a>.</span>

<h2>Les emplois du temps sélectionnés</h2>

<ul style="-moz-column-count: 3;
        -moz-column-gap: 20px;
        -webkit-column-count: 3;
        -webkit-column-gap: 20px;
        column-count: 3;
        column-gap: 20px;">
<?php foreach($categories as $categorie): ?>
  <li><?php echo image_tag("logos/".$categorie->getLogo(), "alt='logo ".$categorie."'");
   echo " ".link_to($categorie, '@categorie_index?categorie='.$categorie->getUrl()) ?>
    <ul>
    <?php foreach($categorie->getPromotions() as $promotion): ?>
      <li>
        <?php echo link_to($promotion, "@image?categorie=".$categorie->getUrl()."&promo=".$promotion->getUrl()."&semaine=") ?>
      </li>
    <?php endforeach ?>
    </ul>
  </li>
<?php endforeach ?>
</ul>

<?php include_partial('global/adsense_lb') ?>
