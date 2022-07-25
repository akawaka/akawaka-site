---
layout: post
title: Voici un exemple d'article
image: /build/front/images/journal-test.jpg
alt: journal akawaka
subtitle: L'article pourra être présenté de cette manière
date:   2023-06-05 08:13:53 -0500
category: nom de la catégorie
author: Amel
---

# Qu'est-ce que Git ?

Git est un outil de "gestion de versions". Cela ne signifie par forcément grand chose à ce stade de la lecture mais c'est important pour la suite.
L'objectif d'un outil de gestion de versions est le suivant : permettre de gérer l'historique des modifications de fichiers et repertoires. C'est quelque chose de très important dans notre métier puisque c'est ce suivi de version qui nous permet de créer de nouvelles fonctionnalités, de
comprendre l'historique d'un fichier, de proposer des modifications, d'en annuler etc.

Sans gestion de versions, nous serions condamné à devoir tout mémoriser ou pire, à tout perdre.

En plus d'être un outil de gestion de versions, Git est un outil décentralisé. Cela veux dire qu'il est possible pour chaque dev d'utiliser Git dans son coin, via un système de branche, et de rassembler toutes les modifications en un point unique tout en gérant les éventuels conflits si le même code étaient modifié par deux personnes.

Bref, Git est un outil indispensable à connaitre

## 1. Comment démarrer ?

La première étape consiste à installer git sur son ordinateur. Il s'agit d'un programme avec lequel on peut interragir en ligne de commande ou via des applications graphiques.

Il faudra ensuite configurer git pour l'utiliser correctement.

```bash
git config --global user.name "John Doe"
git config --global user.email johndoe@example.com
```

Cette première partie consiste tout simplement à dire à Git comment est-ce que l'on s'appelle et comment nous contacter. Il faudra éviter de mettre
n'importe quoi car ces informations sont consultables dans l'historique de Git.

Viens ensuite la configuration de l'éditeur de texte à utiliser par défaut. Ici, on aime vim.

```
git config --global core.editor vim
```

Vous pouvez maintenant consulter la configuration de votre git avec la commande `git config --list`. Toute cette configuration se trouve
dans le fichier `~/.gitconfig`.

```bash
user.name=Jane Doe
user.email=jane@doe.com
core.excludesfile=~/.global_gitignore
init.defaultbranch=main
core.repositoryformatversion=0
core.filemode=true
core.bare=false
```
Un aperçu du fichier `gitconfig`.

```bash
[user]
        name = Jane Doe
        email = jane@doe.com
[core]
        excludesFile = ~/.global_gitignore
[init]
```

L'aide est quant à elle consultable avec la commande `git help config` ou `git <command> -h`.

## 2. Configuration supplémentaire

Git est installé mais il est possible de faire plus. Nous allons donc détailler les étapes supplémentaires à mener.

### a. Ajout d'un fichier gitignore global

Nous travaillons sur des systèmes avec des éditeurs de textes différents. Ces systèmes et ces éditeurs écrivent des fichiers qui nous sont personnels et que nous ne souhaitons pas nécessairement mélanger avec les autres mainteneurs du projet.

Il convient donc de configurer un fichier `.gitignore` global.

Pour ce faire, nous allons créer un fichier à la racine de notre utilisateur avec la commande `vim ~/.gitignore` et y intégrer le
contenu suivant :

```txt
.idea # repertoire créé par les IDE Jetbrains
.gitconfig # fichiers de configuration git locaux
*~ # fichiers temporaires
```

Enregistrez ce fichier en appuyant sur la touche `Esc`, puis saisissez `:` et `x` pour sauvegarder et quitter.

Petite aparté sur Vim : La différence entre `:x` et `:wq` est que `:x` n'enregistre les changements apportés au fichier que s'il a été modifié, tandis que `:wq` enregistre les modifications même si le fichier a été modifié entre temps.



Ajoutez le ensuite à la configuration git avec la commande `git config --global core.excludesFile '~/.gitignore'`.

## 3. Interagir avec Git

Les processus dont nous allons parler à présent ont pour objectif de pousser la qualité au maximum. La règle est donc simple : conformes toi y
en prenant l'habitude de tout le temps suivre ce mode de travail, seul ou en équipe. Dans le cas où tu arriverais sur un projet qui ne suis pas
ces process, n'hésites pas à en parler afin de faire au mieux ton travail de dév.

### a. Créer un nouveau repository

Tout commence avec la création d'un nouveau "repository" (un dépot) git. Il faut commencer par créer un nouveau repertoire dans votre dossier
de travail.

```bash
mkdir -p <mon projet>
```

Le repertoire créé existe sur votre ordinateur mais n'est pas encore un repository git. Il faut ajouter une nouvelle commande :

```bash
git init
```

Cette commande créera un dossier `.git` contenant des fichiers qui sont importants pour la suite. Il ne faudra jamais le supprimer.

### b. Copier un projet existant

Nous avons vu comment créer un projet "neuf", il faut maintenant voir comment copier un projet existant. Dans ce cas, il faudra utiliser
la commande `clone` qui a pour objectif de "dupliquer" un existant. Dans ce cas, il ne faut pas créer un répertoire puis executer une commande
mais se mettre dans un repertoire puis effectuer la commande suivante :

```bash
git clone <url> <nom du dossier>
# example git clone git@github.com:symfony/symfony.git
````

Le repertoire créé lors du clone aura pour nom (par défaut) le nom du repository. Dans notre exemple : `symfony`. Si l'on souhaite avoir
un nom différent, il faut effectuer la commande suivante :

```bash
git clone git@github.com:symfony/symfony.git MonProjet
```

### c. Ton premier changement

Tu as maintenant un projet git sur ton ordinateur. Si tout va bien, tu es actuellement sur une branche qui s'appelle `main`, si ta version de git est récente, ou `master`, si le projet a été créé depuis longtemps. Tu as bien lu, tu es sur "une branche" car il faut visualiser ton repository git comme un arbre ou encore une carte de métro. La branche correspond à la ligne de metro tandis que les stations correspondent à ce qu'on appelle des `commits`. En continuant l'analogie avec la carte de métro, des lignes peuvent être parallèles, avoir des stations en commun avec une station de départ et un terminus.

Tu es donc sur ta branche `main`. Tu le sais grâce à cette commande :

```bash
git branch --show-current
```

Tu peux maintenant créer un fichier avec la commande suivante :

```bash
touch test
```

Cette commande créé un fichier vide qui s'appelle test, tu peux le voir avec la commande :

```bash
ls -al
```
Cette commande te permet également de voir l'ensemble des fichiers et dossiers qui se trouvent à la racine de ton projet, y compris les fichiers cachés. On peut y voir aussi les droits d'accès de chaque fichier.

```bash
total 68
drwxr-xr-x  9 jane jane 4096  8 mars  19:46 .
drwx------ 30 jane jane 4096  9 mars  12:30 ..
-rwxr-xr-x  1 jane jane 1580  1 mars  17:43 configure
-rw-r--r--  1 jane jane  614  8 mars  16:02 docker-compose.override.yaml
-rw-r--r--  1 jane jane  491  8 mars  16:02 docker-compose.yaml
drwxr-xr-x  2 jane jane 4096  1 mars  17:43 docs
-rw-r--r--  1 jane jane  533  8 mars  16:02 .editorconfig
drwxr-xr-x  8 jane jane 4096  9 mars  11:58 .git
-rw-r--r--  1 jane jane  224  1 mars  17:43 .gitignore
drwxr-xr-x  2 jane jane 4096  9 mars  12:27 .idea
drwxr-xr-x  4 jane jane 4096  1 mars  17:43 infrastructure
-rw-r--r--  1 jane jane 1315  8 mars  16:02 Makefile
drwxr-xr-x  5 jane jane 4096  8 mars  16:03 public
-rw-r--r--  1 jane jane 2488  8 mars  19:46 README.md
-rw-r--r--  1 jane jane  272  1 mars  17:43 retype.yml
drwxr-xr-x  4 jane jane 4096  8 mars  19:46 src
drwxr-xr-x  2 jane jane 4096  1 mars  17:43 static
```

A ce stade, le fichier n'est toujours pas connu de git. Si tu avais créé ce fichier avec phpstorm, il t'aurais probablement proposé de l'ajouter
automatiquement mais tu es la pour apprendre, il n'y a donc pas de magie.

Tu peux maintenant utiliser la commande `git status` afin de voir ce que git a de beau à te dire. Il va te répondre la chose suivante "de nouveaux fichiers ont été créés, il faut maintenant que tu me dises quoi en faire".

```bash
Sur la branche main
Votre branche est à jour avec 'origin/main'.

Fichiers non suivis:
  (utilisez "git add <fichier>..." pour inclure dans ce qui sera validé)
        test

aucune modification ajoutée à la validation mais des fichiers non suivis sont présents (utilisez "git add" pour les suivre)
```

A ce stade il est important de signaler la chose suivante : git est un outil formidable qui t'accompagnes au fur et à mesure, il est très important de lire ce genre de messages. Avec `status` git peut te proposer jusqu'à 3 actions différentes afin de choisir oui ou non tu souhaites ajouter un fichier à l'historique git, le supprimer d'un ajout en cours ou tout simplement de ne pas le prendre en compte.

```bash
Sur la branche main
Votre branche est à jour avec 'origin/main'.

Modifications qui ne seront pas validées :
  (utilisez "git add <fichier>..." pour mettre à jour ce qui sera validé)
  (utilisez "git restore <fichier>..." pour annuler les modifications dans le répertoire de travail)
        modifié:         test
```


Ce que nous voyons actuellement donc, c'est que git sait qu'il est entrain de se passer quelque chose mais il ne sait pas quoi en faire. Il faut donc lui dire quoi faire. Nous allons utiliser la commande `add`.

```bash
git add test
```

Il existe plusieurs moyens d'ajouter des fichiers :

- en spécifiant le nom du fichier ou le repertoire (comme l'exemple ci-dessus),
- en ajoutant tous les fichiers `git add .`
- en ajoutant une portion d'un fichier `git add test -p`

Tu seras amené à utiliser ces trois façons de travailler dans ta carrière. N'hésites donc pas à tout essayer.

Tu as maintenant dit à git "prends en compte ce fichier" mais ce n'est pas terminé, il faut maintenant créer ton `commit`, c'est à dire un point d'historique ou plus simplement "une station de métro" si tu suis l'analogie de la carte de transport. Tu utilises donc cette commande :

```bash
git commit -m "Nouveau fichier test pour ma formation"
```

And voilà! Tu as créé un nouveau commit. Si tu utilises la commande `git status` à nouveau, tu ne verras qu'il n'y a plus rien à faire.

```bash
Sur la branche main
Votre branche est à jour avec 'origin/main'.

rien à valider, la copie de travail est propre
```

La commande
`git log` te permertra quand à elle de voir le commit que tu viens de faire.

```bash
commit b009239d3040c0934c1c813633e381d540a7b521 (HEAD -> main, origin/main, origin/HEAD)
Merge: 1f0bd7d 700cd32
Author: Jane Doe <jane@doe.com>
Date:   Tue Mar 8 15:12:11 2022 +0000

    Nouveau fichier test pour ma formation
```


### d. Ton second changement

Tu as maintenant créé un fichier, faisons simple et modifions le contenu de ce fichier :

```bash
vim test
# une fenetre s'ouvre, appuie sur "i" de ton clavier
# ajoute du texte
# enregistre le fichier en faisant l'action suivante "<echap>" puis ":wq" ou ":x"
# la fenetre se ferme
```

`git status` t'indique une modification du fichier, il faut maintenant faire la même opération que précedemment :

```bash
git add test
git commit -m "changement"
```

Tu verras alors deux commits avec la commande `git log`

### e. Modification du commit

Malheureusement pour toi, "changement" ne veux rien dire. Un commit doit avoir une valeur pour l'historique, il faut donc que le message soit cohérent. Tu peux changer ce message de deux manière, tout d'abord avec amend :

```bash
git commit --amend
```

Cette action ouvrira le dernier commit et te proposera de faire ta modification de texte.

```bash
Changement

# Veuillez saisir le message de validation pour vos modifications. Les lignes
# commençant par '#' seront ignorées, et un message vide abandonne la validation.
#
# Date :       Tue Mar 8 20:06:38 2022 +0100
#
# Sur la branche main
# Votre branche est à jour avec 'origin/main'.
#
# Modifications qui seront validées :
#       modifié :         test
#
# Modifications qui ne seront pas validées :
#       modifié :         test
#


```

L'opération est la même que celle de ton second changement, ton éditeur par défaut configuré est `vim`, il faut appuyer sur i, faire le changement, appuyer sur echap et enregistrer puis quitter.

La seconde possibilité consiste à utiliser la commande `rebase`, si tout va bien ça devrait devenir l'une de tes commandes préférées.

```bash
git rebase -i HEAD~1
```

OULA!

La commande est complexe, une fenêtre c'est ouverte, elle te propose de faire plein de choses.

```bash
pick b724629 Changement

# Rebasage de b009239..b724629 sur b009239 (1 commande)
#
# Commandes :
#  p, pick <commit> = utiliser le commit
#  r, reword <commit> = utiliser le commit, mais reformuler son message
#  e, edit <commit> = utiliser le commit, mais s'arrêter pour le modifier
#  s, squash <commit> = utiliser le commit, mais le fusionner avec le précédent
#  f, fixup [-C | -c] <commit> = comme "squash", mais en ne gardant que le message
#                     du commit précédent, à moins que -C ne soit utilisé, auquel cas, conserver
#                     ne conserver que le message de ce commit ; -c est identique à -C mais ouvre
#                     un éditeur
#  x, exec <commit> = lancer la commande (reste de la ligne) dans un shell
#  b, break = s'arrêter ici (on peut continuer ensuite avec 'git rebase --continue')
#  d, drop <commit> = supprimer le commit
#  l, label <label> = étiqueter la HEAD courante avec un nom
#  t, reset <label> = réinitialiser HEAD à label
#  m, merge [-C <commit> | -c <commit>] <label> [# <uniligne>]
#          créer un commit de fusion utilisant le message de fusion original
#          (ou l'uniligne, si aucun commit de fusion n'a été spécifié).
#          Utilisez -c <commit> pour reformuler le message de validation.
#
# Vous pouvez réordonner ces lignes ; elles sont exécutées de haut en bas.
#
# Si vous éliminez une ligne ici, LE COMMIT CORRESPONDANT SERA PERDU.
#
# Cependant, si vous effacez tout, le rebasage sera annulé.
#

```

Voyons ça en détail.

La commande `rebase` permet de :

1. Modifier le message d'un ou plusieurs commits
2. Fusionner des commits entre eux

Entre autre le `rebase` permet de réécrire l'historique des commits. Nous nous attarderons ici sur la première partie "Modifier le nom d'un ou plusieurs commits".

Pour modifier le message d'un commit, il faudra utiliser la commande `reword` ou `edit`. Une de ces deux commandes devra être écrite à l'emplacement de `pick` sur la capture d'écran ci-dessus.

Si tu as un doute, ne t'inquiète pas, git explique de façon ludique à quoi correspond chaque commande du `rebase`.

## Interagir avec Git en équipe

Tu sais maintenant manipuler les commandes de bases git mais tu ne connais pas encore les process d'équipe qui vont autour de tout ça.

Dans une premier temps, tu utiliseras rarement `git` seul. Comme expliqué au début du texte, tu travailleras probablement en équipe, avec des outils tels que Github ou Gitlab qui permettent de visualiser le travail, de faire des commentaires, de déclencher des outils tiers, etc. Il faut donc
que tu connaisses ces outils un minimum.

### a. L'arrivée sur un projet

L'une des premières questions à poser lorsque tu arrives sur un projet est celle du "flow". Le "flow", c'est la façon dont tu vas interragir avec git et la façon dont ton travail va être validé. Le "flow" est important car c'est une règle intrasèque qui permet à tout le monde de se comprendre.

Dans ces règles il y a au minimum :

- la création d'issues,
- les pull/merge request,
- les conventions de nommages

Ce que tu vas apprendre ici, c'est le process ideal, celui que tu devrais tout le temps suivre et qui te permettra d'atteindre le plus haut niveau de qualité.

### b. La création d'issues

Une issue c'est un ticket qui détaille pourquoi est-ce que l'on fait un changement, qui donne une cause et une conséquence. Il faudra toujours créer
des issues avant de commencer à travailler sur une PR/MR

Une issue est composée d'un titre et d'un contenu. Le contenu de ces issues découle de la demande des personnes qui représente ce que l'on appelle "le métier". Le "métier" peut être incarné par le client, un chef de projet, un product owner...

La description doit être précise. On ne fait pas la "création d'un site", on créé la page d'accueil d'un site, une page de contenu, un pied de page, etc. Plus les issues sont petites et précises, plus ton travail est facilité, plus tu peux avancer, plus tu peux te permettre d'attendre un retour, etc. C'est un vrai travail de créer de petites issues, aussi bien avec le client, qu'en terme de rigueur personnelle.

Chaque issue qui a été créé est associé à un identfiant. Cet identifiant est important pour la suite et le prendre en compte te permettra des croisements d'informations dans le futur. D'ailleurs, tu parleras souvent à l'oral "du ticket 120" par exemple.

### c. La création d'une Pull Request ou Merge Request

Avant de commencer, nous parlerons ici et à partir de maintenant uniquement de Pull Request. Gitlab utilise la notion de Merge Request mais le commun des dévelopeurs parle bien de Pull Request et donc de PR.

Une fois que tes issues ont été crées, on va t'assigner du travail. Il faut commencer par créer une PR. Tu as deux possibilités :

- Créer ta PR via l'interface graphique puis suivre les indications pour récupérer la branche correspondante,
- Créer une branche sur ta machine puis l'envoyer sur Github/Gitlab et ouvrir une PR

Ce qui est sur c'est que tu vas toujours effectuer cette opération avant de commencer à réellement coder. Pourquoi ? Parce que c'est une bonne pratique
qui permet de dire à tout le monde "regardez, mon travail est en cours, nous pouvons en discuter à tout moment". Au moment de créer la PR, tu lui donneras un titre et un contenu. A ce stade le titre ressemblera à "Draft: <nom du ticket>" et le contenu "Prise en compte de l'issue #<identifiant>".

L'information "Draft" est importante, elle permet de dire aux autres "regardez, il s'agit d'un travail en cours, ne passez pas forcément du temps à analyser le contenu pour le moment" et elle te protège au cas où une personne arriverait pour commencer à analyser ton travail car tu pourras lui répondre "Regarde, mon travail est en cours, je note tes commentaires mais je n'ai aucune obligation de les prendre en compte à ce stade".

Tu vas ensuite commencer à travailler, enchainer les commits, manipuler ton historique et lorsque tu auras terminé, tu enlèveras l'information "Draft" qui permettra de passer l'information "vous pouvez regarder mon code". Dans le cas où tu travaillerais seul-e, n'hésites pas à laisser un peu de temps afin de toi même relire ta PR avant de la valider. Arriver "à froid" en relecture est le meilleur moyen de se rendre compte de ces erreurs.

Dans un contexte équipe, on pourra te demander de notifier des "reviewers", d'attendre que ta PR soit approuvée etc.

Interesses toi maintenant au contenu de ta PR. Si tu as respecté toutes les règles, elle devra s'occuper d'un ticket précis mais tu peux peut-être avoir fait 10 commits pour assurer ce besoin. Il est maintenant important de parler qualité.

Une application doit pouvoir être fonctionnelle avant et après une Pull Request. Cette Pull Request doit donc être documenté en conséquence. Si il y a des opérations à faire pour intégrer ton code, elles doivent être précisées via une procédure dans la description de la PR mais il y a également un autre point : il peut y avoir une erreur. Pas forcément une erreur qui vienne de toi, le ticket peut avoir été mal spécifié, il peut y avoir un dommage colatéral qui n'a pas été clairement identifié, une regression, etc. Il doit donc être possible de revenir en arrière. Tu utiliseras à ce moment là, la commande `revert` de git et il y a possiblement un problème : il faut savoir sur quoi il faut revenir en arrière.

C'est pour cette raison que dans un contexte profesionnel, on fera toujours en sorte d'avoir le moins de commits possible au moment ou ta PR sera validée. Il est donc plus que conseillé d'utiliser la commande `rebase` afin de rassembler tous tes commits en un seul. Gitlab et Github propose de faire ça automatiquement mais nous non, parce que nous souhaitons que tu maitrises réellement tes outils. C'est pourquoi nous te demanderons de toujours faire un rebase pour réécrire l'histoire afin de n'avoir qu'un seul commit ou du moins le minimum de commits.

Il existe d'autres règles d'hygiènes et de qualité qui vont dans ce sens dans le but de diminuer la possibilité de créer des "conflits", c'est pourquoi
il est une fois de plus important de bien s'assurer des règles en vigueur sur le projet dans lequel on évolue.

### d. Les conventions de nommages


Dernier point important, les conventions de nommages. Ces conventions portent sur :

- le nom des branches,
- le contenu des messages de commits.

Il existe beaucoup de règles possible dont voici la base :

- la branche principe s'appelle main ou master,
- une branche de preprod peut être existante, les PR devront donc cibler cette branche,
- les nouvelles fonctionnalités sont prefixées par feature dans le nom de la branche,
- les correctifs sont préfixés par fix dans le nom de la branche,
- le premier commit doit indiquer l'identifiant du ticket.



## Ce que tu n'as pas encore vu

- Tu ne sais pas comment manipuler un remote : `git remote`
- Tu ne sais pas vraiment encore manipuler ton histoire : `git rebase`
- Tu ne connais pas le système de branche : `git branch`
