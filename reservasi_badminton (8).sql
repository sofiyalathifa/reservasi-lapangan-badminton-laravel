-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2026 at 12:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasi_badminton`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajak_mains`
--

CREATE TABLE `ajak_mains` (
  `id` bigint UNSIGNED NOT NULL,
  `id_cari_teman` bigint UNSIGNED NOT NULL,
  `pengirim_id` bigint UNSIGNED NOT NULL,
  `penerima_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ajak_mains`
--

INSERT INTO `ajak_mains` (`id`, `id_cari_teman`, `pengirim_id`, `penerima_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 5, 1, 'accepted', '2026-06-06 09:13:03', '2026-06-06 09:13:31'),
(4, 5, 1, 5, 'accepted', '2026-06-06 10:04:12', '2026-06-06 10:04:22'),
(5, 7, 5, 1, 'accepted', '2026-06-06 10:06:10', '2026-06-06 10:06:19'),
(6, 14, 23, 1, 'accepted', '2026-06-09 11:14:11', '2026-06-09 11:14:44'),
(7, 15, 1, 31, 'accepted', '2026-06-09 12:14:14', '2026-06-09 12:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_publikasi` date NOT NULL,
  `baca_menit` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `judul`, `slug`, `kategori`, `konten`, `gambar`, `tanggal_publikasi`, `baca_menit`, `created_at`, `updated_at`) VALUES
(1, 'Cara Meningkatkan Konsistensi Permainan Badminton', 'cara-meningkatkan-konsistensi-permainan-badminton-1780949674', 'Tips Bermain', '<div>Bermain badminton di level kompetitif maupun rekreasi membutuhkan konsistensi yang luar biasa. Banyak pemain amatir yang bisa melakukan smash keras satu atau dua kali, namun kehilangan ritme di sisa pertandingan. Kunci dari permainan yang baik bukanlah tentang seberapa keras Anda memukul, tetapi seberapa stabil performa Anda dari set pertama hingga terakhir.</div><div>1. Perbaiki Footwork (Langkah Kaki)</div><div>Footwork adalah fondasi dari segala pukulan dalam badminton. Jika langkah kaki Anda efisien, Anda tidak perlu mengeluarkan tenaga ekstra untuk menjangkau shuttlecock. Latihlah <strong>shadow badminton</strong> setidaknya 15 menit setiap sesi latihan. Pastikan Anda selalu kembali ke posisi tengah (base camp) setelah melakukan pukulan.</div><div>2. Latih Kontrol Pukulan Dasar</div><div>Jangan terburu-buru melatih pukulan tipuan (trick shot) sebelum pukulan dasar Anda matang. Beberapa pukulan yang wajib Anda kuasai dengan konsisten antara lain:</div><ul><li><strong>Clear / Lob:</strong> Pastikan kok melambung tinggi dan jatuh tegak lurus di garis belakang lawan.</li><li><strong>Drop Shot:</strong> Fokus pada presisi agar kok jatuh sedekat mungkin dengan net tanpa melayang terlalu lama.</li><li><strong>Netting:</strong> Latih sentuhan halus agar kok bergulir tipis di atas bibir net.</li></ul><div>3. Jaga Stamina dan Fokus</div><div>Konsistensi berbanding lurus dengan stamina. Ketika fisik mulai lelah, teknik akan mulai berantakan. Rutin lakukan latihan kardio seperti jogging atau skipping. Selain itu, belajarlah mengatur napas dan fokus pada satu poin demi satu poin, alih-alih terlalu memikirkan skor akhir.</div><div>Dengan menerapkan tiga pilar di atas secara disiplin, Anda akan melihat perubahan signifikan dalam kestabilan permainan Anda di lapangan. Selamat berlatih!</div>', 'banner.jpeg', '2026-06-12', 5, '2026-06-06 07:03:15', '2026-06-08 20:14:34'),
(2, 'Turnamen Badminton Lokal Segera Dimulai', 'turnamen-badminton-lokal-segera-dimulai', 'Turnamen', '\n                <p>Kabar gembira bagi para penggemar dan atlet badminton lokal! Turnamen Badminton Tahunan akan segera diselenggarakan pada akhir bulan ini. Turnamen ini bertujuan untuk menjaring bakat-bakat baru sekaligus menjadi ajang silaturahmi antar komunitas pecinta bulu tangkis di kota kita.</p>\n                \n                <h3>Kategori Pertandingan</h3>\n                <p>Turnamen kali ini akan mempertandingkan beberapa kategori, sehingga semua kalangan dapat berpartisipasi:</p>\n                <ul>\n                    <li>Ganda Putra (Kategori Pemula & Lanjutan)</li>\n                    <li>Ganda Putri (Kategori Umum)</li>\n                    <li>Ganda Campuran</li>\n                </ul>\n                \n                <h3>Syarat dan Ketentuan Pendaftaran</h3>\n                <p>Pendaftaran sudah dibuka mulai hari ini hingga dua minggu ke depan. Peserta diwajibkan mendaftar dalam kondisi sehat jasmani dan rohani. Biaya pendaftaran sudah termasuk fasilitas air minum, shuttlecock standar turnamen, serta P3K dasar di lapangan.</p>\n                \n                <p>Total hadiah puluhan juta rupiah beserta trofi dan medali telah disiapkan untuk para juara. Jangan lewatkan kesempatan emas ini untuk menguji kemampuan Anda dan meraih prestasi di tingkat lokal. Segera daftarkan tim Anda ke meja administrasi kami!</p>\n            ', 'berita1.jpeg', '2026-06-10', 3, '2026-06-06 07:03:15', '2026-06-06 07:03:15'),
(3, 'Tips Memilih Raket Berdasarkan Gaya Bermain', 'tips-memilih-raket-berdasarkan-gaya-bermain', 'Tips Bermain', '\n                <p>Sering kali pemain merasa permainannya tidak berkembang, padahal masalahnya mungkin ada pada peralatan yang digunakan. Raket badminton bukan sekadar alat pukul; ia adalah ekstensi dari lengan Anda. Memilih raket yang salah bisa mengakibatkan cedera bahu atau pergelangan tangan, serta mengurangi potensi pukulan Anda.</p>\n                \n                <h3>1. Head-Heavy (Berat di Kepala)</h3>\n                <p>Raket jenis ini sangat cocok bagi Anda yang berposisi sebagai penyerang (attacker) di garis belakang. Bobot ekstra di bagian frame membantu menghasilkan momentum ayunan yang lebih besar, sehingga pukulan smash akan terasa lebih tajam dan bertenaga. Namun, kekurangannya adalah kurang lincah untuk bermain di area depan (netting).</p>\n                \n                <h3>2. Head-Light (Ringan di Kepala)</h3>\n                <p>Berbanding terbalik dengan head-heavy, raket ini didesain untuk para pemain ganda yang mengandalkan kecepatan refleks dan permainan net. Raket ini sangat mudah diarahkan dan digerakkan dengan cepat, membuatnya ideal untuk melakukan drive cepat atau pertahanan (defense) dari gempuran smash lawan.</p>\n\n                <h3>3. Even-Balance (Seimbang)</h3>\n                <p>Jika Anda bermain tunggal atau Anda adalah pemain bertipe <em>all-around</em> yang memadukan serangan dan pertahanan secara seimbang, ini adalah pilihan paling aman. Anda mendapatkan kekuatan smash yang cukup tanpa terlalu mengorbankan kecepatan ayunan untuk bertahan.</p>\n            ', 'berita2.jpeg', '2026-06-08', 4, '2026-06-06 07:03:15', '2026-06-06 07:03:15'),
(4, 'Manfaat Bermain Badminton Bagi Kesehatan Jantung', 'manfaat-bermain-badminton-bagi-kesehatan-jantung', 'Kesehatan', '\n                <p>Banyak orang bermain badminton sekadar untuk mencari keringat atau bersosialisasi. Namun tahukah Anda bahwa olahraga ini memiliki dampak yang luar biasa bagi kesehatan kardiovaskular Anda?</p>\n                \n                <h3>1. Menurunkan Risiko Penyakit Jantung</h3>\n                <p>Bermain badminton secara rutin dapat meningkatkan sirkulasi darah dan menurunkan kadar kolesterol jahat (LDL). Gerakan dinamis dan konstan saat mengejar shuttlecock memaksa otot jantung untuk bekerja memompa darah lebih efisien.</p>\n\n                <h3>2. Membakar Kalori Secara Signifikan</h3>\n                <p>Dalam satu jam permainan dengan intensitas sedang, seorang dewasa dapat membakar hingga 450 kalori. Ini menjadikan badminton salah satu olahraga paling efektif untuk menjaga berat badan ideal, yang mana sangat berkaitan dengan kesehatan jantung.</p>\n\n                <h3>3. Mengurangi Stres</h3>\n                <p>Hormon endorfin yang dilepaskan saat Anda berhasil memukul bola atau memenangkan reli panjang sangat ampuh untuk mengusir stres. Ingat, tingkat stres yang rendah adalah kunci dari jantung yang sehat dan umur panjang!</p>\n            ', 'berita3.jpeg', '2026-06-05', 4, '2026-06-06 07:03:15', '2026-06-06 07:03:15'),
(5, 'Agenda Open Play Komunitas Minggu Ini', 'agenda-open-play-komunitas-minggu-ini', 'Komunitas', '\n                <p>Halo sobat tepok bulu! Akhir pekan ini komunitas kita akan kembali mengadakan sesi <em>Open Play</em> (Mabar - Main Bareng) yang terbuka untuk semua level kemampuan, mulai dari pemula hingga <em>advance</em>.</p>\n                \n                <h3>Jadwal dan Lokasi</h3>\n                <ul>\n                    <li><strong>Hari/Tanggal:</strong> Sabtu, 13 Juni 2026</li>\n                    <li><strong>Waktu:</strong> 18.00 - 22.00 WIB</li>\n                    <li><strong>Lokasi:</strong> GOR Badminton Utama (Lapangan 1, 2, dan 3)</li>\n                </ul>\n\n                <h3>Sistem Permainan</h3>\n                <p>Sistem akan menggunakan papan antrean bergilir. Pemain akan dipasangkan secara acak agar bisa saling mengenal. Shuttlecock sudah disediakan oleh panitia, jadi Anda hanya perlu membawa raket pribadi, sepatu *indoor*, dan baju ganti.</p>\n                \n                <p>Mari ramaikan GOR dan jadikan momen ini untuk memperluas jaringan pertemanan sesama pecinta badminton. Pendaftaran bisa langsung dilakukan di tempat (on the spot) sebelum jam 19.00 WIB.</p>\n            ', 'berita4.jpeg', '2026-06-02', 3, '2026-06-06 07:03:15', '2026-06-06 07:03:15'),
(6, 'Cara Merawat Sepatu Badminton Agar Awet', 'cara-merawat-sepatu-badminton-agar-awet', 'Tips & Trik', '\n                <p>Sepatu adalah \"senjata\" terpenting kedua setelah raket. Sepatu yang baik dapat mencegah cedera ankle dan memberikan cengkeraman maksimal. Namun, jika tidak dirawat dengan benar, sol karet sepatu bisa cepat aus atau mengeras.</p>\n                \n                <h3>1. Gunakan Hanya di Lapangan Indoor</h3>\n                <p>Ini adalah aturan emas! Jangan pernah menggunakan sepatu badminton Anda untuk berjalan di aspal, konblok, atau tanah. Debu, pasir, dan permukaan kasar akan langsung merusak pola karet *outsole* yang bertugas menjaga cengkeraman (grip).</p>\n\n                <h3>2. Keringkan dengan Angin (Air Dry)</h3>\n                <p>Setelah dipakai bermain, sepatu pasti basah oleh keringat. Jangan menjemurnya langsung di bawah terik matahari karena akan merusak lem dan membuat bahan kulit sintetisnya pecah-pecah. Cukup diangin-anginkan di tempat teduh atau letakkan koran bekas di dalamnya untuk menyerap kelembaban.</p>\n\n                <h3>3. Bersihkan Sol Secara Rutin</h3>\n                <p>Sesekali, seka bagian sol karet bawah dengan lap basah atau spons khusus untuk menghilangkan debu halus yang menempel. Debu adalah musuh utama sol sepatu, karena membuat sepatu menjadi sangat licin saat digunakan di lapangan karpet atau kayu.</p>\n            ', 'berita1.jpeg', '2026-05-28', 5, '2026-06-06 07:03:15', '2026-06-06 07:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `cari_temans`
--

CREATE TABLE `cari_temans` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `level_kemampuan` enum('Beginner','Intermediate','Advanced') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaya_bermain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cari_temans`
--

INSERT INTO `cari_temans` (`id`, `id_pengguna`, `level_kemampuan`, `lokasi`, `gaya_bermain`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'Intermediate', 'sidoarjo', 'hai', 0, '2026-06-06 09:12:35', '2026-06-06 10:05:26'),
(4, 5, 'Beginner', 'sidoarjo', 'salsabila', 0, '2026-06-06 09:19:06', '2026-06-06 10:03:11'),
(5, 5, 'Beginner', 'surabaya', 'tes', 0, '2026-06-06 10:04:02', '2026-06-06 10:04:44'),
(6, 1, 'Beginner', 'sd', 'sd', 0, '2026-06-06 10:05:45', '2026-06-06 10:05:46'),
(7, 1, 'Beginner', 'sidoarjo', 'sd', 0, '2026-06-06 10:05:56', '2026-06-06 20:29:36'),
(8, 5, 'Beginner', 'sidoarjo', 'hayy', 0, '2026-06-06 20:21:52', '2026-06-06 20:22:59'),
(9, 1, 'Beginner', 'jakarta', 'halo hai', 0, '2026-06-06 20:32:20', '2026-06-06 20:34:18'),
(10, 5, 'Intermediate', 'sidoarjo', 'gdfgdf', 0, '2026-06-06 20:49:17', '2026-06-06 20:49:39'),
(11, 5, 'Beginner', 'sidoarjo', 'adasdasd', 0, '2026-06-06 20:49:47', '2026-06-09 08:00:19'),
(12, 1, 'Intermediate', 'sd', 'teds', 0, '2026-06-06 20:50:52', '2026-06-09 08:04:52'),
(13, 5, 'Beginner', 'Rungkut, Sidoarjo', 'Mencari partner untuk bertanding santai dan dengan kemampuan yang sama', 1, '2026-06-09 08:01:15', '2026-06-09 08:01:15'),
(14, 1, 'Intermediate', 'Buduran, Surabaya', 'Mencari partner untuk sparring bareng di daerah Surabaya dan sekitarnya', 1, '2026-06-09 08:06:05', '2026-06-09 08:06:05'),
(15, 31, 'Beginner', 'sidoarjo', 'halo', 1, '2026-06-09 12:14:02', '2026-06-09 12:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` varchar(255) NOT NULL,
  `nama_lapangan` varchar(100) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `fasilitas` varchar(255) DEFAULT NULL,
  `jenis_lantai` varchar(50) NOT NULL,
  `harga_per_jam` int NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `status` enum('tersedia','perbaikan') NOT NULL,
  `rating` decimal(2,1) DEFAULT '0.0',
  `jumlah_ulasan` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `foto`, `deskripsi`, `fasilitas`, `jenis_lantai`, `harga_per_jam`, `jam_buka`, `jam_tutup`, `status`, `rating`, `jumlah_ulasan`) VALUES
('LP001', 'Lapangan A1', 'lap1.jpeg', 'Court premium dengan standar profesional, sangat cocok untuk turnamen, latihan intensif, maupun fun match bersama kolega.', 'Lantai Premium,Lampu LED 1000 Lux,Ruang Ganti AC,Area Tunggu Nyaman,Kantin,Loker', 'Vinly', 85000, '06:00:00', '22:00:00', 'tersedia', '0.0', 0),
('LP002', 'Lapangan A2', 'lap2.jpeg', 'Court premium dengan standar profesional, sangat cocok untuk turnamen, latihan intensif, maupun fun match bersama kolega.', 'Lantai Premium,Lampu LED 1000 Lux,Ruang Ganti AC,Area Tunggu Nyaman,Kantin,Loker', 'Vinly', 85000, '06:00:00', '22:00:00', 'tersedia', '5.0', 2),
('LP006', 'Lapangan B2', 'lap3.jpeg', 'Court premium dengan standar profesional, sangat cocok untuk turnamen, latihan intensif, maupun fun match bersama kolega.', 'Lantai Premium,Lampu LED 1000 Lux,Ruang Ganti AC,Area Tunggu Nyaman,Kantin,Loker', 'Karpet', 75000, '06:00:00', '22:00:00', 'tersedia', '3.0', 1),
('LP008', 'Lapangan C1', 'lap4.jpeg', 'Court premium dengan standar profesional, sangat cocok untuk turnamen, latihan intensif, maupun fun match bersama kolega.', 'Lantai Premium,Lampu LED 1000 Lux,Ruang Ganti AC,Area Tunggu Nyaman,Kantin,Loker', 'Kayu', 70000, '06:00:00', '22:00:00', 'tersedia', '5.0', 2),
('LP009', 'Lapangan C2', 'lap5.jpeg', 'Court premium dengan standar profesional, sangat cocok untuk turnamen, latihan intensif, maupun fun match bersama kolega.', 'Lantai Premium,Lampu LED 1000 Lux,Ruang Ganti AC,Area Tunggu Nyaman,Kantin,Loker', 'Kayu', 70000, '06:00:00', '22:00:00', 'tersedia', '0.0', 0),
('LP016', 'Lapangan VIP1', 'lap1.jpeg', 'Court premium dengan standar profesional, sangat cocok untuk turnamen, latihan intensif, maupun fun match bersama kolega.', 'Lantai Premium,Lampu LED 1000 Lux,Ruang Ganti AC,Area Tunggu Nyaman,Kantin,Loker', 'Vinly Ori', 120000, '06:00:00', '22:00:00', 'tersedia', '0.0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_06_05_181301_modify_id_pengguna_in_reservasi_table', 2),
(6, '2026_06_05_182127_create_lapangan_table', 3),
(7, '2026_06_05_182216_create_reservasi_table', 3),
(8, '2026_06_05_182219_create_pembayaran_table', 3),
(9, '2026_06_06_074510_add_details_to_lapangan_table', 3),
(10, '2026_06_06_075058_add_foto_to_lapangan_table', 4),
(11, '2026_06_06_075536_add_rating_to_lapangan_table', 5),
(12, '2026_06_06_085333_add_role_to_users_table', 6),
(13, '2026_06_06_121845_create_ulasans_table', 7),
(14, '2026_06_06_133907_create_beritas_table', 8),
(15, '2026_06_06_141533_create_promos_table', 9),
(16, '2026_06_06_141534_add_promo_fields_to_reservasis_table', 10),
(17, '2026_06_06_145947_add_limit_columns_to_promos_table', 11),
(18, '2026_06_06_151242_add_min_requirements_to_promos_table', 12),
(19, '2026_06_06_152120_add_time_constraints_to_promos_table', 13),
(20, '2026_06_06_160329_create_cari_temans_table', 14),
(21, '2026_06_06_160330_create_ajak_mains_table', 15),
(22, '2026_06_06_160331_create_pesan_komunitas_table', 15),
(23, '2026_06_07_042735_create_pelatihs_table', 16),
(24, '2026_06_07_042858_add_id_pelatih_to_reservasi_table', 16),
(25, '2026_06_07_135949_update_role_enum_in_users_table', 17),
(26, '2026_06_08_171733_add_nomor_telepon_to_users_table', 18),
(27, '2026_06_08_175453_drop_pengguna_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelatihs`
--

CREATE TABLE `pelatihs` (
  `id_pelatih` bigint UNSIGNED NOT NULL,
  `nama_pelatih` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesialisasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_level` enum('Beginner','Intermediate','Advanced') COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_per_sesi` int NOT NULL,
  `rating` decimal(3,1) NOT NULL DEFAULT '0.0',
  `foto_pelatih` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelatihs`
--

INSERT INTO `pelatihs` (`id_pelatih`, `nama_pelatih`, `spesialisasi`, `target_level`, `harga_per_sesi`, `rating`, `foto_pelatih`, `deskripsi`, `status_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Coach Ardi', 'Footwork & Singles', 'Advanced', 150000, '4.9', NULL, 'Fokus pada peningkatan kecepatan langkah dan teknik tunggal putra/putri.', 1, '2026-06-06 21:39:09', '2026-06-06 21:39:09'),
(2, 'Coach Lena', 'Beginner Clinic', 'Beginner', 100000, '4.8', NULL, 'Latihan dasar genggaman raket, pukulan dasar, dan pengenalan lapangan untuk pemula.', 1, '2026-06-06 21:39:09', '2026-06-09 07:58:58'),
(3, 'Coach Steve', 'Footwork & Singles', 'Advanced', 150000, '4.9', NULL, 'Fokus pada peningkatan kecepatan langkah dan teknik tunggal putra/putri.', 0, '2026-06-06 21:40:20', '2026-06-09 11:53:28'),
(4, 'Coach Nabila', 'Beginner Clinic', 'Beginner', 100000, '4.8', NULL, 'Latihan dasar genggaman raket, pukulan dasar, dan pengenalan lapangan untuk pemula.', 0, '2026-06-06 21:40:20', '2026-06-09 11:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(255) NOT NULL,
  `id_reservasi` varchar(255) NOT NULL,
  `metode_pembayaran` enum('QRIS','Transfer','Cash') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `status_pembayaran` enum('pending','lunas','DP') NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `id_admin_verifikasi` varchar(255) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `verification_note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_reservasi`, `metode_pembayaran`, `jumlah_bayar`, `tanggal_bayar`, `status_pembayaran`, `bukti_pembayaran`, `id_admin_verifikasi`, `verified_at`, `verification_note`) VALUES
('PAY-20260606-3ATO', 'RES-20260612-4KGL', 'Transfer', '70000.00', '2026-06-06 08:23:02', 'lunas', 'bukti_bayar/qd252ZHdqslTzKyrpk6kZEqRZ0z3QPGwNvGnMILH.png', '6', '2026-06-07 22:56:19', NULL),
('PAY-20260606-C7O1', 'RES-20260609-HE95', 'Transfer', '85000.00', '2026-06-06 08:22:16', 'lunas', 'bukti_bayar/KAr0oFnO4qmmuDJL4J1vrRn0wD3uZ9lj4rF3OEoI.png', '6', '2026-06-07 22:56:27', NULL),
('PAY-20260606-EASO', 'RES-20260606-1HJD', 'Transfer', '85000.00', '2026-06-06 08:31:13', 'lunas', 'bukti_bayar/ldwlCNoC12GIghM9W08JHtW2QvI4xSSy4XGuKXOl.png', '1', '2026-06-06 19:03:00', 'oke'),
('PAY-20260606-JCA6', 'RES-20260612-8BJM', 'Transfer', '85000.00', '2026-06-06 12:41:10', 'lunas', 'bukti_bayar/jfB05nDIQWcnBU2mz0SEUxWeOkvu5FAwiGkzQKEx.png', '6', '2026-06-07 22:50:08', NULL),
('PAY-20260606-LPPL', 'RES-20260612-ZNM3', 'Transfer', '85000.00', '2026-06-06 08:35:05', 'lunas', 'bukti_bayar/770JZzZE5kLAcYZyzjLGotXfuFNXrwNmiOoT3PEs.png', '6', '2026-06-07 22:50:13', NULL),
('PAY-20260606-MHKL', 'RES-20260606-0S3H', 'Transfer', '340000.00', '2026-06-06 06:27:19', 'lunas', 'bukti_bayar/5VtKCV7FZPZuT1wUZgpqjz2AORZSb4a9pza8NZ7R.png', '6', '2026-06-07 22:59:59', NULL),
('PAY-20260606-TLVJ', 'RES-20260606-JQPS', 'Transfer', '85000.00', '2026-06-06 06:28:31', 'lunas', 'bukti_bayar/LA5VbLuvZ4Iuy6wbqZOElipE6mZKSgVpRdnBdkRM.png', '6', '2026-06-07 22:59:22', NULL),
('PAY-20260606-U2BU', 'RES-20260609-NEDA', 'Transfer', '75000.00', '2026-06-06 08:33:08', 'lunas', 'bukti_bayar/sxVmqTzpIm3xaN5LS5WhAPx3Flxt4cS3dsv2yHGL.png', '6', '2026-06-07 22:53:30', NULL),
('PAY-20260607-GVZY', 'RES-20260607-AI9J', 'Transfer', '175000.00', '2026-06-07 05:23:44', 'lunas', 'bukti_bayar/xDJ7JIVk2RMQU6ZLD1q6C4Q3yLzO7qomKO0QvQrg.png', '6', '2026-06-07 22:48:19', NULL),
('PAY-20260609-7Z3Z', 'RES-20260610-ZGVC', 'Transfer', '225000.00', '2026-06-09 18:13:51', 'lunas', 'bukti_bayar/pSWQfs79XEAJV53W9KkASEHIsYFKxXGP9uIFzbrE.jpg', '2', '2026-06-09 18:19:40', NULL),
('PAY-20260609-EUYC', 'RES-20260609-RDSD', 'Transfer', '75000.00', '2026-06-09 09:55:02', 'lunas', 'bukti_bayar/Cuxl5CS42Jpq3W6VXvhHFgiDmjBSKmjfcBH8AZV9.jpg', '2', '2026-06-09 09:57:30', NULL),
('PAY-20260609-GUAB', 'RES-20260610-RQ2D', 'Transfer', '176250.00', '2026-06-09 18:48:36', 'lunas', 'bukti_bayar/9XgQs7hLrJf9LLYdv42gmHYtEYNmkU3fzR1wGcOA.jpg', '6', '2026-06-09 18:51:40', NULL),
('PAY-20260609-HT6C', 'RES-20260609-HWJZ', 'Transfer', '42500.00', '2026-06-09 07:12:22', 'DP', 'bukti_bayar/GwAlw6Wi24eL0DsOZHQqnU1nmXSuYrwgkXX18b9P.jpg', '2', '2026-06-09 07:20:56', NULL),
('PAY-20260609-HX8A', 'RES-20260609-EMPO', 'Transfer', '70000.00', '2026-06-09 10:51:47', 'lunas', 'bukti_bayar/hFna8c0lBkzXm84YY90P8axAWDZGGLhZHeAr24BD.jpg', '2', '2026-06-09 10:52:29', NULL),
('PAY-20260609-IVIG', 'RES-20260609-0K1Z', 'Transfer', '170000.00', '2026-06-09 15:31:58', 'lunas', 'bukti_bayar/OVL06bdrDZSZLzOwmPdlZZHv4vkpifnVsyeuUdlL.jpg', '2', '2026-06-09 18:52:50', NULL),
('PAY-20260609-JNIE', 'RES-20260611-8WFO', 'Transfer', '165000.00', '2026-06-09 19:12:50', 'lunas', 'bukti_bayar/7lbAFvM1kvNx7X9AIb5IfrZWnMpNFXcifPdyu6ml.jpg', '2', '2026-06-09 19:16:24', NULL),
('PAY-20260609-VS5L', 'RES-20260609-YUZ5', 'Transfer', '470000.00', '2026-06-09 10:57:54', 'lunas', 'bukti_bayar/UH0UOEzaUMi2eZItldx8dk4BrFXmUa7nqlNLLuwM.jpg', '6', '2026-06-09 11:00:09', NULL),
('PAY-6A25D9902FA83', 'RES-6A25D9902D8A1', 'Cash', '280000.00', '2026-06-07 20:50:24', 'lunas', 'offline_payment', '6', '2026-06-08 07:20:55', 'Booking Offline di Kasir'),
('PAY-6A25D9A02093A', 'RES-6A25D9A01ED13', 'Cash', '75000.00', '2026-06-07 20:50:40', 'lunas', 'offline_payment', '6', '2026-06-08 00:04:50', 'Booking Offline di Kasir'),
('PAY-6A25F9910887A', 'RES-20260606-SL5N', 'Cash', '35000.00', '2026-06-07 23:06:57', 'lunas', 'offline_payment', '6', '2026-06-07 23:06:57', 'Bayar Tunai di Kasir (Dari Pesanan Online)'),
('PAY-6A25F9C04D9A1', 'RES-20260607-HBAH', 'Cash', '140000.00', '2026-06-07 23:07:44', 'lunas', 'offline_payment', '6', '2026-06-08 07:20:36', 'Bayar Tunai di Kasir (Dari Pesanan Online)'),
('PAY-6A25FB07177C1', 'RES-20260611-XA1I', 'Cash', '85000.00', '2026-06-07 23:13:11', 'lunas', 'offline_payment', '6', '2026-06-08 00:08:50', 'Proses Bayar Tunai di Kasir'),
('PAY-6A25FCBE0C043', 'RES-6A25FCBE0A2F8', 'Cash', '70000.00', '2026-06-07 23:20:30', 'lunas', 'offline_payment', '6', '2026-06-08 00:08:42', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A25FFFE01D14', 'RES-6A25FFFE005D2', 'Cash', '85000.00', '2026-06-07 23:34:22', 'lunas', 'offline_payment', '6', '2026-06-08 07:20:44', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A2606D17A576', 'RES-6A2606D178D91', 'Cash', '85000.00', '2026-06-08 00:03:29', 'lunas', 'offline_payment', '6', '2026-06-08 07:20:42', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A26EDB94B120', 'RES-6A26EDB94A754', 'Cash', '42500.00', '2026-06-08 16:28:41', 'DP', 'offline_payment', '2', '2026-06-09 07:19:42', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A2753110947B', 'RES-6A27531107620', 'Cash', '42500.00', '2026-06-09 06:41:05', 'DP', 'offline_payment', '2', '2026-06-09 07:13:29', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A278294D792E', 'RES-6A278294D68F9', 'Cash', '120000.00', '2026-06-09 10:03:48', 'lunas', 'offline_payment', '6', '2026-06-09 10:04:42', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A27F645C47B0', 'RES-6A27F645C2525', 'Cash', '85000.00', '2026-06-09 18:17:25', 'lunas', 'offline_payment', '6', '2026-06-09 18:17:39', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A27FE2239896', 'RES-6A27FE22380F6', 'Cash', '170000.00', '2026-06-09 18:50:58', 'lunas', 'offline_payment', '6', '2026-06-09 18:51:14', 'Booking Offline Kasir - Menunggu Pembayaran'),
('PAY-6A2804B4103EB', 'RES-6A2804B40F8A4', 'Cash', '170000.00', '2026-06-09 19:19:00', 'lunas', 'offline_payment', '6', '2026-06-09 19:19:11', 'Booking Offline Kasir - Menunggu Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_komunitas`
--

CREATE TABLE `pesan_komunitas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_ajak_main` bigint UNSIGNED NOT NULL,
  `pengirim_id` bigint UNSIGNED NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesan_komunitas`
--

INSERT INTO `pesan_komunitas` (`id`, `id_ajak_main`, `pengirim_id`, `pesan`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'ayo gas main', 1, '2026-06-06 09:14:13', '2026-06-09 08:38:55'),
(2, 3, 5, 'lah gue mah ayo aja', 1, '2026-06-06 09:14:24', '2026-06-09 11:15:16'),
(3, 3, 5, 'alah lu omdo kalik', 1, '2026-06-06 09:14:41', '2026-06-09 11:15:16'),
(4, 3, 1, 'siapa sih ini baru kenal belagu', 1, '2026-06-06 09:14:49', '2026-06-09 08:38:55'),
(5, 3, 1, 'hai brok', 1, '2026-06-06 09:19:41', '2026-06-09 08:38:55'),
(6, 3, 5, 'yooo', 1, '2026-06-06 09:19:58', '2026-06-09 11:15:16'),
(7, 3, 1, 'tes', 1, '2026-06-06 09:25:11', '2026-06-09 08:38:55'),
(8, 3, 1, 'ya', 1, '2026-06-06 09:25:16', '2026-06-09 08:38:55'),
(9, 3, 1, 'hem', 1, '2026-06-06 09:25:23', '2026-06-09 08:38:55'),
(10, 3, 1, 'tes', 1, '2026-06-06 09:27:09', '2026-06-09 08:38:55'),
(11, 3, 1, 'ga jawab sih', 1, '2026-06-06 09:27:14', '2026-06-09 08:38:55'),
(12, 3, 1, 'lalu saat saya enter pesan', 1, '2026-06-06 09:38:10', '2026-06-09 08:38:55'),
(13, 3, 1, 'tes', 1, '2026-06-06 09:39:55', '2026-06-09 08:38:55'),
(14, 3, 1, 'tes', 1, '2026-06-06 09:40:32', '2026-06-09 08:38:55'),
(15, 3, 1, 'tes', 1, '2026-06-06 09:40:37', '2026-06-09 08:38:55'),
(16, 3, 1, 'tes', 1, '2026-06-06 09:41:17', '2026-06-09 08:38:55'),
(17, 3, 1, 'tes', 1, '2026-06-06 09:42:42', '2026-06-09 08:38:55'),
(18, 3, 1, 'yeh', 1, '2026-06-06 09:43:15', '2026-06-09 08:38:55'),
(19, 3, 1, 'hee', 1, '2026-06-06 09:43:23', '2026-06-09 08:38:55'),
(20, 3, 1, 'tes', 1, '2026-06-06 09:44:22', '2026-06-09 08:38:55'),
(21, 3, 5, 'YEH', 1, '2026-06-06 09:44:42', '2026-06-09 11:15:16'),
(22, 3, 1, 'tes', 1, '2026-06-06 09:45:52', '2026-06-09 08:38:55'),
(23, 3, 1, 'tes', 1, '2026-06-06 09:45:56', '2026-06-09 08:38:55'),
(24, 3, 1, 'tes', 1, '2026-06-06 09:47:08', '2026-06-09 08:38:55'),
(25, 3, 1, 'tes', 1, '2026-06-06 09:48:44', '2026-06-09 08:38:55'),
(26, 3, 1, 'tes', 1, '2026-06-06 09:48:46', '2026-06-09 08:38:55'),
(27, 3, 1, 'tes', 1, '2026-06-06 09:48:49', '2026-06-09 08:38:55'),
(28, 3, 1, 'tes', 1, '2026-06-06 09:48:53', '2026-06-09 08:38:55'),
(29, 3, 1, 'tes', 1, '2026-06-06 09:49:11', '2026-06-09 08:38:55'),
(30, 3, 1, 'tes', 1, '2026-06-06 09:50:25', '2026-06-09 08:38:55'),
(31, 3, 1, 'tes', 1, '2026-06-06 09:50:36', '2026-06-09 08:38:55'),
(32, 3, 1, 'tes', 1, '2026-06-06 09:51:49', '2026-06-09 08:38:55'),
(33, 3, 1, 'tes', 1, '2026-06-06 09:57:03', '2026-06-09 08:38:55'),
(34, 3, 1, 'hai', 1, '2026-06-06 09:57:05', '2026-06-09 08:38:55'),
(35, 3, 1, 'halo', 1, '2026-06-06 09:57:07', '2026-06-09 08:38:55'),
(36, 3, 1, 'tes', 1, '2026-06-06 09:59:02', '2026-06-09 08:38:55'),
(37, 3, 1, 'hheehe😭', 1, '2026-06-06 09:59:52', '2026-06-09 08:38:55'),
(38, 3, 1, 'tes', 1, '2026-06-06 10:02:54', '2026-06-09 08:38:55'),
(39, 3, 1, '💔💔', 1, '2026-06-06 10:03:01', '2026-06-09 08:38:55'),
(40, 3, 1, 'tes', 1, '2026-06-06 10:03:41', '2026-06-09 08:38:55'),
(41, 4, 5, 'tes', 1, '2026-06-06 10:04:30', '2026-06-09 08:37:11'),
(42, 5, 5, 'hi', 1, '2026-06-06 20:29:25', '2026-06-09 11:49:52'),
(43, 4, 5, 'hey', 1, '2026-06-06 20:32:32', '2026-06-09 08:37:11'),
(44, 5, 1, 'selamat siang, yuk main bareng', 1, '2026-06-09 08:38:22', '2026-06-09 11:49:43'),
(45, 5, 5, 'boleh, atur jadwal saja', 1, '2026-06-09 08:39:34', '2026-06-09 11:49:52'),
(46, 6, 23, 'adhajbsdasd', 1, '2026-06-09 11:14:59', '2026-06-09 11:15:21'),
(47, 5, 1, 'hai', 1, '2026-06-09 11:49:15', '2026-06-09 11:49:43'),
(48, 7, 1, 'hai', 1, '2026-06-09 12:14:31', '2026-06-09 12:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_promo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_promo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_diskon` enum('persen','nominal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_diskon` int NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `kuota_total` int DEFAULT NULL COMMENT 'Maksimal kuota global. Null = tanpa batas',
  `batas_per_user` int DEFAULT NULL COMMENT 'Maksimal pemakaian per user. Null = tanpa batas',
  `tanggal_berakhir` date DEFAULT NULL COMMENT 'Tgl kedaluwarsa promo. Null = selamanya',
  `min_durasi` int DEFAULT NULL COMMENT 'Minimal durasi pemesanan (jam)',
  `min_total_harga` int DEFAULT NULL COMMENT 'Minimal total harga pesanan (Rp)',
  `jam_mulai_berlaku` time DEFAULT NULL COMMENT 'Batas awal jam (contoh: 10:00:00)',
  `jam_selesai_berlaku` time DEFAULT NULL COMMENT 'Batas akhir jam (contoh: 15:00:00)',
  `hari_berlaku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'weekend, weekday, atau null (semua hari)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `nama_promo`, `kode_promo`, `deskripsi`, `tipe_diskon`, `nilai_diskon`, `tag`, `status`, `kuota_total`, `batas_per_user`, `tanggal_berakhir`, `min_durasi`, `min_total_harga`, `jam_mulai_berlaku`, `jam_selesai_berlaku`, `hari_berlaku`, `created_at`, `updated_at`) VALUES
(1, 'Happy Hour Weekday', 'HAPPY25', 'Dapatkan diskon 25% untuk booking lapangan pada pukul 10.00–15.00.', 'persen', 25, 'HEMAT', 1, NULL, NULL, NULL, NULL, NULL, '10:00:00', '15:00:00', 'weekday', '2026-06-06 08:23:54', '2026-06-06 08:23:54'),
(2, 'Paket Main + Pelatih', 'COACHPLAY', 'Potongan harga Rp30.000 untuk pemesanan lapangan sekaligus pelatih dengan durasi minimal dua jam.', 'nominal', 30000, 'FAVORIT', 0, NULL, NULL, '2026-06-19', NULL, NULL, NULL, NULL, 'semua', '2026-06-06 08:23:54', '2026-06-08 20:00:20'),
(3, 'Member Referral', 'REFER50', 'Ajak teman untuk bergabung dan dapatkan voucher booking senilai Rp50.000 (Khusus 1x pemakaian per akun).', 'nominal', 50000, 'BARU', 0, NULL, 1, '2026-06-04', NULL, NULL, NULL, NULL, 'semua', '2026-06-06 08:23:54', '2026-06-08 20:02:42'),
(4, 'Diskon Mahasiswa', 'MHS20', 'Tunjukkan kartu tanda mahasiswa (KTM) aktif Anda untuk mendapat diskon 20% (Terbatas untuk 50 pemesan pertama).', 'persen', 20, 'PELAJAR', 0, 50, NULL, '2026-06-04', NULL, NULL, NULL, NULL, 'semua', '2026-06-06 08:23:54', '2026-06-08 20:02:52'),
(5, 'Weekend Seru', 'WEEKENDFUN', 'Potongan harga Rp25.000 khusus untuk pemesanan hari Sabtu dan Minggu pagi (Promo telah berakhir).', 'nominal', 25000, 'WEEKEND', 0, NULL, NULL, '2026-06-04', NULL, NULL, NULL, NULL, 'weekend', '2026-06-06 08:23:54', '2026-06-08 20:02:59'),
(6, 'Ganda Campuran', 'MIXMATCH', 'Ajak pasangan bermain ganda campuran dan nikmati potongan diskon 15%.', 'persen', 15, 'SPESIAL', 0, NULL, NULL, '2026-06-04', NULL, NULL, NULL, NULL, 'semua', '2026-06-06 08:23:54', '2026-06-08 20:03:05'),
(7, 'Pagi Bugar', 'MORNINGFIT', 'Diskon Rp40.000 untuk sesi bermain di bawah jam 09.00 WIB setiap harinya.', 'nominal', 40000, 'PAGI', 1, NULL, NULL, NULL, NULL, NULL, NULL, '09:00:00', NULL, '2026-06-06 08:23:54', '2026-06-06 08:23:54'),
(8, 'Main Puas', 'LONGPLAY', 'Dapatkan potongan harga Rp35.000 khusus untuk pemesanan lebih dari 2 Jam.', 'nominal', 35000, 'LOYAL', 1, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, '2026-06-06 08:23:54', '2026-06-06 08:23:54'),
(9, 'Pesta Olahraga', 'BIGMATCH', 'Diskon 10% untuk transaksi besar dengan total pemesanan di atas Rp 300.000.', 'persen', 10, 'BIG SALE', 1, NULL, NULL, NULL, NULL, 300001, NULL, NULL, NULL, '2026-06-06 08:23:54', '2026-06-06 08:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` varchar(255) NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `id_lapangan` varchar(255) NOT NULL,
  `id_pelatih` bigint UNSIGNED DEFAULT NULL,
  `tanggal_booking` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `durasi` int NOT NULL,
  `total_biaya` decimal(10,2) NOT NULL,
  `status_reservasi` enum('pending','dikonfirmasi','dibatalkan') NOT NULL,
  `kode_promo` varchar(255) DEFAULT NULL,
  `diskon` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_pengguna`, `id_lapangan`, `id_pelatih`, `tanggal_booking`, `jam_mulai`, `jam_selesai`, `durasi`, `total_biaya`, `status_reservasi`, `kode_promo`, `diskon`, `created_at`) VALUES
('RES-20260606-0S3H', 1, 'LP001', NULL, '2026-06-06', '08:00:00', '12:00:00', 4, '340000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:59:59'),
('RES-20260606-1HJD', 1, 'LP002', NULL, '2026-06-06', '11:00:00', '12:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-06 12:03:42'),
('RES-20260606-JHF6', 1, 'LP001', NULL, '2026-06-06', '14:00:00', '15:00:00', 1, '85000.00', 'dibatalkan', NULL, 0, '2026-06-06 10:21:55'),
('RES-20260606-JQPS', 1, 'LP001', NULL, '2026-06-06', '12:00:00', '13:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:59:22'),
('RES-20260606-SL5N', 1, 'LP006', NULL, '2026-06-06', '16:00:00', '17:00:00', 1, '35000.00', 'dikonfirmasi', 'MORNINGFIT', 40000, '2026-06-07 23:06:57'),
('RES-20260607-AI9J', 5, 'LP006', 2, '2026-06-07', '10:00:00', '11:00:00', 1, '175000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:48:19'),
('RES-20260607-HBAH', 5, 'LP008', NULL, '2026-06-07', '12:00:00', '14:00:00', 2, '140000.00', 'dikonfirmasi', NULL, 0, '2026-06-08 00:08:46'),
('RES-20260609-0K1Z', 1, 'LP008', 2, '2026-06-09', '16:00:00', '17:00:00', 1, '170000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 11:52:50'),
('RES-20260609-57FU', 5, 'LP006', NULL, '2026-06-09', '11:00:00', '15:00:00', 4, '300000.00', 'pending', NULL, 0, '2026-06-08 19:32:23'),
('RES-20260609-BVOO', 5, 'LP009', NULL, '2026-06-09', '15:00:00', '17:00:00', 2, '140000.00', 'pending', NULL, 0, '2026-06-09 07:54:58'),
('RES-20260609-EE05', 5, 'LP001', NULL, '2026-06-09', '08:00:00', '09:00:00', 1, '85000.00', 'pending', NULL, 0, '2026-06-08 19:35:08'),
('RES-20260609-EMPO', 5, 'LP008', NULL, '2026-06-09', '11:00:00', '12:00:00', 1, '70000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 03:52:29'),
('RES-20260609-HE95', 1, 'LP001', NULL, '2026-06-09', '09:00:00', '10:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:56:27'),
('RES-20260609-HWJZ', 5, 'LP002', NULL, '2026-06-09', '08:00:00', '09:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 00:12:50'),
('RES-20260609-M4HQ', 5, 'LP001', NULL, '2026-06-09', '13:00:00', '14:00:00', 1, '85000.00', 'pending', NULL, 0, '2026-06-08 09:23:37'),
('RES-20260609-NEDA', 1, 'LP006', NULL, '2026-06-09', '10:00:00', '11:00:00', 1, '75000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:53:30'),
('RES-20260609-RDSD', 23, 'LP006', NULL, '2026-06-09', '15:00:00', '16:00:00', 1, '75000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 02:57:30'),
('RES-20260609-SALV', 23, 'LP001', NULL, '2026-06-09', '10:00:00', '12:00:00', 2, '170000.00', 'pending', NULL, 0, '2026-06-09 03:00:49'),
('RES-20260609-YUZ5', 5, 'LP001', 1, '2026-06-09', '15:00:00', '17:00:00', 2, '470000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 04:00:09'),
('RES-20260610-RQ2D', 1, 'LP001', 1, '2026-06-10', '10:00:00', '11:00:00', 1, '176250.00', 'dikonfirmasi', 'HAPPY25', 58750, '2026-06-09 11:51:41'),
('RES-20260610-ZGVC', 23, 'LP006', 1, '2026-06-10', '08:00:00', '09:00:00', 1, '225000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 11:19:40'),
('RES-20260611-8WFO', 1, 'LP009', 1, '2026-06-11', '10:00:00', '11:00:00', 1, '165000.00', 'dikonfirmasi', 'HAPPY25', 55000, '2026-06-09 12:16:24'),
('RES-20260611-XA1I', 1, 'LP002', NULL, '2026-06-11', '16:00:00', '17:00:00', 1, '85000.00', 'dibatalkan', NULL, 0, '2026-06-09 08:32:43'),
('RES-20260611-ZNM1', 1, 'LP008', NULL, '2026-06-11', '12:00:00', '14:00:00', 2, '100000.00', 'pending', 'MORNINGFIT', 40000, '2026-06-06 08:17:17'),
('RES-20260612-4KGL', 1, 'LP008', NULL, '2026-06-12', '12:00:00', '13:00:00', 1, '70000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:56:19'),
('RES-20260612-8BJM', 1, 'LP002', NULL, '2026-06-12', '11:00:00', '12:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:50:08'),
('RES-20260612-TJWY', 5, 'LP002', NULL, '2026-06-12', '10:00:00', '13:00:00', 3, '255000.00', 'dibatalkan', NULL, 0, '2026-06-09 04:02:08'),
('RES-20260612-ZNM3', 1, 'LP002', NULL, '2026-06-12', '12:00:00', '13:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 22:50:13'),
('RES-6A257FBD1AF06', 8, 'LP006', NULL, '2026-06-24', '21:30:00', '00:30:00', 3, '20000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 07:27:09'),
('RES-6A25D8B4D48D0', 1, 'LP008', NULL, '2026-06-08', '09:00:00', '13:00:00', 4, '280000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 13:46:44'),
('RES-6A25D9902D8A1', 1, 'LP008', NULL, '2026-06-08', '09:00:00', '13:00:00', 4, '280000.00', 'dikonfirmasi', NULL, 0, '2026-06-07 13:50:24'),
('RES-6A25D9A01ED13', 9, 'LP006', NULL, '2026-06-08', '09:00:00', '10:00:00', 1, '75000.00', 'dikonfirmasi', NULL, 0, '2026-06-08 00:04:50'),
('RES-6A25FB1F2ED91', 10, 'LP001', NULL, '2026-06-09', '14:00:00', '15:00:00', 1, '85000.00', 'pending', NULL, 0, '2026-06-07 23:21:49'),
('RES-6A25FCBE0A2F8', 11, 'LP008', NULL, '2026-06-13', '12:00:00', '13:00:00', 1, '70000.00', 'dikonfirmasi', NULL, 0, '2026-06-08 00:08:42'),
('RES-6A25FFFE005D2', 12, 'LP001', NULL, '2026-06-11', '19:00:00', '20:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-08 00:03:41'),
('RES-6A2606D178D91', 13, 'LP001', NULL, '2026-06-08', '09:00:00', '10:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-08 00:03:37'),
('RES-6A26EDB94A754', 22, 'LP001', NULL, '2026-06-09', '12:00:00', '13:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-08 16:32:04'),
('RES-6A27531107620', 25, 'LP001', NULL, '2026-06-09', '07:00:00', '08:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-08 23:43:42'),
('RES-6A278294D68F9', 26, 'LP016', NULL, '2026-06-10', '08:00:00', '09:00:00', 1, '120000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 03:03:59'),
('RES-6A27F645C2525', 28, 'LP001', NULL, '2026-06-10', '08:00:00', '09:00:00', 1, '85000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 11:17:39'),
('RES-6A27FE22380F6', 30, 'LP001', NULL, '2026-06-11', '08:00:00', '10:00:00', 2, '170000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 11:51:14'),
('RES-6A2804B40F8A4', 32, 'LP001', NULL, '2026-06-12', '09:00:00', '11:00:00', 2, '170000.00', 'dikonfirmasi', NULL, 0, '2026-06-09 12:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` bigint UNSIGNED NOT NULL,
  `id_reservasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_lapangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `rating` int NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `id_reservasi`, `id_lapangan`, `id_user`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES
(2, 'RES-20260609-HWJZ', 'LP002', 5, 5, 'hemm gimana yahh', '2026-06-09 03:52:48', '2026-06-09 03:52:48'),
(3, 'RES-20260607-HBAH', 'LP008', 5, 5, 'bagus lapangannya', '2026-06-09 03:58:21', '2026-06-09 03:58:21'),
(4, 'RES-20260609-0K1Z', 'LP008', 1, 5, 'bagus', '2026-06-09 11:56:46', '2026-06-09 11:56:46'),
(5, 'RES-20260606-SL5N', 'LP006', 1, 3, 'lumayan lapangannya', '2026-06-09 12:13:20', '2026-06-09 12:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kasir','owner','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nomor_telepon`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'evelin', 'evelinsalsabila27@gmail.com', NULL, NULL, '$2y$12$t6PlzpoiSG.6zmSQRdnl7.3ayGTyBNt11Rs1dqHQD7WOx8cho3ZRa', 'user', 'sLEeHMTOli6bhwolN2iKFfyBtqdJ4ChU25bpacvbB4dW9NFUB25VzUwPIwcE', '2026-06-05 10:22:50', '2026-06-09 12:11:03'),
(2, 'Administrator', 'admin@arena.com', NULL, '2026-06-07 06:50:35', '$2y$12$mAggWaHpdX0aklHimaTZWek5h2lnQhY/jxJQlUv92VVO/0JUjkXc6', 'admin', NULL, '2026-06-06 01:55:49', '2026-06-07 06:50:35'),
(5, 'salsabila', 'salsabila@gmail.com', NULL, NULL, '$2y$12$S8aOfyinlpjSveCXAf2/QOZ69UFEgwLLf.toqJ6Tc/L3sU5VsxNlu', 'user', 'NIojqLnOm2PhrC6SPhlGzQm63udtyB41ILG2dykTfiCkMMEc3t5KN1d5QFqT', '2026-06-06 09:11:31', '2026-06-06 09:11:31'),
(6, 'Kasir Utama', 'kasir@arena.com', NULL, NULL, '$2y$12$x8qsUaZZxVv3es3bpmNSp.A8DMYO3FpyVzomYRdfz4SfzSzbbRhke', 'kasir', NULL, '2026-06-07 07:01:51', '2026-06-07 07:05:24'),
(7, 'Pemilik', 'owner@arena.com', NULL, NULL, '$2y$12$Kl8WsRf/CLR4Jtblw8lyW.oXE6z0hvkr0e11VGxmX2Azb8vdBc/iq', 'owner', 'x2lzRDB7vpZPii18qbDs3bMfku4LtIyWJOutJQa1KWbVG6JleiDrv6S0zSzt', '2026-06-07 07:01:51', '2026-06-07 07:05:24'),
(8, 'haiii', 'haiii_1780842428@guest.com', NULL, NULL, '$2y$12$nJRROewus8.IrnY/q7c93OiehFt0FZMjDu75bJmoX04f36BOEDLg.', 'user', NULL, '2026-06-07 07:27:08', '2026-06-07 07:27:08'),
(9, 'hemmm', 'hemmm_1780865439@guest.com', NULL, NULL, '$2y$12$kMaLPAz/vscIRFAJo133HemXq3CVjyL33x0unSy7KCqjD7QE8hanK', 'user', NULL, '2026-06-07 13:50:40', '2026-06-07 13:50:40'),
(10, 'tes', 'tes_1780874014@guest.com', NULL, NULL, '$2y$12$Tk9/pBeXO7x0xbR/9Yl5a.djiNLwLDznkScKVXDKPYxtNgjU/MFou', 'user', NULL, '2026-06-07 16:13:35', '2026-06-07 16:13:35'),
(11, 'zxczxc', 'zxczxc_1780874429@guest.com', NULL, NULL, '$2y$12$Hy3NTChYg1lJbgifbY8w9O1hs9ZyvG86ONVd2eFI/yDzGnwve4tKO', 'user', NULL, '2026-06-07 16:20:30', '2026-06-07 16:20:30'),
(12, 'sfsdfsdf', 'sfsdfsdf_1780875261@guest.com', NULL, NULL, '$2y$12$L9gXyrLwIJpfBFdzDGUWr.JqQwbgPDm7PoeehQjZRHBQDAivSrmYu', 'user', NULL, '2026-06-07 16:34:21', '2026-06-07 16:34:21'),
(13, 'sf', 'sf_1780877008@guest.com', NULL, NULL, '$2y$12$.6HtGAJvYQVUKE5Z2bnVyOcPRwayhFlhMYTGqS6LrI4QAWdSDhn7q', 'user', NULL, '2026-06-07 17:03:29', '2026-06-07 17:03:29'),
(15, 'tes acid', 'tesacid_1780935368@guest.com', NULL, NULL, '$2y$12$ISOTxq5OyfIxq3npGoFR8.Ur23dvEQV4J3E7UbcHjtOThxikAk.uu', 'user', NULL, '2026-06-08 09:16:09', '2026-06-08 09:16:09'),
(16, 'aciiiid', 'aciiiid_1780935470@guest.com', NULL, NULL, '$2y$12$rqmiC3Rp7SNgwQZnFpb15eq52EB2/76bH49fyTiIaS9.xs6y3zAKq', 'user', NULL, '2026-06-08 09:17:51', '2026-06-08 09:17:51'),
(17, 'aciiid', 'aciiid_1780935670@guest.com', NULL, NULL, '$2y$12$vBQr6pYGPZ10iwS5ocrj0O9Pmufhx04sjZwho0BsDR4JwsPFH06wW', 'user', NULL, '2026-06-08 09:21:11', '2026-06-08 09:21:11'),
(18, 'axasx', 'axasx_1780935697@guest.com', NULL, NULL, '$2y$12$qZI8iFrPHm6l43SpoQ3k/eFi40yZU5rgY4FEhPjvpeIS9wM27AtHS', 'user', NULL, '2026-06-08 09:21:37', '2026-06-08 09:21:37'),
(19, 'zxasx', 'zxasx_1780935745@guest.com', NULL, NULL, '$2y$12$4tfMDahWpWm.NWsCK7z.c.iDot/dAuoMDd3RTlLK.TS3tP.YRV0zu', 'user', NULL, '2026-06-08 09:22:26', '2026-06-08 09:22:26'),
(20, 'xczxc', 'xczxc_1780935914@guest.com', NULL, NULL, '$2y$12$UmhdGv5sx1y9Iiw2DlcbkeHfCKceoSuwL3xnyppWoHnneVMJ6amfG', 'user', NULL, '2026-06-08 09:25:14', '2026-06-08 09:25:14'),
(21, 'adasdsd', 'adasdsd_1780936031@guest.com', NULL, NULL, '$2y$12$6XGzEtmw6tlhPcTWRuFbYuP6iaN0gXQZqgi0wL/xKCEhUpeLhDDXa', 'user', NULL, '2026-06-08 09:27:12', '2026-06-08 09:27:12'),
(22, 'asdasd', 'asdasd_1780936120@guest.com', NULL, NULL, '$2y$12$ZV3HsdASXgdAjvIeEaJ63OYZA3gLJMVcYNOoFpZ29XUQmQ8rvHGsC', 'user', NULL, '2026-06-08 09:28:41', '2026-06-08 09:28:41'),
(23, 'evelin 2', '24082010017@student.upnjatim.ac.id', NULL, NULL, '$2y$12$jBU7QEnfHdF0Jlm1C2v6lesH0SbQdYGHGL2O1mxtDH3EPm.zLLjOa', 'user', 'dQp1FwIeESkBpnTtZQXPJ9KypWiOq9wLgYU0SINqiRlCF0qcyKcNdvfPYxbA', '2026-06-08 10:45:22', '2026-06-09 11:12:58'),
(24, 'hai tes', 'haites_1780962049@guest.com', '0823242343324', NULL, '$2y$12$vZy03V2JLKFGDat3z60pA.7K.xXhIi6YB3Jeymc6tWHu1X9.CyIx2', 'user', NULL, '2026-06-08 23:40:50', '2026-06-08 23:40:50'),
(25, 'hai test', 'haitest_1780962064@guest.com', '0829342343243', NULL, '$2y$12$WTqFYZhB.zAS3nQIg0ME6..xP5.Uor1KqG9YcgLEeyq.VmabhORBW', 'user', NULL, '2026-06-08 23:41:05', '2026-06-08 23:41:05'),
(26, 'lusi', 'lusi_1780974227@guest.com', '085334213445', NULL, '$2y$12$q4dWV0.TGhMR3C3yUObXrOip6Bf5qkXxSaNRE5M9HvKtvjq1rTvKC', 'user', NULL, '2026-06-09 03:03:48', '2026-06-09 03:03:48'),
(27, 'John', 'john@gmail.com', NULL, NULL, '$2y$12$k/vGskGS85hPoxdg19QFE.Z6IeekFiop999Iy2uXTKu0rsziHA4Mu', 'user', NULL, '2026-06-09 11:11:42', '2026-06-09 11:11:42'),
(28, 'andre', 'andre_1781003844@guest.com', '02842834239423', NULL, '$2y$12$TFEKzREFPwd2gL4mMRa8G.iZyNQnOUpACr0SC3GHXwHSDvDZmnWGm', 'user', NULL, '2026-06-09 11:17:25', '2026-06-09 11:17:25'),
(29, 'fida', 'fida@gmail.com', '02384234234', NULL, '$2y$12$kybFde4X30uXUhdbHAqiAuVHKmNQuYNyQ/8/VhEU2h9UrtYEgsM36', 'user', NULL, '2026-06-09 11:20:08', '2026-06-09 11:20:08'),
(30, 'anddre', 'anddre_1781005857@guest.com', '08234234234', NULL, '$2y$12$ucYLwlTsYf0U26/DWZ562OihvbqskT9cngrBTbuBQN.q0xPw8HNQi', 'user', NULL, '2026-06-09 11:50:58', '2026-06-09 11:50:58'),
(31, 'aflahah', 'aflahah@gmail.com', NULL, NULL, '$2y$12$VXzp8hU.vfcpwJhVGtNd2OcmnbnY1hbqK2r.liiBqfZeJvrtNe6gG', 'user', NULL, '2026-06-09 12:00:44', '2026-06-09 12:00:44'),
(32, 'anddree', 'anddree_1781007539@guest.com', '0934234234', NULL, '$2y$12$e/eW56m613qBof6YC6ot.OxPYwFOXq580aeZ7HOqxGmb2dsFo/wqK', 'user', NULL, '2026-06-09 12:18:59', '2026-06-09 12:18:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajak_mains`
--
ALTER TABLE `ajak_mains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ajak_mains_id_cari_teman_foreign` (`id_cari_teman`),
  ADD KEY `ajak_mains_pengirim_id_foreign` (`pengirim_id`),
  ADD KEY `ajak_mains_penerima_id_foreign` (`penerima_id`);

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `beritas_slug_unique` (`slug`);

--
-- Indexes for table `cari_temans`
--
ALTER TABLE `cari_temans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cari_temans_id_pengguna_foreign` (`id_pengguna`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelatihs`
--
ALTER TABLE `pelatihs`
  ADD PRIMARY KEY (`id_pelatih`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_reservasi_idx` (`id_reservasi`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesan_komunitas`
--
ALTER TABLE `pesan_komunitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesan_komunitas_id_ajak_main_foreign` (`id_ajak_main`),
  ADD KEY `pesan_komunitas_pengirim_id_foreign` (`pengirim_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promos_kode_promo_unique` (`kode_promo`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `id_pengguna_idx` (`id_pengguna`),
  ADD KEY `id_lapangan_idx` (`id_lapangan`),
  ADD KEY `reservasi_id_pelatih_foreign` (`id_pelatih`);

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajak_mains`
--
ALTER TABLE `ajak_mains`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cari_temans`
--
ALTER TABLE `cari_temans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pelatihs`
--
ALTER TABLE `pelatihs`
  MODIFY `id_pelatih` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_komunitas`
--
ALTER TABLE `pesan_komunitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ajak_mains`
--
ALTER TABLE `ajak_mains`
  ADD CONSTRAINT `ajak_mains_id_cari_teman_foreign` FOREIGN KEY (`id_cari_teman`) REFERENCES `cari_temans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ajak_mains_penerima_id_foreign` FOREIGN KEY (`penerima_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ajak_mains_pengirim_id_foreign` FOREIGN KEY (`pengirim_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cari_temans`
--
ALTER TABLE `cari_temans`
  ADD CONSTRAINT `cari_temans_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `id_reservasi` FOREIGN KEY (`id_reservasi`) REFERENCES `reservasi` (`id_reservasi`);

--
-- Constraints for table `pesan_komunitas`
--
ALTER TABLE `pesan_komunitas`
  ADD CONSTRAINT `pesan_komunitas_id_ajak_main_foreign` FOREIGN KEY (`id_ajak_main`) REFERENCES `ajak_mains` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesan_komunitas_pengirim_id_foreign` FOREIGN KEY (`pengirim_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD CONSTRAINT `id_lapangan` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`),
  ADD CONSTRAINT `reservasi_id_pelatih_foreign` FOREIGN KEY (`id_pelatih`) REFERENCES `pelatihs` (`id_pelatih`) ON DELETE SET NULL,
  ADD CONSTRAINT `reservasi_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
