-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2022 a las 13:30:02
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas`
--
CREATE DATABASE IF NOT EXISTS `reservas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `reservas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idResource` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTimeSlot` int(11) NOT NULL,
  `date` date NOT NULL,
  `remarks` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idResource` (`idResource`),
  KEY `idUser` (`idUser`),
  KEY `idTimeSlot` (`idTimeSlot`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `idResource`, `idUser`, `idTimeSlot`, `date`, `remarks`) VALUES
(41, 2, 2, 1, '2022-03-18', 'Lo necesito para el aula 8'),
(44, 3, 1, 8, '2022-03-17', 'Se va a usar para presentacion'),
(51, 1, 1, 1, '2022-03-21', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_spanish_ci NOT NULL,
  `location` varchar(300) COLLATE utf8mb4_spanish_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `name`, `description`, `location`, `image`) VALUES
(1, 'Impresora Láser Brother', 'La impresora negra del departamento', 'Aula 7', 'imgs/resources/impresora.jpg'),
(2, 'Carrito de portátiles A', 'El carrito para portátiles negro que funciona bien', 'Lab. Biología', 'imgs/resources/carrito.jpg'),
(3, 'Proyector de portátil', 'El proyector para las clases sin pantalla', 'Dirección Provincial', 'imgs/resources/proyector.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timeslots`
--

DROP TABLE IF EXISTS `timeslots`;
CREATE TABLE IF NOT EXISTS `timeslots` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dayOfWeek` int(11) NOT NULL,
  `starTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `timeslots`
--

INSERT INTO `timeslots` (`id`, `dayOfWeek`, `starTime`, `endTime`) VALUES
(1, 1, '11:00:00', '12:00:00'),
(2, 1, '12:00:00', '13:00:00'),
(3, 2, '11:00:00', '12:00:00'),
(4, 2, '12:00:00', '13:00:00'),
(5, 3, '11:00:00', '12:00:00'),
(6, 3, '12:00:00', '13:00:00'),
(7, 4, '11:00:00', '12:00:00'),
(8, 4, '12:00:00', '13:00:00'),
(27, 5, '10:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `realname` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `type` enum('admin','user') COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `realname`, `type`) VALUES
(1, 'admin', 'admin', 'Administrador Administrez', 'admin'),
(2, 'Usuario', 'Usuario', 'Usuario Usuariez', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
