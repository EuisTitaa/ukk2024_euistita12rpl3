-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 10:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galerifoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `folow`
--

CREATE TABLE `folow` (
  `folow_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folow`
--

INSERT INTO `folow` (`folow_id`, `User_id`, `user`) VALUES
(3, 33, 25),
(4, 33, 22),
(6, 25, 22),
(7, 22, 33),
(8, 22, 25);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `tanggal_unggah` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `user_id`) VALUES
(28, 'Jembatan Musim Gugur 😊', 'Di penghujung hari, cahaya senja memeluk jembatan dengan lembut, menciptakan panorama yang memukau. Dalam keremangan, jembatan tersebut menjadi saksi bisu dari jejak langkah manusia yang berlalu, cerita kehidupan yang terurai di sepanjang jalur yang dilaluinya. Sinar matahari yang merayap perlahan-lahan di ufuk barat menambahkan pesona pada jalinan besi yang megah. Suara gemericik air di bawahnya menjadi serenade alami yang menenangkan, membalut suasana dengan kehangatan dan ketenangan. Di atas jembatan, seakan ada dunia lain yang terbentang, mengundang untuk dijelajahi. Seseorang mungkin berhenti sejenak, menatap keindahan alam yang mempesona atau merenungkan perjalanan hidupnya. Di sini, waktu berjalan lebih lambat, memberi kesempatan untuk merasakan momen-momen kecil yang berharga. Sore menjelang malam adalah saat yang tepat untuk menghargai keindahan yang tersembunyi di balik keriuhan keseharian. Jembatan di sore hari menjadi saksi bisu dari keindahan alam dan kehidupan yang terus berputar, mengingatkan k', '2024-04-24', '66287a31825b5.jpg', 22),
(29, 'Aku Dan Anakku', 'Melalui pisau cukur dan senyum, kami bersama-sama menemukan arti kebersamaan.&quot; 💈👨‍👦 #BerpengalamanBersama #TautanBapakDanAnak', '2024-04-24', '66287a42a07ba.jpg', 22),
(31, 'Danau Jernih', 'Cahaya matahari membelai permukaan air, menampakkan keindahan alami dan ketenangan di pagi yang masih sepi', '2024-04-24', '66287bd9c3c4a.jpg', 25),
(32, 'Titaa', 'Di penghujung hari, cahaya senja memeluk jembatan dengan lembut, menciptakan panorama yang memukau. ', '2024-04-24', '66287f4a2a084.jpg', 22);

-- --------------------------------------------------------

--
-- Table structure for table `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar_foto`
--

INSERT INTO `komentar_foto` (`komentar_id`, `foto_id`, `user_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(113, 31, 22, 'Hahaha lucu sekali222', '2024-04-24'),
(114, 32, 33, 'Waduh kok saya?', '2024-04-24'),
(115, 28, 33, 'Panjang sekali deskripsinya 🤣', '2024-04-24'),
(116, 32, 25, 'Awokaowkaok Suka kali', '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(126, 31, 22, '2024-04-24'),
(127, 32, 22, '2024-04-24'),
(128, 29, 22, '2024-04-24'),
(129, 28, 32, '2024-04-24'),
(130, 32, 33, '2024-04-24'),
(131, 31, 33, '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `foto_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `foto_user`) VALUES
(22, 'Dynamight', '$2y$10$8E.whAVaJE.ZBjSH9y20ue2HLfILAhjYCSkN29GOkueo5LnJqVwcS', 'Dynamight204@gmail.com', 'Bakugou Katsuki', 'Jepang', '66287f9916555.jpg'),
(25, 'kanna-Chan', '$2y$10$lKoW87J.AeA.boL3Vx.gbOZCPyu1/64h4RZNsw0shrnHyqfcTXqCS', 'KannaAoi@gmail.com', 'Kanna Aoi', 'Jepang', '662603d395197.jpg'),
(32, 'Anonymous', '', '', '', '', 'anonim.png'),
(33, 'Titaa', '$2y$10$vhclkXGsKXPm8cjq3Lj8U.6BmTFdMlFK0d7yKxWgBv8lWXXDYszuS', 'euistitanuraisah@gmail.com', 'EuisTita Nuraisah', 'Majalengka', '6628a4ff229f0.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folow`
--
ALTER TABLE `folow`
  ADD PRIMARY KEY (`folow_id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `foto_id` (`foto_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `foto_id` (`foto_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `foto_id` (`foto_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `folow`
--
ALTER TABLE `folow`
  MODIFY `folow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD CONSTRAINT `komentar_foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_foto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD CONSTRAINT `like_foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_foto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
