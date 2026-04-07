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

-- Volcando datos para la tabla morrosroot_sportec_nucleo.deportes: ~103 rows (aproximadamente)
INSERT INTO `deportes` (`id`, `tipo_deporte`, `codigod`, `deporte`, `en_uso`, `acronimo`, `ruta_logo`, `listo`, `federacion`, `presidente`, `url_federacion`, `email`, `direccion`, `telefono`, `fax`, `observaciones`, `url_ranking`, `clasificatorio`, `plan`, `rango_minimo`, `rango_maximo`, `secundario`, `sport`, `created_at`, `updated_at`) VALUES
	(1, 4, 'AGA', 'AGUAS ABIERTAS', 0, 'DPA', 'c_aga.jpg', 0, 'DPA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(2, 1, 'AJE', 'AJEDREZ', 0, 'AJE', 'c_aje.jpg', 0, 'AJE', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(3, 4, 'ATL', 'ATLETISMO', 0, 'ATL', 'c_atl.jpg', 0, 'ATL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 'ATHLETICS', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(4, 3, 'BAL', 'BALONCESTO', 0, 'BAL', 'c_bal.jpg', 0, 'BAL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(5, 3, 'BMO', 'BALONMANO', 0, 'BMO', 'c_bmo.jpg', 0, 'BMO', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(6, 3, 'BEI', 'BÉISBOL', 0, 'BEI', 'c_bei.jpg', 0, 'BEI', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(7, 4, 'BIC', 'BICICROSS', 0, 'FVC', 'c_bic.jpg', 0, 'FVC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(8, 1, 'BOC', 'BOLAS CRIOLLAS', 0, 'BOC', 'c_boc.jpg', 0, 'BOC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(9, 1, 'BOW', 'BOWLING', 0, 'BOW', 'c_bow.jpg', 0, 'BOW', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(10, 2, 'BOX', 'BOXEO', 0, 'BOX', 'c_box.jpg', 0, 'BOX', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(11, 4, 'CAN', 'CANOTAJE', 0, 'CAN', 'c_can.jpg', 0, 'CAN', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(12, 3, 'BAD', 'BÁDMINTON', 0, 'BAD', 'c_bad.jpg', 0, 'BAD', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(13, 4, 'MTB', 'MOUNTAIN BIKE', 0, 'FVC', 'c_mtb.jpg', 0, 'FVC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(14, 1, 'COL', 'COLEO', 0, 'COL', 'c_col.jpg', 0, 'COL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(15, 2, 'ESG', 'ESGRIMA', 0, 'ESG', 'c_esg.jpg', 0, 'ESG', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 'FENCING', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(16, 3, 'FUT', 'FÚTBOL', 0, 'FVF', 'c_fut.jpg', 0, 'FVF', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(17, 3, 'FUS', 'FÚTBOL SALA', 0, 'FVF', 'c_fus.jpg', 0, 'FVF', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(18, 1, 'BIL', 'BILLAR', 0, 'BIL', 'c_bil.jpg', 0, 'BIL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(19, 1, 'GIA', 'GIMNASIA AERÓBICA DEPORTIVA', 0, 'FVG', 'c_gia.jpg', 0, 'FVG', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(20, 1, 'GAR', 'GIMNASIA ARTÍSTICA', 0, 'FVG', 'c_gar.jpg', 0, 'FVG', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 54, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(21, 1, 'GIR', 'GIMNASIA RÍTMICA', 0, 'FVG', 'c_gir.jpg', 0, 'FVG', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(22, 2, 'HAP', 'HAPKIDO Y SISCOMADA', 0, 'HAP', 'c_hap.jpg', 0, 'HAP', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(23, 2, 'JUD', 'JUDO', 0, 'JUD', 'c_jud.jpg', 0, 'JUD', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(24, 2, 'KDO', 'KARATE DO', 0, 'KDO', 'c_kdo.jpg', 0, 'KDO', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(25, 4, 'KAR', 'KARTING', 0, 'KAR', 'c_kar.jpg', 0, 'KAR', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(26, 2, 'KEN', 'KENPO', 0, 'KEN', 'c_ken.jpg', 0, 'KEN', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(27, 4, 'LDP', 'LEVANTAMIENTO DE PESAS', 0, 'LDP', 'c_ldp.jpg', 0, 'LDP', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(28, 2, 'LUC', 'LUCHA', 0, 'LUC', 'c_luc.jpg', 0, 'LUC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(29, 1, 'ECU', 'ECUESTRE', 0, 'ECU', 'c_ecu.jpg', 0, 'ECU', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(30, 4, 'NAS', 'NADO SINCRONIZADO', 0, 'DPA', 'c_nas.jpg', 0, 'DPA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(31, 4, 'NAT', 'NATACIÓN', 0, 'DPA', 'c_nat.jpg', 0, 'DPA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 'SWIMMING', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(32, 4, 'PAT', 'PATINAJE', 0, 'PAT', 'c_pat.jpg', 0, 'PAT', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(33, 3, 'PVA', 'PELOTA VASCA', 0, 'PVA', 'c_pva.jpg', 0, 'PVA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(34, 4, 'POA', 'POLO ACUÁTICO', 0, 'DPA', 'c_poa.jpg', 0, 'DPA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(35, 4, 'POT', 'POTENCIA', 0, 'POT', 'c_pot.jpg', 0, 'POT', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(36, 3, 'RAC', 'RACQUETBOL', 0, 'RAC', 'c_rac.jpg', 0, 'RAC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(37, 4, 'REM', 'REMO', 0, 'REM', 'c_rem.jpg', 0, 'REM', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(38, 4, 'SAO', 'SALTOS ORNAMENTALES', 0, 'DPA', 'c_sao.jpg', 0, 'DPA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(39, 2, 'SAM', 'SAMBO', 0, 'SAM', 'c_sam.jpg', 0, 'SAM', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(40, 3, 'SOF', 'SOFTBOL', 0, 'SOF', 'c_sof.jpg', 0, 'SOF', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(41, 2, 'TKD', 'TAE KWON DO', 0, 'TKD', 'c_tkd.jpg', 0, 'TKD', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(42, 3, 'TEN', 'TENIS DE CAMPO', 0, 'TEN', 'c_ten.jpg', 0, 'TEN', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(43, 3, 'TDM', 'TENIS DE MESA', 0, 'TDM', 'c_tdm.jpg', 0, 'TDM', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(44, 1, 'TCA', 'TIRO CON ARCO', 0, 'TCA', 'c_tca.jpg', 0, 'TCA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(45, 1, 'TIR', 'TIRO DEPORTIVO', 0, 'TIR', 'c_tir.jpg', 0, 'TIR', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(46, 4, 'TRI', 'TRIATLÓN', 0, 'TRI', 'c_tri.jpg', 0, 'TRI', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(47, 1, 'VEL', 'VELA', 0, 'VEL', 'c_vel.jpg', 0, 'VEL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(48, 3, 'VOL', 'VOLEIBOL CANCHA', 0, 'FVV', 'c_vol.jpg', 0, 'FVV', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 'VOLLEYBALL', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(49, 3, 'VOP', 'VOLEIBOL PLAYA', 0, 'FVV', 'c_vop.jpg', 0, 'FVV', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(50, 2, 'WUS', 'WUSHU', 0, 'WUS', 'c_wus.jpg', 0, 'WUS', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(51, 4, 'CIR', 'CICLISMO RUTA', 0, 'FVC', 'c_cir.jpg', 0, 'FVC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 52, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(52, 4, 'CIP', 'CICLISMO PISTA', 0, 'FVC', 'c_cip.jpg', 0, 'FVC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 51, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(53, 3, 'KIC', 'KICKIMBOL', 0, 'KIC', 'c_kic.jpg', 0, 'KIC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(54, 1, 'GTR', 'GIMNASIA TRAMPOLÍN', 0, 'FVG', 'c_gtr.jpg', 0, 'FVG', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 24, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(55, 3, 'HSC', 'HOCKEY SOBRE CÉSPED', 0, 'HSC', 'c_hsc.jpg', 0, 'HSC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(56, 4, 'PEN', 'PENTATLÓN MODERNO', 0, 'PEN', 'c_pen.jpg', 0, 'PEN', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(57, 3, 'FSA', 'FÚTBOL DE SALÓN', 0, 'FSA', 'c_fsa.jpg', 0, 'FSA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(58, 3, 'SQH', 'SQUASH', 0, 'SQH', 'c_sqh.jpg', 0, 'SQH', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(59, 1, 'PAR', 'PATINAJE ARTÍSTICO', 0, 'PAT', 'c_par.jpg', 0, 'PAT', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(60, 4, 'ESQ', 'ESQUÍ NAUTÍCO', 0, 'ESQ', 'c_esq.jpg', 0, 'ESQ', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(61, 3, 'RUG', 'RUGBY', 0, 'RUG', 'c_rug.jpg', 0, 'RUG', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(62, 3, 'FUP', 'FÚTBOL PLAYA', 0, 'FVF', 'c_fup.jpg', 0, 'FVF', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(63, 0, 'DPC', 'POLIDEPORTIVA PARA PERSONAS CON PARALISIS CEREBRAL', 0, 'DPC', 'c_dpc.jpg', 0, 'DPC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(64, 0, 'DSR', 'DEPORTE SOBRE SILLA DE RUEDAS', 0, 'DSR', 'c_dsr.jpg', 0, 'DSR', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(65, 0, 'PLC', 'POLIDEPORTIVA DE CIEGOS', 0, 'PLC', 'c_plc.jpg', 0, 'PLC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(66, 0, 'PLS', 'POLIDEPORTIVA DE SORDOS', 0, 'PLS', 'c_pls.jpg', 0, 'PLS', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(67, 0, 'PDI', 'POLIDEPORTIVA DE DISCAPACIDAD INTELECTUAL', 0, 'PDI', 'c_pdi.jpg', 0, 'PDI', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(68, 1, 'GOL', 'GOLF', 0, 'GOL', 'c_gol.jpg', 0, 'GOL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(69, 4, 'ASA', 'ACTIVIDADES SUB-ACUÁTICAS', 0, 'ASA', 'c_asa.jpg', 0, 'ASA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(70, 1, 'BRI', 'BRIDGE', 0, 'BRI', 'c_bri.jpg', 0, 'BRI', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(71, 4, 'CAZ', 'CAZADORES DEPORTIVOS', 0, 'CAZ', 'c_caz.jpg', 0, 'CAZ', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(72, 1, 'DOM', 'DOMINO', 1, 'DOM', 'c_dom.jpg', 0, 'DOM', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(73, 1, 'ESC', 'ESCALADA', 0, 'ESC', 'c_esc.jpg', 0, 'ESC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(74, 1, 'FIS', 'FISICOCULTURISMO', 0, 'FIS', 'c_fis.jpg', 0, 'FIS', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(75, 2, 'KIB', 'KICK BOXING', 0, 'KIB', 'c_kib.jpg', 0, 'KIB', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(76, 1, 'MOT', 'MOTOCOCLISMO', 0, 'MOT', 'c_mot.jpg', 0, 'MOT', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(77, 1, 'SUR', 'SURFING', 0, 'SUR', 'c_sur.jpg', 0, 'SUR', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(78, 4, 'AUT', 'AUTOMOVILISMO', 0, 'AUT', 'c_aut.jpg', 0, 'AUT', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(79, 0, 'FDF', 'FEDOFA', 0, 'ZZZ', 'c_fdf.jpg', 0, 'ZZZ', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(80, 1, 'BOH', 'BOCHAS', 0, 'BOH', 'c_boh.jpg', 0, 'BOH', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(81, 3, 'FU7', 'FÚTBOL 7', 0, 'FU7', 'c_fu7.jpg', 0, 'FU7', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(82, 3, 'GOB', 'GOAL BALL', 0, 'GOB', 'c_gob.jpg', 0, 'GOB', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(86, 3, 'BMP', 'BALONMANO PLAYA', 0, 'BMO', ' ', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(87, 3, 'RUP', 'RUGBY PLAYA', 0, 'RUG', ' ', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(96, 4, 'DPA', 'DEPORTES ACUÁTICOS', 0, 'DPA', 'c_dpa.jpg', 0, 'DPA', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(97, 4, 'CPR', 'CICLISMO PISTA - RUTA', 0, 'FVC', 'c_cpr.jpg', 0, 'FVC', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(98, 0, 'ZZZ', 'FALTA SELECCIONAR DEPORTE Y MODALIDAD', 1, 'ZZZ', 'c_zzz.jpg', 0, 'ZZZ', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(99, 0, 'ZZX', 'EVENTOS MULTIPLES', 0, 'ZZZ', 'c_zzx.jpg', 0, 'ZZZ', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(100, 3, 'BAS', 'BALONCESTO SOBRE SILLA DE RUEDAS', 0, 'BAL', 'c_bas.jpg', 0, 'BAL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(101, 3, 'BDI', 'BALONCESTO DISCAPACIDAD INTELECTUAL', 0, 'BAL', 'c_bdi.jpg', 0, 'BAL', ' ', NULL, ' ', ' ', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(105, 3, 'TEP', 'TENIS PLAYA', 0, 'TEN', '   ', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(106, 3, 'RU7', 'RUGBY 7', 0, 'RU7', ' ', 0, 'RUG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(116, 1, 'ORI', 'ORIENTACION', 0, 'ORI', ' ', 0, 'ZZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 'ORIENTEERING ', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(142, 1, 'PEM', 'PENTATLÓN MILITAR', 0, 'PEM', ' ', 0, 'ZZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 'MILITARY PENTATHLON', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(143, 1, 'TCF', 'TIRO (PISTOLA Y FUSIL)', 0, 'TCF', ' ', 0, 'ZZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 'SHOOTING', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(147, 3, 'BA3', 'BALONCESTO  3X3', 1, '', NULL, 0, 'FVB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(151, 3, 'PAD', 'PADEL', 1, 'PAD', 'c_pad.jpg', 0, 'ZZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 'PADEL', '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(152, 3, 'SCO', 'SCOPONE', 1, 'SCO', 'c_pad.jpg', 0, 'ZZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(153, 3, 'BTE', 'BOCCETTE', 1, 'BTE', 'c_pad.jpg', 0, 'ZZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27'),
	(154, 4, 'C1K', 'CARRERA 10K', 1, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(155, 1, 'POI', 'POOL ITALIANO', 1, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2025-11-11 01:36:43', '2025-11-11 01:36:43'),
	(156, 3, 'PCK', 'PICKLEBALL', 1, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2025-11-11 01:36:43', '2025-11-11 01:36:43'),
	(999, 0, 'ZZY', 'SIN DEFINIR', 0, 'ZZY', ' ', 0, 'ZZZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, '2025-05-20 01:46:37', '2025-05-19 22:49:27');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
