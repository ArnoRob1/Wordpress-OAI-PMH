# Wordpress OAI PMH Plugin

Repo de développement d'un plugin Wordpress OAI-PMH

Fonctionnement global du Plugin.

à l'activation du Plugin, on créé une rewrite rule qui permet de gérer les url de type :

www.urldusite.fr/oai/?verb=....

Cette rewrite rule renvoie (comme toutes les rewrite rules WP) vers index.php, avec le paramètre wpoaipmh=true :

index.php?wpoaipmh=true&verb=...


Ensuite, on ajoute un filtre au moment du choix du template à appliquer ('template_include').

S'il s'agit d'une requête OAIPMH (wpoaipmh=true), on affiche notre template et on gère la requête....

