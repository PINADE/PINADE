<?php include_partial('title', array('erreur' => "Foire aux questions")) ?>

<h1>
  <?php include_slot('title') ?>
</h1>

<h2>Qui est à l'origine de ce site ?</h2>
L'équipe de <?php echo link_to('IARISS', 'http://www.iariss.fr/') ?> a codé ce site pour vous,
parce qu'elle trouvait que le site proposé par l'UHA, <?php echo link_to('emploidutemps.uha.fr', 'http://emploidutemps.uha.fr/') ?>, 
n'est pas du tout pratique.<br/>
Les auteurs initiaux sont Michaël Muré et Thépophile Helleboid, mais nous en attendons d'autres. Venez nous rejoindre !

<h2>Je veux contacter les auteurs, à qui m'adresser ?</h2>
Envoyez un mail à <code>contact@iariss.fr</code>, c'est l'adresse unique pour contacter les auteurs.<br/>

<h2>Quel est le délai de mise à jour des emplois du temps ?</h2>
Les emplois du temps sont mis à jour toutes les heures. Si vous trouvez que ce délai n'est pas adapté, contactez-nous.

<h2>Comment fonctionne votre site ?</h2>
Ce site a été développé avec le framework PHP <?php echo link_to('Symfony', 'http://www.symfony-project.org/') ?>.
Il se connecte à ADE Expert, logiciel utilisé pour les emplois du temps de l'UHA, et télécharge les images des emplois du temps pour les garder sur notre serveur (1h actuellement).
Le logiciel reproduit votre navigation, longue et un peu complexe, et peut récupérer les informations pour vous.<br/>
Si vous souhaitez connaître le fonctionnement exact, contactez-nous, et reportez vous à la section <b>Où sont les sources ?</b>

<h2>Je voudrais avoir telle fonctionnalité, c'est possible ?</h2>
Bien sûr, tout est possible avec l'informatique !<br/>
Nous avons déjà quelques idées à implémenter, mais il est probable que nous ne soyons pas au courant de la votre.
Proposez-la nous en nous contactant (<code>contact@iariss.fr</code>), nous ferons notre possible pour qu'elle soit mise en place rapidement.<br/>
Vous savez programmer en PHP ? Et encore mieux, avec Symfony ?<br/>
Alors votre profil nous intéresse ! Contactez-nous très rapidement, et vous pourrez programmer directement pour améliorer les emplois du temps !

<h2>Où sont les sources de votre logiciel ?</h2>
Notre logiciel n'est pas (encore) un Logiciel Libre. L'ouverture des sources d'un tel logiciel ne nous apparaît pas comme prioritaire,
maix exprimez votre demande : il y a de grande chance que nous publierons les sources.

