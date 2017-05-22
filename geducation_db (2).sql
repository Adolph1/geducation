-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2017 at 12:23 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geducation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Accountant', '5', 1495445064),
('admin', '1', 1494495483),
('BranchManager', '3', 1494497284),
('BranchManager', '4', 1494499921),
('BranchManager', '7', 1495292116),
('BranchManager', '8', 1495291617);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Accountant', 1, 'Accountant', NULL, NULL, 1494495973, 1495279287),
('admin', 1, 'Administrator', NULL, NULL, 1488263546, 1488263546),
('BranchManager', 1, 'Branch Manager', NULL, NULL, 1494495932, 1494495932),
('createExpenditure', 2, 'createExpenditure', NULL, NULL, NULL, NULL),
('createUser', 2, 'createUser', NULL, NULL, NULL, NULL),
('verifyExpenditure', 2, 'can verify expenditure', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Accountant', 'createExpenditure'),
('Accountant', 'createUser'),
('Accountant', 'verifyExpenditure'),
('admin', 'createExpenditure'),
('admin', 'createUser'),
('BranchManager', 'createExpenditure');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m130524_201442_init', 1494491735),
('m140506_102106_rbac_init', 1494491735),
('m170113_151537_create_tbl_payment_method_table', 1495180824),
('m170113_160533_create_tbl_system_module_table', 1494491736),
('m170115_104820_create_tbl_audit_table', 1494491736),
('m170207_111738_create_tbl_report_table', 1494491736),
('m170302_081315_create_tbl_branch_table', 1494491736),
('m170308_140213_create_tbl_employee_table', 1494491737),
('m170511_081819_create_tbl_expenditure_table', 1495177571),
('m170519_064908_create_tbl_department_table', 1495176678),
('m170519_082825_create_tbl_expenditure_type_table', 1495182582);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit`
--

CREATE TABLE `tbl_audit` (
  `id` int(11) NOT NULL,
  `activity` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `module` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`id`, `branch_name`, `location`) VALUES
(1, 'Arusha', 'Arusha'),
(2, 'Dodoma', 'Dodoma'),
(3, 'Mbeya', 'Mbeya'),
(4, 'Mwanza', 'Mwanza'),
(5, 'Dar es salaam', 'Dar es salaam'),
(6, 'Zanzibar', 'Zanzibar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `dept_name`) VALUES
(1, 'Online'),
(2, 'Marketing'),
(3, 'Corporate'),
(4, 'Operations');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `job_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `job_title`, `branch_id`, `department_id`, `maker_id`, `maker_time`) VALUES
(2, 'Adolph', '', 'Mwakalinga', '1985-11-05', 'Application Software Manager', 3, 1, NULL, NULL),
(3, 'Juma', '', 'Mwidady', '1989-11-23', 'Branch Manager', 4, 2, NULL, NULL),
(4, 'James', '', 'Chotta', '1989-06-21', 'Accountant', 5, 4, NULL, NULL),
(5, 'Christina', 'G', 'Moshi', '1992-09-30', 'Branch manager', 5, 2, NULL, NULL),
(6, 'Hussein', '', 'Hamis', '1989-07-12', 'Marketing Manager', 1, 2, NULL, NULL),
(7, 'Diamond', '', 'Edward', '1999-02-17', 'Marketing Manager', 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenditure`
--

CREATE TABLE `tbl_expenditure` (
  `id` int(11) NOT NULL,
  `exp_dt` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `fund_source` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_no` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delete_stat` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL,
  `checker` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_expenditure`
--

INSERT INTO `tbl_expenditure` (`id`, `exp_dt`, `amount`, `type`, `description`, `branch_id`, `department_id`, `fund_source`, `payment_method`, `reference_no`, `attachment`, `status`, `delete_stat`, `maker_id`, `maker_time`, `checker`, `checker_time`) VALUES
(1, '2017-05-19', '10000', 2, 'Electricity', 4, 2, 'I', '1', 'HHJJRR', 'Screen Shot 2017-05-18 at 5.15.46 PM.png', 'A', '', 'juma.mwidady', '2017-05-19 20:15:36', 'James.Chotta', '2017-05-20 14:51:55'),
(2, '2017-05-19', '10000', 1, 'Electricity', 4, 2, 'I', '2', 'T14524 7787', 'Purchases.pdf', 'A', '', 'juma.mwidady', '2017-05-19 20:14:17', 'James.Chotta', '2017-05-20 16:38:24'),
(3, '2017-05-02', '10000', 2, 'Electricity', 3, 1, 'O', '3', 'MP20909', 'Mbeya--3.jpg', 'A', '', 'Adolph.Mwakalinga', '2017-05-19 16:31:00', 'James.Chotta', '2017-05-20 17:22:35'),
(4, '2017-05-19', '10000', 2, 'Electricity', 4, 2, 'I', '1', 'YYYYY', 'cover letter lapf.doc', 'U', 'D', 'juma.mwidady', '2017-05-19 17:39:15', NULL, NULL),
(5, '2017-05-20', '25000', 2, 'Visa application', 5, 4, 'O', '1', 'T14524 7787', 'Dar es salaam--5.jpg', 'A', '', 'James.Chotta', '2017-05-20 15:44:07', 'James.Chotta', '2017-05-20 17:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenditure_type`
--

CREATE TABLE `tbl_expenditure_type` (
  `id` int(11) NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maker_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_expenditure_type`
--

INSERT INTO `tbl_expenditure_type` (`id`, `type`, `department_id`, `maker_id`, `maker_time`) VALUES
(1, 'Bill', 0, 'admin', '2017-05-19 11:56:13'),
(2, 'Visa Application', 1, 'admin', '2017-05-19 11:58:05'),
(3, 'Transport', 0, 'admin', '2017-05-19 12:13:38'),
(4, 'Facilitation', 1, 'admin', '2017-05-19 12:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_method`
--

CREATE TABLE `tbl_payment_method` (
  `id` int(11) NOT NULL,
  `method_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_payment_method`
--

INSERT INTO `tbl_payment_method` (`id`, `method_name`) VALUES
(1, 'Cash'),
(2, 'Checque'),
(3, 'M-Pesa'),
(4, 'TigoPesa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `id` int(11) NOT NULL,
  `report_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `module` int(11) DEFAULT NULL,
  `path` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system_module`
--

CREATE TABLE `tbl_system_module` (
  `id` int(11) NOT NULL,
  `module_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `maker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `maker_time` datetime NOT NULL,
  `auth_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checker_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `checker_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `role` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `emp_id`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$13$hL1ToYc0uK7D4Fe8RqLX7efpw', '$2y$13$GybRsPFGaR32t.jFiPBnS.93Pigv2b8Qvjm3RO4oX7cWyXI.fbY7W', '', 'adolph.cm@gmail.com', 0, '1', 10, 20170511, 1494495483),
(3, 'Adolph.Mwakalinga', 'zTyCiMR2Dn-yXVnEJscAbSYrZoCuefgl', '$2y$13$Wo572fTLQmYGjc0bM9iqiuQlTOjz60SBtGksQUcrdAxfxm0xtQpDq', 'gGJn6HhiR3x7qhiH8SvTw5vGn2yO8AT8_1494495410', 'admin@gmail.com', 2, 'BranchManager', 10, 1494495410, 1494497284),
(4, 'juma.mwidady', 'BYJMGzDZzl58R9nh1kvgAXF2Gku7_WmO', '$2y$13$7EnW5cLpz.24IlEqn/OvxulYyyeOTwx77Udo5VqO4FkHdZeUNK8va', 'aWzOfLmY_0Rz7NZvFcRo1EY5ScncU3or_1494499843', 'jmwidady@yahoo.com', 3, 'BranchManager', 10, 1494499842, 1494499921),
(5, 'James.Chotta', 'lHB5zdy0y-3WZpSQhoHyZgykz9ZG6jz3', '$2y$13$WIInHArckyqYZ9LE7VvOquaKQnPIvexRte3MTUNyhGoxKJ52JapTu', 'i8U5EDwfqxct1paEz2nNph3sjEFAI4nT_1495445065', 'james@yahoo.com', 4, 'Accountant', 10, 1494501110, 1494501124),
(6, 'christina.moshi', 'zX2BdOEMVi7FHDtpdnfoWzA7qSWmELcv', '$2y$13$4c.HO4IX3uzt7Ri3eztw6.WNXwhKZWZ6oDc.gEdsDL7dvCM3DQHfG', 'kdmyrIFGdIhEb232Gn0PN1BXlMatlfnV_1495186885', 'moshichristina@gmail.com', 5, 'BranchManager', 10, 1495186885, 1495186885),
(7, 'Hussein.Hamisi', 'tY7Rdn4-wwXgUyk34a-YnRJ4pBxl4zKx', '$2y$13$4IJeQyZlc70NIGp6TbtLnOQYCdtt46efx0Oa3oxqPbwJ95xO600R2', 'Le-hkyHd2RwPHVPo5ZFiqTMOLqBzR4Y5_1495290775', 'man@gmail.com', 6, 'BranchManager', 10, 1495290775, 1495292116),
(8, 'Dimo', '5KmJ4aEpwtKqqHzuDHYf6wOb-aneoRZv', '$2y$13$nUe0dz0X0sZIi7mQ1zsF9eZWjb7l.Lc3mgSpfp5Tp71GZu.6/UEZK', 'V6i9uHeC-dITDnF2sXx5HA73xicDW0ax_1495291617', 'dimo@gmail.com', 7, 'BranchManager', 10, 1495291616, 1495291616);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_employee-branch_id` (`branch_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `tbl_expenditure`
--
ALTER TABLE `tbl_expenditure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_expenditure-branch_id` (`branch_id`);

--
-- Indexes for table `tbl_expenditure_type`
--
ALTER TABLE `tbl_expenditure_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_report-module` (`module`);

--
-- Indexes for table `tbl_system_module`
--
ALTER TABLE `tbl_system_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `emp_id` (`emp_id`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_audit`
--
ALTER TABLE `tbl_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_expenditure`
--
ALTER TABLE `tbl_expenditure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_expenditure_type`
--
ALTER TABLE `tbl_expenditure_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_system_module`
--
ALTER TABLE `tbl_system_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `fk-tbl_employee-branch_id` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`id`),
  ADD CONSTRAINT `fk-tbl_employee-department_id` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`id`);

--
-- Constraints for table `tbl_expenditure`
--
ALTER TABLE `tbl_expenditure`
  ADD CONSTRAINT `fk-tbl_expenditure-branch_id` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branch` (`id`);

--
-- Constraints for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD CONSTRAINT `fk-tbl_purchase_cost-module` FOREIGN KEY (`module`) REFERENCES `tbl_system_module` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
