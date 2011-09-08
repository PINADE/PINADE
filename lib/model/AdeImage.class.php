<?php

/**
 * edt tools.
 *
 * @package    tools
 * @subpackage AdeImage
 * @author     T. Helleboid <t.helleboid@iariss.fr>, M.Muré <m.mure@iariss.fr>
 */
class AdeImage
{

  protected
    $promotion,
    $edt,
    $ade_cookie,
    $projectId,
    $semaine,
    $ade_browser,
    $error = "";

  public function __construct(Promotion $promotion, $semaine)
  {
    $this->promotion = $promotion;
    $this->edt = $promotion->getCategorie()->getEdt();
    $this->ade_browser = new AdeBrowser($this->edt->getAdeServer());

    if(strlen($this->edt->getAdeUrl()) == 0)
      throw new Exception("La catégorie ".$promotion->getCategorie()." de la promotion $promotion doit être liée à un Edt !");

    $this->semaine = $semaine;

  }
  
  public function getUrl()
  {

    return $this->edt->getAdeUrl()."imageEt?".
      "identifier=".$this->edt->getIdentifier().
      "&projectId=".$this->edt->getAdeProjectId().
      "&idPianoWeek=".$this->semaine.
      "&idPianoDay=".$this->edt->getIdPianoDay().
      "&idTree=".$this->promotion->getIdTree().
      "&width=".$this->edt->getWidth().
      "&height=".$this->edt->getHeight().
      "&lunchName=REPAS".
      "&displayMode=".$this->edt->getDisplayMode().
      "&showLoad=false".
      "&ttl=1283427991552".
      "&displayConfId=".$this->edt->getDisplayConfId();
  }


  public function updateImage($force = false, $enable_optipng = true)
  {
    $path = $this->promotion->getPath();
    // Récupération du GIF original pour comparer la date
    $filepath = $path.$this->getFilename();

    
    if(!file_exists($filepath))                 // Si le fichier n'existe pas, on met à jour
      $update = true;
    elseif(time() > filemtime($filepath) + 3*60*60) // Si le fichier a été modifié il y a plus de 3h, on met à jour
      $update = true;
    elseif(file_get_contents($filepath) == "") // Sinon, si le fichier est vide, idem
      $update = true;
    else                                      // Sinon, si on force si on décide comme ça
      $update = $force;

    if($update != true)
    {
      sfContext::getInstance()->getLogger()->info('Image déjà en cache : '.$filepath);
      $this->error = "already in cache";
      return;
    }

    // Refresh content if we have to
    $content = $this->ade_browser->getUrl($this->getUrl());

    // Create the directory if we need to
    if(!is_dir($path))
      mkdir($path, 0777, true); // enable recursion

    if(empty($content))     // Do NOT remove cache if the file is empty (there is likely a problem)
    {
      sfContext::getInstance()->getLogger()->info('Image vide lors du téléchargement ! Cache non réécrit');
      $this->error = "empty picture : ".$this->getUrl();
    }
    else
    {
      // L'image n'est pas vide, est-elle vraiment une image ?
      $tempname = tempnam($this->promotion->getPath(), "edt-");
      file_put_contents($tempname, $content);

      if (getimagesize($tempname)== false)
      {
        sfContext::getInstance()->getLogger()->info('le contenu n\'est pas une image. Pas de remplacement !');
        $this->error = "not a picture : ".$this->getUrl();
      }
      else
      { // it seems OK, we can write it

        // Retournement de l'image pour l'ENSISA
        // Désactivation 2011-08-30 @ 14h10
        if(false && defined('NOM_EDT') && NOM_EDT == "ensisa")
        {
          $source = imagecreatefromgif($tempname);
          $rotate = imagerotate($source, 180, 0);
          imagegif($rotate, $filepath);
        }
        else
        {
          // On supprime le PNG s'il existe
          $png_file = $this->promotion->getPath().$this->getPngFilename();
          if(file_exists($png_file))
            unlink($png_file);

          // Sauvegarde originale
          file_put_contents($filepath, $content);
        }
        // Optimize the gif
        if($enable_optipng && sfConfig::get('app_optimize_image', false))
        {
          $log = exec('optipng -o99 '.escapeshellarg($filepath).' -dir '.escapeshellarg(dirname($filepath)).' > /dev/null 2>/dev/null &');
        }
      }
      // Suppression du fichier temporaire
      unlink($tempname);
    }
    return (strlen($this->error) == 0);
  }


  /**
   * Renvoi le nom du fichier de l'image
   */
  public function getFilename()
  {
    return $this->semaine.'.gif';
  }

  /**
   * Retourne le nom du fichier PNG
   * Attention : il peut ne pas exister
   */
  public function getPngFilename()
  {
    return $this->semaine.'.png';
  }

  /**
   * Retourne le fichier pour l'affichage sur les pages :
   * - le fichier PNG si la feature est activée, qu'il existe et qu'il a moins de 3h
   * - le fichier GIF sinon
   */
  public function getOptimizedFilename()
  {
    $png_file = $this->promotion->getPath().$this->getPngFilename();
    if(
         sfConfig::get('app_optimize_image', false)
      && file_exists($png_file)
      && time() < filemtime($png_file) + 3*60*60
    )
      return $this->getPngFilename();
    else
      return $this->getFilename();
  }

  public function getWebPath()
  {
    return '/images/edt/'.$this->edt->getNom().'/'.$this->promotion->getId().'/'.$this->getFilename();
  }


  /**
   * Retourne le timestamp correspondant à la semaine ADE
   */
  public function getTimestamp()
  {
    return $this->edt->getStartTimestamp() + $this->semaine * (60*60*24*7);
  }


  public function getError()
  {
    return $this->error;
  }

}


