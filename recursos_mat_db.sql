-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2026 a las 07:58:39
-- Versión del servidor: 10.11.16-MariaDB
-- Versión de PHP: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `recursos_mat_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_proveedor`
--

CREATE TABLE `evaluacion_proveedor` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `criterio_1` int(11) NOT NULL,
  `criterio_2` int(11) NOT NULL,
  `total_puntos` int(11) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `firma_jefe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evaluacion_proveedor`
--

INSERT INTO `evaluacion_proveedor` (`id`, `proveedor_id`, `fecha`, `criterio_1`, `criterio_2`, `total_puntos`, `comentarios`, `firma_jefe`) VALUES
(1, 1, '2026-10-30', 50, 50, 100, 'NINGUNO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo_electronico` varchar(150) NOT NULL,
  `propietario_legal` varchar(255) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `estatus` varchar(50) DEFAULT 'Pendiente',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre_empresa`, `domicilio`, `ciudad`, `telefono`, `correo_electronico`, `propietario_legal`, `rfc`, `estatus`, `created_at`) VALUES
(1, 'LOGISTICA GUMO', 'AV LAURO VILLAR CARRETERA A LA PLAYA KM12.5', 'MATAMOROS', '8681231234', 'logistic.gumo@gmail.com', 'Jose Maldonado Games', 'GALS123456E56', 'Requisitado FO-03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisicion_bienes`
--

CREATE TABLE `requisicion_bienes` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `area_solicitante` varchar(150) NOT NULL,
  `descripcion_bienes` text NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad_medida` varchar(50) NOT NULL,
  `estatus_requisicion` varchar(50) DEFAULT 'Solicitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `requisicion_bienes`
--

INSERT INTO `requisicion_bienes` (`id`, `proveedor_id`, `fecha_solicitud`, `area_solicitante`, `descripcion_bienes`, `cantidad`, `unidad_medida`, `estatus_requisicion`) VALUES
(1, 1, '2026-10-30', 'Recursos Materiales y Servicios', 'pistola de aire caliente dewall modelo:D-1325', 1, 'Pieza', 'Solicitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seleccion_proveedor`
--

CREATE TABLE `seleccion_proveedor` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `criterio_1` int(11) NOT NULL,
  `criterio_2` int(11) NOT NULL,
  `criterio_3` int(11) NOT NULL,
  `criterio_4` int(11) NOT NULL,
  `criterio_5` int(11) NOT NULL,
  `criterio_6` int(11) NOT NULL,
  `criterio_7` int(11) NOT NULL,
  `criterio_8` int(11) NOT NULL,
  `total_puntos` int(11) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `firma_jefe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seleccion_proveedor`
--

INSERT INTO `seleccion_proveedor` (`id`, `proveedor_id`, `fecha`, `criterio_1`, `criterio_2`, `criterio_3`, `criterio_4`, `criterio_5`, `criterio_6`, `criterio_7`, `criterio_8`, `total_puntos`, `comentarios`, `firma_jefe`) VALUES
(1, 1, '2026-10-30', 20, 20, 16, 12, 10, 10, 8, 0, 96, NULL, NULL),
(2, 1, '2026-10-30', 20, 20, 16, 16, 10, 10, 8, 0, 100, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evaluacion_proveedor`
--
ALTER TABLE `evaluacion_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfc` (`rfc`);

--
-- Indices de la tabla `requisicion_bienes`
--
ALTER TABLE `requisicion_bienes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `seleccion_proveedor`
--
ALTER TABLE `seleccion_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evaluacion_proveedor`
--
ALTER TABLE `evaluacion_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `requisicion_bienes`
--
ALTER TABLE `requisicion_bienes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `seleccion_proveedor`
--
ALTER TABLE `seleccion_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `evaluacion_proveedor`
--
ALTER TABLE `evaluacion_proveedor`
  ADD CONSTRAINT `evaluacion_proveedor_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `requisicion_bienes`
--
ALTER TABLE `requisicion_bienes`
  ADD CONSTRAINT `requisicion_bienes_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `seleccion_proveedor`
--
ALTER TABLE `seleccion_proveedor`
  ADD CONSTRAINT `seleccion_proveedor_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
