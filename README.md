# ECOMICRO

## Installation

**Prérequis**

- PHP 8
- MariaDB

**Base de donnée**

- Le fichier `schema.sql` à la racine décrit le schéma de la base de donnée.
- Les identifiants de la base de donnée doivent être renseignés dans le fichier `include/config.php`.

**Mailing**

- Pour que les mails partent, passer la variable `MAIL_ENABLED` dans `include/config.php` à `true`.

**Dev**

- Pour lancer ecomicro en local

```
php -S localhost:8080 -t .
```

puis rendez-vous sur [http://localhost:8080](http://localhost:8080).


## Versions

### 0.7.a - Mise à niveau (janvier 2023)

**Changement**

* Mise à niveau vers php8
* Documentation

### 0.6.a - Amèliorations (septembre 2007)

**Nouveautès :**
*  Gestion de l'immobilier
* Ecrans Dètail citoyen et entreprise refaient à neuf !
* Organisation des menus repensée

**A venir :**
* Ecrans de synthèse et d'analyse financière
* Gestion Administrative

**En suspend :**
* Gestion des transports
* Transactions et achats externes

### 0.5.a - C'est vraiment parti là ! (mars 2007)

**Nouveautés :**

* Finalisation pour plusieurs pays
* Emission de titres / Gestion de la 'Bourse'
* Intégration de l'immobilier

**A venir :**
* Ecrans de synthèse et d'analyse financière
* Gestion Administrative


**En suspend :**
* Gestion des transports
* Transactions et achats externes

### 0.4.a - Première utilisation (sept 2006)

**Nouveautés :**

* Envoi d'Email
* Détermination du responsable économique
* Contrôles de màj
* Petites annonces
* Règles économiques
      
**A venir :**

* Finalisation pour plusieurs pays
* Emission de titres / Gestion de la 'Bourse'
* Intégration de l'immobilier
      
**En suspend :**

* Gestion Administrative
* Ecrans de synthèse
* Gestion des transports
* Transactions et achats externes
      
### 0.3.a - Première phase de test (juin 2006)

**Nouveautés :**

* Détail (citoyen, entreprise, état)
* Transformation de matière / Production
* Gestion des besoins
* Messagerie de validation
* Transactions et achats avec validation
* Sécurisation des actions (autant que faire ce peut)
* Documentation !

**A venir :**

* Envoi d'Email
* Détermination du responsable économique
* Finalisation pour plusieurs pays
* Gestion Administrative

**En suspend :**

* Emission de titres / Gestion de la 'Bourse'
* Intégration de l'immobilier
* Ecrans de synthèse
* Gestion des transports
* Transactions et achats externes

###0.2.a - Seconde étape (février 2006)</td>

**Nouveautés :**

* La Bourse
* Visualisation restrainte
* Sécurisation des saisies
* Traitements de màj
* Application des droits
      
**A venir :**

* Détail d'un citoyen
* Détail d'une entreprise
* Messagerie et Email
* Transactions et achats avec validation

**En suspend :**

* Ecrans de synthèse
* Règles économiques
* Transactions et achats externes


### 0.1.a - Première présentation (? 2005)

**Nouveautés :**
* Tout !!
  
**A venir :**

* La Bourse
* Visualisation restrainte
* Sécurisation des saisies
* Traitements de màj
* Application des droits
* Règles économiques

**En suspend :**

* Ecrans de synthèse
* Messagerie et Email
* Transactions et achats avec validation
* Transactions et achats externes
      
### Lancement du projet : février 2005