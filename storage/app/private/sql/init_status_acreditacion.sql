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

-- Volcando datos para la tabla morrosroot_sportec_nucleo.status_acreditacion: ~10 rows (aproximadamente)
INSERT INTO `status_acreditacion` (`id`, `status_acreditacion`, `created_at`, `updated_at`) VALUES
	(1, 'Pre-Inscrito', '2025-05-19 14:22:57', '2025-05-19 14:29:22'),
	(2, 'Pre-Inscrito-No Confirmado', '2025-05-19 14:22:57', '2025-05-19 14:29:26'),
	(3, 'Pre-Inscrito-Confirmado', '2025-05-19 14:22:57', '2025-05-19 14:29:27'),
	(4, 'Inscrito-No Entregado', '2025-05-19 14:22:57', '2025-05-19 14:29:28'),
	(5, 'Inscrito-Entregada', '2025-05-19 14:22:57', '2025-05-19 14:29:28'),
	(6, 'Activada', '2025-05-19 14:22:57', '2025-05-19 14:29:29'),
	(7, 'Desactivada', '2025-05-19 14:22:57', '2025-05-19 14:29:30'),
	(8, 'Anulada', '2025-05-19 14:22:57', '2025-05-19 14:29:31'),
	(9, 'Inscrito-Bajo Reclamo', '2025-05-19 14:22:57', '2025-05-19 14:29:31'),
	(10, 'Entregada-Bajo Reclamo', '2025-05-19 14:22:57', '2025-05-19 14:29:32');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
