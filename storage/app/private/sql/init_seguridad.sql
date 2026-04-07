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

-- Volcando datos para la tabla morrosroot_sportec_nucleo.seguridad: ~0 rows (aproximadamente)
INSERT INTO `seguridad` (`id`, `cod_seguridad`, `color_seguridad`, `permisos`, `nombre_seguridad`, `color_cmyk`, `color_rgb`, `color_letra`, `created_at`, `updated_at`) VALUES
(8, 'COD', '#000000', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,', 'Todas las Areas (tricolor)', 'tricolor', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(9, 'COD', '#FFFF33', '1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,', 'Todas las Areas Excepto Anti-Doping (con Autorizacin)', '6,0,88,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(10, 'COD', '#FFCC00', '1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,', 'Todas las Areas Excepto Anti-Doping (Para COC)', '1,19,100,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(11, 'COD', '#637BF9', '1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,', 'Todas las Areas Excepto Anti-Doping (Para Entes)', '3,0,49,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(12, 'COD', '#0fb02a', '1,2,4,5,6,7,8,9,10,11,12,13,15,27,29,', 'Delegaciones Deportivas', '70,0,100,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(13, 'COD', '#637BF9', '1,2,4,5,6,7,8,9,10,11,12,13,15,19,26,27,29,', 'Delegados', '88,34,100,29', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(14, 'COD', '#6600CC', '2,3,4,5,7,9,10,11,12,15,16,17,19,26,27,', 'Jueces y Arbitros', '28,69,0,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(15, 'COD', '#FF0000', '1,2,4,5,7,8,9,10,11,13,27,29,', 'Personal de Apoyo Complementario Delegaciones', '37,0,59,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(16, 'COD', '#993399', '1,2,3,4,5,6,7,8,9,10,11,12,13,15,17,19,20,21,26,27,29,', 'Delegados Operacionales y de apoyo Federaciones', '11,43,0,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(17, 'COD', '#FF6600', '2,3,4,5,7,9,10,11,13,15,19,20,21,25,26,27,28,29,', 'Prensa', '0,74,100,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(18, 'COD', '#8A0752', '2,4,5,8,9,10,11,15,16,17,18,19,20,21,25,26,27,28,29,', 'Protocolo y Turismo', '75,87,0,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(19, 'COD', '#66FFFF', '1,2,4,8,9,10,11,16,17,18,19,20,21,24,29,', 'Personal Administrativo', '43,0,10,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(20, 'COD', '#FF0000', '2,10,11,14,16,17,19,29,', 'Personal Anti-Doping', '0,99,100,0', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(21, 'COD', '#FFFFFF', '1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,', 'Logistica Y Personal Obrero', '20,40,96,2', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(22, 'COD', '#999999', '1,2,4,9,10,11,17,18,19,27,29,', 'Voluntarios', '43,35,35,1', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(23, 'COD', '#660000', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,', 'Todas las Areas (Seguridad)', '', NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04'),
(24, 'COD', '#000099', '2,3,4,5,7,9,10,11,19,20,21,22,24,27,', 'Transcriptores (Informatica)', NULL, NULL, NULL, '2025-05-18 16:05:04', '2025-05-18 16:05:04');




/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
