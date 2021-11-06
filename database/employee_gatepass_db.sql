-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 06:50 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_gatepass_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'IT Department', 'Information Technology Department', 1, '2021-11-04 08:46:01', '2021-11-04 08:46:01'),
(2, 'HR Department', 'Human Resource Department', 1, '2021-11-04 08:46:16', '2021-11-04 08:46:16'),
(3, 'Accounting and Finance', 'Accounting and Finance Department', 1, '2021-11-04 08:46:48', '2021-11-04 08:46:48'),
(4, 'Marketing Department', 'Marketing Department', 1, '2021-11-04 08:46:59', '2021-11-04 08:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `designation_list`
--

CREATE TABLE `designation_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation_list`
--

INSERT INTO `designation_list` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Department Head', 'Head of the Department', 1, '2021-11-04 08:51:19', '2021-11-04 08:51:19'),
(2, 'Sr. Web Developer', 'Senior Web Developer', 1, '2021-11-04 08:51:39', '2021-11-04 08:51:39'),
(3, 'Jr. Web Developer', 'Junior Web Developer', 1, '2021-11-04 08:52:00', '2021-11-04 08:52:00'),
(4, 'Technical Project Manager', 'Technical Project Manager', 1, '2021-11-04 08:53:02', '2021-11-04 08:53:02'),
(5, 'Project Manager', 'Project Manager', 1, '2021-11-04 08:53:17', '2021-11-04 08:53:17'),
(6, 'Senior Manager IT', 'Senior Manager IT', 1, '2021-11-04 08:53:26', '2021-11-04 08:53:26'),
(7, 'Accounting and Finance Manager', 'Accounting and Finance Manager', 1, '2021-11-04 08:54:23', '2021-11-04 08:54:23'),
(8, 'Accounting and Finance Staff', 'Accounting and Finance Staff', 1, '2021-11-04 08:54:32', '2021-11-04 08:54:32'),
(9, 'Graphic Designer', 'Graphic Designer', 1, '2021-11-04 08:54:47', '2021-11-04 08:54:47'),
(10, 'Social Media Manager', 'Social Media Manager', 1, '2021-11-04 08:55:00', '2021-11-04 08:55:00'),
(11, 'Marketing Manager', 'Marketing Manager', 1, '2021-11-04 08:55:08', '2021-11-04 08:55:08'),
(12, 'HR Manager', 'HR Manager', 1, '2021-11-04 08:55:23', '2021-11-04 08:55:23'),
(13, 'HR Office Clerk', 'HR Office Clerk', 1, '2021-11-04 08:55:37', '2021-11-04 08:55:37'),
(14, 'HR Office Staff', 'HR Office Staff', 1, '2021-11-04 08:55:43', '2021-11-04 08:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE `employee_list` (
  `id` int(30) NOT NULL,
  `employee_code` varchar(50) NOT NULL,
  `department_id` int(30) DEFAULT NULL,
  `designation_id` int(30) DEFAULT NULL,
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active, 2= Inactive',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`id`, `employee_code`, `department_id`, `designation_id`, `fullname`, `status`, `date_created`, `date_updated`) VALUES
(1, '2021-0001', 1, 2, 'Smith, Johnny D', 1, '2021-11-04 10:30:37', '2021-11-04 10:44:21'),
(2, '2021-0002', 2, 12, 'Blake, Claire C', 1, '2021-11-04 10:49:18', '2021-11-04 10:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `employee_meta`
--

CREATE TABLE `employee_meta` (
  `employee_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_meta`
--

INSERT INTO `employee_meta` (`employee_id`, `meta_field`, `meta_value`) VALUES
(1, 'lastname', 'Smith'),
(1, 'firstname', 'Johnny'),
(1, 'middlename', 'D'),
(1, 'gender', 'Male'),
(1, 'dob', '1997-06-23'),
(1, 'contact', '09546699871'),
(1, 'address', 'Sample Address Only'),
(1, 'email', 'jsmith@sample.com'),
(2, 'lastname', 'Blake'),
(2, 'firstname', 'Claire'),
(2, 'middlename', 'C'),
(2, 'gender', 'Female'),
(2, 'dob', '1997-10-14'),
(2, 'contact', '09123456789'),
(2, 'address', 'Sample address 2'),
(2, 'email', 'cblake@sample.com');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=In, 2= Out',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `employee_id`, `type`, `date_created`) VALUES
(1, 2, 1, '2021-11-04 21:52:29'),
(2, 1, 2, '2021-11-04 21:52:36'),
(3, 2, 1, '2021-11-04 21:52:42'),
(4, 2, 2, '2021-11-04 21:52:48'),
(5, 2, 1, '2021-11-05 12:16:20'),
(6, 2, 2, '2021-11-05 12:16:47'),
(7, 2, 1, '2021-11-05 12:16:59'),
(8, 1, 1, '2021-11-05 12:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'COMPUBINARIO - CONTROL DE ACCESSO AL EDIFICIO'),
(6, 'short_name', 'ON LINE'),
(11, 'logo', 'uploads/logo-1635986546.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1635986546.png'),
(15, 'content', 'Array');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1635556826', NULL, 1, '2021-01-20 14:02:37', '2021-10-30 09:20:26'),
(11, 'Claire', NULL, 'Blake', 'cblake', 'cd74fae0a3adf459f73bbf187607ccea', 'uploads/avatar-11.png?v=1635920566', NULL, 1, '2021-11-03 14:22:46', '2021-11-03 14:22:46'),
(13, 'John', NULL, 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', 'uploads/avatar-13.png?v=1636035589', NULL, 2, '2021-11-04 22:19:49', '2021-11-04 22:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `user_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `purpose` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = In, 2 =Out',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `name`, `contact`, `address`, `purpose`, `type`, `date_created`) VALUES
(1, 'Mike Williams', '0912365469', 'Sample Address', 'Invited to attend a meeting.', 1, '2021-11-03 22:14:22'),
(2, 'Samantha Jane Lou', '098556644555', 'Sample Address 2', 'Sample only', 1, '2021-11-04 22:14:45'),
(3, 'Mike Williamns', '0912356987', 'Sample Address 2', 'Sample', 2, '2021-11-03 22:14:54'),
(4, 'Samantha Jane Lou', '09887865444', 'Sample Address 2', 'Sample only', 2, '2021-11-04 22:14:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation_list`
--
ALTER TABLE `designation_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `designation_id` (`designation_id`);

--
-- Indexes for table `employee_meta`
--
ALTER TABLE `employee_meta`
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designation_list`
--
ALTER TABLE `designation_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD CONSTRAINT `employee_list_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_list` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `employee_list_ibfk_2` FOREIGN KEY (`designation_id`) REFERENCES `designation_list` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `employee_meta`
--
ALTER TABLE `employee_meta`
  ADD CONSTRAINT `employee_meta_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
