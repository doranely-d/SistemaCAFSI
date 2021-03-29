-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2014 a las 06:24:55
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistema_cafsi`
--
DROP DATABASE IF EXISTS `sistema_cafsi`;
CREATE DATABASE IF NOT EXISTS `sistema_cafsi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistema_cafsi`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ahf`
--

DROP TABLE IF EXISTS `ahf`;
CREATE TABLE IF NOT EXISTS `ahf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ahf` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apnp`
--

DROP TABLE IF EXISTS `apnp`;
CREATE TABLE IF NOT EXISTS `apnp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apnp` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app`
--

DROP TABLE IF EXISTS `app`;
CREATE TABLE IF NOT EXISTS `app` (
  `id_APP` int(11) NOT NULL AUTO_INCREMENT,
  `APP` varchar(50) NOT NULL,
  PRIMARY KEY (`id_APP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `id_cita` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_especialista` int(11) NOT NULL,
  `asistencia` tinyint(1) NOT NULL,
  `pago` decimal(20,0) NOT NULL,
  `paquete` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `especialidad` varchar(30) NOT NULL,
  `area` varchar(10) NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_cita`),
  KEY `id_paciente` (`id_paciente`),
  KEY `Id_especialista` (`id_especialista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_emergencia`
--

DROP TABLE IF EXISTS `contacto_emergencia`;
CREATE TABLE IF NOT EXISTS `contacto_emergencia` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `id_domicilio` int(11) NOT NULL,
  PRIMARY KEY (`id_contacto`),
  KEY `id_domicilio` (`id_domicilio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnostico_funcional`
--

DROP TABLE IF EXISTS `diagnostico_funcional`;
CREATE TABLE IF NOT EXISTS `diagnostico_funcional` (
  `id_diagnostico_funcional` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_diagnostico_funcional`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

DROP TABLE IF EXISTS `domicilio`;
CREATE TABLE IF NOT EXISTS `domicilio` (
  `id_domicilio` int(11) NOT NULL AUTO_INCREMENT,
  `calle` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `municipio` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  PRIMARY KEY (`id_domicilio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_antropometrica`
--

DROP TABLE IF EXISTS `evaluacion_antropometrica`;
CREATE TABLE IF NOT EXISTS `evaluacion_antropometrica` (
  `id_evaluacion_antropometrica` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `IMC` float NOT NULL,
  `peso` float NOT NULL,
  `porcentaje_magra` double NOT NULL,
  `porcentaje_grasa` double NOT NULL,
  `grasa_viceral` float NOT NULL,
  `edad_metabolica` int(11) NOT NULL,
  `porcentaje_agua` double NOT NULL,
  `porcentaje_oseo` double NOT NULL,
  PRIMARY KEY (`id_evaluacion_antropometrica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_dietetica`
--

DROP TABLE IF EXISTS `evaluacion_dietetica`;
CREATE TABLE IF NOT EXISTS `evaluacion_dietetica` (
  `id_evaluacion_dietetica` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `alimentos_preferidos` text NOT NULL,
  `alimentos_alergia` text NOT NULL,
  `alimentos_intolerancia` text NOT NULL,
  `num_comidas_diarias` int(11) NOT NULL,
  `horario_comida` varchar(15) NOT NULL,
  `peso_minimo_ultimo_año` float NOT NULL,
  `peso_maximo_ultimo_año` float NOT NULL,
  `peso_habitual` float NOT NULL,
  `consumo_suplementos_complementos_medicamentos` text NOT NULL,
  `id_evaluacion_antropometrica` int(11) NOT NULL,
  PRIMARY KEY (`id_evaluacion_dietetica`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_evaluacion_antropometrica` (`id_evaluacion_antropometrica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evolucion`
--

DROP TABLE IF EXISTS `evolucion`;
CREATE TABLE IF NOT EXISTS `evolucion` (
  `id_evolucion` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `fisioterapeuta` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_evolucion`),
  KEY `id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clinico_fisioterapia`
--

DROP TABLE IF EXISTS `historial_clinico_fisioterapia`;
CREATE TABLE IF NOT EXISTS `historial_clinico_fisioterapia` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `motivo_consulta` text NOT NULL,
  `antecedentes_heredofamiliares` text NOT NULL,
  `antecedentes_personales_patologicos` text NOT NULL,
  `tratamientos_afines_farmacologia` text NOT NULL,
  `conocimiento_entorno` text NOT NULL,
  `inspeccion_global` text NOT NULL,
  `id_inspeccion_local` int(11) NOT NULL,
  `problema_fisioterapeutico` varchar(30) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `id_diagnostico_funcional` int(11) NOT NULL,
  `id_padecimientos` int(11) NOT NULL,
  `exploracion_fisica` text NOT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `id_diagnostico_funcional` (`id_diagnostico_funcional`),
  KEY `id_diagnostico_funcional_2` (`id_diagnostico_funcional`),
  KEY `id_inspeccion_local` (`id_inspeccion_local`),
  KEY `id_inspeccion_local_2` (`id_inspeccion_local`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_programa` (`id_programa`),
  KEY `id_padecimientos` (`id_padecimientos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_clinico_general`
--

DROP TABLE IF EXISTS `historial_clinico_general`;
CREATE TABLE IF NOT EXISTS `historial_clinico_general` (
  `id_historial_general` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `motivo_consulta` text,
  `antecedentes_heredofamiliares` text,
  `tratamientos_afines` text,
  `antecedentes_personales_patologicos` text,
  `conocimiento_entorno` text,
  `inspeccion_global` text,
  `inspeccion_local` text,
  `problema_fisio` text,
  `programa_fisio` text,
  `diagnostico_funcional` text,
  `exploracion_fisica` text,
  `plan_intervencion` text,
  `pronostico` text,
  `hoja_evaluacion` text,
  `marked` int(1) DEFAULT '0',
  PRIMARY KEY (`id_historial_general`),
  KEY `id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspeccion_local`
--

DROP TABLE IF EXISTS `inspeccion_local`;
CREATE TABLE IF NOT EXISTS `inspeccion_local` (
  `id_inspeccion_local` int(11) NOT NULL AUTO_INCREMENT,
  `cara` int(11) DEFAULT NULL,
  `cervicales` int(11) DEFAULT NULL,
  `dorsales` int(11) DEFAULT NULL,
  `lumbares` int(11) DEFAULT NULL,
  `sacra` int(11) DEFAULT NULL,
  `Hemiparesia` int(11) DEFAULT NULL,
  `Cuadraparesia` int(11) DEFAULT NULL,
  `Hombro` int(11) DEFAULT NULL,
  `Codo` int(11) DEFAULT NULL,
  `Brazo` int(11) DEFAULT NULL,
  `Antebrazo` int(11) DEFAULT NULL,
  `Muñeca` int(11) DEFAULT NULL,
  `Dedos` int(11) DEFAULT NULL,
  `Abdomen` int(11) DEFAULT NULL,
  `Cadera` int(11) DEFAULT NULL,
  `Muslo` int(11) DEFAULT NULL,
  `Pierna` int(11) DEFAULT NULL,
  `Rodilla` int(11) DEFAULT NULL,
  `Pie` int(11) DEFAULT NULL,
  `Tobillo` int(11) DEFAULT NULL,
  `Ortejos` int(11) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_inspeccion_local`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE IF NOT EXISTS `paciente` (
  `id_paciente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `ap_paterno` varchar(30) NOT NULL,
  `ap_materno` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `ocupacion` varchar(30) NOT NULL,
  `estado_civil` varchar(30) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo_electronico` varchar(50) NOT NULL,
  `hipertension` tinyint(1) DEFAULT NULL,
  `id_especialista` int(11) NOT NULL,
  `id_domicilio` int(11) NOT NULL,
  `id_contacto` int(11) NOT NULL,
  `observaciones` text NOT NULL,
  `especialidad` varchar(20) NOT NULL,
  `area` varchar(10) NOT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `id_domcilio` (`id_domicilio`,`id_contacto`),
  KEY `id_contacto` (`id_contacto`),
  KEY `id_especialista` (`id_especialista`),
  KEY `id_especialista_2` (`id_especialista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padecimientos`
--

DROP TABLE IF EXISTS `padecimientos`;
CREATE TABLE IF NOT EXISTS `padecimientos` (
  `id_padecimientos` int(11) NOT NULL AUTO_INCREMENT,
  `APP1_CARDIOPATIAS` tinyint(1) DEFAULT NULL,
  `APP2_OSTEOPENIA` tinyint(1) DEFAULT NULL,
  `APP3_OSTEOPOROSIS` tinyint(1) DEFAULT NULL,
  `APP4_EPILEPSIA` tinyint(1) DEFAULT NULL,
  `APP5_DM` tinyint(1) DEFAULT NULL,
  `APP6_OBESIDAD` tinyint(1) DEFAULT NULL,
  `APP7_COL_TRIGLI` tinyint(1) DEFAULT NULL,
  `APP8_MIGRAÑA` tinyint(1) DEFAULT NULL,
  `APP9_SARAPEON` tinyint(1) DEFAULT NULL,
  `APP10_ALER_INALATORIA` tinyint(1) DEFAULT NULL,
  `APP11_ALER_ALIMENTARIA` tinyint(1) DEFAULT NULL,
  `APP12_ALER_CUTANEA` tinyint(1) DEFAULT NULL,
  `APP13_INTOL_FARMACOS` tinyint(1) DEFAULT NULL,
  `APP15_GAS` tinyint(1) DEFAULT NULL,
  `APP16_CXP` tinyint(1) DEFAULT NULL,
  `APP17_CXT` tinyint(1) DEFAULT NULL,
  `APP18_CXG` tinyint(1) DEFAULT NULL,
  `APP19_ASM` tinyint(1) DEFAULT NULL,
  `APP_20CX` tinyint(1) DEFAULT NULL,
  `APP_21PAR` tinyint(1) DEFAULT NULL,
  `APP_22FX` tinyint(1) DEFAULT NULL,
  `APP_23HIP` tinyint(1) DEFAULT NULL,
  `APP_24LUX` tinyint(1) DEFAULT NULL,
  `APP_25AU` tinyint(1) DEFAULT NULL,
  `APP_26ESCLE` tinyint(1) DEFAULT NULL,
  `APP_27RENALES` tinyint(1) DEFAULT NULL,
  `APP_28CA` tinyint(1) DEFAULT NULL,
  `APP_29TB` tinyint(1) DEFAULT NULL,
  `APP_30HEPA` tinyint(1) DEFAULT NULL,
  `APP_31EVC` tinyint(1) DEFAULT NULL,
  `APP_32SEP` tinyint(1) DEFAULT NULL,
  `APP_33ICT` tinyint(1) DEFAULT NULL,
  `APP_34Anemia` tinyint(1) DEFAULT NULL,
  `APP_35ART` tinyint(1) DEFAULT NULL,
  `APNP_TABAQ` tinyint(1) DEFAULT NULL,
  `APNP_ALCOHO` tinyint(1) DEFAULT NULL,
  `APNP_TOX` tinyint(1) DEFAULT NULL,
  `APNP_ALIME1` tinyint(1) DEFAULT NULL,
  `APNP_ALIM2` tinyint(1) DEFAULT NULL,
  `DOLOR` tinyint(1) DEFAULT NULL,
  `GONIOM` tinyint(1) DEFAULT NULL,
  `ESC_FZA` tinyint(1) DEFAULT NULL,
  `AHF_MCANCER` tinyint(1) DEFAULT NULL,
  `AHF_MCARDIO` tinyint(1) DEFAULT NULL,
  `AHF_MHTA` tinyint(1) DEFAULT NULL,
  `AHF_MDM` tinyint(1) DEFAULT NULL,
  `AHF_ARTM` tinyint(1) DEFAULT NULL,
  `AHF_PCANCER` tinyint(1) DEFAULT NULL,
  `AHF_PCARDIO` tinyint(1) DEFAULT NULL,
  `AHF_PHTA` tinyint(1) DEFAULT NULL,
  `AHF_PDM` tinyint(1) DEFAULT NULL,
  `AHF_ARTP` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_padecimientos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_tratamiento`
--

DROP TABLE IF EXISTS `plan_tratamiento`;
CREATE TABLE IF NOT EXISTS `plan_tratamiento` (
  `id_plan_tratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `descripcion` text NOT NULL,
  `total_sesiones` int(11) NOT NULL,
  `frecuencia_tratamiento` varchar(20) NOT NULL,
  `fecha_alta` date NOT NULL,
  PRIMARY KEY (`id_plan_tratamiento`),
  KEY `id_paciente` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

DROP TABLE IF EXISTS `programa`;
CREATE TABLE IF NOT EXISTS `programa` (
  `id_programa` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_corto` text NOT NULL,
  `objetivo_mediano` text NOT NULL,
  `objetivo_largo` text NOT NULL,
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorio_alimentos`
--

DROP TABLE IF EXISTS `recordatorio_alimentos`;
CREATE TABLE IF NOT EXISTS `recordatorio_alimentos` (
  `id_recordatorio` int(11) NOT NULL,
  `id_evaluacion_dietetica` int(11) NOT NULL,
  `comida` varchar(50) NOT NULL,
  `horario` varchar(50) NOT NULL,
  `alimento_consumido` varchar(50) NOT NULL,
  PRIMARY KEY (`id_recordatorio`,`id_evaluacion_dietetica`),
  KEY `id_recordatorio` (`id_recordatorio`),
  KEY `id_evaluacion_dietetica` (`id_evaluacion_dietetica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `signos_vitales`
--

DROP TABLE IF EXISTS `signos_vitales`;
CREATE TABLE IF NOT EXISTS `signos_vitales` (
  `id_signos_vitales` int(11) NOT NULL AUTO_INCREMENT,
  `frecuencia_cardiaca` varchar(30) NOT NULL,
  `tension_arterial` varchar(30) NOT NULL,
  `frecuencia_respiratoria` varchar(30) NOT NULL,
  `temperatura` varchar(30) NOT NULL,
  `peso` double NOT NULL,
  `estatura` double NOT NULL,
  `IMC` double NOT NULL,
  `id_cita` int(11) NOT NULL,
  PRIMARY KEY (`id_signos_vitales`),
  KEY `id_cita` (`id_cita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_sistema`
--

DROP TABLE IF EXISTS `usuarios_sistema`;
CREATE TABLE IF NOT EXISTS `usuarios_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `apellidos` varchar(64) NOT NULL,
  `contrasena` varchar(16) NOT NULL,
  `tipo_usuario` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Usuarios del Sistema' AUTO_INCREMENT=1000 ;

--
-- Volcado de datos para la tabla `usuarios_sistema`
--

INSERT INTO `usuarios_sistema` (`id`, `nombre`, `apellidos`, `contrasena`, `tipo_usuario`) VALUES
(999, 'administrador', 'administrador', 'Admin-999', 'ADMINISTRADOR');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
