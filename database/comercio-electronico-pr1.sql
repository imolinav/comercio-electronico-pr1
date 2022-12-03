-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2022 a las 19:46:51
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comercio-electronico-pr1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `name`, `field`, `description`, `tags`, `created_at`, `updated_at`) VALUES
(10, 'Mercadona', '0', 'Technology company', 'phones, computers, tablets', '2022-11-24 12:12:36', '2022-11-24 12:12:36'),
(11, 'Consum', '0', 'Technology company', 'phones, computers, tablets', '2022-11-24 12:12:36', '2022-11-24 12:12:36'),
(12, 'Carrefour', '0', 'Technology company', 'phones, computers, tablets', '2022-11-24 12:12:36', '2022-11-24 12:12:36'),
(13, 'Charter', '0', 'Technology company', 'phones, computers, tablets', '2022-11-24 12:12:36', '2022-11-24 12:12:36'),
(14, 'Lidl', '0', 'Technology company', 'phones, computers, tablets', '2022-11-24 12:12:36', '2022-11-24 12:12:36'),
(15, 'Aldi', '0', 'Technology company', 'phones, computers, tablets', '2022-11-24 12:12:36', '2022-11-24 12:12:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direction`
--

CREATE TABLE `direction` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `direction`
--

INSERT INTO `direction` (`id`, `user_id`, `name`, `surname`, `street`, `postal_code`, `country`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, '1669381003929', 'qwer', 'qwer', 'qwer', 1234, 'qwer', 'qwer', 'qwer', '2022-11-28 13:11:18', '2022-11-28 13:11:18'),
(2, '1669381003929', 'asdf', 'qweasd', 'asdfasdf', 1234, 'asdf', 'asdf', 'asdf', '2022-11-28 14:44:37', '2022-11-28 14:44:37'),
(3, '1669381003929', 'zxcvzxcv', 'zxcvzxcv', 'zxcvzxcv', 1234, 'zxcv', 'zxcv', 'zxcv', '2022-11-28 14:45:35', '2022-11-28 14:45:35'),
(4, 'e_1669716872019', 'asdf', 'sadf', 'asdf', 1234, 'asdf', 'asdf', 'asdf', '2022-11-29 10:16:27', '2022-11-29 10:16:27'),
(5, '19', 'Ian', 'Molina', 'Alacant', 234234, 'España', '123123123', 'adsf@adsf.acds', '2022-12-03 10:15:59', '2022-12-03 10:15:59'),
(6, '19', 'qwer', 'qwer', 'qwer', 0, 'qwer', 'qwer', 'qwer', '2022-12-03 10:18:57', '2022-12-03 10:18:57'),
(7, '26', 'Ian', 'Molina', 'C/Alacant, 20, 25', 49456, 'España', '123123123', 'ianmolina@papal.com', '2022-12-03 11:17:34', '2022-12-03 11:17:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `quantity` float NOT NULL,
  `discount_type` int(11) NOT NULL,
  `valid_until` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discount_type`
--

CREATE TABLE `discount_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `paypal_user` varchar(255) DEFAULT NULL,
  `credit_card` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `payment_method`
--

INSERT INTO `payment_method` (`id`, `user_id`, `payment_type`, `paypal_user`, `credit_card`, `created_at`, `updated_at`) VALUES
(9, '1669381003929', 1, 'asdfasdf', NULL, '2022-11-28 13:01:31', '2022-11-28 13:01:31'),
(10, '1669381003929', 1, 'asdfasdf', NULL, '2022-11-28 14:41:37', '2022-11-28 14:41:37'),
(11, '1669381003929', 1, 'asdfasdf', NULL, '2022-11-28 14:42:12', '2022-11-28 14:42:12'),
(12, '1669381003929', 1, 'asdf', NULL, '2022-11-28 14:42:39', '2022-11-28 14:42:39'),
(13, 'e_1669716872019', 1, 'user_e@test.test', NULL, '2022-11-29 10:15:59', '2022-11-29 10:15:59'),
(14, 'e_1669716872019', 1, 'user_e@test.test', NULL, '2022-11-29 10:16:05', '2022-11-29 10:16:05'),
(15, '19', 1, 'qwerqewr', NULL, '2022-12-03 10:13:35', '2022-12-03 10:13:35'),
(16, '19', 1, 'asdfasdf', NULL, '2022-12-03 10:18:33', '2022-12-03 10:18:33'),
(17, '19', 1, 'asdfasdfasdf', NULL, '2022-12-03 10:18:49', '2022-12-03 10:18:49'),
(18, '26', 1, 'ianmolina@papal.com', NULL, '2022-12-03 11:17:06', '2022-12-03 11:17:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `payment_type`
--

INSERT INTO `payment_type` (`id`, `type`) VALUES
(1, 'Paypal'),
(2, 'Credit Card');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `offer` float NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `company_id`, `price`, `offer`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Mercadona tablet', 10, 10, 8, 'Tablet de la empresa Mercadona', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(2, 'Mercadona computer', 10, 10, 8, 'Computer de la empresa Mercadona', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(3, 'Mercadona phone', 10, 10, 8, 'Phone de la empresa Mercadona', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(4, 'Mercadona TV', 10, 10, 8, 'TV de la empresa Mercadona', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(5, 'Mercadona car', 10, 10, 8, 'Car de la empresa Mercadona', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(6, 'Consum tablet', 11, 10, 8, 'Tablet de la empresa Consum', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(7, 'Consum computer', 11, 10, 8, 'Computer de la empresa Consum', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(8, 'Consum phone', 11, 10, 8, 'Phone de la empresa Consum', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(9, 'Consum TV', 11, 10, 8, 'TV de la empresa Consum', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(10, 'Consum car', 11, 10, 8, 'Car de la empresa Consum', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(11, 'Carrefour tablet', 12, 10, 8, 'Tablet de la empresa Carrefour', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(12, 'Carrefour computer', 12, 10, 8, 'Computer de la empresa Carrefour', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(13, 'Carrefour phone', 12, 10, 8, 'Phone de la empresa Carrefour', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(14, 'Carrefour TV', 12, 10, 8, 'TV de la empresa Carrefour', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(15, 'Carrefour car', 12, 10, 8, 'Car de la empresa Carrefour', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(16, 'Charter tablet', 13, 10, 8, 'Tablet de la empresa Charter', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(17, 'Charter computer', 13, 10, 8, 'Computer de la empresa Charter', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(18, 'Charter phone', 13, 10, 8, 'Phone de la empresa Charter', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(19, 'Charter TV', 13, 10, 8, 'TV de la empresa Charter', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(20, 'Charter car', 13, 10, 8, 'Car de la empresa Charter', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(21, 'Lidl tablet', 14, 10, 8, 'Tablet de la empresa Lidl', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(22, 'Lidl computer', 14, 10, 8, 'Computer de la empresa Lidl', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(23, 'Lidl phone', 14, 10, 8, 'Phone de la empresa Lidl', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(24, 'Lidl TV', 14, 10, 8, 'TV de la empresa Lidl', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(25, 'Lidl car', 14, 10, 8, 'Car de la empresa Lidl', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(26, 'Aldi tablet', 15, 10, 8, 'Tablet de la empresa Aldi', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(27, 'Aldi computer', 15, 10, 8, 'Computer de la empresa Aldi', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(28, 'Aldi phone', 15, 10, 8, 'Phone de la empresa Aldi', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(29, 'Aldi TV', 15, 10, 8, 'TV de la empresa Aldi', '2022-11-24 12:25:33', '2022-11-24 12:25:33'),
(30, 'Aldi car', 15, 10, 8, 'Car de la empresa Aldi', '2022-11-24 12:25:33', '2022-11-24 12:25:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_has_type`
--

CREATE TABLE `product_has_type` (
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product_has_type`
--

INSERT INTO `product_has_type` (`product_id`, `type_id`) VALUES
(1, 1),
(1, 1),
(6, 1),
(11, 1),
(16, 1),
(21, 1),
(2, 2),
(7, 2),
(12, 2),
(17, 2),
(22, 2),
(3, 3),
(8, 3),
(13, 3),
(18, 3),
(23, 3),
(4, 4),
(9, 4),
(14, 4),
(19, 4),
(24, 4),
(5, 5),
(10, 5),
(15, 5),
(20, 5),
(25, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `utility` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `user_id`, `rating`, `comment`, `utility`, `created_at`, `updated_at`) VALUES
(1, 1, '22', 3, '', 0, '2022-11-25 09:29:15', '2022-11-25 09:30:42'),
(2, 1, '23', 4, '', 0, '2022-11-25 09:29:45', '2022-11-25 09:30:42'),
(3, 1, '19', 4, '', 0, '2022-11-25 09:30:09', '2022-11-25 09:30:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product_type`
--

INSERT INTO `product_type` (`id`, `type`) VALUES
(1, 'Tablet'),
(2, 'Computer'),
(3, 'Phone'),
(4, 'TV'),
(5, 'Car');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_direction` int(11) DEFAULT NULL,
  `user_payment` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `finished_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `purchase`
--

INSERT INTO `purchase` (`id`, `user_id`, `user_direction`, `user_payment`, `discount_id`, `finished_at`, `created_at`, `updated_at`) VALUES
(15, '1669381003929', 1, 9, NULL, '2022-11-28 15:32:12', '2022-11-25 14:02:21', '2022-11-28 15:32:12'),
(16, '0', NULL, NULL, NULL, NULL, '2022-11-29 10:03:32', '2022-11-29 10:03:32'),
(17, 'e_1669716872019', 4, 13, NULL, '2022-11-29 10:16:38', '2022-11-29 10:15:18', '2022-11-29 10:16:38'),
(18, 'e_1669716872019', 4, 14, NULL, '2022-11-29 10:20:11', '2022-11-29 10:17:01', '2022-11-29 10:20:11'),
(19, '19', 6, 17, NULL, '2022-12-03 10:19:06', '2022-12-03 10:11:30', '2022-12-03 10:19:06'),
(20, '26', 7, 18, NULL, '2022-12-03 11:20:23', '2022-12-03 11:10:44', '2022-12-03 11:20:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_has_product`
--

CREATE TABLE `purchase_has_product` (
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `purchase_has_product`
--

INSERT INTO `purchase_has_product` (`purchase_id`, `product_id`, `created_at`, `updated_at`) VALUES
(15, 2, '2022-11-28 11:17:36', '2022-11-28 11:17:36'),
(15, 7, '2022-11-28 11:26:34', '2022-11-28 11:26:34'),
(16, 2, '2022-11-29 10:03:32', '2022-11-29 10:03:32'),
(16, 7, '2022-11-29 10:03:35', '2022-11-29 10:03:35'),
(16, 12, '2022-11-29 10:03:37', '2022-11-29 10:03:37'),
(16, 17, '2022-11-29 10:03:39', '2022-11-29 10:03:39'),
(16, 22, '2022-11-29 10:03:41', '2022-11-29 10:03:41'),
(16, 12, '2022-11-29 10:03:48', '2022-11-29 10:03:48'),
(17, 2, '2022-11-29 10:15:18', '2022-11-29 10:15:18'),
(17, 7, '2022-11-29 10:15:21', '2022-11-29 10:15:21'),
(17, 12, '2022-11-29 10:15:23', '2022-11-29 10:15:23'),
(17, 12, '2022-11-29 10:15:23', '2022-11-29 10:15:23'),
(17, 12, '2022-11-29 10:15:23', '2022-11-29 10:15:23'),
(18, 2, '2022-11-29 10:17:01', '2022-11-29 10:17:01'),
(19, 2, '2022-12-03 10:11:30', '2022-12-03 10:11:30'),
(19, 12, '2022-12-03 10:11:32', '2022-12-03 10:11:32'),
(19, 17, '2022-12-03 10:11:34', '2022-12-03 10:11:34'),
(20, 1, '2022-12-03 11:10:44', '2022-12-03 11:10:44'),
(20, 1, '2022-12-03 11:10:44', '2022-12-03 11:10:44'),
(20, 1, '2022-12-03 11:10:44', '2022-12-03 11:10:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `birth_date`, `created_at`, `updated_at`) VALUES
(19, 'Ian', 'Molina', 'imolinava@uoc.edu', '$2y$10$rC.1u1aDCJXG5s420Z6s9OYOfHzxzVuFCgRtGF.YIMIAzKb1BaL6m', '1992-03-24', '2022-11-23 16:24:11', '2022-11-23 16:24:11'),
(22, 'qwer', 'qwer', 'user3pr@test.test', '$2y$10$6zGNSgYmhH/1.s3/WKbuPOCdWrlr7RBKeB8.yvh7dYUyHVaZWEnCW', '2022-11-16', '2022-11-23 17:04:29', '2022-11-23 17:04:29'),
(23, 'qwer', 'qwer', 'user33pr@test.test', '$2y$10$y1bDyXF1f3KBq89zBU7cTunhg5z6agDvSapX1gD.r7NaR9OvF.vRa', '2022-11-16', '2022-11-23 17:05:31', '2022-11-23 17:05:31'),
(24, 'Ian', 'Molina', 'qwer@qwer.com', '$2y$10$jn/zi.3WegnUATuY0wG3au0RBftNOnk3x4mfS5l4cEaUk5FaM5spS', '1212-02-14', '2022-12-03 10:51:34', '2022-12-03 10:51:34'),
(25, 'Ian', 'Molina', 'qwerqwer@qwer.com', '$2y$10$3YvRQgzdlj0WigPeGSGh..wEEFoXfEXV2Av2YTmNXC/PfW707Af6y', '1212-02-14', '2022-12-03 10:52:30', '2022-12-03 10:52:30'),
(26, 'Ian', 'Molina', 'qwerqwer1234@qwer.com', '$2y$10$ZsYUQhWVHNityDeXN.xeie.ILH0yDr3vxVV04FWnZbBMvBEqHs/Wu', '1212-02-14', '2022-12-03 10:53:21', '2022-12-03 10:53:21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_type` (`discount_type`) USING BTREE;

--
-- Indices de la tabla `discount_type`
--
ALTER TABLE `discount_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_type` (`payment_type`);

--
-- Indices de la tabla `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indices de la tabla `product_has_type`
--
ALTER TABLE `product_has_type`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indices de la tabla `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_payment` (`user_payment`),
  ADD KEY `user_direction` (`user_direction`),
  ADD KEY `discount_id` (`discount_id`);

--
-- Indices de la tabla `purchase_has_product`
--
ALTER TABLE `purchase_has_product`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `direction`
--
ALTER TABLE `direction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `discount_type`
--
ALTER TABLE `discount_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`discount_type`) REFERENCES `discount_type` (`id`);

--
-- Filtros para la tabla `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `payment_method_ibfk_2` FOREIGN KEY (`payment_type`) REFERENCES `payment_type` (`id`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Filtros para la tabla `product_has_type`
--
ALTER TABLE `product_has_type`
  ADD CONSTRAINT `product_has_type_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_has_type_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`id`);

--
-- Filtros para la tabla `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Filtros para la tabla `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`user_payment`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`user_direction`) REFERENCES `direction` (`id`),
  ADD CONSTRAINT `purchase_ibfk_4` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`);

--
-- Filtros para la tabla `purchase_has_product`
--
ALTER TABLE `purchase_has_product`
  ADD CONSTRAINT `purchase_has_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `purchase_has_product_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
