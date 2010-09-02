<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title') ?>Emploi du temps ENSISA</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="global">
      <div id="entete">
        <ul>
          <li><?php echo link_to('Annales', 'http://annales.iariss.fr/') ?></li>
          <li><?php echo link_to('Trombinoscope', 'http://trombi.iariss.fr/') ?></li>
          <li><?php echo link_to('Blog', 'http://ensisa11.iariss.fr/') ?></li>
        </ul>
      </div>
      <div id="centre">
        <div id="navigation">
          <div id="menu">
            <ul>
              <li>Informatique</li>
              <li><?php echo link_to('1A', 'info/1A') ?></li>
              <li><?php echo link_to('2A', 'info/2A') ?></li>
              <li><?php echo link_to('3A', 'info/3A') ?></li>

              <li>Automatique</li>
              <li><?php echo link_to('1A', 'auto/1A') ?></li>
              <li><?php echo link_to('2A', 'auto/2A') ?></li>
              <li><?php echo link_to('3A', 'auto/3A') ?></li>

              <li>Textile</li>
              <li><?php echo link_to('1A', 'text/1A') ?></li>
              <li><?php echo link_to('2A', 'text/2A') ?></li>
              <li><?php echo link_to('3A', 'text/3A') ?></li>

              <li>Mécanique</li>
              <li><?php echo link_to('1A', 'meca/1A') ?></li>
              <li><?php echo link_to('2A', 'meca/2A') ?></li>
              <li><?php echo link_to('3A', 'meca/3A') ?></li>

              <li>Système de production</li>
              <li><?php echo link_to('1A', 'prod/1A') ?></li>
              <li><?php echo link_to('2A', 'prod/2A') ?></li>
              <li><?php echo link_to('3A', 'prod/3A') ?></li>
            </ul>
          </div>
          
          <div id="pub">
            bzdjmbdzmzd
          </div>
        </div>
        
        <div id="contenu">
          <?php echo $sf_content ?>
        </div>
      </div>

      <div id="pied">
        <p>Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr') ?>.</p>
      </div>
    </div>
  </body>
</html>
