<?php if(defined('NOM_EDT') && preg_match("/^(4|6)/", $_SERVER['SERVER_NAME']) == 0): ?>
User-agent: *
Disallow: /cookie/
Disallow: /cron/
Disallow: /img/

Sitemap: <?php echo url_for('@sitemap', true) ?>


<?php else: ?>
User-agent: *
Disallow: /
<?php endif ?>
