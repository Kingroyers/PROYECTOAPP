-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2025 a las 03:20:31
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
-- Base de datos: `appbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id_acceso` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `codigo_qr` varchar(255) DEFAULT NULL,
  `fecha_acceso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `nombre_completo`, `correo`, `contraseña`, `creado_en`) VALUES
(122, 'admin antonio', 'admin@gmail.com', 'admin123', '2025-04-19 19:33:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `nombre_clase` varchar(255) NOT NULL,
  `entrenador` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `capacidad_maxima` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `nombre_clase`, `entrenador`, `descripcion`, `horario`, `fecha`, `capacidad_maxima`) VALUES
(100097, 'boxing', 'camilo aguilar', 'lolo', '21:50:00', '2025-05-19', 2),
(100098, 'Zumba', 'Antonio Royero', 'lolo', '23:11:00', '2025-05-21', 2),
(100099, 'Crossfit', 'Antonio Royero', 'lolo', '16:57:00', '2025-05-22', 2),
(100100, 'boxing', 'Samuel Alzate', '1° Clase de Box con el Mejor Profe de box', '12:00:00', '2025-05-23', 1),
(100101, 'boxing', 'Samuel Alzate', 'lolo', '00:37:00', '2025-05-27', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_inscripcion` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscripcion`, `id_clase`, `id_usuario`, `fecha_inscripcion`) VALUES
(132, 100097, 1043647824, '2025-05-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` text NOT NULL,
  `foto_usuario` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id_login`, `id_usuario`, `nombre_usuario`, `apellido`, `correo`, `contraseña`, `foto_usuario`) VALUES
(1, 1043647824, 'Antonio', 'Royero', 'antonioroyeros@gmail.com', 'ROyero123', '680eca6f25142_androgynous-avatar-non-binary-queer-person.jpg'),
(2, 123, 'eder', 'arevalo', 'ederarevalo@gmail.com', 'Eder1234', '6827f36d833b2_2151100198.jpg'),
(4, 1234, 'samuel', 'alzate', 'samuelalzatetejada@gmail.com', 'Samuel1234', '680f8fe814ab1_WhatsApp Image 2025-04-28 at 9.23.22 AM.jpeg'),
(5, 1536, 'rosa', 'perez', 'rosalba@gmail.com', 'Rosa1234', NULL),
(6, 1924, 'luz', 'sepulveda', 'luz@gmail.com', 'luz123', '6812e301b1e86_luz.jpg'),
(8, 1891827393, 'brenda', 'royero', 'brendaroyeros@gmail.com', 'Brenda1234', '6826b178ec102_WhatsApp Image 2025-04-14 at 9.22.18 PM.jpeg'),
(9, 1234665, 'miguel', 'romero', 'mrpsistemas@gmail.com', 'Miguel123', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_plan` int(11) DEFAULT NULL,
  `nombre_titular` varchar(255) DEFAULT NULL,
  `numero_tarjeta` varchar(20) DEFAULT NULL,
  `fecha_caducidad` varchar(7) DEFAULT NULL,
  `codigo_seguridad` varchar(4) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_expiracion` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_usuario`, `id_plan`, `nombre_titular`, `numero_tarjeta`, `fecha_caducidad`, `codigo_seguridad`, `fecha_inicio`, `fecha_expiracion`, `estado`) VALUES
(7, 1536, 1, 'rosa', '115475158', '2027-05', '2183', '2025-05-14', '2025-05-14', 0),
(20, 1891827393, 1, 'antoino', '1234567887545678', '2026-01', '534', '2025-05-16', '2025-06-16', 1),
(26, 123, 2, 'antonio', '2134121421223233', '2026-01', '123', '2025-05-17', '2025-05-15', 0),
(33, 123, 3, 'eder', '9934728748279873', '2026-01', '988', '2025-05-23', '2025-06-23', 1),
(34, 1234, 3, 'antoino', '4535679875597568', '2027-02', '075', '2025-05-23', '2025-06-23', 1),
(35, 1234665, 3, 'samuel', '6271382168736761', '2026-01', '444', '2025-05-23', '2025-06-23', 1),
(36, 1043647824, 1, 'nkifnfinflknf', '8732498738978297', '2026-01', '788', '2025-05-27', '2025-06-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id_plan` int(11) NOT NULL,
  `nombre_plan` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `beneficios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id_plan`, `nombre_plan`, `precio`, `beneficios`) VALUES
(1, 'Eco', 30000.00, '• Precio accesible – Ideal para comenzar sin gastar de más.\r\n• Acceso a equipo completo – Todo lo necesario para entrenar bien.\r\n• Mejora tu salud y bienestar – Gana energía, fuerza y confianza.'),
(2, 'Estándar', 50000.00, '• Clases grupales incluidas – Yoga, HIIT, funcional y más.\r\n• Entrenamiento más completo – Acceso a zonas exclusivas como peso libre y área funcional.\r\n• Mejor relación calidad-precio – Más servicios sin pagar mucho más.'),
(3, 'VIP', 70000.00, '• Acceso prioritario y exclusivo – Horarios preferenciales y áreas VIP.\r\n• Entrenador personal – Asesoramiento especializado y entrenamientos a medida.\r\n• Servicios adicionales premium – Sauna, masajes, y acceso a eventos exclusivos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `Identificacion` int(20) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `id_plan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `Identificacion`, `Nombre`, `Apellido`, `Correo`, `id_plan`) VALUES
(1891827396, 123, 'eder', 'arevalo', 'ederarevalo@gmail.com', 2),
(1891827398, 1234, 'samuel', 'alzate', 'samuelalzatetejada@gmail.com', 3),
(1891827397, 1536, 'rosa', 'perez', 'rosalba@gmail.com', 1),
(1891827399, 1234665, 'miguel', 'romero', 'mrpsistemas@gmail.com', 3),
(1891827395, 1043647824, 'antonio', 'royero', 'antonioroyeros@gmail.com', 3),
(1891827394, 1891827393, 'brenda', 'royero', 'brendaroyeros@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id_acceso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `fk_inscripcion_clase` (`id_clase`),
  ADD KEY `fk_inscripcion_usuario` (`id_usuario`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_pagos_planes` (`id_plan`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id_plan`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Identificacion`),
  ADD KEY `id_usuario` (`id_usuario`,`Identificacion`),
  ADD KEY `id_usuario_2` (`id_usuario`),
  ADD KEY `fk_id_plan` (`id_plan`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id_acceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100102;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1891827400;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD CONSTRAINT `accesos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_inscripcion_clase` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscripcion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`Identificacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_planes` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id_plan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_plan` FOREIGN KEY (`id_plan`) REFERENCES `planes` (`id_plan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
