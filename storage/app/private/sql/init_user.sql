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

-- Volcando datos para la tabla morrosroot_sportec_nucleo.users: ~33 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `id_entidad`, `id_nivel`, `activo`, `visitas`, `descripcion`, `telefono`, `is_admin`, `is_root`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(0, 'Comité Organizador', 'carloswcastillo@gmail.com', '2025-05-19 13:39:18', '$2y$12$3Q0RV3Qy/yH.N28.6P/pA.Cy2GkJBN0fTXaQ9N5HGWrG7R80BOouy', NULL, NULL, NULL, 'sGSWiCYm2H5R5bOv1MnERN6in1j1djQRVEoFsSIAhzNa5xRtwkU9r8nhSOLs', NULL, NULL, 0, 1, 1, 2, 'Comité Organizador', '04129625446', 1, 0, '2025-05-18 17:23:17', '2025-11-22 01:57:42', NULL),
	(1, 'CLUB SOCIAL ITALO VENEZOLANO ACARIGUA', 'ciced@hotmail.com', '2025-11-17 21:32:26', '$2y$12$nII4KIc4vz4a5PCjc9DJDOkv.dviONMD7RUboxPtVZv9WL9LBYyf6', NULL, NULL, NULL, 'EuZkBVhAqz9MwutqAIEOzdJE9KRKbT7Ks1vvWLJtDkQxuv3C9TNlhjkThIcA', NULL, NULL, 1, 4, 1, 4, 'Acarigua', NULL, 1, 0, '2025-05-18 17:23:17', '2025-11-22 01:58:16', NULL),
	(2, 'CENTRO ITALO VENEZOLANO DE ORIENTE EN BARCELONA', 'aldoojedag@hotmail.com', NULL, '$2y$12$aZ6EZHpYmVq7HgJbKR2QfedBIpRM2aSBUUsOoOOXCnxxhC6hRBAp.', NULL, NULL, NULL, NULL, NULL, NULL, 2, 4, 1, 0, 'Barcelona', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:48:56', NULL),
	(3, 'CLUB ITALO VENEZOLANO DE BARINAS', 'sainsrl@gmail.com', NULL, '$2y$12$L50vL4vnQ7G/DvjZFXO6kuBDVbCKPS9kQoZ6qIe8UtCjKBcsSEc3a', NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, 1, 0, 'Barinas', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:50:24', NULL),
	(4, 'ASOCIACION FRATERNA ITALO VENEZOLANO DEL ESTADO LARA (AFIVEL)', 'giangrecofrank@gmail.com', NULL, '$2y$12$OZFewhn7zzyKHGXpcRBfAujBJaKkf8Lbupgk6Eyvns0c6FEfIuI9K', NULL, NULL, NULL, NULL, NULL, NULL, 4, 4, 1, 0, 'Barquisimeto', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:50:43', NULL),
	(5, 'CLUB ITALO DE CABIMAS', 'nailynethborjas@gmail.com', NULL, '$2y$12$zC93rLAeqZI/BfLkZbfr.ulxqUCxry6bWYpy.tne/SmqX2NC.pQLi', NULL, NULL, NULL, NULL, NULL, NULL, 5, 4, 1, 0, 'Cabimas', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:52:28', NULL),
	(6, 'CENTRO ITALO VENEZOLANO AGUSTIN CODAZZI CAGUA', 'civ6@gmail.com', NULL, '$2y$12$0sf//LUD0xyiPHxQ290/vO0LwEpQl3CdFQK66Babpe/RAKZcyhx6a', NULL, NULL, NULL, NULL, NULL, NULL, 6, 4, 1, 0, 'Cagua', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:52:49', NULL),
	(7, 'CLUB SOCIAL ITALIANO DE CALABOZO', 'agropecuariaveneagro@gmail.com', NULL, '$2y$12$VJgE6ka0Z0WU59aGl8eeEe7ce6J/tJ.5PBcg0ohDtesv/Frsp9shy', NULL, NULL, NULL, NULL, NULL, NULL, 7, 4, 1, 0, 'Calabozo', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:53:27', NULL),
	(8, 'CASA D\'ITALIA CIUDAD BOLIVAR', 'civ8@gmail.com', NULL, '$2y$12$ClU7HaXjjftUtoKQPmYGVeukRyUEMgkXoJqAR0FqXd0UIRC4o9Dxq', NULL, NULL, NULL, NULL, NULL, NULL, 8, 4, 1, 0, 'Ciudad Bolívar', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:53:49', NULL),
	(9, 'CENTRO ITALIANO VENEZOLANO DE CARACAS', 'fafax@icloud.com', NULL, '$2y$12$8diFuR5YmOSn/x3PVCc1XOP2uwdSbfS3Lyar9mrTInisNk0P1SW.e', NULL, NULL, NULL, NULL, NULL, NULL, 9, 4, 1, 0, 'Caracas', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:54:15', NULL),
	(10, 'CENTRO ITALO VENEZOLANO DE CORO', 'csivcoro@gmail.com', NULL, '$2y$12$AtvB.jszV5X42KR.SbA9G..bpWTV81fQuDS8.psA5DTm1Uy1SX3Ya', NULL, NULL, NULL, NULL, NULL, NULL, 10, 4, 1, 0, 'Coro', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:56:16', NULL),
	(11, 'CENTRO ITALO VENEZOLANO DE CARUPANO', 'ferretodocarupano@gmail.com', NULL, '$2y$12$MkpM99p0HAzXWovLpthF7ec0i3TKygnYaNncUvh4LIpfN0QL8lBWO', NULL, NULL, NULL, NULL, NULL, NULL, 11, 4, 1, 0, 'Carúpano', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:56:45', NULL),
	(12, 'CENTRO ITALO VENEZOLANO EL TIGRE', 'civ28@gmail.com', NULL, '$2y$12$XZlsDIRr6oNTI6MjY58zOOpIK0WSlXnPqprHxanjwVSff0cad.Byi', NULL, NULL, NULL, NULL, NULL, NULL, 12, 4, 1, 0, 'El Tigre', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 13:57:07', NULL),
	(13, 'CENTRO SOCIAL ITALO VENEZOLANO DE GUANARE', 'camando130986@gmail.com', NULL, '$2y$12$nGMcD4vwQhe8H795uvV6uedeo/TbuSxF5ZaQNySb46RjGmtWjNat6', NULL, NULL, NULL, NULL, NULL, NULL, 13, 4, 1, 0, 'Guanare', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:07:46', NULL),
	(14, 'CASA D\'ITALIA DE LOS TEQUES', 'guerraf@yahoo.com', NULL, '$2y$12$WdTsRYd9RIV/azD0lIhZC..T0wyZ2a8twGrAiY0WebMdbDqO81912', NULL, NULL, NULL, NULL, NULL, NULL, 14, 4, 1, 0, 'Los Teques', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:10:33', NULL),
	(15, 'CASA D\'ITALIA DE MARACAIBO', 'lucianocamporota@gmail.com', NULL, '$2y$12$b5xdMZQ3.kaFdJ66uQ1ggOA2uapqxDMR2J6uTdKR5IlwC7PHdgZqu', NULL, NULL, NULL, NULL, NULL, NULL, 15, 4, 1, 0, 'Maracaibo', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:10:53', NULL),
	(16, 'CASA DE ITALIA DE MARACAY', 'italo.110@hotmail.com', NULL, '$2y$12$k4WiEppAeWSLEya7KUlnEuZlwb619arkgkIcnqKo2DNQuV/mh7hw2', NULL, NULL, NULL, NULL, NULL, NULL, 16, 4, 1, 0, 'Maracay', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:11:10', NULL),
	(17, 'CENTRO SOCIAL ITALO VENEZOLANO DE MÉRIDA', 'spatarojose@hotmail.com', NULL, '$2y$12$80V7k4unyN56HmRbDmLKvOW.XTFxJfB/UDJ7gTHACLjy9hLgn4wVW', NULL, NULL, NULL, NULL, NULL, NULL, 17, 4, 1, 0, 'Mérida', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:11:35', NULL),
	(18, 'CENTRO ITALO VENEZOLANO DE MARGARITA', 'civ23@gmail.com', NULL, '$2y$12$HYvHXf5kiXkylfgyy9Hu1O15/ikMzcoTfx0UjLOULR6i67GlwUT8S', NULL, NULL, NULL, NULL, NULL, NULL, 18, 4, 1, 0, 'Margarita', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:12:44', NULL),
	(19, 'CENTRO ITALO VENEZOLANO DE CIUDAD GUAYANA EN PUERTO ORDAZ', 'mf.sperez@qmail.com', NULL, '$2y$12$yIgjKUObA7LzRWLevgM1HO7QU42V1pg7KNlTf6TO4n2BqQ01x7Cfi', NULL, NULL, NULL, NULL, NULL, NULL, 19, 4, 1, 0, 'Puerto Ordaz', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:13:02', NULL),
	(20, 'CENTRO SOCIAL ITALO VENEZOLANO DE PUERTO CABELLO', 'edoardoescalona@gmail.com', NULL, '$2y$12$LXqxYUF9nXJ0d8LgrY8KnOPQ6FGJiL.GPTuxkovoMccdE2lRNRL.y', NULL, NULL, NULL, NULL, NULL, NULL, 20, 4, 1, 0, 'Puerto Cabello', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:13:25', NULL),
	(21, 'CENTRO ITALO VENEZOLANO DEL TACHIRA', 'grecoaso@gmail.com', NULL, '$2y$12$s30xXfJZj0lkS/2U7wW6Oue1XpZasCf3LAx1j1G2nUSug8v6cNDbS', NULL, NULL, NULL, NULL, NULL, NULL, 21, 4, 1, 0, 'Táchira', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:13:43', NULL),
	(22, 'CASA D\'ITALIA DE PARAGUANA EN PUNTO FIJO', 'josebuenoamaris@gmail.com', NULL, '$2y$12$eDa0CU0yk2QzUxLQcIYP8uYLeGaBQLUn8y1XYQO/iV2eEg0CRMktK', NULL, NULL, NULL, NULL, NULL, NULL, 22, 4, 1, 0, 'Punto Fijo', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:14:00', NULL),
	(23, 'CLUB CAMPESTRE ITALO VENEZOLANO DE SAN FERNANDO DE APURE', 'azuajetedeschi@gmail.com', NULL, '$2y$12$8TsUl88kI4Yt.k2wWKqKXOg/SEQfA0xEVhbjnY/5jQX/4LPWO3XWG', NULL, NULL, NULL, NULL, NULL, NULL, 23, 4, 1, 0, 'San Fernando', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:14:27', NULL),
	(24, 'CENTRO ITALO VENEZOLANO SAN JUAN DE LOS MORROS', 'verlayneg@gmail.com', NULL, '$2y$12$7qGjUckWwqgIlnE9xwfpgOjgGPVIe5ElUvp1XtzWSpFJj044pd8Qa', NULL, NULL, NULL, NULL, NULL, NULL, 24, 4, 1, 0, 'San Juan de los Morros', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:14:44', NULL),
	(25, 'CENTRO SOCIAL ITALO VENEZOLANO DE SAN FELIPE', 'aguayurubi2@gmail.com', NULL, '$2y$12$x0GQXLizit6pkPQu210lfO.vPJoGLnKTjBN/HbNcCuJWWC.C7fdQS', NULL, NULL, NULL, NULL, NULL, NULL, 25, 4, 1, 0, 'San Felipe', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:15:20', NULL),
	(26, 'CENTRO SOCAL ITALO VENEZOLANO DE VALENCIA', 'bact23@gmail.com', NULL, '$2y$12$yc.nAwXOnUiUHPVHd0eMOOZGPIJ6KVePig1fqac0H7KsPnZ8..3RW', NULL, NULL, NULL, NULL, NULL, NULL, 26, 4, 1, 0, 'Valencia', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:15:39', NULL),
	(27, 'CENTRO ITALO VENEZOLANO DE VALLE DE LA PASCUA', 'massimosacchetti85@gmail.com', NULL, '$2y$12$TyO1er7VtmH5Wl8MAGKbhO9EM8uVwcaPS78l3hc4VuvLlw5HIJ7Qa', NULL, NULL, NULL, NULL, NULL, NULL, 27, 4, 1, 0, 'Valle de la Pascua', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:16:01', NULL),
	(28, 'CLUB DEPORTIVO ITALVEN VALERA', 'mandatoantonio@gmail.com', NULL, '$2y$12$mxLf1W7uo2bQpa/aFt82ZenymW6NJUDCbn.C0qaMHDS15fAxlZ0Si', NULL, NULL, NULL, NULL, NULL, NULL, 28, 4, 1, 0, 'Valera', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:16:29', NULL),
	(29, 'CENTRO ITALO VENEZOLANO CIUDAD OJEDA', 'civ19@gmail.com', NULL, '$2y$12$fRe4NOja/KMZuQ1nqO3EW.QJxRrCy1yKEENZxXD3BafrguuK73.2S', NULL, NULL, NULL, NULL, NULL, NULL, 29, 4, 1, 0, 'Ciudad Ojeda', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:16:56', NULL),
	(30, 'CLUB ITALO VENEZOLANO UPATA', 'civ17@gmail.com', NULL, '$2y$12$vG9hE8LCJz7IyDOmQR/mkOH.rQrcQZSOBWEodtFh1Jhw8VEQU8nFy', NULL, NULL, NULL, NULL, NULL, NULL, 30, 4, 1, 0, 'Upata', NULL, 1, 0, '2025-05-18 17:23:17', '2025-05-19 14:17:17', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
