-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2024 a las 01:21:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `es_administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_usuario`, `usuario`, `contrasenia`, `es_administrador`) VALUES
(1, 'pokeadmin', '1234', 1),
(2, 'poke', '123', 0);

-- --------------------------------------------------------


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
(6, 7, 'Squirtle.png', 'Squirtle', 3, NULL),
(7, 4, 'Charmander.png', 'Charmander', 2, NULL),
(8, 144, 'Articuno.png', 'Articuno', 14, NULL),
(9, 24, 'Arbok.png', 'Arbok', 7, NULL),
(10, 12, 'Butterfree.png', 'Butterfree', 16, 4),
(12, 15, '1714863113.png', 'Beedrill', 16, 7),
(13, 2, '1714863557.png', 'Ivysaur', 1, 7),
(14, 3, '1714863769.png', 'Venusaur', 1, 7),
(22, 30, '1714864163.png', 'Nidorina', 7, 1),
(23, 32, '1714864259.png', 'Nidoran', 7, NULL),
(24, 6, '1714864361.png', 'Charizard', 2, 4),
(25, 18, '1714864441.png', 'Pidgeot', 6, 4),
(26, 84, '1714864648.png', 'Doduo', 6, 4),
(27, 87, '1714864717.png', 'Dewgong', 3, 14),
(28, 81, '1714864813.png', 'Magnemite', 8, NULL),
(29, 78, '1714864879.png', 'Rapidash', 2, NULL),
(30, 77, '1714864953.png', 'Ponyta', 2, NULL),
(31, 76, '1714865027.png', 'Golem', 12, 9),
(32, 73, '1714865084.png', 'Tentacruel', 7, 3),
(37, 80, '1714871196.png', 'Slowbro', 3, 11),
(38, 90, '1714871350.png', 'Shellder', 3, NULL),
(39, 66, '1714871412.png', 'Machop', 10, NULL),
(40, 56, '1714871514.png', 'Mankey', 10, NULL),
(41, 64, '1714876280.png', 'Kadabra', 11, NULL),
(42, 47, '1714876356.png', 'Parasect', 16, 1),
(43, 44, '1714876481.png', 'Gloom', 1, 7),
(44, 25, '1714876574.png', 'Pikachu', 8, NULL),
(45, 33, '1714876648.png', 'Nidorino', 7, NULL),
(48, 28, '1714876870.png', 'Sandslash', 9, NULL),
(49, 19, '1714877013.png', 'Rattata', 6, 9),
(50, 16, '1714877079.png', 'Pidgey', 6, 4),
(52, 13, '1714877281.png', 'Weedle', 16, 7),
(54, 9, '1714877455.png', 'Blastoise', 3, 3),
(55, 37, '1714877534.png', 'Vulpix', 2, NULL),
(57, 31, '1714877683.png', 'Nidoqueen', 7, 9),
(58, 38, '1714877751.png', 'Ninetales', 2, 7),
(59, 39, '1714877853.png', 'Jigglypuff', 6, NULL),
(60, 42, '1714877951.png', 'Golbat', 7, 4),
(61, 43, '1714878075.png', 'Oddish', 1, 7),
(62, 46, '1714878178.png', 'Paras', 16, 1),
(63, 45, '1714878318.png', 'Vileplume', 1, 7),
(64, 50, '1714878482.png', 'Diglett', 9, NULL),
(66, 54, '1714878819.png', 'Psyduck', 3, NULL),
(67, 58, '1714878929.png', 'Growlithe', 2, NULL),
(68, 59, '1714879117.png', 'Arcanine', 2, 12),
(69, 62, '1714879200.png', 'Poliwrath', 3, 10),
(71, 63, '1714879549.png', 'Abra', 11, NULL),
(73, 61, '1714879933.png', 'Poliwhirl', 3, NULL),
(74, 55, '1714880024.png', 'Golduck', 3, NULL),
(75, 57, '1714880083.png', 'Primeame', 10, NULL),
(76, 41, '1714880240.png', 'Zubat', 7, 6),
(78, 49, '1714880432.png', 'Venomoth', 16, 7),
(80, 88, '1714950137.png', 'Grimer', 7, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo_pokemon` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id_tipo_pokemon`, `descripcion`) VALUES
(1, 'planta'),
(2, 'fuego'),
(3, 'agua'),
(4, 'volador'),
(5, 'insecto'),
(6, 'normal'),
(7, 'veneno'),
(8, 'electrico'),
(9, 'tierra'),
(10, 'lucha'),
(11, 'psiquico'),
(12, 'roca'),
(13, 'fantasma'),
(14, 'hielo'),
(15, 'dragon'),
(16, 'bicho');

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
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo_pokemon`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  MODIFY `id_bdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo_pokemon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
