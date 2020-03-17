-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 17 2020 г., 20:50
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
(51, 1, 1, 10, 19),
(52, 36, 3, 1, 20),
(53, 36, 2, 2, 20);

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
(1, 'Castlevania', 'Игра для NES', 4, '/1-1.jpg', '2020-03-07 13:05:20'),
(2, 'Castlevania II', 'Игра для NES', 8, '/2-2.jpg', '2020-03-07 13:06:15'),
(3, 'Castlevania III', 'Игра для NES', 16, '/3-3.jpg', '2020-03-07 13:06:25'),
(18, 'Castlevania Dracula X', 'Игра для SNES', 32, '/18-6draculax.jpg', '2020-03-17 18:57:19');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_cost` float NOT NULL DEFAULT '0',
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

INSERT INTO `orders` (`id`, `total_cost`, `client_id`, `name`, `phone`, `adress`, `comment`, `order_status`) VALUES
(19, 40, '1', 'Саймон', '1234567890', 'На деревню дедушке.', 'Срочно.', 0),
(20, 32, '36', 'Бельмонт', '987654321', 'Трансильвания, замок Дракулы', 'Не горит.', 0);

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
(34, 'логин', '35cc8a561c5d0991a62c94e6f4ca5cc8', 'user'),
(36, 'master', '35cc8a561c5d0991a62c94e6f4ca5cc8', 'user');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
