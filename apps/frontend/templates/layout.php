<!DOCTYPE html>
<html lang="fr">

  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title') ?> - Emploi du temps ENSISA</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_partial('global/perso-css') ?>
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

      <div id="pied">
        <p>
          Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr/') ?>.
           <b><?php echo $_SERVER['SERVER_NAME'] ?></b> vous est livré grâce à <acronym title="PINADE Is Not ADE"><?php echo link_to('PINADE', 'https://github.com/PINADE/PINADE') ?></acronym>.
          - <a href="mailto:contact@iariss.fr">Contact</a>
          - <?php echo link_to('FAQ', '@page?url=faq') ?>
          - <span id="status"></span>
        </p>
      </div>
    </div>

  </body>
</html>
