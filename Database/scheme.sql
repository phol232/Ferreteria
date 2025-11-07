CREATE TABLE `clientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombreCliente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidosCliente` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dniCliente` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccionCliente` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonoCliente` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correoCliente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `detalleventas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idVenta` bigint unsigned NOT NULL,
  `idProducto` bigint unsigned NOT NULL,
  `cantidadDetalleVenta` bigint NOT NULL,
  `subtotalDetalleVenta` double NOT NULL,
  `totalDetalleVenta` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalleventas_idventa_foreign` (`idVenta`),
  KEY `detalleventas_idproducto_foreign` (`idProducto`),
  CONSTRAINT `detalleventas_idproducto_foreign` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`),
  CONSTRAINT `detalleventas_idventa_foreign` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `productos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idProveedor` bigint unsigned NOT NULL,
  `codigoProducto` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombreProducto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcionProducto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidadProducto` bigint NOT NULL,
  `costoProducto` float NOT NULL,
  `gananciaProducto` float NOT NULL,
  `precioProducto` float NOT NULL,
  `imageProducto` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productos_idproveedor_foreign` (`idProveedor`),
  CONSTRAINT `productos_idproveedor_foreign` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `proveedores` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `razonSocial` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rucProveedor` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correoProveedor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccionProveedor` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefonoProveedor` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

CREATE TABLE `ventas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `idCliente` bigint unsigned NOT NULL,
  `subtotalVenta` float NOT NULL,
  `gananciasVenta` float NOT NULL,
  `igvVenta` float NOT NULL,
  `totalVenta` float NOT NULL,
  `fechaVenta` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_idcliente_foreign` (`idCliente`),
  CONSTRAINT `ventas_idcliente_foreign` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci