DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nim` varchar(14) NOT NULL DEFAULT '00000000000000',
  `faculty` varchar(255) NOT NULL DEFAULT 'Belum disetel',
  `major` varchar(255) NOT NULL DEFAULT 'Belum disetel',
  `description` varchar(2000) NOT NULL DEFAULT 'Tidak ada deskripsi.',
  `image` varchar(255) NOT NULL DEFAULT 'assets/img/default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `users` (`id`, `uname`, `email`, `pass`, `name`, `nim`, `faculty`, `major`, `description`, `image`) VALUES
(1, 'irvanmalik48', 'irvanmalik48@gmail.com', '$2y$10$dIjCDgWBas8/BprGmVflru3XIIfPOrEpvheeg1y6xmrbwp0RzqfOS', 'Irvan Malik Azantha', '09021282025060', 'Ilmu Komputer', 'Teknik Informatika', 'Tidak ada deskripsi.', 'assets/img/default.jpg'),
(2, 'aliftoriq', 'aliftoriq@gmail.com', '$2y$10$Ud7iJ8un5MSH6jLAXOoRzeeh5Hj0UVEKrnKlxgkY.DynynukcVDky', 'Alif Toriq Alkausar', '00000000000000', 'Belum disetel', 'Belum disetel', 'Tidak ada deskripsi.', 'assets/img/default.jpg');