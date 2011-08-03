<?php if(defined('NOM_EDT')): ?>
User-agent: *
Disallow: /cookie/
Disallow: /cron/

Sitemap: <?php echo url_for('@sitemap', true) ?>


<?php else: ?>
User-agent: *
Disallow: /
<?php endif ?>
