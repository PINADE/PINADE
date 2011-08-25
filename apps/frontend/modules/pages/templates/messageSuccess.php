<h1>Envoyer un message</h1>
Vous pouvez envoyer un message à l'administrateur du site <b><?php echo $_SERVER['SERVER_NAME'] ?></b> via le formulaire ci-dessous.<br/>
Si vous préférez l'email, vous pouvez toujours contacter l'administrateur sur contact-(at)-pinade.org , ou trouver des moyens alternatifs sur <a href="http://pinade.org/pages/Contact">pinade.org</a>.

<?php if (strlen($feedback)): ?>
   <div class="notice"><?php echo $feedback ?></div>
<?php endif; ?>

<br/><br/>
<form method="post" action="<?php echo url_for("message_process") ?>">
  <input type="text" id="name" name="name" />  <label for="name">Nom</label><br/>
  <input type="text" id="email" name="email" />  <label for="email">Adresse email</label><br/>
  <input type="text" id="subject" name="subject" />  <label for="subject">Sujet du message</label><br/>
  <label for="t-content">Message :</label><br/>
  <textarea id="t-content" name="content" style="width:500px;height:300px"></textarea><br/>
  <input type="submit" value="Envoyer le message" />
</form>

