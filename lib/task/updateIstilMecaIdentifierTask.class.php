<?php

class updateIstilMecaIdentifierTask extends updateLyon1IdentifierTask
{
  protected function configure()
  {
    $this->nom_edt = "istil-meca";
    parent::configure();
  }
}
