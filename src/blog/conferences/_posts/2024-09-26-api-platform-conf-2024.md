---
layout: post
title: L'API Platform conférence 2024 à Lille
image: /build/front/images/blog/apip-conf-2023.png
alt: Logo API Platform conférence 2024
subtitle: Nous avons eu l'occasion d'assister à de nombreuses conférences durant l'API Platform Conference, et dans cet article, nous tenons à vous partager nos impressions et retours.
date: 2024-09-26 16:00:00
date_modified: 2024-09-26 16:00:00
category: conferences
author: Équipe AKAWAKA
---

Lors de l'API Platform Conference 2024, notre équipe a eu l'opportunité de plonger au cœur de l'écosystème d'API Platform. Cet événement a offert une formidable occasion de découvrir les dernières innovations, les nouvelles tendances et les meilleures pratiques dans le développement d'API. Durant ces journées riches en contenu, nous avons assisté à des présentations de grande qualité, animées par des intervenants d'exception, nous permettant de repartir avec de précieuses connaissances pour optimiser nos projets clients.

Dans cet article, nous vous proposons un retour sur certaines conférences qui nous ont particulièrement marqués.

## L'IA au service de vos projets API Platform par Matthieu Werner

Lors de la conférence, Matthieu présente un cas de développement d'un site projet pour illustrer comment l'IA peut faciliter ce processus. Il débute par un historique succinct de l'évolution de l'intelligence artificielle et souligne son adoption croissante au sein des entreprises.

Matthieu commence par interroger ChatGPT afin d'obtenir une liste de fonctionnalités pour son application. Il utilise ensuite Notion et son IA pour organiser le développement en générant un tableau Kanban et un backlog.

Pour l'architecture logicielle, il explore plusieurs outils tels que Lucidchart, GitHub Copilot et Cursor IDE. Avec Lucidchart, il crée des schémas d'architecture de l'application en utilisant l'IA. Par la suite, il génère l'aspect graphique de l'application via l'IA de Figma.

Concernant la création de l'API, Matthieu demande à ChatGPT de générer le schéma OpenAPI pour chaque fonctionnalité, puis utilise un générateur d'API à partir de ce schéma. Pour l'interface d'administration, il choisit React Admin, compatible avec API Platform.

Enfin, Matthieu présente Cursor, une alternative à Copilot, qui permet de générer du code par le biais d'un chat. Il utilise également Cursor pour créer des tests basés sur les fichiers sources, tout en recourant à des Actions GitHub intégrant de l'IA pour exécuter ces tests.

En conclusion, bien que l'IA puisse considérablement améliorer la productivité des développeurs en automatisant des tâches récurrentes et complexes, il est important de nuancer ses performances. Les systèmes d'IA peuvent parfois fournir des informations incorrectes, et tous les outils présentés sont payants, ce qui peut engendrer des coûts significatifs. De plus, le recours à de nombreux outils peut rendre la gestion du projet complexe. Il est donc essentiel de peser les avantages et les inconvénients avant de s'engager dans cette approche.

## How dev became villains par Sergès Goma

La conférence démarre par un **ice breaker** sur nos *evil laughs*. Quelques personnes se lancent et c'est parti pour la conférence.

On nous parle rapidement de l'IA qui se comporte "étrangement" : racisme, sexisme, etc. On nous demande si les développeurs sont des villains.

Plusieurs exemples nous montrent que les développeurs peuvent être utilisés à des fins malveillantes, notamment l'affaire **FTX**, **Telegram**, etc.

Il s'agit ici de se remettre en question : qui sont les **stakeholders** dans le logiciel ?

- **End users**
- **Gouvernement**
- **Organisations**
- **Clients**
- Puis ceux qui les font
- Les **3rd parties**

Nous avons une responsabilité quant à la création de logiciels ; nous avons un impact sur la société.

La conclusion s'axera sur la réflexion que nous devons avoir sur notre impact, notre responsabilité et notre éthique, avec une petite note d'humour : se faire virer, ce n'est pas toujours une possibilité...

## Gestion des messages et notifications en temps réel avec API Platform par Allison Guilhem

Allison nous présente les notifications en temps réel au sein d'API Platform. Elle commence par expliquer le protocole et la technique derrière ces notifications. Depuis la version 1.1 de HTTP, il est possible de maintenir une connexion persistante entre le client et le serveur. La version 2 introduit le transfert binaire, le multiplexage et le push serveur. Enfin, la version 3 aborde les limitations de TCP en utilisant UDP et propose des connexions plus sécurisées.

Elle décrit ensuite plusieurs solutions de connexion en temps réel avec un serveur :

**Polling et Long Polling** : Solution simple et universelle, ne nécessite pas de connexions persistantes, évite la haute latence et une utilisation accrue de la bande passante avec le long polling.

**Server-Sent Events (SSE)** : Facile à mettre en œuvre, basé sur HTTP. Utilise des écouteurs d'événements JavaScript pour gérer les mises à jour. Reconnexion automatique. Protocole basé sur du texte. Communication unidirectionnelle.

**WebSocket** : Protocole de niveau inférieur à HTTP, canal de communication bidirectionnel et duplex. Offre beaucoup de contrôle mais présente des inconvénients. Faible latence. Supporte les données binaires et textuelles. Moins bien intégré avec HTTP/2 et HTTP/3. Complexité et défis de scalabilité, risques de sécurité.

Allison présente ensuite la solution de Kevin Dunglas, **Mercure** : Aucune configuration supplémentaire n'est nécessaire, compatible avec n'importe quel serveur. Reconnexions et synchronisations automatiques. Sécurisé avec JWT. Haute performance. Compatible avec GraphQL et les hypermédias. Chiffrement intégré et compatibilité ascendante.

Elle illustre l'utilisation de Mercure dans une application de casino en ligne, abordant des fonctionnalités comme la détection d'actions interdites (fraude, connexions depuis des pays restreints, etc.). Le système doit surveiller les activités des joueurs, nécessitant des notifications en temps réel sur un tableau de bord d'administration.

Allison explique comment utiliser Mercure avec FrankenPHP, en installant MercureBundle et en configurant ce dernier. Elle génère ensuite les différents points de terminaison de l'API et ajoute la configuration Mercure aux ressources d'API Platform. Elle en profite pour présenter les fonctionnalités de Mercure, ainsi que ses limites, notamment la gestion de la consommation concurrentielle, qui est encore en développement pour une fonctionnalité complète.

Elle conclue que le temps réel est une avancée essentielle qui fonctionne et offre de la clarté, en capturant l'essence même de la communication instantanée. Qu'il s'agisse de mises à jour, d'interactions ou de partage de connaissances, le temps réel a marqué une étape importante dans le progrès technologique. Et selon Alison, le temps réel ne se contentera pas de changer notre manière de communiquer, il va également révolutionner notre façon d'interagir avec les données.

## Accélérer la sérialisation avec API Platform par Mathias Arlaud

**"Représenter des structures de données dans un format pouvant être envoyé ou persisté, afin d'être reconstruit plus tard."**

Dans une API, lorsque vous essayez d'obtenir une ressource, vous sérialisez et convertissez les données vers une représentation. Le même processus s'applique pour la désérialisation : vous passez par un "entonnoir" qui transforme et adapte les données dans l'application.

Dans **API Platform**, on utilise un **Provider** (qui peut en appeler un autre) pour récupérer les données. Ensuite, ces données passent par un ou plusieurs **Processors** pour être converties en réponse. Ce processus est basé sur Symfony pour la (dé)sérialisation. Donc, étant lié au sérialiseur Symfony, nous dépendons de ses performances.

> **Schéma** : [Serializer (documentation Symfony)](https://symfony.com/doc/current/components/serializer.html)

Des règles de sérialisation et désérialisation sont définies et appliquées. Par exemple, avec une classe `Cat`, on peut utiliser des attributs comme `#[Ignore]` ou `#[SerializerName('name')]` pour personnaliser l'input/output des champs.

### Problèmes de performance et solutions

Un système de cache est utilisé pour améliorer les performances, mais cela ne suffit pas toujours.

**"Metadata is data, but about data"** : plus nous avons de métadonnées, plus nous pouvons manipuler la donnée efficacement.

Dans une classe représentant la pluie :

```php
/** @template T of string */
final class Rain {
    /** @return list<T> */
    public function content(): array {}
}
/** @var Rain<'cat'|'dog'> $englishRain */
$englishRain = new Rain();
```

La documentation des types (comme @var) nous informe sur les valeurs possibles. Si nous connaissons le type, nous pouvons l'exploiter efficacement.

Dans Symfony, le Property Type Extractor identifie les types des propriétés, mais il ne différencie pas les unions, intersections, listes ou dictionnaires, et ne gère pas les génériques.

Le composant TypeInfo a été introduit pour combler ces lacunes dans la sérialisation. Il permet de lire les propriétés, les retours de méthode, et prend en compte la PHPDoc, les génériques, etc.

Streaming pour optimiser la mémoire
Un des défis avec la sérialisation de grandes données est l'impact sur la mémoire. Pour y remédier, on peut utiliser le streaming de données plutôt que de tout charger en mémoire.

Un autre élément introduit est le JsonEncoder, qui exploite à la fois le composant de type et le streaming pour optimiser la sérialisation.

Voici un exemple simple d'un chat représenté en PHP puis en JSON :

```php
final class Cat {
    public string $name;
    public bool $flying;
}
```

En JSON :

```json
{
    "name": "Mittens",
    "flying": false/true
}
```

Plutôt que de tout écrire d'un coup, on peut écrire progressivement chaque élément du JSON et gérer dynamiquement les données, optimisant ainsi l'utilisation de la mémoire. Ce processus est géré par un encoder, qui vérifie s'il existe déjà, et si non, en crée un optimisé pour la donnée souhaitée.

### Sérialisation flexible et groupes

Par conception, le nouveau système ne permet pas de changer le type durant la sérialisation, contrairement à l'actuel qui est plus flexible.

En utilisant les attributs #[Groups()], on peut définir différentes représentations d'une même donnée. Mais cela peut entraîner de multiples représentations en fonction du nombre de groupes définis.

API Platform cherche à promouvoir une ressource = une représentation. Par exemple, CatGet, CatPost devraient uniquement contenir les champs spécifiques à leurs contextes respectifs. Cela peut demander un effort rébarbatif, mais avec le composant ObjectMapper, on peut facilement mapper des objets ensemble, évitant ainsi d'écrire manuellement du code répétitif.

En utilisant les attributs #[Map], il est possible de décider comment transformer les données d'une représentation à une autre (par exemple avec ucfirst). Cela permet de créer un provider qui utilise à la fois le mapper et le provider pour passer d'une représentation à l'autre.

### Performances

En appliquant ces principes, on peut passer de **2ms** avec le serializer Symfony à **-50 nanosecondes** en utilisant un encoder optimisé, soit un gain de **x40**. Avec l'**ObjectMapper**, on obtient environ **200ns**, soit un gain de **x20**. Pour la désérialisation, les performances peuvent aussi être améliorées par **x10**.

### Prochaines étapes

Certains des composants évoqués (comme **TypeInfo** ou **ObjectMapper**) ne sont pas encore fusionnés dans les versions stables de Symfony ou API Platform. Mais ces avancées promettent une amélioration significative des performances dans le futur.

Il est possible d'utiliser les attributs **Mapper** sur des DTO ou des entités tout en maintenant un code propre et performant.

## API Platform, des développeurs d'attributs ? par Clément Talleu

Clément nous propose un tour d'horizon des attributs disponibles dans API Platform. Il commence par expliquer ce que sont les attributs PHP, un outil permettant d'ajouter des métadonnées à des classes, fonctions, paramètres, etc. Il détaille leur utilisation dans l'écosystème Symfony, où l'API Reflection permet d'ajouter des comportements ou de configurer des services.

Dans API Platform, on compte 20 attributs, incluant ceux pour les opérations HTTP (API resource, Get, GetCollection, Patch, Post), ainsi que pour les paramètres de requête, les en-têtes et les erreurs HTTP.

Clément conclut en montrant comment créer un attribut. Il définit une classe, spécifie qu'il s'agit d'un attribut avec l'attribut Attribute, puis explique comment l'appliquer à n'importe quelle classe. Enfin, il utilise l'API Reflection pour récupérer les métadonnées de cet attribut.

## API Platform Admin: The Ultimate Admin Generator par François Zaninotto

Nous avons plusieurs promesses que nous allons explorer ici concernant la création du générateur d'admin API platform.

- CRUD easily (no code)
- No javascript code
- Extend the generated code using a simple javascript API
- Replace any part of the generated app with a custom React Component!

### CRUD easily (no code)

En créant une entité, quelques attributs notre CRUD est automatiquement généré dans l'admin, c'est aussi simple que ça !

### No javascript code

Il ajoute quelques APIFilter à son entité et des notions d'iri pour le schéma, pour passer à mercure, chercher dans l'existant et le documenter.
L'admin est mis à jour automatiquement, la documentation aussi et les changements d'entités sont partagés à tous les utilisateurs sur la page grâce à mercure
Pas une ligne de JS donc second objectif completé !

### Extend the generated code using a simple javascript API

Pas moyen de choisir quels champs afficher dans l'admin, les attributs PHP ne suffiront pas ici...

Le code généré en lisant la doc se fait en mémoire, aucun code ou configure n'est stocké ailleurs.
Le code est en revanche dump dans le console.log, avec des instructions indiqués pour overwrite !
En modifiant ce code et passant des props, on peut modifier le sort ou bien le label des champs voir encore les retirer.
Le code est très simple à modifier et comprendre, la documentation le notifie dans "Customizing the Admin" et vous en informe.

L'API du code généré est simple à modifier et remplie son rôle, il n'est pas obligatoire de savoir faire du react (ou le langage utilisé pour générer la doc).

### Replace any part of the generated app with a custom React Component!

Pour approfondir, il utilise marmelab/react-admin (25k stars).
Au lieu du FieldGuesser ou ListGuesser, il utilise les List, Datagrid etc... pareil pour EditGuesser => Edit etc etc..
Comme les règles ne sont plus "guessed", il faut parcontre mettre les règles nous même :/

Déjà pour Sf 1 il avait créé un générateur d'admin basé sur ng-admin et bootstrap, ce qui n'était pas parfait pour plusieurs soucis, le langage YAML en a beaucoup et le js code aussi.
Puis react-admin est arrivé, en fonctionnant en headless et utilisant les libs désirés (shadui, osef tout ça).
Quelqu'un a même fait un spotify clone.
Le souci en jsx ce sont les balises du jsx... au gout de chacun donc.

react-admin a des composants tels que PrevNextButton, TranslatableInputs, MenuLive pour avoir des badges (quand tu as du real time update par exemple).

FIlterList et RevisionsButton aussi, qui sont très très cools. Avis perso.

Le WizardForm pour faire du multi step pololoooo. Même des calendriers ! Oui oui !

## Adopter un lapin par Frédéric Bouchery

Frédéric nous a présenté RabbitMQ lors de la conférence API Platform, en partageant son retour d'expérience. Il a débuté par une introduction à RabbitMQ, en expliquant la création de queues et leur configuration. Il a détaillé le fonctionnement des messages dans les queues, en se concentrant sur les stratégies de suppression, notamment les modes "ack" et "nack". Il a souligné qu'il ne faut pas présumer que les messages seront consommés dans l'ordre.

Il a également précisé qu'on ne publie pas directement un message dans une queue, mais sur un échangeur, qui se charge ensuite de diriger les messages vers les queues appropriées. Il est toutefois possible de taguer les queues pour ne traiter que certains messages spécifiques ou bien tous les messages.

À travers des cas concrets, Frédéric a regretté que l'utilisation de RabbitMQ se résume souvent à un schéma simple, similaire à celui de Symfony Messenger : un échangeur, une queue et un consommateur. Pourtant, RabbitMQ est conçu pour traiter les messages en parallèle, ce qui ouvre des possibilités plus complexes.

Ensuite, il a expliqué comment intégrer RabbitMQ dans un projet API Platform. Cela commence par l'installation de Symfony Messenger ainsi que du module RabbitMQ pour Messenger. Il a montré comment configurer une opération API Platform pour envoyer un message à RabbitMQ via Symfony Messenger, en ajoutant un paramètre de type "Messenger" dans l'attribut de l'opération. Cependant, il a noté que cette méthode ignore la réponse, ce qui entraîne une réponse vide. Pour résoudre ce problème, il propose d'ajouter un décorateur sur le PersisterProcessor, afin de persister les données tout en envoyant le message, ce qui permet de conserver la fonctionnalité de l'endpoint API tout en intégrant RabbitMQ.

Un autre défi concerne le contenu des messages transitant dans RabbitMQ, qui sont sérialisés en PHP. Une solution consiste à créer un MessageSerializer personnalisé pour gérer ce contenu et les namespaces, qui peuvent ne pas exister dans le code du consommateur. Une alternative est d'éviter de propager des entités Doctrine, en utilisant plutôt des DTO communs entre le producteur et le consommateur.

En résumé, Frédéric nous propose des astuces pour simplifier et optimiser l'utilisation de RabbitMQ.

## Table ronde le marché de l'emploi

Participants : Clément Talleu, Jeanne Londiche et Olivier Mansour.

La discussion s’ouvre sur le sujet des freelances et des difficultés qu’ils rencontrent pour trouver du travail. Jeanne constate qu'en raison du ralentissement actuel du marché, de nombreux développeurs envisagent de revenir vers des CDI. Olivier souligne que la perspective de hauts salaires a poussé beaucoup de jeunes diplômés à se tourner rapidement vers le freelancing.

Jeanne revient sur l'impact de la pandémie : le secteur du e-commerce a connu une forte croissance pendant le COVID, mais subit désormais un déclin marqué, avec la fermeture de nombreuses boutiques. Clément ajoute que le marché du divertissement a également stimulé les embauches durant cette période, notamment grâce à l'usage accru des plateformes de streaming.

Pour Jeanne, le marché devient aujourd'hui plus difficile à cause d'une baisse des besoins et des salaires en recul. Olivier confirme cette tendance à travers le baromètre des salaires de l'AFUP, indiquant une stagnation des rémunérations pour les développeurs juniors et intermédiaires.

Sur l'attractivité des entreprises, Clément explique que Les-Tilleuls.coop, bien que proposant des salaires inférieurs à la moyenne, attire grâce à son modèle social coopératif. Olivier, quant à lui, affirme qu'il n'y a pas de forte tendance au turn-over et que les développeurs restent globalement fidèles à leur entreprise. Il précise que des avantages comme le télétravail ou la semaine de quatre jours sont des atouts majeurs pour attirer de nouveaux talents.

Concernant les langages demandés sur le marché : une étude montre que PHP est désormais peu recherché. Olivier remarque que les entreprises privilégient de plus en plus des développeurs capables de maîtriser plusieurs langages, plutôt que de se spécialiser dans une seule technologie.

Pour ce qui est de l'attractivité des développeurs eux-mêmes, Olivier conseille de consulter le baromètre des salaires pour se positionner de manière juste en fonction de son expérience. Jeanne ajoute que la veille technologique et les projets personnels sont des moyens efficaces pour se démarquer. Olivier nuance cependant en précisant que les entreprises devraient éviter de demander aux développeurs de réaliser des projets sur leur temps libre, et plutôt les soutenir avec des programmes de mentorat pour les juniors.

En conclusion, cette table ronde a été particulièrement intéressante, offrant des échanges riches et variés sur des sujets essentiels pour les développeurs et les entreprises dans le contexte actuel. Les interventions de Clément, Jeanne et Olivier étaient claires et bien argumentées, et l’organisation de la discussion, avec des questions pertinentes et bien ciblées, a permis de couvrir une large palette de problématiques. Cependant, le temps alloué s'est avéré trop court pour explorer pleinement certains aspects.

## Comment se sortir du legacy ? par Smaïne Milliani

Le terme **legacy** est souvent mal défini. Cela peut faire référence à du vieux code, à du code sans tests. Ou même du code qui génère des revenus pour l'entreprise, mais qui est difficile à maintenir. Smaïne Milliani nous propose une approche claire pour gérer ce type de code et améliorer sa qualité.

### Les caractéristiques d'un bon test

Pour sortir du legacy il faut d'abord comprendre comment tester correctement le code. Voici quelques caractéristiques importantes à garder en tête pour des tests efficaces et pertinents :

- **Rapide** : les tests doivent s'exécuter rapidement.
- **Isolé** : ils ne doivent tester que le code ciblé, sans interférence avec d'autres parties.
- **Répétable** : les tests doivent fonctionner de manière identique en local et sur un serveur CI.
- **Auto-validant** : ils doivent signaler clairement si le code échoue.
- **Exhaustif** : plusieurs scénarios doivent être couverts.

#### Utiliser les bons outils

Pour aborder le legacy, il est crucial de s'appuyer sur des outils adaptés tels que :

- **Deptrac** : pour visualiser et gérer les dépendances entre les modules.
- **Rector** : pour automatiser le refactoring en suivant des règles prédéfinies.

Ces outils facilitent la transition d'un code legacy vers un code plus maintenable.

### Le code ne nous appartient pas

Un point clé souvent négligé : **le code ne vous appartient pas**. Il appartient à l'équipe et aux futures générations de développeurs qui devront le maintenir. Par conséquent, il est essentiel que chaque modification soit validée par l'ensemble de l'équipe, pour assurer la continuité et la maintenabilité.

#### Remboursez votre dette technique !

Smaïne rappelle un principe fondamental :

> **"Make it work, then make it clean."**

Il est important de s'assurer que le code fonctionne avant d'essayer de le rendre propre. Une fois cela fait, vous pouvez appliquer les principes du **Clean Code** pour améliorer sa qualité.

### Les principes du Clean Code

Voici quelques concepts de **Clean Code** qu'il est important de respecter :

- **KISS** : _Keep It Simple, Stupid_ afin de conserver un code _simple_ et compréhensible.
- **SOLID** : respecter les cinq principes pour garantir une architecture modulaire et flexible.
- **DRY** : _Don't Repeat Yourself_ pour ne pas dupliquer le code inutilement.

#### Utilisation des Design Patterns (quand c'est nécessaire)

Les **design patterns** sont des outils puissants, mais ils doivent être utilisés à bon escient. Par exemple, il ne sert à rien d'utiliser un pattern si deux simples conditions `if` suffisent. Utilisez des patterns tels que **Strategy**, **Adapter**, et **Decorator** uniquement lorsque cela apporte une vraie plus-value.

> "N'utilisez des design patterns **QUE LORSQUE C'EST NÉCESSAIRE**."

### L'architecture, un pilier du bon code

Pour structurer et maintenir le code à long terme, une architecture solide est essentielle. Voici quelques exemples :

- **Clean Architecture**
- **CQRS** (Command Query Responsibility Segregation)
- **Hexagonal Architecture**
- **Onion Architecture**
- **MVC** (Model-View-Controller)

Ces modèles permettent de mieux organiser le code, en le rendant modulaire, testable et évolutif.

### Fin du "Array Oriented Programming"

Smaïne souligne qu'il est temps d'abandonner le "array-oriented programming". Au lieu d'utiliser des tableaux pour tout, privilégiez les objets et les **DTO** (Data Transfer Objects) pour structurer vos données :

- **Requête SQL ?** Utilisez un **DTO**.
- **Requête HTTP ?** Utilisez un **DTO**.
- **Une commande ?** Utilisez un **DTO**.

> **"DTO partout !"**

### La règle du Boy Scout : laisser le code plus propre

Un principe simple mais efficace : **ne laissez jamais un code dans un état pire que celui dans lequel vous l'avez trouvé**. Cela signifie que chaque fois que vous touchez une partie du code, améliorez-la autant que possible.

### Garder les dépendances à jour

Il est crucial de garder ses dépendances à jour pour éviter des problèmes de sécurité et de compatibilité. Des outils comme **[Renovate Bot](https://github.com/renovatebot)** ou des mises à jour manuelles régulières sont indispensables pour garantir la stabilité du projet.

### Comment gérer le legacy existant ?

Arriver sur un projet legacy peut sembler décourageant. Voici quelques pièges à éviter :

- Ne modifiez jamais du code sans comprendre comment il fonctionne.
- Ne changez pas plusieurs choses en même temps.
- Ne travaillez jamais seul sur du code legacy.
- Ne réécrivez pas complètement le code legacy sans tests.
- Ne commencez pas par modifier les opérations d'écriture (WRITE), car elles impactent directement le système. Modifiez d'abord les opérations de lecture (READ), car elles sont moins risquées.

### Stratégies pour gérer le legacy

Smaïne propose plusieurs méthodes pour s'attaquer au legacy de manière efficace :

- **Mikado Method** : cette approche consiste à découper un refactoring trop conséquent en plusieurs petites parties, à traiter une à une.
- **Golden Master Testing** : une technique de test qui permet de capturer le comportement actuel du système afin de le comparer après refactoring.
- **Smoke Test** : des tests simples pour s'assurer que le système fonctionne toujours après modification.

### Et pour le management ?

Le refactoring ne concerne pas uniquement les développeurs : le management doit également être impliqué dans le processus. Voici quelques actions à mettre en place :

- **Auditer** le projet, pour identifier les points sensibles.
- **Documenter** les processus et les modifications apportées.
- **Planifier** le refactoring sur le long terme.
- **Tester** chaque modification avant de la déployer.
- **Travailler par petits pas**, avec des déploiements progressifs.
- **Communiquer** de manière transparente sur l'avancement.
- **Déployer et monitorer**, pour vérifier que tout fonctionne bien après un refactoring.
- **Recommencer** : le refactoring est un processus continu.

Avec ces stratégies, Smaïne Milliani nous offre une feuille de route claire pour aborder le code legacy de manière progressive, tout en assurant la qualité et la maintenabilité à long terme.

## Automating build with frankenphp par Boas Falke

### FrankenPHP : Un seul service pour PHP

**FrankenPHP** est une solution innovante qui propose un seul service pour exécuter PHP. Il présente plusieurs atouts majeurs que Boas nous a exposés.

#### Avantages de FrankenPHP

- **Prod/CI/Dev** : fonctionne de manière homogène en production, en intégration continue (CI), et en environnement de dev.
- **Custom build de Caddy** : intégration avec Caddy dans une version spécifique, ajoutant des fonctionnalités au serveur de base.
- **Mode worker pour les performances** : optimisation des performances avec un mode worker.
- **Support des 103 Early Hints** : meilleure expérience utilisateur avec des réponses HTTP anticipées.
- **Binaire statique** : distribution sous forme de binaire statique.

### La distribution par binaire statique

L'un des aspects les plus novateurs de FrankenPHP est la **distribution sous forme de binaire statique**. Cette approche offre plusieurs avantages :

- **Interaction avec le système de fichiers** : gère facilement les interactions avec le système de fichiers (FS) et les tâches programmées.
- **Distribution simplifiée** : le binaire peut être distribué facilement sur différentes plateformes sans dépendances externes.

### Prérequis pour la construction

Pour utiliser FrankenPHP avec un **binaire statique**, voici les étapes à suivre :

1. Utiliser l'image **static builder** comme base.
2. Archiver les fichiers nécessaires.
3. Définir les **variables d'environnement** à utiliser.
4. Supprimer les dossiers inutiles (comme les tests).
5. Installer les dépendances requises.
6. Exécuter la commande **dump-env** en mode production.

### Processus de build

1. Définir l'emplacement de l'application.
2. Spécifier les extensions PHP souhaitées.
3. Lancer le script `.sh` pour le build.

> Note : Le processus de build peut être long car le code est compressé pour optimiser la taille et les performances.

Une fois le build terminé, il est possible de créer un **artifact** pour GitLab ou d'autres systèmes de CI/CD.

### Démo live avec Mailpit

Pour démontrer la puissance et la simplicité de FrankenPHP, une démo live a été réalisée avec **Mailpit**, un service pour visualiser les emails générés par le système. Lorsqu'un fichier est déposé, un email est envoyé, ce qui prouve que le binaire interagit parfaitement avec le système. Cela montre non seulement la facilité d'interaction, mais aussi la rapidité et la fiabilité de cette solution.

Avec FrankenPHP, la gestion des services PHP est simplifiée. Que ce soit pour des environnements de production, de développement ou de CI, il assure des performances optimales et une distribution facilitée grâce aux binaires statiques.

---

En conclusion, l'API Platform Conference 2024 a une nouvelle fois tenu toutes ses promesses. Les conférences étaient de qualité, la table ronde s'est révélée passionnante et a suscité des échanges enrichissants. Comme toujours, l'organisation était irréprochable, permettant aux participants de profiter pleinement de chaque moment. Sans oublier l'excellent apéro, qui a permis de poursuivre les discussions dans une ambiance chaleureuse et détendue. 

Une édition à la hauteur des attentes, vivement la prochaine !
