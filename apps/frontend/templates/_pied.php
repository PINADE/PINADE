      <div id="pied">
        <p>
           <b><?php echo $_SERVER['SERVER_NAME'] ?></b> vous est livré grâce à <abbr title="PINADE Is Not ADE"><a href="http://www.pinade.org/">PINADE</a></abbr>,
          son <?php echo link_to('code source', 'https://github.com/PINADE/PINADE') ?> est Libre.<br/>
          <a href="mailto:contact-(at)-pinade.org">Contact</a>
          - <?php echo link_to('FAQ', 'http://www.pinade.org/pages/Foire-Aux-Questions') ?>
<!--           - <span id="status"></span> -->
        </p>
        <div class="social">Vous aimez <?php echo $_SERVER['SERVER_NAME'] ?>&nbsp;? Dites le !  
          <div class="social-button"><div class="g-plusone" data-size="medium" data-count="true" data-href="<?php echo url_for("@homepage", true) ?>"></div></div>
          <div class="social-button"><iframe src="http://www.facebook.com/plugins/like.php?app_id=198451846877677&amp;href=<?php echo urlencode(url_for("@homepage", true)) ?>&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;action=like&amp;colorscheme=dark&amp;font=verdana&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true" style="vertical-align:middle"></iframe></div>
        </div>
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
    <script type="text/javascript">
      window.___gcfg = {
        lang: 'fr'
      };
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
