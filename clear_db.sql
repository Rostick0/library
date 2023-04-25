-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 26 2023 г., 01:31
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
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `patronymic` varchar(45) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` text,
  `birthday` date DEFAULT NULL,
  `date_death` date DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `book_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `count_page` int NOT NULL,
  `raiting` float DEFAULT NULL,
  `count_view` int NOT NULL DEFAULT '0',
  `count_comment` int NOT NULL DEFAULT '0',
  `count_reader` int NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_link` varchar(255) NOT NULL,
  `genre_id` int DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `book_type_id` int NOT NULL DEFAULT '1',
  `publishing_id` int DEFAULT NULL
);

--
-- Структура таблицы `book_comment`
--

CREATE TABLE `book_comment` (
  `book_comment_id` int NOT NULL,
  `text` text NOT NULL,
  `raiting` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `book_id` int NOT NULL,
  `user_id` int NOT NULL
);

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
);

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
  `name` varchar(45) NOT NULL
);

--
-- Дамп данных таблицы `book_type`
--

INSERT INTO `book_type` (`book_type_id`, `name`) VALUES
(1, 'Электронная книга'),
(2, 'Бумажная книга');

-- --------------------------------------------------------

--
-- Структура таблицы `book_view`
--

CREATE TABLE `book_view` (
  `book_view_id` int NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL
);

--
-- Триггеры `book_view`
--
DELIMITER $$
CREATE TRIGGER `book view insert` AFTER INSERT ON `book_view` FOR EACH ROW UPDATE `book` SET
`count_view`=(SELECT * FROM (SELECT COUNT(*) FROM `book` WHERE NEW.`book_id` = `book`.`book_id`) as `count`)
WHERE NEW.`book_id` = `book`.`book_id`
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `genre_id` int NOT NULL,
  `name` varchar(45) NOT NULL
);

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
  `name` varchar(100) NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4
);

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE `session` (
  `session_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(45) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `patronymic` varchar(45) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth` date DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

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
-- Индексы таблицы `book_view`
--
ALTER TABLE `book_view`
  ADD PRIMARY KEY (`book_view_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

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
  MODIFY `author_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `book_comment`
--
ALTER TABLE `book_comment`
  MODIFY `book_comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `book_has_user`
--
ALTER TABLE `book_has_user`
  MODIFY `book_has_user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `book_type`
--
ALTER TABLE `book_type`
  MODIFY `book_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `book_view`
--
ALTER TABLE `book_view`
  MODIFY `book_view_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `publishing`
--
ALTER TABLE `publishing`
  MODIFY `publishing_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

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
-- Ограничения внешнего ключа таблицы `book_view`
--
ALTER TABLE `book_view`
  ADD CONSTRAINT `book_view_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `book_view_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
