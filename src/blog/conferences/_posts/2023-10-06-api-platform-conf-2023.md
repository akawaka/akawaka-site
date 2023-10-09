---
layout: post
title: L'API Platform conférence 2023 à Lille
image: /build/front/images/blog/apip-conf-2023.png
alt: Logo API Platform conférence 2023
subtitle: Nous avons pu assister à de nombreuses conférences lors de ce API Platform conférence et nous souhaitons vous partager nos retours dans cet article.
date: 2023-10-06 16:00:00
date_modified: 2023-10-06 16:00:00
category: conferences
author: Équipe AKAWAKA
---

Lors de l'API Platform Conférence, notre équipe a eu la chance de plonger au cœur de l'univers de APIP. Cette conférence a été l'occasion de découvrir les dernières avancées, les tendances émergentes et les meilleures pratiques en matière de développement d'API. Au fil de ces journées intenses, nous avons assisté à des conférences exceptionnelles animées par des orateurs non moins exceptionnels, nous permettant ainsi de repartir avec une mine d'informations précieuses pour améliorer nos projets clients.

Dans cet article, nous souhaitons vous faire un retour de quelques conférences qui nous ont marquées.

## Keynote d'ouverture par Kévin Dunglas

L'introduction de cette API Platform se concentre sur la présentation d'une solution afin d'améliorer l'expérience de développeur PHP et Symfony.
Le monde de PHP et son architecture classique se composent d'au moins deux services, le serveur web (apache/nginx) et PHP-FPM qui vient permettre d'avoir plusieurs processus. PHP est un langage (très) rapide parmi ses concurrents malgré son fonctionnement en fire-and-forget. Lorsqu'une requête arrive, Symfony va préparer le kernel, l'injection de dépendances, lier les services ...
Autres soucis, PHP n'est pas fait pour du temps réel ou des processus de longue durée, les solutions front à ces problématiques (souvent des SSE et websocket) ne fonctionnent pas en osmose avec PHP. Les nouvelles fonctionnalités HTTP, telles que les early hints, ne sont pas supportées immédiatement.
Les early hints permettent d'avertir par une réponse 103 que certaines ressources statiques peuvent être téléchargées en avance. Les gains de perf qu'il nous remonte indiquent 60% en moyenne.
La multitude de services existants rend la Dockerisation des services plus complexes à gérer de par la multitude de solutions à déployer.
FrankenPHP qui vient combler l'intégralité de ces soucis, est un serveur web basé sur Go qui intègre caddy et mercure (deux produits en go). Caddy évolue rapidement, suit les nouveautés HTTP et bénéficie de support. Mercure permet lui du temps réel en suivant un standard très performant. FrankenPHP est livré via un binaire, il ne se compose que de lui-même et solutionne les soucis de performance grâce à un système de worker, similaire à Swoole, Roadrunner etc.
Un worker va tourner sur le long terme, conserver un Symfony initialisé et prêt à traiter les requêtes, en passant les variables globales _GET, _POST etc., puis en rendant la réponse.
Le facteur d'amélioration est mesuré à x3 sur une démo de Symfony, le gain étant plus important si l'application utilise beaucoup d'injection.

Son usage est simplifié au sein de Symfony grâce à Symfony Runtime, un adapteur est déjà disponible. Depuis la conférence, l'usage est d'autant plus simple puisqu'une simple commande Docker permet de lancer un projet PHP (https://twitter.com/dunglas/status/1709268078205272220).
Let's encrypt est aussi intégré et permet d'obtenir un certificat SSL autorenouvelé.
Puisque ce service fonctionne seul, docker compose n'est pas nécessaire (si l'on n’a pas besoin d'une base de données). Disponibles en PHP 8.2 pour l'instant, toutes les extensions PHP (presque) sont disponibles dans un Dockerfile.
Il existait au moment de la conférence trois soucis (https://github.com/dunglas/frankenphp/blob/main/docs/known-issues.md), les fibers qui nécessitent une modification d'usage, l'extension native imap ne sont pas compatibles et Doctrine ne fonctionne pas correctement sur le long terme dans les projets FrakenPHP, Swoole, Roadrunner... (https://github.com/symfony/symfony/issues/51661)
Tout juste sortie d'alpha, FrakenPHP est désormais sortie en version stable via sa première beta et il respecte des BC semver. Déjà utilisés en production, nous sommes impatients de l'essayer afin de délivrer des applis toujours plus performantes.

## API platform Opendata et schemaless par Xavier Leune

Nous vivons en France l'expansion de l'open data, d'abord initiée par la ville de Rennes, Paris a suivi avant que l'état généralise cette mouvance.
CCMbenchmark a créé une plateforme basée sur l'open data, elle se veut transparente, honnête et avec une volonté de partage.
Plusieurs médias composent CCM et sur de multiples thématiques (Le journal des femmes, JDN, droit finances.net, l'intern@ute).
Leur projet s'est basé API platform avec MariaDB, la donnée qu'ils traitent est gigantesque et l'ingestion ces dernières est le sujet qui leur demande le plus de travail. Ils ont développé pour leur besoin un ETL en PHP déployé sur 35 machines, il ingère la donnée depuis une solution de stockage maison avant de l'injecter dans MariaDB. Leurs clients (web) qui consomment la donnée vont alors chercher la donnée au sein de ces bases de données.
Leur solution de stockage contenait 600 millions de lignes et MariaDB porte 580GO de données. Lors d'événements publics (type résultat des élections, brevet, bac) des pics sont constatés, en moyenne 60 millions de pages vues.
Les données qui passent dans l'ETL sortent en XML, dans un format exploitable directement. Afin d'être flexibles dans leur stockage, ils implémentent le pattern EAV, une table est une entité, l'autre est la valeur associée à cette entité.
L'inconvénient majeur de cette solution est l'usage de jointures, les optimisations du SGBD sont donc faibles.
Ces données peuvent aussi évoluer, par exemple la popularité des prénoms est basée sur la somme de valeurs dans une plage donnée. Le calcul se fait lors de l'ingestion, le traitement prend environ 36 heures. Lors des élections, bien que les résultats soient disponibles immédiatement, les statiques sont calculées en même temps.

Leurs objectifs sont les suivants :

- Une ingestion rapide
- Un modèle scalable et performant
- Plus de duplication de données
- 0 développement lors de nouvelles données

Cette conférence très intéressante et hors norme nous montrera comment ils ont fait pour atteindre leurs objectifs tout en respectant les standards d'API Platform.

## Developing an API without API Platform - Alexandre Salomé

Alexandre, à travers son retour d'expérience, veut nous rappeler comment on pouvait faire des API à l'époque où API Platform n'était pas encore la référence d'aujourd'hui. Il y a 4 ans, lorsqu'il fait sa veille technique pour son projet d'API, il a le souhait d'avoir également une documentation de cette API pour simplifier ses intégrations.
Pour la documentation, il se tourne sur l'utilisation de Swagger Editor. Pour l'implémentation de l'API, il teste API Platform, crée les modèles de son API et bien vite, se confronte au premier problème :
Au lieu d'avoir des identifiants numériques, il obtient des IRI, ce qui bloque beaucoup l'intégration de leur API, en effet, c'était assez déroutant il y a 4 ans de ne pas pouvoir utiliser des identifiants pour requêter une API. Autre problème, il doit écrire beaucoup de code pour écrire la documentation qui sera générée par APIP.

Au final, il abandonne l'utilisation d'APIP et préfère une implémentation plus pragmatique.

Pour la documentation il utilise `NelmioApiDocBundle` et ajoute des commentaires dans ses contrôleurs pour alimenter la documentation. Il se retrouve assez vite avec beaucoup de logique similaire dans ses contrôleurs : de la désérialisation de données JSON, de la validation de ces données, puis le renvoi de la réponse avec de la sérialisation.

Ainsi il refond son code tel que:
- Il crée un `ViewListener` pour encapsuler la sérialisation de la réponse. Il peut donc juste renvoyer la donnée depuis le contrôleur, l'écouteur faisait la création de la réponse Symfony.
- Il déplace les données de la requête dans un DTO. Il crée un `ModelResolver` permettant de désérialiser la donnée, dans le but d'avoir un objet exploitable dans son contrôleur.
- Il gère les diverses erreurs de validation pour fournir une réponse avec un bon code HTTP via un `ValidateListener` qui vient écouter les erreurs type de Symfony pour réécrire le statut de la réponse et également le format des erreurs pour une intégration plus facile pour les fronts.
- Il ajoute un écouteur CORS, qu'il préfère à l'utilisation de `NelmioCorsBundle`, toujours dans une idée d'être pragmatique, leur besoin était extrêmement simple.


En avançant comme ceci, il se retrouve avec une version 0.1 qu'il faudra bien vite améliorer les mois suivants, en ajoutant :
- La création d'un manuel utilisateur avec des instructions générales de comment s'authentifier, les fonctionnalités de chaque route (en plus du Swagger), etc.
- La création d'un SDK Javascript pour l'utilisation de l'API
- La création d'une API d'administration
- Etc ...


Au bout de 4 ans, le bilan devient vite mitigé sur leurs choix initiaux de ne pas utiliser APIP. Leur API se retrouve bloquée avec l'incapacité de gérer plusieurs autres formats que JSON. Il y a une difficulté d'ajouter des fonctionnalités compliquées, autre que du simple CRUD. Et pratiquement pas d'outillage standard obligeant à développer des outils à la main.
Alexandre conclut qu'aujourd'hui, il ne referait plus le même choix et n'hésiterait pas à utiliser API Platform car c'est une solution permettant le multiformat, la pagination, un SDK JavaScript, etc. et c'est un meilleur choix que de tout refaire à la main
C'est aussi s'ouvrir à l'ajout de nouvelles fonctionnalités qui peuvent être utiles comme Mercure pour du temps réel, Vulcan etc.

## Subresources, the easy way par Mathias Arlaud

Mathias a décidé de nous parler de la coupe du monde de rugby pour illustrer sa conférence. À travers plusieurs exemples habilement trouvés, il nous explique ce que sont les Subresources d'API Platform et quand les utiliser.
On apprend que les Subresources ont bien évolué avec la version 3 d'API Platform. Anciennement elles ne pouvaient être utilisées qu'en lecture seule, alors qu'aujourd'hui on peut leur appliquer des opérations de modification, suppression, etc.
En plus de ça, Mathias nous explique comment bien configurer nos Subresources pour éviter les soucis d'over-fetching.

## Remplacer une base de données par une API sans toucher l’existant, Mission impossible ? par Smaïne Milianni

Pendant sa conférence, Smaïne nous explique comment il a dû remplacer une base de données par une API dans un projet e-commerce.
Au programme : de l'écriture d'informations dans plusieurs bases de données, des problèmes de synchronisation à gérer, et surtout une application qui fonctionne encore quelques années après une migration progressive toujours en cours.
Tant d'aventures racontées avec une belle touche d'humour.

## Une histoire d'épouvante qui finit bien : récit d'une migration d'une API custom vers API Platform 2.x puis 3 - Bastien Jaillot

Bastien nous explique comment il a vécu les mises à jour d’API Platform vers la version 3. Après avoir corrigé toutes les erreurs, les plus évidentes induisent par des erreurs de codages via l'outil Blackfire, il explique comment chaque montée de version de APIP arrive avec son lot de problèmes qui ont joué sur les performances de leur application.

Il détaille précisément chaque problème rencontré et comment il les a corrigés, tout en améliorant le projet APIP en contribuant pour tous et pour leur application.

Si au début il critique l'aspect très figé de APIP dans ses premières versions, il finit par saluer les ajouts permettant plus de personnalisation avec les Provider et Processor.

Il conclut en disant que sans tests fonctionnels, il n'aurait pas pu faire ces migrations et également que c'est en contribuant au projet APIP qu'on permet à d'autres d'éviter tous ces déboires.
