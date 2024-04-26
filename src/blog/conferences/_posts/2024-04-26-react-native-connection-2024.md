---
layout: post
title: React & React Native Connection à Paris
image: /build/front/images/blog/react-connection.png
alt: logo React Native
subtitle: Nous avons pu assister à de nombreuses conférences lors de la React & React Native Connection et nous souhaitons vous partager nos retours dans cet article.
date: 2024-04-26 10:00:00
date_modified: 2024-04-26 10:00:00
category: conferences
author: Équipe AKAWAKA
---

# React et React Native Connection 2024

Le 22 et 23 avril derniers à Paris, Akawaka a fait ses premiers pas dans l'univers des conférences 100 % dédiées à l'écosystème JavaScript en participant à React Connection et React Native Connection, qui se sont déroulées à Paris. Pour Akawaka, cette immersion dans le développement web et mobile représentait une opportunité de mieux connaitre le monde React.

Dans cet article, nous allons résumer les moments forts de ces conférences, sélectionnés par l'équipe. Nous vous résumons les présentations les plus inspirantes, les démonstrations les plus captivantes et les discussions les plus pertinentes, offrant ainsi un aperçu des tendances émergentes et des avancées technologiques les plus prometteuses de l'écosystème React.

## How we made the new React site - Par **Rachel Nabors**

**Rachel** nous emmène dans les coulisses de la refonte de la documentation de React et React Native. Elle partage son expérience dans l'ajout de fonctionnalités essentielles en réponse aux besoins de la communauté, qui auparavant consultait rarement la documentation.

La nouvelle documentation est enrichie de nombreux schémas, de descriptions détaillées des composants et d'exemples interactifs. Un aspect notable est l'utilisation de personnages accessibles à tous, tels que des scientifiques, plutôt que des références à la culture pop américaine.

Grâce à cette refonte, la communauté recommande désormais la nouvelle documentation trois fois plus souvent qu'auparavant.

## Why You Should Use Redux in 2024 - Par Mark Erikson

Mark Erikson, le créateur de Redux, nous éclaire sur les raisons pour lesquelles Redux demeure une solution pertinente en 2024, tout en soulignant les cas d'utilisation idéaux pour cet outil.

Il met en lumière le fait que Redux n'a jamais bénéficié d'une promotion officielle, ce qui a souvent conduit à des utilisations inappropriées et à une mauvaise réputation. La critique principale portait sur la quantité de code et de fichiers nécessaires à son utilisation.

Mark revient sur la genèse de Redux en 2013, lorsque Facebook a introduit une architecture de flux pour gérer les changements d'état dans les applications. Redux est né de cette époque et est rapidement devenu la solution de prédilection de la communauté, intégrée par défaut dans de nombreuses applications React.

Aujourd'hui, l'objectif est de redéfinir le rôle de Redux. Initialement conçu pour les projets de grande envergure, son architecture a été modernisée en 2023 pour fournir un toolkit adaptable aux évolutions de React, notamment avec React Query, permettant la récupération de données de manière efficace.

En conclusion, Mark énumère les scénarios dans lesquels l'utilisation de Redux est pertinente, ainsi que ceux où d'autres approches peuvent être préférables.

## Creating 3D Experiences with React - Par **Sara Vieira**

**Sara** nous livre une démonstration épatante de live coding, nous plongeant dans une expérience 3D immersive rappelant l'esthétique rétro de la PlayStation 1, où la jaquette du jeu prend vie sous la forme d'un modèle 3D en rotation.

Pour réaliser cette prouesse, Sara utilise une combinaison de technologies : Blender pour la modélisation 3D, Suzanne pour l'intégration du modèle dans le code, et React avec Three.js pour le rendu 3D.

Cette démonstration met en lumière les possibilités incroyables offertes par ce type d'expérience 3D.

## Vite et bien : React component testing with Playwright - Par **Jean-François Greffier**

Au cours de cette session, **Jean-François** nous initie à l'utilisation de Playwright, un outil de test poussé par Microsoft et inspiré de Puppeteer. À travers une démonstration en live coding, il met en lumière les possibilités offertes par cet outil.

La syntaxe de Playwright reste familière pour ceux qui sont habitués au testing en JavaScript avec des frameworks comme Jest. L'utilisation de ViteJS en interne offre des performances remarquables, permettant de regrouper les tests et de les exécuter efficacement.

Bien que toujours en phase beta, Playwright présente un potentiel prometteur. Cependant, il est à noter qu'il reste encore des améliorations à apporter avant qu'il puisse être largement adopté.

## Building complex UIs with a Server-driven React app - Par **Mo Khazali**

**Mo** nous éclaire sur le concept de l'interface pilotée par le serveur, qui permet au backend de contrôler l'affichage des éléments frontend, y compris leur ordre, leur visibilité et d'autres attributs.

En pratique, cela se traduit par la fourniture par le backend d'un JSON décrivant les composants à afficher ainsi que leurs paramètres, que le frontend interprète ensuite pour générer l'interface utilisateur.

Cette approche est adoptée par des entreprises telles qu'Airbnb, Lyft et Shopify, offrant la flexibilité d'adapter l'interface en fonction de divers critères, tels que l'état de connexion du client ou son profil utilisateur, par exemple dans le cadre d'une application GPS où les conducteurs de scooters et de vélos voient des interfaces différentes.

Cependant, cette solution ne résout pas tous les problèmes : elle déplace la complexité de la logique frontend vers le backend, soulevant des questions sur la mise en cache et la disponibilité hors ligne de l'application. De plus, la gestion de réponses serveur de plus en plus volumineuses pose également des défis.

Cette approche n'est pas universelle et doit être envisagée avec discernement en fonction des exigences spécifiques de chaque projet.

## Custom Renderers - Par **Maël Nison**

**Maël** commence par une explication du fonctionnement de la mise à jour du DOM dans React, en mettant en lumière le concept de réconciliation des nœuds JSX. Il plonge ensuite dans les rouages internes du rendu des composants React, en détaillant leur mécanique interne.

Il approfondit le sujet en présentant un exemple de Rendu Personnalisé pour sa bibliothèque Terminausorus, permettant de créer des interfaces dans le terminal. Il souligne également d'autres exemples de Rendus Personnalisés tels que React Native, React PDF, etc.

En conclusion, il nous oriente vers le dépôt Git awesome-react-renderer, répertoriant tous les Rendus Personnalisés existants.

## Single Page Apps Are Not Dead - Par **François Zaninotto**

**François** dresse un panorama des différentes approches pour le rendu d'applications React, telles que File Router, SSR (rendu côté serveur), chacune ayant ses avantages et ses inconvénients.

Il explore ensuite l'architecture logicielle à travers les design patterns et la méthodologie DDD (Domain-Driven Design) avec les Bounding Context. Selon lui, ces concepts ne sont pas compatibles avec File Router ou SSR, mais trouvent leur place dans la vision des Applications Monopages (SPA).

Bien que le SSR réponde souvent à des besoins de performance, François soutient qu'il est possible de contourner ces limitations en utilisant des techniques telles que le lazy loading et les placeholders de changement. Pour ce qui est de l'optimisation pour les moteurs de recherche (SEO), il mentionne la possibilité de pré-rendre une partie du contenu pour le référencement et de gérer le reste en SPA.

En conclusion, il souligne un dernier avantage des SPA : la capacité à héberger le code sur un CDN, améliorant ainsi la rapidité de chargement de l'application web.

## A Look at Tomorrow: The Future of React - Par **Christophe Porteneuve**

**Christophe** nous offre un aperçu du futur de React avec l'avènement du React Server Component (RSC), une nouveauté majeure. Il énumère les évolutions à venir :

- Une adoption accrue et la compatibilité avec davantage de bibliothèques pour le RSC.
- La stabilisation de son API.
- Une disponibilité accrue de typages TypeScript (pour GraphQL, le schéma Zod, etc.).
- L'introduction du React Compiler postérieur à la version 19 de React.
- Une amélioration de l'instanciation de JSX.

En résumé, de nombreuses perspectives prometteuses pour l'avenir de React.

## Code Sharing Between Web and React Native - Par **Kadi Kraman**

**Kadi** nous propose une analyse de l'augmentation de l'utilisation des appareils mobiles par rapport aux ordinateurs de bureau pour accéder aux sites web et aux applications.

Avec cette tendance croissante, la nécessité d'une solution permettant de gérer à la fois le web et le mobile se fait de plus en plus sentir, et React Native apparaît comme un candidat idéal pour une approche cross-platform, à la fois web et mobile.

Il devient ainsi intéressant de pouvoir partager une partie du code entre l'application web et mobile. Par exemple, Expo Router offre la possibilité de partager la logique de routage et d'affichage, qui est souvent très spécifique entre les applications natives et web.

React Native propose une API permettant de distinguer les environnements web et mobile, offrant ainsi la possibilité d'avoir une logique commune ainsi que des spécificités pour chaque plateforme.

## New Architecture is here - Par **Tomasz Zawadzki**

**Tomasz** nous présente la toute nouvelle architecture de React Native, comprenant :

- L'introduction d'un bus natif pour gérer de manière asynchrone les changements d'interface utilisateur.
- La transition d'une pile d'instructions JSON à une interface C++ (JSI) pour le pont entre React et le natif, facilitant ainsi la communication entre JavaScript et les appareils mobiles.
- L'utilisation de turbo modules, désormais typés avec TypeScript et offrant des abstractions sécurisées, pour accéder aux fonctionnalités natives telles que la caméra et le GPS.
- Un nouveau moteur de rendu avec JSI pour une meilleure communication avec le natif.

Ces améliorations sont toujours en cours de développement, mais de nombreuses bibliothèques de l'écosystème React Native sont déjà compatibles avec cette nouvelle architecture. Tomasz encourage vivement son utilisation dès maintenant pour favoriser son adoption au sein de la communauté.

Dans l'ensemble, cette nouvelle architecture se révèle plus performante dans l'affichage des vues, textes, images, etc., renforçant ainsi la position de React Native comme un choix de développement mobile sérieux.

## Conclusion

En conclusion, notre participation à React Connection et React Native Connection a été une expérience extrêmement enrichissante pour l'équipe Akawaka. Nous avons grandement apprécié cet événement qui nous a permis de nous immerger dans le monde passionnant du développement JavaScript. L'animation était dynamique et engageante, et nous avons été impressionnés par la qualité des présentations et des discussions.

Nous avons également eu l'opportunité d'échanger avec des développeurs passionnés, partageant leurs expériences et leurs idées, ce qui a renforcé notre conviction de poursuivre notre engagement dans le développement d'applications avec React et React Native pour nos clients.

En somme, React Connection et React Native Connection ont été des événements exceptionnels pour Akawaka, et nous sommes impatients de participer à d'autres rencontres similaires dans le futur.
