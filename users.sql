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

INSERT INTO `users` (`uname`, `email`, `pass`, `name`, `nim`, `faculty`, `major`, `description`, `image`) VALUES
('irvanmalik48', 'irvanmalik48@gmail.com', '$2y$10$92lrprkTcrFgUqrcTTLAa.XWI2N5Ay.5pSt7Bar5Qq7qCfOG/CUWm', 'Irvan Malik Azantha', '09021282025060', 'Ilmu Komputer', 'Teknik Informatika', 'Btw I use Arch.', 'assets/img/default.jpg'),
('aliftoriq', 'aliftoriq@gmail.com', '$2y$10$SNgCil/DamJ5DBX0UnN.Le54NQL9GKqakNHmHK/7/Eu7rFq2eGeqS', 'Alif Toriq Alkausar', '09021182025016', 'Ilmu Komputer', 'Teknik Informatika', 'Manusia hanyalah alat.', 'assets/img/default.jpg'),
('pasha12', 'pashaakbar27@gmail.com', '$2y$10$60Idk0qhl1CvyiHeIrKBe.qYTuFnhAybdgHXIrRJAGCw6RquDjanC', 'Anwaripasha Akbar', '09021282025072', 'Ilmu Komputer', 'Teknik Informatika', 'Calon penduduk planet Mars.', 'assets/img/default.jpg');