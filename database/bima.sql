-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2020 at 10:46 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alur`
--

CREATE TABLE `tbl_alur` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `daftar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_alur`
--

INSERT INTO `tbl_alur` (`id`, `judul`, `icon`, `keterangan`, `daftar`) VALUES
(1, 'PERSIAPAN', 'fa fa-code', '<p>#syarat :</p>\r\n<p>1. Sudah lulus >= 130 sks</p>\r\n<p>2. Sudah lulus PKL & KKN</p>\r\n<p>#Mahasiswa</p>\r\n<p>1. Histori judul skripsi dan Kuota calon dosen pembimbing dapat dilihat dimenu akun mahasiswa masing-masing</p>\r\n<p>2. Menentukan topik skripsi dan mencari calon dosen pembimbing</p>', 0),
(2, 'PENDAFTARAN PRA SKRIPSI', 'fa fa-code', '<p>#Jadwal pra skripsi dapat dilihat pada halaman utama/jadwal.</p>\r\n<p>#Mahasiswa :</p>\r\n<p>1. Menyiapkan Form Pengajuan Topik Skripsi (berisi Deskripsi Topik Skripsi dan 2 Calon Pembimbing).</p>\r\n<p>2. Mengumpulkan Form Pengajuan Topik Skripsi dan Transkrip Nilai terbaru (bisa diambil dari Siamik)</p>\r\n<p>3. Membuat akun bima, melengkapi profil, data topik, melengkapi berkas, dan mendaftarkan pra skripsi.</p>', 1),
(3, 'PRA SKRIPSI', 'fa fa-code', '<p>#Jadwal pra skripsi dapat dilihat pada halaman utama/jadwal.</p>\r\n<p>#Mahasiswa</p>\r\n<p>1. Memaparkan Topik Skripsi (berdasarkan Deskripsi yang dibuat, dapat didukung dengan data atau referensi lain).</p>\r\n<p>2. Hasil kelulusan pra skripsi dapat dilihat pada akun bima menu topik</p>', 0),
(7, 'PROSES BIMBINGAN DAN PENGERJAAN SKRIPSI', 'fa fa-code', '<p>#Mahasiswa :</p>\r\n<p>1. Topik yang disetujui dapat langsung dikerjakan Mahasiswa.</p>\r\n<p>2. Konten Skripsi mengikuti Tabel Bidang Keahlian di Kurikulum 2019.</p>\r\n<p>3. Bimbingan & Penyelesaian Skripsi sampai dengan Jadwal Ujian Skripsi.</p>', 0),
(8, 'PENDAFTARAN UJIAN SKRIPSI', 'fa fa-code', '<p>#Jadwal ujian skripsi dapat dilihat pada halaman utama/jadwal.</p>\r\n<p>#Mahasiswa :</p>\r\n<p>1. Pada akun bima, melengkapi berkas, dan mendaftarkan ujian skripsi.</p>', 1),
(9, 'UJIAN SKRIPSI', 'fa fa-code', '<p>#Jadwal ujian skripsi dapat dilihat pada halaman utama/jadwal.</p>\r\n<p>#Mahasiswa</p>\r\n<p>1. Memaparkan Hasil Skripsi dan Buku Skripsi</p>\r\n<p>2. Hasil kelulusan ujian skripsi dapat dilihat pada akun bima menu topik</p>', 0),
(10, 'PENDAFTARAN YUDISIUM', 'fa fa-code', '<p>Berkas persyaratan dapat dilihat di TU Fakultas</p>', 0),
(14, 'YUDISIUM', 'fa fa-code', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berita`
--

CREATE TABLE `tbl_berita` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `judul` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `nama_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_berita`
--

INSERT INTO `tbl_berita` (`id`, `tanggal`, `judul`, `keterangan`, `nama_file`) VALUES
(1, '2020-03-05 11:42:54', 'Kuota Pembimbing Skripsi per 25 Februari 2020', '', '050320201142541583383374825.jpg'),
(2, '2020-03-05 11:43:09', 'Jadwal Pra Skripsi periode Maret 2020', '', '050320201143091583383389715.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bidang_keahlian`
--

CREATE TABLE `tbl_bidang_keahlian` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bidang_keahlian`
--

INSERT INTO `tbl_bidang_keahlian` (`id`, `nama`) VALUES
(1, '-'),
(2, 'Perancangan Sistem'),
(3, 'Pembuatan Sistem'),
(4, 'Pengujian Sistem'),
(5, 'Reverse Enginering'),
(6, 'Strategi IT'),
(7, 'Komputasi Cerdas'),
(8, 'Pengolahan Citra'),
(9, 'Visi Komputer'),
(10, 'Robotika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bimbingan`
--

CREATE TABLE `tbl_bimbingan` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `materi` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carousel`
--

CREATE TABLE `tbl_carousel` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `nama_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_carousel`
--

INSERT INTO `tbl_carousel` (`id`, `judul`, `nama_file`) VALUES
(13, 'Gedung giri santika', '210120202218011579619881708.jpg'),
(14, 'Gedung giri santika 2', '210120202218211579619901777.png'),
(15, 'Patung jendral sudirman', '210120202220041579620004999.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen`
--

CREATE TABLE `tbl_dokumen` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `nama_file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dokumen`
--

INSERT INTO `tbl_dokumen` (`id`, `nama`, `jumlah`, `jenis`, `nama_file`) VALUES
(1, 'Form Pengajuan Topik Skripsi ', 1, 1, '120320201849581584013798722.docx'),
(2, 'Transkrip Nilai terbaru (bisa  diambil dari Siamik, sudah lulus 130 SKS)', 1, 1, ''),
(3, 'Bukti KRS (Skripsi)', 1, 1, ''),
(4, 'Fotokopi Lembar Pengesahan PKL, Sertifikat KKN', 1, 1, ''),
(5, 'Transkrip Nilai (harus lulus semua MK selain Skripsi) ', 1, 4, ''),
(6, 'Form Persetujuan Pembimbing', 1, 4, ''),
(7, 'Buku Skripsi (belum dijilid)', 3, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen_mahasiswa`
--

CREATE TABLE `tbl_dokumen_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `nama_file` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email`
--

CREATE TABLE `tbl_email` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `id` int(11) NOT NULL,
  `tanya` varchar(250) NOT NULL,
  `jawab` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`id`, `tanya`, `jawab`) VALUES
(1, 'Berapa jumlah minimal sks untuk mendaftar pra skripsi', '130 sks');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_histori`
--

CREATE TABLE `tbl_histori` (
  `id` int(11) NOT NULL,
  `npm` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `pembimbing_1` varchar(100) NOT NULL,
  `pembimbing_2` varchar(100) NOT NULL,
  `tanggal_lulus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_histori`
--

INSERT INTO `tbl_histori` (`id`, `npm`, `nama`, `judul`, `pembimbing_1`, `pembimbing_2`, `tanggal_lulus`) VALUES
(1, '1634010017', 'MUHAMMAD AGUNG SHOBIRIN', 'RANCANG BANGUN SISTEM INFORMASI MONITORING TUGAS AKHIR / SKRIPSI BERBASIS WEB (STUDI KASUS PRODI INFORMATIKA UPN &quot;VETERAN&quot; JATIM)', 'Rizky Parlika, S.Kom, M.Kom', 'Fawwaz Ali Akbar, S.Kom, M.Kom', '2020-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(20) NOT NULL,
  `keterangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id`, `tanggal`, `jam`, `keterangan`) VALUES
(1, '2020-02-07', '', 2),
(2, '2020-03-06', '', 2),
(3, '2020-04-17', '', 5),
(5, '2020-04-29', '', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kontak`
--

CREATE TABLE `tbl_kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subjek` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `balasan` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kontak`
--

INSERT INTO `tbl_kontak` (`id`, `nama`, `email`, `subjek`, `pesan`, `balasan`, `tanggal`) VALUES
(1, 'agung', 'agung.sman1@gmail.com', 'pra skripsi', '<p>apakah bulan mei ada agenda pra skripsi ?</p>', '', '2020-04-26 14:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laboratorium`
--

CREATE TABLE `tbl_laboratorium` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_laboratorium`
--

INSERT INTO `tbl_laboratorium` (`id`, `nama`) VALUES
(1, '-'),
(2, 'PPS'),
(3, 'SCR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topik`
--

CREATE TABLE `tbl_topik` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen_1` int(11) NOT NULL,
  `id_dosen_2` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `id_laboratorium` int(11) NOT NULL,
  `id_bidang_keahlian` int(11) NOT NULL,
  `tahap` int(11) NOT NULL,
  `latar_belakang` text NOT NULL,
  `tujuan` text NOT NULL,
  `permasalahan` text NOT NULL,
  `metodologi` text NOT NULL,
  `metode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_topik`
--

INSERT INTO `tbl_topik` (`id`, `id_mahasiswa`, `id_dosen_1`, `id_dosen_2`, `judul`, `id_laboratorium`, `id_bidang_keahlian`, `tahap`, `latar_belakang`, `tujuan`, `permasalahan`, `metodologi`, `metode`) VALUES
(1, 1, 16, 24, 'RANCANG BANGUN SISTEM INFORMASI MONITORING TUGAS AKHIR / SKRIPSI BERBASIS WEB (STUDI KASUS PRODI INFORMATIKA UPN &quot;VETERAN&quot; JATIM)', 2, 3, 6, 'Peran sistem informasi di Prodi Informatika UPN “Veteran” Jatim terdapat beberapa macam, salah satunya berupa sistem informasi untuk skripsi. Perancangan sistem informasi akan memicu perubahan besar dalam proses manajemen skripsi. Saat ini proses pengajuan topik skripsi dan ujian skripsi di Prodi Informatika UPN “Veteran” Jatim masih dilakukan secara konvensional / manual, sehingga hal tersebut kurang efektif karena proses tidak berjalan cepat karena menyita banyak waktu serta membutuhkan banyak resource yang cukup besar.', 'Dengan penelitian ini diharapkan dapat memberikan perancangan sistem informasi mengenai skripsi agar memudahkan mahasiswa, dosen, dan PIA skripsi yang memiliki tujuan sebagai berikut : \r\na. Memudahkan mahasiswa dalam melakukan pengajuan proposal skripsi dan ujian lisan. \r\nb. Memudahkan dosen untuk mengetahui data mahasiswa siapa saja yang dibimbingnya.  \r\nc. Memudahkan PIA skripsi dalam proses rekap data mahasiswa dan verifikasi kelengkapan persyaratan mahasiswa dalam pengajuan proposal skripsi maupun ujian lisan.\r\n', 'Berdasarkan latar belakang masalah diatas, maka pokok permasalahan yang dihadapi yaitu bagaimana cara merancang sistem informasi skripsi berbasis web di Prodi Informatika UPN “Veteran” Jatim guna menggantikan proses manual dalam pengajuan topik skripsi dan ujian skripsi bagi mahasiswa serta baik mahasiswa, dosen, dan PIA skripsi mudah dalam melakukan monitoring.', 'Sesuai dengan metode waterfall yaitu tahap analisa kebutuhan dengan melakukan pengumpulan data dan analisa kebutuhan sistem. Tahap desain dengan melakukan pembuatan desain UML, database, dan anta muka. Tahap Implementasi dengan melakukan implementasi kedalam baris kode program. Dan tahap terakhir yaitu uji coba dengan melakukan pengujian sistem sesuai dengan skenario yang sudah dibuat.', 'Algoritma SAW (Simple Additive Weighting) adalah salah satu algoritma yang digunakan untuk pengambilan keputusan. Algoritma SAW juga dikenal dengan algoritma dengan metode penjumlahan berbobot. Metode ini digunakan untuk mencari alternatif optimal dari sejumlah alternatif dengan kriteria tertetentu, artinya metode SAW dapat menentukan nilai bobot untuk setiap atribut kemudian dilanjut dengan proses prangkingan yang akan menyeleksi alternatif yang sudah dihasilkan. Pada umumnyya metode SAW memiliki 3 pendekatan untuk mencari nilai bobot atribut, yaitu pendekatan subyektif, pendekatan obyektif, dan pendekatan integrasi antara subyektif – obyektif.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topik_acc`
--

CREATE TABLE `tbl_topik_acc` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `posisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_topik_acc`
--

INSERT INTO `tbl_topik_acc` (`id`, `id_mahasiswa`, `id_dosen`, `status`, `posisi`) VALUES
(1, 1, 16, 1, 0),
(2, 1, 24, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topik_riwayat`
--

CREATE TABLE `tbl_topik_riwayat` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tahap` int(11) NOT NULL,
  `penguji_1` int(11) NOT NULL,
  `penguji_2` int(11) NOT NULL,
  `penguji_3` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `id_dosen_1` int(11) NOT NULL,
  `id_dosen_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_topik_riwayat`
--

INSERT INTO `tbl_topik_riwayat` (`id`, `id_mahasiswa`, `id_jadwal`, `status`, `keterangan`, `tahap`, `penguji_1`, `penguji_2`, `penguji_3`, `judul`, `id_dosen_1`, `id_dosen_2`) VALUES
(79, 1, 1, 2, '', 2, 18, 19, 9, 'RANCANG BANGUN SISTEM INFORMASI MONITORING TUGAS AKHIR / SKRIPSI BERBASIS WEB (STUDI KASUS PRODI INFORMATIKA UPN \"VETERAN\" JATIM)', 16, 24),
(80, 1, 3, 2, '', 5, 18, 15, 1, 'RANCANG BANGUN SISTEM INFORMASI MONITORING TUGAS AKHIR / SKRIPSI BERBASIS WEB (STUDI KASUS PRODI INFORMATIKA UPN \"VETERAN\" JATIM)', 16, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_admin`
--

CREATE TABLE `tbl_user_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `last_accessed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_admin`
--

INSERT INTO `tbl_user_admin` (`id`, `email`, `password`, `nama`, `last_accessed`) VALUES
(1, 'admin@bima.com', '$2y$10$5pIv410mdTJTmlXw.SqUTebvyT5R0Jyq9sPvO8aubFPlQ4RO295US', 'admin', '0000-00-00 00:00:00'),
(2, 'admin2@bima.com', '$2y$10$7OsnKuKpmcii/TLVA2HV3.kLx.EDCrgevpR.ceG2Mi.QK4W6DjbEi', 'admin2', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_dosen`
--

CREATE TABLE `tbl_user_dosen` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `no_induk` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_laboratorium` int(11) NOT NULL,
  `kuota_pembimbing_1` int(11) NOT NULL,
  `kuota_pembimbing_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_dosen`
--

INSERT INTO `tbl_user_dosen` (`id`, `email`, `password`, `no_induk`, `nama`, `id_laboratorium`, `kuota_pembimbing_1`, `kuota_pembimbing_2`) VALUES
(1, 'dosen@bima.com', '$2y$10$q7r1f/597Ov7rwLmU6J8OOS.uuT3qAu/pUqlYcvmiEBFVGxKPUOAW', '', '-', 1, 0, 0),
(2, 'p.ajun@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Achmad Junaidi, S.Kom, M.Kom', 1, 0, 0),
(3, 'p.bas@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Dr. Basuki Rahmat, S.Si, MT', 3, 15, 5),
(4, 'p.budi@bima.com', '$2y$10$weSSFPwUWfCjgRlMs/ny2ujOlxLEW8oKw9Xr4oGB5VSqxoMgIA9Ri', '', 'Budi Nugroho, S.Kom, M.Kom', 3, 15, 5),
(5, 'p.aji@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Chrystia Aji Putra, S.Kom, MT', 3, 10, 10),
(6, 'b.eva@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Eva Yulia Puspaningrum, S.Kom, M.Kom', 3, 9, 11),
(7, 'p.faisal@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Faisal Muttaqin, S.Kom, MT', 2, 9, 11),
(8, 'b.fetty@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Fetty Tri Anggraeny, S.Kom, M.Kom', 2, 15, 5),
(9, 'p.firza@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Firza Prima Aditiawan, S.Kom, MTI', 2, 9, 11),
(10, 'b.henni@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Henni Endah Wahanani, ST, M.Kom', 2, 9, 11),
(11, 'p.gede@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Dr. I Gede Susrama MD, ST, MT', 3, 15, 5),
(12, 'b.intan@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Intan Yuniar Purbasari, S.Kom, MSc', 3, 15, 5),
(13, 'b.kartini@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Ir. Kartini, S.Kom, MT', 1, 0, 0),
(14, 'p.idhom@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Mohammad Idhom, SP, S.Kom, MT', 2, 9, 11),
(15, 'p.pratama@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Pratama Wirya Atmaja, S.Kom, M.Kom', 2, 0, 10),
(16, 'p.rizky@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Rizky Parlika, S.Kom, M.Kom', 2, 9, 11),
(17, 'p.ronggo@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Ronggo Alit, S.Kom, MM, MT', 2, 9, 11),
(18, 'p.sugi@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Sugiarto, S.Kom, M.Kom', 2, 9, 11),
(19, 'p.wahyu@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Wahyu SJ Saputra, S.Kom, M.Kom', 3, 9, 11),
(20, 'b.yisti@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Yisti Vita Via, S.ST, M.Kom', 3, 9, 11),
(21, 'b.retno@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Retno Mumpuni, S.Kom, M.Sc', 2, 9, 11),
(22, 'b.hanin@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Made Hanindia Prami Swari, S.Kom, M.Cs', 2, 0, 10),
(23, 'p.eka@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Eka Prakarsa Mandyartha, ST, M.Kom', 3, 0, 10),
(24, 'p.fawwaz@bima.com', '$2y$10$WJHCVW.Kkf38i.F7A4W.suALuHL2Roe1kY37AFIRED3lkuvJzwJ1e', '', 'Fawwaz Ali Akbar, S.Kom, M.Kom', 3, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_mahasiswa`
--

CREATE TABLE `tbl_user_mahasiswa` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `npm` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `telegram` varchar(15) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `ipk` varchar(5) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `kode` varchar(6) NOT NULL,
  `status_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_mahasiswa`
--

INSERT INTO `tbl_user_mahasiswa` (`id`, `email`, `password`, `npm`, `nama`, `no_hp`, `telegram`, `jenis_kelamin`, `alamat`, `jumlah_sks`, `ipk`, `foto`, `kode`, `status_akun`) VALUES
(1, 'agung.sman1@gmail.com', '$2y$10$mYvwAd0jTDrwL7kmFNZfRuSzmwM/5hiR396XHyoRdE/Ul3b3wmT0i', '1634010017', 'Muhammad Agung Shobirin', '082331008114', '651410447', 1, 'sidoarjo', 148, '3.83', '030520201034411588494881434.jpg', '272457', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_pimpinan`
--

CREATE TABLE `tbl_user_pimpinan` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `last_accessed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_pimpinan`
--

INSERT INTO `tbl_user_pimpinan` (`id`, `email`, `password`, `nama`, `last_accessed`) VALUES
(1, 'pimpinan@bima.com', '$2y$10$HtKdXgN.bBmOyabOk8TFaefYTIuujd4yqnA6q7dFAgnJeElAME/o6', '', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alur`
--
ALTER TABLE `tbl_alur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bidang_keahlian`
--
ALTER TABLE `tbl_bidang_keahlian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `tbl_carousel`
--
ALTER TABLE `tbl_carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dokumen_mahasiswa`
--
ALTER TABLE `tbl_dokumen_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dokumen` (`id_dokumen`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `tbl_email`
--
ALTER TABLE `tbl_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_histori`
--
ALTER TABLE `tbl_histori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_laboratorium`
--
ALTER TABLE `tbl_laboratorium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_topik`
--
ALTER TABLE `tbl_topik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen_1` (`id_dosen_1`),
  ADD KEY `id_dosen_2` (`id_dosen_2`),
  ADD KEY `id_bidang_keahlian` (`id_bidang_keahlian`),
  ADD KEY `id_laboratorium` (`id_laboratorium`);

--
-- Indexes for table `tbl_topik_acc`
--
ALTER TABLE `tbl_topik_acc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `id_dosen` (`id_dosen`);

--
-- Indexes for table `tbl_topik_riwayat`
--
ALTER TABLE `tbl_topik_riwayat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`),
  ADD KEY `penguji_1` (`penguji_1`),
  ADD KEY `penguji_2` (`penguji_2`),
  ADD KEY `penguji_3` (`penguji_3`),
  ADD KEY `id_tanggal` (`id_jadwal`),
  ADD KEY `jenis` (`tahap`);

--
-- Indexes for table `tbl_user_admin`
--
ALTER TABLE `tbl_user_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_dosen`
--
ALTER TABLE `tbl_user_dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laboratorium` (`id_laboratorium`);

--
-- Indexes for table `tbl_user_mahasiswa`
--
ALTER TABLE `tbl_user_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_pimpinan`
--
ALTER TABLE `tbl_user_pimpinan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_alur`
--
ALTER TABLE `tbl_alur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_bidang_keahlian`
--
ALTER TABLE `tbl_bidang_keahlian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_carousel`
--
ALTER TABLE `tbl_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_dokumen_mahasiswa`
--
ALTER TABLE `tbl_dokumen_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_email`
--
ALTER TABLE `tbl_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_histori`
--
ALTER TABLE `tbl_histori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_laboratorium`
--
ALTER TABLE `tbl_laboratorium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_topik`
--
ALTER TABLE `tbl_topik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_topik_acc`
--
ALTER TABLE `tbl_topik_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_topik_riwayat`
--
ALTER TABLE `tbl_topik_riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_user_admin`
--
ALTER TABLE `tbl_user_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_dosen`
--
ALTER TABLE `tbl_user_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user_mahasiswa`
--
ALTER TABLE `tbl_user_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_pimpinan`
--
ALTER TABLE `tbl_user_pimpinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD CONSTRAINT `tbl_bimbingan_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `tbl_user_dosen` (`id`),
  ADD CONSTRAINT `tbl_bimbingan_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_user_mahasiswa` (`id`);

--
-- Constraints for table `tbl_dokumen_mahasiswa`
--
ALTER TABLE `tbl_dokumen_mahasiswa`
  ADD CONSTRAINT `tbl_dokumen_mahasiswa_ibfk_1` FOREIGN KEY (`id_dokumen`) REFERENCES `tbl_dokumen` (`id`),
  ADD CONSTRAINT `tbl_dokumen_mahasiswa_ibfk_2` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_user_mahasiswa` (`id`);

--
-- Constraints for table `tbl_email`
--
ALTER TABLE `tbl_email`
  ADD CONSTRAINT `tbl_email_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_user_mahasiswa` (`id`);

--
-- Constraints for table `tbl_topik`
--
ALTER TABLE `tbl_topik`
  ADD CONSTRAINT `tbl_topik_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_user_mahasiswa` (`id`),
  ADD CONSTRAINT `tbl_topik_ibfk_2` FOREIGN KEY (`id_dosen_1`) REFERENCES `tbl_user_dosen` (`id`),
  ADD CONSTRAINT `tbl_topik_ibfk_3` FOREIGN KEY (`id_dosen_2`) REFERENCES `tbl_user_dosen` (`id`),
  ADD CONSTRAINT `tbl_topik_ibfk_4` FOREIGN KEY (`id_bidang_keahlian`) REFERENCES `tbl_bidang_keahlian` (`id`),
  ADD CONSTRAINT `tbl_topik_ibfk_5` FOREIGN KEY (`id_laboratorium`) REFERENCES `tbl_laboratorium` (`id`);

--
-- Constraints for table `tbl_topik_acc`
--
ALTER TABLE `tbl_topik_acc`
  ADD CONSTRAINT `tbl_topik_acc_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_user_mahasiswa` (`id`),
  ADD CONSTRAINT `tbl_topik_acc_ibfk_2` FOREIGN KEY (`id_dosen`) REFERENCES `tbl_user_dosen` (`id`);

--
-- Constraints for table `tbl_topik_riwayat`
--
ALTER TABLE `tbl_topik_riwayat`
  ADD CONSTRAINT `tbl_topik_riwayat_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_user_mahasiswa` (`id`),
  ADD CONSTRAINT `tbl_topik_riwayat_ibfk_4` FOREIGN KEY (`penguji_1`) REFERENCES `tbl_user_dosen` (`id`),
  ADD CONSTRAINT `tbl_topik_riwayat_ibfk_5` FOREIGN KEY (`penguji_2`) REFERENCES `tbl_user_dosen` (`id`),
  ADD CONSTRAINT `tbl_topik_riwayat_ibfk_6` FOREIGN KEY (`penguji_3`) REFERENCES `tbl_user_dosen` (`id`),
  ADD CONSTRAINT `tbl_topik_riwayat_ibfk_7` FOREIGN KEY (`id_jadwal`) REFERENCES `tbl_jadwal` (`id`);

--
-- Constraints for table `tbl_user_dosen`
--
ALTER TABLE `tbl_user_dosen`
  ADD CONSTRAINT `tbl_user_dosen_ibfk_2` FOREIGN KEY (`id_laboratorium`) REFERENCES `tbl_laboratorium` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
