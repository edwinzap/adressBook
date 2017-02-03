CREATE DATABASE `adressbook` /*!40100 DEFAULT CHARACTER SET utf8 */

CREATE TABLE `contact` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nom` varchar(25) NOT NULL,
 `prenom` varchar(25) NOT NULL,
 `telephone` varchar(20) DEFAULT NULL,
 `rue` varchar(50) DEFAULT NULL,
 `numero` varchar(10) DEFAULT NULL,
 `codePostal` int(11) DEFAULT NULL,
 `ville` varchar(50) DEFAULT NULL,
 `id_utilisateur` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `index_id_utilisateur` (`id_utilisateur`) USING BTREE,
 CONSTRAINT `fk_contact_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8

CREATE TABLE `utilisateur` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `login` varchar(30) NOT NULL,
 `password` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8