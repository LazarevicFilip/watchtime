-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 12:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watchtime`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id_anketa` int(5) NOT NULL,
  `pitanje` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id_anketa`, `pitanje`, `aktivna`) VALUES
(22, 'How do you like our blog?', 0),
(23, 'What you think about smart watches?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `anketa_korisnik_odgovor`
--

CREATE TABLE `anketa_korisnik_odgovor` (
  `id_odgovor` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL,
  `Id_anketa` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anketa_odgovori`
--

CREATE TABLE `anketa_odgovori` (
  `id_odgovor` int(11) NOT NULL,
  `odgovor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Id_anketa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa_odgovori`
--

INSERT INTO `anketa_odgovori` (`id_odgovor`, `odgovor`, `Id_anketa`) VALUES
(47, 'I like it.', 23),
(48, 'Not a fan.', 23),
(49, 'Natural', 23);

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id_kategorije` int(10) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id_kategorije`, `naziv`) VALUES
(2, 'Dress watches'),
(3, 'Sport watches'),
(4, 'Diving watches'),
(5, 'Ladies watches'),
(6, 'Chronograph'),
(7, 'GMT');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id_komentar` int(255) NOT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL,
  `vreme_unosa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_post` int(10) NOT NULL,
  `id_korisnik` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id_komentar`, `tekst`, `vreme_unosa`, `id_post`, `id_korisnik`) VALUES
(2, 'This watch looks so nice!', '2021-04-22 17:14:33', 10, 1),
(3, 'Prefect!', '2021-04-22 17:24:04', 9, 1),
(7, 'So classy....', '2021-04-22 18:44:47', 9, 1),
(8, 'White is my favorite!', '2021-04-22 19:00:51', 13, 1),
(9, 'This watch is amazing!', '2021-04-22 19:26:57', 12, 1),
(10, 'Wow.......It looks so nice....', '2021-04-22 19:31:06', 14, 49),
(11, 'Not a big fan.I would rather take Richard Mille', '2021-04-22 19:32:53', 14, 49),
(12, 'My pick definitely!', '2021-04-22 19:34:08', 9, 49),
(13, 'Design of this watch is so powerful!', '2021-04-22 19:34:39', 21, 49),
(14, 'Wow', '2021-04-22 19:36:39', 17, 49),
(15, 'Niceee', '2021-04-22 19:36:49', 19, 49),
(16, 'I would never go diving with this watch', '2021-04-22 19:37:17', 15, 49),
(17, 'Perfect...I want it definitely', '2021-04-22 19:37:52', 7, 49),
(18, 'AP best watches for sure.', '2021-04-22 19:38:49', 17, 49),
(19, 'I like it!', '2021-04-22 19:45:21', 11, 1),
(20, 'My favorite!', '2021-04-22 23:53:56', 14, 47),
(21, 'Like it', '2021-04-22 23:54:36', 16, 47),
(22, 'Perfect', '2021-04-23 09:31:22', 28, 47);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnik` int(255) NOT NULL,
  `ime` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_uloge` int(10) NOT NULL,
  `vreme_registracije` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `je_aktivan` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnik`, `ime`, `prezime`, `email`, `lozinka`, `id_uloge`, `vreme_registracije`, `je_aktivan`) VALUES
(1, 'Filip', 'Lazarevic', 'filip@gmail.com', '2e6c740729c44c12663c973965cbf698', 2, '2021-04-19 20:46:36', 0),
(39, 'Pera', 'Peric', 'pera@gmail.com', 'c32f618e79024665045ddb2066c40780', 2, '2021-04-19 21:55:00', 0),
(47, 'Pera', 'Peric', 'pericaaa@gmail.com', '2e6c740729c44c12663c973965cbf698', 2, '2021-04-19 22:09:44', 0),
(49, 'Nikola', 'Nikolic', 'nikola@gmail.com', 'e8f8b0cf7e6f4267e0bce864db0ac20c', 1, '2021-04-20 19:13:29', 0),
(54, 'Jovana', 'Medic', 'joka@gmail.com', 'd8095e8d0ba7a74d983eb3ad50c9f273', 2, '2021-04-24 13:37:15', 0),
(57, 'Marta', 'Mesic', 'mesic@gmail.cac', '16dd189ce58340d771bd0149098aade2', 2, '2021-04-24 14:20:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id_meni` int(5) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `putanja` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id_meni`, `naziv`, `putanja`) VALUES
(1, 'Home', 'index.php'),
(2, 'Blog', 'blog.php'),
(3, 'Contact', 'contact.php'),
(4, 'Author', 'author.php'),
(5, 'Login', 'login.php'),
(6, 'Register', 'register.php'),
(7, 'Profile', 'profile.php'),
(8, 'New Post', 'newpost.php'),
(9, 'Admin', 'admin.php'),
(10, 'Log Out', 'models/logout.php');

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `id_poruke` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tema` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poruke`
--

INSERT INTO `poruke` (`id_poruke`, `email`, `tema`, `tekst`, `vreme`) VALUES
(1, 'marija@gmail.com', 'Big Thanks', 'I just want to thanks to this amaizing blog', '2021-04-24 16:24:20'),
(2, 'nenad@gmail.com', 'No rolex?', 'Why is no post for rolex??', '2021-04-24 16:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `postovi`
--

CREATE TABLE `postovi` (
  `id_post` int(10) NOT NULL,
  `naslov` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tekst` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_korisnik` int(10) NOT NULL,
  `id_kategorije` int(10) NOT NULL,
  `slika_src` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `postovi`
--

INSERT INTO `postovi` (`id_post`, `naslov`, `tekst`, `datum`, `id_korisnik`, `id_kategorije`, `slika_src`) VALUES
(7, 'Bulgari - Octo Finissimo S Chronograph GMT Automatic', 'Unveiled by Bulgari at Baselworld 2019, the Octo Finissimo Chronograph GMT Automatic comes in two new versions, one completely new in a 43 mm stainless steel case and the other as a variation of the 42 mm titanium case that established a world record as the thinnest ever mechanical chronograph in watchmaking history.\r\n\r\nBulgari Octo Finissimo S Chronograph GMT Automatic ref. 103467\r\n\r\nThe Octo Finissimo S Chronograph GMT Automatic ref. 103467 is available in satin-polished steel with a new blue sunray dial paired with silver counters, including the one at 3 o\\\'clock that displays a second time zone on the sub-counter at 3 o’clock. \r\nBulgari Octo Finissimo S Chronograph GMT Automatic ref. 103467\r\n\r\nThe octagonal case is slightly larger than the titanium version (43 mm x 8.75 mm vs 42 mm x 6.6 mm) but this model offers the advantage of increasing water resistance to 100 metres / 330 feet (instead of 30 metres / 100 feet) also thanks to a larger screw-down crown (with a black ceramic insert).', '2021-04-21 16:39:20', 1, 7, '1619023160-img3.jpg'),
(9, 'Longines - DolceVita Art Deco Sector Dial Automatic', 'Longines presented two new DolceVita timepieces characterised by a sector dial inspired to a model from the 1920s, the age of the Art Deco.\r\n\r\nLongines DolceVita Sector Dial\r\n\r\nBoth feature rectangular cases crafted from stainless steel and water resistant to 3 bar (approximately 30 metres / 100 feet) but with different sizes: 28.20 x 47 mm (ref. L5.767) and 27.70 x 43.80 mm (ref. L5.757).\r\n\r\nLongines DolceVita Sector Dial\r\n\r\nBalancing two tones of silver, the dial is distinctive for its hour-circle adorned with Arabic numerals and cross hairs at the centre of the dial. The long, fine hands in blued steel stand out beautifully. A small aperture at 6 o\\\'clock displays the date.', '2021-04-21 23:15:17', 1, 2, '1619023314-img5.jpg'),
(10, 'Frederique Constant - Slimline Monolithic Manufacture 40Hz', 'With the new Slimline Monolithic Manufacture, Frederique Constant is introducing an innovative silicon oscillator beating at the impressive pace of 288,000 vibrations per hour, or 40 Hz - ten times faster than most mehanical movements.\r\n\r\nFrederique Constant Slimline Monolithic Manufacture 40Hz\r\n\r\nThe development of this solution started 3 years ago following the encounter between Peter Stas, co-founder and former CEO of Frederique Constant, and Dr Nima Tolou, founder and CEO of Flexous, an independent innovative horology-oriented technology branch of YES!Delft specialising in compliant or flexible mechanisms. \r\n\r\nThe goal was the production of a new flexible oscillating system with a size comparable to that of a traditional balance, the highest possible frequency, an autonomy of at least 80 hours and, not a minor thing, reasonably priced.', '2021-04-23 13:59:57', 1, 2, '1619186397-1619023392-img6.jpg'),
(11, 'Hublot - Big Bang One Click 33mm', 'Hublot redefined the case of the Big Bang for feminine wrists presenting it in stainless steel or in King Gold with the possibility to change appearance in no time thanks to interchangeable straps.\r\n\r\nHublot Big Bang One Click 33mm\r\n\r\nThe result is the Big Bang One Click 33mm, a timepiece of great character whose look is distinguished by screws, stylised numerals and a bezel set with 36 diamonds for 0.76ct. \r\nHublot Big Bang One Click 33mm\r\nHublot Big Bang One Click 33mm\r\n\r\nThe dial can be matte black or matte white. The case is also offered in a Pave version that is enhanced by 130 diamonds for a total of 0.4ct.', '2021-04-21 16:44:28', 1, 5, '1619023468-img7.jpg'),
(12, 'Richard Mille - RM 037 White Ceramic', 'The latest addition to the ever growing Richard Mille women’s collection is a new interpretation of its RM 037 model that combines, for the first time, white ceramic, mother-of-pearl and white gold.\r\nWhite ceramic is used for the bezel and the caseback. In particular, Richard Mille uses ATZ white ceramic, where ATZ stands for Alumina Toughened Zirconia. This material is based on aluminium oxide powder tubes injected at a pressure of 2,000 bar. This high-pressure injection increases rigidity by 20-30% and reduces the material’s porosity to an absolute minimum.\r\n\r\nHypo-allergenic and one of the hardest materials in the world after diamond, ATZ ceramic is valued for its remarkable resistance to scratches, shocks and abrasion, as well as for its whiteness that does not change over time.', '2021-04-21 16:45:37', 1, 5, '1619023537-img8.jpg'),
(13, 'Hublot - Big Bang Integral Ceramic', 'Following the launch of the Big Bang Integral at the beginning of 2020 (you can read about it here), in 2021 Hublot introduced three new Integral models made in high-tech ceramic.\r\n\r\nHublot Big Bang Integral Ceramic\r\n\r\nA signature material at Hublot, ceramic combines hardness and lightness (two to three times harder than steel but 30% lighter). Difficult to machine, this material offers scratch-resistance, durability and hypoallergenic properties. It is also soft to the touch and pleasant to wear thanks to its low thermal conductivity.\r\n\r\nThe new Big Bang Integral Ceramic models shares the monobloc architecture with an integrated bracelet on which the first link is fused with the case while differentiating for their colours: white, navy blue or grey.', '2021-04-21 16:47:46', 49, 3, '1619023666-img9.jpg'),
(14, 'Audemars Piguet - Royal Oak Green Dial models 2021', 'Audemars Piguet presented five new Royal Oak models adorned by green dials.\r\n\r\nThe first, and most interesting, model is a 950 platinum Royal Oak “Jumbo” Extra-Thin ref. 15202PT.OO.1240PT.01 featuring a smoked green dial embellished with a sunburst pattern.\r\n\r\nAudemars Piguet Royal Oak Jumbo 15202PT.OO.1240PT.01\r\n\r\nThis is the first time that this configuration has been employed within the 15202 collection (you can read the history of the Audemars Piguet Royal Oak model, the masterpiece of artist and designer Gerald Genta, here). \r\n\r\nThe 41 mm case is just 8.1 mm in thickness and water resistant to 50 metres / 165 feet. Framed by the signature bezel and protected by a glareproofed sapphire crystal, the dial displays hours, minutes and date. No \\\"Petite Tapisserie\\\" decoration for this model. ', '2021-04-21 16:48:32', 49, 3, '1619023712-img10.jpg'),
(15, 'Bell  Ross - BR 03-92 Diver Red Bronze', 'After releasing black, green and blue versions, Bell & Ross introduced a new variation of its BR 03-92 Diver characterised by a red dial and a red anodised aluminium bezel ring.\r\n\r\nBell & Ross BR 03-92 Diver Red Bronze\r\n\r\nCase and bezel of the BR 03-92 Diver Red Bronze are made from bronze, an alloy combining 92% Copper and 8% Tin that is deeply linked to diving history for its resistance to corrosion. Depending on how the watch is worn by its owner, bronze develops a patina that makes each piece somehow unique and accentuates the vintage appeal of the timepiece.', '2021-04-21 16:49:39', 49, 4, '1619023779-img11.jpg'),
(16, 'TAG Heuer - Carrera Calibre Heuer 02T COSC Blue', 'First introduced in 2016, TAG Heuer\\\'s Carrera Heuer-02T, a COSC-certified automatic chronograph movement combined with a titanium and carbon flying tourbillon, is now powering a striking blue version of the Carrera.\r\nThe new TAG Heuer Carrera Calibre Heuer 02T COSC Blue is a limited edition of 250 pieces and comes in a 45 mm grade 5 titanium case matched to a grade 2 titanium bracelet, a first compared to previous Heuer 02T models that were fitted with leather or rubber straps.\r\nFramed by a blue ceramic tachymetric bezel, the dial has a blue sunray finish with the flying tourbillon at 6 o\\\'clock and two rhodium plated polished snailed counters at 3 and 9 o\\\'clock to display the chronographic minutes and hours, respectively. Blue rubber protects the crown and pusher buttons.', '2021-04-21 16:51:27', 49, 6, '1619023887-img12.jpg'),
(17, 'Audemars Piguet - Royal Oak Offshore Flying Tourbillon Flyback Chronograph', 'With the new Royal Oak Offshore Selfwinding Flying Tourbillon Flyback Chronograph, Audemars Piguet introduces a new complication in the Royal Oak Offshore collection together with a revamping of the overall aesthetics.\r\n\r\nAudemars Piguet Royal Oak Offshore Selfwinding Flying Tourbillon Flyback Chronograph 26622TI.GG.D002CA.01\r\n\r\nThis selfwinding timepiece combines a flying tourbillon with a flyback chronograph housed in a restyled 43 mm titanium case that paves the way for a new generation of Royal Oak Offshore models presenting larger polished chamfers on the edges, curved bezel and\r\n sapphire crystal, and curved chronograph pushers.\r\n\r\nThe signature bezel frames the openworked dial disclosing the architecture of the multi-layered movement whose dark tones creates a contrasting background for the white gold hands and white transferred minute track. The red chronograph hands enhance the sporty look of the watch.\r\n\r\n', '2021-04-21 16:52:32', 49, 6, '1619023952-img13.jpg'),
(18, 'Tudor - Black Bay Chrono', 'Tudor introduced the Black Bay Chrono, a sport chronograph powered by a self-winding Manufacture movement and presented in two dial options with contrasting sub-counters.\r\n\r\nTudor Black Bay Chrono\r\n\r\nThe 41 mm satin-brushed and polished stainless steel case is equipped with a fixed bezel in stainless steel with a tachymetric scale insert in black anodised aluminium. The screw-down pushers have been inspired by the very first generation of Tudor chronographs.\r\n\r\nThe domed dial, matt black or opaline, includes two hollowed sub-counters in contrasting colours, white opaline and matt black, respectively.', '2021-04-21 16:53:52', 49, 6, '1619024032-img14.jpg'),
(19, 'Krayon - Lady Anywhere', 'After the Everywhere and the Anywhere models, Krayon presented its first model for Ladies, the Lady Anywhere.\r\n\r\nKrayon Lady Anywhere\r\n\r\nThis exclusive timepiece indicates the length of the day and the time at which the sun rises and sets by displaying the time of sunrise and sunset at any point on the globe chosen by its wearer, hence its name.\r\n\r\nThe watch indicates the hours and minutes with dedicated hands in the central portion of the dial, surrounded by an annular zone upon which a small sun circulates in perpetual motion, indicating the time over 24 hours. The annular zone has two sectors for day (pink) and night (dark blue) cut from sapphire and hand-painted in contrasting colours. The dark blue section representing the night is enriched by small Super‐LumiNova stars.', '2021-04-21 16:55:25', 49, 5, '1619024125-img15.jpg'),
(21, 'Audemars Piguet - Royal Oak Double Balance Wheel Openworked Black Ceramic', 'Audemars Piguet unveiled today a new version of its Royal Oak Double Balance Wheel Openworked that comes with black ceramic case and bracelet, a first for this specific model.\r\n\r\nAudemars Piguet Royal Oak Double Balance Wheel Openworked Black Ceramic Ref. 15416CE.OO.1225CE.01\r\n\r\nPresented in 2016 (you can read our presentation article here), the Royal Oak Double Balance Wheel Openworked features a patented innovation aimed to improve the watch’s precision and stability by incorporating two balance wheels and two hairsprings assembled on the same axis so that the system oscillates in synchrony.\r\n \r\nNot only an engineering feat, the solution is also aesthetically fascinating which is why Audemars Piguet has fully openworked the blackened movement. The pink gold-toned double balance wheel mechanism and applied hour-markers and luminescent hands enhance the ensemble.\r\n\r\nAudemars Piguet Royal Oak Double Balance Wheel Openworked Black Ceramic Ref. 15416CE.OO.1225CE.01\r\n\r\nThe watch’s titanium caseback presents the engraving: “Royal Oak Double Balancier” and, through the transparent sapphire crystal, showcases the back of the movement and its 22-carat pink gold oscillating.\r\n\r\nAudemars Piguet Royal Oak Double Balance Wheel Openworked Black Ceramic Ref. 15416CE.OO.1225CE.01\r\n\r\nBeating at 3 Hz (21,600 vibrations per hour), the selfwinding Manufacture Calibre 3132 offers a power reserve of 45 hours.\r\n\r\nThe 41 mm case and the bracelet are meticulously hand-finished alternating satin-brushed and polished surfaces.', '2021-04-22 17:40:19', 1, 3, '1619113219-img10.jpg'),
(27, 'Patek Philippe - Calatrava Clous de Paris Ref. 6119R and 6119G', 'Patek Philippe is updating one of its most emblematic dress watches, the Calatrava with a bezel decorated with a guilloched “Clous de Paris” pattern.\r\nThis diamond-polished motif composed of small pyramid tips first appeared on the bezel of a Calatrava in 1934, the Ref. 96D (D for décor). Since then, it has been reinterpreted in numerous versions. Probably the most successful model featuring this decoration element was the Reference 3919 launched in 1985 and produced for 20 years: it featured the manually wound caliber 215 PS, subsidiary seconds at 6 o\\\'clock, a white dial with black lacquered Roman numerals and straight lugs. \r\n\r\nThe Calatrava \\\"Clous de Paris\\\" comes now with a decidedly contemporary look, a slightly larger diameter of 39 mm, a dial with applied hour markers and a brand new hand-wound Patek Philippe movement that has been expressly developed for this model. \r\nTwo versions have been presented. Reference 6119R-001 combines a rose-gold case with a silvery grained dial as well as applied hour markers and hands in rose gold. \r\n\r\nPatek Philippe Calatrava \\\"Clous de Paris\\\" Ref. 6119R\r\n\r\nPatek Philippe Calatrava \\\"Clous de Paris\\\" Ref. 6119R\r\n\r\nThe Reference 6119G-001 in white gold features a charcoal gray dial enhanced by a vertical satin finish interrupted by the snailed subsidiary seconds dial. The applied hour markers and hands are made of the same metal as the case. \r\n\r\nPatek Philippe Calatrava \\\"Clous de Paris\\\" Ref. 6119G\r\n\r\nPatek Philippe Calatrava \\\"Clous de Paris\\\" Ref. 6119G\r\n\r\nThe gold dauphine-style hour and minute hands have three instead of two facets. Legibility is excellent thanks to the railway-track minute scale at the periphery of the dial. The slender “cheveu”-style seconds hand rotates on the subsidiary subdial at 6 o\\\'clock which is divided into four quarters.', '2021-04-23 09:26:18', 1, 2, '1619169978-img1.jpg'),
(28, 'Grand Seiko - Sport Collection GMT SBGJ237 and SBGJ239', 'Grand Seiko enriches its Sport Collection with two new GMT Triple Time Zone models. Thanks to their rotating 24-hour bezel, they simultaneously displays three different time zones.\r\n\r\nGrand Seiko Sport Collection GMT SBGJ237 and SBGJ239\r\n\r\nWater resistant down to 20 bar and highly resistant to shocks, the new Sport GMT models combine great presence on the wrist, robustness and luxury finishes.\r\n\r\nProtected by a dual-curved sapphire glass with anti-reflective coating on the inner surface, the dial is available in two variations: blue framed by a blue/white bezel (ref. SBGJ237) and vintage green with black/white bezel (ref. SBGJ239).\r\n\r\nGrand Seiko Sport Collection GMT SBGJ237\r\n  \r\nGrand Seiko Sport Collection GMT SBGJ239\r\n\r\nReadability is enhanced by Lumibrite coating on hands, indexs and bezel. The GMT hand is white on the SBGJ237 and red on the SBGJ239.\r\n\r\nThe glass on the surface of the ring enhances the look of this model with a nice depth effect.\r\n\r\nGrand Seiko Sport Collection GMT SBGJ237\r\n\r\nGrand Seiko Sport Collection GMT SBGJ239\r\n\r\nThe 44.2 mm x 14.4 mm stainless steel case is matched to a steel bracelet or to a crocodile leather strap.\r\n\r\nThese new models are powered by the Caliber 9S86, a hi-beat (36,000 vibrations per hour) automatic movement with GMT function that delivers great accuracy (-5 to +3 seconds a day) and 55 hours of power reserve.\r\n\r\nGrand Seiko Calibre 9S86\r\n\r\nPulling the crown out by one notch enables the hour hand to be adjusted without stopping the second hand so that accurate timekeeping is not lost.', '2021-04-23 09:27:47', 1, 7, '1619170067-img3.jpg'),
(29, 'Bulgari - Octo Finissimo Chronograph GMT Automatic', 'Bulgari adds a fifth world record to its impressive collection: the thinnest ever mechanical chronograph in watchmaking history.\r\n\r\nUnveiled at Baselworld 2019, the new Octo Finissimo Chronograph GMT Automatic is another demonstration of Bulgari’s skills in Haute Horlogerie.\r\n\r\nBulgari Octo Finissimo Chronograph GMT Automatic\r\n\r\nIts unique case, neither round nor square, houses an integrated chronograph movement with GMT function which is only 3.3 mm thick. The record is particularly impressive considering that the BVL 318 calibre  is also self-winding. The use of a peripheral mass significantly contributed to limit the overall thickness of the movement. The power reserve is 55 hours. It is visible through the transparent  sapphire crystal case back.\r\n\r\n\r\n\r\nBulgari Octo Finissimo Chronograph GMT Automatic\r\n\r\nThe 42 mm (diameter) x 6.90 mm (thickness) case is crafted from titanium with a special sandblasting treatment which makes the surfaces smooth as silk. The titanium crown is enhanced by a ceramic insert.\r\n\r\n\r\n\r\nBulgari Octo Finissimo Chronograph GMT Automatic\r\n\r\nThe dial is well organized with a useful GMT function that allows one to set the local time with a button at 9 o\\\'clock. The home time is indicated on the subcounter at 3 o\\\'clock: thanks to its 24-hour graduation, it also indicates day or night.\r\n\r\nBulgari Octo Finissimo Chronograph GMT Automatic\r\n\r\n\r\n\r\nThe chronograph minutes counter is positioned at 6 o\\\'clock, while small seconds are readable at 9 o\\\'clock.\r\n\r\nCompleted by a sandblasted titanium bracelet with folding clasp, this new model is water-resistant up to 30 meters / 100 feet.\r\n\r\nThe Bulgari Octo Finissimo Chronograph GMT Automatic Ref. 103068 an impressive timepiece that combines contemporary design, technical innovation, and the use of high-tech materials. Its price is Euro 17,400. bulgari.com\r\n\r\n', '2021-04-23 09:30:46', 47, 7, '1619170246-img12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id_uloge` int(5) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id_uloge`, `naziv`) VALUES
(1, 'Admin'),
(2, 'Korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id_anketa`);

--
-- Indexes for table `anketa_korisnik_odgovor`
--
ALTER TABLE `anketa_korisnik_odgovor`
  ADD KEY `id_odgovor` (`id_odgovor`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `Id_anketa` (`Id_anketa`);

--
-- Indexes for table `anketa_odgovori`
--
ALTER TABLE `anketa_odgovori`
  ADD PRIMARY KEY (`id_odgovor`),
  ADD KEY `Id_anketa` (`Id_anketa`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id_kategorije`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_uloge` (`id_uloge`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id_meni`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`id_poruke`);

--
-- Indexes for table `postovi`
--
ALTER TABLE `postovi`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_kategorije` (`id_kategorije`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id_uloge`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id_anketa` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id_kategorije` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id_komentar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id_meni` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `id_poruke` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postovi`
--
ALTER TABLE `postovi`
  MODIFY `id_post` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id_uloge` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketa_korisnik_odgovor`
--
ALTER TABLE `anketa_korisnik_odgovor`
  ADD CONSTRAINT `anketa_korisnik_odgovor_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`),
  ADD CONSTRAINT `anketa_korisnik_odgovor_ibfk_2` FOREIGN KEY (`Id_anketa`) REFERENCES `anketa` (`id_anketa`),
  ADD CONSTRAINT `anketa_korisnik_odgovor_ibfk_3` FOREIGN KEY (`id_odgovor`) REFERENCES `anketa_odgovori` (`id_odgovor`);

--
-- Constraints for table `anketa_odgovori`
--
ALTER TABLE `anketa_odgovori`
  ADD CONSTRAINT `anketa_odgovori_ibfk_1` FOREIGN KEY (`Id_anketa`) REFERENCES `anketa` (`id_anketa`) ON DELETE CASCADE;

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `postovi` (`id_post`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentari_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`);

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`id_uloge`) REFERENCES `uloge` (`id_uloge`);

--
-- Constraints for table `postovi`
--
ALTER TABLE `postovi`
  ADD CONSTRAINT `postovi_ibfk_1` FOREIGN KEY (`id_kategorije`) REFERENCES `kategorije` (`id_kategorije`) ON DELETE CASCADE,
  ADD CONSTRAINT `postovi_ibfk_2` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnici` (`id_korisnik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
