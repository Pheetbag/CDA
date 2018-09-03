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

	DROP TABLE IF EXISTS `clientes`;
	CREATE TABLE IF NOT EXISTS `clientes` (
	  `nombre_cliente` varchar(20) NOT NULL,
	  `apellido_cliente` varchar(20) NOT NULL,
	  `ci_cliente` varchar(12) NOT NULL,
	  `direccion_cliente` varchar(100) NOT NULL,
	  `telefono` varchar(15) NOT NULL,
	  PRIMARY KEY (`ci_cliente`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `detalles_facturacion`;
	CREATE TABLE IF NOT EXISTS `detalles_facturacion` (
	  `codigo_factura` int(11) DEFAULT NULL,
	  `codigo_producto` int(11) DEFAULT NULL,
	  `cantidad` int(11) NOT NULL,
	  `subtotal` decimal(17,2) NOT NULL,
	  KEY `codigo_producto` (`codigo_producto`),
	  KEY `codigo_factura` (`codigo_factura`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `detalles_pedido`;
	CREATE TABLE IF NOT EXISTS `detalles_pedido` (
	  `codigo_pedido` int(11) DEFAULT NULL,
	  `codigo_producto` int(11) DEFAULT NULL,
	  `precio_compra` decimal(17,2) NOT NULL,
	  `cantidad` int(11) NOT NULL,
	  `subtotal` decimal(17,2) NOT NULL,
	  KEY `codigo_producto` (`codigo_producto`),
	  KEY `codigo_pedido` (`codigo_pedido`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `facturacion`;
	CREATE TABLE IF NOT EXISTS `facturacion` (
	  `codigo_factura` int(11) NOT NULL AUTO_INCREMENT,
	  `fecha_venta` datetime NOT NULL,
	  `ci_cliente` varchar(12) DEFAULT NULL,
	  `subtotal` decimal(17,2) NOT NULL,
	  `iva` decimal(17,2) NOT NULL,
	  `total` decimal(17,2) NOT NULL,
	  PRIMARY KEY (`codigo_factura`),
	  KEY `ci_cliente` (`ci_cliente`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `pedidos`;
	CREATE TABLE IF NOT EXISTS `pedidos` (
	  `codigo_pedido` int(11) NOT NULL AUTO_INCREMENT,
	  `codigo_proveedor` varchar(20) DEFAULT NULL,
	  `fecha` datetime NOT NULL,
	  `fecha_llegada` datetime NOT NULL,
	  `subtotal` decimal(17,2) NOT NULL,
	  PRIMARY KEY (`codigo_pedido`),
	  KEY `codigo_proveedor` (`codigo_proveedor`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `productos`;
	CREATE TABLE IF NOT EXISTS `productos` (
	  `codigo_producto` int(11) NOT NULL AUTO_INCREMENT,
	  `nombre_producto` varchar(100) NOT NULL,
	  `tipo_producto` varchar(100) NOT NULL,
	  `marca_producto` varchar(100) NOT NULL,
	  `modelo_producto` varchar(100) NOT NULL,
	  `precio_venta` decimal(17,2) NOT NULL,
	  `existencias` int(11) NOT NULL,
	  PRIMARY KEY (`codigo_producto`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

	DROP TABLE IF EXISTS `proveedores`;
	CREATE TABLE IF NOT EXISTS `proveedores` (
	  `nombre_empresa` varchar(100) NOT NULL,
	  `telefono` varchar(15) NOT NULL,
	  `direccion` varchar(100) NOT NULL,
	  `rif` varchar(20) NOT NULL,
	  PRIMARY KEY (`rif`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	DROP TABLE IF EXISTS `usuarios`;
	CREATE TABLE IF NOT EXISTS `usuarios` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `usuario` varchar(25) NOT NULL,
	  `clave` varchar(16) NOT NULL,
	  `rango` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

	INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `rango`) VALUES
	(1, 'ADMIN', '', 1),
	(2, 'OPERADOR', '', 2),
	(3, 'VENDEDOR', '', 3);


	ALTER TABLE `detalles_facturacion`
	  ADD CONSTRAINT `detalles_facturacion_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo_producto`) ON DELETE SET NULL ON UPDATE CASCADE,
	  ADD CONSTRAINT `detalles_facturacion_ibfk_2` FOREIGN KEY (`codigo_factura`) REFERENCES `facturacion` (`codigo_factura`) ON DELETE SET NULL ON UPDATE CASCADE;

	ALTER TABLE `detalles_pedido`
	  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `productos` (`codigo_producto`) ON DELETE SET NULL ON UPDATE CASCADE,
	  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`codigo_pedido`) REFERENCES `pedidos` (`codigo_pedido`) ON DELETE SET NULL ON UPDATE CASCADE;

	ALTER TABLE `facturacion`
	  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`ci_cliente`) REFERENCES `clientes` (`ci_cliente`) ON DELETE SET NULL ON UPDATE CASCADE;

	ALTER TABLE `pedidos`
	  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`codigo_proveedor`) REFERENCES `proveedores` (`rif`) ON DELETE SET NULL ON UPDATE CASCADE;
	COMMIT;

	";

	$conexion->get_consulta($sql, $sql_values);

}
