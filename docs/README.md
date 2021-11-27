# SQL - TP / ÉVALUATION

Pour notre association et dans le but de mieux gérer nos groupes de soirées jeux de société, nous souhaitons mettre en place une application web permettant de recencer nos licenciés ainsi que les jeux qu'ils possèdent. Nous voulons pouvoir ajouter des membres de l'association ainsi que des jeux mais aussi pouvoir associer ces derniers aux utilisateurs afin de savoir qui possède quel jeu et donc de mieux gérer les soirées jeux.

## 1 - MISE EN PLACE DE LA BASE DE DONNÉES

- base de données 'formation_sql_tp'
- table 'utilisateur' :
    - id_utilisateur (int, PK, AI)
    - email (varchar, UQ)
    - pseudo (varchar)
- table 'jeu' :
    - id_jeu (int, PK, AI)
    - categorie (varchar)
    - editeur (varchar)
    - nom (varchar)
    - joueurs_min (int, null)
    - joueurs_max (int, null)
    - duree (time, null)
    - age_minimum (int, null)
- association_utilisateur_jeu :
    - id_association (int, PK, AI)
    - id_utilisateur (int, FK)
    - id_jeu (int, FK)

## 2 - CREATE

- mettre en place un menu pour accéder aux affichages suivants : utilisateur, jeu, association_utilisateur_jeu
- créer un formulaire pour chaque entité
- réaliser les contrôles de saisie (informations indispensables)
- enregistrer les données suivantes dans les tables correspondantes :

    utilisateur
    +----------------+---------------------------+---------+
    | id_utilisateur | email                     | pseudo  |
    +----------------+---------------------------+---------+
    |              1 | clement.tine@gmail.com    | clem    |
    |              2 | jean.nemar@laposte.net    | jean-ti |
    |              3 | louis.fine@gmail.com      | loulou  |
    |              4 | alain.tuission@orange.fr  | al-1    |
    |              5 | jerry.guolay@gmail.com    | riri    |
    |              6 | serge.ouin@gmail.com      | labarbe |
    |              7 | yves.remord@yahoo.fr      | sevy    |
    |              8 | thomas.toketchup@yahoo.fr | toto    |
    |              9 | sacha.touille@orange.fr   | sachou  |
    |             10 | jean.serre-rien@gmail.com | jéjé    |
    +----------------+---------------------------+---------+

    jeu
    +--------+-----------------------------------------+----------------+--------------------+-------------+-------------+----------+-------------+
    | id_jeu | nom                                     | categorie      | éditeur            | joueurs_min | joueurs_max | duree    | age_minimum |
    +--------+-----------------------------------------+----------------+--------------------+-------------+-------------+----------+-------------+
    |      1 | Pandemic                                | coopération    | Zman Games         |           2 |           4 | 00:45:00 |           8 |
    |      2 | Azul                                    | placement      | Next Move          |           2 |           4 | 00:45:00 |           8 |
    |      3 | Catan                                   | développement  | filosofia          |           3 |           4 | 01:15:00 |          10 |
    |      4 | Gaïa                                    | placement      | BLACKROCK Editions |           2 |           5 | 00:30:00 |           8 |
    |      5 | Colt Express                            | programmation  | Ludonaute          |           2 |           6 | 00:40:00 |          10 |
    |      6 | Smash Up                                | cartes         | AEG                |           2 |           4 | 00:45:00 |          12 |
    |      7 | Carcassonne                             | placement      | filosofia          |           2 |           5 | 00:35:00 |           7 |
    |      8 | Kingdomino                              | placement      | blue orange        |           2 |           4 | 00:15:00 |           8 |
    |      9 | Galèrapagos                             | coopération    | Gigamic            |           3 |          12 | 00:20:00 |          10 |
    |     10 | Citadelles                              | cartes         | Edge               |           2 |           8 | 01:00:00 |          10 |
    |     11 | Pandemic Zone Rouge - Amérique du Nord  | coopération    | Zman Games         |           2 |           4 | 00:30:00 |           8 |
    |     12 | Pandemic - Montée des Eaux              | coopération    | Zman Games         |           2 |           5 | 01:00:00 |           8 |
    |     13 | Saboteur                                | bluff          | Gigamic            |           3 |          10 | 00:30:00 |           8 |
    +--------+-----------------------------------------+----------------+--------------------+-------------+-------------+----------+-------------+

    association_utilisateur_jeu
    +----------------+----------------+--------+
    | id_association | id_utilisateur | id_jeu |
    +----------------+----------------+--------+
    |              1 |              1 |      1 |
    |              2 |              1 |      2 |
    |              3 |              1 |      3 |
    |              4 |              1 |      4 |
    |              5 |              2 |      1 |
    |              6 |              2 |      5 |
    |              7 |              2 |      6 |
    |              8 |              3 |      1 |
    |              9 |              4 |      4 |
    |             10 |              4 |      7 |
    |             11 |              4 |      8 |
    |             12 |              5 |      9 |
    |             13 |              6 |      5 |
    |             14 |              6 |      3 |
    |             15 |              6 |      8 |
    |             16 |              6 |     10 |
    |             17 |              7 |      1 |
    |             18 |              7 |     11 |
    |             21 |              7 |     13 |
    |             22 |              8 |     13 |
    |             23 |              9 |      3 |
    |             24 |              9 |      7 |
    |             25 |              9 |      9 |
    |             26 |              9 |     13 |
    |             27 |             10 |      2 |
    |             28 |             10 |      8 |
    |             29 |             10 |     10 |
    |             30 |             10 |     13 |
    +----------------+----------------+--------+

## 3 - READ, UPDATE, DELETE

- pour chaque entité, afficher les données dans un tableaux
- ajouter une option permettant la suppression et la modification

## 4 - DIVERS

- afficher le nombre d'utilisateurs
- afficher le nombre de jeux
- afficher le nombre d'associations
- afficher les jeux n'ayant pas d'utilisateur
- afficher les utilisateurs n'ayant pas de jeu
- afficher les jeux possédés par sachou

## 5 - CODE, PARTAGE

- l'aspect visuel n'est pas une priorité
- vérifier le code (propreté, indentation, ...)
- exporter la base de données et l'intégrer au dossier du projet
- le projet devra être rendu sous forme d'une archive (zip ou rar) sur Discord (en message privé) ou par mail (david.hurtrel@gmail.com) au plus tard à 17h
- bon courage !