--
-- Database: `eitf05`
--
CREATE DATABASE `eitf05` DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE `eitf05`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `passwordhash` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `sur_name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `homeaddress` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;
