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
              <li><?php echo image_tag('logos/info.png', 'alt=') ?>Informatique
                <ul>
                  <li><?php echo link_to('1A', 'info/1a') ?></li>
                  <li><?php echo link_to('2A', 'info/2a') ?></li>
                  <li><?php echo link_to('3A', 'info/3a') ?></li>
                </ul>
              </li>
              
              <li><?php echo image_tag('logos/auto.png', 'alt=') ?>Automatique
                <ul>
                  <li><?php echo link_to('1A', 'auto/1a') ?></li>
                  <li><?php echo link_to('2A', 'auto/2a') ?></li>
                  <li><?php echo link_to('3A', 'auto/3a') ?></li>
                </ul>
              </li>

              <li><?php echo image_tag('logos/text.png', 'alt=') ?>Textile
                <ul>
                  <li><?php echo link_to('1A', 'text/1a') ?></li>
                  <li><?php echo link_to('2A', 'text/2a') ?></li>
                  <li><?php echo link_to('3A', 'text/3a') ?></li>
                </ul>
              </li>

              <li><?php echo image_tag('logos/meca.png', 'alt=') ?>Mécanique
                <ul>
                  <li><?php echo link_to('1A', 'meca/1a') ?></li>
                  <li><?php echo link_to('2A', 'meca/2a') ?></li>
                  <li><?php echo link_to('3A', 'meca/3a') ?></li>
                </ul>
              </li>

              <li><?php echo image_tag('logos/prod.png', 'alt=') ?>Système de production
                <ul>
                  <li><?php echo link_to('1A', 'prod/1a') ?></li>
                  <li><?php echo link_to('2A', 'prod/2a') ?></li>
                  <li><?php echo link_to('3A', 'prod/3a') ?></li>
                </ul>
              </li>
            </ul>
          </div>
          
          <div id="pub">
            <p>Tu es étudiant à l'ENSISA&nbsp;? Tu souhaites rejoindre une équipe motivée et acquérir de nombreuses compétences ? IARISS recrute, dès la rentrée !
Pour faciliter ta candidature, tu peux postuler sur un site dédié : <?php echo link_to('Candidature IARISS', 'http://candidature.iariss.fr') ?>
            </p>
          </div>
        </div>
        
        <div id="contenu">
          <?php echo $sf_content ?>
        </div>
      </div>

      <div id="pied">
        <p>Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr/') ?>.</p>
      </div>
    </div>
  </body>
</html>
