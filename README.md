Déploiement d'un site web en PHP qui interagit avec une base PhpMyAdmin sur un serveur Docker
PARTICIPANTS :
Houda AMGHAR
Thinhinane SADOU
Ouerdia KACED
Abdelhak BENADJAOUD
Djamel OULD SAADI

Le fichier docker-compose.yml définit plusieurs services :

🖥️ Service web (Serveur Apache + PHP)
Construit l’image à partir du Dockerfile dans le répertoire actuel (build: .).
Expose le port 8080 pour accéder au serveur web (8080:80).
Monteur un volume pour synchroniser les fichiers locaux avec /var/www/html dans le conteneur, permettant un développement en temps réel.
🗄️ Service db (Base de données MySQL)
Utilise l’image officielle mysql:8.
Définit un mot de passe root et crée la base test_db.
Monte un volume persistant db_data pour éviter la perte de données si le conteneur est arrêté.
Expose le port 3306 pour permettre à d’autres services d’accéder à la base.
🌍 Service phpmyadmin (Interface de gestion MySQL)
Utilise l’image phpmyadmin/phpmyadmin pour accéder et gérer la base.
Se connecte au service db via PMA_HOST: db.
Accessible sur le port 8081 (http://localhost:8081).
📝 Service vscode (Éditeur Code Server)
Utilise l’image codercom/code-server, qui permet d’accéder à VS Code dans le navigateur.
Sécurisé par un mot de passe (PASSWORD=monpassword).
Monte le volume ./src pour éditer les fichiers PHP directement.
Accessible sur http://localhost:8082.

 Création et Alimentation de la Base de Données via PhpMyAdmin
📌 Accès à PhpMyAdmin
Après avoir démarré les services avec docker-compose up -d, nous avons accédé à PhpMyAdmin via l'URL :
🔗 http://localhost:8081

📌 Connexion à la Base de Données
Serveur MySQL : db
Utilisateur : root
Mot de passe : root
Nom de la base : egypto
📌 Création de la Base de Données
Dans PhpMyAdmin, nous avons créé la base egypto en exécutant la requête SQL suivante :

CREATE DATABASE egypto;
USE egypto;
📌 Création de la Table dieu
Ensuite, nous avons créé une table dieu pour stocker les informations sur les dieux égyptiens :


CREATE TABLE dieu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    symbole VARCHAR(100),
    domaine VARCHAR(100)
);
📌 Insertion des Données
Nous avons ajouté quelques entrées dans la table dieu avec la requête suivante :


INSERT INTO dieu (nom, symbole, domaine) VALUES
('Râ', 'Disque solaire', 'Soleil'),
('Osiris', 'Couronne blanche', 'Vie après la mort'),
('Anubis', 'Chacal', 'Momification'),
('Horus', 'Faucon', 'Ciel et royauté'),
('Thot', 'Ibis', 'Sagesse et écriture');
2️⃣ Création du Site Web PHP
Nous avons développé une page web index.php qui se connecte à la base MySQL et affiche dynamiquement les dieux sous forme de tableau.

📌 Fonctionnalités du site
✅ Connexion sécurisée à la base MySQL
✅ Affichage dynamique des résultats
✅ Barre de recherche en temps réel
✅ Mise en page avec Bootstrap

📌 Code HTML & PHP du Site Web
Le fichier index.php contient :
1️⃣ Connexion à la base de données
2️⃣ Exécution de la requête SQL
3️⃣ Affichage des résultats sous forme de tableau Bootstrap
4️⃣ Filtrage des résultats via JavaScript
