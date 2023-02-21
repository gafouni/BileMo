## Description
* BileMo  est une API exposant un catalogue de telephone portable. Ce projet m'a permis d'apprendre a developper une API REST avec le framework Symfony.  Les diagrammes UML se trouvent dans le dossier "Diagrams".  L'analyse Codacy est disponible a l'url suivante: https://app.codacy.com/gh/gafouni/bilemo/dashboard  Versions: PHP 7.4.12  Symfony 5.4

---------------------------------
## Installation
* Cloner le depot:  git clone https://github.com/gafouni/bilemo.git

* Telecharger les dependances:  
  composer install
  
* Parametrer la base de donnees:  
  editer le fichier intitule ".env", modifier les valeurs de parametrage de la base de donnees 
  
* Creer la base de donnees: 
  importer le fichier "bilemo.sql" situe a la racine du projet, pour charger les fixtures: php bin/console doctrine:fixtures:load
  
  
* Lancer le projet:  
  lancer le serveur de developpement (Xampp ou autre)  
  lancer le serveur de symfony: symfony server:start 

* Installation de Postman:  
  Pour tester les fonctionnalites de l'API, installer Postman, utiliser l'url suivant pour obtenir un token d'authentification:  
  https://127.0.0.1:8000/api/login_check  
  Copier le token ainsi obtenu. Il n'est valable qu'une heure.  
  Lancez une requete avec dans le header la clé Authorisation et la valeur "Bearer votre_token" 

* Documentation:  
  Vous pouvez acceder a la documentation de l'API a l'adresse suivante en local:  
  https://127.0.0.1:8000/api/doc




