## Index
1. Infos générales
2. Fonctionnalités
3. Installation
4. Utilisation
5. Prérequis
___
## 1) Infos générales
- Nom du projet : My_Quiz
- Statut du projet : Fini
    - Version : 1.0
- Auteurs: 
    - Yanis Benhagouga  ( linkedin : https://www.linkedin.com/in/yanis-benhagouga-50782120a/ )
    - Christopher Debray  ( linkedin : https://www.linkedin.com/in/christopher-debray/ )
    - Jérémy Ly  ( linkedin : https://www.linkedin.com/in/jeremy-ly-dev/ )
- Objectif (résumé du sujet) :
    - Le but du projet est de créer un site de quiz sous Symfony 5
- Compétences apprises :
    - Symfony 5
    - Bootstrap
___
## 2) Fonctionnalités
##### Si non connecté :
- Formulaire d'inscription ( avec mail de vérification )
    - Email
    - Mot de passe
- Formulaire de connexion
    - Email
    - Mot de passe
- Possibilité de passer des quizz
    - Affichage de l'historique des quizz passés
___
##### Si connecté en temps qu'utilisateur ( en plus des fonctionnalités mentionnées précédemment ) : 
- Modification du compte :
    - Email
    - Mot de passe
- Création de questionnaire :
    - Création d'une catégorie
    - Ajout de la question lié à la catégorie
    - Ajout des réponses lié à la question
___
##### Si connecté en temps qu'administrateur ( en plus des fonctionnalités mentionnées précédemment ) : 
- Possibilité de :
    - Créer
    - Récupérer
    - Modifier
    - Supprimer
    
- Ces opérations sont utilisables sur :
    - Les utilisateurs 
        - Notamment possible de transformer un utilisateur en administrateur
    - Les catégories
    - Les questions
    - Les réponses

- Consulter l'historique de tous les utilisateurs
___
## 3) Installation
Suivez bien les étapes ci-dessous !
###  Étape 1 : installation des dépendances
- Déplacez vous dans votre dossier et lancez les commande :
    - composer install
###  Étape 2 : création de la base de données
- Créer une base de données du nom de my_quizz
- Importer dans cette base de données le fichier my_quizz.sql
###  Étape 3 : configuration du fichier .env
- Modifier la partie de votre fichier .env ( à la racine du dossier cloné ), d'abord la partie contenant :
<pre>
    <code>
        # DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
        DATABASE_URL="mysql://USER_NAME:PASSWORD@127.0.0.1:3306/my_quizz?serverVersion=5.7"
        # DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
    </code>
</pre>
- Remplacez les valeurs suivantes :
    - USER_NAME par le nom que vous utiliser pour vous connecter à mysql
    - PASSWORD par le mot de passe que vous utiliser pour vous connecter à mysql
    - Toute les ligne commençant par DATABASE_URL donc la valeur ne commence pas par mysql , (ex:  DATABASE_URL="mysql ...") devront être mise en commentaire ( avec un # ) , exemple :
    <pre>
        <code>
            # DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
            # DATABASE_URL="postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=13&charset=utf8"
        </code>
    </pre>

###  Étape 5 : vérification de mail, mailtrap
***Important ! Obligatoire afin de pouvoir utiliser le projet !***
- Se rendre sur le site https://mailtrap.io/signin ( Mailtrap )
***Mailtrap est un outil qui permet l'envoi d'email, ici cela nous sers pour tester / utiliser la vérfication d'email***
- Une fois connecté, se rendre dans l'onglet inbox et cliquez sur le lien My Inbox.
- Dans l'onglet **SMTP Settings** de My Inbox :
    - Sélectionnez le menu déroulant sous **Integrations** 
        - Dans ce menu dans la catégorie PHP sélectionnez Symfony 5+
- En dessous du menu déroulant vous devriez trouvez un block de code ressemblant au suivant :
<pre>
    <code>
        MAILER_DSN=smtp://90b8de4034c5e4:f9c7eb8e9dad1e@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login
    </code>
</pre>
- Récupérez le code et modifier le code de votre fichier .env en conséquence ( ligne 22 normalement )
***Lors de l'envoi d'un email de vérification, il faudra vérifier dans My Inbox puis confirmer le mail suite à quoi vous devrez vous connecter pour confirmer la validation***
___
## 4) Utilisation
- Pour utiliser les fonctionnalités d'administrateur :
    - Le premier administrateur devra être créée via phpMyAdmin , pour cela :
        - Allez dans la table user
        - Changez le contenu de la colonne 'roles' ( pour l'utilisateur voulu ) de : [] en ["ROLE_ADMIN"] 
- Lancez la commande php artisan serve pour lancer le projet
___
## 5) Prérequis
- PHP 
- MySQL
- Composer
