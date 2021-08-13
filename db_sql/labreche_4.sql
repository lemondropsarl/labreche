/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ labreche_4 /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE labreche_4;

DROP TABLE IF EXISTS acl_modules;
CREATE TABLE `acl_modules` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(30) NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS categories;
CREATE TABLE `categories` (
  `cat_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS ci_sessions;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` mediumint(11) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS groups;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS groups_permissions;
CREATE TABLE `groups_permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL,
  `perm_id` mediumint(8) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS invoice;
CREATE TABLE `invoice` (
  `invoice_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `inv_pos_id` mediumint(4) NOT NULL,
  `inv_total_amount` decimal(10,0) NOT NULL,
  `inv_discount_amount` decimal(10,0) NOT NULL,
  `inv_vat_amount` decimal(10,0) NOT NULL,
  `user_id` mediumint(4) NOT NULL,
  `inv_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_pos_id` (`inv_pos_id`),
  CONSTRAINT `fk_pos_id` FOREIGN KEY (`inv_pos_id`) REFERENCES `pos` (`pos_ws_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS last_update_stock;
CREATE TABLE `last_update_stock` (
  `lus_product_id` mediumint(4) NOT NULL,
  `lus_quantity` int(4) NOT NULL,
  `lus_prod_loc_id` mediumint(4) NOT NULL,
  `lus_prod_loc_description` varchar(150) NOT NULL,
  `lus_updated_date` date NOT NULL,
  PRIMARY KEY (`lus_product_id`),
  UNIQUE KEY `lus_product_id` (`lus_product_id`),
  KEY `w_ID` (`lus_prod_loc_id`),
  CONSTRAINT `w_ID` FOREIGN KEY (`lus_prod_loc_id`) REFERENCES `product_location` (`prod_loc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS login_attempts;
CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS migrations;
CREATE TABLE `migrations` (
  `module` varchar(20) NOT NULL,
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS modules;
CREATE TABLE `modules` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL,
  `module_display_name` varchar(50) NOT NULL,
  `module_description` varchar(250) NOT NULL,
  `module_status` tinyint(1) unsigned NOT NULL,
  `module_version` varchar(4) NOT NULL,
  `license_key` varchar(150) DEFAULT NULL,
  `license_status` varchar(50) DEFAULT NULL,
  `required_module` varchar(50) DEFAULT NULL,
  `is_preloaded` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_name` (`module_name`),
  UNIQUE KEY `license_key` (`license_key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS navigation_menu;
CREATE TABLE `navigation_menu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `icon-name` varchar(50) DEFAULT NULL,
  `text` varchar(50) NOT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `order` int(11) unsigned NOT NULL,
  `perm_key` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `text` (`text`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS permissions;
CREATE TABLE `permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `perm_key` varchar(30) NOT NULL,
  `perm_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `perm_key` (`perm_key`),
  UNIQUE KEY `perm_name` (`perm_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS pos;
CREATE TABLE `pos` (
  `pos_ws_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(20) NOT NULL,
  `pos_addres` varchar(30) NOT NULL,
  PRIMARY KEY (`pos_ws_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS prods_in_inv;
CREATE TABLE `prods_in_inv` (
  `pi_product_id` mediumint(4) NOT NULL,
  `pi_invoice_id` mediumint(4) NOT NULL,
  `pi_quantity` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS product;
CREATE TABLE `product` (
  `product_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(20) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `min_qty` int(11) NOT NULL,
  `product_brand` varchar(20) DEFAULT NULL,
  `product_model` varchar(20) DEFAULT NULL,
  `product_cat_id` mediumint(4) NOT NULL,
  `product_uom` varchar(20) NOT NULL,
  `product_currency` varchar(3) NOT NULL,
  `product_vehicule_id` mediumint(4) NOT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_code` (`product_code`),
  KEY `fk_ve_id` (`product_vehicule_id`),
  KEY `fk_cat_id` (`product_cat_id`),
  CONSTRAINT `fk_cat_id` FOREIGN KEY (`product_cat_id`) REFERENCES `categories` (`cat_id`),
  CONSTRAINT `fk_ve_id` FOREIGN KEY (`product_vehicule_id`) REFERENCES `vehicule` (`vehicule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS product_location;
CREATE TABLE `product_location` (
  `prod_loc_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `prod_loc_prod_id` mediumint(4) NOT NULL,
  `prod_loc_zone_id` mediumint(4) NOT NULL,
  `prod_loc_shelf_id` mediumint(4) NOT NULL,
  PRIMARY KEY (`prod_loc_id`),
  UNIQUE KEY `prod_loc_prod_id` (`prod_loc_prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS shelf_location;
CREATE TABLE `shelf_location` (
  `shelf_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `shelf_name` varchar(20) NOT NULL,
  PRIMARY KEY (`shelf_id`),
  UNIQUE KEY `shelf_name` (`shelf_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS stock_entries_in;
CREATE TABLE `stock_entries_in` (
  `si_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `si_product_id` mediumint(4) NOT NULL,
  `si_quantity` int(4) NOT NULL,
  `si_entry_date` date NOT NULL,
  `si_user_id` mediumint(4) NOT NULL,
  PRIMARY KEY (`si_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS stock_entries_out;
CREATE TABLE `stock_entries_out` (
  `so_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `so_product_id` mediumint(4) NOT NULL,
  `so_quantity` int(4) NOT NULL,
  `so_entry_date` date NOT NULL,
  `so_dest_ware_id` mediumint(4) NOT NULL,
  `so_user_id` mediumint(4) NOT NULL,
  PRIMARY KEY (`so_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS uom;
CREATE TABLE `uom` (
  `uom_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL,
  `last_login` timestamp(6) NULL DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `activation_selector` (`activation_selector`),
  UNIQUE KEY `forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS users_groups;
CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS users_permissions;
CREATE TABLE `users_permissions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) NOT NULL,
  `perm_id` mediumint(8) NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `perm_id` (`perm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS vehicule;
CREATE TABLE `vehicule` (
  `vehicule_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `vehicule_brand` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`vehicule_id`),
  UNIQUE KEY `vehicule_brand` (`vehicule_brand`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS version;
CREATE TABLE `version` (
  `current_version` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS warehouses;
CREATE TABLE `warehouses` (
  `warehouse_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `warehouse_name` varchar(20) NOT NULL,
  `warehouse_address` varchar(50) NOT NULL,
  PRIMARY KEY (`warehouse_id`),
  UNIQUE KEY `warehouse_name` (`warehouse_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS warehouse_stock;
CREATE TABLE `warehouse_stock` (
  `ws_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `ws_product_id` mediumint(4) NOT NULL,
  `warehouse_id` mediumint(4) NOT NULL,
  `ws_quantity` int(4) NOT NULL,
  `updated_date` date NOT NULL,
  PRIMARY KEY (`ws_id`),
  KEY `ws_FK_ID` (`warehouse_id`),
  CONSTRAINT `ws_FK_ID` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`warehouse_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS zone_location;
CREATE TABLE `zone_location` (
  `zone_id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(20) NOT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

CREATE OR REPLACE VIEW `critical_stock_view` AS select `product`.`product_id` AS `pid`,`product`.`product_code` AS `pcode`,`product`.`product_name` AS `pname`,`product`.`product_uom` AS `uom`,`product`.`min_qty` AS `min_qty`,`last_update_stock`.`lus_quantity` AS `actual_quantity` from (`product` join `last_update_stock`) where ((`product`.`product_id` = `last_update_stock`.`lus_product_id`) and (`product`.`min_qty` = `last_update_stock`.`lus_quantity`)) order by `product`.`product_name`;

CREATE OR REPLACE VIEW `list_of_stock_view` AS select `product`.`product_id` AS `pid`,`product`.`product_code` AS `pcode`,`product`.`product_name` AS `pname`,`product`.`product_uom` AS `uom`,`product`.`min_qty` AS `min_qty`,`last_update_stock`.`lus_quantity` AS `qty` from (`product` join `last_update_stock`) where (`product`.`product_id` = `last_update_stock`.`lus_product_id`) order by `product`.`product_name`;

CREATE OR REPLACE VIEW `so_entries_out_view` AS select `product`.`product_name` AS `name`,`stock_entries_out`.`so_entry_date` AS `entry_date`,`stock_entries_out`.`so_quantity` AS `quantity`,`warehouses`.`warehouse_name` AS `warehouse_name` from ((`product` join `stock_entries_out`) join `warehouses`) where ((`product`.`product_id` = `stock_entries_out`.`so_product_id`) and (`stock_entries_out`.`so_dest_ware_id` = `warehouses`.`warehouse_id`)) order by `stock_entries_out`.`so_entry_date` desc;

INSERT INTO acl_modules(id,module_name,group_id,value) VALUES(1,'badmin',1,1),(2,'badmin',2,1),(3,'dashboard',1,1),(4,'dashboard',2,1),(5,'dashboard',3,1),(6,'module',1,1),(7,'module',2,1),(8,'product',1,1),(9,'product',2,1),(10,'warehouse',1,1),(11,'warehouse',2,1),(12,'pos',1,1),(13,'pos',1,1),(14,'pos',2,1);

INSERT INTO categories(cat_id,cat_name,cat_description) VALUES(1,'MOTEUR','pieces moteur'),(2,'SUSPENSSION','pieces suspenssion'),(3,'ACCESSOIRE','LES ACCESSOIRES');

INSERT INTO ci_sessions(id,ip_address,timestamp,data) VALUES('2b343004db582b4d1ab56835fbea53c867225d0d','127.0.0.1',16777215,X'5f5f63695f6c6173745f726567656e65726174657c693a313632383739373732363b736974655f6c616e677c733a373a22656e676c697368223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383739363232353b'),('4ed4b44d6236429a0ff2a85e7c653d2119c43539','127.0.0.1',16777215,X'5f5f63695f6c6173745f726567656e65726174657c693a313632383830303835353b736974655f6c616e677c733a373a22656e676c697368223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383739363232353b'),('702b466be1de6db9799d560e2cb00f5132c79c5c','127.0.0.1',16777215,X'5f5f63695f6c6173745f726567656e65726174657c693a313632383830303835363b'),('98ad85a52e7b08ec4a937f156b099120f7eca18f','127.0.0.1',16777215,X'5f5f63695f6c6173745f726567656e65726174657c693a313632383739373135363b736974655f6c616e677c733a373a22656e676c697368223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383739363232353b'),('f8b62799eb5d124dceec36320b59032df0cd3085','127.0.0.1',16777215,X'5f5f63695f6c6173745f726567656e65726174657c693a313632383739383134343b736974655f6c616e677c733a373a22656e676c697368223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383739363232353b');

INSERT INTO groups(id,name,description) VALUES(1,'Super','Super User'),(2,'Admin','Administrator');

INSERT INTO groups_permissions(id,group_id,perm_id,value) VALUES(1,1,1,1),(2,1,2,1),(3,1,3,1),(4,1,4,1),(5,2,1,1),(6,2,2,1),(7,2,3,1),(8,2,4,0);


INSERT INTO last_update_stock(lus_product_id,lus_quantity,lus_prod_loc_id,lus_prod_loc_description,lus_updated_date) VALUES(1,81,1,'zone A SUR ETAGERE 10 A rqnger 3\t\t\t\t\t\t\t\t','2021-08-11'),(3,500,2,'zone A SUR ETAGERE 10 A rqnger 3\t\t\t\t\t\t\t\t','2021-08-11');


INSERT INTO migrations(module,version) VALUES('CI_core',1),('auth\\',2),('badmin\\',1),('dashboard\\',1),('module\\',1),('product\\',1),('warehouse\\',1);

INSERT INTO modules(id,module_name,module_display_name,module_description,module_status,module_version,license_key,license_status,required_module,is_preloaded) VALUES(1,'auth','Authorization','Handle your authentification for your app and manage the access control level',1,'1.0.',NULL,NULL,NULL,1),(2,'admin','Administration','This extension handle all your administration operation and management',1,'1.0.',NULL,NULL,NULL,1),(3,'dashboard','Dashboard','connect information for other extension to your dashbord',1,'1.0.',NULL,NULL,NULL,1),(4,'module','Module management','This extension Helps you manage all your extensions',1,'1.0',NULL,NULL,NULL,1),(5,'product','Product management','This extension Helps you manage all your products',1,'1.0',NULL,NULL,NULL,1),(6,'warehouse','Gestion stock','This extension handle all your stock operations and management',1,'1.0.',NULL,NULL,NULL,1),(7,'pos','Point de vente','la facturation des produits',1,'1.0','1',NULL,NULL,1);

INSERT INTO navigation_menu(id,name,url,icon,icon-name,text,parent,order,perm_key) VALUES(1,'dashboard','dashboard','fa-tachometer-alt','dashboard','dashboard','dashboard',1,'R'),(2,'badmin','','fa-cog','','administration','',900,'R'),(3,'users','badmin/users','material-icons','','Users','badmin',910,'R'),(4,'group_permission','badmin/groups_permissions','material-icons','','Groups & Permissions','badmin',920,'R'),(5,'module','','fa-th-large21`','apps','Modules','',1000,'A'),(6,'list_module','module','material-icons','apps','Extensions','module',1100,'A'),(7,'product','','fa-th-large21`','apps','Articles','',200,'A'),(8,'list_product','product/list','material-icons','apps','Liste des articles','product',210,'A'),(9,'create_product','product/create','material-icons','apps','Ajouter article','product',220,'A'),(10,'warehouse','','fa-cog','','Gestion stock','',300,'R'),(11,'check_stock','warehouse/check','material-icons','','Voir stock','warehouse',310,'R'),(12,'entry_in','warehouse/entry_in','material-icons','','Entrée stock','warehouse',320,'R'),(13,'entry_out','warehouse/entry_out','material-icons','','Sortie stock','warehouse',330,'R'),(14,'pos',NULL,'fa-th-large21`','apps','Points de vente',NULL,400,'W'),(15,'invoicing','pos/invoicing','materials-icons','apps','Facturation','pos',410,'W'),(16,'check_pos','pos/check','materials-icons','apps','Voir dépôt','pos',420,'R');

INSERT INTO permissions(id,perm_key,perm_name) VALUES(1,'R','Read'),(2,'W','Write'),(3,'A','Admin'),(4,'S','Super');



INSERT INTO product(product_id,product_code,product_name,unit_price,min_qty,product_brand,product_model,product_cat_id,product_uom,product_currency,product_vehicule_id,product_status) VALUES(1,'1145A','FILTRE',8000,200,'N/A','N/A',3,'PIECE','CDF',4,1),(2,'1145b','FILTRE',8000,200,'N/A','N/A',1,'PIECE','CDF',2,1),(3,'1155g','FREIN',35000,200,'N/A','N/A',2,'PIECE','CDF',4,1);

INSERT INTO product_location(prod_loc_id,prod_loc_prod_id,prod_loc_zone_id,prod_loc_shelf_id) VALUES(1,1,1,1),(2,3,3,4);

INSERT INTO shelf_location(shelf_id,shelf_name) VALUES(1,'ETAGERE 1'),(2,'ETAGERE 2'),(4,'ETAGERE 4'),(5,'ETAGERE 5'),(6,'ETAGERE 6'),(3,'ETAGERE`3 ');

INSERT INTO stock_entries_in(si_id,si_product_id,si_quantity,si_entry_date,si_user_id) VALUES(1,1,100,'2021-08-11',1),(2,3,500,'2021-08-11',1);

INSERT INTO stock_entries_out(so_id,so_product_id,so_quantity,so_entry_date,so_dest_ware_id,so_user_id) VALUES(1,1,10,'2021-08-11',1,1),(2,1,9,'2021-08-11',1,1);

INSERT INTO uom(uom_name) VALUES('BOUTEILLE'),('PIECE'),('CARTON'),('LITRE');

INSERT INTO users(id,ip_address,username,password,email,activation_selector,activation_code,forgotten_password_selector,forgotten_password_code,forgotten_password_time,remember_selector,remember_code,created_on,last_login,active,first_name,last_name,company,phone) VALUES(1,'127.0.0.1','admin','$2y$10$F2ad37HKlWfAn1D1SKrub.qFKywPd1YOK/OPgDoggnqx4Yd5cg9XS','admin@admin.com',NULL,'',NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00.000000','0000-00-00 00:00:00.000000',1,'cedric','mataso','lemondrop sarl','0975899576');

INSERT INTO users_groups(id,user_id,group_id) VALUES(1,1,1);

INSERT INTO users_permissions(id,user_id,perm_id,value) VALUES(1,1,1,1),(2,1,2,1),(3,1,3,1),(4,1,4,1);

INSERT INTO vehicule(vehicule_id,vehicule_brand,isActive) VALUES(1,'TOYOTA HARRIER',1),(2,'TOYOTA CARINA',1),(3,'TOYOTA RAV 4',1),(4,'NISSAN DUALIS',1);


INSERT INTO warehouses(warehouse_id,warehouse_name,warehouse_address) VALUES(1,'pos1-depot','ville');

INSERT INTO warehouse_stock(ws_id,ws_product_id,warehouse_id,ws_quantity,updated_date) VALUES(1,1,1,19,'2021-08-11');
INSERT INTO zone_location(zone_id,zone_name) VALUES(1,'ZONE A'),(2,'ZONE B'),(3,'ZONE C'),(4,'ZONE D'),(5,'ZONE E'),(6,'ZONE F');