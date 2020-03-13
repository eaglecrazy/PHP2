-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 13 2020 г., 21:21
-- Версия сервера: 5.6.43
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
-- База данных: `shop2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `client_id`, `item_id`, `count`, `order_id`) VALUES
(11, 1, 1, 2, -1),
(15, 15, 2, 1, -1);

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cost` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `cost`, `filename`, `datetime`) VALUES
(1, 'Castlevania', 'Игра для NES', 4, '1-castlevania.jpg', '2020-03-07 13:05:20'),
(2, 'Castlevania II', 'Игра для NES', 8, '2-castlevaniaii.jpg', '2020-03-07 13:06:15'),
(3, 'Castlevania III', 'Игра для NES', 16, '3-castlevaniaiii.jpg', '2020-03-07 13:06:25');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` text NOT NULL,
  `comment` text NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `name`, `phone`, `adress`, `comment`, `order_status`) VALUES
(29, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(30, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(31, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(32, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(33, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(34, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(35, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(36, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(37, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(38, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(39, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(40, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(41, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(42, '1', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(43, '15', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(44, '15', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(45, '15', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(46, '15', 'имя', 'телефон', 'адрес', 'комментарий', 0),
(47, '15', 'имя', 'телефон', 'адрес', 'комментарий', 0);

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
(1, 'admin', '35cc8a561c5d0991a62c94e6f4ca5cc8', 'admin'),
(2, 'user', '35cc8a561c5d0991a62c94e6f4ca5cc8', 'user'),
(13, 'логин', '35cc8a561c5d0991a62c94e6f4ca5cc8', 'user'),
(14, 'логин1', '35cc8a561c5d0991a62c94e6f4ca5cc8', 'user'),
(15, 'admin1', '35cc8a561c5d0991a62c94e6f4ca5cc8', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
