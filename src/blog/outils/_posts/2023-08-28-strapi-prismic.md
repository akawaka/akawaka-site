---
layout: post
title: Strapi et Prismic, comment choisir ?
image: /build/front/images/blog/strapi-vs-prismic.png
alt: logos Strapi et Prismic 
subtitle: Réflexions d'une juniore sur le choix d'une solution de CMS Headless 
date: 2023-09-08 12:00:00
date_modified: 2023-09-08 12:00:00
category: outils
author: Équipe AKAWAKA
---

# Strapi et Prismic : comment choisir ?

Nous sommes en 2023, il existe de nombreux CMS Headless qui peuvent répondre à vos besoins. Il est alors facile de se perdre dans toute cette documentation, ces [comparatifs](https://cms-comparison.io/#/card) et guides, surtout lorsque les besoins ne sont pas clairement identifiés. Parce qu'à la problématique : Strapi et Prismic, comment choisir la meilleure solution ? Je vais citer la réponse que vous connaissez déjà : ça dépend.

> **CMS Headless** : Système de gestion de contenu (Content Management System) qui se concentre sur la gestion et le stockage du contenu (et du back-end globalement) laissant le choix libre concernant les technologies à utiliser pour le front-end. 

Prenons le temps de la réflexion et avant de nous lancer, il peut être judicieux de savoir pourquoi vous pourriez préférer un CMS Headless à un CMS traditionnel, et inversement.

Les CMS Headless ont gagné en popularité ces dernières années par leur flexibilité et leur scalabilité notamment, mais selon votre projet, peut-être que vous préférerez un CMS traditionnel. Il n'en sera cependant pas question dans cet article.

> **Scalabilité** : faculté d'un produit, d'un logiciel ou d'une application à s'adapter aux fluctuations de la demande et du marché, tout en conservant ses fonctionnalités de base.

La multitude de solutions peut vite déboussoler les personnes qui n'ont jamais touché à ces solutions, alors comment faire le bon choix ?
Tout commence par l'identification claire de vos besoins.

## Identifier les besoins

Avant de commencer à lire tous les articles et comparatifs de CMS que vous allez trouver, posez-vous certaines questions :
* Quels sont les objectifs du site / de l'application ? (Vente en ligne, blog, plateforme éducative... etc)
* Quel est le budget ?
* Qui sont les utilisateurs finaux ?
* Quelle est la stratégie de contenu ? 

Concernant la **stratégie de contenu** il faut se demander :
quel est son but (éducatif, engageant...), quels types de contenus seront créés, quels seront les canaux de distribution (où sera publié le contenu), comment ce dernier sera maintenu et actualisé etc.

D'autres questions peuvent ensuite s'ajouter à la liste, comme :
* Quel est votre niveau de compétences techniques ?
Si vous êtes novice, vos choix vont se porter sur des solutions avec des interfaces intuitives par exemple.
* Quelle importance est-ce que vous accordez à la personnalisation ?
*  Est-ce que vous allez réaliser ce projet seul·e ou bien de façon collaborative ?


Vous l'avez compris, la liste de questions à se poser peut vite devenir impressionnante. La sélection sera moins compliquée une fois les besoins clairement déterminés.

## Faire connaissance avec les outils

**Strapi** est un CMS open source auto-hébergeable construit avec Node.js et qui propose une architecture back-end basée sur Express. Il permet de créer une intégration de contenu personnalisable, performante et est doté d'une API.

> Open source software (OSS) : dont le code est mis à disposition du public. Ce qui encourage la transparence et la collaboration dans les communautés de développeurs·ses.
>
> Il est optionnellement encadré par une licence dans laquelle le détenteur du droit d'auteur accorde aux utilisateurs le droit d'utiliser, d'étudier, de modifier et de distribuer le logiciel et son code source à quiconque et à n'importe quelle fin.

Il permet de créer des modèles de données avec des relations personnalisées entre les contenus.
Par exemple, pour la création d'un blog, on peut créer des modèles de données comme "Article" et "Auteur" et faire en sorte que chaque article soit lié à un auteur spécifique. Il est aussi possible de créer d'autres "liens", d'autres relations telles que des catégories d'articles pour organiser le contenu. En d'autres mots, il s'agit de façonner la structure du contenu de manière à répondre aux besoins du projet. 

Outre sa flexibilité, Strapi offre un éditeur WYSIWYG (What You See Is What You Get) pour simplifier la création et modification de contenu, ce qui peut être particulièrement utile pour les rédacteurs.

Cette solution profite d'une grande extensibilité de par sa communauté active (sur [Discord](https://discord.gg/strapi) par exemple). De plus, de nombreux plugins sont disponibles et visualisables via l'interface générée lors de la création de votre projet.

Strapi permet aussi un travail collaboratif avec ses fonctionnalités de contrôle d'accès et de gestion des rôles, tout comme Prismic.

---

En ce qui concerne ce dernier, **Prismic** se focalise sur la gestion de contenu en fournissant un cadre structuré. Contrairement à Strapi, il offre moins de personnalisation et propose des types de contenu prédéfinis.
En tant que SaaS offrant une API de gestion de contenu, Prismic propose notamment un outil intéressant nommé **Slice Machine**, qui fonctionne avec les technologies Next.js et Nuxt 2 & 3. 

> SaaS (Software as a Service) : solution logicielle applicative hébergée dans le cloud et exploitée en dehors de l’organisation ou de l’entreprise par un tiers (fournisseur de service).

### Slice Machine en quelques mots
[Slice Machine](https://prismic.io/docs/slice-machine) est un outil de développement local qui permet de construire des modèles "**types**" et des "**Slices**" de façon synchronisée entre votre codebase et votre repository Prismic.

Les types font référence à la structure globale des différents contenus / pages dans l'application. Chaque type représente un **modèle de contenu** spécifique. 
Quant aux Slices, ce sont des éléments **modulaires** et réutilisables, cela permet de diviser les contenus en sections avec leur propre structure.

Cet outil place vos modèles de contenu directement dans votre code faisant ainsi de votre code la source de vérité pour vos structures de données. 

Grâce à Slice Machine, vous pouvez gérer les versions et simuler localement vos modèles de contenu. 
> "Source of truth" (source de vérité) est une expression utilisée pour désigner la source la plus fiable et la plus à jour d'informations ou de données dans un système.

## Comment faire votre choix ?
Nous y voilà, la fameuse question.
Lorsqu'il s'agit de choisir, ici entre Strapi et Prismic, il y a quelques points à considérer et il s'agit plus ou moins de relier les points évoqués plus haut.

* Complexité technique : 
Strapi, en raison de sa personnalisation, peut nécessiter une meilleure compréhension des frameworks JavaScript tels que Node.js et Express, tandis que Prismic est probablement plus intuitif pour les débutants.

Strapi propose une interface admin qui permet de "tout" gérer (modèles de données, relations des contenus etc) et vous pourriez avoir besoin de manipuler le code de l'API par exemple pour définir certains endpoints, pour gérer des autorisations etc, et dans ces cas là, une compréhension de Node.js et Express peut s'avérer nécessaire. 
Ça ne veut pas dire qu'il faut maîtriser ces technologies pour utiliser Strapi, mais pour des personnalisations avancées, c'est un plus.

* Flexibilité et personnalisation (décidément) :
Comme nous venons de le voir, Strapi est une bonne solution pour une personnalisation approfondie, mais si par contre vous cherchez une solution plus structurée et de façon modulaire et un peu "clés en main", votre choix se porterait peut-être plus sur Prismic.

* Taille du projet : 
Plus un projet est vaste, plus il peut nécessiter une gestion efficace de la scalabilité. 
Dans ce cas là, Strapi pourrait offrir plus de possibilités, en raison de son auto hébergement.

Prismic propose une solution hébergée dans le cloud, donc l'infrastructure d'hébergement est gérée par Prismic et cela peut simplifier le processus de déploiement pour les utilisateurs qui ne souhaitent pas gérer leur propre infrastructure mais le niveau de contrôle direct sur l'environnement d'hébergement est donc limité.

Strapi quant à lui, en étant auto hébergé, peut être déployé sur vos propres serveurs et vous avez un contrôle total sur l'environnement d'hébergement ainsi que la capacité à ajuster les ressources en fonction des besoins du projet et de la charge (par exemple dans le cas où il y ait un grand nombre d'utilisateurs actifs).

* Accès aux données :
Avec **Strapi** vous avez un contrôle total sur la base de données et les données stockées. Vous avez la liberté de choisir la base de données qui convient le mieux à votre projet (par exemple MongoDB, MySQL... etc) et définir la structure des modèles de données en fonction de vos besoins.
Dans le cadre de Strapi, vous avez également la mainmise sur les opérations CRUD (Create, Read, Update et Delete). Cette flexibilité vous permet de personnaliser et de mettre en place des opérations spécifiques pour manipuler les données conformément aux exigences de votre projet.

D'un autre côté, **Prismic** adopte une approche différente pour l'accès aux données. Vos contenus sont stockés dans le cloud, et vous interagissez avec eux via une interface déployée dans le cloud. Vous accédez aux données en interrogeant l'API de Prismic à l'aide de requêtes.

## Conseils pratiques pour la prise de décision 
Une fois vos besoins, vos critères et vos scénarios définis, libre à vous d'expérimenter et de vous faire votre propre avis sur les outils disponibles.
Vous pourrez tester leur fonctionnement, leur intégration à votre projet.
Consulter les différentes communautés peut aussi vous aider, lisez les retours d'expérience d'autres utilisateurs car ils ont eu à se poser les mêmes questions que vous.

Comme vous l'avez compris, ce choix dépend tellement des spécificités de votre projet et de vos préférences techniques que je ne pourrais pas vous donner une réponse qui conviendra à tout le monde et tout le temps. Toutes ces solutions ont des avantages et des inconvénients et répondent à des besoins spécifiques.
En prenant tout cela en compte, vous pourrez choisir la solution qui vous convient le mieux pour tel ou tel projet. 

## Ressources 
Documentation de Strapi :
https://docs.strapi.io/dev-docs/intro

Documentation de Prismic : 
https://prismic.io/docs

Turoriels et guides : 

 - [Getting started with Strapi v4](https://www.youtube.com/playlist?list=PL7Q0DQYATmvidz6lEmwE5nIcOAYagxWqq)
 - [Strapi blog](https://strapi.io/blog)
 - [Communauté Prismic](https://community.prismic.io/)
 - [SvelteKit 1.0 Crash Course - Full Tutorial with Prismic](https://www.youtube.com/watch?v=mDQy0NsBrwg)