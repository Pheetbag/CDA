<?php

//Este archivo se ejecuta cada vez que se intenta entrar al sistema, para comprobar la existencia de la base de datos y así mantener la integridad del sistema, en caso de que no exista la base de datos podrá ser creada automaticamente gracias al manejador de PDOException incluido en la libreria "conexion".

//Crea una conexión a la base de datos para forzar una PDOException en caso de algún problema.
function estado_db(){

    require_once('libs/conexion.php');
	$conexion = new conexion;

	$sql = "SELECT id,usuario FROM `usuarios` WHERE usuario = 'administrador' AND clave = ''";
	$sql_values = null;

	$consulta = $conexion->get_consulta($sql, $sql_values);
}

//Esta función es activada por el manejador de PDOExceptions integrado, al detectar que la base de datos no existe.
function crear_db(){

	//Este sistema usa Mysqli debido a que PDO necesita por obligación que una base de datos sea indicada.
	$conexion = new mysqli(DB_HOSTNAME, DB_USUARIO, DB_CONTRA);

	//Creamos la base de datos
	$resultado = $conexion->multi_query('
	SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
	SET AUTOCOMMIT = 0;
	START TRANSACTION;
	SET time_zone = "+00:00";
	CREATE DATABASE IF NOT EXISTS `cda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
	');

	$conexion->close();
}

function crear_tablas(){

	require_once 'libs/conexion.php';
	$conexion = new conexion;

	//Creamos las tablas

	$sql_values = null;
	$sql = "

	SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
	SET AUTOCOMMIT = 0;
	START TRANSACTION;
	SET time_zone = '+00:00';
	ALTER DATABASE `cda` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
	USE `cda`;

	DROP TABLE IF EXISTS `usuarios`;
	CREATE TABLE IF NOT EXISTS `usuarios` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `usuario` varchar(25) NOT NULL,
	  `clave` varchar(16) NOT NULL,
	  `rango` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=INNODB  DEFAULT CHARSET=utf8mb4;


	DROP TABLE IF EXISTS `clientes`;
	CREATE TABLE IF NOT EXISTS `clientes` (
	  `nombre_cliente` varchar(20) NOT NULL,
	  `apellido_cliente` varchar(20) NOT NULL,
	  `ci_cliente` varchar(12) NOT NULL,
	  `direccion_cliente` varchar(100) NOT NULL,
	  `telefono` varchar(15) NOT NULL,
	  PRIMARY KEY (`ci_cliente`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `detalles_facturacion`;
	CREATE TABLE IF NOT EXISTS `detalles_facturacion` (
	  `codigo_factura` int(11),
	  `codigo_producto` int(11),
	  `cantidad` int(11) NOT NULL,
	  `subtotal` decimal(15,2) NOT NULL,
	  KEY `codigo_producto` (`codigo_producto`),
	  KEY `codigo_factura` (`codigo_factura`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `detalles_pedido`;
	CREATE TABLE IF NOT EXISTS `detalles_pedido` (
	  `codigo_pedido` int(11),
	  `codigo_producto` int(11),
	  `precio_compra` decimal(15,2) NOT NULL,
	  `cantidad` int(11) NOT NULL,
	  `subtotal` decimal(15,2) NOT NULL,
	  KEY `codigo_producto` (`codigo_producto`),
	  KEY `codigo_pedido` (`codigo_pedido`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `facturacion`;
	CREATE TABLE IF NOT EXISTS `facturacion` (
	  `codigo_factura` int(11) NOT NULL AUTO_INCREMENT,
	  `fecha_venta` date NOT NULL,
	  `ci_cliente` varchar(12),
	  `subtotal` decimal(15,2) NOT NULL,
	  `iva` decimal(15,2) NOT NULL,
	  `total` decimal(15,2) NOT NULL,
	  PRIMARY KEY (`codigo_factura`),
	  KEY `ci_cliente` (`ci_cliente`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `pedidos`;
	CREATE TABLE IF NOT EXISTS `pedidos` (
	  `codigo_pedido` int(11) NOT NULL AUTO_INCREMENT,
	  `codigo_proveedor` int(11),
	  `fecha` date NOT NULL,
	  `fecha_llegada` date NOT NULL,
	  `subtotal` decimal(15,2) NOT NULL,
	  `iva` decimal(15,2) NOT NULL,
	  `total` decimal(15,2) NOT NULL,
	  PRIMARY KEY (`codigo_pedido`),
	  KEY `codigo_proveedor` (`codigo_proveedor`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `productos`;
	CREATE TABLE IF NOT EXISTS `productos` (
	  `codigo_producto` int(11) NOT NULL AUTO_INCREMENT,
	  `nombre_producto` varchar(100) NOT NULL,
	  `tipo_producto` varchar(100) NOT NULL,
	  `marca_producto` varchar(100) NOT NULL,
	  `modelo_producto` varchar(100) NOT NULL,
	  `precio_venta` decimal(15,2) NOT NULL,
	  `existencias` int(11) NOT NULL,
	  PRIMARY KEY (`codigo_producto`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `proveedores`;
	CREATE TABLE IF NOT EXISTS `proveedores` (
	  `nombre_empresa` varchar(100) NOT NULL,
	  `codigo_proveedor` int(11) NOT NULL AUTO_INCREMENT,
	  `telefono` varchar(15) NOT NULL,
	  `direccion` varchar(100) NOT NULL,
	  `rif` varchar(20) NOT NULL,
	  PRIMARY KEY (`codigo_proveedor`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	ALTER TABLE `detalles_pedido`
	  ADD FOREIGN KEY (`codigo_producto`)
	  REFERENCES `productos`(`codigo_producto`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE;
	  ;

	ALTER TABLE `detalles_pedido`
	  ADD FOREIGN KEY (`codigo_pedido`)
	  REFERENCES `pedidos`(`codigo_pedido`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE;
	  ;

	ALTER TABLE `detalles_facturacion`
	  ADD FOREIGN KEY (`codigo_producto`)
	  REFERENCES `productos`(`codigo_producto`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE;
	  ;

	ALTER TABLE `detalles_facturacion`
	  ADD FOREIGN KEY (`codigo_factura`)
	  REFERENCES `facturacion`(`codigo_factura`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE;
	  ;

	ALTER TABLE `pedidos`
	  ADD FOREIGN KEY (`codigo_proveedor`)
	  REFERENCES `proveedores`(`codigo_proveedor`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE;
	  ;

	ALTER TABLE `facturacion`
	  ADD FOREIGN KEY (`ci_cliente`)
	  REFERENCES `clientes`(`ci_cliente`)
	  ON DELETE SET NULL
	  ON UPDATE CASCADE;
	  ;

	INSERT INTO `usuarios` (`usuario`, `clave`, `rango`) VALUES
	('administrador', '', 1);
	COMMIT;

	";

	$conexion->get_consulta($sql, $sql_values);

}
