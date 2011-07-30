          <div id="menu">
            <ul>
              <li id='accueil-menu'>
                <?php echo link_to('Accueil', '@homepage', "inline") ?>

              </li>
<?php $categories = Doctrine_Core::getTable('Categorie')
      ->createQuery('c')
      ->leftJoin('c.Promotions p')
      ->andWhere('c.in_menu = 1')
      ->andWhere('p.in_menu = 1')
      ->orderBy('c.weight ASC, p.weight ASC')
      ->execute();
?>
<?php foreach($categories as $categorie): ?>
              <li><?php echo image_tag("logos/".$categorie->getLogo(), "alt='logo ".$categorie."'") ?><?php echo $categorie ?>

                <ul>
  <?php foreach($categorie->getPromotions() as $promo): ?>
                <li><?php echo link_to($promo, "@image?categorie=".$categorie->getUrl()."&promo=".$promo->getUrl()."&semaine=".$sf_request->getParameter('semaine')) ?></li>
  <?php endforeach ?>
              </ul>
              </li>
<?php endforeach ?>
            </ul>
          </div>

          <div id="pub" style="text-align:justify; font-size:80%">
            <p>Tu veux changer de semaine avec ton <b>clavier</b>&nbsp;?<br/>
              Tu souhaites avoir ton emploi du temps sur <b>Google Agenda</b> ou un logiciel similaire&nbsp;?<br/>
              Tout est expliqué sur la <?php echo link_to('FAQ', '@page?url=faq', 'style="padding:0"') ?>&nbsp;!
            </p>
          </div>
          <div>
            <p>
              <b><a href="<?php echo url_for('@myedt?action=import') ?>">Importez votre agenda&nbsp;!</a></b>
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
        <?php if(count($stylesheets = sfConfig::get('app_css'))): ?>
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

