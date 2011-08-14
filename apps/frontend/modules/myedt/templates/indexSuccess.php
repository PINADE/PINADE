<h1>Liste des emplois du temps</h1>

<ul>
  <?php foreach($adeservers as $adeserver): ?>
  <li>
    <?php echo $adeserver ?>
      <ul>
      <?php foreach($adeserver->getEdts() as $edt): ?>
        <li>
          <?php echo $edt ?>
          <ul>
          <?php foreach($edt->getCategories() as $categorie): ?>
            <li><?php echo $categorie ?>
              <ul>
              <?php foreach($categorie->getPromotions() as $promotion): ?>
                <li><?php echo link_to($promotion, 'myedt/show?categorie='.$categorie->getUrl().'&promo='.$promotion->getUrl()) ?></li>
              <?php endforeach ?>
              </ul>
            </li>
          <?php endforeach ?>
          </ul>
        </li>
      <?php endforeach ?>
      </ul>
  </li>
  <?php endforeach ?>
</ul>