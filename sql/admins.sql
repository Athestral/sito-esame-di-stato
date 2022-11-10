CREATE TABLE `admins` (
  `id` int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL
);