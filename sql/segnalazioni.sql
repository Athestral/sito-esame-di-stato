CREATE TABLE `segnalazioni` (
  `id` int(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `dataSegnalazione` datetime NOT NULL,
  `descrizione` varchar(1000) NOT NULL,
  `risolto` tinyint(1) NOT NULL DEFAULT '0',
  `atti` tinyint(1) NOT NULL,
  `ksUser` int unsigned NOT NULL,
  `ksReparto` int unsigned DEFAULT NULL,
  `ksTipologia` int unsigned DEFAULT NULL,
  FOREIGN KEY (`ksUser`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
  FOREIGN KEY (`ksReparto`) REFERENCES `reparti` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (`ksTipologia`) REFERENCES `tipologie` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
);

