-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.24.110
-- Время создания: Июн 18 2020 г., 18:13
-- Версия сервера: 5.7.26-29
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `a0343562_practical`
--

-- --------------------------------------------------------

--
-- Структура таблицы `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `club` text NOT NULL,
  `place_of_living` text NOT NULL,
  `weight` float NOT NULL,
  `sex` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `members`
--

INSERT INTO `members` (`id`, `name`, `surname`, `date_of_birth`, `club`, `place_of_living`, `weight`, `sex`) VALUES
(1, 'Антонина', 'Иванов', '2010-10-01', 'Олимпиец', 'Оренбург 460132', 24.95, 'woman'),
(2, 'Арсений', 'Куликов', '2008-07-16', 'Старт', 'Архангельск 494562', 35, 'man'),
(3, 'Флорентина', 'Богданова', '2013-09-19', 'Север', 'Мурманск 183017', 23, 'woman'),
(4, 'Ярослав', 'Крылов', '2009-04-01', '№1', 'Москва 105037', 30.5, 'man'),
(5, 'Ева', 'Полякова', '2011-01-28', 'Юг', 'Краснодар 352012', 25.8, 'woman'),
(6, 'Жасмин ', 'Хижняк', '2013-02-19', 'Старт', 'Архангельск 494562', 23.7, 'woman'),
(7, 'Юлия', 'Ермакова ', '2010-01-02', 'Олимпиец', 'Оренбург 460132', 26.35, 'woman'),
(8, 'Клара', 'Цветкова', '2010-05-05', 'Север', 'Мурманск 183017', 26.1, 'woman'),
(9, 'Валентина', 'Филатов', '2010-10-10', 'Юг', 'Краснодар 352012', 25.6, 'woman'),
(10, 'Марта', 'Карпова', '2011-11-08', 'Мастер', 'Владимир 602587', 25.4, 'woman'),
(11, 'Мария ', 'Громова', '2009-06-29', 'Юность', 'Ростов-на-Дону 343602', 25.45, 'woman'),
(12, 'София ', 'Елисеева', '2012-03-27', 'Торнадо', 'Омск 644016', 25, 'woman'),
(13, 'Людмила', 'Кудряшова', '2008-09-17', 'ДзенДо', 'Красноярск 600895', 27.65, 'woman'),
(14, 'Юнона', 'Сорокина', '2012-08-08', 'Дзюдокан', 'Пермь 616405', 24.3, 'woman'),
(15, 'Зоя', 'Кириллова', '2007-11-17', 'Отвага', 'Саратов 410808', 27.9, 'woman'),
(16, 'Эльза', 'Власова', '2012-11-04', 'Планета Дзюдо', 'Тула 305614', 24.1, 'woman'),
(17, 'Оксана', 'Фёдорова', '2009-05-14', 'Огненный феникс', 'Самара 443058', 27.3, 'woman'),
(18, 'Полина', 'Тимофеева', '2009-10-24', 'Силачъ', 'Санкт-Петербург 187330', 27, 'woman'),
(19, 'Василиса', 'Уварова', '2011-05-09', 'Витязъ', 'Санкт-Петербург 188506', 24, 'woman'),
(20, 'Светлана', 'Носова', '2011-04-08', 'Сталь', 'Владивосток 690548', 25.05, 'woman'),
(21, 'Рыбакова', 'Виктория', '2008-03-20', 'Панда', 'Тюмень 625987', 28.2, 'woman'),
(22, 'Татьяна', 'Никифорова', '2011-07-14', 'Огненный феникс', 'Самара 443058', 24.7, 'woman'),
(23, 'Олег', 'Макаров', '2012-03-07', 'Юг', 'Краснодар 352012', 23.9, 'man'),
(24, 'Родион', 'Гордеев', '2013-01-14', 'Мастер', 'Владимир 602587', 24.2, 'man'),
(25, 'Гордей', 'Гайчук', '2012-02-16', 'Юность', 'Ростов-на-Дону 343602', 23, 'man'),
(26, 'Валерий', 'Ларионов', '2012-07-08', 'Силачъ', 'Санкт-Петербург 187330', 24, 'man'),
(27, 'Адам', 'Лебедев', '2011-06-09', '№1', 'Москва 105037', 26.65, 'man'),
(28, 'Евсей', 'Забужко', '2010-09-30', 'Старт', 'Архангельск 494562', 29.2, 'man'),
(29, 'Валентин', 'Петровский', '2009-12-10', 'Витязъ', 'Санкт-Петербург 188506', 31.2, 'man'),
(30, 'Семён', 'Михеев', '2009-11-07', 'Дзюдокан', 'Пермь 616405', 31.4, 'man'),
(31, 'Юлий', 'Горбачёв', '2008-07-31', 'Торнадо', 'Омск 644016', 32.7, 'man'),
(32, 'Георгий', 'Лобанов', '2010-05-23', 'Сталь', 'Владивосток 690548', 30.7, 'man'),
(33, 'Анатолий', 'Носов', '2010-06-13', 'Панда', 'Тюмень 625987', 29.05, 'man'),
(34, 'Глеб', 'Шумейко', '2011-09-25', 'ДзенДо', 'Красноярск 600895', 28.25, 'man'),
(35, 'Юрий', 'Романов', '2011-03-15', 'Север', 'Мурманск 183017', 28.1, 'man'),
(36, 'Фёдор', 'Ермаков', '2012-10-24', 'Олимпиец', 'Оренбург 460132', 24.7, 'man'),
(37, 'Павел', 'Щукин', '2011-07-16', 'Отвага', 'Саратов 410808', 27.9, 'man'),
(38, 'Альберт', 'Лапин', '2010-07-18', 'Торнадо', 'Омск 644016', 28.9, 'man'),
(39, 'Тимур ', 'Масловский', '2008-02-05', 'Отвага', 'Саратов 410808', 34.7, 'man'),
(40, 'Роберт', 'Кулагин', '2011-10-16', 'Планета Дзюдо', 'Тула 305614', 27.2, 'man'),
(41, 'tasd', 'asd', '0000-00-00', 'asd', 'asd', 0, 'm');

-- --------------------------------------------------------

--
-- Структура таблицы `tokens`
--

CREATE TABLE `tokens` (
  `user_id` int(11) NOT NULL,
  `token` varchar(32) COLLATE utf8_bin NOT NULL,
  `expiration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;