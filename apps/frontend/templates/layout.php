<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title') ?> - Emploi du temps ENSISA</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="global">
      <div id="entete">
        <ul>
          <li><?php echo link_to('Accueil', '/') ?></li>
          <li><?php echo link_to('Annales', 'http://annales.iariss.fr/') ?></li>
          <li><?php echo link_to('Trombinoscope', 'http://trombi.iariss.fr/') ?></li>
          <li><?php echo link_to('Blog', 'http://ensisa11.iariss.fr/') ?></li>
        </ul>
      </div>
      <div id="centre">
        <div id="navigation">
          <div id="menu">
            <ul>
              <li id='accueil-menu'>
                <?php echo link_to('Accueil', '/', "inline") ?>
              </li>
<?php foreach(array(
  "info" => "Informatique",
  "auto" => "Automatique",
  "text" => "Textile",
  "meca" => "Mécanique",
  "prod" => "Système de Production") as $id_f => $filiere): ?>
              <li><?php echo image_tag("logos/$id_f.png", "alt='logo $id_f'") ?><?php echo $filiere ?>
                <ul>
  <?php foreach(array("1a" => "1A", "2a" => "2A", "3a" => "3A") as $id_p => $promo): ?>
    <?php if($id_f == "prod" && $id_p == "3a") continue ?>
                  <li><?php echo link_to("$promo", "@image?filiere=$id_f&promo=$id_p&semaine=".$sf_request->getParameter('semaine')) ?></li>
  <?php endforeach ?>
                </ul>
              </li>
              <li><img alt="logo auto" src="/images/logos/auto.png" />Automatique
                  <ul>
                    <li><a href="/auto/1a/">1A</a></li>
                    <li><a href="/auto/2a/">2A</a></li>
                    <li><a href="/auto/3a/">3A</a></li>
                  </ul>

              </li>
              <li><img alt="logo text" src="/images/logos/text.png" />Textile
                  <ul>
                    <li><a href="/text/1a/">1A</a></li>
                    <li><a href="/text/2a/">2A</a></li>
                    <li><a href="/text/3a/">3A</a></li>
                  </ul>
              </li>

              <li><img alt="logo meca" src="/images/logos/meca.png" />Mécanique
                  <ul>
                    <li><a href="/meca/1a/">1A</a></li>
                    <li><a href="/meca/2a/">2A</a></li>
                    <li><a href="/meca/3a/">3A</a></li>
                  </ul>
              </li>
              <li><img alt="logo prod" src="/images/logos/prod.png" />Système de Production
                  <ul>
                    <li><a href="/prod/1a/">1A</a></li>
                    <li><a href="/prod/2a/">2A</a></li>
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
        <p>
          Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr/') ?>
          - <a href="mailto:contact@iariss.fr">Contact</a>
          - <?php echo link_to('FAQ', '@faq') ?>
        </p>
      </div>
    </div>

    <!-- Piwik -->
    <script type="text/javascript">
      var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.iariss.fr/" : "http://piwik.iariss.fr/");
      document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
      try {
        var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 9);
        piwikTracker.trackPageView();
        piwikTracker.enableLinkTracking();
      } catch( err ) {}
    </script><noscript><p><img src="http://piwik.iariss.fr/piwik.php?idsite=9" style="border:0" alt="" /></p></noscript>
    <!-- End Piwik Tag -->
  </body>
</html>
