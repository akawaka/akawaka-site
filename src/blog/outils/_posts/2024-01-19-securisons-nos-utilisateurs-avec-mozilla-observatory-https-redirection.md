---
layout: post
title: Sécurisons nos utilisateurs avec Mozilla Observatory - HTTPS et redirection
image: /build/front/images/blog/mozilla-observatory-https-redirection.png
alt: logo Mozilla Observatory
date: 2024-01-22 10:00:00
date_modified: 2024-01-22 10:00:00
category: outils
author: Équipe AKAWAKA
---

Nous avons eu la chance d'assister, lors d’un Meetup de LyonJs, à la conférence d'[Antoine Caron](https://twitter.com/Slashgear_) sur l'outil Mozilla Observatory. Il dresse un constat intéressant : pourquoi avons-nous tendance à croire que nous sommes en sécurité sur Internet, alors que les navigateurs pourraient être comparés, selon lui, à *des coffres-forts dont la porte serait grande ouverte* ? Ainsi, nos utilisateurs ne sont pas à l'abri tant que les navigateurs leur permettent d'être la cible d'attaques, telles que le vol de session via un lien dissimulant une injection de script JavaScript.

Pour sensibiliser aux risques de ces attaques potentielles, Mozilla a mis au point un outil permettant d'analyser les failles de sécurité éventuelles d'un site tout en fournissant des conseils de correction. En tant que développeurs d'applications, il nous incombe de protéger nos utilisateurs en installant les bons mécanismes de verrouillage pour refermer cette porte.

## Mozilla Observatory

Dans cette série d’articles, nous allons voir les principales erreurs que peut remonter l’outil Mozilla Observatory, les comprendre et voir comment les corriger.

Lorsqu’on arrive sur le site [https://observatory.mozilla.org/](https://observatory.mozilla.org/) on nous invite à rentrer l’URL du site que l’on souhaite analyse, essayons donc avec akawaka.fr

![Résultat d’analyse de Mozilla Observability sur akawaka.fr](/build/front/images/blog/mozilla-observatory-akawaka.png)

Résultat d’analyse de Mozilla Observability sur akawaka.fr

On obtient une note de D, sachant que la pire note étant F. Ce qui est bien, mais pas top ! En regardant la fiche de résultat, on remarque trois sections.

La première en haut à gauche nous donne des infos sur la notation du site, on remarque ici un score de 35/100 avec 6 tests passés sur 11. Sachez également que par défaut, votre analyse sera conservée dans les statistiques publiques de Mozilla.

La deuxième section en haut à droite nous donne en recommandation la règle la plus urgente à corriger. Ici Mozilla Observatory nous conseille d’ajouter l’entête `X-Frame-Options` avant toute chose.

Enfin, la troisième section liste toutes les règles évaluées pas Mozilla Observatory sur notre site, ainsi que si on passe le test ou non et son score.

### HTTPS et redirection

Si aujourd’hui le sujet de mettre HTTPS ou non sur un site est devenu un non sujet avec l’arrivée de [Let’s Encrypt](https://letsencrypt.org/) et surtout de la gratuité des certificats. Encore faut-il correctement configurer la redirection pour ne pas laisser les visiteurs accéder au site sous HTTP.

Pour chaque règle, Mozilla nous fournit un lien vers leur documentation avec une explication de la règle évaluée, ainsi que des éléments de réponses pour corriger. 

Dans le cas de la règle [Redirection](https://infosec.mozilla.org/guidelines/web_security#http-redirections), la documentation nous dit qu’un site doit être disponible via le protocole HTTPS et que tout accès au site via le protocole non sécurisé HTTP doit être redirigé vers sa version sécurisée. Pour ce faire, c’est au niveau de la configuration du serveur HTTP que cela se passe et Mozilla nous fournit un exemple pour les deux principales solutions, Nginx et Apache.

```
# Redirect all incoming http requests to the same site and URI on https, using nginx
server {
  listen 80;

  return 301 https://$host$request_uri;
}
```

```
# Redirect for site.example.org from http to https, using Apache
<VirtualHost *:80>
  ServerName site.example.org
  Redirect permanent / https://site.example.org/
</VirtualHost>
```

Si cette règle est plutôt bien connue de la majorité, la suivante l’est un peu moins.

[HTTP Strict Transport Security](https://infosec.mozilla.org/guidelines/web_security#http-strict-transport-security), cet entête HTTP, permet de dire au navigateur que la prochaine fois qu’il se connectera au site avec le protocole HTTP, pas besoin d’initié la requête, il doit passer directement sur le protocole HTTPS. Sachez également que cet entête force le navigateur à être plus stricte sur les erreurs TLS et d’interdire un utilisateur d’ignorer ces erreurs. *Par exemple via une page sensibilisant l’utilisateur qu’il prend un risque s’il continue sur ce site alors que le certificat semble erroné.*

Cet entête possède 3 paramètres :

`max-age` : Défini le temps en seconde durant lequel le navigateur effectue la redirection automatiquement.

`includeSubDomains` (optionnel) : Défini que la règle s’applique également aux sous domaines du domaine courent, par exemple pour [domain.example.com](http://domain.example.com), la redirection en HTTPS sera également faite sur [host1.domain.example.com](http://host1.domain.example.com), [host2.domain.example.co](http://host2.domain.example.co)m, etc.

`preload` (optionnel) : Ce paramètre permet d’inscrire notre site dans la “Preload HSTS list”. C’est une liste, initialement faite pour Chrome, regroupant tous les sites définissant l’entête HSTS et donc certifiant que son site est bien disponible en HTTPS. Aujourd’hui la majorité des navigateurs regarde dans cette liste pour savoir si un site est bien accessible en HTTPS. Vous pouvez ajouter le vôtre manuellement via le site [https://hstspreload.org/](https://hstspreload.org/), ou ajouter l’option `preload`.

Enfin, Mozilla nous donne quelques exemples pour illustrer cet entête.

```
# Only connect to this site via HTTPS for the two years (recommended)
Strict-Transport-Security: max-age=63072000

# Only connect to this site and subdomains via HTTPS for the next two years and also include in the preload list
Strict-Transport-Security: max-age=63072000; includeSubDomains; preload
```

Nous verrons la suite des règles dans nos prochains articles, les attaques concernées et comment s’en prémunir. 

Chez Akawaka, nous sommes fermement convaincus de la valeur de l'outil Mozilla Observatory. C'est pourquoi il est désormais intégré à nos nombreux points de contrôle en plus de la qualité et des bonnes pratiques du code de votre application, l'outillage de votre environnement de développement, les processus d'intégration et de déploiement continu, et bien d'autres aspects.

N'hésitez pas à nous contacter si votre site obtient une note défavorable. Nous serons ravis de vous accompagner, que ce soit pour la mise en œuvre ou pour des conseils, afin d'améliorer la sécurité de votre plateforme.
