-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Lun 30 Avril 2018 à 12:19
-- Version du serveur :  5.5.52-0+deb8u1
-- Version de PHP :  5.6.26-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Structure de la table `eco_banque`
--

CREATE TABLE `eco_banque` (
  `idcompte` mediumint(9) NOT NULL,
  `idtitulaire` mediumint(9) NOT NULL DEFAULT '0',
  `solde` mediumint(9) NOT NULL DEFAULT '0',
  `devise` char(3) NOT NULL DEFAULT '',
  `nomcpte` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste les comptes bancaires';

-- --------------------------------------------------------

--
-- Structure de la table `eco_besoin`
--

CREATE TABLE `eco_besoin` (
  `idpays` mediumint(9) NOT NULL DEFAULT '0',
  `idtitulaire` mediumint(9) NOT NULL DEFAULT '0',
  `type` varchar(4) NOT NULL DEFAULT '',
  `typeproduit` varchar(5) NOT NULL DEFAULT '',
  `quantite` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste l''état des besoins';

-- --------------------------------------------------------

--
-- Structure de la table `eco_bourse`
--

CREATE TABLE `eco_bourse` (
  `identreprise` mediumint(9) NOT NULL DEFAULT '0',
  `idactionnaire` mediumint(9) NOT NULL DEFAULT '0',
  `nbaction` mediumint(9) NOT NULL DEFAULT '0',
  `datederniereope` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='liste des actions possédées';

-- --------------------------------------------------------

--
-- Structure de la table `eco_capitalisation_histo`
--

CREATE TABLE `eco_capitalisation_histo` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `mont` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `idpays` int(11) NOT NULL,
  `nompays` int(11) NOT NULL,
  `capitalisation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eco_cnx`
--

CREATE TABLE `eco_cnx` (
  `id_cnx` mediumint(9) NOT NULL,
  `IP` varchar(50) NOT NULL DEFAULT '',
  `date_cnx` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ecran` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eco_cotation`
--

CREATE TABLE `eco_cotation` (
  `identreprise` mediumint(9) NOT NULL DEFAULT '0',
  `nbtitre` mediumint(9) NOT NULL DEFAULT '0',
  `cotation` mediumint(9) NOT NULL DEFAULT '0',
  `devise` char(3) NOT NULL DEFAULT '',
  `dernierecotation` mediumint(9) NOT NULL DEFAULT '0',
  `evol3mois` decimal(4,2) NOT NULL DEFAULT '0.00',
  `evol12mois` decimal(4,2) NOT NULL DEFAULT '0.00',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `solde` int(11) NOT NULL DEFAULT '0',
  `dette` int(11) NOT NULL DEFAULT '0',
  `val` int(11) NOT NULL DEFAULT '0',
  `poss` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des cotations boursières';

-- --------------------------------------------------------

--
-- Structure de la table `eco_cotation_histo`
--

CREATE TABLE `eco_cotation_histo` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `identreprise` mediumint(9) NOT NULL,
  `nbtitre` mediumint(9) NOT NULL,
  `cotation` mediumint(9) NOT NULL,
  `devise` char(3) NOT NULL,
  `dernierecotation` mediumint(9) NOT NULL,
  `evol3mois` decimal(4,2) NOT NULL,
  `evol12mois` decimal(4,2) NOT NULL,
  `datemaj` datetime NOT NULL,
  `solde` int(11) NOT NULL DEFAULT '0',
  `dette` int(11) NOT NULL DEFAULT '0',
  `val` int(11) NOT NULL DEFAULT '0',
  `poss` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eco_defbesoin`
--

CREATE TABLE `eco_defbesoin` (
  `iddefbesoin` mediumint(9) NOT NULL,
  `type` varchar(4) NOT NULL DEFAULT '',
  `typeproduit` varchar(5) NOT NULL DEFAULT '',
  `quantite` smallint(6) NOT NULL DEFAULT '0',
  `entite` varchar(4) NOT NULL DEFAULT '',
  `typedata` varchar(4) NOT NULL DEFAULT '',
  `nbdata` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste les définition des besoins';

-- --------------------------------------------------------

--
-- Structure de la table `eco_dette`
--

CREATE TABLE `eco_dette` (
  `identreprise` mediumint(9) NOT NULL DEFAULT '0',
  `dette` mediumint(9) NOT NULL DEFAULT '0',
  `devise` char(3) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `eco_entreprise`
--

CREATE TABLE `eco_entreprise` (
  `identreprise` mediumint(9) NOT NULL DEFAULT '0',
  `nomentreprise` varchar(50) NOT NULL DEFAULT '',
  `typeentreprise` varchar(5) NOT NULL DEFAULT '',
  `idpays` mediumint(9) NOT NULL DEFAULT '0',
  `iduser` mediumint(9) NOT NULL DEFAULT '0',
  `capacite` smallint(6) NOT NULL DEFAULT '0',
  `capacitemens` smallint(6) NOT NULL DEFAULT '0',
  `site` varchar(250) NOT NULL DEFAULT '',
  `logo` varchar(250) NOT NULL DEFAULT '',
  `datecreation` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des entreprises';

-- --------------------------------------------------------

--
-- Structure de la table `eco_fonction`
--

CREATE TABLE `eco_fonction` (
  `idfonction` mediumint(9) NOT NULL,
  `iduser` mediumint(9) NOT NULL DEFAULT '0',
  `fonction` varchar(10) NOT NULL DEFAULT '',
  `auto1` char(1) NOT NULL DEFAULT '',
  `auto2` char(1) NOT NULL DEFAULT '',
  `auto3` char(1) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des fonctions affectð™';

-- --------------------------------------------------------

--
-- Structure de la table `eco_histo`
--

CREATE TABLE `eco_histo` (
  `idhisto` mediumint(9) NOT NULL,
  `identreprise` mediumint(9) NOT NULL DEFAULT '0',
  `mois` smallint(2) NOT NULL DEFAULT '0',
  `idunite` mediumint(9) NOT NULL DEFAULT '0',
  `action` char(1) NOT NULL DEFAULT '',
  `nb` mediumint(9) NOT NULL DEFAULT '0',
  `cout` mediumint(9) NOT NULL DEFAULT '0',
  `devise` char(3) NOT NULL DEFAULT '',
  `qualite` mediumint(9) NOT NULL DEFAULT '0',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Historique mensuel';

-- --------------------------------------------------------

--
-- Structure de la table `eco_immo`
--

CREATE TABLE `eco_immo` (
  `idpossession` mediumint(9) NOT NULL DEFAULT '0',
  `idproprio` mediumint(9) NOT NULL DEFAULT '0',
  `occupe` varchar(9) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `idlocataire` mediumint(9) NOT NULL DEFAULT '0',
  `prix` mediumint(9) NOT NULL DEFAULT '0',
  `devise` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `prime` mediumint(9) NOT NULL DEFAULT '0',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `province` mediumint(9) NOT NULL DEFAULT '0',
  `regroupement` smallint(6) NOT NULL DEFAULT '0',
  `adresse_immo` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liste des biens immobiliers';

-- --------------------------------------------------------

--
-- Structure de la table `eco_immo_tmp`
--

CREATE TABLE `eco_immo_tmp` (
  `idproduit` mediumint(9) NOT NULL DEFAULT '0',
  `province` mediumint(9) NOT NULL DEFAULT '0',
  `adresse` varchar(150) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `eco_max`
--

CREATE TABLE `eco_max` (
  `idmax` mediumint(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Table des maximum';


-- --------------------------------------------------------

--
-- Structure de la table `eco_menu`
--

CREATE TABLE `eco_menu` (
  `id_menu` int(10) UNSIGNED NOT NULL,
  `id_node_menu` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `titre_menu` text NOT NULL,
  `lien_menu` text NOT NULL,
  `pos_x` int(11) NOT NULL DEFAULT '0',
  `pos_y` int(11) NOT NULL DEFAULT '0',
  `cible_menu` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eco_message`
--

CREATE TABLE `eco_message` (
  `idmsg` mediumint(9) NOT NULL,
  `origine` mediumint(9) NOT NULL DEFAULT '0',
  `destinataire` mediumint(9) NOT NULL DEFAULT '0',
  `objet` varchar(15) NOT NULL DEFAULT '',
  `libelle` text NOT NULL,
  `reponse` char(1) NOT NULL DEFAULT '',
  `datepropo` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateexpir` date NOT NULL DEFAULT '0000-00-00',
  `data` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste les messages';

-- --------------------------------------------------------

--
-- Structure de la table `eco_mvtbanque`
--

CREATE TABLE `eco_mvtbanque` (
  `idmvt` mediumint(9) NOT NULL,
  `idcompte` mediumint(9) NOT NULL DEFAULT '0',
  `idcompteaux` mediumint(9) NOT NULL DEFAULT '0',
  `montant` mediumint(9) NOT NULL DEFAULT '0',
  `devise` char(3) NOT NULL DEFAULT '',
  `commentaire` varchar(200) NOT NULL DEFAULT '',
  `dateheure` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des mouvements comptables';
-- --------------------------------------------------------

--
-- Structure de la table `eco_param`
--

CREATE TABLE `eco_param` (
  `idparam` mediumint(9) NOT NULL,
  `param` varchar(50) NOT NULL DEFAULT '',
  `valeur` varchar(50) NOT NULL DEFAULT '',
  `libelle` varchar(150) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des paramètres de EcoMicro';

-- --------------------------------------------------------

--
-- Structure de la table `eco_pays`
--

CREATE TABLE `eco_pays` (
  `idpays` mediumint(9) NOT NULL,
  `nompays` varchar(40) NOT NULL DEFAULT '',
  `iduser` mediumint(9) NOT NULL DEFAULT '0',
  `adr_site` varchar(100) NOT NULL DEFAULT '',
  `adr_forum` varchar(100) NOT NULL DEFAULT '',
  `emaileco` varchar(100) NOT NULL DEFAULT '',
  `devise` char(3) NOT NULL DEFAULT '',
  `cptenat` mediumint(9) NOT NULL DEFAULT '0',
  `drapeau` varchar(100) NOT NULL DEFAULT '',
  `datecreation` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateelection` date NOT NULL DEFAULT '0000-00-00',
  `election` smallint(1) NOT NULL DEFAULT '0',
  `controle_fiscal` mediumint(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste les pays';

-- --------------------------------------------------------

--
-- Structure de la table `eco_possession`
--

CREATE TABLE `eco_possession` (
  `idpossession` mediumint(9) NOT NULL,
  `idpossesseur` mediumint(9) NOT NULL DEFAULT '0',
  `idproduit` mediumint(9) NOT NULL DEFAULT '0',
  `datehachat` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nomproduit` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `typeproduit` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `image` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `description` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `nbunite` mediumint(9) NOT NULL DEFAULT '0',
  `idunite` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `datehmaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `prixachat` mediumint(9) NOT NULL DEFAULT '0',
  `devise` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `etat` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liste les possessions';
-- --------------------------------------------------------

--
-- Structure de la table `eco_possession_histo`
--

CREATE TABLE `eco_possession_histo` (
  `idpossession` mediumint(9) NOT NULL DEFAULT '0',
  `idpossesseur` mediumint(9) NOT NULL DEFAULT '0',
  `idproduit` mediumint(9) NOT NULL DEFAULT '0',
  `datehachat` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nomproduit` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `typeproduit` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `image` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `description` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `nbunite` mediumint(9) NOT NULL DEFAULT '0',
  `idunite` varchar(5) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `datehmaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `prixachat` mediumint(9) NOT NULL DEFAULT '0',
  `devise` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `etat` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `eco_production`
--

CREATE TABLE `eco_production` (
  `idproduit` mediumint(9) NOT NULL,
  `identreprise` mediumint(9) NOT NULL DEFAULT '0',
  `nomproduit` varchar(50) NOT NULL DEFAULT '',
  `typeproduit` varchar(5) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(150) NOT NULL DEFAULT '',
  `nbunite` smallint(6) NOT NULL DEFAULT '0',
  `idunite` varchar(5) NOT NULL DEFAULT '0',
  `prix` int(11) NOT NULL DEFAULT '0',
  `deviseprix` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des production des entreprises';

-- --------------------------------------------------------

--
-- Structure de la table `eco_produire`
--

CREATE TABLE `eco_produire` (
  `idproduire` mediumint(9) NOT NULL,
  `idproduitfini` varchar(5) NOT NULL DEFAULT '0',
  `typeentreprise` varchar(5) NOT NULL DEFAULT '0',
  `typeproduire` mediumint(9) NOT NULL DEFAULT '0',
  `idres` varchar(5) NOT NULL DEFAULT '0',
  `nbres` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Définition des productions';

-- --------------------------------------------------------

--
-- Structure de la table `eco_quiprodquoi`
--

CREATE TABLE `eco_quiprodquoi` (
  `typeentreprise` varchar(5) NOT NULL DEFAULT '',
  `typeproduit` varchar(5) NOT NULL DEFAULT '',
  `typeunite` varchar(5) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eco_relation`
--

CREATE TABLE `eco_relation` (
  `idpays1` mediumint(9) NOT NULL DEFAULT '0',
  `idpays2` mediumint(9) NOT NULL DEFAULT '0',
  `vision` binary(1) NOT NULL DEFAULT '\0',
  `eco` binary(1) NOT NULL DEFAULT '\0',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des relations internationales';

-- --------------------------------------------------------

--
-- Structure de la table `eco_stat_stock`
--

CREATE TABLE `eco_stat_stock` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `idpays` int(11) NOT NULL,
  `nompays` varchar(250) NOT NULL,
  `idunite` int(11) NOT NULL,
  `libelle` varchar(250) NOT NULL,
  `quantite` int(11) NOT NULL,
  `quantite_valeur` int(11) NOT NULL,
  `valeur_avg` decimal(5,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `eco_stock`
--

CREATE TABLE `eco_stock` (
  `identreprise` mediumint(9) NOT NULL DEFAULT '0',
  `idunite` varchar(5) NOT NULL DEFAULT '0',
  `quantite` mediumint(9) NOT NULL DEFAULT '0',
  `prixrevient` mediumint(9) NOT NULL DEFAULT '0',
  `devise` char(3) NOT NULL DEFAULT '',
  `qualite` mediumint(9) NOT NULL DEFAULT '0',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste les stocks courants des entreprises';

-- --------------------------------------------------------

--
-- Structure de la table `eco_tauxchange`
--

CREATE TABLE `eco_tauxchange` (
  `devise1` char(3) NOT NULL DEFAULT '0',
  `devise2` char(3) NOT NULL DEFAULT '0',
  `idpays1` mediumint(9) NOT NULL DEFAULT '0',
  `taux` decimal(5,2) NOT NULL DEFAULT '0.00',
  `idcompte` mediumint(9) NOT NULL DEFAULT '0',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Taux de change entre devise';
-- --------------------------------------------------------

--
-- Structure de la table `eco_taxeimport`
--

CREATE TABLE `eco_taxeimport` (
  `idpays1` mediumint(9) NOT NULL DEFAULT '0',
  `idpays2` mediumint(9) NOT NULL DEFAULT '0',
  `typeproduit` varchar(5) NOT NULL DEFAULT '',
  `taxe` decimal(5,2) NOT NULL DEFAULT '0.00',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des taxes d''import entre pays';

-- --------------------------------------------------------

--
-- Structure de la table `eco_tranperiodique`
--

CREATE TABLE `eco_tranperiodique` (
  `idtransac` mediumint(9) NOT NULL,
  `idcpte1` mediumint(9) NOT NULL DEFAULT '0',
  `montant` mediumint(9) NOT NULL DEFAULT '0',
  `devise` char(3) NOT NULL DEFAULT '',
  `idpays` mediumint(9) NOT NULL DEFAULT '0',
  `idcpte2` mediumint(9) NOT NULL DEFAULT '0',
  `commentaire` varchar(100) NOT NULL DEFAULT '',
  `periodicite` smallint(1) NOT NULL DEFAULT '0',
  `jour` smallint(1) NOT NULL DEFAULT '0',
  `datedebut` date NOT NULL DEFAULT '0000-00-00',
  `dateprochain` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des transactions périodiques courantes';

-- --------------------------------------------------------

--
-- Structure de la table `eco_typeentreprise`
--

CREATE TABLE `eco_typeentreprise` (
  `typeentreprise` varchar(5) NOT NULL DEFAULT '',
  `libelle` varchar(50) NOT NULL DEFAULT '',
  `typeequi` varchar(5) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste les type d''entreprise';

-- --------------------------------------------------------

--
-- Structure de la table `eco_typeproduit`
--

CREATE TABLE `eco_typeproduit` (
  `typeproduit` varchar(5) NOT NULL DEFAULT '',
  `libelle` varchar(30) NOT NULL DEFAULT '',
  `typeequi` varchar(5) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des type de produits';

-- --------------------------------------------------------

--
-- Structure de la table `eco_user`
--

CREATE TABLE `eco_user` (
  `iduser` mediumint(9) NOT NULL DEFAULT '0',
  `login` varchar(20) NOT NULL DEFAULT '',
  `pwd` varchar(20) CHARACTER SET latin1 NOT NULL DEFAULT 'aa',
  `nom` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `datemaj` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datecreation` date NOT NULL DEFAULT '0000-00-00',
  `datecnx` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idpays` mediumint(9) NOT NULL DEFAULT '0',
  `exclu` binary(1) NOT NULL DEFAULT '0',
  `idpaysaccueil` mediumint(9) NOT NULL DEFAULT '0',
  `inactif` binary(1) NOT NULL DEFAULT '0',
  `portrait` varchar(100) NOT NULL DEFAULT '',
  `election` smallint(1) NOT NULL DEFAULT '0',
  `resp` mediumint(9) NOT NULL DEFAULT '0',
  `idExterne` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Liste des utilisateurs';


--
-- Index pour les tables exportées
--

--
-- Index pour la table `eco_banque`
--
ALTER TABLE `eco_banque`
  ADD PRIMARY KEY (`idcompte`),
  ADD KEY `idtitulaire` (`idtitulaire`);

--
-- Index pour la table `eco_besoin`
--
ALTER TABLE `eco_besoin`
  ADD PRIMARY KEY (`idpays`,`idtitulaire`,`type`,`typeproduit`),
  ADD KEY `idtitulaire` (`idtitulaire`),
  ADD KEY `typeproduit` (`typeproduit`);

--
-- Index pour la table `eco_bourse`
--
ALTER TABLE `eco_bourse`
  ADD PRIMARY KEY (`identreprise`,`idactionnaire`),
  ADD KEY `identreprise` (`identreprise`),
  ADD KEY `idactionnaire` (`idactionnaire`);

--
-- Index pour la table `eco_cnx`
--
ALTER TABLE `eco_cnx`
  ADD PRIMARY KEY (`id_cnx`);

--
-- Index pour la table `eco_cotation`
--
ALTER TABLE `eco_cotation`
  ADD PRIMARY KEY (`identreprise`);

--
-- Index pour la table `eco_cotation_histo`
--
ALTER TABLE `eco_cotation_histo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eco_defbesoin`
--
ALTER TABLE `eco_defbesoin`
  ADD PRIMARY KEY (`iddefbesoin`),
  ADD KEY `typeproduit` (`typeproduit`);

--
-- Index pour la table `eco_dette`
--
ALTER TABLE `eco_dette`
  ADD PRIMARY KEY (`identreprise`);

--
-- Index pour la table `eco_entreprise`
--
ALTER TABLE `eco_entreprise`
  ADD PRIMARY KEY (`identreprise`),
  ADD UNIQUE KEY `nomentreprise` (`nomentreprise`),
  ADD KEY `idpays` (`idpays`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `typeentreprise` (`typeentreprise`);

--
-- Index pour la table `eco_fonction`
--
ALTER TABLE `eco_fonction`
  ADD PRIMARY KEY (`idfonction`);

--
-- Index pour la table `eco_histo`
--
ALTER TABLE `eco_histo`
  ADD PRIMARY KEY (`idhisto`),
  ADD KEY `identreprise` (`identreprise`),
  ADD KEY `idunite` (`idunite`);

--
-- Index pour la table `eco_immo`
--
ALTER TABLE `eco_immo`
  ADD PRIMARY KEY (`idpossession`),
  ADD KEY `idproprio` (`idproprio`),
  ADD KEY `idlocataire` (`idlocataire`),
  ADD KEY `province` (`province`);

--
-- Index pour la table `eco_immo_tmp`
--
ALTER TABLE `eco_immo_tmp`
  ADD PRIMARY KEY (`idproduit`),
  ADD KEY `province` (`province`);

--
-- Index pour la table `eco_max`
--
ALTER TABLE `eco_max`
  ADD PRIMARY KEY (`idmax`);

--
-- Index pour la table `eco_menu`
--
ALTER TABLE `eco_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_menu` (`id_menu`,`id_node_menu`);

--
-- Index pour la table `eco_message`
--
ALTER TABLE `eco_message`
  ADD PRIMARY KEY (`idmsg`),
  ADD KEY `origine` (`origine`),
  ADD KEY `destinataire` (`destinataire`);

--
-- Index pour la table `eco_mvtbanque`
--
ALTER TABLE `eco_mvtbanque`
  ADD PRIMARY KEY (`idmvt`),
  ADD KEY `idcompte` (`idcompte`),
  ADD KEY `idcompteaux` (`idcompteaux`);

--
-- Index pour la table `eco_param`
--
ALTER TABLE `eco_param`
  ADD PRIMARY KEY (`idparam`),
  ADD UNIQUE KEY `param` (`param`);

--
-- Index pour la table `eco_pays`
--
ALTER TABLE `eco_pays`
  ADD PRIMARY KEY (`idpays`),
  ADD UNIQUE KEY `nompays` (`nompays`),
  ADD UNIQUE KEY `devise` (`devise`),
  ADD KEY `iduser` (`iduser`);

--
-- Index pour la table `eco_possession`
--
ALTER TABLE `eco_possession`
  ADD PRIMARY KEY (`idpossession`),
  ADD KEY `idpossesseur` (`idpossesseur`),
  ADD KEY `typeproduit` (`typeproduit`),
  ADD KEY `idunite` (`idunite`),
  ADD KEY `idproduit` (`idproduit`);

--
-- Index pour la table `eco_possession_histo`
--
ALTER TABLE `eco_possession_histo`
  ADD PRIMARY KEY (`idpossession`);

--
-- Index pour la table `eco_production`
--
ALTER TABLE `eco_production`
  ADD PRIMARY KEY (`idproduit`),
  ADD KEY `identreprise` (`identreprise`),
  ADD KEY `typeproduit` (`typeproduit`),
  ADD KEY `idunite` (`idunite`);

--
-- Index pour la table `eco_produire`
--
ALTER TABLE `eco_produire`
  ADD PRIMARY KEY (`idproduire`),
  ADD KEY `typeentreprise` (`typeentreprise`),
  ADD KEY `typeproduire` (`typeproduire`),
  ADD KEY `idres` (`idres`),
  ADD KEY `idproduitfini` (`idproduitfini`);

--
-- Index pour la table `eco_quiprodquoi`
--
ALTER TABLE `eco_quiprodquoi`
  ADD PRIMARY KEY (`typeentreprise`,`typeproduit`,`typeunite`),
  ADD KEY `typeentreprise` (`typeentreprise`),
  ADD KEY `typeproduit` (`typeproduit`),
  ADD KEY `typeunite` (`typeunite`);

--
-- Index pour la table `eco_relation`
--
ALTER TABLE `eco_relation`
  ADD PRIMARY KEY (`idpays1`,`idpays2`),
  ADD KEY `idpays1` (`idpays1`),
  ADD KEY `idpays2` (`idpays2`);

--
-- Index pour la table `eco_stat_stock`
--
ALTER TABLE `eco_stat_stock`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eco_stock`
--
ALTER TABLE `eco_stock`
  ADD PRIMARY KEY (`identreprise`,`idunite`),
  ADD KEY `identreprise` (`identreprise`),
  ADD KEY `idunite` (`idunite`);

--
-- Index pour la table `eco_tauxchange`
--
ALTER TABLE `eco_tauxchange`
  ADD PRIMARY KEY (`devise1`,`devise2`),
  ADD KEY `idpays1` (`idpays1`),
  ADD KEY `idcompte` (`idcompte`),
  ADD KEY `devise1` (`devise1`),
  ADD KEY `devise2` (`devise2`);

--
-- Index pour la table `eco_taxeimport`
--
ALTER TABLE `eco_taxeimport`
  ADD PRIMARY KEY (`idpays1`,`idpays2`,`typeproduit`),
  ADD KEY `idpays1` (`idpays1`),
  ADD KEY `idpays2` (`idpays2`),
  ADD KEY `typeproduit` (`typeproduit`);

--
-- Index pour la table `eco_tranperiodique`
--
ALTER TABLE `eco_tranperiodique`
  ADD PRIMARY KEY (`idtransac`),
  ADD KEY `idcpte1` (`idcpte1`),
  ADD KEY `idpays` (`idpays`),
  ADD KEY `idcpte2` (`idcpte2`);

--
-- Index pour la table `eco_typeentreprise`
--
ALTER TABLE `eco_typeentreprise`
  ADD PRIMARY KEY (`typeentreprise`),
  ADD UNIQUE KEY `libelle` (`libelle`),
  ADD KEY `typeequi` (`typeequi`);

--
-- Index pour la table `eco_typeproduit`
--
ALTER TABLE `eco_typeproduit`
  ADD PRIMARY KEY (`typeproduit`),
  ADD UNIQUE KEY `libelle` (`libelle`),
  ADD KEY `typeequi` (`typeequi`);

--
-- Index pour la table `eco_user`
--
ALTER TABLE `eco_user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `idpays` (`idpays`),
  ADD KEY `idpaysaccueil` (`idpaysaccueil`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `eco_banque`
--
ALTER TABLE `eco_banque`
  MODIFY `idcompte` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103733;
--
-- AUTO_INCREMENT pour la table `eco_cnx`
--
ALTER TABLE `eco_cnx`
  MODIFY `id_cnx` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192506;
--
-- AUTO_INCREMENT pour la table `eco_cotation_histo`
--
ALTER TABLE `eco_cotation_histo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `eco_defbesoin`
--
ALTER TABLE `eco_defbesoin`
  MODIFY `iddefbesoin` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `eco_fonction`
--
ALTER TABLE `eco_fonction`
  MODIFY `idfonction` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=990;
--
-- AUTO_INCREMENT pour la table `eco_histo`
--
ALTER TABLE `eco_histo`
  MODIFY `idhisto` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7487;
--
-- AUTO_INCREMENT pour la table `eco_menu`
--
ALTER TABLE `eco_menu`
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT pour la table `eco_message`
--
ALTER TABLE `eco_message`
  MODIFY `idmsg` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34187;
--
-- AUTO_INCREMENT pour la table `eco_mvtbanque`
--
ALTER TABLE `eco_mvtbanque`
  MODIFY `idmvt` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165326;
--
-- AUTO_INCREMENT pour la table `eco_param`
--
ALTER TABLE `eco_param`
  MODIFY `idparam` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `eco_pays`
--
ALTER TABLE `eco_pays`
  MODIFY `idpays` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9891;
--
-- AUTO_INCREMENT pour la table `eco_possession`
--
ALTER TABLE `eco_possession`
  MODIFY `idpossession` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6011;
--
-- AUTO_INCREMENT pour la table `eco_production`
--
ALTER TABLE `eco_production`
  MODIFY `idproduit` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3412;
--
-- AUTO_INCREMENT pour la table `eco_produire`
--
ALTER TABLE `eco_produire`
  MODIFY `idproduire` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT pour la table `eco_stat_stock`
--
ALTER TABLE `eco_stat_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;
--
-- AUTO_INCREMENT pour la table `eco_tranperiodique`
--
ALTER TABLE `eco_tranperiodique`
  MODIFY `idtransac` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=811;
DELIMITER $$
--
-- Événements
--
CREATE DEFINER=`root`@`localhost` EVENT `Stat_Stock_Brut` ON SCHEDULE EVERY 1 WEEK STARTS '2014-06-23 04:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO eco_stat_stock
SELECT '', 'BRUT', YEAR(NOW()), MONTH(NOW()), WEEK(NOW()), p.idpays, p.nompays, t.typeproduit, t.libelle, sum(s.quantite), sum(s.quantite * s.prixrevient), avg(s.prixrevient)
FROM
        eco_stock as s,
        eco_entreprise as e,
        eco_pays as p,
        eco_typeproduit as t
WHERE
            s.identreprise = e.identreprise
        AND e.idpays = p.idpays
        AND s.idunite = t.typeproduit
        AND e.idpays IN (1, 1006, 929,890) 
        AND s.quantite > 0
GROUP BY
        p.idpays, p.nompays, t.typeproduit, t.libelle
ORDER BY
		p.nompays, t.libelle$$

CREATE DEFINER=`root`@`localhost` EVENT `Cotation_Histo` ON SCHEDULE EVERY 1 WEEK STARTS '2014-06-23 04:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO eco_cotation_histo
SELECT '', YEAR(NOW()), MONTH(NOW()), WEEK(NOW()), c.* FROM eco_cotation as c$$

CREATE DEFINER=`root`@`localhost` EVENT `Stat_Stock_Non_Prod` ON SCHEDULE EVERY 1 WEEK STARTS '2014-07-06 04:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO eco_stat_stock
SELECT 'NOPROD', YEAR(NOW()), MONTH(NOW()), WEEK(NOW()), p.idpays, p.nompays, t.typeproduit, t.libelle, sum(s.quantite), sum(s.quantite * s.prixrevient), avg(s.prixrevient) 
FROM 
eco_stock as s, 
eco_entreprise as e, 
eco_pays as p, 
eco_typeproduit as t, 
eco_produire as pp 
WHERE s.identreprise = e.identreprise 
AND s.idunite = t.typeproduit 
AND s.idunite = pp.idproduitfini 
AND s.idunite = pp.idres 
AND NOT e.typeentreprise = pp.typeentreprise 
AND e.idpays = p.idpays 
AND e.idpays IN (1, 1006, 929,890) 
AND s.quantite > 0 
GROUP BY p.idpays, p.nompays, t.typeproduit, t.libelle 
ORDER BY p.nompays, t.libelle$$

CREATE DEFINER=`root`@`localhost` EVENT `Stat_Stock_Prod` ON SCHEDULE EVERY 1 WEEK STARTS '2014-06-23 04:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO eco_stat_stock
SELECT '', 'PROD', YEAR(NOW()), MONTH(NOW()), WEEK(NOW()), p.idpays, p.nompays, t.typeproduit, t.libelle, sum(s.quantite), sum(s.quantite * s.prixrevient), avg(s.prixrevient)
FROM
        eco_stock as s,
        eco_entreprise as e,
        eco_pays as p,
        eco_typeproduit as t,
        eco_produire as pp
WHERE
            s.identreprise = e.identreprise
        AND s.idunite = t.typeproduit
        AND s.idunite = pp.idproduitfini
        AND s.idunite = pp.idres
        AND e.typeentreprise = pp.typeentreprise
        AND e.idpays = p.idpays
        AND e.idpays IN (1, 1006, 929,890) 
        AND s.quantite > 0
GROUP BY
        p.idpays, p.nompays, t.typeproduit, t.libelle
ORDER BY p.nompays, t.libelle$$

CREATE DEFINER=`root`@`localhost` EVENT `Capitalisation_Histo` ON SCHEDULE EVERY 1 WEEK STARTS '2014-07-06 04:00:00' ON COMPLETION NOT PRESERVE ENABLE DO INSERT INTO eco_capitalisation_histo
SELECT '', YEAR(NOW()), MONTH(NOW()), WEEK(NOW()), e.idpays, p.nompays, sum(c.cotation * 1000)
FROM eco_cotation as c,
     eco_entreprise as e,
     eco_pays as p
WHERE c.identreprise = e.identreprise
AND e.idpays = p.idpays
AND e.idpays IN (1, 1006, 929,890)
AND e.typeentreprise <= 40000
GROUP BY e.idpays, p.nompays
ORDER BY p.nompays$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
