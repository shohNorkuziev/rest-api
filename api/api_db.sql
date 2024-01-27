-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Янв 27 2024 г., 08:49
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `api_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modify`) VALUES
(2, 'Книги', 'Книги для детей и влюбленных', '2024-01-12 14:55:35', '2024-01-12 12:00:12'),
(3, 'Одежда', 'Одежда и обувь для всей семьи', '2024-01-12 15:06:10', '2024-01-12 12:07:26'),
(4, 'Строй материал', 'Все строй материалы', '2024-01-12 15:06:10', '2024-01-12 12:07:26'),
(5, 'Автомобили', 'Лучшие автомобили германии', '2024-01-15 16:37:25', '2024-01-15 13:37:25');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int NOT NULL,
  `created` datetime NOT NULL,
  `modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `created`, `modify`) VALUES
(20, 'mg metro 80', 'mg metro 80, that\'s cool car', '550.00', 5, '2024-01-24 16:24:12', '2024-01-24 13:25:23'),
(21, 'horizon car', 'cool car ', '777.00', 5, '2024-01-24 16:56:52', '2024-01-24 13:56:52'),
(22, '11', ' 11', '11.00', 2, '2024-01-25 12:41:18', '2024-01-25 09:41:18'),
(23, '32131', ' 312', '312312.00', 2, '2024-01-25 12:41:22', '2024-01-25 09:41:22'),
(24, '34324', '352', '324.00', 2, '2024-01-25 12:41:26', '2024-01-25 09:41:26'),
(25, '35354', ' 343', '434.00', 2, '2024-01-25 12:41:30', '2024-01-25 09:41:30'),
(26, '45675', ' 65765', '67.00', 2, '2024-01-25 12:41:34', '2024-01-25 09:41:34'),
(27, '6865', ' 76876', '68.00', 2, '2024-01-25 12:41:39', '2024-01-25 09:41:39');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created`, `modified`) VALUES
(1, 'shoh', 'kent', 'kent@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-01-16 16:23:43', '2024-01-16 13:24:31'),
(3, 'shohruh', 'kent', 'kent@gmail.com', '$2y$10$1AcOCd/Trq5/KYTvLQBrDOfoQJ47QSLh0UV/sZUDVMa.sUR36vy1W', '2024-01-19 13:51:34', '2024-01-19 10:51:34'),
(4, 'art', 'pois', 'art@gmail.com', '$2y$10$q16n54WT1NQ7.7Z9tkrYBelT2icbbIK7XmoOzocEbzNzrRLrO79TC', '2024-01-25 13:38:52', '2024-01-25 10:38:52'),
(6, 'vlad', 'nehoroshkov', 'vlad@gmail.com', '$2y$10$9af3pcKH.WJVuVj5FjAgouUH7IX1fG98q8RhleZ6Z8IPIpqlr8iRG', '2024-01-25 14:45:34', '2024-01-25 11:45:34'),
(7, 'Киря', 'Платон', 'kir@gmail.com', '$2y$10$0WqSrAAqQ/6tw.N5KFRt.Ozs1LWoTb0dJ7TWs/w14Zg5H5mxTDYPC', '2024-01-26 14:32:57', '2024-01-26 11:32:57');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
