<!DOCTYPE html>
<html lang="fr" <?php
 echo ($sf_request->getCookie("offline") == "enabled") ?
 'manifest="'.url_for('@manifest?filiere='.$sf_request->getParameter('filiere').'&promo='.$sf_request->getParameter('promo').'&semaine=').'" >'
 : '>'
?>
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title') ?> - Emploi du temps ENSISA</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <link rel="stylesheet" href="/css/mobile.css" type="text/css" media="handheld, only screen and (max-device-width: 480px)" />
    <?php include_javascripts() ?>
    <?php if($sf_request->getCookie("offline") == "enabled")
            echo javascript_include_tag('offline.js');
    ?>
  </head>
  <body <?php echo ($sf_request->getCookie("offline") == "enabled") ? 'onload="loaded();"' : '' ?> >
    <div id="global">
      <div id="centre">
        <div id="contenu">
          <?php echo $sf_content ?>
        </div>

        <div id="navigation">
          <div id="menu">
            <ul>
              <li id='accueil-menu'>
                <?php echo link_to('Accueil', '@homepage', "inline") ?>
              </li>
<?php $filieres = sfConfig::get('sf_filieres') ?>
<?php foreach($filieres as $id_f => $filiere): ?>
              <li><?php echo image_tag("logos/$id_f.png", "alt='logo $id_f'") ?><?php echo $filiere['nom'] ?>
                <ul>
  <?php foreach($filiere['promotions'] as $id_p => $promo): ?>
                  <li><?php echo link_to($promo['nom'], "@image?filiere=$id_f&promo=$id_p&semaine=".$sf_request->getParameter('semaine')) ?></li>
  <?php endforeach ?>
                </ul>
              </li>
<?php endforeach ?>
            </ul>
          </div>
          
          <div id="pub" style="text-align:justify; font-size:80%">
            <p>Tu veux changer de semaine avec ton <b>clavier</b>&nbsp;?<br/>
            Tu souhaites avoir ton emploi du temps sur <b>Google Agenda</b> ou un logiciel similaire&nbsp;?<br/>
            Tout est expliqué sur la <?php echo link_to('FAQ', '@faq', 'style="padding:0"') ?>&nbsp;!
            </p>
          </div>
          <div id="liens-internes">
            <b>Liens utiles</b>
            <ul>
              <li><?php echo link_to('iariss.fr', 'http://www.iariss.fr/') ?></li>
              <li><?php echo link_to('Annales', 'http://annales.iariss.fr/') ?></li>
              <li><?php echo link_to('Trombinoscope', 'http://trombi.iariss.fr/') ?></li>
<!--               <li><?php echo link_to('BDE ENSISA', 'http://www.ensisa.info/') ?></li> -->
              <li><?php echo link_to('emploisdutemps.uha.fr', 
              'https://www.emploisdutemps.uha.fr/') ?></li>
            </ul>
          </div>
        </div>
     
      </div>

      <div id="pied">
        <p>
          Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr/') ?>
          - <a href="mailto:contact@iariss.fr">Contact</a>
          - <?php echo link_to('FAQ', '@faq') ?>
          - <span id="status"></span>
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
