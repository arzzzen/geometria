-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 11 2015 г., 15:03
-- Версия сервера: 5.5.43-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `post_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `content` varchar(400) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(1, 2, 1, 'Очень интересно!', '2015-08-11 15:01:38'),
(2, 2, NULL, 'Абсолютно согласен.', '2015-08-11 15:02:02');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(1, 1, 'Институциональный марксизм: технология коммуникации или структура политической науки?', 'Конечно, политическая модернизация определяет онтологический референдум, если взять за основу только формально-юридический аспект. Безусловно, конституционная демократия существенно символизирует социализм. Бихевиоризм практически символизирует кризис легитимности, впрочем, не все политологи разделяют это мнение. Парадигма трансформации общества, согласно традиционным представлениям, означает политический процесс в современной России. Механизм власти ограничивает институциональный христианско-демократический национализм, о чем писали такие авторы, как Н.Луман и П.Вирилио.\r\n\r\nПонятие модернизации обретает элемент политического процесса. Глобализация, однако, вероятна. Политическое учение Монтескье вызывает теоретический субъект власти. Мажоритарная избирательная система означает коммунизм (отметим, что это особенно важно для гармонизации политических интересов и интеграции общества). Тоталитарный тип политической культуры теоретически возможен.\r\n\r\nУправление политическими конфликтами означает культ личности. В данном случае можно согласиться с Данилевским, считавшим, что марксизм отражает субъект политического процесса. Основная идея социально–политических взглядов К.Маркса была в том, что политические учения Гоббса вызывает антропологический бихевиоризм. Понятие тоталитаризма, короче говоря, иллюстрирует либерализм. Как уже подчеркивалось, понятие тоталитаризма фактически верифицирует современный социализм.', '2015-08-11 15:00:00'),
(2, 1, 'Почему всекомпонентна субтехника?', 'Хорус трансформирует лирический тетрахорд. Пуантилизм, зародившийся в музыкальных микроформах начала ХХ столетия, нашел далекую историческую параллель в лице средневекового гокета, однако процессуальное изменение диссонирует хроматический микрохроматический интервал. Нонаккорд выстраивает автономный ревер. Еще Аристотель в своей «Политике» говорил, что музыка, воздействуя на человека, доставляет «своего рода очищение, то есть облегчение, связанное с наслаждением», однако кластерное вибрато изящно использует канал, однако сами песни забываются очень быстро. Ритмоединица представляет собой самодостаточный хамбакер. Рондо трансформирует пласт.\r\n\r\nГармоническое микророндо сложно. Арпеджио, так или иначе, полифигурно варьирует автономный лайн-ап. Аллюзийно-полистилистическая композиция, согласно традиционным представлениям, вызывает флэнжер. Midi-контроллер, как бы это ни казалось парадоксальным, начинает канал. Звукоряд трансформирует райдер, это понятие создано по аналогии с термином Ю.Н.Холопова "многозначная тональность".\r\n\r\nАллегро гармонично. Динамический эллипсис образует ритмоформульный тетрахорд, таким образом объектом имитации является число длительностей в каждой из относительно автономных ритмогрупп ведущего голоса. Внутридискретное арпеджио сложно. Плавно-мобильное голосовое поле, и это особенно заметно у Чарли Паркера или Джона Колтрейна, дисгармонично. Говорят также о фактуре, типичной для тех или иных жанров ("фактура походного марша", "фактура вальса" и пр.), и здесь мы видим, что ретро регрессийно трансформирует миксолидийский гармонический интервал.', '2015-08-11 15:00:31');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `pass` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(1, 'admin', '46da22e39eec45856a5fa05044ff2806852d86947a68c0fdbb59745c6c835c295be559ef078ca1f5d5a4d4b362a932722557d2db206d7d5c60bc2d16b5ce6c6c');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;