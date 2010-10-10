<?php include_partial('title', array('erreur' => "Foire aux questions")) ?>

<h1><?php include_slot('title') ?></h1>

<h2 id="fiable">Est-ce le site de référence ?</h2>
<b>Non, ce site n'est pas le site officiel de l'emploi du temps</b> de l'<?php echo link_to('ENSISA','http://www.ensisa.fr/') ?>.
Le site officiel est <?php echo link_to('emploidutemps.uha.fr', 'http://emploidutemps.uha.fr/') ?> et reste la référence de votre emploi du temps.<br/>
Cependant, si tout va bien, <b>edt.iariss.fr</b> met à jour régulièrement (<i>cf</i> section <a href="#delai"><b>Délai</b></a>) les emplois du temps.

<h2 id="origine">Qui est à l'origine de ce site ?</h2>
L'équipe de <?php echo link_to('IARISS', 'http://www.iariss.fr/') ?> a codé ce site pour vous,
parce qu'elle trouvait que le site proposé par l'UHA, <?php echo link_to('emploidutemps.uha.fr', 'http://emploidutemps.uha.fr/') ?>, 
n'est pas du tout pratique.<br/>
Les auteurs initiaux sont <b>Michaël Muré</b> et <b>Thépophile Helleboid</b>, mais nous en attendons d'autres. Venez nous rejoindre&nbsp;!

<h2 id="contact">Je veux contacter les auteurs, à qui m'adresser ?</h2>
Envoyez un mail à <b><code>contact@iariss.fr</code></b>, c'est l'adresse unique pour contacter les auteurs.<br/>

<h2 id="delai">Quel est le délai de mise à jour des emplois du temps ?</h2>
Les emplois du temps sont mis à jour très régulièrement&nbsp;:
<b>toutes les deux heures</b> pour les semaines courante et suivante, toutes les trois heures pour les autres.
 Si vous trouvez que ce délai n'est pas adapté, <a href="#contact">contactez-nous</a>.

<h2 id="fonctionnement">Comment fonctionne votre site ?</h2>
Ce site a été développé avec le framework PHP <?php echo link_to('Symfony', 'http://www.symfony-project.org/') ?>.
Il se connecte à ADE Expert, logiciel utilisé pour les emplois du temps de l'UHA, et télécharge les images des emplois du temps pour les garder sur notre serveur (chaque heure actuellement).
Le logiciel reproduit votre navigation, longue et un peu complexe, et peut récupérer les informations pour vous.<br/>
Si vous souhaitez connaître le fonctionnement exact, <a href="#contact">contactez-nous</a>, et reportez vous à la section <a href="#sources">Où sont les sources&nbsp;?</a>

<h2 id="fonctionnalite">Je voudrais avoir telle fonctionnalité, c'est possible ?</h2>
Bien sûr, tout est possible avec l'informatique !<br/>
Nous avons déjà quelques idées à implémenter, mais il est probable que nous ne soyons pas au courant de la votre.
Proposez-la nous en nous contactant (<code>contact@iariss.fr</code>), nous ferons notre possible pour qu'elle soit mise en place rapidement.<br/>
Vous savez programmer en PHP ? Et encore mieux, avec Symfony ?<br/>
Alors votre profil nous intéresse ! <a href="#contact">Contactez-nous</a> très rapidement, vous avez probablement votre place à IARISS !

<h2 id="sources">Où sont les sources de votre logiciel ?</h2>
Notre logiciel n'est pas (encore) un Logiciel Libre. L'ouverture des sources d'un tel logiciel ne nous apparaît pas comme prioritaire,
mais exprimez votre demande : il y a de grande chance que nous publierons les sources.

