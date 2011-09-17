<!DOCTYPE html>
<html lang="fr">

  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <meta name="description" content="Emplois du temps <?php include_partial('global/nom_edt') ?>" />
    <meta property="fb:admins" content="<?php echo implode(',',sfConfig::get('app_facebook_auth', array())) ?>" />

    <title><?php include_slot('title') ?> - Emploi du temps <?php include_partial('global/nom_edt') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <link rel="stylesheet" href="/css/mobile.css" type="text/css" media="handheld, only screen and (max-device-width: 480px)" />
    <?php include_javascripts() ?>

  </head>
  <body>
    <div id="global">
      <div id="centre">
        <div id="contenu">
          <?php echo $sf_content ?>
        </div>

        <div id="navigation">
            <?php include_partial('global/menu') ?>
        </div>
      </div>

      <?php include_partial('global/pied') ?>
    </div>
  </body>
</html>
