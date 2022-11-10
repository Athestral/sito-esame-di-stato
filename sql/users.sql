CREATE TABLE `users` (
  `id` int(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `cognome` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sesso` char(1) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(100) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `citta` varchar(100) NOT NULL,
  `provincia` char(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(150) UNIQUE NOT NULL,
  `telefono` int(100) UNSIGNED NOT NULL
);