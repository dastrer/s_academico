-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2025 a las 02:57:45
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
-- Base de datos: `sistema-1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `idaula` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`idaula`, `nombre`, `condicion`) VALUES
(1, 'Aula 1', 1),
(2, 'Aula 102', 1),
(3, 'Aula 201', 1),
(4, 'Aula 202', 1),
(5, 'Aula 301', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `idcarrera` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`idcarrera`, `nombre`, `condicion`) VALUES
(1, 'Sistemas Informáticos', 1),
(2, 'Contaduría Pública', 1),
(3, 'Secretariado Ejecutivo', 1),
(4, 'Idioma Ingles', 1),
(5, 'Administración de Empresas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `idmateria` int(11) NOT NULL,
  `iddocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `nombre`, `idmateria`, `iddocente`) VALUES
(1, 'Curso A', 1, 1),
(2, 'Curso B', 2, 2),
(3, 'Curso C', 3, 3),
(4, 'Curso D', 4, 4),
(5, 'Curso E', 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `iddocente` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `apellido` varchar(70) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `celular` bigint(20) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `nivel_est` varchar(70) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`iddocente`, `nombre`, `apellido`, `cedula`, `direccion`, `celular`, `correo`, `nivel_est`, `condicion`) VALUES
(1, 'Marco', 'Lopez', '8012345', 'San Roque', 71500123, 'marco.lopez@incos.edu.bo', 'Licenciado', 1),
(2, 'Veronica', 'Apaza', '8023456', 'Villa Bolívar A', 72500654, 'veronica.apaza@incos.edu.bo', 'Magister', 1),
(3, 'Rolando', 'Quispe', '8034567', 'Río Seco', 73500234, 'r.quispe@incos.edu.bo', 'Ingeniero', 1),
(4, 'Sandra', 'Choque', '8045678', 'Villa Esperanza', 74500345, 'sandra.choque@incos.edu.bo', 'Licenciada', 1),
(5, 'David', 'Mamani', '8056789', 'Puerto de Mejillones', 75500456, 'd.mamani@incos.edu.bo', 'Ingeniero', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `apellido` varchar(70) NOT NULL,
  `edad` int(11) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `celular` bigint(20) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `fecha_nac` date NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `nombre`, `apellido`, `edad`, `cedula`, `direccion`, `celular`, `correo`, `fecha_nac`, `condicion`) VALUES
(1, 'Jhonatan', 'Quispe', 19, '8245678', 'Villa Adela', 71543210, 'jquispe@gmail.com', '2005-06-10', 1),
(2, 'María', 'Condori', 20, '8234567', 'Ciudad Satélite', 72456789, 'mcondori@hotmail.com', '2004-08-15', 1),
(3, 'Luis', 'Mamani', 18, '8256789', 'Mercedario', 73456781, 'luisma@outlook.com', '2006-01-22', 1),
(4, 'Ana', 'Choque', 21, '8223456', 'Villa Ingenio', 74456812, 'anachoque@gmail.com', '2003-11-30', 1),
(5, 'Carlos', 'Huanca', 22, '8267890', 'Zona 16 de Julio', 75456789, 'chuanca@gmail.com', '2002-09-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `idgrado` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`idgrado`, `nombre`, `condicion`) VALUES
(1, 'Tercer Año', 1),
(2, 'Segundo Año', 1),
(3, 'Primer Año', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `idinscripcion` int(11) NOT NULL,
  `idestudiante` int(11) NOT NULL,
  `idcarrera` int(11) NOT NULL,
  `idgrado` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `idturno` int(11) NOT NULL,
  `idaula` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha_ins` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`idinscripcion`, `idestudiante`, `idcarrera`, `idgrado`, `idcurso`, `idturno`, `idaula`, `idusuario`, `fecha_ins`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2025-01-10'),
(2, 2, 2, 2, 2, 2, 2, 2, '2025-01-11'),
(3, 3, 3, 3, 3, 3, 3, 3, '2025-01-12'),
(4, 4, 4, 4, 4, 4, 4, 4, '2025-01-13'),
(5, 5, 5, 5, 5, 5, 5, 5, '2025-01-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `idmateria` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`idmateria`, `nombre`, `condicion`) VALUES
(1, 'Redes de Computadoras I', 1),
(2, 'Programacion I', 1),
(3, 'Programacion en Internet', 1),
(4, 'Hardware de Computadoras', 1),
(5, 'Base de Datos I', 1),
(6, 'Base de datos II', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre_permiso` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre_permiso`) VALUES
(1, 'ver_estudiantes'),
(2, 'editar_inscripciones'),
(3, 'ver_notas'),
(4, 'administrar_usuarios'),
(5, 'generar_reportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`idturno`, `nombre`, `condicion`) VALUES
(1, 'Mañana', 1),
(2, 'Tarde', 1),
(3, 'Noche', 1),
(4, 'Intermedio', 1),
(5, 'Virtual', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `cargo` varchar(70) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(70) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `cedula`, `direccion`, `celular`, `email`, `cargo`, `login`, `clave`, `imagen`, `condicion`) VALUES
(1, 'Carlos Mamani', '8374562', 'Zona Villa Adela, Calle 8', '71582345', 'cmamani@gmail.com', 'Administrador', 'carlos.m', 'admin123', 'carlos.jpg', 1),
(2, 'Sandra Quispe', '6247895', 'Zona Río Seco, Av. Juan Pablo II', '70654321', 'sandraq@hotmail.com', 'Secretaria', 'sandra.q', 'secret321', 'sandra.png', 1),
(3, 'Jorge Choque', '7896543', 'Zona 12 de Octubre, Calle P', '73548901', 'jchoque@incos.edu.bo', 'Docente', 'jorge.c', 'docente2024', 'jorge.jpeg', 1),
(4, 'Lucía Flores', '8529631', 'Zona Alto Lima, Calle 10', '74920123', 'lflores@incos.edu.bo', 'Coordinadora', 'lucia.f', 'coord2024', 'lucia.jpg', 1),
(5, 'Marco Álvarez', '7698432', 'Zona Senkata, Calle 3', '70123456', 'malvarez@correo.com', 'Administrador', 'marco.a', 'admin2024', 'marco.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`idaula`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`idcarrera`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `idmateria` (`idmateria`),
  ADD KEY `iddocente` (`iddocente`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`iddocente`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idestudiante`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`idgrado`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`idinscripcion`),
  ADD KEY `idestudiante` (`idestudiante`),
  ADD KEY `idcarrera` (`idcarrera`),
  ADD KEY `idgrado` (`idgrado`),
  ADD KEY `idcurso` (`idcurso`),
  ADD KEY `idturno` (`idturno`),
  ADD KEY `idaula` (`idaula`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idmateria`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`idturno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idpermiso` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `idaula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `idcarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `iddocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `idgrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `idinscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `idturno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
