<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="global">
      <div id="entete">
        <ul>
          <li><?php echo link_to('Annales', 'http://annales.iariss.fr') ?></li>
          <li><?php echo link_to('Trombinoscope', 'http://trombi.iariss.fr') ?></li>
          <li><?php echo link_to('Blog', 'http://ensisa11.iariss.fr') ?></li>
        </ul>
      </div>
      <div id="centre">
        <div id="navigation">
          <div id="menu">
            <ul>
              <li>Informatique</li>
              <li><?php echo link_to('1A', 'edt/info/1A') ?></li>
              <li><?php echo link_to('2A', 'edt/info/2A') ?></li>
              <li><?php echo link_to('3A', 'edt/info/3A') ?></li>

              <li>Automatique</li>
              <li><?php echo link_to('1A', 'edt/auto/1A') ?></li>
              <li><?php echo link_to('2A', 'edt/auto/2A') ?></li>
              <li><?php echo link_to('3A', 'edt/auto/3A') ?></li>

              <li>Textile</li>
              <li><?php echo link_to('1A', 'edt/tex/1A') ?></li>
              <li><?php echo link_to('2A', 'edt/tex/2A') ?></li>
              <li><?php echo link_to('3A', 'edt/tex/3A') ?></li>

              <li>Mécanique</li>
              <li><?php echo link_to('1A', 'edt/meca/1A') ?></li>
              <li><?php echo link_to('2A', 'edt/meca/2A') ?></li>
              <li><?php echo link_to('3A', 'edt/meca/3A') ?></li>

              <li>Système de production</li>
              <li><?php echo link_to('1A', 'edt/prod/1A') ?></li>
              <li><?php echo link_to('2A', 'edt/prod/2A') ?></li>
              <li><?php echo link_to('3A', 'edt/prod/3A') ?></li>
            </ul>
          </div>
          
          <div id="pub">
            bzdjmbdzmzd
          </div>
        </div>
        
        <div id="contenu">
          <?php echo image_tag('fake', 'alt=fake') ?>
          <?php echo $sf_content ?>
        </div>
      </div>

      <div id="pied">
        <p>Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr') ?>.</p>
      </div>
    </div>
  </body>
</html>
