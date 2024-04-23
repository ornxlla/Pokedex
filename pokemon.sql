-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2024 a las 00:54:21
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
  `id_bdd` int(151) NOT NULL,
  `id_pokemon` int(151) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemon`
--

INSERT INTO `pokemon` (`id_bdd`, `id_pokemon`, `imagen`, `nombre`, `descripcion`) VALUES
(1, 1, 'Pokedex/img/Bulbasaur.png.png', 'Bulbasaur', 'es un Pokémon de tipo planta/veneno introducido en la primera generación. Es uno de los tres Pokémon iniciales que pueden elegir los entrenadores que empiezan su aventura en la región de Kanto, junto a Charmander y Squirtle. Se destaca por ser el primer P'),
(2, 2, 'Pokedex/img/ivysaur.png', 'Ivysaur', 'Ivysaur es un Pokémon de tipo planta/veneno introducido en la primera generación. Es la evolución de Bulbasaur, uno de los Pokémon iniciales de Kanto.'),
(3, 3, 'Pokedex/img/Venusaur.png', 'Venusaur', ' es un Pokémon de tipo planta/veneno introducido en la primera generación. Es la evolución de Ivysaur.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_pokemon_tipo`
--

CREATE TABLE `relacion_pokemon_tipo` (
  `id_relacion` int(11) NOT NULL,
  `id_pokemon` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `relacion_pokemon_tipo`
--

INSERT INTO `relacion_pokemon_tipo` (`id_relacion`, `id_pokemon`, `id_tipo`) VALUES
(2, 1, 2),
(3, 1, 8),
(4, 2, 2),
(5, 2, 8),
(6, 3, 2),
(7, 3, 8);

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
(2, 'planta'),
(3, 'fuego'),
(4, 'agua'),
(5, 'volador'),
(6, 'insecto'),
(7, 'normal'),
(8, 'veneno'),
(9, 'electrico'),
(10, 'tierra'),
(11, 'lucha'),
(12, 'psiquico'),
(13, 'roca'),
(14, 'fantasma'),
(15, 'hielo'),
(16, 'dragon'),
(17, 'bicho/volador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pokemon`
--
ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id_bdd`),
  ADD UNIQUE KEY `id_pokemon` (`id_pokemon`);

--
-- Indices de la tabla `relacion_pokemon_tipo`
--
ALTER TABLE `relacion_pokemon_tipo`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `fk_id_pokemon` (`id_pokemon`),
  ADD KEY `fk_id_tipo` (`id_tipo`);

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
  MODIFY `id_bdd` int(151) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `relacion_pokemon_tipo`
--
ALTER TABLE `relacion_pokemon_tipo`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo_pokemon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `relacion_pokemon_tipo`
--
ALTER TABLE `relacion_pokemon_tipo`
  ADD CONSTRAINT `fk_id_pokemon` FOREIGN KEY (`id_pokemon`) REFERENCES `pokemon` (`id_bdd`),
  ADD CONSTRAINT `fk_id_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo_pokemon`),
  ADD CONSTRAINT `relacion_pokemon_tipo_ibfk_1` FOREIGN KEY (`id_pokemon`) REFERENCES `pokemon` (`id_bdd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
