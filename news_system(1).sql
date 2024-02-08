-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2023 at 09:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'techdipesh36@gmail.com', 'Dipesh chaudhary', 'Dipesh@3214', '2023-06-24 06:11:23', '2023-06-24 06:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `created_at`, `updated_at`) VALUES
(10, 'Nation', NULL, '2023-06-25 18:35:53'),
(17, 'Global', NULL, '2023-06-30 16:53:21'),
(18, 'Health', '2023-06-25 04:02:03', '2023-06-26 16:21:18'),
(19, 'Politics', '2023-06-25 17:48:56', '2023-06-25 18:36:01'),
(20, 'Technology', '2023-06-26 14:39:39', '2023-06-26 16:21:36'),
(21, 'Sports', '2023-06-26 14:39:45', '2023-06-26 16:21:28'),
(22, 'Business', '2023-06-26 16:21:42', '2023-06-26 16:21:42'),
(28, 'science', '2023-07-04 05:46:53', '2023-07-04 05:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_approve` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `email`, `username`, `comment`, `news_id`, `created_at`, `updated_at`, `is_approve`) VALUES
(4, 'HKFJASDKH@gmail.com', 'ASDHKF', 'ashdkufhasdfkhasdjfkasd', 30, '2023-06-28 06:07:54', '2023-06-28 06:07:54', 1),
(5, 'new@gmail.com', 'asdfk', 'faksdjfasduhfkasd', 30, '2023-06-28 06:12:17', '2023-06-28 06:12:17', 1),
(6, 'new@gmail.com', 'asdfk', 'faksdjfasduhfkasd', 30, '2023-06-28 06:14:45', '2023-06-28 06:14:45', 1),
(7, 'jection@gmail.com', 'afdjakjsd,', 'faksdjfas', 30, '2023-06-28 06:14:59', '2023-06-28 06:14:59', 1),
(8, 'jeshannew@gmail.com', 'sdsajfj', 'aushdkfhaskdfahskdfkahsdfh', 29, '2023-06-28 06:16:08', '2023-06-28 06:16:08', 1),
(9, 'jadsfjjaskd@gmail.com', 'asdkjfn,', 'asdfkja,sdfksa', 29, '2023-06-28 06:16:58', '2023-06-28 06:16:58', 1),
(10, 'techdipesh36@gmail.com', 'Dipesh Chaudhary', 'This is nice post i like it', 30, '2023-06-28 06:43:05', '2023-06-28 06:43:05', 1),
(11, 'basu@gmail.com', 'basu dev', 'this is very nice', 30, '2023-06-28 06:43:27', '2023-06-28 06:43:27', 1),
(12, 'fhakdhk@gmail.com', 'afdjhk', 'fahskdfjhasdkfhkasdjfhkds', 40, '2023-06-28 06:55:35', '2023-06-28 06:55:35', 1),
(13, 'Dipeshchaudhary@gmail.com', 'Dipesh Chaudhary', 'This is very nice post\r\n', 37, '2023-06-28 09:44:28', '2023-06-28 09:44:28', 1),
(14, 'jeshan@gmail.com', 'jeshan', 'hello this is test comment\r\n', 33, '2023-06-28 14:27:18', '2023-06-28 14:27:18', 1),
(15, 'Techdipesh36@gmail.com', 'Dipesh Chaudhary', 'This is very nice post', 26, '2023-06-29 12:22:08', '2023-06-29 12:22:08', 1),
(16, 'Jeshan@gmail.com', 'Jeshan', 'This is very nice', 27, '2023-06-29 13:02:05', '2023-06-29 13:02:05', 1),
(27, 'fdgjash@gmail.com', 'dsfasdfa', 'aksdfhaksjhdfkhsadkjfs', 36, '2023-06-30 08:00:49', '2023-06-30 08:00:49', 0),
(28, 'asdf@gmail.com', 'fasdsa', 'afskfhdjashd', 29, '2023-06-30 08:03:43', '2023-06-30 08:03:43', 0),
(29, 'asdfasd@gmail.com', 'sdafasf', 'fasdjhfasdkhfsad', 33, '2023-06-30 08:06:12', '2023-06-30 08:06:12', 0),
(33, 'asdf@gmail.com', 'asdfgds', 'fsadkjhfjahsjdk', 36, '2023-06-30 08:13:14', '2023-06-30 08:13:14', 0),
(34, 'fkjashdkfjh@gmail.com', 'eafasf', 'fahskdjfhjasdhkf', 27, '2023-06-30 08:15:56', '2023-06-30 08:15:56', 0),
(35, 'hfhaskjdhk@gmail.com', 'dasfsahkj', 'nafkjsdhfjsad', 27, '2023-06-30 08:16:56', '2023-06-30 08:16:56', 0),
(36, 'asdfsfa@gmail.com', 'eafasd', 'dsjakfkasjdfsdaf', 31, '2023-06-30 08:19:49', '2023-06-30 08:19:49', 0),
(38, 'fhkjsahfkdjh@gmail.com', 'dsafkhdsjhk', 'askdjhfkjsadf', 36, '2023-06-30 08:23:17', '2023-06-30 08:23:17', 0),
(39, 'fasdfasd@gmail.com', 'dsaffasd', 'sadkfjaskjdfhkajsdhfjkdsf', 33, '2023-06-30 08:25:48', '2023-06-30 08:25:48', 0),
(40, 'asdf@gmail.com', 'afsdf', 'asdkjhfajsdhfkjh', 31, '2023-06-30 08:27:13', '2023-06-30 08:27:13', 0),
(41, 'asdfsadf@gmail.com', 'asdfasd', 'fasjdkjfhaksdf', 37, '2023-06-30 08:31:31', '2023-06-30 08:31:31', 0),
(43, 'fhdskf@gmail.com', 'asdfajsfdkjh', 'dskfjsadkfsdjkf\r\n', 31, '2023-06-30 08:37:14', '2023-06-30 08:37:14', 0),
(44, 'fhkajsdfkh@gmail.com', 'fhdkjhak', 'fjadlksjfls', 36, '2023-06-30 09:02:11', '2023-06-30 09:02:11', 0),
(45, 'asfd@gmail.com', 'asdfasdf', 'sdhfjksadf', 36, '2023-06-30 09:16:13', '2023-06-30 09:16:13', 0),
(46, 'dsf@gmail.com', 'sadfs', 'fdsfds', 36, '2023-06-30 09:16:46', '2023-06-30 09:16:46', 0),
(47, 'asdfas@gmail.com', 'afasfd', 'kjadfasd', 36, '2023-06-30 09:22:22', '2023-06-30 09:22:22', 0),
(48, 'asfd@gmail.com', 'fasasdf', 'akjshdfkjhasdf', 36, '2023-06-30 09:23:40', '2023-06-30 09:23:40', 0),
(49, 'asdf@gmail.com', 'adffas', 'fjadskhfsad', 36, '2023-06-30 09:24:07', '2023-06-30 09:24:07', 0),
(50, 'asdf@gmail.com', 'fasdf', 'fjkdashfas', 36, '2023-06-30 09:25:02', '2023-06-30 09:25:02', 0),
(51, 'asdffas@gmail.com', 'asdfsa', 'asjkdhkfjasd', 36, '2023-06-30 09:26:26', '2023-06-30 09:26:26', 0),
(52, 'fkasfdjhk@gmail.com', 'fasdfasdk', 'akjsdfjhsad', 36, '2023-06-30 09:27:35', '2023-06-30 09:27:35', 0),
(53, 'asdf@gmail.com', 'asdfasf', 'akjdshfja', 36, '2023-06-30 09:27:58', '2023-06-30 09:27:58', 0),
(54, 'dfs@gmail.com', 'fsdaf', 'ahkjdsfhkajsdf', 36, '2023-06-30 09:31:38', '2023-06-30 09:31:38', 0),
(55, 'faskdhf@gmail.com', 'afsdfa', 'fakjshdfj', 36, '2023-06-30 09:32:40', '2023-06-30 09:32:40', 0),
(56, 'kajshjdh@gmail.com', 'asfasdhkfjh', 'kashdfjasd', 36, '2023-06-30 09:33:01', '2023-06-30 09:33:01', 0),
(57, 'fhaskfjh@gmail.com', 'afsdfhk', 'akshdfjhask', 36, '2023-06-30 09:35:18', '2023-06-30 09:35:18', 0),
(58, 'askjdhj@gmail.com', 'asdfaskj', 'kasdhfjsad', 36, '2023-06-30 09:35:45', '2023-06-30 09:35:45', 0),
(59, 'afdsfa@gmail.com', 'asdfasd', 'akjsdfas', 36, '2023-06-30 09:38:04', '2023-06-30 09:38:04', 0),
(60, 'fdas@gmail.com', 'asdff', 'asdfas', 36, '2023-06-30 09:40:51', '2023-06-30 09:40:51', 0),
(61, 'fasfd@gmail.com', 'adsfas', 'askjdfhas', 36, '2023-06-30 09:42:53', '2023-06-30 09:42:53', 0),
(62, 'hkjdshfjah@gmail.com', 'asdfasfd', 'kasdhfhaskd', 36, '2023-06-30 09:44:33', '2023-06-30 09:44:33', 0),
(63, 'afsd@gmail.com', 'asdfas', 'hsakdfsa', 36, '2023-06-30 09:49:32', '2023-06-30 09:49:32', 0),
(64, 'afdsa@gmail.com', 'adsfas', 'skadhfs', 36, '2023-06-30 09:50:10', '2023-06-30 09:50:10', 0),
(65, 'hdsjhk@gmail.com', 'sfasfjh', 'hkashdf', 36, '2023-06-30 09:50:33', '2023-06-30 09:50:33', 0),
(66, 'hfjashkjfh@gmail.com', 'adsfas', 'kjfashfuhd', 36, '2023-06-30 09:51:00', '2023-06-30 09:51:00', 0),
(67, 'fhsakjh@gmail.com', 'asdfas', 'hfasjdgfhsja', 36, '2023-06-30 09:51:21', '2023-06-30 09:51:21', 0),
(68, 'asfa@gmail.com', 'asdfasd', 'asdfjhskad', 36, '2023-06-30 09:51:58', '2023-06-30 09:51:58', 0),
(69, 'fhakjshdkj@gmail.com', 'asdfash', 'akshkfdjhska', 36, '2023-06-30 09:52:45', '2023-06-30 09:52:45', 0),
(70, 'hfhkajh@gmai.com', 'asdfajh', 'ausdhkf', 36, '2023-06-30 09:53:13', '2023-06-30 09:53:13', 0),
(71, 'saf@asfd.com', 'afda', 'jhsgdf', 36, '2023-06-30 09:53:29', '2023-06-30 09:53:29', 0),
(72, 'asdf@gmail.com', 'asdf', 'ashjkdhfa', 36, '2023-06-30 09:53:52', '2023-06-30 09:53:52', 0),
(73, 'faskdfh@gmail.com', 'asdfas', 'fashfjksa', 36, '2023-06-30 09:55:44', '2023-06-30 09:55:44', 0),
(74, 'fas@gmail.com', 'afasf', 'asjhkdfas', 36, '2023-06-30 09:56:31', '2023-06-30 09:56:31', 0),
(75, 'asdf@gmail.com', 'asdfas', 'asdfas', 36, '2023-06-30 10:05:31', '2023-06-30 10:05:31', 0),
(76, 'asfdf@sdgf.sdf', 'asfd', 'dfasd', 36, '2023-06-30 10:06:24', '2023-06-30 10:06:24', 0),
(77, 'asdf@gfsd.sdgfd', 'asdf', 'sfdgsdfg', 36, '2023-06-30 10:06:41', '2023-06-30 10:06:41', 0),
(78, 'fasdf@gmail.com', 'sDFa', 'asfa', 36, '2023-06-30 10:08:09', '2023-06-30 10:08:09', 0),
(79, 'fasdf@gmail.com', 'asfdf', 'asf', 36, '2023-06-30 10:08:44', '2023-06-30 10:08:44', 0),
(80, 'fasdf@gmail.com', 'asdf', 'fasdf@gmail.com', 36, '2023-06-30 10:08:57', '2023-06-30 10:08:57', 0),
(82, 'asdf@gmail.com', 'asdfas', 'adhsfjhsakdf', 36, '2023-06-30 10:20:35', '2023-06-30 10:20:35', 0),
(87, 'demo@gmail.com', 'demo', 'demo123\r\n', 33, '2023-06-30 17:40:44', '2023-06-30 17:43:42', 1),
(88, 'demodemo@gmail.com', 'demo demo', 'demo demo', 33, '2023-06-30 17:41:21', '2023-06-30 17:43:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `editors`
--

CREATE TABLE `editors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `editors`
--

INSERT INTO `editors` (`id`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(2, 'dipu@gmail.com', 'Dipu chaudhary', 'Dipu123456', NULL, NULL),
(3, 'jeshan@gmail.com', 'Jeshan Tiwari', 'Jeshan123456', NULL, NULL),
(4, 'dipesh@gmail.com', 'dipesh', 'Dipesh@123', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `address`, `contact`, `email`, `message`, `created_at`) VALUES
(1, 'eafas', 'fadsf', '9852145635', 'asdfasd@gmail.com', 'afdsf', '2023-06-30 16:27:48'),
(2, 'asfdsadf', 'asfdas', '9852146523', 'adfasdf@gmail.com', 'afsdf', '2023-06-30 16:27:48'),
(3, 'Dipesh Chaudhary', 'Ratnanagar-4, Chitwan', '9852146325', 'techdipesh36@gmail.com', 'i have an issue please contact me\r\n', '2023-06-30 16:27:48'),
(4, 'jeshan', 'Ratnanagar,tandi', '9852145632', 'jeshan@gmail.com', 'ajdhfkahdsf', '2023-06-30 16:27:48'),
(5, 'test', 'tandi', '9852146321', 'test@gmail.com', 'i have a issue', '2023-06-30 16:27:48'),
(6, 'basu', 'Tandi', '9845632145', 'basu@gmail.com', 'Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document.\r\nTo make your document look professionally produced, Word provides header, footer, cover page, and text box designs that complement each other. For example, you can add a matching cover page, header, and sidebar. Click Insert and then choose the elements you want from the different galleries.\r\nThemes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme.\r\nSave time in Word with new buttons that show up where you need them. To change the way a picture fits in your document, click it and a button for layout options appears next to it. When you work on a table, click where you want to add a row or a column, and then click the plus sign.\r\nReading is easier, too, in the new Reading view. You can collapse parts of the document and focus on the text you want. If you need to stop reading before you reach the end, Word remembers where you left off - even on another device.\r\n\r\n', '2023-06-30 16:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `postBy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `image`, `cat_id`, `postBy`, `created_at`, `updated_at`) VALUES
(26, 'Govt to spare no effort in managing no-man\'s-land: DPM Shrestha', '<p>Deputy Prime Minister and Home Minister Narayan Kaji Shrestha clarified that the government had not issued any permission for installation of siren at Kechanakawal in Jhapa district and border outpost (BOP) in Sunsari district. Responding to the queries raised by parliamentarians in today\'s meeting of the House of Representatives, DPM Shrestha assured that the government would leave no stone unturned to further manage the no-man\'s-land and make it orderly. Shrestha informed the lawmakers that a total of 250 BOPs had been set up so far and more would be set up for border security. Considering the problems surfacing in national economy, the construction of additional BOP would be difficult for the government at present, admitted the DPM. He also assured that the government was committed towards arranging proper accommodation for the Nepal Police and the Armed Police Force\'s personnel, especially those guarding the borders in the BOP. On a different note, he shared that there had been no any official discussion on devising counter intelligence mechanism yet. However, he did not rule out the discussions on the same taken place informally from time to time. Stating that the government was serious about forceful conversion of religion, he also appraised the parliamentarians that some action were taken against those preaching religion with vested interest and those making others forcefully converting religion. According to him, yoga and meditation session would be conducted regularly in the security agencies and arrangements were placed to further motivate the traffic police personnel. Regarding the fake Bhutanese refugee scam and the culprit, the DPM stated that the culprits will not be spared and investigation into the scam was not closed. The government, according to him, had included research on marijuana for its medicinal use. Furthermore, the DPM shared the discussions were being held with the Prime Minister to bring the National Investigation Department under the Ministry of Home Affairs. It may be noted that the Department is currently under the Office of the Prime Minister and Council of Ministers.</p>', 'Bharatpur_202206241611471687747354_1024.jpg', 10, 'Dipesh chaudhary', '2023-06-25 17:27:57', '2023-06-26 16:13:33'),
(27, 'UML Chairman Oli invites national cricket players to meet up', '<p style=\"text-align: justify;\">CPN-UML Chairman KP Sharma Oli has invited the Nepali national cricket players to meet for dinner after returning from Zimbabwe to Nepal. After the Nepali team lost to the Netherlands on Saturday, he said on social media that one failure is not the end of the journey, but our journey continues. Oli said that he watched the match between the Nepalese team and the Netherlands live yesterday and said that he watched it even though there was some disturbance due to slow internet on his mobile phone. He said, \"Nepal did not get to participate in the ICC One Day Cricket World Cup. Hard work is like a mother, but the result is like a child. Sometimes, despite hard work, the result may not be achieved. We should not be disappointed. Although the result was not what we expected, the effort of the Nepali team was not weak.\" He thanked the Nepali cricket team for their hard work and said that one failure is not the end of the journey and our journey continues.</p>', 'Kathmandu_District_Court_Building1685152547_480X320.jpg', 19, 'Dipesh chaudhary', '2023-06-25 17:48:36', '2023-06-27 13:15:09'),
(29, 'NDRRMA warns of heat wave in monsoon as well', '<p>The National Disaster Risk Reduction and Management Authority (NDRRMA) has warned of the possibility of a heat wave in this monsoon.</p>\n<p>A heat wave may occur in monsoon albeit for a shorter duration as in the pre-monsoon season, the Authority said, urging all to stay alert to the potential atmospheric adversity.</p>\n<p>In this monsoon, rainfall less than average has been predicted and it happens, hotter days than overage are likely, according to Authority chief executive officer Anil Pokhrel. Under this situation, agricultural productions are likely to drop this year.</p>\n<p>Likewise, possibility remains for the infections of waterborne and communicable diseases in monsoon and the public are urged to be cautious about their health.</p>\n<p>In the past, health issues like jaundice, cholera, diarrhea, respiratory illnesses, malaria, dengue, influenza, and flu-like illnesses were season during rains.</p>\n<p>The data shows that the country reports around 500 deaths from cholera, kala-azar diarrhea and snakebites in monsoon each year.</p>', 'hot_weather1687700628_1024.jpg', 19, 'Dipesh chaudhary', '2023-06-25 18:31:29', '2023-06-26 14:39:02'),
(30, 'Birgunj Metropolitan City taken action against half dozen of internet, cable service', '<p>Birgunj Metropolitan City has taken action against half a dozen internet and cable service providers.</p>\r\n<p>The Metropolis took action against six internet and cable service providers after they turned deaf ear towards the frequent requests of Metropolis for wire management.</p>\r\n<p>Chief Administrative Officer of Metropolitan City, Laxmi Prasad Poudel, shared that they were compelled to take the legal action after the service providers neglected Metropolis\'s request to manage wires. The Metropolitan City has been carrying out activities to manage wires.</p>\r\n<p>The Metropolitan City has fined Rs 2,500 to internet and cable service providers&mdash;World Link, Vianet, Classic Tech, Subisu, and Dish Home each.</p>\r\n<p>The Metropolitan City had urged the internet and cable service providers to remove their wires as risk has been paused due to unmanaged wires lying on the road at different places including District Police Office and Om Ashram following a fire incident that occurred a few days ago.</p>\r\n<p>Brijesh Pradhan of Information Technology Section of Birgunj Metropolitan City said a stern action would be taken against such internet and cable service providers found hanging wires without permission of Metropolis.</p>', 'Best_Internet_Service_Providers_ISP_in_Nepal_2021_20221681185727_1024.jpg', 10, 'Dipesh chaudhary', '2023-06-26 09:58:33', '2023-06-26 09:58:33'),
(31, 'Weather Update: Possibility of light to moderate rain', '<p>Today</p>\r\n<p>Generally cloudy throughout the country.. Light to moderate rain with thunder and lightning is likely to occur at some places of Koshi Province, Bagmati Province, Gandaki Province, Lumbini Province and Sudur Pashchim Province and at a few places of rest of the provinces and , chances of heavy rainfall at one or two places of Koshi Province, Gandaki Province, Lumbini Province and Karnali Province.</p>\r\n<p>Tonight</p>\r\n<p>Generally cloudy in Koshi Province, Gandaki Province and Sudur Pashchim Province along with the hilly regions of the country and partly to generally cloudy in the rest of the country. Light to moderate rain with thunder and lightning is likely to occur at some places of Koshi Province, Bagmati Province, Gandaki Province, Lumbini Province and Sudur Pashchim Province and at a few places of rest of the provinces , chances of heavy rainfall at one or two places of the Gandaki Province, Lumbini Province and Sudur Pashchim Province.&nbsp;</p>', 'rain_(8_of_9)1677418613_1024.jpg', 17, 'Dipesh chaudhary', '2023-06-26 09:59:16', '2023-06-26 14:40:17'),
(33, '300 cattle vaccinated against LSD Gorkha', '<p>Three hundred cattle have been vaccinated against lumpy skin disease (LSD) in Gorkha municipality.</p>\r\n<p>The cattle of Gorkha municipality-13 and 14 were vaccinated against lumpy skin disease with technical support of Gorkha municipality Livestock Service Section and veterinary Hospital and Livestock Service Expert Centre, Gorkha, said Information Officer of Livestock Service Expert Centre, Dr Lalmani Aryal.</p>\r\n<p>He shared that a vaccination campaign was launched to vaccinate cattle in two wards of the municipality to control the diseases. The disease is spreading in the municipality.</p>\r\n<p>Aryal mentioned that Budhikoti Dairy production Cooperative provided financial support to run the vaccination programme. Cows and buffaloes affected from lumpy skin disease do not only decrease milk production, they might also die due to this if not treated on time.</p>\r\n<p>The disease has already spread in more than five local levels of Gorkha district&mdash;Bhimsen Thapa rural municipality, Sahid Lakhan eural municipality, Barpak rural municipality, Gandaki rural municipality and Dharche rural municipality.</p>\r\n<p>More than 58 cattle have died from lumpy skin disease in the district so far</p>', 'vaccine202112061816312021121407590420220708155706202207090856561657360507_1024.jpg', 18, 'Dipesh chaudhary', '2023-06-26 10:08:26', '2023-06-26 16:08:49'),
(36, 'Full press freedom to be in media law, policy: Minister Sharma', '<p>Minister for Communications and Information Technology Rekha Sharma vowed that the media and communications related laws and policies would have full press freedom. Necessary laws and policies would be formulated while some reviewed to make the mass communications sector dignified, accountable and credible, she added.</p>\r\n<p>Minister Sharma said it in the House of Representatives meeting on Sunday while responding to the queries raised by the lawmakers in relation to the budget allocation under the ministry she is heading. She informed me that a bill on public service broadcasting was presented in the parliament.</p>\r\n<p>According to her, the mass communications bill, Nepal Media Council bill, and bill on National Mass Communications Training Academy were being drafted. Efforts were on to prepare National Broadcasting Policy, Minister Sharma said, further informing that social media would be made well-managed. The ministry was allocated a total budget of Rs 8.71 billion for essential spending including administrative works and policy and law formulation.</p>\r\n<p>The allocation to the ministry accounts for 0.5 percent of the total budget. Among which, 94 percent goes to day-to-day compulsory spending. Moreover, the Information Minister reiterated government commitment that good governance and electronic governance would be promoted and integrity maintained. She informed the lawmakers that there were 242 televisions and 928 FM radios operating in the country, while, so far, the country has recorded the registration of 7,979 newspapers and 3,990 online media.</p>\r\n<p>Also the spokesperson of the government, Sharma said PSB bill was in the parliament for merging Radio Nepal and Nepal Television so that citizen\'s access to media would increase further and press freedom and accountability bolster.</p>\r\n<p>The Advertisement Board was working actively to not allow the advertisement of tobacco production and distribution which are injurious to human health. Emphasis was laid on the enforcement of journalists\' code of conduct and initiatives begun to make timely corrections on proportional distribution of advertisement to the media as per Advertisement Act.</p>\r\n<p>Other issues the Minister informed the parliament were government works on addressing the concept of gender-responsive budget, capacity building of women journalists, women\'s participation in information technology, women empowerment and inclusive development.</p>\r\n<p>RSS role significant Minister Sharma appreciated the role played by the Rastriya Samachar Samiti (RSS) on disseminating factual and credible information, thereby contributing hugely to Nepali journalism.</p>\r\n<p>An infographics was published by the ministry on the occasion of the 15th Republic Day this year.</p>\r\n<p>The government has accorded priority to citizen\'s access to IT, so broadband internet service was available in all local levels. Now, all wards would be provided quality internet service.</p>\r\n<p>As per information she shared, currently, 4,390 health centres and 5,318 community schools had installed broadband internet. This drive would be continued.</p>\r\n<p>Uniformity among government websites, effectiveness of integrated website management, reduction of cyber threats, launch of web monitoring system, ongoing process of integrated national cyber security policy by consulting cyber security experts, effective running of cyber security operation, formulation of policy on electronic data protection, upgrading and monitoring of government data were other issues the Minister addressed during the meeting.</p>\r\n<p>Moreover, her address featured capacity building of IT employees, cooperation with universities to produce a capable IT workforce, efforts to make effective postal service, security printing, and promotion of innovative technology to contribute to national ambition of prosperity.</p>', 'Minister_photo1687745387_1024.jpg', 10, 'Dipesh chaudhary', '2023-06-26 11:57:54', '2023-06-26 11:57:54'),
(37, 'Bharatpur Metropolitan City releases Rs 6.31 billion budget for FY 2080/081', '<p>The Bharatpur Metropolitan City has announced the budget of Rs 6.31 billion for the Fiscal Year 2080/081 BS.</p>\r\n<p>Deputy Mayor of Bharatpur Chitrasen Adhikari tabled the budget in the 13th municipal assembly on Sunday with the provision of Rs 1.75 billion as internal income, almost Rs 1.84 billion from intergovernmental fiscal transfer and Rs 540 million to be received from the revenue sharing from the federal and Bagmati Province government.</p>\r\n<p>Likewise, Rs 500 million would be received from public participation, Rs 1.65 billion from the bank deposit and Rs 30 million from Road Board, Nepal.</p>\r\n<p>Furthermore, Rs 1.1 billion is projected in the heading under the intergovernmental authority.</p>\r\n<p>The Bharatpur Metropolitan City has allocated Rs 1.65 billion for the incomplete projects in the current fiscal year and the multi-year projects. Similarly, provision has been made to implement the programmes from the ward-level and Rs 20 million has been allocated to each ward for the implementation of such projects.</p>\r\n<p>A Complementary Partnership Fund would be established and implemented for the development of mega and the strategically important projects for which Rs 100 million has been allocated for this.</p>\r\n<p>The Bharatpur Metropolitan City has allocated Rs 160 million for urban beautification and land-utilisation, and settlement development.</p>\r\n<p>Likewise, Rs 70 million has been allocated for the implementation of agriculture-related policy that include mechanization of agriculture, capacity building of farmers, technology transfer, production of seeds, providing grants to the farmers based on the quantity of the farmers and other activities.</p>\r\n<p>The Metropolitan City has allocated Rs 40 million to run special health programmes targeting children, senior citizens and women.</p>\r\n<p>Similarly, Rs 30 million has been allocated to complete the incomplete task of Gautam Buddha International Cricket Stadium establishing partnership and cooperation with the federal government and Bagmati Province government.</p>\r\n<p>Earlier, Mayor Renu Dahal had tabled the policies and programmes of the metropolitan city.</p>\r\n<p>&nbsp;</p>', 'Bharatpur_202206241611471687747354_1024.jpg', 10, 'Dipesh chaudhary', '2023-06-26 12:03:36', '2023-06-26 12:03:36'),
(40, 'Dhangadhi Sub-Metropolis releases budget of Rs 1.93 billion', '<p>Dhangadhi Sub-Metropolitan City has brought a budget of Rs 1.93 billion for the coming fiscal year 2080/81 BS.</p>\r\n<p>Presenting the budget for the coming fiscal year in the 10th municipal assembly of the sub-metropolis on Sunday, Deputy Mayor Kandakala Kumari Rana said Rs 1.17 billion has been estimated towards current expenditure and Rs 756.3 million towards capital expenditure.</p>\r\n<p>The highest 44 per cent of the total budget has been allocated towards social development which is Rs 853.6 million.</p>\r\n<p>A total of Rs 354 million to be received as internal income and Rs 469 million from revenue distribution, Rs 928 million from intergovernmental fiscal transfer.</p>\r\n<p>The budget has given priority to management of encroached public property, easy access of Dhangadhi sub-metropolis folks to basic needs including quality education, health and drinking water, commercialization of agriculture, livestock, industry and tourism sector, sustainable infrastructure development, sanitation and urban development.</p>', 'municipality_011687753770_1024.jpg', 21, 'Dipesh chaudhary', '2023-06-26 16:13:01', '2023-06-26 16:13:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_news_id_foreign` (`news_id`);

--
-- Indexes for table `editors`
--
ALTER TABLE `editors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_cat_id_foreign` (`cat_id`),
  ADD KEY `news_postby_foreign` (`postBy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `editors`
--
ALTER TABLE `editors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
