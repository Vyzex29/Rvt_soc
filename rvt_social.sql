-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 19, 2017 at 12:32 PM
-- Server version: 5.7.16
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rvt_social`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `posted_at` datetime NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `posted_at`, `post_id`) VALUES
(1, 'faggot', 5, '2017-11-27 20:54:08', 26),
(2, 'bullshit i love my asus it fucks me everyday', 5, '2017-11-27 20:54:58', 25),
(3, 'wtf', 5, '2017-11-27 20:55:04', 37),
(4, 'kok', 13, '2017-11-27 21:04:38', 40),
(5, 'wtf', 13, '2017-11-27 21:04:54', 40),
(6, 'KROOK', 13, '2017-11-27 21:05:09', 40),
(15, 'BIACTH', 5, '2017-11-27 21:32:33', 25),
(16, 'zbsj', 5, '2017-11-27 21:32:38', 25),
(17, 'test comment\r\n', 5, '2017-11-27 21:32:44', 25),
(18, 'KILL Me', 5, '2017-11-28 09:00:26', 25),
(19, 'SHIEEyt', 5, '2017-11-28 09:00:40', 39),
(20, '#YUNO IS FWAUFOI', 5, '2017-11-28 09:01:42', 36),
(21, '\' \"DROP DATABASE RVT\"', 13, '2017-11-28 09:10:05', 47);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `follower_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`) VALUES
(10, 5, 13),
(11, 14, 13),
(12, 15, 13),
(13, 13, 5),
(14, 13, 20),
(16, 5, 20),
(17, 5, 17),
(18, 13, 17);

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(14, '68812d04ec91a32fe00a336e29337f332bdf6684', 5),
(15, '4057aaff71619f444cb48bd13d561589167a169e', 5),
(16, '92b69b76a18559f87d408adbebc4f9696550338e', 5),
(17, 'c7b127bbf68f0822ef30d123c48f0b3de5a8f1bc', 5),
(18, '56c28dba07bf65a0ea0c29f40197b3eda2ffcf24', 5),
(28, 'f6058a5568eddcf6a17ae380583e2e3c812c9f55', 5),
(29, '1a836ebcee0fdfcc9b50f0ff17bc81080aea2c61', 5),
(30, 'd5b6764fc388cf48bb8318bad57f69786f808ff0', 5),
(31, 'df8153f539536b69d6b322e7dd11a9a2392bd14c', 5),
(33, 'bfeeecdbda5f8c1cdeaf0e00a21e5e4ca4b8cb9a', 5),
(34, 'fe17b4df966f47309cf8ace2f04348c5f2280fba', 5),
(35, '1f41a3e47e50823afbc971ca6743cdc6b4d184aa', 5),
(39, '4a4c417f8f9f53ad5779ae663f091c69ec299a5c', 5),
(51, '9f1bda08d026d7a5a628a959ed321e0dec58f4a7', 19),
(54, '294657ce14a8523da02deb92983d76417b1a65d7', 5),
(56, '7f76bd1cbf4ddadbf0c705ee3e6d73757776ed38', 5),
(57, '2e08cff73077a6f28ec207c3cf37396f8af77525', 13),
(58, '82c2b65332f1adfa6267a04c61ef9e72123acff4', 13),
(59, 'ebf246d809752997586a2a2bb55e34a99724344a', 13),
(60, 'b9b826db36f08418bdf063b6970f8b7db0a8669b', 13),
(61, 'a57241682e0a200adc8aa7e909e2872113441dad', 13),
(63, '5fe65a814435cc0c7c0cdc4f89193c3217b14450', 20);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `sender` int(10) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `sender`, `receiver`, `is_read`) VALUES
(1, '\'', 5, 13, 1),
(3, 'Krok?\r\n', 5, 13, 1),
(4, 'Hello world', 13, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL,
  `sender` int(10) UNSIGNED NOT NULL,
  `extra` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `receiver`, `sender`, `extra`) VALUES
(3, 1, 13, 13, ' { \"postbody\": \"@123456 #ASUS can cuk my zuk\" } '),
(4, 2, 13, 13, ''),
(5, 2, 13, 13, ''),
(6, 2, 13, 13, ''),
(7, 2, 13, 13, ''),
(8, 2, 13, 13, ''),
(9, 2, 13, 5, ''),
(10, 2, 13, 5, ''),
(11, 2, 5, 13, ''),
(12, 2, 20, 20, '');

-- --------------------------------------------------------

--
-- Table structure for table `password_tokens`
--

CREATE TABLE `password_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` varchar(160) NOT NULL,
  `posted_at` datetime NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `likes` int(10) UNSIGNED NOT NULL,
  `postimg` varchar(255) DEFAULT NULL,
  `topics` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_at`, `user_id`, `likes`, `postimg`, `topics`) VALUES
(24, 'Lets talk about grils', '2017-11-19 18:40:06', 13, 2, 'https://i.imgur.com/dnXfNpN.jpg', NULL),
(25, 'Help me', '2017-11-19 18:44:00', 13, 1, 'https://i.imgur.com/HzxohBP.jpg', NULL),
(26, 'FUCKING KILL ME', '2017-11-19 20:32:15', 13, 2, 'https://i.imgur.com/52aRM52.jpg', NULL),
(28, '@vyzex29 faggot', '2017-11-19 21:31:17', 13, 2, NULL, NULL),
(35, '#Loli is my waifu', '2017-11-19 22:26:12', 13, 0, NULL, 'Loli,'),
(36, '#TOMOKOISWAIFU', '2017-11-21 12:22:37', 13, 1, 'https://i.imgur.com/XkzsZS4.jpg', 'TOMOKOISWAIFU,'),
(37, '@vyzex29 #ASUS is shait', '2017-11-26 19:42:20', 13, 0, NULL, 'ASUS,'),
(39, '@123456 #ASUS can cuk my zuk', '2017-11-27 12:25:26', 13, 1, NULL, 'ASUS,'),
(40, '#Yandere da best', '2017-11-27 12:45:37', 5, 4, 'https://i.imgur.com/lTHDq1t.jpg', 'Yandere,'),
(41, '#yandere top yandere', '2017-11-27 18:02:53', 13, 2, 'https://i.imgur.com/GrVopuF.jpg', 'yandere,'),
(42, 'Upload', '2017-11-28 00:42:43', 5, 1, 'https://i.imgur.com/pMzIAOb.png', ''),
(44, 'wtf', '2017-11-28 01:45:37', 5, 0, NULL, ''),
(45, 'KILL ME', '2017-11-28 08:37:11', 5, 0, NULL, ''),
(47, 'KILLL MEEEE', '2017-11-28 08:56:17', 5, 0, NULL, ''),
(48, 'New post', '2017-11-28 10:14:23', 5, 1, NULL, ''),
(49, 'RVT post', '2017-11-29 02:53:01', 13, 1, 'https://i.imgur.com/rEJeVmo.png', ''),
(50, 'test', '2017-12-11 17:37:12', 5, 0, NULL, ''),
(51, 'test', '2017-12-11 17:53:12', 13, 0, NULL, ''),
(52, 'pic test', '2017-12-11 18:16:45', 13, 1, 'https://i.imgur.com/1ITSVCP.png', ''),
(53, 'First post', '2017-12-13 13:43:59', 20, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `posts_likes`
--

CREATE TABLE `posts_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts_likes`
--

INSERT INTO `posts_likes` (`id`, `post_id`, `user_id`) VALUES
(2, 25, 13),
(53, 28, 5),
(57, 42, 5),
(88, 24, 5),
(89, 39, 5),
(94, 26, 5),
(107, 36, 5),
(111, 41, 5),
(121, 48, 13),
(129, 49, 13),
(160, 41, 13),
(161, 52, 13),
(164, 53, 20),
(165, 54, 20),
(167, 55, 20),
(168, 56, 20),
(169, 26, 17),
(170, 40, 17),
(171, 28, 13),
(172, 40, 13),
(174, 24, 13),
(175, 40, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` text NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `profileimg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `verified`, `profileimg`) VALUES
(5, 'vyzex29', '$2y$10$Lsz0pA0RJAnVYYa0vrXyguF3gdxhrSw8Sr9S3/mHiINwmX1n.n5SG', 'virtuoso292@gmail.com', 1, NULL),
(12, 'verified', '$2y$10$8.kU7I3mj1KzmTwkPEpCFu4lI6zwwA59Q8rxCq.K0EjT757HWLfHy', 'verified@kursadarbs.com', 0, NULL),
(13, '123456', '$2y$10$3ivj4m/k2YhoaMan.BOjNOH7s4qvPzGcrlx/j.KshIE3J1cfaab26', '1@1.com', 0, 'https://i.imgur.com/o5BQo7z.jpg'),
(15, 'qwerty1', '$2y$10$G/iM4woa/E9moanI60B7quuILOuu2A5GjvgWmbGTK0wg3zOmRyIPO', 'qwerty1@qwerty1.com', 0, NULL),
(16, 'qwerty2', '$2y$10$vKYBRBbJ63TxLGvF6c4Up.7eDcBBgYNWN5y.oONsBIziuM9mtr7Aa', 'qwerty2@qwerty2.com', 0, NULL),
(17, 'Valera_Dik', '$2y$10$TQIi1TWMzr6YPoY9IMkrQ.x1i2Yf8o8JfHv62WCKjfJi9W3ff0mrK', 'valera.dik29@gmail.com', 0, NULL),
(18, '654321', '$2y$10$s9Orum.kJW.o.ipRo/f3M.4aMJRVESQlPiFVSbfNQbawwMvnxvfW.', '2@2.com', 0, NULL),
(19, 'testuser', '$2y$10$cl/lQmZP3p6BboWmuTi7zucaiGjpG68amVNBCUPUn7OwB8GWNHima', 'testuser@gmail.com', 0, NULL),
(20, '123456789', '$2y$10$9ONVrF6kXf/A2zCEe70z5e0UjGT7cMENBqini0O4Q8q6o2Z0CBW7C', 'apejlab@inbox.lv', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_user` (`user_id`),
  ADD KEY `follower_id` (`follower_id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_token` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_tokens`
--
ALTER TABLE `password_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password_token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts_likes`
--
ALTER TABLE `posts_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `password_tokens`
--
ALTER TABLE `password_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `posts_likes`
--
ALTER TABLE `posts_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `password_tokens`
--
ALTER TABLE `password_tokens`
  ADD CONSTRAINT `users_password_tokens` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `User_posts` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
