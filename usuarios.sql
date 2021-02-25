SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'Nicolás', 'Fracchia', 'admin@admin.com', '1162235848', '$2y$10$9T/jxfj3xLwXcRnrWROcUe3Wuy9euIf8EfWuMrwvPGWxb14xZz10O');