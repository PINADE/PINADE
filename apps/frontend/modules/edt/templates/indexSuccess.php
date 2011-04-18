<?php slot('title'); ?>Accueil<?php end_slot() ?>
<h1>
  Bienvenue sur le site de <b>votre</b> emploi du temps.
</h1>


<h2>Les emplois du temps <i>officiels</i></h2>

<ul style="-moz-column-count: 3;
        -moz-column-gap: 20px;
        -webkit-column-count: 3;
        -webkit-column-gap: 20px;
        column-count: 3;
        column-gap: 20px;">
<?php foreach($filieres as $filiere): ?>
  <li><?php echo image_tag("logos/".$filiere->getLogo(), "alt='logo ".$filiere."'");
   echo " ".link_to($filiere, '@filiere_index?filiere='.$filiere->getUrl()) ?>
    <ul>
    <?php foreach($filiere->getPromotions() as $promotion): ?>
      <li>
        <?php echo link_to($promotion, "@image?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=") ?>
      </li>
    <?php endforeach ?>
    </ul>
  </li>
<?php endforeach ?>
</ul>

