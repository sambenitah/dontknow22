SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `Articles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(310) NOT NULL,
  `route` varchar(100) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` varchar(10000) DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dui nulla, sollicitudin eu enim eget, eleifend pulvinar nisi. Vivamus a iaculis sem. Aliquam ultricies diam et porta pulvinar. Integer molestie, eros eget dignissim vulputate, lectus orci dictum augue, at dignissim quam sapien sed risus. Nunc vestibulum sollicitudin eros, eu accumsan nunc faucibus at. Integer ut arcu ut erat mollis ullamcorper ac et augue. Aenean id urna erat. Cras sollicitudin, orci sit amet ornare iaculis,',
  `main_picture` varchar(250) NOT NULL DEFAULT 'default.jpg',
  `category` varchar(30) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` varchar(200) NOT NULL,
  `articleId` int(100) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Customizer` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT 'IDK',
  `content` varchar(300) NOT NULL DEFAULT 'Créez un blog ou un site Web haut de gamme. Assistance en direct. Commencez ! Hébergement Gratuit. Des Centaines de Designs. Live Chat & Aide Par Mail. Stats Faciles à Lire. Prêt pour le Mobile. Évolutif et Sécurisé. SEO Intégré. Aide Rapide et Conviviale.',
  `contactMenu` int(1) NOT NULL DEFAULT '0',
  `colorFront` varchar(50) NOT NULL,
  `postContentColor` varchar(50) NOT NULL,
  `aColor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ErrorPage` (
  `id` int(11) NOT NULL,
  `content` varchar(100) NOT NULL DEFAULT 'Sorry an error has occured',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `background_color` char(7) NOT NULL,
  `text_color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Pictures` (
  `id` int(11) NOT NULL,
  `name_id` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `tokenPassword` varchar(60) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `Articles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Customizer`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ErrorPage`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Pictures`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `Articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Customizer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ErrorPage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
