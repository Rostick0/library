-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 25 2023 г., 02:22
-- Версия сервера: 8.0.29
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `author_id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `patronymic` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `birthday` date DEFAULT NULL,
  `date_death` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`author_id`, `name`, `surname`, `patronymic`, `avatar`, `description`, `birthday`, `date_death`) VALUES
(1, 'Фёдор', 'Достоевский', 'Михайлович', 'https://www.sensusnovus.ru/wp-content/uploads/2017/02/fyodor-dostoevsky.jpg', 'Фёдор Михайлович Достоевский — русский писатель, мыслитель, философ и публицист. Член-корреспондент Петербургской академии наук с 1877 года. Классик мировой литературы, по данным ЮНЕСКО, один из самых читаемых писателей в мире.\nПодробнее на livelib.ru:\nhttps://www.livelib.ru/author/264-fjodor-dostoevskij', '1812-10-30', '1881-01-28'),
(2, 'Роман', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Ростислав', 'Волков', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `book_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` float NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `count_page` int NOT NULL,
  `raiting` float DEFAULT NULL,
  `count_view` int NOT NULL DEFAULT '0',
  `count_comment` int NOT NULL DEFAULT '0',
  `count_reader` int NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `genre_id` int DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `book_type_id` int NOT NULL DEFAULT '1',
  `publishing_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`book_id`, `name`, `description`, `price`, `image`, `date`, `count_page`, `raiting`, `count_view`, `count_comment`, `count_reader`, `created_date`, `file_link`, `genre_id`, `author_id`, `book_type_id`, `publishing_id`) VALUES
(1, 'Преступление и наказание', NULL, 600, 'https://tse3.mm.bing.net/th?id=OIP.sNpF_q79DgckAIL2eQrQiQHaLh&pid=Api', NULL, 280, 5, 0, 1, 0, '2023-04-24 10:19:17', 'https://www.100bestbooks.ru/files/Dostoevskyi_Prestuplenie_i_nakazanie.pdf', 1, 1, 1, 1),
(2, 'Преступление и наказание 2', NULL, 2600, 'https://tse3.mm.bing.net/th?id=OIP.sNpF_q79DgckAIL2eQrQiQHaLh&pid=Api', NULL, 280, 3, 0, 0, 0, '2023-04-24 10:19:17', 'https://www.100bestbooks.ru/files/Dostoevskyi_Prestuplenie_i_nakazanie.pdf', 1, 1, 1, 1),
(3, 'Новый том', NULL, 1900, 'https://tse3.mm.bing.net/th?id=OIP.sNpF_q79DgckAIL2eQrQiQHaLh&pid=Api', NULL, 280, NULL, 0, 1, 0, '2023-04-24 10:19:17', 'https://www.100bestbooks.ru/files/Dostoevskyi_Prestuplenie_i_nakazanie.pdf', 2, 2, 2, 1),
(4, 'Копия', NULL, 1300, 'https://tse3.mm.bing.net/th?id=OIP.sNpF_q79DgckAIL2eQrQiQHaLh&pid=Api', NULL, 280, 5, 0, 1, 0, '2023-04-24 10:19:17', 'https://www.100bestbooks.ru/files/Dostoevskyi_Prestuplenie_i_nakazanie.pdf', 3, 2, 2, 1),
(5, 'ДИЗАЙНЕР', NULL, 19120, 'https://shumik.files.wordpress.com/2016/12/logotip-i-firmennyj-stil-1-825x360.jpg', NULL, 280, 2, 0, 0, 0, '2023-04-24 10:19:17', 'https://www.100bestbooks.ru/files/Dostoevskyi_Prestuplenie_i_nakazanie.pdf', 2, 3, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `book_comment`
--

CREATE TABLE `book_comment` (
  `book_comment_id` int NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `raiting` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `book_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `book_comment`
--

INSERT INTO `book_comment` (`book_comment_id`, `text`, `raiting`, `created_date`, `update_date`, `book_id`, `user_id`) VALUES
(8, 'Мне очень понравилась книга!', 5, '2023-04-24 17:13:14', '2023-04-24 20:26:07', 1, 4);

--
-- Триггеры `book_comment`
--
DELIMITER $$
CREATE TRIGGER `book comment delete` BEFORE DELETE ON `book_comment` FOR EACH ROW UPDATE `book` SET
`count_comment`=(SELECT * FROM (SELECT COUNT(*) FROM `book` WHERE OLD.`book_id` = `book`.`book_id`) as `count`)
WHERE OLD.`book_id` = `book`.`book_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `book comment delete raiting` AFTER DELETE ON `book_comment` FOR EACH ROW UPDATE `book` SET `raiting`=(SELECT AVG(`raiting`) FROM `book_comment` WHERE `book_id` = OLD.`book_id`) WHERE `book`.`book_id` = OLD.`book_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `book comment insert` AFTER INSERT ON `book_comment` FOR EACH ROW UPDATE `book` SET
`count_comment`=(SELECT * FROM (SELECT COUNT(*) FROM `book` WHERE NEW.`book_id` = `book`.`book_id`) as `count`)
WHERE NEW.`book_id` = `book`.`book_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `book comment insert raiting` AFTER INSERT ON `book_comment` FOR EACH ROW UPDATE `book` SET `raiting`=(SELECT AVG(`raiting`) FROM `book_comment` WHERE `book_id` = NEW.`book_id`) WHERE `book`.`book_id` = NEW.`book_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `book comment update raiting` AFTER UPDATE ON `book_comment` FOR EACH ROW UPDATE `book` SET `raiting`=(SELECT AVG(`raiting`) FROM `book_comment` WHERE `book_id` = NEW.`book_id`) WHERE `book`.`book_id` = NEW.`book_id`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `book_has_user`
--

CREATE TABLE `book_has_user` (
  `book_has_user_id` int NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `book_has_user`
--

INSERT INTO `book_has_user` (`book_has_user_id`, `user_id`, `book_id`) VALUES
(1, 1, 1);

--
-- Триггеры `book_has_user`
--
DELIMITER $$
CREATE TRIGGER `book has user delete` AFTER DELETE ON `book_has_user` FOR EACH ROW UPDATE `book` SET
`count_reader`=(SELECT * FROM (SELECT COUNT(*) FROM `book` WHERE OLD.`book_id` = `book`.`book_id`) as `count`)
WHERE OLD.`book_id` = `book`.`book_id`
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `book has user insert` AFTER INSERT ON `book_has_user` FOR EACH ROW UPDATE `book` SET
`count_reader`=(SELECT * FROM (SELECT COUNT(*) FROM `book` WHERE NEW.`book_id` = `book`.`book_id`) as `count`)
WHERE NEW.`book_id` = `book`.`book_id`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `book_type`
--

CREATE TABLE `book_type` (
  `book_type_id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `book_type`
--

INSERT INTO `book_type` (`book_type_id`, `name`) VALUES
(1, 'Электронная книга'),
(2, 'Бумажная книга');

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `genre_id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`genre_id`, `name`) VALUES
(1, 'Роман'),
(2, 'Повесть'),
(3, 'Рассказ');

-- --------------------------------------------------------

--
-- Структура таблицы `publishing`
--

CREATE TABLE `publishing` (
  `publishing_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `publishing`
--

INSERT INTO `publishing` (`publishing_id`, `name`, `photo`, `description`) VALUES
(1, 'Тест', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE `session` (
  `session_id` int NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `session`
--

INSERT INTO `session` (`session_id`, `token`, `ip`, `user_agent`, `user_id`, `date_created`) VALUES
(1, '22b7698d989a53d72dad8ba025d5b9a0', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 YaBrowser/23.3.2.806 Yowser/2.5 Safari/537.36', 1, '2023-04-23 16:12:36'),
(2, '432bcc634c590f9610bd4cbb5b4bf503', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 YaBrowser/23.3.2.806 Yowser/2.5 Safari/537.36', 2, '2023-04-23 16:14:52'),
(3, '9d160015996ab5a5f44102f9cad4c774', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 YaBrowser/23.3.2.806 Yowser/2.5 Safari/537.36', 3, '2023-04-23 16:18:13'),
(4, 'ce19b52a2628d5d99b0eb59362e1f04e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 YaBrowser/23.3.2.806 Yowser/2.5 Safari/537.36', 4, '2023-04-23 16:19:14'),
(5, '869d76c6c38666cf442f6ac00f386425', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Mobile Safari/537.36', 2, '2023-04-24 08:56:27');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `patronymic` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `birth` date DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `name`, `surname`, `patronymic`, `avatar`, `telephone`, `email`, `password`, `birth`, `created_date`) VALUES
(1, 'Имя', NULL, NULL, NULL, NULL, 'name@name.com', '$2y$10$kwiLKSMJyB976xrEQGT0Ver9jSGj45yHNBt/NDB2gcp3v3y2jNKOu', NULL, '2023-04-23 16:12:36'),
(2, 'Ростислав', NULL, NULL, '16822664922922.png', NULL, 'rostik057@gmail.com', '$2y$10$UxxzM6dh8hDPyg6CTw9d5eS8/b7b.Bp2jjneOfwGaVLMPG1CcjY9y', NULL, '2023-04-23 16:14:52'),
(3, 'Ростислав', NULL, NULL, '16822666936992.png', '+79999999999', 'zajcevav30@gmail.com', '$2y$10$ZIVrq9zV7Jzm9zabeSuPjOTV7nz5i/zSvbWBKnS1TEEAVnKNwV5VS', NULL, '2023-04-23 16:18:13'),
(4, 'Ростислав', NULL, NULL, '16823473569999.png', '+79999999999', 'zajcevav301@gmail.com', '$2y$10$0Hr6g96Dw4Md3fIigU67jOcuc5AqNboeyPl2OuOjgRmzf2YMZVSNm', '2023-04-17', '2023-04-23 16:19:14');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `book_type_id` (`book_type_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `publishing_id` (`publishing_id`);

--
-- Индексы таблицы `book_comment`
--
ALTER TABLE `book_comment`
  ADD PRIMARY KEY (`book_comment_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `book_has_user`
--
ALTER TABLE `book_has_user`
  ADD PRIMARY KEY (`book_has_user_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `book_type`
--
ALTER TABLE `book_type`
  ADD PRIMARY KEY (`book_type_id`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Индексы таблицы `publishing`
--
ALTER TABLE `publishing`
  ADD PRIMARY KEY (`publishing_id`);

--
-- Индексы таблицы `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `book_comment`
--
ALTER TABLE `book_comment`
  MODIFY `book_comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `book_has_user`
--
ALTER TABLE `book_has_user`
  MODIFY `book_has_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `book_type`
--
ALTER TABLE `book_type`
  MODIFY `book_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `publishing`
--
ALTER TABLE `publishing`
  MODIFY `publishing_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`book_type_id`) REFERENCES `book_type` (`book_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `book_ibfk_4` FOREIGN KEY (`publishing_id`) REFERENCES `publishing` (`publishing_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `book_comment`
--
ALTER TABLE `book_comment`
  ADD CONSTRAINT `book_comment_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `book_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `book_has_user`
--
ALTER TABLE `book_has_user`
  ADD CONSTRAINT `book_has_user_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `book_has_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
