CREATE TABLE `users` (
  `id` int(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `cognome` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sesso` char(1) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(100) NOT NULL,
  `indirizzo` varchar(100) NOT NULL,
  `citta` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `cf` varchar(100) UNIQUE NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `telefono` varchar(100) NOT NULL
);