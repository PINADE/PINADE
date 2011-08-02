<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc><?php echo url_for('@homepage', true) ?></loc>
   </url>

<?php foreach($categories as $categorie): ?>
   <url>
      <loc><?php echo url_for('categorie_index', array('categorie' => $categorie->getUrl()), true) ?></loc>
   </url>
  <?php foreach($categorie->getPromotions() as $promotion): ?>
   <url>
      <loc><?php echo url_for('@image?categorie='.$categorie->getUrl().'&promo='.$promotion->getUrl().'&semaine=', true) ?></loc>
   </url>
  <?php endforeach ?>
<?php endforeach ?>
</urlset>
