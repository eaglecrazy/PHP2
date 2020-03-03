-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 02 2020 г., 14:31
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70POsdfs459+:0dsjpOIGHf', 'admin'),
(2, 'Саймон', '202cb962ac59075b964b07152d234b70POsdfs459+:0dsjpOIGHf', 'user'),
(3, 'Бельмонт', '202cb962ac59075b964b07152d234b70POsdfs459+:0dsjpOIGHf', 'user'),
(4, 'user', '202cb962ac59075b964b07152d234b70POsdfs459+:0dsjpOIGHf', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `user_history`
--

CREATE TABLE `user_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_history`
--

INSERT INTO `user_history` (`id`, `user_id`, `page`, `datetime`) VALUES
(42, 2, 'Редактирование', '2020-03-02 14:28:53'),
(43, 2, 'Личный кабинет', '2020-03-02 14:28:54'),
(44, 2, 'Чтение', '2020-03-02 14:29:25'),
(45, 2, 'Редактирование', '2020-03-02 14:29:25'),
(46, 2, 'Личный кабинет', '2020-03-02 14:29:26'),
(47, 1, 'Личный кабинет', '2020-03-02 14:29:35'),
(48, 1, 'Чтение', '2020-03-02 14:29:37'),
(49, 1, 'Личный кабинет', '2020-03-02 14:29:38'),
(50, 1, 'Редактирование', '2020-03-02 14:29:42'),
(51, 1, 'Личный кабинет', '2020-03-02 14:29:43');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
