---
layout: post
title: Sécurisons nos utilisateurs avec Mozilla Observatory partie 3 - Cookie et Subresource Integrity
image: /build/front/images/blog/mozilla-observatory-cookies-subresource-integrity.png
alt: logo Mozilla Observatory
date: 2024-02-09 10:00:00
date_modified: 2024-02-09 10:00:00
category: outils
author: Équipe AKAWAKA
---

Cet article fait partie d’une suite d’articles sur les directives testés par Mozilla Observatory, vous pouvez retrouver notre précédent article sur [X-Frame-Options et Cors](https://www.akawaka.fr/blog/outils/securisons-nos-utilisateurs-avec-mozilla-observatory-x-frame-options-cors.html).

On continue notre exploration avec deux nouveaux tests très importants, car axés sur le vol de données et l’injection de script malveillant.

### Cookies

Les cookies sont partout, lorsqu’ils ne servent pas à tracker les utilisateurs, ils sont utilisés pour persister une connexion à un service. Et c’est pour cette utilisation que les hackers souhaitent les récupérer à l’insu des utilisateurs.

Lorsque mal configuré, un cookie est accessible directement depuis un script Javascript via document.cookie. Imaginons donc qu'une personne arrive à introduire un script malveillant sur votre site - nous verrons comment plus loin - il lui serait parfaitement possible de récupérer les cookies d'un utilisateur et d'usurper sa connexion.

Heureusement, les cookies ont des options de configuration qui permettent de les rendre plus sécurisés.

Lorsqu’on crée un cookie, on peut lui associer des options :

- `Secure` : Permet de limiter l’utilisation du cookie que sur des requêtes HTTPS.
- `HttpOnly` : Permet d’interdire la lecture des cookies en dehors des requêtes HTTP, cela bloquera donc sa lecture dans un script JavaScript.
- `Expires` : Permet de définir la date d’expiration du cookie, cela évite d’avoir des sessions ouvertes à l’infini (et donc être vulnérable dans le temps).
- `Max-Age` : Même chose que Expires, mais exprimé en secondes relatives a la date de création du cookie.
- `Domain` : Permet de limiter l’utilisation d’un cookie à un domaine spécifique, inutile de rendre votre cookie session disponible sur d’autres sites.
- `Path` : Permet de limiter le cookie à un certain niveau d’URL de votre site, par exemple limiter son utilisation à `/admin`.
- `SameSite` : Permet de limiter l’utilisation de cookie lorsqu’on fait appel à des ressources extérieures au site (par exemple via une balise <img>). Cela permet d’éviter qu’un cookie utilisateur soit transmis par défaut aux requêtes de chargements de média. Très utile pour se protéger des [attaques CSRF](https://infosec.mozilla.org/guidelines/web_security#csrf-prevention). Deux valeurs sont possibles : `Strict` Le navigateur envoie uniquement le cookie pour les requêtes vers le même site d'origine du cookie. `Lax` le navigateur envoie également le cookie lorsque la personne *navigue* vers le site d'origine du cookie (même si elle vient d'un site différent), par exemple lorsqu'elle suit un lien depuis un site externe.

Il est également possible de préfixer le nom des cookies pour ajouter une couche de sécurité et éviter par exemple leur surcharge.

- `__Host-` : À utiliser pour tous les cookies nécessaires uniquement sur un domaine spécifique (pas de sous-domaines) où `Path` est défini sur /.
- `__Secure-` : À utiliser pour tous les autres cookies envoyés depuis des origines sécurisées (telles que HTTPS).

Comme d’habitude, Mozilla ajoute des exemples que vous retrouverez sur leur [documentation](https://infosec.mozilla.org/guidelines/web_security#cookies) :

```
# Cookie d'identifiant de session accessible uniquement sur cet hôte qui est purgé lorsque l'utilisateur ferme son navigateur
Set-Cookie: MOZSESSIONID=980e5da39d4b472b9f504cac9; Path=/; Secure; HttpOnly

# Identifiant de session pour tous les sites example.org qui expire dans 30 jours en utilisant le préfixe __Secure-
# Ce cookie n'est pas envoyé d'origine croisée, mais est envoyé lors de la navigation vers un site Mozilla à partir d'un autre site
Set-Cookie: __Secure-MOZSESSIONID=7307d70a86bd4ab5a00499762; Max-Age=2592000; Domain=example.org; Path=/; Secure; HttpOnly; SameSite=Lax

# Définit un cookie de longue durée pour l'hôte actuel, accessible par Javascript, lorsque l'utilisateur accepte les ToS
# Ce cookie est envoyé lors de la navigation vers votre site, envoyé depuis un autre site, par exemple en cliquant sur un lien
Set-Cookie: __Host-ACCEPTEDTOS=true; Expires=Fri, 31 Dec 9999 23:59:59 GMT; Path=/; Secure; SameSite=Lax

# Identifiant de session utilisé pour un site sécurisé, tel que bugzilla.example.org. Il n'est pas envoyé depuis une origine croisée
# requêtes, et elles ne sont pas non plus envoyées lors de la navigation vers bugzilla.example.org depuis un autre site. Utilisé conjointement avec autres mesures anti-CSRF, c'est un moyen très efficace de défendre votre site contre les attaques CSRF.
Set-Cookie: __Host-BMOSESSIONID=YnVnemlsbGE=; Max-Age=2592000; Path=/; Secure; HttpOnly; SameSite=Strict
```

Aujourd’hui, la plupart des frameworks modernes fait le minimum pour rendre vos cookies sécurisé, mais il peut être intéressant de regarder plus en détails la configuration des cookies de vos applications.

### Subresource Integrity

Comme on l’a vu plus haut, pour pouvoir voler un cookie, il faut avoir réussi à injecter du code malveillant sur un site. Il existe plein de techniques différentes pour ce faire, dont la plupart peuvent être contrées via des mesures de sécurité directement dans le code de votre application.

Mais il existe une autre manière d’injecter du code malveillant, indépendamment de votre volonté, celle d’introduire du code depuis une source externe que vous utilisez sur votre site. Cela peut être fait par exemple en voulant charger une libraire JavaScript depuis un CDN.

Lorsqu’on souhaite charger une librairie externe depuis un CDN via la balise <script>, il est possible d’ajouter deux attributs pour renforcer la sécurité.

- `integrity` : Permet de définir un hash qui est la signature du fichier que vous recevez. Le navigateur va générer sa propre signature lors de la réception du fichier, et s’il constate une différence, il va bloquer le chargement de cette ressource. La plupart des CDN vous fournissent le hash de la libraire que vous souhaitez utiliser.
- `crossorigin` : Attend la valeur `anonymous` spécifiant au navigateur de faire une requête anonyme, sans cookie.

```
<!-- Chargement de jQuery 4.0.0 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0-beta/jquery.js" 
integrity="sha512-5DIV4rFAkqgNzEqQuiczycmrnUZW8/+Gj7Dbhc5Ga6UYMPMV3CeSnMO6f0xy9G9kSgd1buwT6WlFS5VO7ATNDQ==" 
crossorigin="anonymous"></script>
```

Vous pouvez générer vous-même votre hash depuis une source de confiance :

```
$ curl -s https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0-beta/jquery.js | \
    openssl dgst -sha384 -binary | \
    openssl base64 -A
```

Il n’est pas toujours possible d’avoir la main sur les chargements de librairies externes, surtout lorsqu’on utilise des solutions comme NextJs ou NuxtJs qui chargent automatiquement des ressources. Des solutions existent tout de même qui sortent du cadre de cet article. Je vous propose de voir la conférence d'[Antoine Caron](https://twitter.com/Slashgear_) qui donne des pistes :

[https://www.lyonjs.org/evenement/90-webassembly-and-mozilla-observatory-e_298162224](https://www.lyonjs.org/evenement/90-webassembly-and-mozilla-observatory-e_298162224)

### **X-Content-Type-Options**

Directive bonus qui permet d’éviter le comportement par défaut des navigateurs qui essaye de deviner le type mime d’un fichier. Cela évite à votre navigateur d’exécuter du script contenu dans une image, car il a détecté que c’était en réalité du JavaScript.

```
# Empêcher les navigateurs de détecter incorrectement les non-scripts en tant que scripts
X-Content-Type-Options: nosniff
```

Le prochain article sera le dernier et nous verrons la directive **Content Security Policy**, un gros morceau. Elle permet de défini très finement les actions possibles sur un site. Par exemple, interdire le chargement de ressources en HTTP.
