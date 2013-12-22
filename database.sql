-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 02:29 PM
-- Server version: 5.1.72-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `decovery_p4_decovery_me`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `created`, `modified`, `user_id`, `author`, `title`, `content`, `image`) VALUES
(76, 1387732130, 1387732130, 3, 'Jane Austen', 'Pride and Prejudice', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas at massa at felis accumsan rhoncus. Donec ultricies libero sit amet risus pellentesque posuere. Praesent hendrerit dolor ac commodo condimentum. Phasellus eu nisi enim. Fusce volutpat quis sapien eget ornare. Suspendisse accumsan pulvinar lacus nec feugiat. Etiam aliquet leo eu nibh tristique, eget eleifend justo interdum.', 'Pride and Prejudice_1387732130.jpg'),
(77, 1387733749, 1387733749, 7, 'John Doe', 'Tales', 'Integer vulputate quam sit amet tempor imperdiet. Integer consectetur metus lacus, ac vulputate tortor rutrum a. Maecenas pulvinar nisi in tortor tempor, in laoreet urna ullamcorper. Sed fermentum ante ac leo elementum, vel dapibus enim gravida. Integer ultricies, lectus non laoreet dignissim, lorem massa convallis libero, at dapibus elit nibh ac eros.', 'Tales_1387733749.jpg'),
(78, 1387734695, 1387734695, 8, 'Dan Brown', 'Inferno', 'Nunc consequat faucibus enim sit amet tempor. Etiam vel libero lacus. Proin elementum vulputate risus vitae gravida. Etiam tempor, ante vitae venenatis convallis, ipsum purus tempor orci, a tempor dolor nisl ut sapien. Nam tristique neque eu risus porttitor, at mollis nibh ultricies.', 'Inferno_1387734695.jpg'),
(79, 1387735228, 1387735228, 9, 'J.K. Rowling', 'Harry Poter', 'Donec massa diam, sodales et purus a, interdum imperdiet lectus. Aliquam erat volutpat. Fusce vel sollicitudin neque, nec viverra odio. Aenean iaculis, nisi a rhoncus pulvinar, nisl mauris sollicitudin urna, vitae laoreet metus neque et nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce ipsum massa, ornare ac euismod id, tempus a libero. Etiam volutpat leo ac lacus pretium tristique.', 'Harry Poter_1387735228.jpg'),
(80, 1387737756, 1387737756, 1, 'vd', 'adgad', 'advag', 'Invalid file type.'),
(81, 1387740044, 1387740044, 10, 'Carles Dickens', 'The Pickwick Papers', 'Donec vestibulum, sem eget feugiat imperdiet, erat neque dictum libero, id hendrerit odio diam non nunc. Nunc malesuada augue quis lectus faucibus, vitae lobortis justo fringilla. Sed lacinia tempor odio, in vulputate risus ullamcorper et. Donec interdum semper erat a congue. Curabitur fringilla nunc enim, a semper elit semper nec. Nunc a ante facilisis, dictum nulla nec, tristique leo. Suspendisse ornare felis eget suscipit consectetur. Nunc placerat dignissim facilisis.', 'The Pickwick Papers_1387740044.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `timezone`, `token`, `password`, `last_login`, `first_name`, `last_name`, `email`, `bio`, `avatar`) VALUES
(1, 1387479842, 1387479842, '', '8b155d421c1864c30d12e58ec38b7d79ba06f1f9', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, 'Aiste', 'Ciurlyte', 'aiste@akmila.lt', '', '1.jpg'),
(2, 1387540973, 1387540973, '', '333d35dd0d61151616433169d7bbb431c5decb7a', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, 'betty', 'boo', 'betty@gmail.com', '', '2.jpg'),
(3, 1387561822, 1387561822, '', 'f94320ac5bf3ab8d5e53d54f6055257cd130f98b', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, 'Aiste', 'Ciurlyte', 'aiste@gmail.com', '', 'example.jpg'),
(7, 1387733605, 1387733605, '', '5dea985a50afda09a0e05c637c501f9ececa5c50', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, 'Mary', 'Jane', 'mary@gmail.com', '', 'example.jpg'),
(8, 1387734375, 1387734375, '', '55cc42e5b3d07918d429913b1b90200eccfd5716', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, 'Jimmy', 'T', 'jim@gmail.com', '', 'example.jpg'),
(9, 1387735133, 1387735133, '', 'aa29d0b4393ded3b7630951a9db84d6db3f6bb94', '5ac9bb69c20bf05a01d3c1627f66972ca0807de5', 0, 'Tina', 'Turner', 'tina@gmail.com', '', 'example.jpg'),
(10, 1387739868, 1387739868, '', 'e41756135d5d325456f9b2110bb6fdae7a68439f', '8187c4784f212fb2996ce0f060948fc730c804d6', 0, 'Aiste', 'Me', 'me@gmail.com', 'serdtjfysrdthfjykgulhij;oiug', 'example.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_users`
--

CREATE TABLE IF NOT EXISTS `users_users` (
  `user_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_id_followed` int(11) NOT NULL,
  PRIMARY KEY (`user_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users_users`
--

INSERT INTO `users_users` (`user_user_id`, `created`, `user_id`, `user_id_followed`) VALUES
(2, 1387562166, 3, 2),
(3, 1387562168, 3, 3),
(4, 1387628822, 1, 1),
(5, 1387628823, 1, 2),
(6, 1387628824, 1, 3),
(7, 1387630427, 2, 1),
(8, 1387630428, 2, 2),
(9, 1387630429, 2, 3),
(11, 1387641367, 3, 1),
(14, 1387735133, 9, 9),
(15, 1387735245, 9, 1),
(16, 1387735246, 9, 2),
(17, 1387735247, 9, 3),
(18, 1387735249, 9, 7),
(19, 1387735252, 9, 8),
(20, 1387735398, 1, 8),
(21, 1387735401, 1, 9),
(22, 1387735404, 1, 7),
(23, 1387739868, 10, 10),
(25, 1387739878, 10, 2),
(26, 1387739881, 10, 1),
(27, 1387739882, 10, 3),
(28, 1387739886, 10, 8),
(29, 1387739889, 10, 8),
(30, 1387739889, 10, 7),
(31, 1387739894, 10, 9);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_users`
--
ALTER TABLE `users_users`
  ADD CONSTRAINT `users_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
