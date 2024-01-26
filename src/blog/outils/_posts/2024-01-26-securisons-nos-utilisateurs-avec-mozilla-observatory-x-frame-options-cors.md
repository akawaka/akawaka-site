---
layout: post
title: Sécurisons nos utilisateurs avec Mozilla Observatory partie 2 - X-Frame-Options et CORS
image: /build/front/images/blog/mozilla-observatory-x-frame-options-cors.png
alt: logo Mozilla Observatory
date: 2024-01-31 10:00:00
date_modified: 2024-01-31 10:00:00
category: outils
author: Équipe AKAWAKA
---

Cet article fait partie d’une série d’articles consacrés à Mozilla Observatory, vous pouvez retrouver le premier article qui fait le focus sur [les règles HTTPS et redirection](https://www.akawaka.fr/blog/outils/securisons-nos-utilisateurs-avec-mozilla-observatory-https-redirection.html).

Continuons notre présentation des règles de sécurités testées par Mozilla Observatory et comment les corriger.

### X-Frame-Options

Cette directive de sécurité est essentielle pour définir la politique à suivre lors de l'intégration de votre site web dans une balise iframe. Bien que l'usage des iframes puisse sembler désuet aujourd'hui, à l'exception de certains cas comme l'intégration de widgets (vidéos, cartes, etc.), il ne faut pas sous-estimer leur pertinence. En effet, les iframes sont encore largement utilisées, notamment dans des pratiques malveillantes comme le détournement de données. L'utilisation judicieuse de l'en-tête HTTP `X-Frame-Options` s'avère donc cruciale pour renforcer la sécurité et prévenir les tentatives de vol de données par le biais de contenu intégré non autorisé.

Imaginez qu'un individu malintentionné acquiert un nom de domaine semblable à celui de votre site web. Cette personne pourrait alors intégrer votre site dans une iframe sur sa propre page, se mettant ainsi en position de contrôler tout ce qui se passe au sein de cette iframe. Cela ouvre la porte à des pratiques malveillantes, comme la capture de sessions utilisateur, le vol d'identifiants ou d'autres données sensibles. L'utilisateur final, ne remarquant pas la supercherie, pourrait interagir avec l'iframe en pensant naviguer sur votre site authentique.

Dans la plupart des cas, on ne souhaite pas que notre site puisse être affiché dans un iframe, heureusement l’entête HTTP `X-Frame-Options` permet de dire au navigateur comme notre site doit se comporter dans un iframe.

À noter que la directive `X-Frame-Options` est dépréciée pour `Content-Security-Policy`, mais pour une compatibilité optimale avec tous les navigateurs, il est préférable de mettre les deux.

On retrouve trois stratégies différentes :

- `DENY` / `none`: On bloque tout simplement la possibilité d’afficher le site dans un iframe.
- `SAMEORIGIN` / `self`: On autorise seulement d’afficher notre site dans un iframe si on est sur le même nom de domaine, en d’autres termes, on accepte d’afficher un site A dans un iframe seulement à partir du site A.
- `ALLOW-FROM`: On autorise d’afficher notre site dans un iframe seulement pour les noms de domaines cités.

```
// Block site from being framed with X-Frame-Options and CSP
Content-Security-Policy: frame-ancestors 'none'
X-Frame-Options: DENY

// Only allow my site to frame itself
Content-Security-Policy: frame-ancestors 'self'
X-Frame-Options: SAMEORIGIN

// Allow only framer.example.org to frame site
Content-Security-Policy: frame-ancestors https://framer.example.org
X-Frame-Options: ALLOW-FROM https://framer.example.org
```

## Cross-origin Resource Sharing

Le **CORS** (Cross-Origin Resource Sharing) est souvent perçu comme un véritable casse-tête pour les développeurs d'applications Web qui consomment des API. Cependant, il s'agit d'une mesure de sécurité essentielle conçue pour protéger vos applications contre les requêtes provenant de sources inconnues ou non autorisées. Par défaut, les navigateurs sont configurés pour restreindre et contrôler l'accès aux API depuis des domaines différents de celui d'origine, garantissant ainsi que seules les requêtes fiables et prévues sont traitées.

*Je ne vais pas entrer dans les détails techniques du fonctionnement du CORS ni souligner son importance ici. Si vous êtes intéressé par une compréhension approfondie de ce mécanisme, je vous invite à consulter mon article dédié au [CORS appliqué aux applications Node](https://boutdecode.fr/article/cors-avec-nodejs). Dans cet article, j'aborde en profondeur tous les aspects pertinents, fournissant ainsi une ressource complète sur le sujet.*

De nos jours, la majorité des développeurs sont au fait des principes de sécurité CORS, mais il arrive souvent que son implémentation soit effectuée de manière trop permissive. Pour administrer le CORS, l'entête HTTP `Access-Control-Allow-Origin` est utilisé pour spécifier une liste d'origines autorisées à interagir avec votre API.

```
# Allow any site to read the contents of this JavaScript library, so that subresource integrity works
Access-Control-Allow-Origin: https://random-dashboard.example.org
```

Cependant, il est également crucial de connaître les entêtes HTTP `Access-Control-Allow-Methods` et `Access-Control-Allow-Headers`. Ces derniers offrent la possibilité de limiter l'accès à certaines méthodes HTTP spécifiques et à certains en-têtes HTTP. Cela renforce le contrôle sur la manière dont vos API sont consommées. Bien que cette pratique puisse sembler fastidieuse pour une API publique, elle assure une sécurité accrue lorsque vos API sont destinées à être utilisées par un groupe restreint de clients fiables.
