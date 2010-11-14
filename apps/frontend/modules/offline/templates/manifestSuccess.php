CACHE MANIFEST
# Version : timestamp of the image of the current week
# V <?php echo filemtime(sfConfig::get('sf_web_dir').$adeImage->getWebPath()) ?>

CACHE:
# CSS files
<?php
foreach($sf_response->getStylesheets() as $file => $options) {
  echo stylesheet_path($file)."\n";
}
?>
# IMG logo files
<?php
foreach($filieres as $f) {
  echo image_path("logos/$f")."\n";
}
?>

# Javascript
<?php echo javascript_path('offline.js')."\n"           ?>

# Others images
<?php echo image_path("divers/precedent.png")."\n";     ?>
<?php echo image_path("divers/suivant.png")."\n";       ?>

# The welcome page
<?php echo url_for('@homepage')."\n" ?>

# The edt image
<?php echo url_for("@image_img?filiere=$filiere&promo=$promo&semaine=$semaine")."/img.gif\n"; ?>

# The current page
<?php echo url_for("@image?filiere=$filiere&promo=$promo&semaine=$semaine")."\n"; ?>
# The current page has no semaine number if it's default
<?php echo ($semaine == AdeTools::getSemaineNumber()) ? url_for("@image?filiere=$filiere&promo=$promo&semaine=")."\n" : "# it's not current week\n"; ?>

# If you are online, you can still download what you want
NETWORK:
*

FALLBACK:
<?php echo url_for("@image_img?filiere=$filiere&promo=$promo&semaine=$semaine")."/img.gif" ?> <?php echo image_path("edt-offline.png") ?>

