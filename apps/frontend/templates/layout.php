<!DOCTYPE html>
<html lang="fr" <?php
  echo ($sf_request->getCookie("offline") == "enabled" && $sf_request->getParameter('module') == 'edt') ?
    'manifest="'.url_for('@manifest?filiere='.$sf_request->getParameter('filiere').
    '&promo='.$sf_request->getParameter('promo').
    '&semaine='.$sf_request->getParameter('semaine', AdeTools::getSemaineNumber())).'" >'
 : '>' ?>

  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php include_slot('title') ?> - Emploi du temps ENSISA</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_partial('global/perso-css') ?>
    <link rel="stylesheet" href="/css/mobile.css" type="text/css" media="handheld, only screen and (max-device-width: 480px)" />
    <?php include_javascripts() ?>
    <?php if($sf_request->getCookie("offline") == "enabled")
            echo javascript_include_tag('offline.js');    ?>

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
<?php $filieres = Doctrine_Core::getTable('Filiere')
      ->createQuery('f')
      ->execute();
?>
<?php foreach($filieres as $filiere): ?>
              <li><?php echo image_tag("logos/".$filiere->getLogo(), "alt='logo ".$filiere."'") ?><?php echo $filiere ?>

                <ul>
  <?php foreach($filiere->getPromotions() as $promo): ?>
                <li><?php echo link_to($promo, "@image?filiere=".$filiere->getUrl()."&promo=".$promo->getUrl()."&semaine=".$sf_request->getParameter('semaine')) ?></li>
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
        <?php if(count($stylesheets = sfConfig::get('sf_css'))): ?>
        <div id="stylesheet">
          <form method="post" action="<?php echo url_for('@cookie_set') ?>">
            Changez l'affichage de l'emploi du temps !<br/>
            <input type="hidden" name="key" value="css" />
            <select name="value">
              <option value="">Par défaut</option>
            <?php foreach($stylesheets as $id_css => $css): ?>
              <option value="<?php echo $id_css ?>"
                <?php echo ($sf_request->getCookie('css') == $id_css) ? " selected='selected' " : "" ?>
                ><?php echo $css['title'] ?></option>
            <?php endforeach ?>
            </select><br/>
            <input type="submit" value="Enregistrer ce style" />
          </form>
        </div>
        <?php endif ?>
      </div>

      <div id="pied">
        <p>
          Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr/') ?>,
            code source du projet <acronym title="PINADE Is Not ADE"><?php echo link_to('PINADE', 'https://github.com/PINADE/PINADE') ?></acronym> sur <?php echo link_to('GitHub', 'https://github.com/ ') ?>
          - <a href="mailto:contact@iariss.fr">Contact</a>
          - <?php echo link_to('FAQ', '@faq') ?>
          - <span id="status"></span>
        </p>
      </div>
    </div>

  </body>
</html>
