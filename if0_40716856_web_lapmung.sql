-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql308.byetcluster.com
-- Waktu pembuatan: 31 Des 2025 pada 01.26
-- Versi server: 11.4.9-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40716856_web_lapmung`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `culture_gallery`
--

CREATE TABLE `culture_gallery` (
  `id` int(11) NOT NULL,
  `category` enum('Tari','Rumah Adat','Kain','Senjata','Kuliner') NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `culture_gallery`
--

INSERT INTO `culture_gallery` (`id`, `category`, `title`, `description`, `image_url`, `created_at`) VALUES
(2, 'Tari', 'Tari Sigeh Penguten', 'Tari Sigeh Penguten adalah tari penyambutan tamu agung dalam adat Lampung. Tarian ini merupakan perpaduan budaya antara kedua suku masyarakat Lampung, yaitu Saibatin dan Pepadun. Awalnya tarian ini bernama Tari Sembah, namun telah dibakukan menjadi Sigeh Penguten.\r\n\r\nPara penari mengenakan busana adat yang mewah dengan mahkota Siger berwarna emas di kepala. Gerakan tubuh yang luwes dan jemari yang lentik menyiratkan keramahan, penghormatan, dan kehangatan masyarakat Lampung dalam menerima tamu yang datang ke \"Sang Bumi Ruwa Jurai\". Salah satu penari utama biasanya membawa tepak (kotak kuningan) berisi sekapur sirih untuk disuguhkan kepada tamu kehormatan.', '6944ef8c67696.jpg', '2025-12-18 18:13:14'),
(3, 'Tari', 'Tari Melinting', 'Tari Melinting merupakan tarian tradisional peninggalan Kerajaan Melinting yang berasal dari Lampung Timur. Tarian ini tergolong tarian klasik karena sudah ada sejak abad ke-16. Awalnya, tarian ini hanya dipentaskan di lingkungan istana kerajaan (sesat) untuk menghibur raja dan keluarga bangsawan.\r\n\r\nCiri khas Tari Melinting adalah penggunaan kipas tangan yang dimainkan secara dinamis oleh penari pria dan wanita. Gerakannya lincah namun tetap anggun, mencerminkan kegagahan pria dan kelembutan wanita Lampung. Busana yang dikenakan biasanya didominasi warna merah, putih, dan emas yang melambangkan keberanian dan kesucian.', '6944f3e3b7743.jpg', '2025-12-19 06:26:23'),
(4, 'Rumah Adat', 'Nuwo Sesat', 'Nuwo Sesat adalah rumah adat tradisional masyarakat Lampung, khususnya bagi masyarakat adat Pepadun. Secara harfiah, \"Nuwo\" berarti rumah dan \"Sesat\" berarti bangunan musyawarah. Jadi, fungsi utama bangunan ini pada zaman dahulu bukanlah sebagai tempat tinggal pribadi, melainkan sebagai balai pertemuan adat atau tempat para Penyimbang (tetua adat) bermusyawarah (pepung).\r\n\r\nBangunan ini berbentuk rumah panggung kayu yang besar dengan ornamen ukiran yang rumit dan indah. Atapnya memiliki ciri khas yang disebut \"Ilalang\" atau anyaman bambu. Di bagian depan terdapat tangga (ijan) yang jumlah anak tangganya ganjil, melambangkan nilai-nilai sakral.\r\n', '6944f501ad53a.jpg', '2025-12-19 06:28:21'),
(5, 'Kain', 'Kain Tapis Lampung', 'Kain Tapis adalah kain tenun tradisional kebanggaan masyarakat Lampung. Kain ini dibuat oleh kaum ibu dan gadis-gadis Lampung dengan cara menenun benang kapas, yang kemudian disulam (cucuk) menggunakan benang emas atau perak membentuk motif-motif yang indah.\r\n\r\nMotif Tapis sangat beragam, mulai dari motif alam (flora dan fauna), motif geometris, hingga motif kapal dan naga yang melambangkan perjalanan hidup manusia. Kain Tapis bukan sekadar pakaian, melainkan simbol status sosial dalam struktur masyarakat adat Lampung. Tapis biasanya dikenakan pada upacara-upacara besar seperti pernikahan (begawi) dan pengangkatan gelar adat.', '6944f55c0a13b.jpeg', '2025-12-19 06:49:00'),
(6, 'Senjata', 'Keris Terapang', 'Terapang adalah senjata tradisional Lampung yang bentuknya menyerupai keris, namun memiliki ciri khas tersendiri. Bilahnya sedikit berlekuk atau lurus dengan ukiran yang halus. Keunikan Terapang terletak pada sarungnya yang seringkali diukir dengan motif kepala burung atau manusia yang distilasi.\r\n\r\nPada masa lalu, Terapang digunakan oleh para bangsawan atau hulu balang sebagai senjata pertahanan diri dan simbol kewibawaan. Saat ini, Terapang lebih sering digunakan sebagai pelengkap busana adat pengantin pria dalam upacara pernikahan adat Lampung, melambangkan tanggung jawab dan perlindungan terhadap keluarga.', '6944f5a58a5e4.jpg', '2025-12-19 06:50:13'),
(7, 'Kuliner', 'Seruit', 'Seruit adalah hidangan khas Lampung yang menjadi simbol kebersamaan. Makanan ini terdiri dari ikan bakar (biasanya ikan sungai seperti Belida, Baung, atau Layis) yang dicampur dengan sambal terasi khas Lampung, tempoyak (durian fermentasi), atau mangga muda.\r\n\r\nTradisi memakan seruit disebut \"Nyeruit\". Dalam tradisi ini, orang-orang makan bersama-sama menggunakan tangan dalam satu wadah besar atau duduk lesehan, didampingi dengan lalapan segar seperti daun singkong, terong bakar, dan jengkol. Rasa seruit sangat kaya: pedas, asam, gurih, dan segar, mencerminkan karakter masyarakat Lampung yang ekspresif dan hangat.', '6944f60f531cc.jpg', '2025-12-19 06:51:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `last_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id`, `content`, `last_updated`) VALUES
(1, 'Sejarah Panjang Provinsi Lampung: Sang Bumi Ruwa Jurai\r\nAsal Usul dan Legenda Sejarah Lampung dimulai dari masa prasejarah yang kaya akan legenda dan bukti arkeologis. Nama \"Lampung\" sendiri memiliki berbagai versi asal-usul. Ada yang menyebutkan berasal dari kata \"To-Lang-Pohwang\" dari catatan Tiongkok kuno abad ke-7. Ada pula legenda masyarakat yang mengaitkannya dengan peristiwa \"terapung\"nya Puyang Si Aji di atas rakit di Lautan. Namun, secara budaya, masyarakat adat Lampung meyakini bahwa nenek moyang mereka berasal dari dataran tinggi Sekala Brak, di kaki Gunung Pesagi, Lampung Barat. Dari sanalah peradaban menyebar ke seluruh penjuru daerah yang kini kita kenal sebagai Lampung.\r\n\r\nEra Kerajaan Tulang Bawang dan Sekala Brak Jauh sebelum masa kolonial, di tanah Lampung telah berdiri kerajaan-kerajaan kuno. Catatan sejarah tertua menyebutkan adanya Kerajaan Tulang Bawang yang mengirimkan utusan ke Tiongkok. Sementara itu, Kerajaan Sekala Brak dianggap sebagai cikal bakal etnis Lampung modern. Pada masa ini, pengaruh Hindu-Buddha cukup kuat, terlihat dari peninggalan prasasti seperti Prasasti Palas Pasemah dan Batu Bedil yang menunjukkan pengaruh Kerajaan Sriwijaya yang kuat di wilayah ini sebagai jalur perdagangan strategis Selat Sunda.\r\n\r\nMasuknya Islam dan Pengaruh Banten Memasuki abad ke-15 dan 16, pengaruh Islam mulai masuk dan mengubah tatanan sosial budaya. Kesultanan Banten memiliki peran yang sangat signifikan dalam penyebaran Islam dan struktur pemerintahan di Lampung. Pada masa ini, masyarakat Lampung mulai terbagi dalam struktur marga-marga yang kuat. Hubungan dagang, terutama lada hitam (black pepper), menjadikan Lampung sebagai primadona di mata pedagang internasional, yang kemudian menarik perhatian bangsa Eropa.\r\n\r\nMasa Kolonialisme dan Perjuangan Radin Inten II Kekayaan rempah-rempah Lampung, khususnya lada, memicu kedatangan VOC (Belanda). Masyarakat Lampung dikenal gigih melawan penjajahan. Salah satu pahlawan nasional yang paling disegani adalah Radin Inten II. Beliau memimpin perlawanan sengit terhadap Belanda di wilayah Lampung Selatan. Meskipun akhirnya gugur karena pengkhianatan, semangat juangnya tetap hidup dan menjadi simbol keberanian rakyat Lampung. Pada masa kolonial ini pula, tepatnya tahun 1905, pemerintah Hindia Belanda memulai program kolonisasi (cikal bakal transmigrasi) dengan memindahkan penduduk dari Pulau Jawa ke Gedong Tataan, yang menjadikan Lampung sebagai wilayah yang sangat majemuk (heterogen) hingga saat ini.\r\n\r\nLetusan Krakatau 1883 Sejarah Lampung tidak bisa dilepaskan dari peristiwa alam dahsyat meletusnya Gunung Krakatau pada tahun 1883. Letusan ini meluluhlantakkan sebagian besar wilayah pesisir Lampung Selatan dan memakan ribuan korban jiwa. Namun, peristiwa ini juga yang kemudian membentuk bentang alam Lampung seperti yang kita lihat sekarang.\r\n\r\nTerbentuknya Provinsi Lampung Setelah kemerdekaan Indonesia, Lampung awalnya merupakan bagian dari Keresidenan di bawah Provinsi Sumatera Selatan. Namun, menyadari potensi besar wilayah dan identitas budaya yang kuat, tokoh-tokoh masyarakat Lampung memperjuangkan status otonomi. Perjuangan tersebut membuahkan hasil pada tanggal 18 Maret 1964, ketika Lampung resmi berdiri sebagai Provinsi sendiri yang terpisah dari Sumatera Selatan, berdasarkan Undang-Undang Nomor 14 Tahun 1964.\r\n\r\nSang Bumi Ruwa Jurai Kini, Provinsi Lampung dikenal dengan semboyan \"Sang Bumi Ruwa Jurai\", yang bermakna satu bumi (Lampung) yang didiami oleh dua jurai (garis keturunan) masyarakat adat, yaitu masyarakat adat Saibatin (Pesisir) dan Pepadun (Pedalaman), serta hidup berdampingan secara damai dengan berbagai suku pendatang lainnya. Lampung telah bertransformasi menjadi \"Gerbang Pulau Sumatera\", sebuah provinsi yang maju dengan tetap memegang teguh nilai-nilai luhur budayanya.', '2025-12-19 06:15:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-12-18 15:31:00'),
(3, 'AryaPutra', '$2y$10$T8Cpx2ICsJf7Ekyksuo0GuzZNzGa/MHta5/kutncu3wY7YyQgZd4K', '2025-12-18 16:37:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `culture_gallery`
--
ALTER TABLE `culture_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `culture_gallery`
--
ALTER TABLE `culture_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
