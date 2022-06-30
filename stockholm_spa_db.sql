-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 30 jun 2022 kl 09:44
-- Serverversion: 5.7.34
-- PHP-version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `stockholm_spa_db`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(9) NOT NULL,
  `billing_full_name` varchar(150) NOT NULL,
  `billing_street` varchar(100) NOT NULL,
  `billing_postal_code` varchar(100) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_country` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `billing_full_name`, `billing_street`, `billing_postal_code`, `billing_city`, `billing_country`, `create_date`) VALUES
(1, 2, 275, 'Checkout Test', 'Test 2', '10000', 'Test', 'SE', '2022-06-30 09:43:40');

-- --------------------------------------------------------

--
-- Tabellstruktur `order_items`
--

CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_title`, `quantity`, `unit_price`, `created_at`) VALUES
(1, 1, 1, 'Milky Jelly Cleanser', 1, 175, '2022-06-30 09:43:40'),
(2, 1, 5, 'Balm Dotcom', 1, 100, '2022-06-30 09:43:40');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(90) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `stock`, `img_url`) VALUES
(1, 'Milky Jelly Cleanser', 'A nourishing (and pH-balanced), creamy gel face wash that’s kind to every skin type under the sun.', 175, 10, 'product-images/MilkyJelly_Carousel_1.jpg'),
(2, 'Priming Moisturizer', 'A moisturizer that instantly brings out the best in your skin, making it fresh and glowing', 200, 15, 'product-images/PrimingMoisturizer.jpg'),
(3, 'Priming Moisturizer Balance', 'A lightweight gel-cream moisturizer that balances oil without drying skin or leaving a flat, powdery finish. Pores appear minimized, shine is gone, and skin is hydrated and happy.', 285, 5, 'product-images/PMB_1.jpg'),
(4, 'Super Bounce', 'A soothing combination of 2% Hyaluronic Acid Complex and Pro-Vitamin B5 that hydrates the skin on multiple levels.', 270, 8, 'product-images/SuperBounce_0_Global_01.jpg'),
(5, 'Balm Dotcom', 'A hydrating lip balm packed with antioxidants and natural emollients to nourish dry, chafed skin—in original or other fun flavors', 100, 5, 'product-images/BDC_update-1.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `street` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `city` varchar(90) NOT NULL,
  `country` varchar(90) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `create_date`) VALUES
(1, 'Natalie', 'Esseen', 'natalie.esseen@cmeducations.se', '$2y$12$UI0d.4V7Fq7nH0CPzdcktuPx3FvLfC86JtZDyLh7G3ajHzk.qVMPK', '0701234567', 'Test 1', '10000', 'Test', 'NO', '2022-06-28 09:49:45'),
(2, 'Checkout', 'Test', 'checkout@mail.com', '$2y$12$HfhdYQSigupyzWI3M61XyOtd7gnyayLmUjJXrVrBoPQQYElYcaZ1e', '10000', 'Test 2', '10000', 'Test', 'SE', '2022-06-30 09:43:40');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
