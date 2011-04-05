          <?php include_partial('edt/title', array('filiere' => $filiere, 'promotion' => $promotion)) ?>


          <h1 id="title"><?php include_slot('title') ?></h1>

          <h2 id="semaine">
            Semaine du <b><?php echo strftime("%e %B %G", $timestamp + 2*60*60) ?></b> au <b><?php echo  strftime("%e %B %G", intval($timestamp) + 5*24*60*60 - 1 ) ?></b>
          </h2>

<?php echo link_to('Créer/Éditer le message', "@notice?action=edit&filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=".$semaine, 'style="font-weight:bold"') ?>

<?php if($notice): ?>
            <div id="notice"><?php echo nl2br(html_entity_decode($notice)) ?></div>
<?php endif ?>
          <p class="center">
            <?php echo link_to(image_tag('divers/precedent.png', 'alt="<<"'),
              "@notice?action=show&filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=$semaine_precedente") ?>

            <?php echo link_to('semaine actuelle', "@notice?action=show&filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=".AdeTools::getSemaineNumber()) ?>

            <?php echo link_to(image_tag('divers/suivant.png', 'alt=">>"'), "@notice?action=show&filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=$semaine_suivante") ?>

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
              document.location = '<?php echo url_for("@notice?action=show&filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=".max(0,$semaine-1)) ?>';
            }
            else if(e.which == 39)
            {
              document.location = '<?php echo url_for("@notice?action=show&filiere=".$filiere->getUrl()."&promo=".$promotion->getUrl()."&semaine=".max(0,$semaine+1)) ?>';
            }
          }
          </script>
<br/>
