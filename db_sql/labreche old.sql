-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2021 at 06:41 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labreche`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_modules`
--

CREATE TABLE `acl_modules` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `module_name` varchar(30) NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `module_name`, `group_id`, `value`) VALUES
(1, 'badmin', 1, 1),
(2, 'badmin', 2, 1),
(3, 'dashboard', 1, 1),
(4, 'dashboard', 2, 1),
(5, 'dashboard', 3, 1),
(6, 'module', 1, 1),
(7, 'module', 2, 1),
(8, 'product', 1, 1),
(9, 'product', 2, 1),
(10, 'warehouse', 1, 1),
(11, 'warehouse', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` mediumint(4) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(1, 'moteur', 'TOUTES PIECES DU MOTEUR');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` mediumint(11) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1156db78c4bc2b242168d1e8b52c3b2935396bfa', '127.0.0.1', 16777215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632383134353231303b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383134333636313b736974655f6c616e677c733a373a22656e676c697368223b),
('2a5a1b63fd59e906620c8dac38ce8e3d8cfb60a4', '127.0.0.1', 16777215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632383134343439333b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383134333636313b736974655f6c616e677c733a373a22656e676c697368223b),
('d78f7d9491eebf67f7b3ee6dc7304f234148f4a8', '127.0.0.1', 16777215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632383134353231303b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383134333636313b736974655f6c616e677c733a373a22656e676c697368223b),
('f5d5360c15f62ac8af3fcfc0fdd6e9b05733094c', '127.0.0.1', 16777215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632383134343739353b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a31353a2261646d696e4061646d696e2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a32363a22303030302d30302d30302030303a30303a30302e303030303030223b6c6173745f636865636b7c693a313632383134333636313b736974655f6c616e677c733a373a22656e676c697368223b);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'Super', 'Super User'),
(2, 'Admin', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `groups_permissions`
--

CREATE TABLE `groups_permissions` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  `perm_id` mediumint(8) UNSIGNED NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_permissions`
--

INSERT INTO `groups_permissions` (`id`, `group_id`, `perm_id`, `value`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 2, 1, 1),
(6, 2, 2, 1),
(7, 2, 3, 1),
(8, 2, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `last_update_stock`
--

CREATE TABLE `last_update_stock` (
  `lus_product_id` mediumint(4) NOT NULL,
  `lus_quantity` int(4) NOT NULL,
  `lus_prod_loc_id` mediumint(4) NOT NULL,
  `lus_min_quantity` int(4) NOT NULL,
  `lus_updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `module` varchar(20) NOT NULL,
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`module`, `version`) VALUES
('CI_core', 1),
('auth\\', 2),
('badmin\\', 1),
('dashboard\\', 1),
('module\\', 1),
('product\\', 1),
('warehouse\\', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_display_name` varchar(50) NOT NULL,
  `module_description` varchar(250) NOT NULL,
  `module_status` tinyint(1) UNSIGNED NOT NULL,
  `module_version` varchar(4) NOT NULL,
  `license_key` varchar(150) DEFAULT NULL,
  `license_status` varchar(50) DEFAULT NULL,
  `required_module` varchar(50) DEFAULT NULL,
  `is_preloaded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `module_display_name`, `module_description`, `module_status`, `module_version`, `license_key`, `license_status`, `required_module`, `is_preloaded`) VALUES
(1, 'auth', 'Authorization', 'Handle your authentification for your app and manage the access control level', 1, '1.0.', NULL, NULL, NULL, 1),
(2, 'admin', 'Administration', 'This extension handle all your administration operation and management', 1, '1.0.', NULL, NULL, NULL, 1),
(3, 'dashboard', 'Dashboard', 'connect information for other extension to your dashbord', 1, '1.0.', NULL, NULL, NULL, 1),
(4, 'module', 'Module management', 'This extension Helps you manage all your extensions', 1, '1.0', NULL, NULL, NULL, 1),
(5, 'product', 'Product management', 'This extension Helps you manage all your products', 1, '1.0', NULL, NULL, NULL, 1),
(6, 'warehouse', 'Gestion stock', 'This extension handle all your stock operations and management', 1, '1.0.', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `navigation_menu`
--

CREATE TABLE `navigation_menu` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `icon-name` varchar(50) DEFAULT NULL,
  `text` varchar(50) NOT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `order` int(11) UNSIGNED NOT NULL,
  `perm_key` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `navigation_menu`
--

INSERT INTO `navigation_menu` (`id`, `name`, `url`, `icon`, `icon-name`, `text`, `parent`, `order`, `perm_key`) VALUES
(1, 'dashboard', 'dashboard', 'fa-tachometer-alt', 'dashboard', 'dashboard', 'dashboard', 1, 'R'),
(2, 'badmin', '', 'fa-cog', '', 'administration', '', 900, 'R'),
(3, 'users', 'badmin/users', 'material-icons', '', 'Users', 'badmin', 910, 'R'),
(4, 'group_permission', 'badmin/groups_permissions', 'material-icons', '', 'Groups & Permissions', 'badmin', 920, 'R'),
(5, 'module', '', 'fa-th-large21`', 'apps', 'Modules', '', 1000, 'A'),
(6, 'list_module', 'module', 'material-icons', 'apps', 'Extensions', 'module', 1100, 'A'),
(7, 'product', '', 'fa-th-large21`', 'apps', 'Articles', '', 200, 'A'),
(8, 'list_product', 'product/list', 'material-icons', 'apps', 'Liste des articles', 'product', 210, 'A'),
(9, 'create_product', 'product/create', 'material-icons', 'apps', 'Ajouter article', 'product', 220, 'A'),
(10, 'warehouse', '', 'fa-cog', '', 'Gestion stock', '', 300, 'R'),
(11, 'check_stock', 'warehouse/check', 'material-icons', '', 'Voir stock', 'warehouse', 310, 'R'),
(12, 'entry_in', 'warehouse/entry_in', 'material-icons', '', 'Entrée stock', 'warehouse', 320, 'R'),
(13, 'entry_out', 'warehouse/entry_in', 'material-icons', '', 'Sortie stock', 'warehouse', 330, 'R');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `perm_key` varchar(30) NOT NULL,
  `perm_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `perm_key`, `perm_name`) VALUES
(1, 'R', 'Read'),
(2, 'W', 'Write'),
(3, 'A', 'Admin'),
(4, 'S', 'Super');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` mediumint(4) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `unit_price` double NOT NULL,
  `product_brand` varchar(20) DEFAULT NULL,
  `product_model` varchar(20) DEFAULT NULL,
  `product_cat_id` mediumint(4) NOT NULL,
  `product_uom` varchar(20) NOT NULL,
  `product_currency` varchar(3) NOT NULL,
  `product_vehicule_id` mediumint(4) NOT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_location`
--

CREATE TABLE `product_location` (
  `prod_loc_id` mediumint(4) NOT NULL,
  `prod_loc_prod_id` mediumint(4) NOT NULL,
  `prod_loc_zone_id` mediumint(4) NOT NULL,
  `prod_loc_shelf_id` mediumint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shelf_location`
--

CREATE TABLE `shelf_location` (
  `shelf_id` mediumint(4) NOT NULL,
  `shelf_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_entries_in`
--

CREATE TABLE `stock_entries_in` (
  `si_id` mediumint(4) NOT NULL,
  `si_product_id` mediumint(4) NOT NULL,
  `si_quantity` int(4) NOT NULL,
  `si_entry_date` date NOT NULL,
  `si_user_id` mediumint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_entries_out`
--

CREATE TABLE `stock_entries_out` (
  `so_id` mediumint(4) NOT NULL,
  `so_product_id` mediumint(4) NOT NULL,
  `so_quantity` int(4) NOT NULL,
  `so_entry_date` date NOT NULL,
  `so_dest_ware_id` mediumint(4) NOT NULL,
  `so_user_id` mediumint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `uom_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`uom_name`) VALUES
('BOUTEILLE'),
('PIECE'),
('CARTON'),
('LITRE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL,
  `last_login` timestamp(6) NULL DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2y$10$8s1I.56jJsVu/vsiASuS1.CpUA7ge.Cqy8D8BiFSXzjLL.ed.44r.', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000', 1, 'CEDRIC', 'MATASO', 'LEMONDROP SARL', '0975899576');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `perm_id` mediumint(8) NOT NULL,
  `value` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`id`, `user_id`, `perm_id`, `value`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE `vehicule` (
  `vehicule_id` mediumint(4) NOT NULL,
  `vehicule_brand` varchar(50) NOT NULL,
  `vehicule_model` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`vehicule_id`, `vehicule_brand`, `vehicule_model`, `isActive`) VALUES
(1, 'TOYOTA', 'RAV4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `current_version` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `warehouse_id` mediumint(4) NOT NULL,
  `warehouse_name` varchar(20) NOT NULL,
  `warehouse_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock`
--

CREATE TABLE `warehouse_stock` (
  `ws_id` mediumint(4) NOT NULL,
  `ws_product_id` mediumint(4) NOT NULL,
  `warehouse_id` mediumint(4) NOT NULL,
  `ws_quantity` int(4) NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `zone_location`
--

CREATE TABLE `zone_location` (
  `zone_id` mediumint(4) NOT NULL,
  `zone_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_modules`
--
ALTER TABLE `acl_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_permissions`
--
ALTER TABLE `groups_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_update_stock`
--
ALTER TABLE `last_update_stock`
  ADD UNIQUE KEY `lus_product_id` (`lus_product_id`),
  ADD KEY `w_ID` (`lus_prod_loc_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_name` (`module_name`),
  ADD UNIQUE KEY `license_key` (`license_key`);

--
-- Indexes for table `navigation_menu`
--
ALTER TABLE `navigation_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `text` (`text`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perm_key` (`perm_key`),
  ADD UNIQUE KEY `perm_name` (`perm_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `fk_ve_id` (`product_vehicule_id`),
  ADD KEY `fk_cat_id` (`product_cat_id`);

--
-- Indexes for table `product_location`
--
ALTER TABLE `product_location`
  ADD PRIMARY KEY (`prod_loc_id`),
  ADD UNIQUE KEY `prod_loc_prod_id` (`prod_loc_prod_id`);

--
-- Indexes for table `shelf_location`
--
ALTER TABLE `shelf_location`
  ADD PRIMARY KEY (`shelf_id`),
  ADD UNIQUE KEY `shelf_name` (`shelf_name`);

--
-- Indexes for table `stock_entries_in`
--
ALTER TABLE `stock_entries_in`
  ADD PRIMARY KEY (`si_id`);

--
-- Indexes for table `stock_entries_out`
--
ALTER TABLE `stock_entries_out`
  ADD PRIMARY KEY (`so_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `perm_id` (`perm_id`);

--
-- Indexes for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`vehicule_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`warehouse_id`),
  ADD UNIQUE KEY `warehouse_name` (`warehouse_name`);

--
-- Indexes for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD PRIMARY KEY (`ws_id`),
  ADD KEY `ws_FK_ID` (`warehouse_id`);

--
-- Indexes for table `zone_location`
--
ALTER TABLE `zone_location`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl_modules`
--
ALTER TABLE `acl_modules`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` mediumint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups_permissions`
--
ALTER TABLE `groups_permissions`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `navigation_menu`
--
ALTER TABLE `navigation_menu`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_location`
--
ALTER TABLE `product_location`
  MODIFY `prod_loc_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shelf_location`
--
ALTER TABLE `shelf_location`
  MODIFY `shelf_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_entries_in`
--
ALTER TABLE `stock_entries_in`
  MODIFY `si_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_entries_out`
--
ALTER TABLE `stock_entries_out`
  MODIFY `so_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_permissions`
--
ALTER TABLE `users_permissions`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `vehicule_id` mediumint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `warehouse_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  MODIFY `ws_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zone_location`
--
ALTER TABLE `zone_location`
  MODIFY `zone_id` mediumint(4) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `last_update_stock`
--
ALTER TABLE `last_update_stock`
  ADD CONSTRAINT `w_ID` FOREIGN KEY (`lus_prod_loc_id`) REFERENCES `product_location` (`prod_loc_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_cat_id` FOREIGN KEY (`product_cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `fk_ve_id` FOREIGN KEY (`product_vehicule_id`) REFERENCES `vehicule` (`vehicule_id`);

--
-- Constraints for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD CONSTRAINT `ws_FK_ID` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`warehouse_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
