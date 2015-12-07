-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 07 2015 г., 23:32
-- Версия сервера: 5.5.45
-- Версия PHP: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `HM`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(5, 'Магнус Флайт'),
(6, 'Данте Алигьери'),
(7, 'Анна Гаврилова'),
(8, 'Рысь Ю.И.'),
(9, 'В.Е. Степанов');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `price`, `description`) VALUES
(6, 'Город темной магии', '150.00', 'Когда-то Прага была городом огромного богатства и культуры, домом для императоров, алхимиков, астрономов, и, добавляли шепотом, порталом в ад. Оправляясь в пражский замок, заносить в каталог манускрипты Бетховена, музыкальная студентка Сара Вестон понятия не имела, насколько опасной станет ее жизнь.\r\nВскоре после прибытия Сары начинают происходить странные вещи. Она выясняет, что ее ментор, который работал в замке, возможно не совершал самоубийства. Могут его загадочные записи быть предупреждениями? Пока Сара расшифровывает его подсказки к «Бессмертной возлюбленной» Бетховена, она умудряется быть арестованной, заняться тантрическим сексом в общественном фонтане и открыть препарат для путешествия во времени. К тому же она привлекает внимание четырехсотлетнего дварфа, симпатичного принца Макса, и могущественного американского сенатора с секретами, которые она обязана спрятать.'),
(7, 'Божественная комедия', '137.35', 'Иллюстрированная версия\r\n«Комедия», ставшая для потомков «божественной книгой» — одно из величайших художественных произведений, какие знает мир. Это энциклопедия знаний «моральных, естественных, философских, богословских», грандиозный синтез феодально-католического мировоззрения и столь же грандиозного прозрения развертывающейся в то время новой культуры. Огромный поэтический гений автора поставил комедию над эпохой, сделал ее достоянием веков.'),
(8, 'Счастье вдруг, или История маленького дракона', '129.99', 'Счастье вдруг… в тишине… постучалось в…\r\nВпрочем, нет. Счастье герцога Кернского стучать в двери не стало. Оно поступило умней — в окно влезло. Просто когда счастье стоит на пороге, человек может не поверить и прогнать, а если уже прокралось в дом, то точно не отвертишься. Тут хочешь не хочешь, а принимай. Корми, люби, чеши и гладь! И если у тебя есть хоть немного ума, сделай всё, чтобы оно никуда не делось.\r\nГерцог Кернский глупцом никогда не был. Он вообще замечательный, если честно. А ещё у него совесть есть! Причём до того большая, что и на двоих хватит. А это в данном случае важно, ведь у герцогского счастья с совестью откровенные проблемы. Хотя последнее не удивительно — чего ещё ждать от девчонки? Тем более такой, как Астра!'),
(9, 'Социология', '45.91', 'Социология — это наука об обществе, системах, составляющих его, закономерностях его функционирования и развития, социальных институтах, отношениях и общностях. Социология изучает общество, раскрывая внутренние механизмы его строения и развития его структур (структурных элементов: социальных общностей, институтов, организаций и групп); закономерности социальных действий и массового поведения людей, а также отношения между личностью и обществом. Как фундаментальная наука, социология объясняет социальные явления, собирает и обобщает информацию о них. Как прикладная наука, социология позволяет прогнозировать социальные явления и управлять ими. С социологией тесно связаны такие науки, как психология, политология, культурология, антропология и другие гуманитарные дисциплины.'),
(10, 'тест', '10.00', 'ТЕСТ');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(5, 'Фэнтези'),
(6, 'Мистика'),
(7, 'Поэзия'),
(8, 'Пособие');

-- --------------------------------------------------------

--
-- Структура таблицы `sum_author`
--

CREATE TABLE IF NOT EXISTS `sum_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `sum_author`
--

INSERT INTO `sum_author` (`id`, `id_author`, `id_book`) VALUES
(16, 5, 6),
(17, 6, 7),
(18, 7, 8),
(19, 8, 9),
(20, 9, 9),
(25, 5, 10),
(26, 6, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `sum_genre`
--

CREATE TABLE IF NOT EXISTS `sum_genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_genre` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `sum_genre`
--

INSERT INTO `sum_genre` (`id`, `id_genre`, `id_book`) VALUES
(20, 5, 6),
(21, 6, 6),
(22, 7, 7),
(23, 5, 8),
(24, 8, 9),
(32, 6, 10),
(33, 7, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
