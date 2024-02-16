---
layout: post
title: Sécurisons nos utilisateurs avec Mozilla Observatory partie 4 - Content Security Policy
image: /build/front/images/blog/mozilla-observatory-content-security-policy.png
alt: logo Mozilla Observatory
date: 2024-02-16 10:00:00
date_modified: 2024-02-16 10:00:00
category: outils
author: Équipe AKAWAKA
---

Cet article est le dernier d’une série sur les directives testées par Mozilla Observatory, vous pouvez retrouver notre précédent article sur les [Cookies et Subresource Integrity.](https://www.akawaka.fr/blog/outils/securisons-nos-utilisateurs-avec-mozilla-observatory-cookies-subresource-integrity.html)

Nous voici à présent face à la dernière directive majeure évaluée par Mozilla Observatory. Cette directive revêt une importance capitale, car elle a un impact majeur sur les fonctionnalités accessibles à vos utilisateurs sur votre site. Par défaut, le navigateur est configuré pour permettre toutes les actions, ce qui expose votre site à de nombreuses possibilités d'attaques. Nous allons voir ensemble comment restreindre de manière judicieuse ces possibilités afin de protéger vos utilisateurs.

### **Content Security Policy**

Le CSP est un entête HTTP qui permet de définir ce qu’il est possible de faire ou non sur votre site. S’il est possible par exemple de charger des ressources extérieures comme des images, des scripts etc. S’il est possible de charger des ressources avec HTTP, la version non sécurisée du protocole. Ou encore s’il est possible d’afficher des Iframe.

Vous l’avez compris, cette directive permet de verrouiller très finement votre site et éviter toute attaque XSS, c'est-à-dire des attaques via exécution de script malveillant provenant de l’extérieur. Bien entendu, cette directive est aussi à définir intelligemment, étant très puissante, mal utilisée, elle peut rendre vote site complètement inutilisable pour vos utilisateurs.

Elle doit donc être définie au cas par cas, par exemple si votre application est une API, il n'est effectivement pas utile de permettre à vos utilisateurs d’afficher des Iframe.

La directive **Content Security Policy** est une suite de cible accompagnée d’une règle de permission.

```
# Désactive l'execution de script en inline/eval non sécurisé, charge uniquement les images de la même origine, mais autorise également les images d'imgur
Content-Security-Policy: default-src 'self'; img-src 'self' https://i.imgur.com;
```

Mozilla, dans sa documentation, donne des premiers conseils pour implémenter correctement la directive.

- La première règle à ajouter est `default-src https:` qui permet de désactiver l’exécution de scripte et style directement dans le code et force le chargement des ressources en HTTPS uniquement.
- Désactiver l’exécution de scripte ou style depuis le code peut être contraignant sur des sites existants et peut potentiellement casser votre site. `default-src https: 'unsafe-inline'` permet de forcer le chargement des ressources en HTTPS tout en autorisant les scripts et style directement dans le code.
- Ensuite, on peut autoriser seulement le chargement des ressources image, scripte et style que depuis le même domaine ou sur certains domaines avec `default-src 'none'; img-src 'self'; script-src 'self'; style-src 'self'`.
- Les ressources de plugin telles que Flash ou Silverlight devraient être interdites si non nécessaires avec `object-src 'none'`.

Vous pouvez retrouver toutes les recommandations de Mozilla sur leur [documentation de CSP](https://infosec.mozilla.org/guidelines/web_security#content-security-policy).

```
# Désactive l'exécution inline/eval non sécurisé, autorise uniquement le chargement de ressources (images, polices, scripts, etc.) via https
Content-Security-Policy: default-src https:

# Désactive l'exécution inline/eval non sécurisés, autorise tout le reste sauf l'exécution du plugin
Content-Security-Policy: default-src *; object-src 'none'

# Désactive l'exécution inline/eval non sécurisée, charge uniquement les ressources de la même origine, mais autorise également les images d'imgur
# Désactive l'exécution des plugins
Content-Security-Policy: default-src 'self'; img-src 'self' https://i.imgur.com; object-src 'none'

# Désactive l'exécution inline/eval et les plugins non sécurisés, charge uniquement les scriptes et les feuilles de style de la même origine, les polices de Google,
# et images de même origine et imgur. Les sites devraient viser des politiques comme celle-ci.
Content-Security-Policy: default-src 'none'; font-src https://fonts.gstatic.com;
			 img-src 'self' https://i.imgur.com; object-src 'none'; script-src 'self'; style-src 'self'

# Site préexistant qui utilise trop de code en ligne à corriger
# mais veut s'assurer que les ressources sont chargées uniquement via https, tout en désactivant les plugins
Content-Security-Policy: default-src https: 'unsafe-eval' 'unsafe-inline'; object-src 'none'

# Ne pas encore mettre en œuvre la politique; au lieu de cela, signale simplement les violations qui auraient eu lieu via l'url /csp-violation-report-endpoint/
# Utile lorsqu'on n'est pas sur d'une règle et qu'on veut mesurer son impact
Content-Security-Policy-Report-Only: default-src https:; report-uri /csp-violation-report-endpoint/

# Désactive le chargement de toutes les ressources et désactive les iframes, recommandé pour les API
Content-Security-Policy: default-src 'none'; frame-ancestors 'none'
```

### En vrac

**Referrer Policy** est un entête HTTP qui permet de gérer la traçabilité d'où provient un visiteur. Par défaut, lors d’une visite d’un lien, la requête HTTP possède l’information d'où provient le visiteur, cela peut être depuis un moteur de recherche, un réseau social ou tout simplement d’un autre site. Avec cette directive, on peut redonner de l’anonymat aux utilisateurs. Elle possède plusieurs valeurs possibles :

- `no-referrer` : On demande à ne jamais fournir l’information de provenance.
- `same-origin` : On demande à fournir l’information de provenance seulement si elle est du même domaine.
- `strict-origin` : Même chose que `same-origin`, mais on ne fournit pas le chemin de l’URL, c'est-à-dire qu’on ne communique que le nom de domaine.
- `strict-origin-when-cross-origin` : Envoyer la provenance complète si depuis la même origine, sinon URL sans le chemin sur les origines étrangères.

```
# Sur example.com, envoi uniquement l'en-tête Referer vers d'autres ressources example.com
Referrer-Policy: same-origin

# Envoi uniquement le référent abrégé vers une origine étrangère, le référent complet vers un hôte local
Referrer-Policy: strict-origin-when-cross-origin

# Désactive les référents pour les navigateurs qui ne prennent pas en charge l'origine stricte lorsque l'origine est croisée
# Utilise strict-origin-when-cross-origin pour les navigateurs qui le font
Referrer-Policy: no-referrer, strict-origin-when-cross-origin

<!-- Faites pareil, mais avec une balise méta -->
<meta http-equiv="Referrer-Policy" content="no-referrer, strict-origin-when-cross-origin">

<!-- Faites de même, mais uniquement pour un seul lien -->
<a href="https://example.org/" referrerpolicy="no-referrer, strict-origin-when-cross-origin">
```

**X-XSS-Protection**, ancêtre de la directive Content-Security-Policy, plus utilisé aujourd’hui sur les navigateurs modernes, elle peut toutefois être utile pour de la rétrocompatibilité avec d’anciens navigateurs.

Voilà qui clôture notre tour de l’outil Observatory de Mozilla. Chez Akawaka, nous sommes convaincus de son importance pour sécuriser nos utilisateurs. Cet outil fait partie de nos nombreux points de contrôle lors de nos audits.
