-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2018 a las 13:05:32
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica12`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `date_added`, `id_tienda`) VALUES
(1, 'Electrodomesticos', 'Serie de articulos electronicos para el hogar en ciudades', '2018-06-05 08:16:57', 1),
(2, 'Articulos del Hogar', 'Articulos para ama de casa hogarenias', '2018-06-05 08:20:30', 1),
(4, 'Platos', 'Vajilla para el hogar123', '2018-06-08 13:27:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id_historial`, `id_producto`, `id_user`, `fecha`, `nota`, `referencia`, `cantidad`, `id_tienda`) VALUES
(1, 3, 11, '2018-06-06 10:00:19', 'El empleadoFher Torres agrego 1 producto(s) al inventario', '11111', 1, 1),
(2, 3, 11, '2018-06-06 10:02:43', 'El empleado Fher Torres agrego 1 producto(s) al inventario', '1212', 1, 1),
(3, 3, 11, '2018-06-06 10:22:53', 'El empleado Fher Torres agrego 27 producto(s) al inventario', '121212', 27, 1),
(4, 3, 11, '2018-06-06 10:24:32', 'El empleado Fher Torres agrego 54 producto(s) al inventario', '131231', 54, 1),
(5, 3, 11, '2018-06-06 10:33:44', 'El empleado Fher Torres elimino 1 producto(s) del inventario', '321321', 1, 1),
(6, 4, 11, '2018-06-07 10:58:56', 'El empleado Fher Torres elimino 1 producto(s) del inventario', '432', 1, 1),
(1496, 3, 11, '2018-06-06 21:00:59', 'El empleado Fher Torres elimino 26 producto(s) del inventario', '1212', 26, 1),
(1497, 3, 11, '2018-06-06 21:01:07', 'El empleado Fher Torres elimino 26 producto(s) del inventario', '1212', 26, 1),
(1504, 6, 15, '2018-06-08 21:01:00', 'El empleado Mariana Hinojosa elimino 1 producto(s) del inventario', '432423', 1, 2),
(1505, 6, 15, '2018-06-08 21:01:18', 'El empleado Mariana Hinojosa agrego 3 producto(s) al inventario', '01203102', 3, 2),
(1506, 3, 11, '2018-06-10 08:36:43', 'El empleado Fher Torres agrego 1 producto(s) al inventario', '4213412', 1, 1),
(1507, 3, 11, '2018-06-12 12:24:45', 'El empleado Fher Torres agrego 1 producto(s) al inventario', '43242', 1, 1),
(1508, 3, 11, '2018-06-12 12:25:33', 'El empleado Fher Torres agrego 2 producto(s) al inventario', '432123', 2, 1),
(1509, 3, 11, '2018-06-12 12:25:58', 'El empleado Fher Torres agrego 2 producto(s) al inventario', '432432', 2, 1),
(1510, 3, 11, '2018-06-12 12:27:47', 'El empleado Fher Torres agrego 2 producto(s) al inventario', '54543', 2, 1),
(1511, 3, 11, '2018-06-12 12:27:55', 'El empleado Fher Torres elimino 1 producto(s) del inventario', '543543', 1, 1),
(1512, 3, 11, '2018-06-12 12:28:10', 'El empleado Fher Torres agrego 1 producto(s) al inventario', '21321', 1, 1),
(1513, 6, 13, '2018-06-12 12:48:44', 'El empleado Administrador Administrador agrego 6 producto(s) al inventario', 'dsadsa', 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` varchar(20) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo_producto`, `nombre_producto`, `date_added`, `precio_producto`, `stock`, `id_categoria`, `id_tienda`) VALUES
(3, '11111', 'Refrigerador', '2018-06-05 09:06:00', 1025, 0, 1, 1),
(4, '101010', 'Escoba', '2018-06-06 04:23:35', 14.5, 17, 2, 1),
(5, '1101', 'Lampara', '2018-06-08 20:17:45', 220, 12, 1, 1),
(6, '110011', 'Plato de vidrio', '2018-06-08 13:28:00', 30, 0, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id_tienda` int(11) NOT NULL,
  `nombre_tienda` varchar(50) NOT NULL,
  `direccion_tienda` varchar(100) NOT NULL,
  `estado_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id_tienda`, `nombre_tienda`, `direccion_tienda`, `estado_tienda`) VALUES
(1, 'Walmart', 'Colonia Adelitas #304', 1),
(2, 'Waldos', 'Colonia Centro', 1),
(1000, 'ROOT', 'ROOT', 1),
(1001, 'Gigante', '6 Ceros Carrera', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_password_hash` varchar(255) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `date_added` datetime NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`, `id_tienda`) VALUES
(11, 'Fher', 'Torres', 'Kenshi', 'kakashi1', 'kenshi_fe@hotmail.com', '2018-06-05 11:20:50', 1),
(13, 'Administrador', 'Administrador', 'admin', 'admin', 'admin@hotmail.com', '2018-06-06 21:02:19', 1000),
(14, 'Sergio', 'Perez Picazo', 'sergio', 'sergio', 'sergio@hotmail.com', '2018-06-08 20:22:49', 1),
(15, 'Mariana', 'Hinojosa Tijerin', 'mariana', 'mariana', 'mariana@hotmail.com', '2018-06-08 13:29:00', 2),
(16, 'Erick', 'Elizondo', 'erick', 'erick', 'erick@hotmail.com', '2018-06-10 05:33:43', 1001);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `total_venta` double(15,2) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha_venta`, `total_venta`, `id_tienda`) VALUES
(1, '2018-06-12 11:35:56', 235.00, 1),
(2, '2018-06-12 11:36:57', 1260.00, 1),
(3, '2018-06-12 11:38:17', 1699.00, 1),
(4, '2018-06-12 11:39:37', 1039.50, 1),
(5, '2018-06-12 11:57:39', 1025.00, 1),
(6, '2018-06-12 11:58:38', 1025.00, 1),
(7, '2018-06-12 11:59:08', 1025.00, 1),
(8, '2018-06-12 11:59:33', 1025.00, 1),
(9, '2018-06-12 12:00:17', 1025.00, 1),
(10, '2018-06-12 12:00:53', 1025.00, 1),
(11, '2018-06-12 12:07:16', 1025.00, 1),
(12, '2018-06-12 12:07:39', 1025.00, 1),
(13, '2018-06-12 12:08:08', 1025.00, 1),
(14, '2018-06-12 12:09:55', 1025.00, 1),
(15, '2018-06-12 12:10:18', 1259.50, 1),
(16, '2018-06-12 12:10:46', 1714.00, 1),
(17, '2018-06-12 12:13:00', 1025.00, 1),
(18, '2018-06-12 12:14:00', 1025.00, 1),
(19, '2018-06-12 12:17:57', 1025.00, 1),
(20, '2018-06-12 12:19:04', 1025.00, 1),
(21, '2018-06-12 12:21:36', 14.50, 1),
(22, '2018-06-12 12:22:06', 14.50, 1),
(23, '2018-06-12 12:28:31', 1025.00, 1),
(24, '2018-06-12 12:38:33', 14.50, 1),
(27, '2018-06-12 12:52:13', 30.00, 2),
(28, '2018-06-12 12:59:33', 120.00, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `codigo_producto` varchar(50) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`id_venta`, `id_producto`, `codigo_producto`, `nombre_producto`, `cantidad`) VALUES
(14, 3, '11111', 'Refrigerador', 1),
(15, 3, '11111', 'Refrigerador', 1),
(15, 5, '1101', 'Lampara', 1),
(15, 4, '101010', 'Escoba', 1),
(16, 3, '11111', 'Refrigerador', 1),
(16, 4, '101010', 'Escoba', 2),
(16, 5, '1101', 'Lampara', 3),
(17, 3, '11111', 'Refrigerador', 1),
(18, 3, '11111', 'Refrigerador', 1),
(19, 3, '11111', 'Refrigerador', 1),
(20, 3, '11111', 'Refrigerador', 1),
(21, 4, '101010', 'Escoba', 1),
(22, 4, '101010', 'Escoba', 1),
(23, 3, '11111', 'Refrigerador', 1),
(24, 4, '101010', 'Escoba', 1),
(27, 6, '110011', 'Plato de vidrio', 1),
(28, 6, '110011', 'Plato de vidrio', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id_tienda`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_tienda` (`id_tienda`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1514;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id_tienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `historial_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `historial_ibfk_3` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_tienda`) REFERENCES `tienda` (`id_tienda`);

--
-- Filtros para la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD CONSTRAINT `venta_producto_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`),
  ADD CONSTRAINT `venta_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
