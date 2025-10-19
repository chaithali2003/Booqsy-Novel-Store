-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 19, 2025 at 11:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booqsy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT 'default_book.jpg',
  `genre` enum('fiction','mystery','romance','sci-fi','fantasy','biography','history','thriller','horror') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `price`, `image`, `genre`, `created_at`) VALUES
(1, '0385720045', 'Never Let Me Go', 'Kazuo Ishiguro', 399.00, 'never-let-me-go.jpg', 'fiction', '2025-08-03 12:05:08'),
(2, '0571225405', 'The Curious Incident of the Dog in the Night-Time', 'Mark Haddon', 349.00, 'curious-incident.jpg', 'fiction', '2025-08-03 12:05:08'),
(3, '0743273567', 'The Glass Castle', 'Jeannette Walls', 429.00, 'glass-castle.jpg', 'fiction', '2025-08-03 12:05:08'),
(4, '0307278786', 'The Help', 'Kathryn Stockett', 379.00, 'the-help.jpg', 'fiction', '2025-08-03 12:05:08'),
(5, '0316017934', 'The Lovely Bones', 'Alice Sebold', 349.00, 'lovely-bones.jpg', 'fiction', '2025-08-03 12:05:08'),
(6, '1400034779', 'The Shadow of the Wind', 'Carlos Ruiz Zafón', 449.00, 'shadow-wind.jpg', 'fiction', '2025-08-03 12:05:08'),
(7, '1594480001', 'The Memory Keeper\'s Daughter', 'Kim Edwards', 399.00, 'memory-keeper.jpg', 'fiction', '2025-08-03 12:05:08'),
(8, '0062315005', 'The Ocean at the End of the Lane', 'Neil Gaiman', 299.00, 'ocean-lane.jpg', 'fiction', '2025-08-03 12:05:08'),
(9, '0312368475', 'Gone Girl', 'Gillian Flynn', 499.00, 'gone-girl.jpg', 'mystery', '2025-08-03 12:05:08'),
(10, '0307743654', 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 449.00, 'dragon-tattoo.jpg', 'mystery', '2025-08-03 12:05:08'),
(11, '0062073565', 'And Then There Were None', 'Agatha Christie', 299.00, 'none-left.jpg', 'mystery', '2025-08-03 12:05:08'),
(12, '0312948556', 'The No. 1 Ladies\' Detective Agency', 'Alexander McCall Smith', 349.00, 'ladies-detective.jpg', 'mystery', '2025-08-03 12:05:08'),
(13, '0062310631', 'Big Little Lies', 'Liane Moriarty', 399.00, 'big-little-lies.jpg', 'mystery', '2025-08-03 12:05:08'),
(14, '0553419714', 'The Cuckoo\'s Calling', 'Robert Galbraith', 429.00, 'cuckoos-calling.jpg', 'mystery', '2025-08-03 12:05:08'),
(15, '0062257838', 'The Woman in Cabin 10', 'Ruth Ware', 349.00, 'cabin-10.jpg', 'mystery', '2025-08-03 12:05:08'),
(16, '0316206849', 'The Cuckoo\'s Calling', 'Robert Galbraith', 379.00, 'cuckoos-calling.jpg', 'mystery', '2025-08-03 12:05:08'),
(17, '1476753163', 'Me Before You', 'Jojo Moyes', 349.00, 'me-before-you.jpg', 'romance', '2025-08-03 12:05:08'),
(18, '0345807984', 'The Rosie Project', 'Graeme Simsion', 299.00, 'rosie-project.jpg', 'romance', '2025-08-03 12:05:08'),
(19, '0671027344', 'The Notebook', 'Nicholas Sparks', 249.00, 'the-notebook.jpg', 'romance', '2025-08-03 12:05:08'),
(20, '0553418026', 'Eleanor & Park', 'Rainbow Rowell', 279.00, 'eleanor-park.jpg', 'romance', '2025-08-03 12:05:08'),
(21, '1476756669', 'The Hating Game', 'Sally Thorne', 329.00, 'hating-game.jpg', 'romance', '2025-08-03 12:05:08'),
(22, '1501142976', 'It Starts with Us', 'Colleen Hoover', 379.00, 'starts-with-us.jpg', 'romance', '2025-08-03 12:05:08'),
(23, '0345806406', 'Call Me by Your Name', 'André Aciman', 399.00, 'call-me-name.jpg', 'romance', '2025-08-03 12:05:08'),
(24, '0061120085', 'Pride and Prejudice', 'Jane Austen', 199.00, 'pride-prejudice.jpg', 'romance', '2025-08-03 12:05:08'),
(25, '0553293354', 'Foundation', 'Isaac Asimov', 349.00, 'foundation.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(26, '0441013597', 'Dune', 'Frank Herbert', 499.00, 'dune.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(27, '1857984986', 'The War of the Worlds', 'H.G. Wells', 279.00, 'war-worlds.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(28, '0345391802', 'The Moon is a Harsh Mistress', 'Robert A. Heinlein', 329.00, 'moon-mistress.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(29, '0765311789', 'Old Man\'s War', 'John Scalzi', 379.00, 'old-mans-war.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(30, '0316005383', 'The Host', 'Stephenie Meyer', 349.00, 'the-host.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(31, '0446675539', 'Contact', 'Carl Sagan', 399.00, 'contact.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(32, '0441008658', 'Ender\'s Game', 'Orson Scott Card', 299.00, 'enders-game.jpg', 'sci-fi', '2025-08-03 12:05:08'),
(33, '0439554934', 'The Name of the Wind', 'Patrick Rothfuss', 499.00, 'name-wind.jpg', 'fantasy', '2025-08-03 12:05:08'),
(34, '0553103547', 'A Game of Thrones', 'George R.R. Martin', 549.00, 'game-thrones.jpg', 'fantasy', '2025-08-03 12:05:08'),
(35, '0316056125', 'The Way of Kings', 'Brandon Sanderson', 529.00, 'way-kings.jpg', 'fantasy', '2025-08-03 12:05:08'),
(36, '0765326352', 'The Lies of Locke Lamora', 'Scott Lynch', 479.00, 'lies-lamora.jpg', 'fantasy', '2025-08-03 12:05:08'),
(37, '0316065765', 'The Blade Itself', 'Joe Abercrombie', 449.00, 'blade-itself.jpg', 'fantasy', '2025-08-03 12:05:08'),
(38, '0765345565', 'Gardens of the Moon', 'Steven Erikson', 469.00, 'gardens-moon.jpg', 'fantasy', '2025-08-03 12:05:08'),
(39, '0316068047', 'The Last Wish', 'Andrzej Sapkowski', 429.00, 'last-wish.jpg', 'fantasy', '2025-08-03 12:05:08'),
(40, '0765348275', 'The Black Prism', 'Brent Weeks', 459.00, 'black-prism.jpg', 'fantasy', '2025-08-03 12:05:08'),
(41, '0743247541', 'The Diary of a Young Girl', 'Anne Frank', 299.00, 'anne-frank.jpg', 'biography', '2025-08-03 12:05:08'),
(42, '0061120082', 'The Autobiography of Malcolm X', 'Malcolm X', 349.00, 'malcolm-x.jpg', 'biography', '2025-08-03 12:05:08'),
(43, '0743477103', 'Long Walk to Freedom', 'Nelson Mandela', 399.00, 'mandela.jpg', 'biography', '2025-08-03 12:05:08'),
(44, '0743493915', 'Bossypants', 'Tina Fey', 329.00, 'bossypants.jpg', 'biography', '2025-08-03 12:05:08'),
(45, '0062409865', 'When Breath Becomes Air', 'Paul Kalanithi', 379.00, 'breath-air.jpg', 'biography', '2025-08-03 12:05:08'),
(46, '1501127624', 'Leonardo da Vinci', 'Walter Isaacson', 499.00, 'da-vinci.jpg', 'biography', '2025-08-03 12:05:08'),
(47, '0062457714', 'Born a Crime', 'Trevor Noah', 349.00, 'born-crime.jpg', 'biography', '2025-08-03 12:05:08'),
(48, '1501173219', 'Becoming', 'Michelle Obama', 449.00, 'becoming.jpg', 'biography', '2025-08-03 12:05:08'),
(49, '0060925532', 'Guns, Germs, and Steel', 'Jared Diamond', 499.00, 'guns-germs.jpg', 'history', '2025-08-03 12:05:08'),
(50, '0743271319', '1776', 'David McCullough', 399.00, '1776.jpg', 'history', '2025-08-03 12:05:08'),
(51, '0060194995', 'A People\'s History of the United States', 'Howard Zinn', 449.00, 'peoples-history.jpg', 'history', '2025-08-03 12:05:08'),
(52, '0143039954', 'The Wright Brothers', 'David McCullough', 349.00, 'wright-bros.jpg', 'history', '2025-08-03 12:05:08'),
(53, '0060555661', 'The Tipping Point', 'Malcolm Gladwell', 299.00, 'tipping-point.jpg', 'history', '2025-08-03 12:05:08'),
(54, '0743297318', 'Team of Rivals', 'Doris Kearns Goodwin', 499.00, 'team-rivals.jpg', 'history', '2025-08-03 12:05:08'),
(55, '0062316095', 'Sapiens', 'Yuval Noah Harari', 399.00, 'sapiens.jpg', 'history', '2025-08-03 12:05:08'),
(56, '0307474279', 'The Guns of August', 'Barbara W. Tuchman', 429.00, 'guns-august.jpg', 'history', '2025-08-03 12:05:08'),
(57, '0316056731', 'The Girl Who Played with Fire', 'Stieg Larsson', 399.00, 'played-fire.jpg', 'thriller', '2025-08-03 12:05:08'),
(58, '0062073492', 'Murder on the Orient Express', 'Agatha Christie', 299.00, 'orient-express.jpg', 'thriller', '2025-08-03 12:05:08'),
(59, '0316168815', 'The Snowman', 'Jo Nesbø', 379.00, 'the-snowman.jpg', 'thriller', '2025-08-03 12:05:08'),
(60, '0062257839', 'The Woman in the Window', 'A.J. Finn', 349.00, 'woman-window.jpg', 'thriller', '2025-08-03 12:05:08'),
(61, '0316010662', 'The Bourne Identity', 'Robert Ludlum', 329.00, 'bourne-identity.jpg', 'thriller', '2025-08-03 12:05:08'),
(62, '1250301696', 'The Silent Patient', 'Alex Michaelides', 389.00, 'silent-patient.jpg', 'thriller', '2025-08-03 12:05:08'),
(63, '0385347030', 'Sharp Objects', 'Gillian Flynn', 359.00, 'sharp-objects.jpg', 'thriller', '2025-08-03 12:05:08'),
(64, '1501168521', 'The Seven Husbands of Evelyn Hugo', 'Taylor Jenkins Reid', 429.00, 'evelyn-hugo.jpg', 'thriller', '2025-08-03 12:05:08'),
(65, '0385516484', 'The Shining', 'Stephen King', 399.00, 'the-shining.jpg', 'horror', '2025-08-03 12:05:08'),
(66, '0307346606', 'World War Z', 'Max Brooks', 349.00, 'world-war-z.jpg', 'horror', '2025-08-03 12:05:08'),
(67, '0385121679', 'The Exorcist', 'William Peter Blatty', 299.00, 'the-exorcist.jpg', 'horror', '2025-08-03 12:05:08'),
(68, '0451169526', 'It', 'Stephen King', 499.00, 'it.jpg', 'horror', '2025-08-03 12:05:08'),
(69, '0061002828', 'The Silence of the Lambs', 'Thomas Harris', 379.00, 'silence-lambs.jpg', 'horror', '2025-08-03 12:05:08'),
(70, '0316154514', 'The Haunting of Hill House', 'Shirley Jackson', 329.00, 'hill-house.jpg', 'horror', '2025-08-03 12:05:08'),
(71, '0385182448', 'Pet Sematary', 'Stephen King', 349.00, 'pet-sematary.jpg', 'horror', '2025-08-03 12:05:08'),
(72, '0451199867', 'Rosemary\'s Baby', 'Ira Levin', 299.00, 'rosemarys-baby.jpg', 'horror', '2025-08-03 12:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `book_id`, `quantity`, `created_at`) VALUES
(1, 2, 5, 1, '2025-08-04 10:05:23'),
(2, 2, 12, 2, '2025-08-04 10:05:23'),
(3, 2, 34, 1, '2025-08-04 10:05:23'),
(4, 2, 47, 3, '2025-08-04 10:05:23'),
(5, 2, 68, 1, '2025-08-04 10:05:23'),
(6, 2, 8, 1, '2025-08-04 10:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Heera', 'heerachaithra@gmail.com', '$2y$10$TS.xzsgozMsvlVilKkJqZ.nwjkl4b71hYIFu/BHi.uvAHYdJLCvM6', '2025-08-03 04:09:21'),
(2, 'Chaithali S', 'chaithalis471@gmail.com', '$2y$10$qcOOn/dGo9OaOaZMOoysGOAIZBiJNl7VoMjYflBuBU5fJCsGu.fMu', '2025-08-03 08:25:47'),
(3, 'pooja', 'pooja123@gmail.com', '$2y$10$HV.wmTEGjssvX9z4y2s07e7NnsNaQOBm2fukAE/T/7BAoxCcp5rte', '2025-08-03 10:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `book_id`, `created_at`) VALUES
(1, 2, 3, '2025-08-04 10:06:12'),
(2, 2, 18, '2025-08-04 10:06:12'),
(3, 2, 27, '2025-08-04 10:06:12'),
(4, 2, 52, '2025-08-04 10:06:12'),
(5, 2, 71, '2025-08-04 10:06:12'),
(6, 2, 15, '2025-08-04 10:06:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);
ALTER TABLE `books` ADD FULLTEXT KEY `title_author` (`title`,`author`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_book` (`user_id`,`book_id`),
  ADD KEY `fk_cart_book` (`book_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_book` (`user_id`,`book_id`),
  ADD KEY `fk_wishlist_book` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `fk_wishlist_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
