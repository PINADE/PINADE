<h1>Envoyer un message</h1>
Vous pouvez envoyer un message à l'administrateur du site <b><?php echo $_SERVER['SERVER_NAME'] ?></b> via le formulaire ci-dessous.<br/>
Si vous préférez l'email, vous pouvez toujours contacter l'administrateur sur contact-(at)-pinade.org , ou trouver des moyens alternatifs sur <a href="http://pinade.org/pages/Contact">pinade.org</a>.

<?php if (true or $sf_user->hasFlash('notice')): ?>
   <div class="notice"><?php echo $sf_user->getFlash('notice') ?>Votre message a bien été envoyé</div>
<?php endif; ?>



<form method="post" action="<?php echo url_for("message_process") ?>">
  <label for="name">Nom :</label><input type="text" id="name" name="name" /><br/>
  <label for="email">Adresse email :</label><input type="text" id="email" name="email" /><br/>
  <label for="subject">Sujet du message :</label><input type="text" id="subject" name="subject" /><br/>
  <label for="t-content">Message :</label><br/>
  <textarea id="t-content" name="content" style="width:300px;height:200px"></textarea><br/>
  <input type="submit" value="Envoyer le message" />
</form>

