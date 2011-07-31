<?php

class updateLyon1InfoIdentifierTask extends updateLyon1IdentifierTask
{
  protected function configure()
  {
    $this->nom_edt = "lyon1-info";
    parent::configure();
  }
}
