      <div id="pied">
        <p>
          Emploi du temps réalisé par <?php echo link_to('IARISS', 'http://iariss.fr/') ?>.
           <b><?php echo $_SERVER['SERVER_NAME'] ?></b> vous est livré grâce à <acronym title="PINADE Is Not ADE"><?php echo link_to('PINADE', 'https://github.com/PINADE/PINADE') ?></acronym>.
          - <a href="mailto:contact@iariss.fr">Contact</a>
          - <?php echo link_to('FAQ', '@page?url=faq') ?>
          - <span id="status"></span>
        </p>
      </div>

    <?php if(($url = sfConfig::get('app_piwik_url')) && ($code = sfConfig::get('app_piwik_code'))): ?>
    <!-- Piwik --> 
    <script type="text/javascript"> 
    var pkBaseURL = (("https:" == document.location.protocol) ? "https://<?php echo $url ?>/" : "http://<?php echo $url ?>/");
    document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
    </script><script type="text/javascript"> 
    try {
    var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", <?php echo $code ?>);
    piwikTracker.trackPageView();
    piwikTracker.enableLinkTracking();
    } catch( err ) {}
    </script><noscript><p><img src="http://<?php echo $url ?>/piwik.php?idsite=<?php echo $code ?>" style="border:0" alt="" /></p></noscript> 
    <!-- End Piwik Tracking Code --> 
    <?php endif ?>
