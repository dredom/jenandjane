-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.67-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema jjdb
--

CREATE DATABASE IF NOT EXISTS jjdb;
USE jjdb;

--
-- Temporary table structure for view `productcode`
--
DROP TABLE IF EXISTS `productcode`;
DROP VIEW IF EXISTS `productcode`;
CREATE TABLE `productcode` (
  `id` int(10) unsigned,
  `code` varbinary(24),
  `category` char(1),
  `style` smallint(6) unsigned,
  `type` varchar(9),
  `material` varchar(9),
  `created` timestamp
);

--
-- Definition of table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id`         int(10) unsigned NOT NULL auto_increment,
  `category`   char(1)   NOT NULL,
  `style`      smallint(6) unsigned NOT NULL,
  `type`       varchar(9)   NOT NULL,
  `material`   varchar(9)  NOT NULL,
  `created`    timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `Index_product` (`category`,`style`,`type`,`material`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Definition of table `productdata`
--

DROP TABLE IF EXISTS `productdata`;
CREATE TABLE `productdata` (
  `productid`     int(10) unsigned NOT NULL,
  `description`   varchar(1024)  default NULL,
  `specs`         varchar(1024)  default NULL,
  `created`       timestamp NOT NULL default '0000-00-00 00:00:00',
  `updated`       timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`productid`),
  CONSTRAINT `FK_productdata_product` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



--
-- Definition of table `productoption`
--

DROP TABLE IF EXISTS `productoption`;
CREATE TABLE `productoption` (
  `productid`   int(10) unsigned NOT NULL,
  `seq`         tinyint(3) unsigned NOT NULL default '0',
  `optiontype`  varchar(18) default NULL,
  `value`       varchar(18) default NULL,
  `price`       decimal(9,2) default NULL,
  `created`     timestamp NOT NULL default '0000-00-00 00:00:00',
  `updated`     timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  USING BTREE (`seq`,`productid`),
  UNIQUE KEY `Index_productoption` USING BTREE (`productid`,`optiontype`,`value`),
  CONSTRAINT `FK_productoption_product` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;





--
-- Definition of table `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE `stats` (
  `id` varchar(12) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Definition of view `productcode`
--

DROP TABLE IF EXISTS `productcode`;
DROP VIEW IF EXISTS `productcode`;
CREATE ALGORITHM=UNDEFINED DEFINER=`auntiedt`@`localhost` SQL SECURITY DEFINER VIEW `productcode` AS select `p`.`id` AS `id`,concat(`p`.`category`,lpad(`p`.`style`,3,_utf8'0'),_utf8'-',`p`.`type`,_utf8'-',`p`.`material`) AS `code`,`p`.`category` AS `category`,`p`.`style` AS `style`,`p`.`type` AS `type`,`p`.`material` AS `material`,`p`.`created` AS `created` from `product` `p`;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
