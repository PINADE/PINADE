          <?php include_partial('title', array('nom_filiere' => $nom_filiere, 'nom_promo' => $nom_promo)) ?>


          <h1 id="title"><?php include_slot('title') ?></h1>

          <h2 id="semaine">
            Semaine du <b><?php echo strftime("%e %B %G", $timestamp + 2*60*60) ?></b> au <b><?php echo  strftime("%e %B %G", intval($timestamp) + 5*24*60*60 - 1 ) ?></b>
          </h2>

<?php if(! empty($notice)): ?>
            <div id="notice"><?php echo nl2br(html_entity_decode($notice)) ?></div>
<?php endif ?>

          <p class="center">
            <?php echo link_to(image_tag('divers/precedent.png', 'alt="<<"'), "@image?filiere=$filiere&promo=$promo&semaine=$semaine_precedente") ?>

            <?php echo link_to('semaine actuelle', "@image?filiere=$filiere&promo=$promo&semaine=") ?>

            <?php echo link_to(image_tag('divers/suivant.png', 'alt=">>"'), "@image?filiere=$filiere&promo=$promo&semaine=$semaine_suivante") ?>

          </p>

<?php if(file_exists($image_path)): ?>
  <?php if($diff_day > 1): ?>
              <div id="error">
                Attention, cet emploi du temps a plus de <?php echo floor($diff_day)." jour".(($diff_day >= 2) ? "s" : "") ?>.
                <?php echo link_to("Actualisez la page", "@image?filiere=$filiere&promo=$promo&semaine=$semaine") ?> et 
                <?php echo link_to('contactez-nous', '@faq#contact') ?> si cela ne débloque pas cette situation.<br/><br/>
              </div>
  <?php endif ?>

          <img src='<?php echo url_for("@image_img?filiere=$filiere&promo=$promo&semaine=$semaine") ?>/img.gif' alt='emploi du temps <?php echo $filiere." ".$promo ?>'/>
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
              document.location = '<?php echo url_for("@image?filiere=$filiere&promo=$promo&semaine=".max(0,$semaine-1)) ?>';
            }
            else if(e.which == 39)
            {
              document.location = '<?php echo url_for("@image?filiere=$filiere&promo=$promo&semaine=".max(0,$semaine+1)) ?>';
            }
          }
          </script>
<br/>
<?php if($sf_request->getCookie('default') == $filiere.'-'.$promo): ?>
          <?php echo link_to('Effacer cette page comme page d\'accueil', "@cookie_reset?key=default") ?>
<?php else: ?>
          <?php echo link_to('Enregistrer cette page comme page d\'accueil', "@cookie_set?key=default&value=$filiere-$promo") ?>
<?php endif ?>
<br/>
<?php echo link_to("Ajouter à Google Agenda", "http://www.google.com/calendar/render?cid=".urlencode(url_for("@ical?promo=$promo&filiere=$filiere", true))) ?>
