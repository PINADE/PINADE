<?php include_partial('title', array('erreur' => "Foire aux questions")) ?>

<h1><?php include_slot('title') ?></h1>

<h2 id="fiable">Est-ce le site de référence ?</h2>
<p><b>Non, ce site n'est pas le site officiel de l'emploi du temps</b> de l'<?php echo link_to('ENSISA','http://www.ensisa.fr/') ?>.
Le site officiel est <?php echo link_to('emploisdutemps.uha.fr', 'https://emploisdutemps.uha.fr/') ?> et reste la référence de votre emploi du temps.<br/>
Cependant, si tout va bien, <b>edt.iariss.fr</b> met à jour régulièrement (<i>cf</i> section <a href="#delai"><b>Délai</b></a>) les emplois du temps.</p>

<span style="color:red; float:left; padding:3px;">nouveau ! </span>
<h2 id="raccourcis">Quels sont les raccourcis claviers sur le site ?</h2>
<p>Deux raccourcis claviers ont été mis en place pour faciliter la navigation sur <b>edt.iariss.fr</b> :
<ul>
  <li>La touche «&nbsp;flèche gauche&nbsp;» pour aller vers la semaine précédente,</li>
  <li>La touche «&nbsp;flèche droite&nbsp;» pour aller vers la semaine suivante.</li>
</ul>
Il n'y a pas d'autres raccourcis actuellement, mais contactez nous si vous en voulez plus !<br/></p>

<h2 id="origine">Qui est à l'origine de ce site ?</h2>
<p>L'équipe de <?php echo link_to('IARISS', 'http://www.iariss.fr/') ?> a codé ce site pour vous,
parce qu'elle trouvait que le site proposé par l'UHA, <?php echo link_to('emploisdutemps.uha.fr', 'https://emploisdutemps.uha.fr/') ?>, 
n'est pas du tout pratique.<br/>
Les auteurs initiaux sont <b>Michaël Muré</b> et <b>Thépophile Helleboid</b>, mais nous en attendons d'autres. Venez nous rejoindre&nbsp;!</p>

<h2 id="contact">Je veux contacter les auteurs, à qui m'adresser ?</h2>
<p>Envoyez un mail à <b><code>contact@iariss.fr</code></b>, c'est l'adresse unique pour contacter les auteurs.<br/></p>

<h2 id="delai">Quel est le délai de mise à jour des emplois du temps ?</h2>
<p>Les emplois du temps sont mis à jour très régulièrement&nbsp;:
<b>toutes les deux heures</b> pour les semaines courante et suivante, toutes les six heures pour les autres.
 Si vous trouvez que ce délai n'est pas adapté, <a href="#contact">contactez-nous</a>.</p>

<span style="color:red; float:left; padding:3px;">nouveau ! </span>
<h2 id="ical">Où trouver le calendrier <i>iCal</i> de mon emploi du temps ?</h2>
L'adresse est simple : <code>http://edt.iariss.fr/ical/<i>&lt;votre filière&gt;</i>/<i>&lt;votre promo&gt;</i>/ical.ics</code></br/>
Par exemple, pour les 2A Informatique : <code><a href="http://edt.iariss.fr/ical/info/2a/ical.ics">http://edt.iariss.fr/ical/info/2a/ical.ics</a></code>.<br/>
Le calendrier est mis à jour une fois par jour, vers 4h du matin. Il reprend tous les cours disponibles de toute l'année.
<p><b>Attention</b> : cette fonctionnalité n'est pas correctement implémentée (et ne le sera sans doute jamais) et plusieurs bugs existent.
Par exemple, ce calendrier n'indique pas si certains cours ont été supprimés ou remplacés.<br/>
Si un cours est supprimé, il le sera dans le calendier iCal, mais il est possible qu'il apparaisse toujours dans votre calendrier local. Soyez attentif !
</p>

<h2 id="fonctionnement">Comment fonctionne votre site ?</h2>
<p>Ce site a été développé avec le framework PHP <?php echo link_to('Symfony', 'http://www.symfony-project.org/') ?>.
Il se connecte à ADE Expert, logiciel utilisé pour les emplois du temps de l'UHA, et télécharge les images des emplois du temps pour les garder sur notre serveur (chaque heure actuellement).
Le logiciel reproduit votre navigation, longue et un peu complexe, et peut récupérer les informations pour vous.<br/>
Si vous souhaitez connaître le fonctionnement exact, <a href="#contact">contactez-nous</a>, et reportez vous à la section <a href="#sources">Où sont les sources&nbsp;?</a></p>

<h2 id="fonctionnalite">Je voudrais avoir telle fonctionnalité, c'est possible ?</h2>
<p>Bien sûr, tout est possible avec l'informatique !<br/>
Nous avons déjà quelques idées à implémenter, mais il est probable que nous ne soyons pas au courant de la votre.
Proposez-la nous en nous contactant (<code>contact@iariss.fr</code>), nous ferons notre possible pour qu'elle soit mise en place rapidement.<br/>
Vous savez programmer en PHP ? Et encore mieux, avec Symfony ?<br/>
Alors votre profil nous intéresse ! <a href="#contact">Contactez-nous</a> très rapidement, vous avez probablement votre place à IARISS !</p>

<h2 id="sources">Où sont les sources de votre logiciel ?</h2>
<p>Notre logiciel n'est pas (encore) un Logiciel Libre. L'ouverture des sources d'un tel logiciel ne nous apparaît pas comme prioritaire,
mais exprimez votre demande : il y a de grande chance que nous publierons les sources.</p>

