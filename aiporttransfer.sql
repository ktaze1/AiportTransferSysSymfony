-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 08:35 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aiporttransfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parentid`, `title`, `keywords`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Airport', 'none, none', 'Bus Terminal at Airports', NULL, 'Active', NULL, NULL),
(2, 1, 'International', NULL, 'Stations at international flights\' part of airport', NULL, 'Active', NULL, NULL),
(3, 0, 'City Stations', NULL, 'Stations in the city center', NULL, 'False', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` int(11) NOT NULL,
  `tranportation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `station_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `title`, `image`, `station_id`) VALUES
(4, 'fdgdfg', 'c52c8190412f0887bbc83e5af5998cc1.jpeg', 14),
(6, 'gdfg', 'd237a86709b53327f8a3acf403684821.jpeg', 10),
(7, 'Someting', 'cef7ea799bcba46458d21e545bc95ca3.jpeg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `status`) VALUES
(1, 'fdgdfg', 'kaan@gmail.com', 'sdfsjdfk', 'kfsjkfdjfk', 'true'),
(2, 'fdgdfg', 'kaan@gmail.com', 'sdfsjdfk', 'kfsjkfdjfk', NULL),
(3, 'sdfgsdf', 'kaan@gmail.com', 'sdfsdf', 'asdfasdf', NULL),
(4, 'asdfasdf', 'fasdfasdf@gdfgkdfg', 'asdfasdf', 'asdfasdf', 'new'),
(5, 'fsdfs', 'gfdfg@gfdgfg', 'fsfsdf', 'sdfsdf', 'new'),
(6, 'fsdfs', 'gfdfg@gfdgfg', 'fsfsdf', 'sdfsdf', 'new'),
(7, 'fsdfs', 'gfdfg@gfdgfg', 'fsfsdf', 'sdfsdf', 'new'),
(8, 'fsdfs', 'gfdfg@gfdgfg', 'fsfsdf', 'sdfsdf', 'new'),
(9, 'fsdfs', 'gfdfg@gfdgfg', 'fsfsdf', 'sdfsdf', 'new'),
(10, 'fsdfs', 'gfdfg@gfdgfg', 'fsfsdf', 'sdfsdf', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191119141024', '2019-11-19 14:10:51'),
('20191119143058', '2019-11-19 14:31:33'),
('20191214202404', '2019-12-14 20:33:51'),
('20191215095249', '2019-12-15 09:53:07'),
('20191215105138', '2019-12-15 10:51:48'),
('20191215113825', '2019-12-15 11:40:07'),
('20191219083957', '2019-12-19 08:40:15'),
('20191219220219', '2019-12-19 22:02:26'),
('20191219222348', '2019-12-19 22:23:52'),
('20191222112923', '2019-12-22 11:29:29'),
('20191222125027', '2019-12-22 13:11:27'),
('20191222131123', '2020-01-11 11:59:17'),
('20191222131157', '2020-01-11 11:59:17'),
('20191222131211', '2020-01-11 11:59:17'),
('20200111112249', '2020-01-11 11:59:18'),
('20200111113045', '2020-01-11 11:59:18'),
('20200111113157', '2020-01-11 11:59:18'),
('20200111114021', '2020-01-11 11:59:18'),
('20200111115914', '2020-01-11 11:59:18'),
('20200113103248', '2020-01-13 10:32:55'),
('20200113221337', '2020-01-13 22:13:52'),
('20200113223436', '2020-01-13 22:34:41'),
('20200113231234', '2020-01-13 23:12:39'),
('20200114060126', '2020-01-14 06:01:45'),
('20200114183925', '2020-01-14 18:39:32'),
('20200114183926', '2020-01-14 18:40:11'),
('20200115051737', '2020-01-15 05:17:58'),
('20200115053519', '2020-01-15 05:35:23'),
('20200115053559', '2020-01-15 05:36:03'),
('20200115072553', '2020-01-15 07:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `transportsid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departuretime` date DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `stationid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `userid`, `transportsid`, `name`, `surname`, `email`, `departuretime`, `total`, `status`, `created_at`, `updated_at`, `stationid`) VALUES
(1, 23, 10, 'kaan', 'taze', 'mail@fm.com', NULL, NULL, NULL, NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtpserver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtpemail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtppassword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtpport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aboutus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `keywords`, `description`, `company`, `address`, `phone`, `fax`, `email`, `smtpserver`, `smtpemail`, `smtppassword`, `smtpport`, `facebook`, `instagram`, `twitter`, `aboutus`, `reference`, `status`, `contact`) VALUES
(1, 'Airport', 'Airports', 'Some Airports and buses', 'THY', 'Istanbul', '+90 555 555 55 55', '+90 555 555 55 55', 'info@saw.com.tr', 'gmail@gmail.com', 'dodjf@gkflgk', '123456', '4400', 'https://facebook.com', 'https://instagram.com', 'https://twitter.com', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent imperdiet urna et efficitur efficitur. Fusce porta orci non sodales consequat. Donec eu semper nulla. Vestibulum fermentum eu augue sed placerat. Fusce condimentum, erat eu interdum lobortis, odio metus pharetra erat, sit amet tempus risus diam mollis massa. Mauris imperdiet mi vel diam lobortis pellentesque ultricies id turpis. Duis fermentum elementum nisi eget tincidunt. Vestibulum vehicula facilisis erat in vehicula.</p>\r\n\r\n<p>Nulla mi ligula, tincidunt et ligula eget, blandit vestibulum ipsum. Maecenas non ante ut dui maximus imperdiet eu id sem. Aliquam at facilisis ipsum. Proin dapibus, purus ac elementum aliquam, enim orci venenatis nisl, sed euismod purus massa non enim. Nam ut ultrices tellus. Phasellus tincidunt lacus ligula, iaculis auctor est scelerisque quis. Integer at imperdiet purus. Nulla pretium vehicula mi, laoreet ornare elit ultricies sed. Mauris efficitur velit ut elit viverra, a convallis neque pharetra. Duis posuere est dui, ut volutpat est tempor eu. Nulla finibus odio erat, ornare euismod mi dapibus vel. Phasellus tincidunt, mauris nec vehicula iaculis, arcu mauris blandit tellus, ut viverra metus leo ac tortor. Curabitur vel est ut magna imperdiet posuere.</p>\r\n\r\n<p>Vestibulum ut diam sed tellus tincidunt iaculis vel in odio. Suspendisse ultricies, ante vulputate tempor finibus, est orci tincidunt ipsum, sit amet pretium ante odio eget risus. Morbi dolor tellus, aliquam vitae consequat suscipit, facilisis a augue. Curabitur risus diam, sodales eu lectus pellentesque, bibendum elementum nibh. Vestibulum a auctor quam. Cras nec odio nec sem vestibulum vestibulum sit amet ac enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce suscipit euismod ex id dapibus.</p>\r\n\r\n<p>Vestibulum nec felis neque. Praesent purus ex, pulvinar vitae odio ut, rutrum lacinia justo. Nunc bibendum urna at nisi rutrum, id sodales velit condimentum. Mauris luctus rutrum erat, eu tristique nunc posuere nec. In tempus risus ac suscipit pretium. Mauris et nibh posuere, suscipit ipsum commodo, ornare justo. Sed sit amet euismod lacus. Etiam lorem dui, cursus sed quam ut, finibus molestie metus. Proin condimentum id odio quis lacinia. Maecenas a ipsum id ex ornare molestie. Donec aliquam risus ac urna laoreet, ac luctus elit pellentesque. Vivamus efficitur massa eu lectus rutrum, eu porta tortor mattis.</p>\r\n\r\n<p>Nam commodo, libero a bibendum pulvinar, quam leo scelerisque purus, non scelerisque ligula nibh ac eros. Ut vitae enim ut diam sagittis aliquam. Phasellus eleifend vestibulum enim eu eleifend. Proin ut ligula vel libero ultricies lacinia. Donec convallis porttitor felis faucibus porta. Sed non nisi et nulla suscipit gravida ac vitae nisl. In rutrum, enim id consequat posuere, tellus nisi fermentum odio, in vulputate mauris tortor eget risus. Integer ultrices libero non lectus imperdiet, id congue nisi rhoncus. Ut sodales ex hendrerit la</p>', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of</p>', 'True', '<h2>Some contact info</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Phone : +90 800 500 01 01</p>\r\n\r\n<p>Fax: +90 544 484 00 00</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Address: 78050, Karabuk University</p>\r\n\r\n<p>Karabuk/Turkey</p>');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`id`, `category_id`, `title`, `keywords`, `description`, `image`, `address`, `city`, `country`, `status`, `created_at`, `updated_at`, `detail`, `userid`) VALUES
(10, 1, 'Oslo Gardermoen', NULL, 'Norway\'s Capital', '8f8032df602cd76114e4df0d6d0e51b7.jpeg', NULL, 'Oslo', 'Norway', 'True', NULL, NULL, '<p>Norway Airport</p>', NULL),
(14, 1, 'Netherlands', NULL, 'Schipol', '2a814aa84e0c5f351c99b7065e32b8b3.jpeg', NULL, 'Amsterdam', 'Netherlands', 'False', NULL, NULL, '<p>fdgdfg</p>', 24),
(16, 1, 'Paris Charles de Gaulle', 'Paris France', 'Airport', 'c452107b05ce89829d3660e7b23da375.jpeg', NULL, 'Paris', 'France', 'True', NULL, NULL, NULL, NULL),
(17, 1, 'St. Petersburg Pulkovo', NULL, NULL, 'af8e78269bf2ea7dece495766b06acb9.jpeg', NULL, 'St. Petersburg', 'Russian Federation', 'True', NULL, NULL, NULL, NULL),
(18, 1, 'Berlin Schönefeld', NULL, 'Berlin\'s Finest', 'f368a9dc1505b744e24bd98f8d6a74f2.jpeg', NULL, 'Berlin', 'Germany', 'True', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stationid` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transportcnt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `title`, `stationid`, `image`, `price`, `status`, `transportcnt`) VALUES
(7, 'Bus', 10, NULL, 20, 'True', 10),
(8, 'Minibus', 10, NULL, 10, 'True', 40),
(9, 'shuttle', 10, NULL, 3, 'True', 15),
(10, 'bus', 14, NULL, 25, 'True', 42),
(11, 'Minibus', 14, NULL, 19, 'True', 20),
(12, 'shuttle', 14, NULL, 7, 'True', 15),
(13, 'bus', 18, NULL, 10, 'True', 42),
(14, 'shuttle', 18, NULL, 20, 'True', 1),
(15, 'Minibus', 18, NULL, 10, 'True', 24),
(16, 'bus', 17, NULL, 40, 'True', 14),
(17, 'bus', 16, NULL, 104, 'True', 23);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `surname`, `image`, `status`, `created_at`, `updated_at`) VALUES
(21, 'bkaantaze@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$Zi5LUWZ0aVFIaEQvQVEvbA$33OOxXlkQQpzRoIXx27UP85Q5vDxFkLXEpNE65rMXoc', 'Kaan', 'Taze', '29d96e3065498295fb973a56d3f45eaa.png', 'True', NULL, NULL),
(22, 'a@b.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$TkFVbVRPT0pyM3ZnT3RjTg$wza1ncCre/Ep+TOw8OrOAhjcYtgtanoNioD5DEx9tUc', 'Enes', 'Eren', '4f1c78c58feac13967ba255355bc365f.jpeg', 'True', NULL, NULL),
(23, 'dsf@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$M3h2ZFFXNXR6ckl6UUVuWQ$LBGuk4S/rOeksWyeeone88W1sVirh5hrp7CBpM16Ehk', 'Gorkem', 'Gursoy', NULL, 'True', NULL, NULL),
(24, 'kaant@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$VVR2dXNzMERPbTRUaVppbg$qc6a1IgFhJ6otT/qNQG5Gv3UX0JtoRXHCnKXn7Nmlko', 'Ayfer', 'Gurbuz', 'eddc16a5c5402c966808eca362467975.png', 'False', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045F21BDB235` (`station_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9F39F8B112469DE2` (`category_id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F21BDB235` FOREIGN KEY (`station_id`) REFERENCES `station` (`id`);

--
-- Constraints for table `station`
--
ALTER TABLE `station`
  ADD CONSTRAINT `FK_9F39F8B112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
