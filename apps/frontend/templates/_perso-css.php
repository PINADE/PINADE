<?php if(preg_match("/[a-zA-Z\-_]+/i",$css =  $sf_request->getCookie('css'))): ?>
  <?php echo stylesheet_tag($css) ?>
<?php endif ?>