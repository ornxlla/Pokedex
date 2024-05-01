-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2024 a las 03:30:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pokemon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemon`
--

CREATE TABLE `pokemon` (
                           `id_bdd` int(11) NOT NULL,
                           `id_pokemon` int(11) NOT NULL,
                           `imagen` varchar(255) NOT NULL,
                           `nombre` varchar(255) NOT NULL,
                           `id_tipo_pokemon1` int(16) NOT NULL,
                           `id_tipo_pokemon2` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`id_bdd`, `id_pokemon`, `imagen`, `nombre`, `id_tipo_pokemon1`, `id_tipo_pokemon2`) VALUES
                                                                                                               (4, 1, '1714415092.png', 'Bulbasaur', 1, 7),
                                                                                                               (5, 148, '1714420200.png', 'Dragonair', 14, 15),
                                                                                                               (6, 1001, 'Squirtle.png', 'Squirtle', 3, NULL),
                                                                                                               (7, 1002, 'Charmander.png', 'Charmander', 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pokemon`
--
ALTER TABLE `pokemon`
    ADD PRIMARY KEY (`id_bdd`),
    ADD UNIQUE KEY `id_pokemon` (`id_pokemon`),
    ADD KEY `fk_tipo_pokemon1` (`id_tipo_pokemon1`),
    ADD KEY `fk_tipo_pokemon2` (`id_tipo_pokemon2`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pokemon`
--
ALTER TABLE `pokemon`
    MODIFY `id_bdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemon`
--
ALTER TABLE `pokemon`
    ADD CONSTRAINT `fk_tipo_pokemon1` FOREIGN KEY (`id_tipo_pokemon1`) REFERENCES `tipo` (`id_tipo_pokemon`),
    ADD CONSTRAINT `fk_tipo_pokemon2` FOREIGN KEY (`id_tipo_pokemon2`) REFERENCES `tipo` (`id_tipo_pokemon`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
