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
                  <li><?php echo link_to('1A', 'info/1A') ?></li>
                  <li><?php echo link_to('2A', 'info/2A') ?></li>
                  <li><?php echo link_to('3A', 'info/3A') ?></li>
                </ul>
              </li>
              
              <li><?php echo image_tag('logos/auto.png', 'alt=') ?>Automatique
                <ul>
                  <li><?php echo link_to('1A', 'auto/1A') ?></li>
                  <li><?php echo link_to('2A', 'auto/2A') ?></li>
                  <li><?php echo link_to('3A', 'auto/3A') ?></li>
                </ul>
              </li>

              <li><?php echo image_tag('logos/text.png', 'alt=') ?>Textile
                <ul>
                  <li><?php echo link_to('1A', 'text/1A') ?></li>
                  <li><?php echo link_to('2A', 'text/2A') ?></li>
                  <li><?php echo link_to('3A', 'text/3A') ?></li>
                </ul>
              </li>

              <li><?php echo image_tag('logos/meca.png', 'alt=') ?>Mécanique
                <ul>
                  <li><?php echo link_to('1A', 'meca/1A') ?></li>
                  <li><?php echo link_to('2A', 'meca/2A') ?></li>
                  <li><?php echo link_to('3A', 'meca/3A') ?></li>
                </ul>
              </li>

              <li><?php echo image_tag('logos/prod.png', 'alt=') ?>Système de production
                <ul>
                  <li><?php echo link_to('1A', 'prod/1A') ?></li>
                  <li><?php echo link_to('2A', 'prod/2A') ?></li>
                  <li><?php echo link_to('3A', 'prod/3A') ?></li>
                </ul>
              </li>
            </ul>
          </div>
          
          <div id="pub">
            Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié.
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
