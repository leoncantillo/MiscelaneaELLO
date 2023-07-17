-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2023 a las 23:55:19
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `data_ello`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ellodb_categories`
--

CREATE TABLE `ellodb_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ellodb_categories`
--

INSERT INTO `ellodb_categories` (`id`, `category_name`) VALUES
(0, ''),
(1, 'Cuadernos'),
(2, 'Marcadores'),
(3, 'Boligrafos'),
(4, 'Lápices');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ellodb_orderdetails`
--

CREATE TABLE `ellodb_orderdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `units` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ellodb_orders`
--

CREATE TABLE `ellodb_orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `order_date` date NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ellodb_products`
--

CREATE TABLE `ellodb_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(60) NOT NULL,
  `description` varchar(1200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `promotion_price` decimal(11,2) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `condition` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ellodb_profiles`
--

CREATE TABLE `ellodb_profiles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `profile_photo` varchar(100) DEFAULT NULL,
  `phonenumer` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ellodb_tags`
--

CREATE TABLE `ellodb_tags` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ellodb_tags`
--

INSERT INTO `ellodb_tags` (`id`, `tag_name`) VALUES
(0, ''),
(1, 'Con Stickers'),
(2, 'Para Dibujar'),
(4, 'Lettering');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ellodb_users`
--

CREATE TABLE `ellodb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `useradmin` tinyint(1) NOT NULL DEFAULT 0,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ellodb_categories`
--
ALTER TABLE `ellodb_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ellodb_orderdetails`
--
ALTER TABLE `ellodb_orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ellodb_orders`
--
ALTER TABLE `ellodb_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ellodb_products`
--
ALTER TABLE `ellodb_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ellodb_profiles`
--
ALTER TABLE `ellodb_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ellodb_tags`
--
ALTER TABLE `ellodb_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ellodb_users`
--
ALTER TABLE `ellodb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ellodb_categories`
--
ALTER TABLE `ellodb_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ellodb_orderdetails`
--
ALTER TABLE `ellodb_orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ellodb_orders`
--
ALTER TABLE `ellodb_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ellodb_products`
--
ALTER TABLE `ellodb_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ellodb_profiles`
--
ALTER TABLE `ellodb_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ellodb_tags`
--
ALTER TABLE `ellodb_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ellodb_users`
--
ALTER TABLE `ellodb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
