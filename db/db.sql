-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 13 2020 г., 11:26
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `secret_text`
--

CREATE TABLE `secret_text` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_text` int(10) UNSIGNED NOT NULL,
  `secret_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `secret_text`
--

INSERT INTO `secret_text` (`id`, `id_text`, `secret_text`) VALUES
(1, 1, '1'),
(2, 2, '2, 3'),
(3, 3, '457, 98, 2, 12637, 89123789, -2010');

-- --------------------------------------------------------

--
-- Структура таблицы `text`
--

CREATE TABLE `text` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `title` text NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `text`
--

INSERT INTO `text` (`id`, `date`, `title`, `text`) VALUES
(1, '2020-02-13 10:16:01', 'Test', '{1}'),
(2, '2020-02-13 10:16:50', 'Test2', '{2} \r\n{3}'),
(3, '2020-02-13 10:17:22', 'Test3', 'demis \r\n4 \r\nlala-}blab{la ! =)) \r\n:( \r\n{457}7775         {-1.000001 } \r\n32 \r\n{+98} \r\n{2}           {+3.14}  {12637} 9812 {89123789} \r\n1 \r\nO   O1         01 \r\n1O \r\n1}OO \r\n{zer}o! \r\n{df1000 ggg... \r\n{5-} \r\n105} \r\n{-2010} \r\nwass{auupp!! \r\n'),
(4, '2020-02-13 10:19:17', 'Test4', '2} \r\n{3 \r\n4} \r\n{5');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'Admin', '15b9e14e2c508171d01fe0929f28ebdf'),
(2, 'UserTest', '694a330f0980b4784818022bba0f89e8');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `secret_text`
--
ALTER TABLE `secret_text`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_text` (`id_text`);

--
-- Индексы таблицы `text`
--
ALTER TABLE `text`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `secret_text`
--
ALTER TABLE `secret_text`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `text`
--
ALTER TABLE `text`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `secret_text`
--
ALTER TABLE `secret_text`
  ADD CONSTRAINT `secret_text_ibfk_1` FOREIGN KEY (`id_text`) REFERENCES `text` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
