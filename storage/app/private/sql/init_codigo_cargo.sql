-- --------------------------------------------------------
-- Host:                         92.205.26.108
-- Versión del servidor:         11.4.5-MariaDB-ubu2404 - mariadb.org binary distribution
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando datos para la tabla morrosroot_sportec_nucleo.codigo_cargo: ~37 rows (aproximadamente)
INSERT INTO `codigo_cargo` (`id`, `cod_cargo`, `descripcion_cargo`, `logo`, `created_at`, `updated_at`) VALUES
	(1, '1', 'Presidente de la República', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(2, 'A', 'Ejecutivo Nacional', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(3, 'B', 'Federativos/Comisión Técnica/Plana IND', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(4, 'C', 'Plana Mayor Regional', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(5, 'D', 'Atletas', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(6, 'F', 'Entrenadores/Personal Médico y Técnico de las delegaciones', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(7, 'G', 'Delegados y técnicos de especialidad, personal de apoyo deportivo', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(8, 'G0', 'Personal de Apoyo Complementario', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(9, 'Gi', 'Invitados Deportivos', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(10, 'H', 'Prensa', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(11, 'Ha', 'Personal de Apoyo a medios de Comunicación', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(12, 'Hc', 'Prensa Comunitaria', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(13, 'Hg', 'Fotógrafos y Prensa Gráfica', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(14, 'HL', 'Locutores', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(15, 'Hm', 'Prensa en Medios Audiovisuales', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(16, 'Hp', 'Prensa en Medios Escritos', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(17, 'I', 'Informática General', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(18, 'Ia', 'Asistentes Informática', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(19, 'Ic', 'Informática : Transcriptores', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(20, 'Ij', 'Jefatura Técnica Informática', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(21, 'It', 'Personal Técnico Informática', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(22, 'J', 'Jueces y Árbitros', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(23, 'L', 'Logística y Transporte', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(24, 'N', 'Delegados Operacionales', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(25, 'O', 'Comité Organizador Comité Ejecutivo Central', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(26, 'Oa', 'Personal Administrativo del Comité', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(27, 'Oe', 'Personal Adjunto Sub-Comité', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(28, 'Oi', 'Personal adjunto al Comité Organizador nivel Central y Estadal', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(29, 'Oo', 'Personal auxiliar Comité Organizador', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(30, 'P', 'Personal Médico', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(31, 'Q', 'Anti-Doping', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(32, 'R', 'Personal de la Cruz Roja', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(33, 'S', 'Seguridad y Vigilancia', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(34, 'T', 'Turismo y Recreación', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(35, 'U', 'Personal Obrero y de mantenimiento', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(36, 'V', 'Voluntariado General', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22'),
	(37, 'X', 'Personal de Servicios Generales y Administrativos', NULL, '2025-05-20 20:24:22', '2025-05-20 20:24:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
