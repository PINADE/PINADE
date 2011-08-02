<?php

class updateIstilMamIdentifierTask extends updateLyon1IdentifierTask
{
  protected function configure()
  {
    $this->nom_edt = "istil-mam";
    parent::configure();
  }
}
