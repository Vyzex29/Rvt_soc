-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 18 2018 г., 21:52
-- Версия сервера: 5.5.53
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rvt_social`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `posted_at` datetime NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `posted_at`, `post_id`) VALUES
(2, 'Nice', 5, '2017-11-27 20:54:58', 25),
(4, 'To hell with her', 13, '2017-11-27 21:04:38', 40),
(5, 'Top Meme', 13, '2017-11-27 21:04:54', 40),
(6, 'Man i love the dead eyes', 13, '2017-11-27 21:05:09', 40),
(15, 'BIACTH', 5, '2017-11-27 21:32:33', 25),
(16, 'That\'s a nice mashup', 5, '2017-11-27 21:32:38', 25),
(17, 'I love future diary', 5, '2017-11-27 21:32:44', 25),
(18, 'KILL Me', 5, '2017-11-28 09:00:26', 25),
(20, '#YUNO IS Waifu', 5, '2017-11-28 09:01:42', 36),
(29, 'Great anime', 5, '2018-05-25 19:42:43', 40),
(30, 'Neat feature', 5, '2018-05-25 19:42:47', 40),
(31, 'General you are threading on mighty thin ice here', 5, '2018-06-18 18:53:44', 40),
(38, 'Emmm.. what happened?', 5, '2018-06-18 18:59:53', 40);

-- --------------------------------------------------------

--
-- Структура таблицы `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `follower_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`) VALUES
(10, 5, 13),
(11, 14, 13),
(12, 15, 13),
(13, 13, 5),
(14, 13, 20),
(16, 5, 20),
(17, 5, 17),
(18, 13, 17),
(19, 13, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(57, '2e08cff73077a6f28ec207c3cf37396f8af77525', 13),
(58, '82c2b65332f1adfa6267a04c61ef9e72123acff4', 13),
(59, 'ebf246d809752997586a2a2bb55e34a99724344a', 13),
(60, 'b9b826db36f08418bdf063b6970f8b7db0a8669b', 13),
(61, 'a57241682e0a200adc8aa7e909e2872113441dad', 13),
(75, 'e807473a416308a2a72a06da92917aade8d44e4d', 5),
(80, '6abfc4ce546ca010df010f0aa9b4f2dd2ef78bdd', 5),
(84, '981ee8a3cb4aa783d11581872b403a3cd12f65d3', 5),
(89, 'ae0188f6906f3ea053b0c95c9fa5ab5575ec9176', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `sender` int(10) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL,
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `body`, `sender`, `receiver`, `is_read`) VALUES
(4, 'Hello world', 13, 5, 0),
(5, 'hello', 5, 13, 0),
(7, 'Hello', 13, 5, 0),
(11, 'Hello', 5, 13, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  `receiver` int(10) UNSIGNED NOT NULL,
  `sender` int(10) UNSIGNED NOT NULL,
  `extra` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notifications`
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
(12, 2, 20, 20, ''),
(13, 1, 5, 13, ' { \"postbody\": \"@Vyzex29 Kok\" } ');

-- --------------------------------------------------------

--
-- Структура таблицы `password_tokens`
--

CREATE TABLE `password_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `password_tokens`
--

INSERT INTO `password_tokens` (`id`, `token`, `user_id`) VALUES
(1, 'afef67afc012fbfa2a5bd54df3bfef946143d923', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
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
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_at`, `user_id`, `likes`, `postimg`, `topics`) VALUES
(24, 'Lets talk about grils', '2017-11-19 18:40:06', 13, 2, 'https://i.imgur.com/dnXfNpN.jpg', NULL),
(25, 'Future diaries artwork', '2017-11-19 18:44:00', 13, 1, 'https://i.imgur.com/HzxohBP.jpg', NULL),
(26, 'Yandere from gyaru', '2017-11-19 20:32:15', 13, 2, 'https://i.imgur.com/52aRM52.jpg', NULL),
(36, '#TOMOKOISWAIFU', '2017-11-21 12:22:37', 13, 1, 'https://i.imgur.com/XkzsZS4.jpg', 'TOMOKOISWAIFU,'),
(40, '#Yandere da best', '2017-11-27 12:45:37', 5, 5, 'https://i.imgur.com/lTHDq1t.jpg', 'Yandere,'),
(41, '#yandere top yandere', '2017-11-27 18:02:53', 13, 2, 'https://i.imgur.com/GrVopuF.jpg', 'yandere,'),
(42, 'Upload', '2017-11-28 00:42:43', 5, 1, 'https://i.imgur.com/pMzIAOb.png', ''),
(49, 'RVT post', '2017-11-29 02:53:01', 13, 3, 'https://i.imgur.com/rEJeVmo.png', ''),
(55, 'Tanya degurechaff artwork', '2018-05-23 15:35:00', 5, 1, 'https://i.imgur.com/fV322XM.png', ''),
(71, 'Tanya after battle', '2018-06-07 16:49:16', 5, 1, 'https://i.imgur.com/DqoFTFI.jpg', '');

-- --------------------------------------------------------

--
-- Структура таблицы `posts_likes`
--

CREATE TABLE `posts_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts_likes`
--

INSERT INTO `posts_likes` (`id`, `post_id`, `user_id`) VALUES
(2, 25, 13),
(53, 28, 5),
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
(175, 40, 20),
(177, 49, 21),
(179, 42, 5),
(181, 55, 5),
(184, 50, 5),
(189, 61, 13),
(193, 61, 5),
(194, 69, 13),
(195, 68, 13),
(197, 71, 5),
(202, 49, 5),
(205, 40, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` text NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `profileimg` varchar(255) DEFAULT 'https://i.imgur.com/ZgNqzmX.jpg',
  `description` text,
  `role` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `verified`, `profileimg`, `description`, `role`) VALUES
(5, 'vyzex29', '$2y$10$Lsz0pA0RJAnVYYa0vrXyguF3gdxhrSw8Sr9S3/mHiINwmX1n.n5SG', 'virtuoso292@gmail.com', 1, 'https://i.imgur.com/rloDiju.png', 'I enjoy anime and programming. I also play league of legends in my free time.', 1),
(12, 'verified', '$2y$10$8.kU7I3mj1KzmTwkPEpCFu4lI6zwwA59Q8rxCq.K0EjT757HWLfHy', 'verified@kursadarbs.com', 0, 'https://i.imgur.com/ZgNqzmX.jpg	', NULL, 1),
(13, 'General', '$2y$10$3ivj4m/k2YhoaMan.BOjNOH7s4qvPzGcrlx/j.KshIE3J1cfaab26', '1@1.com', 0, 'https://i.imgur.com/o5BQo7z.jpg', NULL, 0),
(17, 'Valera_Dik', '$2y$10$TQIi1TWMzr6YPoY9IMkrQ.x1i2Yf8o8JfHv62WCKjfJi9W3ff0mrK', 'valera.dik29@gmail.com', 0, 'https://i.imgur.com/ZgNqzmX.jpg	', NULL, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Индексы таблицы `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `follower_user` (`user_id`),
  ADD KEY `follower_id` (`follower_id`);

--
-- Индексы таблицы `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_token` (`user_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_tokens`
--
ALTER TABLE `password_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password_token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `posts_likes`
--
ALTER TABLE `posts_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT для таблицы `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `password_tokens`
--
ALTER TABLE `password_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT для таблицы `posts_likes`
--
ALTER TABLE `posts_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `password_tokens`
--
ALTER TABLE `password_tokens`
  ADD CONSTRAINT `users_password_tokens` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `User_posts` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
