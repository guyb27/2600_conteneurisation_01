# Projet de contenerisation avec l ecole 2600

Projet de conteneurisation avec un site web avec une faille SQLI, une db et une machine attaquante
Exercice Noté 01 - Environnement d'Attaque SQLi
Ce projet configure un environnement Docker Compose simulant une vulnérabilité d'injection SQL (SQLi) et son exploitation automatisée.
Structure du projet
.
├── docker-compose.yml
├── web/
│   ├── Dockerfile
│   ├── start.sh
│   ├── nginx/
│   │   └── default.conf
│   └── src/
│       ├── index.php
│       └── search.php
├── db_init/
│   └── init.sql
├── attacker/
│   ├── Dockerfile
│   ├── scripts/
│   │   └── attack.sh
│   └── results/  (créé automatiquement pendant l'exécution)
└── README.md
Contenu de l'environnement

Service Web Vulnérable :

Image PHP-FPM avec Nginx
Application web simple avec une page de recherche vulnérable aux injections SQL
Exposé sur le port 8080 (accessible via http://localhost:8080)


Base de Données :

PostgreSQL 14
Contient des tables avec des données factices, dont certaines "sensibles"


Machine Attaquante :

Image Debian
Équipée de SQLMap
Script d'attaque automatisé



Fonctionnement
Au démarrage de l'environnement, la séquence suivante se produit :

La base de données démarre et est initialisée avec des tables et données
Le service web démarre, connecté à la base de données
La machine attaquante démarre et attend que le service web soit disponible
Une fois le service web prêt, le script d'attaque s'exécute automatiquement :

Il détecte la vulnérabilité SQLi
Il extrait la liste des bases de données
Il réalise un dump complet de la base de données vulnérable
Il génère un rapport de synthèse



Instructions d'utilisation
Prérequis

Docker et Docker Compose installés sur votre machine

Installation et démarrage

Clonez ou téléchargez ce dépôt
Ouvrez un terminal et naviguez jusqu'au répertoire du projet
Exécutez la commande suivante :

bashdocker-compose up --build

Attendez que tous les services soient opérationnels et que l'attaque se termine

Accès à l'application vulnérable

Ouvrez votre navigateur et accédez à http://localhost:8080
Vous pouvez tester manuellement la vulnérabilité en entrant des payloads SQLi dans le champ de recherche, comme ' OR 1=1 --

Visualisation des résultats
Les résultats de l'attaque automatisée sont disponibles dans le dossier attacker/results/.
Vulnérabilité SQLi implémentée
L'application est intentionnellement vulnérable aux injections SQL dans la page de recherche. La requête suivante dans search.php est vulnérable :
php$query = "SELECT id, username, email, role FROM users WHERE username LIKE '%" . $username . "%'";
Cette implémentation permet l'injection de code SQL malveillant par le biais du paramètre username.
Choix techniques

Pourquoi PHP avec Nginx pour l'application vulnérable :

Facilité d'implémentation d'une vulnérabilité SQLi
Nginx offre de meilleures performances qu'Apache
Configuration flexible et légère


Pourquoi PostgreSQL :

Base de données robuste et sécurisée
Bonnes performances et conformité SQL
Compatibilité avec PHP via PDO


Pourquoi Debian pour l'attaquant :

Image légère
Compatible avec les outils de sécurité comme SQLMap


Pourquoi SQLMap :

Outil spécialisé dans la détection et l'exploitation des vulnérabilités SQLi
Permet l'automatisation complète de l'attaque



Remarques
Ce projet est destiné uniquement à des fins éducatives. L'exploitation de vulnérabilités sans autorisation explicite est illégale.
