-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2023 pada 13.50
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

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
-- Struktur dari tabel `tb_disposisi`
--

CREATE TABLE `tb_disposisi` (
  `id_disposisi` int(11) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `isi_disposisi` text NOT NULL,
  `sifat` varchar(20) NOT NULL,
  `catatan` text NOT NULL,
  `id_suratmasuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_instansi`
--

CREATE TABLE `tb_instansi` (
  `id_instansi` int(11) NOT NULL,
  `institusi` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kepala` varchar(250) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `notelp` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_instansi`
--

INSERT INTO `tb_instansi` (`id_instansi`, `institusi`, `nama`, `status`, `alamat`, `kepala`, `nip`, `email`, `notelp`, `logo`) VALUES
(1, 'PEMATANG RAYA', 'PT NESVA', 'PT', 'Jalan Sutomo No 18 PEM. Raya ', 'EVARIA MONA PURBA', ' ', '  Samuelsumbayak2000@gmail.com', '   082261937394', 'Gambar WhatsApp 2023-06-27 pukul 17.09.23.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_klasifikasi`
--

CREATE TABLE `tb_klasifikasi` (
  `id_klasifikasi` int(11) NOT NULL,
  `kode_klasifikasi` varchar(20) NOT NULL,
  `judul_klasifikasi` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_klasifikasi`
--

INSERT INTO `tb_klasifikasi` (`id_klasifikasi`, `kode_klasifikasi`, `judul_klasifikasi`, `keterangan`) VALUES
(10, 'K20 Saset', '20gr', 'Bubuk Jahe Nesva 20gr Saset'),
(11, 'K20', '20gr', 'Bubuk Jahe Nesva 20gr'),
(12, 'K100', '100gr', 'Bubuk Jahe Nesva 100gr'),
(13, 'K300', '300gr', 'Bubuk Jahe Nesva 300gr');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_suratkeluar`
--

CREATE TABLE `tb_suratkeluar` (
  `id_suratkeluar` int(11) NOT NULL,
  `no_suratkeluar` varchar(50) NOT NULL,
  `lampiran` text NOT NULL,
  `tujuan_surat` varchar(250) NOT NULL,
  `kode_klasifikasi` varchar(50) NOT NULL,
  `kepada` text NOT NULL,
  `perihal` text NOT NULL,
  `isi_surat` text NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `file_suratkeluar` varchar(250) NOT NULL,
  `ket_suratkeluar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_suratkeluar`
--

INSERT INTO `tb_suratkeluar` (`id_suratkeluar`, `no_suratkeluar`, `lampiran`, `tujuan_surat`, `kode_klasifikasi`, `kepada`, `perihal`, `isi_surat`, `tgl_surat`, `tgl_keluar`, `file_suratkeluar`, `ket_suratkeluar`) VALUES
(50, 'K', 'bubuk jahe', '2', 'K20 Saset', 'PT Nesva', '<p>&nbsp;</p>\r\n<quillbot-extension-portal></quillbot-extension-portal>', '<p>&nbsp;</p>\r\n<quillbot-extension-portal></quillbot-extension-portal>', '2023-06-28', '2023-06-27', 'TIDAK ADA FILE', ''),
(51, '', 'Bubuk jahe 100 gr', '100', 'K100', '', '', '', '0000-00-00', '2023-06-27', 'TIDAK ADA FILE', ''),
(52, '', 'Bubuk jahe 20gr', '5', 'K20', '', '', '', '0000-00-00', '2023-06-27', 'TIDAK ADA FILE', ''),
(53, '', 'Bubuk jahe 300gr', '10', 'K300', '', '', '', '0000-00-00', '2023-06-27', 'TIDAK ADA FILE', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_suratmasuk`
--

CREATE TABLE `tb_suratmasuk` (
  `id_suratmasuk` int(11) NOT NULL,
  `no_suratmasuk` varchar(50) NOT NULL,
  `no_agenda` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `kode_klasifikasi` varchar(50) NOT NULL,
  `isi_surat` text NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file_suratmasuk` varchar(250) NOT NULL,
  `ket_suratmasuk` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(1, 'samuel', '123123', 'Samuel Saragih', 'Admin'),
(8, 'samuel', '123123', 'samuel saragih', 'Admin'),
(9, 'staf', 'staf', 'riswan', 'Staf');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indeks untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  ADD PRIMARY KEY (`id_klasifikasi`);

--
-- Indeks untuk tabel `tb_suratkeluar`
--
ALTER TABLE `tb_suratkeluar`
  ADD PRIMARY KEY (`id_suratkeluar`);

--
-- Indeks untuk tabel `tb_suratmasuk`
--
ALTER TABLE `tb_suratmasuk`
  ADD PRIMARY KEY (`id_suratmasuk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  MODIFY `id_disposisi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_instansi`
--
ALTER TABLE `tb_instansi`
  MODIFY `id_instansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_klasifikasi`
--
ALTER TABLE `tb_klasifikasi`
  MODIFY `id_klasifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_suratkeluar`
--
ALTER TABLE `tb_suratkeluar`
  MODIFY `id_suratkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tb_suratmasuk`
--
ALTER TABLE `tb_suratmasuk`
  MODIFY `id_suratmasuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
