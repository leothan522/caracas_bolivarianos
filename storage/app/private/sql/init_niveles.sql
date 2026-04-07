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

-- Volcando datos para la tabla morrosroot_sportec_nucleo.niveles: ~0 rows (aproximadamente)
INSERT INTO `niveles` (`id`, `id_nivel`, `id_permiso`, `nivel`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'adm', 1, 'Administradores', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(2, 'sus', 2, 'Suspendido', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(3, 'pre', 3, 'Prensa', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(4, 'del', 4, 'Delegaciones', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(5, 'inf', 5, 'Informtica Subsedes', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(6, 'rep', 6, 'Reporte', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(7, 'fed', 7, 'Federaciones', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(8, 'dep', 8, 'Deportes', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(9, 'vol', 9, 'Voluntario', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(10, 'med', 9, 'Medallistas', 1, '2025-05-18 15:41:21', '2025-05-18 15:41:21'),
(11, 'tra', 11, 'Personal Transporte', 1, '2025-05-18 15:47:57', '2025-05-18 15:47:57');


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
