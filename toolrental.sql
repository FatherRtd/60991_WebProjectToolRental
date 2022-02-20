-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 20 2022 г., 17:07
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `toolrental`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Индекс категории',
  `name` varchar(255) NOT NULL COMMENT 'Название категории',
  `description` varchar(255) NOT NULL COMMENT 'Краткое описание категории',
  `parent_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Индекс родительской категории'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Категория товара' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID товара',
  `name` varchar(255) NOT NULL COMMENT 'Наименование товара',
  `short_description` varchar(255) NOT NULL COMMENT 'Краткое описание',
  `long_description` varchar(255) NOT NULL COMMENT 'Полное описание',
  `rental_price` int(10) UNSIGNED NOT NULL COMMENT 'Цена аренды',
  `is_in_stock` tinyint(1) NOT NULL COMMENT 'Наличие товара',
  `quantity` int(10) UNSIGNED NOT NULL COMMENT 'Кол-во товара',
  `min_rental_time` int(10) UNSIGNED NOT NULL COMMENT 'Минимально время аренды товара',
  `image` varchar(255) NOT NULL COMMENT 'Изображение товара',
  `category_id` int(10) UNSIGNED NOT NULL COMMENT 'Индекс категории'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация о товаре' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `rental_order`
--

CREATE TABLE `rental_order` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Индекс заказа',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'Индекс пользователя',
  `product_id` int(10) UNSIGNED NOT NULL COMMENT 'Индекс товара',
  `order_date` date NOT NULL COMMENT 'Дата заказа',
  `rental_time` int(10) UNSIGNED NOT NULL COMMENT 'Время аренды',
  `rental_price` int(10) UNSIGNED NOT NULL COMMENT 'Цена аренды'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация о заказе' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'ID пользователя',
  `firstname` varchar(255) NOT NULL COMMENT 'Имя',
  `lastname` varchar(255) NOT NULL COMMENT 'Фамилия',
  `login` varchar(255) NOT NULL COMMENT 'Логин',
  `md5password` varchar(255) NOT NULL COMMENT 'Пароль',
  `is_admin` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Является администратором'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация о пользователе' ROW_FORMAT=COMPACT;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `rental_order`
--
ALTER TABLE `rental_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Индекс категории';

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID товара';

--
-- AUTO_INCREMENT для таблицы `rental_order`
--
ALTER TABLE `rental_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Индекс заказа';

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID пользователя', AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `rental_order`
--
ALTER TABLE `rental_order`
  ADD CONSTRAINT `rental_order_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `rental_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
