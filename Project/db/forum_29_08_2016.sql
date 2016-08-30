-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2016 at 11:32 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(60) COLLATE utf8_bin NOT NULL,
  `category_description` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'First Category', 'Automatics context help is disabled'),
(2, 'Second Category', 'Use the toolbar to manually get help for the current caret position or to toggle automatic help');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(8) NOT NULL,
  `title` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `tagName` varchar(45) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `date`, `user_id`, `tagName`, `topic_id`) VALUES
(1, 'Samo''s post', 'My first post', '2016-08-26 13:51:50', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(8) NOT NULL,
  `role_name` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'C#'),
(2, 'JAVA'),
(4, 'PHP'),
(3, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `topic_subject` varchar(100) COLLATE utf8_bin NOT NULL,
  `topic_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_category` int(8) NOT NULL,
  `topic_by` int(8) NOT NULL,
  `posts_count` int(8) NOT NULL,
  `topic_views` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic_subject`, `topic_date`, `topic_category`, `topic_by`, `posts_count`, `topic_views`) VALUES
(9, 'Java', '2016-08-25 23:58:37', 1, 2, 0, 0),
(10, 'C#', '2016-08-26 00:02:01', 2, 2, 0, 0),
(11, 'New topic', '2016-08-26 09:44:07', 1, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic_tags`
--

CREATE TABLE `topic_tags` (
  `topic_id` int(8) DEFAULT NULL,
  `tag_id` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic_tags`
--

INSERT INTO `topic_tags` (`topic_id`, `tag_id`) VALUES
(9, 4),
(10, 1),
(11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(100) DEFAULT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `user_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `full_name`, `email`, `user_date`, `status`) VALUES
(1, 'sasho123', 'fwfwrfrw', 'kadrio kadrev', 'sasho@sasho.bg', '2016-08-23 14:06:53', 1),
(2, 'viktor', '$2y$10$13V6b7K/7xGheEQuA24cRugWVORNKVnZNbUayMgsg2AH4aoSuzzTG', 'viktor dimitrov', 'viktorsk8@mail.bg', '2016-08-23 16:42:30', 1),
(4, 'alisa', '$2y$10$doY98o2wYsgTQpybsEq44eMFalrdpUK6U7w2zek/bhmxybdniE1/W', 'Alisa Alisa', 'alisa_terzieva@abv.bg', '2016-08-24 07:13:41', 1),
(5, 'test', '$2y$10$7d8PkcrfKZafbHoTFidxKennadSB89DNKySQgCnGgG2b5IlZUsXaW', 'test test1', 'test@test.bg', '2016-08-24 14:42:28', 1),
(6, 'admin', '$2y$10$ZOuDKncwzHFTlC3N8n7X7uDDA3gVkZ3SAg34JXtH5kcFumPRLfkeS', 'admin admin', 'admin@fdsfd', '2016-08-26 11:49:45', 1),
(7, 'samo', '$2y$10$dE0Zl0MvWAVGfj1NCUOD7.OQb5voIVIklEGLj9HVdgJWWjelQCDoi', 'samo samo', 'asfda@asd', '2016-08-26 12:27:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(8) NOT NULL,
  `role_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(2, 1),
(1, 2),
(5, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id_UNIQUE` (`category_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_topics_idx` (`topic_id`),
  ADD KEY `fk_posts_users_idx` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `topic_id_UNIQUE` (`id`),
  ADD KEY `fk_topics_categories_idx` (`topic_category`),
  ADD KEY `fk_topics_users_idx` (`topic_by`);

--
-- Indexes for table `topic_tags`
--
ALTER TABLE `topic_tags`
  ADD KEY `fk_topic_tags_topics_idx` (`topic_id`),
  ADD KEY `fk_topic_tags_tags_idx` (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `fk_usersroles_users_idx` (`user_id`),
  ADD KEY `fk_usersroles_roles_idx` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_topics` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_topics_categories` FOREIGN KEY (`topic_category`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_topics_users` FOREIGN KEY (`topic_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `topic_tags`
--
ALTER TABLE `topic_tags`
  ADD CONSTRAINT `fk_topic_tags_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_topic_tags_topics` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fk_usersroles_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_usersroles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
