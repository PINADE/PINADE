          <?php include_partial('title', array('filiere' => $filiere, 'promotion' => $promotion)) ?>


          <h1 id="title"><?php include_slot('title') ?></h1>

          <h2 id="semaine">
            Semaine du <b><?php echo strftime("%e %B %G", $timestamp + 2*60*60) ?></b> au <b><?php echo  strftime("%e %B %G", intval($timestamp) + 5*24*60*60 - 1 ) ?></b>
          </h2>

<?php if($notice): ?>
            <div id="notice"><?php echo nl2br(html_entity_decode($notice)) ?></div>
<?php endif ?>

          <p class="center">
            <?php echo link_to(image_tag('divers/precedent.png', 'alt="<<"'),
              "@image?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=$semaine_precedente") ?>

            <?php echo link_to('semaine actuelle', "@image?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=") ?>

            <?php echo link_to(image_tag('divers/suivant.png', 'alt=">>"'), "@image?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=$semaine_suivante") ?>

          </p>

<?php if(file_exists($image_path)):
        if($diff_day > 1):
?>
              <div id="error">
                Attention, cet emploi du temps a plus de <?php echo floor($diff_day)." jour".(($diff_day >= 2) ? "s" : "") ?>.
                <?php echo link_to("Actualisez la page", "@image?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=$semaine") ?> et 
                <?php echo link_to('contactez-nous', '@faq#contact') ?> si cela ne débloque pas cette situation.<br/><br/>
              </div>
  <?php endif ?>
          <img src='<?php echo url_for("@image_img?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=$semaine") ?>/img.gif' alt='emploi du temps <?php echo $filiere." ".$promotion ?>'/>
<?php else: ?>
          <p>Pas d'emploi du temps cette semaine.</p>
<?php endif ?>


          <!-- raccourci clavier gauche/droite -->
          <script type="text/javascript">
          document.onkeydown=function(e){
            //Internet Explorer ne prend pas d'objet Event en paramètre, il faut donc aller le chercher dans l'objet window 
            if (typeof event == "undefined" ) e = window.event;

            if(e.which == 37)
            {
              document.location = '<?php echo url_for("@image?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=".max(0,$semaine-1)) ?>';
            }
            else if(e.which == 39)
            {
              document.location = '<?php echo url_for("@image?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=".max(0,$semaine+1)) ?>';
            }
          }
          </script>
<br/>
<?php if($sf_request->getCookie('default') == $filiere->getUrl().'-'.$promotion->getUrl()): ?>
          <form method="post" action="<?php echo url_for('@cookie_reset') ?>">
          <input type="submit" value="Effacer cette page comme page d'accueil" class="button" />
          <input type="hidden" name="key" value="default" />
<?php else: ?>
          <form method="post" action="<?php echo url_for('@cookie_set') ?>">
          <input type="submit" value="Enregistrer cette page comme page d'accueil" class="button" />
          <input type="hidden" name="key" value="default" />
          <input type="hidden" name="value" value="<?php echo $filiere->getUrl().'-'.$promotion->getUrl() ?>" />

<?php endif ?>
          </form>

<br/>
<?php echo link_to("Ajouter à Google Agenda", "http://www.google.com/calendar/render?cid=".urlencode(url_for("@ical?filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl(), true))) ?>
