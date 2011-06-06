<?php include_partial('global/title', array('erreur' => $page->getTitle())) ?>

<h1><?php include_slot('title') ?></h1>

<?php echo $page->getText(ESC_RAW) ?>