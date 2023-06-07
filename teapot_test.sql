-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 07 2023 г., 18:44
-- Версия сервера: 8.0.33
-- Версия PHP: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `teapot_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `ID` int NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_slug` varchar(100) NOT NULL,
  `product_description` longtext NOT NULL,
  `product_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`ID`, `product_name`, `product_slug`, `product_description`, `product_status`) VALUES
(1, 'Чайник 1', 'teapod-1', 'Description of Чайник 1', 'publish'),
(2, 'Чайник 2', 'teapod-2', '', 'publish'),
(3, 'Product', 'product', 'Добавится ли ещё чайник? )', 'publish'),
(4, 'Product', 'product', 'Добавится ли ещё чайник? )', 'publish'),
(5, 'Product5', 'product5', '', 'publish'),
(6, 'Product-6', 'product-6', '', 'publish'),
(7, 'Product-7', 'product-7', '', 'publish'),
(8, 'Product-8', 'чайник-8', '', 'private'),
(9, 'Чайник 9', 'product-9', '', 'publish'),
(10, 'Product-10', 'product-10', 'Запишем описание продукта', 'publish'),
(11, 'Чайник-11', 'tea-11', 'We can edit description for free!', 'private'),
(12, 'Product-12', 'product-12', 'asdf', 'publish'),
(13, 'Product-13', 'product-13', 'asdf', 'publish'),
(14, 'Product-14', 'product-14', 'asdf', 'publish'),
(15, 'Product-15', 'product-15', 'Unique content', 'publish'),
(16, 'Product-16', 'product-16', '', 'publish');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
