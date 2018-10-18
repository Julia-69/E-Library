-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 5, 2018 at 10:48 PM
-- Server version: 5.5.45
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yulia_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'Леся Українка'),
(2, 'Тарас Шевченко'),
(3, 'Павло Тичина'),
(4, 'Микола Гоголь'),
(5, 'Стівен Кінг'),
(6, 'Франц Кафка'),
(7, 'Джованні Бокаччо'),
(8, 'Габріель Гарсіа Маркес');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `pages` int(5) NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `isbn`, `price`, `pages`, `publication_id`) VALUES
(1, 'Сто років самоти', '123', 300, 500, NULL),
(2, 'Перетворення', '456', 200, 50, NULL),
(3, 'Мертві душі', '789', 350, 600, NULL),
(4, 'Тарас Бульба', '741', 200, 250, NULL),
(5, '11/22/63', '852', 400, 900, NULL),
(6, 'Під Куполом', '963', 280, 500, NULL),
(7, 'Кобзар', '159', 500, 115, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_author_has_book_author1` (`author_id`),
  KEY `fk_author_has_book_book1` (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`id`, `author_id`, `book_id`) VALUES
(1, 8, 1),
(2, 6, 2),
(3, 4, 3),
(4, 4, 4),
(5, 5, 5),
(6, 5, 6),
(7, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `book_genre`
--

CREATE TABLE IF NOT EXISTS `book_genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_genre_book` (`book_id`),
  KEY `fk_genre_book_genre1` (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `book_genre`
--

INSERT INTO `book_genre` (`id`, `genre_id`, `book_id`) VALUES
(1, 7, 1),
(2, 10, 2),
(3, 7, 3),
(4, 9, 4),
(5, 7, 5),
(6, 7, 6),
(7, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Біографія'),
(2, 'Детектив'),
(3, 'Комедія'),
(4, 'Поезія'),
(5, 'Пригоди'),
(6, 'Психологічний'),
(7, 'Роман'),
(8, 'Фантастика'),
(9, 'Поема'),
(10, 'Оповідання');

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `fk_author_has_book_author1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_author_has_book_book1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `book_genre`
--
ALTER TABLE `book_genre`
  ADD CONSTRAINT `fk_genre_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_genre_book_genre1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
