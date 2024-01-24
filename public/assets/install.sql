-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2023 at 08:06 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lock`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_identifier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchese_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `purchase_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agent_payment_keys`
--

CREATE TABLE `agent_payment_keys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `payment_keys` longtext,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `mode` varchar(255) DEFAULT NULL COMMENT 'live /test',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agent_review`
--

CREATE TABLE `agent_review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `review` longtext NOT NULL,
  `rating` varchar(255) NOT NULL,
  `dislike` varchar(255) NOT NULL DEFAULT '{}',
  `like` varchar(255) NOT NULL DEFAULT '{}',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `comment` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `listing_type_id` bigint(20) UNSIGNED NOT NULL,
  `zoom_meeting_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `thumbnail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_popular` int(11) NOT NULL,
  `likes` longtext COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `og_title` longtext COLLATE utf8_unicode_ci,
  `og_description` longtext COLLATE utf8_unicode_ci,
  `json_ld` longtext COLLATE utf8_unicode_ci,
  `og_image` longtext COLLATE utf8_unicode_ci,
  `canonical` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calculator_attribute`
--

CREATE TABLE `calculator_attribute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orders` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `is_featured` int(11) DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dial_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` int(11) DEFAULT NULL,
  `currency_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `dial_code`, `currency_name`, `currency_symbol`, `currency_code`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', '+93', 'Afghan afghani', 0, 0, NULL, NULL),
(2, 'Aland Islands', 'AX', '+358', '', 0, 0, NULL, NULL),
(3, 'Albania', 'AL', '+355', 'Albanian lek', 0, 0, NULL, NULL),
(4, 'Algeria', 'DZ', '+213', 'Algerian dinar', 0, 0, NULL, NULL),
(5, 'AmericanSamoa', 'AS', '+1684', '', 0, 0, NULL, NULL),
(6, 'Andorra', 'AD', '+376', 'Euro', 0, 0, NULL, NULL),
(7, 'Angola', 'AO', '+244', 'Angolan kwanza', 0, 0, NULL, NULL),
(8, 'Anguilla', 'AI', '+1264', 'East Caribbean dolla', 0, 0, NULL, NULL),
(9, 'Antarctica', 'AQ', '+672', '', 0, 0, NULL, NULL),
(10, 'Antigua and Barbuda', 'AG', '+1268', 'East Caribbean dolla', 0, 0, NULL, NULL),
(11, 'Argentina', 'AR', '+54', 'Argentine peso', 0, 0, NULL, NULL),
(12, 'Armenia', 'AM', '+374', 'Armenian dram', 0, 0, NULL, NULL),
(13, 'Aruba', 'AW', '+297', 'Aruban florin', 0, 0, NULL, NULL),
(14, 'Australia', 'AU', '+61', 'Australian dollar', 0, 0, NULL, NULL),
(15, 'Austria', 'AT', '+43', 'Euro', 0, 0, NULL, NULL),
(16, 'Azerbaijan', 'AZ', '+994', 'Azerbaijani manat', 0, 0, NULL, NULL),
(17, 'Bahamas', 'BS', '+1242', '', 0, 0, NULL, NULL),
(18, 'Bahrain', 'BH', '+973', 'Bahraini dinar', 0, 0, NULL, NULL),
(19, 'Bangladesh', 'BD', '+880', 'Bangladeshi taka', 0, 0, NULL, NULL),
(20, 'Barbados', 'BB', '+1246', 'Barbadian dollar', 0, 0, NULL, NULL),
(21, 'Belarus', 'BY', '+375', 'Belarusian ruble', 0, 0, NULL, NULL),
(22, 'Belgium', 'BE', '+32', 'Euro', 0, 0, NULL, NULL),
(23, 'Belize', 'BZ', '+501', 'Belize dollar', 0, 0, NULL, NULL),
(24, 'Benin', 'BJ', '+229', 'West African CFA fra', 0, 0, NULL, NULL),
(25, 'Bermuda', 'BM', '+1441', 'Bermudian dollar', 0, 0, NULL, NULL),
(26, 'Bhutan', 'BT', '+975', 'Bhutanese ngultrum', 0, 0, NULL, NULL),
(27, 'Bolivia, Plurination', 'BO', '+591', '', 0, 0, NULL, NULL),
(28, 'Bosnia and Herzegovi', 'BA', '+387', '', 0, 0, NULL, NULL),
(29, 'Botswana', 'BW', '+267', 'Botswana pula', 0, 0, NULL, NULL),
(30, 'Brazil', 'BR', '+55', 'Brazilian real', 0, 0, NULL, NULL),
(31, 'British Indian Ocean', 'IO', '+246', '', 0, 0, NULL, NULL),
(32, 'Brunei Darussalam', 'BN', '+673', '', 0, 0, NULL, NULL),
(33, 'Bulgaria', 'BG', '+359', 'Bulgarian lev', 0, 0, NULL, NULL),
(34, 'Burkina Faso', 'BF', '+226', 'West African CFA fra', 0, 0, NULL, NULL),
(35, 'Burundi', 'BI', '+257', 'Burundian franc', 0, 0, NULL, NULL),
(36, 'Cambodia', 'KH', '+855', 'Cambodian riel', 0, 0, NULL, NULL),
(37, 'Cameroon', 'CM', '+237', 'Central African CFA ', 0, 0, NULL, NULL),
(38, 'Canada', 'CA', '+1', 'Canadian dollar', 0, 0, NULL, NULL),
(39, 'Cape Verde', 'CV', '+238', 'Cape Verdean escudo', 0, 0, NULL, NULL),
(40, 'Cayman Islands', 'KY', '+ 345', 'Cayman Islands dolla', 0, 0, NULL, NULL),
(41, 'Central African Repu', 'CF', '+236', '', 0, 0, NULL, NULL),
(42, 'Chad', 'TD', '+235', 'Central African CFA ', 0, 0, NULL, NULL),
(43, 'Chile', 'CL', '+56', 'Chilean peso', 0, 0, NULL, NULL),
(44, 'China', 'CN', '+86', 'Chinese yuan', 0, 0, NULL, NULL),
(45, 'Christmas Island', 'CX', '+61', '', 0, 0, NULL, NULL),
(46, 'Cocos (Keeling) Isla', 'CC', '+61', '', 0, 0, NULL, NULL),
(47, 'Colombia', 'CO', '+57', 'Colombian peso', 0, 0, NULL, NULL),
(48, 'Comoros', 'KM', '+269', 'Comorian franc', 0, 0, NULL, NULL),
(49, 'Congo', 'CG', '+242', '', 0, 0, NULL, NULL),
(50, 'Congo, The Democrati', 'CD', '+243', '', 0, 0, NULL, NULL),
(51, 'Cook Islands', 'CK', '+682', 'New Zealand dollar', 0, 0, NULL, NULL),
(52, 'Costa Rica', 'CR', '+506', 'Costa Rican colón', 0, 0, NULL, NULL),
(53, 'Cote d\'Ivoire', 'CI', '+225', 'West African CFA fra', 0, 0, NULL, NULL),
(54, 'Croatia', 'HR', '+385', 'Croatian kuna', 0, 0, NULL, NULL),
(55, 'Cuba', 'CU', '+53', 'Cuban convertible pe', 0, 0, NULL, NULL),
(56, 'Cyprus', 'CY', '+357', 'Euro', 0, 0, NULL, NULL),
(57, 'Czech Republic', 'CZ', '+420', 'Czech koruna', 0, 0, NULL, NULL),
(58, 'Denmark', 'DK', '+45', 'Danish krone', 0, 0, NULL, NULL),
(59, 'Djibouti', 'DJ', '+253', 'Djiboutian franc', 0, 0, NULL, NULL),
(60, 'Dominica', 'DM', '+1767', 'East Caribbean dolla', 0, 0, NULL, NULL),
(61, 'Dominican Republic', 'DO', '+1849', 'Dominican peso', 0, 0, NULL, NULL),
(62, 'Ecuador', 'EC', '+593', 'United States dollar', 0, 0, NULL, NULL),
(63, 'Egypt', 'EG', '+20', 'Egyptian pound', 0, 0, NULL, NULL),
(64, 'El Salvador', 'SV', '+503', 'United States dollar', 0, 0, NULL, NULL),
(65, 'Equatorial Guinea', 'GQ', '+240', 'Central African CFA ', 0, 0, NULL, NULL),
(66, 'Eritrea', 'ER', '+291', 'Eritrean nakfa', 0, 0, NULL, NULL),
(67, 'Estonia', 'EE', '+372', 'Euro', 0, 0, NULL, NULL),
(68, 'Ethiopia', 'ET', '+251', 'Ethiopian birr', 0, 0, NULL, NULL),
(69, 'Falkland Islands (Ma', 'FK', '+500', '', 0, 0, NULL, NULL),
(70, 'Faroe Islands', 'FO', '+298', 'Danish krone', 0, 0, NULL, NULL),
(71, 'Fiji', 'FJ', '+679', 'Fijian dollar', 0, 0, NULL, NULL),
(72, 'Finland', 'FI', '+358', 'Euro', 0, 0, NULL, NULL),
(73, 'France', 'FR', '+33', 'Euro', 0, 0, NULL, NULL),
(74, 'French Guiana', 'GF', '+594', '', 0, 0, NULL, NULL),
(75, 'French Polynesia', 'PF', '+689', 'CFP franc', 0, 0, NULL, NULL),
(76, 'Gabon', 'GA', '+241', 'Central African CFA ', 0, 0, NULL, NULL),
(77, 'Gambia', 'GM', '+220', '', 0, 0, NULL, NULL),
(78, 'Georgia', 'GE', '+995', 'Georgian lari', 0, 0, NULL, NULL),
(79, 'Germany', 'DE', '+49', 'Euro', 0, 0, NULL, NULL),
(80, 'Ghana', 'GH', '+233', 'Ghana cedi', 0, 0, NULL, NULL),
(81, 'Gibraltar', 'GI', '+350', 'Gibraltar pound', 0, 0, NULL, NULL),
(82, 'Greece', 'GR', '+30', 'Euro', 0, 0, NULL, NULL),
(83, 'Greenland', 'GL', '+299', '', 0, 0, NULL, NULL),
(84, 'Grenada', 'GD', '+1473', 'East Caribbean dolla', 0, 0, NULL, NULL),
(85, 'Guadeloupe', 'GP', '+590', '', 0, 0, NULL, NULL),
(86, 'Guam', 'GU', '+1671', '', 0, 0, NULL, NULL),
(87, 'Guatemala', 'GT', '+502', 'Guatemalan quetzal', 0, 0, NULL, NULL),
(88, 'Guernsey', 'GG', '+44', 'British pound', 0, 0, NULL, NULL),
(89, 'Guinea', 'GN', '+224', 'Guinean franc', 0, 0, NULL, NULL),
(90, 'Guinea-Bissau', 'GW', '+245', 'West African CFA fra', 0, 0, NULL, NULL),
(91, 'Guyana', 'GY', '+595', 'Guyanese dollar', 0, 0, NULL, NULL),
(92, 'Haiti', 'HT', '+509', 'Haitian gourde', 0, 0, NULL, NULL),
(93, 'Holy See (Vatican Ci', 'VA', '+379', '', 0, 0, NULL, NULL),
(94, 'Honduras', 'HN', '+504', 'Honduran lempira', 0, 0, NULL, NULL),
(95, 'Hong Kong', 'HK', '+852', 'Hong Kong dollar', 0, 0, NULL, NULL),
(96, 'Hungary', 'HU', '+36', 'Hungarian forint', 0, 0, NULL, NULL),
(97, 'Iceland', 'IS', '+354', 'Icelandic króna', 0, 0, NULL, NULL),
(98, 'India', 'IN', '+91', 'Indian rupee', 0, 0, NULL, NULL),
(99, 'Indonesia', 'ID', '+62', 'Indonesian rupiah', 0, 0, NULL, NULL),
(100, 'Iran, Islamic Republ', 'IR', '+98', '', 0, 0, NULL, NULL),
(101, 'Iraq', 'IQ', '+964', 'Iraqi dinar', 0, 0, NULL, NULL),
(102, 'Ireland', 'IE', '+353', 'Euro', 0, 0, NULL, NULL),
(103, 'Isle of Man', 'IM', '+44', 'British pound', 0, 0, NULL, NULL),
(104, 'Israel', 'IL', '+972', 'Israeli new shekel', 0, 0, NULL, NULL),
(105, 'Italy', 'IT', '+39', 'Euro', 0, 0, NULL, NULL),
(106, 'Jamaica', 'JM', '+1876', 'Jamaican dollar', 0, 0, NULL, NULL),
(107, 'Japan', 'JP', '+81', 'Japanese yen', 0, 0, NULL, NULL),
(108, 'Jersey', 'JE', '+44', 'British pound', 0, 0, NULL, NULL),
(109, 'Jordan', 'JO', '+962', 'Jordanian dinar', 0, 0, NULL, NULL),
(110, 'Kazakhstan', 'KZ', '+7 7', 'Kazakhstani tenge', 0, 0, NULL, NULL),
(111, 'Kenya', 'KE', '+254', 'Kenyan shilling', 0, 0, NULL, NULL),
(112, 'Kiribati', 'KI', '+686', 'Australian dollar', 0, 0, NULL, NULL),
(113, 'Korea, Democratic Pe', 'KP', '+850', '', 0, 0, NULL, NULL),
(114, 'Korea, Republic of S', 'KR', '+82', '', 0, 0, NULL, NULL),
(115, 'Kuwait', 'KW', '+965', 'Kuwaiti dinar', 0, 0, NULL, NULL),
(116, 'Kyrgyzstan', 'KG', '+996', 'Kyrgyzstani som', 0, 0, NULL, NULL),
(117, 'Laos', 'LA', '+856', 'Lao kip', 0, 0, NULL, NULL),
(118, 'Latvia', 'LV', '+371', 'Euro', 0, 0, NULL, NULL),
(119, 'Lebanon', 'LB', '+961', 'Lebanese pound', 0, 0, NULL, NULL),
(120, 'Lesotho', 'LS', '+266', 'Lesotho loti', 0, 0, NULL, NULL),
(121, 'Liberia', 'LR', '+231', 'Liberian dollar', 0, 0, NULL, NULL),
(122, 'Libyan Arab Jamahiri', 'LY', '+218', '', 0, 0, NULL, NULL),
(123, 'Liechtenstein', 'LI', '+423', 'Swiss franc', 0, 0, NULL, NULL),
(124, 'Lithuania', 'LT', '+370', 'Euro', 0, 0, NULL, NULL),
(125, 'Luxembourg', 'LU', '+352', 'Euro', 0, 0, NULL, NULL),
(126, 'Macao', 'MO', '+853', '', 0, 0, NULL, NULL),
(127, 'Macedonia', 'MK', '+389', '', 0, 0, NULL, NULL),
(128, 'Madagascar', 'MG', '+261', 'Malagasy ariary', 0, 0, NULL, NULL),
(129, 'Malawi', 'MW', '+265', 'Malawian kwacha', 0, 0, NULL, NULL),
(130, 'Malaysia', 'MY', '+60', 'Malaysian ringgit', 0, 0, NULL, NULL),
(131, 'Maldives', 'MV', '+960', 'Maldivian rufiyaa', 0, 0, NULL, NULL),
(132, 'Mali', 'ML', '+223', 'West African CFA fra', 0, 0, NULL, NULL),
(133, 'Malta', 'MT', '+356', 'Euro', 0, 0, NULL, NULL),
(134, 'Marshall Islands', 'MH', '+692', 'United States dollar', 0, 0, NULL, NULL),
(135, 'Martinique', 'MQ', '+596', '', 0, 0, NULL, NULL),
(136, 'Mauritania', 'MR', '+222', 'Mauritanian ouguiya', 0, 0, NULL, NULL),
(137, 'Mauritius', 'MU', '+230', 'Mauritian rupee', 0, 0, NULL, NULL),
(138, 'Mayotte', 'YT', '+262', '', 0, 0, NULL, NULL),
(139, 'Mexico', 'MX', '+52', 'Mexican peso', 0, 0, NULL, NULL),
(140, 'Micronesia, Federate', 'FM', '+691', '', 0, 0, NULL, NULL),
(141, 'Moldova', 'MD', '+373', 'Moldovan leu', 0, 0, NULL, NULL),
(142, 'Monaco', 'MC', '+377', 'Euro', 0, 0, NULL, NULL),
(143, 'Mongolia', 'MN', '+976', 'Mongolian tögrög', 0, 0, NULL, NULL),
(144, 'Montenegro', 'ME', '+382', 'Euro', 0, 0, NULL, NULL),
(145, 'Montserrat', 'MS', '+1664', 'East Caribbean dolla', 0, 0, NULL, NULL),
(146, 'Morocco', 'MA', '+212', 'Moroccan dirham', 0, 0, NULL, NULL),
(147, 'Mozambique', 'MZ', '+258', 'Mozambican metical', 0, 0, NULL, NULL),
(148, 'Myanmar', 'MM', '+95', 'Burmese kyat', 0, 0, NULL, NULL),
(149, 'Namibia', 'NA', '+264', 'Namibian dollar', 0, 0, NULL, NULL),
(150, 'Nauru', 'NR', '+674', 'Australian dollar', 0, 0, NULL, NULL),
(151, 'Nepal', 'NP', '+977', 'Nepalese rupee', 0, 0, NULL, NULL),
(152, 'Netherlands', 'NL', '+31', 'Euro', 0, 0, NULL, NULL),
(153, 'Netherlands Antilles', 'AN', '+599', '', 0, 0, NULL, NULL),
(154, 'New Caledonia', 'NC', '+687', 'CFP franc', 0, 0, NULL, NULL),
(155, 'New Zealand', 'NZ', '+64', 'New Zealand dollar', 0, 0, NULL, NULL),
(156, 'Nicaragua', 'NI', '+505', 'Nicaraguan córdoba', 0, 0, NULL, NULL),
(157, 'Niger', 'NE', '+227', 'West African CFA fra', 0, 0, NULL, NULL),
(158, 'Nigeria', 'NG', '+234', 'Nigerian naira', 0, 0, NULL, NULL),
(159, 'Niue', 'NU', '+683', 'New Zealand dollar', 0, 0, NULL, NULL),
(160, 'Norfolk Island', 'NF', '+672', '', 0, 0, NULL, NULL),
(161, 'Northern Mariana Isl', 'MP', '+1670', '', 0, 0, NULL, NULL),
(162, 'Norway', 'NO', '+47', 'Norwegian krone', 0, 0, NULL, NULL),
(163, 'Oman', 'OM', '+968', 'Omani rial', 0, 0, NULL, NULL),
(164, 'Pakistan', 'PK', '+92', 'Pakistani rupee', 0, 0, NULL, NULL),
(165, 'Palau', 'PW', '+680', 'Palauan dollar', 0, 0, NULL, NULL),
(166, 'Palestinian Territor', 'PS', '+970', '', 0, 0, NULL, NULL),
(167, 'Panama', 'PA', '+507', 'Panamanian balboa', 0, 0, NULL, NULL),
(168, 'Papua New Guinea', 'PG', '+675', 'Papua New Guinean ki', 0, 0, NULL, NULL),
(169, 'Paraguay', 'PY', '+595', 'Paraguayan guaraní', 0, 0, NULL, NULL),
(170, 'Peru', 'PE', '+51', 'Peruvian nuevo sol', 0, 0, NULL, NULL),
(171, 'Philippines', 'PH', '+63', 'Philippine peso', 0, 0, NULL, NULL),
(172, 'Pitcairn', 'PN', '+872', '', 0, 0, NULL, NULL),
(173, 'Poland', 'PL', '+48', 'Polish z?oty', 0, 0, NULL, NULL),
(174, 'Portugal', 'PT', '+351', 'Euro', 0, 0, NULL, NULL),
(175, 'Puerto Rico', 'PR', '+1939', '', 0, 0, NULL, NULL),
(176, 'Qatar', 'QA', '+974', 'Qatari riyal', 0, 0, NULL, NULL),
(177, 'Romania', 'RO', '+40', 'Romanian leu', 0, 0, NULL, NULL),
(178, 'Russia', 'RU', '+7', 'Russian ruble', 0, 0, NULL, NULL),
(179, 'Rwanda', 'RW', '+250', 'Rwandan franc', 0, 0, NULL, NULL),
(180, 'Reunion', 'RE', '+262', '', 0, 0, NULL, NULL),
(181, 'Saint Barthelemy', 'BL', '+590', '', 0, 0, NULL, NULL),
(182, 'Saint Helena, Ascens', 'SH', '+290', '', 0, 0, NULL, NULL),
(183, 'Saint Kitts and Nevi', 'KN', '+1869', '', 0, 0, NULL, NULL),
(184, 'Saint Lucia', 'LC', '+1758', 'East Caribbean dolla', 0, 0, NULL, NULL),
(185, 'Saint Martin', 'MF', '+590', '', 0, 0, NULL, NULL),
(186, 'Saint Pierre and Miq', 'PM', '+508', '', 0, 0, NULL, NULL),
(187, 'Saint Vincent and th', 'VC', '+1784', '', 0, 0, NULL, NULL),
(188, 'Samoa', 'WS', '+685', 'Samoan t?l?', 0, 0, NULL, NULL),
(189, 'San Marino', 'SM', '+378', 'Euro', 0, 0, NULL, NULL),
(190, 'Sao Tome and Princip', 'ST', '+239', '', 0, 0, NULL, NULL),
(191, 'Saudi Arabia', 'SA', '+966', 'Saudi riyal', 0, 0, NULL, NULL),
(192, 'Senegal', 'SN', '+221', 'West African CFA fra', 0, 0, NULL, NULL),
(193, 'Serbia', 'RS', '+381', 'Serbian dinar', 0, 0, NULL, NULL),
(194, 'Seychelles', 'SC', '+248', 'Seychellois rupee', 0, 0, NULL, NULL),
(195, 'Sierra Leone', 'SL', '+232', 'Sierra Leonean leone', 0, 0, NULL, NULL),
(196, 'Singapore', 'SG', '+65', 'Brunei dollar', 0, 0, NULL, NULL),
(197, 'Slovakia', 'SK', '+421', 'Euro', 0, 0, NULL, NULL),
(198, 'Slovenia', 'SI', '+386', 'Euro', 0, 0, NULL, NULL),
(199, 'Solomon Islands', 'SB', '+677', 'Solomon Islands doll', 0, 0, NULL, NULL),
(200, 'Somalia', 'SO', '+252', 'Somali shilling', 0, 0, NULL, NULL),
(201, 'South Africa', 'ZA', '+27', 'South African rand', 0, 0, NULL, NULL),
(202, 'South Georgia and th', 'GS', '+500', '', 0, 0, NULL, NULL),
(203, 'Spain', 'ES', '+34', 'Euro', 0, 0, NULL, NULL),
(204, 'Sri Lanka', 'LK', '+94', 'Sri Lankan rupee', 0, 0, NULL, NULL),
(205, 'Sudan', 'SD', '+249', 'Sudanese pound', 0, 0, NULL, NULL),
(206, 'Suriname', 'SR', '+597', 'Surinamese dollar', 0, 0, NULL, NULL),
(207, 'Svalbard and Jan May', 'SJ', '+47', '', 0, 0, NULL, NULL),
(208, 'Swaziland', 'SZ', '+268', 'Swazi lilangeni', 0, 0, NULL, NULL),
(209, 'Sweden', 'SE', '+46', 'Swedish krona', 0, 0, NULL, NULL),
(210, 'Switzerland', 'CH', '+41', 'Swiss franc', 0, 0, NULL, NULL),
(211, 'Syrian Arab Republic', 'SY', '+963', '', 0, 0, NULL, NULL),
(212, 'Taiwan', 'TW', '+886', 'New Taiwan dollar', 0, 0, NULL, NULL),
(213, 'Tajikistan', 'TJ', '+992', 'Tajikistani somoni', 0, 0, NULL, NULL),
(214, 'Tanzania, United Rep', 'TZ', '+255', '', 0, 0, NULL, NULL),
(215, 'Thailand', 'TH', '+66', 'Thai baht', 0, 0, NULL, NULL),
(216, 'Timor-Leste', 'TL', '+670', '', 0, 0, NULL, NULL),
(217, 'Togo', 'TG', '+228', 'West African CFA fra', 0, 0, NULL, NULL),
(218, 'Tokelau', 'TK', '+690', '', 0, 0, NULL, NULL),
(219, 'Tonga', 'TO', '+676', 'Tongan pa?anga', 0, 0, NULL, NULL),
(220, 'Trinidad and Tobago', 'TT', '+1868', 'Trinidad and Tobago ', 0, 0, NULL, NULL),
(221, 'Tunisia', 'TN', '+216', 'Tunisian dinar', 0, 0, NULL, NULL),
(222, 'Turkey', 'TR', '+90', 'Turkish lira', 0, 0, NULL, NULL),
(223, 'Turkmenistan', 'TM', '+993', 'Turkmenistan manat', 0, 0, NULL, NULL),
(224, 'Turks and Caicos Isl', 'TC', '+1649', '', 0, 0, NULL, NULL),
(225, 'Tuvalu', 'TV', '+688', 'Australian dollar', 0, 0, NULL, NULL),
(226, 'Uganda', 'UG', '+256', 'Ugandan shilling', 0, 0, NULL, NULL),
(227, 'Ukraine', 'UA', '+380', 'Ukrainian hryvnia', 0, 0, NULL, NULL),
(228, 'United Arab Emirates', 'AE', '+971', 'United Arab Emirates', 0, 0, NULL, NULL),
(229, 'United Kingdom', 'GB', '+44', 'British pound', 0, 0, NULL, NULL),
(230, 'United States', 'US', '+1', 'United States dollar', 0, 0, NULL, NULL),
(231, 'Uruguay', 'UY', '+598', 'Uruguayan peso', 0, 0, NULL, NULL),
(232, 'Uzbekistan', 'UZ', '+998', 'Uzbekistani som', 0, 0, NULL, NULL),
(233, 'Vanuatu', 'VU', '+678', 'Vanuatu vatu', 0, 0, NULL, NULL),
(234, 'Venezuela, Bolivaria', 'VE', '+58', '', 0, 0, NULL, NULL),
(235, 'Vietnam', 'VN', '+84', 'Vietnamese ??ng', 0, 0, NULL, NULL),
(236, 'Virgin Islands, Brit', 'VG', '+1284', '', 0, 0, NULL, NULL),
(237, 'Virgin Islands, U.S.', 'VI', '+1340', '', 0, 0, NULL, NULL),
(238, 'Wallis and Futuna', 'WF', '+681', 'CFP franc', 0, 0, NULL, NULL),
(239, 'Yemen', 'YE', '+967', 'Yemeni rial', 0, 0, NULL, NULL),
(240, 'Zambia', 'ZM', '+260', 'Zambian kwacha', 0, 0, NULL, NULL),
(241, 'Zimbabwe', 'ZW', '+263', 'Botswana pula', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_supported` int(11) NOT NULL DEFAULT '0',
  `stripe_supported` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `paypal_supported`, `stripe_supported`) VALUES
(1, 'Leke', 'ALL', 'Lek', 0, 1),
(2, 'Dollars', 'USD', '$', 1, 1),
(3, 'Afghanis', 'AFN', '؋', 0, 1),
(4, 'Pesos', 'ARS', '$', 0, 1),
(5, 'Guilders', 'AWG', 'ƒ', 0, 1),
(6, 'Dollars', 'AUD', '$', 1, 1),
(7, 'New Manats', 'AZN', 'ман', 0, 1),
(8, 'Dollars', 'BSD', '$', 0, 1),
(9, 'Dollars', 'BBD', '$', 0, 1),
(10, 'Rubles', 'BYR', 'p.', 0, 0),
(11, 'Euro', 'EUR', '€', 1, 1),
(12, 'Dollars', 'BZD', 'BZ$', 0, 1),
(13, 'Dollars', 'BMD', '$', 0, 1),
(14, 'Bolivianos', 'BOB', '$b', 0, 1),
(15, 'Convertible Marka', 'BAM', 'KM', 0, 1),
(16, 'Pula', 'BWP', 'P', 0, 1),
(17, 'Leva', 'BGN', 'лв', 0, 1),
(18, 'Reais', 'BRL', 'R$', 1, 1),
(19, 'Pounds', 'GBP', '£', 1, 1),
(20, 'Dollars', 'BND', '$', 0, 1),
(21, 'Riels', 'KHR', '៛', 0, 1),
(22, 'Dollars', 'CAD', '$', 1, 1),
(23, 'Dollars', 'KYD', '$', 0, 1),
(24, 'Pesos', 'CLP', '$', 0, 1),
(25, 'Yuan Renminbi', 'CNY', '¥', 0, 1),
(26, 'Pesos', 'COP', '$', 0, 1),
(27, 'Colón', 'CRC', '₡', 0, 1),
(28, 'Kuna', 'HRK', 'kn', 0, 1),
(29, 'Pesos', 'CUP', '₱', 0, 0),
(30, 'Koruny', 'CZK', 'Kč', 1, 1),
(31, 'Kroner', 'DKK', 'kr', 1, 1),
(32, 'Pesos', 'DOP ', 'RD$', 0, 1),
(33, 'Dollars', 'XCD', '$', 0, 1),
(34, 'Pounds', 'EGP', '£', 0, 1),
(35, 'Colones', 'SVC', '$', 0, 0),
(36, 'Pounds', 'FKP', '£', 0, 1),
(37, 'Dollars', 'FJD', '$', 0, 1),
(38, 'Cedis', 'GHC', '¢', 0, 0),
(39, 'Pounds', 'GIP', '£', 0, 1),
(40, 'Quetzales', 'GTQ', 'Q', 0, 1),
(41, 'Pounds', 'GGP', '£', 0, 0),
(42, 'Dollars', 'GYD', '$', 0, 1),
(43, 'Lempiras', 'HNL', 'L', 0, 1),
(44, 'Dollars', 'HKD', '$', 1, 1),
(45, 'Forint', 'HUF', 'Ft', 1, 1),
(46, 'Kronur', 'ISK', 'kr', 0, 1),
(47, 'Rupees', 'INR', 'Rp', 1, 1),
(48, 'Rupiahs', 'IDR', 'Rp', 0, 1),
(49, 'Rials', 'IRR', '﷼', 0, 0),
(50, 'Pounds', 'IMP', '£', 0, 0),
(51, 'New Shekels', 'ILS', '₪', 1, 1),
(52, 'Dollars', 'JMD', 'J$', 0, 1),
(53, 'Yen', 'JPY', '¥', 1, 1),
(54, 'Pounds', 'JEP', '£', 0, 0),
(55, 'Tenge', 'KZT', 'лв', 0, 1),
(56, 'Won', 'KPW', '₩', 0, 0),
(57, 'Won', 'KRW', '₩', 0, 1),
(58, 'Soms', 'KGS', 'лв', 0, 1),
(59, 'Kips', 'LAK', '₭', 0, 1),
(60, 'Lati', 'LVL', 'Ls', 0, 0),
(61, 'Pounds', 'LBP', '£', 0, 1),
(62, 'Dollars', 'LRD', '$', 0, 1),
(63, 'Switzerland Francs', 'CHF', 'CHF', 1, 1),
(64, 'Litai', 'LTL', 'Lt', 0, 0),
(65, 'Denars', 'MKD', 'ден', 0, 1),
(66, 'Ringgits', 'MYR', 'RM', 1, 1),
(67, 'Rupees', 'MUR', '₨', 0, 1),
(68, 'Pesos', 'MXN', '$', 1, 1),
(69, 'Tugriks', 'MNT', '₮', 0, 1),
(70, 'Meticais', 'MZN', 'MT', 0, 1),
(71, 'Dollars', 'NAD', '$', 0, 1),
(72, 'Rupees', 'NPR', '₨', 0, 1),
(73, 'Guilders', 'ANG', 'ƒ', 0, 1),
(74, 'Dollars', 'NZD', '$', 1, 1),
(75, 'Cordobas', 'NIO', 'C$', 0, 1),
(76, 'Nairas', 'NGN', '₦', 0, 1),
(77, 'Krone', 'NOK', 'kr', 1, 1),
(78, 'Rials', 'OMR', '﷼', 0, 0),
(79, 'Rupees', 'PKR', '₨', 0, 1),
(80, 'Balboa', 'PAB', 'B/.', 0, 1),
(81, 'Guarani', 'PYG', 'Gs', 0, 1),
(82, 'Nuevos Soles', 'PEN', 'S/.', 0, 1),
(83, 'Pesos', 'PHP', 'Php', 1, 1),
(84, 'Zlotych', 'PLN', 'zł', 1, 1),
(85, 'Rials', 'QAR', '﷼', 0, 1),
(86, 'New Lei', 'RON', 'lei', 0, 1),
(87, 'Rubles', 'RUB', 'руб', 0, 1),
(88, 'Pounds', 'SHP', '£', 0, 1),
(89, 'Riyals', 'SAR', '﷼', 0, 1),
(90, 'Dinars', 'RSD', 'Дин.', 0, 1),
(91, 'Rupees', 'SCR', '₨', 0, 1),
(92, 'Dollars', 'SGD', '$', 1, 1),
(93, 'Dollars', 'SBD', '$', 0, 1),
(94, 'Shillings', 'SOS', 'S', 0, 1),
(95, 'Rand', 'ZAR', 'R', 0, 1),
(96, 'Rupees', 'LKR', '₨', 0, 1),
(97, 'Kronor', 'SEK', 'kr', 1, 1),
(98, 'Dollars', 'SRD', '$', 0, 1),
(99, 'Pounds', 'SYP', '£', 0, 0),
(100, 'New Dollars', 'TWD', 'NT$', 1, 1),
(101, 'Baht', 'THB', '฿', 1, 1),
(102, 'Dollars', 'TTD', 'TT$', 0, 1),
(103, 'Lira', 'TRY', 'TL', 0, 1),
(104, 'Liras', 'TRL', '£', 0, 0),
(105, 'Dollars', 'TVD', '$', 0, 0),
(106, 'Hryvnia', 'UAH', '₴', 0, 1),
(107, 'Pesos', 'UYU', '$U', 0, 1),
(108, 'Sums', 'UZS', 'лв', 0, 1),
(109, 'Bolivares Fuertes', 'VEF', 'Bs', 0, 0),
(110, 'Dong', 'VND', '₫', 0, 1),
(111, 'Rials', 'YER', '﷼', 0, 1),
(112, 'Zimbabwe Dollars', 'ZWD', 'Z$', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_subscribes`
--

CREATE TABLE `email_subscribes` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `frontend_settings`
--

CREATE TABLE `frontend_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `frontend_settings`
--

INSERT INTO `frontend_settings` (`id`, `type`, `description`) VALUES
(1, 'light_logo', ''),
(2, 'dark_logo', ''),
(3, 'favicon', ''),
(4, 'blog_visibility_on_home_page', '1'),
(5, 'global_blog_title', 'Blog'),
(6, 'global_blog_subtitle', 'Our Latest Blog'),
(7, 'website_title', 'Discover A Place Where You\'ll Love To Live'),
(8, 'website_subtitle', 'Create subscription-based packages for your agents and list real estate properties in your application'),
(9, 'feature_city_subtitle', 'Explore a Neighborhood or City'),
(10, 'real_estate_subtitle', 'The featured listings are progressively below'),
(20, 'real_estate_title', 'Search Properties for Buy and Rent'),
(21, 're_subtitle', 'Lorem Ipsum available, but the majority have suffered alteration.'),
(22, 're_listing_title', 'The featured listings are progressively below.'),
(23, 'faq_title', 'Frequently Asked Questions.'),
(24, 'faq_subtitle', 'Lorem Ipsum available, but the majority have suffered alteration some'),
(25, 'blog_title', 'Blog'),
(26, 'blog_subtitle', 'Our Latest Blog'),
(27, 'feature_video_title', 'Trending Business Places'),
(28, 'feature_video_subtitle', 'Prepare to be inspired by delight in luxury stunning property highlights'),
(29, 'feature_video_description', 'Prepare to be inspired by delight in luxury stunning property highlights'),
(30, 'feature_video_url', ''),
(31, 'footer_need_help_text', 'We are Always here for you! Knock us on Messenger anytime or Call our Hotline (10AM - 10PM)'),
(32, 'facebook_link', 'https://www.facebook.com/CreativeitemApps'),
(33, 'twitter_link', 'https://twitter.com/creativeitem'),
(34, 'linkedin_link', 'https://www.linkedin.com/company/creativeitem/'),
(35, 'instagram_link', 'https://www.instagram.com/creativeitem.developers/'),
(36, 'footer_description', 'Perfect choice for your real estate business to start and publish a real estate business'),
(37, 'directory_title', 'A Comprehensive Directory Database'),
(38, 'bannar', ''),
(39, 'footer_logo', ''),
(40, 'video_image', ''),
(41, 'website_hero_title', 'We provide the best'),
(42, 'feature_city_title', 'Find your property city'),
(43, 'pricing_subtitle', 'PRICING PLAN'),
(44, 'pricing_title', 'Pricing Plan for Real Estate');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `identifier` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phrase` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `translated` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `identifier`, `phrase`, `translated`) VALUES
(1, 'english', 'Real Estate', 'Real Estate'),
(2, 'english', 'Home', 'Home'),
(3, 'english', 'Manage Listing Type', 'Manage Listing Type'),
(4, 'english', 'Back', 'Back'),
(5, 'english', 'Property Type', 'Property Type'),
(6, 'english', 'Property Information', 'Property Information'),
(7, 'english', 'Property Amenities', 'Property Amenities'),
(8, 'english', 'Total Property Type', 'Total Property Type'),
(9, 'english', 'Add Property Type', 'Add Property Type'),
(10, 'english', 'Name', 'Name'),
(11, 'english', 'Options', 'Options'),
(12, 'english', 'Actions', 'Actions'),
(13, 'english', 'Update property Type', 'Update property Type'),
(14, 'english', 'Edit', 'Edit'),
(15, 'english', 'Delete', 'Delete'),
(16, 'english', 'Total Property Information', 'Total Property Information'),
(17, 'english', 'Add Property Information', 'Add Property Information'),
(18, 'english', 'No data found', 'No data found'),
(19, 'english', 'Total Property Amenity', 'Total Property Amenity'),
(20, 'english', 'Add Property Amenity', 'Add Property Amenity'),
(21, 'english', 'Icon', 'Icon'),
(22, 'english', 'Update property amenity', 'Update property amenity'),
(23, 'english', 'Admin', 'Admin'),
(24, 'english', 'Panel', 'Panel'),
(25, 'english', 'Locus', 'Locus'),
(26, 'english', 'Close', 'Close'),
(27, 'english', 'Dashboard', 'Dashboard'),
(28, 'english', 'Listing Type', 'Listing Type'),
(29, 'english', 'Users', 'Users'),
(30, 'english', 'Agent', 'Agent'),
(31, 'english', 'Customer', 'Customer'),
(32, 'english', 'Listings', 'Listings'),
(33, 'english', 'All Directories', 'All Directories'),
(34, 'english', 'State & City', 'State & City'),
(35, 'english', 'Blogs', 'Blogs'),
(36, 'english', 'All Blogs', 'All Blogs'),
(37, 'english', 'Create New Blog', 'Create New Blog'),
(38, 'english', 'Blog Category', 'Blog Category'),
(39, 'english', 'Blog Settings', 'Blog Settings'),
(40, 'english', 'Subscriptions', 'Subscriptions'),
(41, 'english', 'Price Package', 'Price Package'),
(42, 'english', 'Subscription Report', 'Subscription Report'),
(43, 'english', 'Pending Request', 'Pending Request'),
(44, 'english', 'Confirmed Payment', 'Confirmed Payment'),
(45, 'english', 'My Profile', 'My Profile'),
(46, 'english', 'Settings', 'Settings'),
(47, 'english', 'System Settings', 'System Settings'),
(48, 'english', 'Website Settings', 'Website Settings'),
(49, 'english', 'SEO Settings', 'SEO Settings'),
(50, 'english', 'Payment Settings', 'Payment Settings'),
(51, 'english', 'Smtp settings', 'Smtp settings'),
(52, 'english', 'Manage Faq', 'Manage Faq'),
(53, 'english', 'Map Settings', 'Map Settings'),
(54, 'english', 'Contact Settings', 'Contact Settings'),
(55, 'english', 'About', 'About'),
(56, 'english', 'Visit Website', 'Visit Website'),
(57, 'english', 'Read documentation', 'Read documentation'),
(58, 'english', 'Watch video tutorial', 'Watch video tutorial'),
(59, 'english', 'Get customer support', 'Get customer support'),
(60, 'english', 'Order customization', 'Order customization'),
(61, 'english', 'Request a new feature', 'Request a new feature'),
(62, 'english', 'My Account', 'My Account'),
(63, 'english', 'Change Password', 'Change Password'),
(64, 'english', 'Logout', 'Logout'),
(65, 'english', 'by', 'by'),
(66, 'english', 'All rights reserved', 'All rights reserved'),
(67, 'english', 'Loading...', 'Loading...'),
(68, 'english', 'Heads up', 'Heads up'),
(69, 'english', 'Are you sure', 'Are you sure'),
(70, 'english', 'Continue', 'Continue'),
(71, 'english', 'You won_t able to revert this', 'You won_t able to revert this'),
(72, 'english', 'Yes', 'Yes'),
(73, 'english', 'Cancel', 'Cancel'),
(74, 'english', 'Your title', 'Your title'),
(75, 'english', 'Listing', 'Listing'),
(76, 'english', 'Pricing', 'Pricing'),
(77, 'english', 'Blog', 'Blog'),
(78, 'english', 'Contact', 'Contact'),
(79, 'english', 'Login', 'Login'),
(80, 'english', 'Add Listing', 'Add Listing'),
(81, 'english', 'Discover A Place Where You_ll Love To Live', 'Discover A Place Where You_ll Love To Live'),
(82, 'english', 'All Citises', 'All Citises'),
(83, 'english', 'Choose Type', 'Choose Type'),
(84, 'english', 'Location', 'Location'),
(85, 'english', 'Explore from listing', 'Explore from listing'),
(86, 'english', 'See More Property', 'See More Property'),
(87, 'english', 'More Gallery', 'More Gallery'),
(88, 'english', 'A Comprehensive Directory Database', 'A Comprehensive Directory Database'),
(89, 'english', 'Total Listing', 'Total Listing'),
(90, 'english', 'Place In The World', 'Place In The World'),
(91, 'english', 'Happy Peoples', 'Happy Peoples'),
(92, 'english', 'Contact Us', 'Contact Us'),
(93, 'english', 'REVIEWS', 'REVIEWS'),
(94, 'english', 'What the people Thinks About Us.', 'What the people Thinks About Us.'),
(95, 'english', 'Subscribe', 'Subscribe'),
(96, 'english', 'Category', 'Category'),
(97, 'english', 'City', 'City'),
(98, 'english', 'Need Help', 'Need Help'),
(99, 'english', 'Resturent', 'Resturent'),
(100, 'english', 'Real State', 'Real State'),
(101, 'english', 'Apartment Hotel', 'Apartment Hotel'),
(102, 'english', 'Cars', 'Cars'),
(103, 'english', 'Bike', 'Bike'),
(104, 'english', 'Something Went Wrong', 'Something Went Wrong'),
(105, 'english', 'Error 404 page not found', 'Error 404 page not found'),
(106, 'english', 'Go to Home', 'Go to Home'),
(107, 'english', 'Sign into your account to start using Locus', 'Sign into your account to start using Locus'),
(108, 'english', 'Email', 'Email'),
(109, 'english', 'Password', 'Password'),
(110, 'english', 'Remember me', 'Remember me'),
(111, 'english', 'Forget password', 'Forget password'),
(112, 'english', 'Don_t have account', 'Don_t have account'),
(113, 'english', 'Sign up', 'Sign up'),
(114, 'english', 'Number of listing', 'Number of listing'),
(115, 'english', 'Total User', 'Total User'),
(116, 'english', 'Total Earning', 'Total Earning'),
(117, 'english', 'Number Of Agent', 'Number Of Agent'),
(118, 'english', 'Earning Chart:', 'Earning Chart:'),
(119, 'english', 'Search', 'Search'),
(120, 'english', 'Now showing', 'Now showing'),
(121, 'english', 'of', 'of'),
(122, 'english', 'Price Range', 'Price Range'),
(123, 'english', 'Price:', 'Price:'),
(124, 'english', 'Bedroom', 'Bedroom'),
(125, 'english', 'Bathrooms', 'Bathrooms'),
(126, 'english', 'Garage', 'Garage'),
(127, 'english', 'Type', 'Type'),
(128, 'english', 'Features', 'Features'),
(129, 'english', 'Cities', 'Cities'),
(130, 'english', 'States', 'States'),
(131, 'english', 'Map', 'Map'),
(132, 'english', 'Categories', 'Categories'),
(133, 'english', 'Recent Post', 'Recent Post'),
(134, 'english', 'Tag', 'Tag'),
(135, 'english', 'Reach Out to Our Team for Assistance and Inquiries', 'Reach Out to Our Team for Assistance and Inquiries'),
(136, 'english', 'Send a message', 'Send a message'),
(137, 'english', 'I am bound by the terms of the service I accept Privacy Policy', 'I am bound by the terms of the service I accept Privacy Policy'),
(138, 'english', 'Send Message', 'Send Message'),
(139, 'english', 'Verified', 'Verified'),
(140, 'english', 'Details info', 'Details info'),
(141, 'english', 'Phone Number', 'Phone Number'),
(142, 'english', 'Address', 'Address'),
(143, 'english', 'Cc', 'Cc'),
(144, 'english', 'H', 'H'),
(145, 'english', 'Zip code', 'Zip code'),
(146, 'english', 'Website', 'Website'),
(147, 'english', 'Facebook', 'Facebook'),
(148, 'english', 'Twitter', 'Twitter'),
(149, 'english', 'Linkedin', 'Linkedin'),
(150, 'english', 'Gender', 'Gender'),
(151, 'english', 'Male', 'Male'),
(152, 'english', 'Female', 'Female'),
(153, 'english', 'Country code', 'Country code'),
(154, 'english', 'Address Line', 'Address Line'),
(155, 'english', 'Photo', 'Photo'),
(156, 'english', 'Save Changes', 'Save Changes'),
(157, 'english', 'Profile info updated successfully', 'Profile info updated successfully'),
(158, 'english', 'Directories', 'Directories'),
(159, 'english', 'Create Customer', 'Create Customer'),
(160, 'english', 'State', 'State'),
(161, 'english', 'Create', 'Create'),
(162, 'english', 'Export', 'Export'),
(163, 'english', 'PDF', 'PDF'),
(164, 'english', 'Print', 'Print'),
(165, 'english', 'User Info', 'User Info'),
(166, 'english', 'Oprions', 'Oprions'),
(167, 'english', 'Phone', 'Phone'),
(168, 'english', 'Edit Customer', 'Edit Customer'),
(169, 'english', ' Deactive', ' Deactive'),
(170, 'english', 'Make Agent', 'Make Agent'),
(171, 'english', 'Showing', 'Showing'),
(172, 'english', 'from', 'from'),
(173, 'english', 'data', 'data'),
(174, 'english', 'update', 'update'),
(175, 'english', 'Edit Agent', 'Edit Agent'),
(176, 'english', 'Ban', 'Ban'),
(177, 'english', 'Deactive', 'Deactive'),
(178, 'english', 'List of State & Cities', 'List of State & Cities'),
(179, 'english', 'States & Cities', 'States & Cities'),
(180, 'english', 'Add new State', 'Add new State'),
(181, 'english', 'Add new Cities', 'Add new Cities'),
(182, 'english', 'Select Country First', 'Select Country First'),
(183, 'english', 'Property Name', 'Property Name'),
(184, 'english', 'Property Image (80 X 80)', 'Property Image (80 X 80)'),
(185, 'english', 'Create Property', 'Create Property'),
(186, 'english', 'Update Property', 'Update Property'),
(187, 'english', 'Country', 'Country'),
(188, 'english', 'Select a Country', 'Select a Country'),
(189, 'english', 'Afghanistan', 'Afghanistan'),
(190, 'english', 'Aland Islands', 'Aland Islands'),
(191, 'english', 'Albania', 'Albania'),
(192, 'english', 'Algeria', 'Algeria'),
(193, 'english', 'AmericanSamoa', 'AmericanSamoa'),
(194, 'english', 'Andorra', 'Andorra'),
(195, 'english', 'Angola', 'Angola'),
(196, 'english', 'Anguilla', 'Anguilla'),
(197, 'english', 'Antarctica', 'Antarctica'),
(198, 'english', 'Antigua and Barbuda', 'Antigua and Barbuda'),
(199, 'english', 'Argentina', 'Argentina'),
(200, 'english', 'Armenia', 'Armenia'),
(201, 'english', 'Aruba', 'Aruba'),
(202, 'english', 'Australia', 'Australia'),
(203, 'english', 'Austria', 'Austria'),
(204, 'english', 'Azerbaijan', 'Azerbaijan'),
(205, 'english', 'Bahamas', 'Bahamas'),
(206, 'english', 'Bahrain', 'Bahrain'),
(207, 'english', 'Bangladesh', 'Bangladesh'),
(208, 'english', 'Barbados', 'Barbados'),
(209, 'english', 'Belarus', 'Belarus'),
(210, 'english', 'Belgium', 'Belgium'),
(211, 'english', 'Belize', 'Belize'),
(212, 'english', 'Benin', 'Benin'),
(213, 'english', 'Bermuda', 'Bermuda'),
(214, 'english', 'Bhutan', 'Bhutan'),
(215, 'english', 'Bolivia, Plurination', 'Bolivia, Plurination'),
(216, 'english', 'Bosnia and Herzegovi', 'Bosnia and Herzegovi'),
(217, 'english', 'Botswana', 'Botswana'),
(218, 'english', 'Brazil', 'Brazil'),
(219, 'english', 'British Indian Ocean', 'British Indian Ocean'),
(220, 'english', 'Brunei Darussalam', 'Brunei Darussalam'),
(221, 'english', 'Bulgaria', 'Bulgaria'),
(222, 'english', 'Burkina Faso', 'Burkina Faso'),
(223, 'english', 'Burundi', 'Burundi'),
(224, 'english', 'Cambodia', 'Cambodia'),
(225, 'english', 'Cameroon', 'Cameroon'),
(226, 'english', 'Canada', 'Canada'),
(227, 'english', 'Cape Verde', 'Cape Verde'),
(228, 'english', 'Cayman Islands', 'Cayman Islands'),
(229, 'english', 'Central African Repu', 'Central African Repu'),
(230, 'english', 'Chad', 'Chad'),
(231, 'english', 'Chile', 'Chile'),
(232, 'english', 'China', 'China'),
(233, 'english', 'Christmas Island', 'Christmas Island'),
(234, 'english', 'Cocos (Keeling) Isla', 'Cocos (Keeling) Isla'),
(235, 'english', 'Colombia', 'Colombia'),
(236, 'english', 'Comoros', 'Comoros'),
(237, 'english', 'Congo', 'Congo'),
(238, 'english', 'Congo, The Democrati', 'Congo, The Democrati'),
(239, 'english', 'Cook Islands', 'Cook Islands'),
(240, 'english', 'Costa Rica', 'Costa Rica'),
(241, 'english', 'Cote d_Ivoire', 'Cote d_Ivoire'),
(242, 'english', 'Croatia', 'Croatia'),
(243, 'english', 'Cuba', 'Cuba'),
(244, 'english', 'Cyprus', 'Cyprus'),
(245, 'english', 'Czech Republic', 'Czech Republic'),
(246, 'english', 'Denmark', 'Denmark'),
(247, 'english', 'Djibouti', 'Djibouti'),
(248, 'english', 'Dominica', 'Dominica'),
(249, 'english', 'Dominican Republic', 'Dominican Republic'),
(250, 'english', 'Ecuador', 'Ecuador'),
(251, 'english', 'Egypt', 'Egypt'),
(252, 'english', 'El Salvador', 'El Salvador'),
(253, 'english', 'Equatorial Guinea', 'Equatorial Guinea'),
(254, 'english', 'Eritrea', 'Eritrea'),
(255, 'english', 'Estonia', 'Estonia'),
(256, 'english', 'Ethiopia', 'Ethiopia'),
(257, 'english', 'Falkland Islands (Ma', 'Falkland Islands (Ma'),
(258, 'english', 'Faroe Islands', 'Faroe Islands'),
(259, 'english', 'Fiji', 'Fiji'),
(260, 'english', 'Finland', 'Finland'),
(261, 'english', 'France', 'France'),
(262, 'english', 'French Guiana', 'French Guiana'),
(263, 'english', 'French Polynesia', 'French Polynesia'),
(264, 'english', 'Gabon', 'Gabon'),
(265, 'english', 'Gambia', 'Gambia'),
(266, 'english', 'Georgia', 'Georgia'),
(267, 'english', 'Germany', 'Germany'),
(268, 'english', 'Ghana', 'Ghana'),
(269, 'english', 'Gibraltar', 'Gibraltar'),
(270, 'english', 'Greece', 'Greece'),
(271, 'english', 'Greenland', 'Greenland'),
(272, 'english', 'Grenada', 'Grenada'),
(273, 'english', 'Guadeloupe', 'Guadeloupe'),
(274, 'english', 'Guam', 'Guam'),
(275, 'english', 'Guatemala', 'Guatemala'),
(276, 'english', 'Guernsey', 'Guernsey'),
(277, 'english', 'Guinea', 'Guinea'),
(278, 'english', 'Guinea-Bissau', 'Guinea-Bissau'),
(279, 'english', 'Guyana', 'Guyana'),
(280, 'english', 'Haiti', 'Haiti'),
(281, 'english', 'Holy See (Vatican Ci', 'Holy See (Vatican Ci'),
(282, 'english', 'Honduras', 'Honduras'),
(283, 'english', 'Hong Kong', 'Hong Kong'),
(284, 'english', 'Hungary', 'Hungary'),
(285, 'english', 'Iceland', 'Iceland'),
(286, 'english', 'India', 'India'),
(287, 'english', 'Indonesia', 'Indonesia'),
(288, 'english', 'Iran, Islamic Republ', 'Iran, Islamic Republ'),
(289, 'english', 'Iraq', 'Iraq'),
(290, 'english', 'Ireland', 'Ireland'),
(291, 'english', 'Isle of Man', 'Isle of Man'),
(292, 'english', 'Israel', 'Israel'),
(293, 'english', 'Italy', 'Italy'),
(294, 'english', 'Jamaica', 'Jamaica'),
(295, 'english', 'Japan', 'Japan'),
(296, 'english', 'Jersey', 'Jersey'),
(297, 'english', 'Jordan', 'Jordan'),
(298, 'english', 'Kazakhstan', 'Kazakhstan'),
(299, 'english', 'Kenya', 'Kenya'),
(300, 'english', 'Kiribati', 'Kiribati'),
(301, 'english', 'Korea, Democratic Pe', 'Korea, Democratic Pe'),
(302, 'english', 'Korea, Republic of S', 'Korea, Republic of S'),
(303, 'english', 'Kuwait', 'Kuwait'),
(304, 'english', 'Kyrgyzstan', 'Kyrgyzstan'),
(305, 'english', 'Laos', 'Laos'),
(306, 'english', 'Latvia', 'Latvia'),
(307, 'english', 'Lebanon', 'Lebanon'),
(308, 'english', 'Lesotho', 'Lesotho'),
(309, 'english', 'Liberia', 'Liberia'),
(310, 'english', 'Libyan Arab Jamahiri', 'Libyan Arab Jamahiri'),
(311, 'english', 'Liechtenstein', 'Liechtenstein'),
(312, 'english', 'Lithuania', 'Lithuania'),
(313, 'english', 'Luxembourg', 'Luxembourg'),
(314, 'english', 'Macao', 'Macao'),
(315, 'english', 'Macedonia', 'Macedonia'),
(316, 'english', 'Madagascar', 'Madagascar'),
(317, 'english', 'Malawi', 'Malawi'),
(318, 'english', 'Malaysia', 'Malaysia'),
(319, 'english', 'Maldives', 'Maldives'),
(320, 'english', 'Mali', 'Mali'),
(321, 'english', 'Malta', 'Malta'),
(322, 'english', 'Marshall Islands', 'Marshall Islands'),
(323, 'english', 'Martinique', 'Martinique'),
(324, 'english', 'Mauritania', 'Mauritania'),
(325, 'english', 'Mauritius', 'Mauritius'),
(326, 'english', 'Mayotte', 'Mayotte'),
(327, 'english', 'Mexico', 'Mexico'),
(328, 'english', 'Micronesia, Federate', 'Micronesia, Federate'),
(329, 'english', 'Moldova', 'Moldova'),
(330, 'english', 'Monaco', 'Monaco'),
(331, 'english', 'Mongolia', 'Mongolia'),
(332, 'english', 'Montenegro', 'Montenegro'),
(333, 'english', 'Montserrat', 'Montserrat'),
(334, 'english', 'Morocco', 'Morocco'),
(335, 'english', 'Mozambique', 'Mozambique'),
(336, 'english', 'Myanmar', 'Myanmar'),
(337, 'english', 'Namibia', 'Namibia'),
(338, 'english', 'Nauru', 'Nauru'),
(339, 'english', 'Nepal', 'Nepal'),
(340, 'english', 'Netherlands', 'Netherlands'),
(341, 'english', 'Netherlands Antilles', 'Netherlands Antilles'),
(342, 'english', 'New Caledonia', 'New Caledonia'),
(343, 'english', 'New Zealand', 'New Zealand'),
(344, 'english', 'Nicaragua', 'Nicaragua'),
(345, 'english', 'Niger', 'Niger'),
(346, 'english', 'Nigeria', 'Nigeria'),
(347, 'english', 'Niue', 'Niue'),
(348, 'english', 'Norfolk Island', 'Norfolk Island'),
(349, 'english', 'Northern Mariana Isl', 'Northern Mariana Isl'),
(350, 'english', 'Norway', 'Norway'),
(351, 'english', 'Oman', 'Oman'),
(352, 'english', 'Pakistan', 'Pakistan'),
(353, 'english', 'Palau', 'Palau'),
(354, 'english', 'Palestinian Territor', 'Palestinian Territor'),
(355, 'english', 'Panama', 'Panama'),
(356, 'english', 'Papua New Guinea', 'Papua New Guinea'),
(357, 'english', 'Paraguay', 'Paraguay'),
(358, 'english', 'Peru', 'Peru'),
(359, 'english', 'Philippines', 'Philippines'),
(360, 'english', 'Pitcairn', 'Pitcairn'),
(361, 'english', 'Poland', 'Poland'),
(362, 'english', 'Portugal', 'Portugal'),
(363, 'english', 'Puerto Rico', 'Puerto Rico'),
(364, 'english', 'Qatar', 'Qatar'),
(365, 'english', 'Romania', 'Romania'),
(366, 'english', 'Russia', 'Russia'),
(367, 'english', 'Rwanda', 'Rwanda'),
(368, 'english', 'Reunion', 'Reunion'),
(369, 'english', 'Saint Barthelemy', 'Saint Barthelemy'),
(370, 'english', 'Saint Helena, Ascens', 'Saint Helena, Ascens'),
(371, 'english', 'Saint Kitts and Nevi', 'Saint Kitts and Nevi'),
(372, 'english', 'Saint Lucia', 'Saint Lucia'),
(373, 'english', 'Saint Martin', 'Saint Martin'),
(374, 'english', 'Saint Pierre and Miq', 'Saint Pierre and Miq'),
(375, 'english', 'Saint Vincent and th', 'Saint Vincent and th'),
(376, 'english', 'Samoa', 'Samoa'),
(377, 'english', 'San Marino', 'San Marino'),
(378, 'english', 'Sao Tome and Princip', 'Sao Tome and Princip'),
(379, 'english', 'Saudi Arabia', 'Saudi Arabia'),
(380, 'english', 'Senegal', 'Senegal'),
(381, 'english', 'Serbia', 'Serbia'),
(382, 'english', 'Seychelles', 'Seychelles'),
(383, 'english', 'Sierra Leone', 'Sierra Leone'),
(384, 'english', 'Singapore', 'Singapore'),
(385, 'english', 'Slovakia', 'Slovakia'),
(386, 'english', 'Slovenia', 'Slovenia'),
(387, 'english', 'Solomon Islands', 'Solomon Islands'),
(388, 'english', 'Somalia', 'Somalia'),
(389, 'english', 'South Africa', 'South Africa'),
(390, 'english', 'South Georgia and th', 'South Georgia and th'),
(391, 'english', 'Spain', 'Spain'),
(392, 'english', 'Sri Lanka', 'Sri Lanka'),
(393, 'english', 'Sudan', 'Sudan'),
(394, 'english', 'Suriname', 'Suriname'),
(395, 'english', 'Svalbard and Jan May', 'Svalbard and Jan May'),
(396, 'english', 'Swaziland', 'Swaziland'),
(397, 'english', 'Sweden', 'Sweden'),
(398, 'english', 'Switzerland', 'Switzerland'),
(399, 'english', 'Syrian Arab Republic', 'Syrian Arab Republic'),
(400, 'english', 'Taiwan', 'Taiwan'),
(401, 'english', 'Tajikistan', 'Tajikistan'),
(402, 'english', 'Tanzania, United Rep', 'Tanzania, United Rep'),
(403, 'english', 'Thailand', 'Thailand'),
(404, 'english', 'Timor-Leste', 'Timor-Leste'),
(405, 'english', 'Togo', 'Togo'),
(406, 'english', 'Tokelau', 'Tokelau'),
(407, 'english', 'Tonga', 'Tonga'),
(408, 'english', 'Trinidad and Tobago', 'Trinidad and Tobago'),
(409, 'english', 'Tunisia', 'Tunisia'),
(410, 'english', 'Turkey', 'Turkey'),
(411, 'english', 'Turkmenistan', 'Turkmenistan'),
(412, 'english', 'Turks and Caicos Isl', 'Turks and Caicos Isl'),
(413, 'english', 'Tuvalu', 'Tuvalu'),
(414, 'english', 'Uganda', 'Uganda'),
(415, 'english', 'Ukraine', 'Ukraine'),
(416, 'english', 'United Arab Emirates', 'United Arab Emirates'),
(417, 'english', 'United Kingdom', 'United Kingdom'),
(418, 'english', 'United States', 'United States'),
(419, 'english', 'Uruguay', 'Uruguay'),
(420, 'english', 'Uzbekistan', 'Uzbekistan'),
(421, 'english', 'Vanuatu', 'Vanuatu'),
(422, 'english', 'Venezuela, Bolivaria', 'Venezuela, Bolivaria'),
(423, 'english', 'Vietnam', 'Vietnam'),
(424, 'english', 'Virgin Islands, Brit', 'Virgin Islands, Brit'),
(425, 'english', 'Virgin Islands, U.S.', 'Virgin Islands, U.S.'),
(426, 'english', 'Wallis and Futuna', 'Wallis and Futuna'),
(427, 'english', 'Yemen', 'Yemen'),
(428, 'english', 'Zambia', 'Zambia'),
(429, 'english', 'Zimbabwe', 'Zimbabwe'),
(430, 'english', 'State Name', 'State Name'),
(431, 'english', 'State Thumbnail', 'State Thumbnail'),
(432, 'english', 'Add State', 'Add State'),
(433, 'english', 'Select a Country First', 'Select a Country First'),
(434, 'english', 'City Name', 'City Name'),
(435, 'english', 'Add City', 'Add City'),
(436, 'english', 'Number of Cities', 'Number of Cities'),
(437, 'english', 'Update state', 'Update state'),
(438, 'english', 'Update City', 'Update City'),
(439, 'english', 'Blog List', 'Blog List'),
(440, 'english', 'Add new blog', 'Add new blog'),
(441, 'english', 'Blog Categories', 'Blog Categories'),
(442, 'english', 'Add blog category', 'Add blog category'),
(443, 'english', 'Add Blog Form', 'Add Blog Form'),
(444, 'english', 'Create Blog', 'Create Blog'),
(445, 'english', 'Blog Title', 'Blog Title'),
(446, 'english', 'Select a category', 'Select a category'),
(447, 'english', 'Blog Description', 'Blog Description'),
(448, 'english', 'keywords', 'keywords'),
(449, 'english', 'Blog Thumbnail', 'Blog Thumbnail'),
(450, 'english', 'Do you want to mark it as popular', 'Do you want to mark it as popular'),
(451, 'english', 'Mark as popular', 'Mark as popular'),
(452, 'english', 'Meta Title', 'Meta Title'),
(453, 'english', 'Meta Keywords', 'Meta Keywords'),
(454, 'english', 'Meta Description', 'Meta Description'),
(455, 'english', 'Blog Category Title', 'Blog Category Title'),
(456, 'english', 'Blog Subtitle', 'Blog Subtitle'),
(457, 'english', '80 Charecter', '80 Charecter'),
(458, 'english', 'Title', 'Title'),
(459, 'english', 'Number of Blog', 'Number of Blog'),
(460, 'english', 'Edit blog category', 'Edit blog category'),
(461, 'english', 'Profile', 'Profile'),
(462, 'english', 'Places', 'Places'),
(463, 'english', 'Read More', 'Read More'),
(464, 'english', 'Featured', 'Featured'),
(465, 'english', 'Creator', 'Creator'),
(466, 'english', 'Status', 'Status'),
(467, 'english', 'Active', 'Active'),
(468, 'english', 'Inactive', 'Inactive'),
(469, 'english', 'Agents blog permission', 'Agents blog permission'),
(470, 'english', 'No', 'No'),
(471, 'english', 'Blog visibility on home page', 'Blog visibility on home page'),
(472, 'english', 'Visible', 'Visible'),
(473, 'english', 'Invisible', 'Invisible'),
(474, 'english', 'Time', 'Time'),
(475, 'english', 'Appointment Type', 'Appointment Type'),
(476, 'english', 'Property Id', 'Property Id'),
(477, 'english', 'delete it', 'delete it'),
(478, 'english', 'Add Meeting Link', 'Add Meeting Link'),
(479, 'english', 'Save', 'Save'),
(480, 'english', 'Join Now', 'Join Now'),
(481, 'english', 'My Customer Panel', 'My Customer Panel'),
(482, 'english', 'Wishlist', 'Wishlist'),
(483, 'english', 'Appointment', 'Appointment'),
(484, 'english', 'Messages', 'Messages'),
(485, 'english', 'Account', 'Account'),
(486, 'english', 'Following Agent', 'Following Agent'),
(487, 'english', 'My Agent Panel', 'My Agent Panel'),
(488, 'english', 'My Listings', 'My Listings'),
(489, 'english', 'Create Listings', 'Create Listings'),
(490, 'english', 'Subscription', 'Subscription'),
(491, 'english', 'Basic Info', 'Basic Info'),
(492, 'english', 'Full name', 'Full name'),
(493, 'english', 'Other', 'Other'),
(494, 'english', 'Bio', 'Bio'),
(495, 'english', 'Profile Photo', 'Profile Photo'),
(496, 'english', 'Company Logo (160 X 160)', 'Company Logo (160 X 160)'),
(497, 'english', 'Old Password', 'Old Password'),
(498, 'english', 'New Password', 'New Password'),
(499, 'english', 'Back to listing', 'Back to listing'),
(500, 'english', 'Property Title*', 'Property Title*'),
(501, 'english', 'Property Type*', 'Property Type*'),
(502, 'english', 'Select Property type', 'Select Property type'),
(503, 'english', 'Listing Type*', 'Listing Type*'),
(504, 'english', 'Rent', 'Rent'),
(505, 'english', 'Sell', 'Sell'),
(506, 'english', 'Description*', 'Description*'),
(507, 'english', 'Build In*', 'Build In*'),
(508, 'english', 'Size*', 'Size*'),
(509, 'english', 'Bedroom*', 'Bedroom*'),
(510, 'english', 'Bathroom*', 'Bathroom*'),
(511, 'english', 'Garage*', 'Garage*'),
(512, 'english', 'Price*', 'Price*'),
(513, 'english', 'Visibility', 'Visibility'),
(514, 'english', 'Hidden', 'Hidden'),
(515, 'english', 'Country*', 'Country*'),
(516, 'english', 'State*', 'State*'),
(517, 'english', 'City*', 'City*'),
(518, 'english', 'Area*', 'Area*'),
(519, 'english', 'Address*', 'Address*'),
(520, 'english', 'Postal Code*', 'Postal Code*'),
(521, 'english', 'Latitude*', 'Latitude*'),
(522, 'english', 'Longitude*', 'Longitude*'),
(523, 'english', 'Select Location*', 'Select Location*'),
(524, 'english', 'Save Address', 'Save Address'),
(525, 'english', 'Your selected', 'Your selected'),
(526, 'english', 'All', 'All'),
(527, 'english', 'Filter', 'Filter'),
(528, 'english', 'Add listings', 'Add listings'),
(529, 'english', 'Image', 'Image'),
(530, 'english', 'Price', 'Price'),
(531, 'english', 'Remove', 'Remove'),
(532, 'english', 'Edit Listing', 'Edit Listing'),
(533, 'english', 'Hide Listing', 'Hide Listing'),
(534, 'english', 'Remove Listing', 'Remove Listing'),
(535, 'english', 'Go Back', 'Go Back'),
(536, 'english', 'View on frontend', 'View on frontend'),
(537, 'english', 'Basic', 'Basic'),
(538, 'english', 'Property Details', 'Property Details'),
(539, 'english', 'SEO', 'SEO'),
(540, 'english', 'Media', 'Media'),
(541, 'english', 'Nearby', 'Nearby'),
(542, 'english', '3d Model', '3d Model'),
(543, 'english', 'Property Title', 'Property Title'),
(544, 'english', 'Property Status', 'Property Status'),
(545, 'english', 'Description', 'Description'),
(546, 'english', 'Save Basic', 'Save Basic'),
(547, 'english', 'Save Property', 'Save Property'),
(548, 'english', 'Selected Features', 'Selected Features'),
(549, 'english', 'Save Features', 'Save Features'),
(550, 'english', 'Area', 'Area'),
(551, 'english', 'Postal Code', 'Postal Code'),
(552, 'english', 'Latitude', 'Latitude'),
(553, 'english', 'Longitude', 'Longitude'),
(554, 'english', 'Select Location', 'Select Location'),
(555, 'english', 'Upload Photo', 'Upload Photo'),
(556, 'english', 'Floor design', 'Floor design'),
(557, 'english', 'Choose video link', 'Choose video link'),
(558, 'english', '---OR---', '---OR---'),
(559, 'english', 'Choose video file', 'Choose video file'),
(560, 'english', 'Video Link', 'Video Link'),
(561, 'english', 'Video Upload', 'Video Upload'),
(562, 'english', 'Click to upload or drag and drop', 'Click to upload or drag and drop'),
(563, 'english', 'Nearby Location', 'Nearby Location'),
(564, 'english', 'Add Nearby Location', 'Add Nearby Location'),
(565, 'english', 'Upload 3D Model:', 'Upload 3D Model:'),
(566, 'english', 'Upload A 3D Model', 'Upload A 3D Model'),
(567, 'english', 'Property Photo', 'Property Photo'),
(568, 'english', 'Floor Photo', 'Floor Photo'),
(569, 'english', 'Add a Nearby Location', 'Add a Nearby Location'),
(570, 'english', 'Save Nearby', 'Save Nearby'),
(571, 'english', 'Bed', 'Bed'),
(572, 'english', 'Bat', 'Bat'),
(573, 'english', 'Sqft', 'Sqft'),
(574, 'english', 'More', 'More'),
(575, 'english', 'Bedrooms', 'Bedrooms'),
(576, 'english', 'Square Feet', 'Square Feet'),
(577, 'english', 'Year Build', 'Year Build'),
(578, 'english', 'Apartment', 'Apartment'),
(579, 'english', 'ID', 'ID'),
(580, 'english', 'Beedrooms', 'Beedrooms'),
(581, 'english', 'Details', 'Details'),
(582, 'english', 'Property Size', 'Property Size'),
(583, 'english', 'Property Agent', 'Property Agent'),
(584, 'english', 'Get Direction', 'Get Direction'),
(585, 'english', 'Amenities', 'Amenities'),
(586, 'english', 'Floor Plans', 'Floor Plans'),
(587, 'english', 'Video', 'Video'),
(588, 'english', 'School', 'School'),
(589, 'english', 'Shopping Center', 'Shopping Center'),
(590, 'english', 'Hospital', 'Hospital'),
(591, 'english', 'Nearby Locations', 'Nearby Locations'),
(592, 'english', 'Schools', 'Schools'),
(593, 'english', 'Shopping-Center', 'Shopping-Center'),
(594, 'english', 'Agent Contact Details', 'Agent Contact Details'),
(595, 'english', 'View Details', 'View Details'),
(596, 'english', 'Listing by', 'Listing by'),
(597, 'english', 'Enquire About This Property', 'Enquire About This Property'),
(598, 'english', 'Your Message', 'Your Message'),
(599, 'english', 'Send', 'Send'),
(600, 'english', 'Write a Review', 'Write a Review'),
(601, 'english', 'Report this review', 'Report this review'),
(602, 'english', 'Rating', 'Rating'),
(603, 'english', 'Review', 'Review'),
(604, 'english', 'Submit Review', 'Submit Review'),
(605, 'english', 'Share', 'Share'),
(606, 'english', 'Book a Meeting', 'Book a Meeting'),
(607, 'english', 'Select Date And Time', 'Select Date And Time'),
(608, 'english', 'Tour Type', 'Tour Type'),
(609, 'english', 'In Person', 'In Person'),
(610, 'english', 'Vedio Chat', 'Vedio Chat'),
(611, 'english', 'Submit', 'Submit'),
(612, 'english', 'Related Property', 'Related Property'),
(613, 'english', 'Follow', 'Follow'),
(614, 'english', 'Create account to start using Locus', 'Create account to start using Locus'),
(615, 'english', 'SIGNUP', 'SIGNUP'),
(616, 'english', 'Already have an account', 'Already have an account'),
(617, 'english', 'Contact agent', 'Contact agent'),
(618, 'english', 'Saved', 'Saved'),
(619, 'english', 'Amenity name', 'Amenity name'),
(620, 'english', 'Icon picker', 'Icon picker'),
(621, 'english', 'Create Amenity', 'Create Amenity'),
(622, 'english', 'Packages', 'Packages'),
(623, 'english', 'Add Package', 'Add Package'),
(624, 'english', 'FRONTEND PRICING SETTINGS', 'FRONTEND PRICING SETTINGS'),
(625, 'english', 'Pricing Subtitle', 'Pricing Subtitle'),
(626, 'english', 'Pricing Title', 'Pricing Title'),
(627, 'english', 'Chose Package Icon', 'Chose Package Icon'),
(628, 'english', 'Package price', 'Package price'),
(629, 'english', 'Package Type', 'Package Type'),
(630, 'english', 'Select a package type', 'Select a package type'),
(631, 'english', 'Paid', 'Paid'),
(632, 'english', 'Trail', 'Trail'),
(633, 'english', 'Interval', 'Interval'),
(634, 'english', 'Select a interval', 'Select a interval'),
(635, 'english', 'Days', 'Days'),
(636, 'english', 'Monthly', 'Monthly'),
(637, 'english', 'Yearly', 'Yearly'),
(638, 'english', 'Interval Preiod', 'Interval Preiod'),
(639, 'english', 'Select a status', 'Select a status'),
(640, 'english', 'Services', 'Services'),
(641, 'english', 'Write service', 'Write service'),
(642, 'english', 'Create package', 'Create package'),
(643, 'english', 'Package', 'Package'),
(644, 'english', 'duration', 'duration'),
(645, 'english', 'Action', 'Action'),
(646, 'english', 'Enroll Now', 'Enroll Now'),
(647, 'english', 'Update package', 'Update package'),
(648, 'english', 'Update Nearby Location', 'Update Nearby Location'),
(649, 'english', 'More Category', 'More Category'),
(650, 'english', 'More City', 'More City'),
(651, 'english', 'Share On', 'Share On'),
(652, 'english', 'Meeting Link', 'Meeting Link'),
(653, 'english', 'No Meeting link Yet!', 'No Meeting link Yet!'),
(654, 'english', 'Become an Agent', 'Become an Agent'),
(655, 'english', 'Add question and answer', 'Add question and answer'),
(656, 'english', 'Question Title', 'Question Title'),
(657, 'english', 'Question Description', 'Question Description'),
(658, 'english', 'Update question and answer', 'Update question and answer'),
(659, 'english', 'Enter your payment details', 'Enter your payment details'),
(660, 'english', 'Update Info', 'Update Info'),
(661, 'english', 'TOTAL', 'TOTAL'),
(662, 'english', 'Payment Information', 'Payment Information'),
(663, 'english', 'By clicking', 'By clicking'),
(664, 'english', 'Start now', 'Start now'),
(665, 'english', 'you agree to the', 'you agree to the'),
(666, 'english', 'Edit Review', 'Edit Review'),
(667, 'english', 'Like', 'Like'),
(668, 'english', 'Dislike', 'Dislike'),
(669, 'english', 'Edit Your Review', 'Edit Your Review'),
(670, 'english', 'Update Review', 'Update Review'),
(671, 'english', 'Edit Blog Form', 'Edit Blog Form'),
(672, 'english', 'Update Blog', 'Update Blog'),
(673, 'english', 'Message', 'Message'),
(674, 'english', 'Choose an option from the left side', 'Choose an option from the left side'),
(675, 'english', 'Unfollow', 'Unfollow'),
(676, 'english', 'Website Title', 'Website Title'),
(677, 'english', 'System Title', 'System Title'),
(678, 'english', 'Meta Keyword', 'Meta Keyword'),
(679, 'english', 'System Email', 'System Email'),
(680, 'english', 'Meta pixel', 'Meta pixel'),
(681, 'english', 'Time zone', 'Time zone'),
(682, 'english', 'Select a Time zone', 'Select a Time zone'),
(683, 'english', 'Africa/Abidjan', 'Africa/Abidjan'),
(684, 'english', 'Africa/Accra', 'Africa/Accra'),
(685, 'english', 'Africa/Addis_Ababa', 'Africa/Addis_Ababa'),
(686, 'english', 'Africa/Algiers', 'Africa/Algiers'),
(687, 'english', 'Africa/Asmara', 'Africa/Asmara'),
(688, 'english', 'Africa/Bamako', 'Africa/Bamako'),
(689, 'english', 'Africa/Bangui', 'Africa/Bangui'),
(690, 'english', 'Africa/Banjul', 'Africa/Banjul'),
(691, 'english', 'Africa/Bissau', 'Africa/Bissau'),
(692, 'english', 'Africa/Blantyre', 'Africa/Blantyre'),
(693, 'english', 'Africa/Brazzaville', 'Africa/Brazzaville'),
(694, 'english', 'Africa/Bujumbura', 'Africa/Bujumbura'),
(695, 'english', 'Africa/Cairo', 'Africa/Cairo'),
(696, 'english', 'Africa/Casablanca', 'Africa/Casablanca'),
(697, 'english', 'Africa/Ceuta', 'Africa/Ceuta'),
(698, 'english', 'Africa/Conakry', 'Africa/Conakry'),
(699, 'english', 'Africa/Dakar', 'Africa/Dakar'),
(700, 'english', 'Africa/Dar_es_Salaam', 'Africa/Dar_es_Salaam'),
(701, 'english', 'Africa/Djibouti', 'Africa/Djibouti'),
(702, 'english', 'Africa/Douala', 'Africa/Douala'),
(703, 'english', 'Africa/El_Aaiun', 'Africa/El_Aaiun'),
(704, 'english', 'Africa/Freetown', 'Africa/Freetown'),
(705, 'english', 'Africa/Gaborone', 'Africa/Gaborone'),
(706, 'english', 'Africa/Harare', 'Africa/Harare'),
(707, 'english', 'Africa/Johannesburg', 'Africa/Johannesburg'),
(708, 'english', 'Africa/Juba', 'Africa/Juba'),
(709, 'english', 'Africa/Kampala', 'Africa/Kampala'),
(710, 'english', 'Africa/Khartoum', 'Africa/Khartoum'),
(711, 'english', 'Africa/Kigali', 'Africa/Kigali'),
(712, 'english', 'Africa/Kinshasa', 'Africa/Kinshasa'),
(713, 'english', 'Africa/Lagos', 'Africa/Lagos'),
(714, 'english', 'Africa/Libreville', 'Africa/Libreville'),
(715, 'english', 'Africa/Lome', 'Africa/Lome'),
(716, 'english', 'Africa/Luanda', 'Africa/Luanda'),
(717, 'english', 'Africa/Lubumbashi', 'Africa/Lubumbashi'),
(718, 'english', 'Africa/Lusaka', 'Africa/Lusaka'),
(719, 'english', 'Africa/Malabo', 'Africa/Malabo'),
(720, 'english', 'Africa/Maputo', 'Africa/Maputo'),
(721, 'english', 'Africa/Maseru', 'Africa/Maseru'),
(722, 'english', 'Africa/Mbabane', 'Africa/Mbabane'),
(723, 'english', 'Africa/Mogadishu', 'Africa/Mogadishu'),
(724, 'english', 'Africa/Monrovia', 'Africa/Monrovia'),
(725, 'english', 'Africa/Nairobi', 'Africa/Nairobi'),
(726, 'english', 'Africa/Ndjamena', 'Africa/Ndjamena'),
(727, 'english', 'Africa/Niamey', 'Africa/Niamey'),
(728, 'english', 'Africa/Nouakchott', 'Africa/Nouakchott'),
(729, 'english', 'Africa/Ouagadougou', 'Africa/Ouagadougou'),
(730, 'english', 'Africa/Porto-Novo', 'Africa/Porto-Novo'),
(731, 'english', 'Africa/Sao_Tome', 'Africa/Sao_Tome'),
(732, 'english', 'Africa/Tripoli', 'Africa/Tripoli'),
(733, 'english', 'Africa/Tunis', 'Africa/Tunis'),
(734, 'english', 'Africa/Windhoek', 'Africa/Windhoek'),
(735, 'english', 'America/Adak', 'America/Adak'),
(736, 'english', 'America/Anchorage', 'America/Anchorage'),
(737, 'english', 'America/Anguilla', 'America/Anguilla'),
(738, 'english', 'America/Antigua', 'America/Antigua'),
(739, 'english', 'America/Araguaina', 'America/Araguaina'),
(740, 'english', 'America/Argentina/Buenos_Aires', 'America/Argentina/Buenos_Aires'),
(741, 'english', 'America/Argentina/Catamarca', 'America/Argentina/Catamarca'),
(742, 'english', 'America/Argentina/Cordoba', 'America/Argentina/Cordoba'),
(743, 'english', 'America/Argentina/Jujuy', 'America/Argentina/Jujuy'),
(744, 'english', 'America/Argentina/La_Rioja', 'America/Argentina/La_Rioja'),
(745, 'english', 'America/Argentina/Mendoza', 'America/Argentina/Mendoza'),
(746, 'english', 'America/Argentina/Rio_Gallegos', 'America/Argentina/Rio_Gallegos'),
(747, 'english', 'America/Argentina/Salta', 'America/Argentina/Salta'),
(748, 'english', 'America/Argentina/San_Juan', 'America/Argentina/San_Juan'),
(749, 'english', 'America/Argentina/San_Luis', 'America/Argentina/San_Luis'),
(750, 'english', 'America/Argentina/Tucuman', 'America/Argentina/Tucuman'),
(751, 'english', 'America/Argentina/Ushuaia', 'America/Argentina/Ushuaia'),
(752, 'english', 'America/Aruba', 'America/Aruba'),
(753, 'english', 'America/Asuncion', 'America/Asuncion'),
(754, 'english', 'America/Atikokan', 'America/Atikokan'),
(755, 'english', 'America/Bahia', 'America/Bahia'),
(756, 'english', 'America/Bahia_Banderas', 'America/Bahia_Banderas'),
(757, 'english', 'America/Barbados', 'America/Barbados'),
(758, 'english', 'America/Belem', 'America/Belem'),
(759, 'english', 'America/Belize', 'America/Belize'),
(760, 'english', 'America/Blanc-Sablon', 'America/Blanc-Sablon'),
(761, 'english', 'America/Boa_Vista', 'America/Boa_Vista'),
(762, 'english', 'America/Bogota', 'America/Bogota'),
(763, 'english', 'America/Boise', 'America/Boise'),
(764, 'english', 'America/Cambridge_Bay', 'America/Cambridge_Bay'),
(765, 'english', 'America/Campo_Grande', 'America/Campo_Grande'),
(766, 'english', 'America/Cancun', 'America/Cancun'),
(767, 'english', 'America/Caracas', 'America/Caracas'),
(768, 'english', 'America/Cayenne', 'America/Cayenne'),
(769, 'english', 'America/Cayman', 'America/Cayman'),
(770, 'english', 'America/Chicago', 'America/Chicago'),
(771, 'english', 'America/Chihuahua', 'America/Chihuahua'),
(772, 'english', 'America/Ciudad_Juarez', 'America/Ciudad_Juarez'),
(773, 'english', 'America/Costa_Rica', 'America/Costa_Rica'),
(774, 'english', 'America/Creston', 'America/Creston'),
(775, 'english', 'America/Cuiaba', 'America/Cuiaba'),
(776, 'english', 'America/Curacao', 'America/Curacao'),
(777, 'english', 'America/Danmarkshavn', 'America/Danmarkshavn'),
(778, 'english', 'America/Dawson', 'America/Dawson'),
(779, 'english', 'America/Dawson_Creek', 'America/Dawson_Creek'),
(780, 'english', 'America/Denver', 'America/Denver'),
(781, 'english', 'America/Detroit', 'America/Detroit'),
(782, 'english', 'America/Dominica', 'America/Dominica'),
(783, 'english', 'America/Edmonton', 'America/Edmonton'),
(784, 'english', 'America/Eirunepe', 'America/Eirunepe'),
(785, 'english', 'America/El_Salvador', 'America/El_Salvador'),
(786, 'english', 'America/Fort_Nelson', 'America/Fort_Nelson'),
(787, 'english', 'America/Fortaleza', 'America/Fortaleza'),
(788, 'english', 'America/Glace_Bay', 'America/Glace_Bay'),
(789, 'english', 'America/Goose_Bay', 'America/Goose_Bay'),
(790, 'english', 'America/Grand_Turk', 'America/Grand_Turk'),
(791, 'english', 'America/Grenada', 'America/Grenada'),
(792, 'english', 'America/Guadeloupe', 'America/Guadeloupe'),
(793, 'english', 'America/Guatemala', 'America/Guatemala'),
(794, 'english', 'America/Guayaquil', 'America/Guayaquil'),
(795, 'english', 'America/Guyana', 'America/Guyana'),
(796, 'english', 'America/Halifax', 'America/Halifax'),
(797, 'english', 'America/Havana', 'America/Havana'),
(798, 'english', 'America/Hermosillo', 'America/Hermosillo'),
(799, 'english', 'America/Indiana/Indianapolis', 'America/Indiana/Indianapolis'),
(800, 'english', 'America/Indiana/Knox', 'America/Indiana/Knox'),
(801, 'english', 'America/Indiana/Marengo', 'America/Indiana/Marengo'),
(802, 'english', 'America/Indiana/Petersburg', 'America/Indiana/Petersburg'),
(803, 'english', 'America/Indiana/Tell_City', 'America/Indiana/Tell_City'),
(804, 'english', 'America/Indiana/Vevay', 'America/Indiana/Vevay'),
(805, 'english', 'America/Indiana/Vincennes', 'America/Indiana/Vincennes'),
(806, 'english', 'America/Indiana/Winamac', 'America/Indiana/Winamac'),
(807, 'english', 'America/Inuvik', 'America/Inuvik'),
(808, 'english', 'America/Iqaluit', 'America/Iqaluit'),
(809, 'english', 'America/Jamaica', 'America/Jamaica'),
(810, 'english', 'America/Juneau', 'America/Juneau'),
(811, 'english', 'America/Kentucky/Louisville', 'America/Kentucky/Louisville'),
(812, 'english', 'America/Kentucky/Monticello', 'America/Kentucky/Monticello'),
(813, 'english', 'America/Kralendijk', 'America/Kralendijk'),
(814, 'english', 'America/La_Paz', 'America/La_Paz'),
(815, 'english', 'America/Lima', 'America/Lima'),
(816, 'english', 'America/Los_Angeles', 'America/Los_Angeles'),
(817, 'english', 'America/Lower_Princes', 'America/Lower_Princes'),
(818, 'english', 'America/Maceio', 'America/Maceio'),
(819, 'english', 'America/Managua', 'America/Managua'),
(820, 'english', 'America/Manaus', 'America/Manaus'),
(821, 'english', 'America/Marigot', 'America/Marigot'),
(822, 'english', 'America/Martinique', 'America/Martinique'),
(823, 'english', 'America/Matamoros', 'America/Matamoros'),
(824, 'english', 'America/Mazatlan', 'America/Mazatlan'),
(825, 'english', 'America/Menominee', 'America/Menominee'),
(826, 'english', 'America/Merida', 'America/Merida'),
(827, 'english', 'America/Metlakatla', 'America/Metlakatla'),
(828, 'english', 'America/Mexico_City', 'America/Mexico_City'),
(829, 'english', 'America/Miquelon', 'America/Miquelon'),
(830, 'english', 'America/Moncton', 'America/Moncton'),
(831, 'english', 'America/Monterrey', 'America/Monterrey'),
(832, 'english', 'America/Montevideo', 'America/Montevideo'),
(833, 'english', 'America/Montserrat', 'America/Montserrat'),
(834, 'english', 'America/Nassau', 'America/Nassau'),
(835, 'english', 'America/New_York', 'America/New_York'),
(836, 'english', 'America/Nome', 'America/Nome'),
(837, 'english', 'America/Noronha', 'America/Noronha'),
(838, 'english', 'America/North_Dakota/Beulah', 'America/North_Dakota/Beulah'),
(839, 'english', 'America/North_Dakota/Center', 'America/North_Dakota/Center'),
(840, 'english', 'America/North_Dakota/New_Salem', 'America/North_Dakota/New_Salem'),
(841, 'english', 'America/Nuuk', 'America/Nuuk'),
(842, 'english', 'America/Ojinaga', 'America/Ojinaga'),
(843, 'english', 'America/Panama', 'America/Panama'),
(844, 'english', 'America/Paramaribo', 'America/Paramaribo'),
(845, 'english', 'America/Phoenix', 'America/Phoenix'),
(846, 'english', 'America/Port-au-Prince', 'America/Port-au-Prince'),
(847, 'english', 'America/Port_of_Spain', 'America/Port_of_Spain'),
(848, 'english', 'America/Porto_Velho', 'America/Porto_Velho'),
(849, 'english', 'America/Puerto_Rico', 'America/Puerto_Rico'),
(850, 'english', 'America/Punta_Arenas', 'America/Punta_Arenas'),
(851, 'english', 'America/Rankin_Inlet', 'America/Rankin_Inlet'),
(852, 'english', 'America/Recife', 'America/Recife'),
(853, 'english', 'America/Regina', 'America/Regina'),
(854, 'english', 'America/Resolute', 'America/Resolute'),
(855, 'english', 'America/Rio_Branco', 'America/Rio_Branco'),
(856, 'english', 'America/Santarem', 'America/Santarem'),
(857, 'english', 'America/Santiago', 'America/Santiago'),
(858, 'english', 'America/Santo_Domingo', 'America/Santo_Domingo'),
(859, 'english', 'America/Sao_Paulo', 'America/Sao_Paulo'),
(860, 'english', 'America/Scoresbysund', 'America/Scoresbysund'),
(861, 'english', 'America/Sitka', 'America/Sitka'),
(862, 'english', 'America/St_Barthelemy', 'America/St_Barthelemy'),
(863, 'english', 'America/St_Johns', 'America/St_Johns'),
(864, 'english', 'America/St_Kitts', 'America/St_Kitts'),
(865, 'english', 'America/St_Lucia', 'America/St_Lucia'),
(866, 'english', 'America/St_Thomas', 'America/St_Thomas'),
(867, 'english', 'America/St_Vincent', 'America/St_Vincent'),
(868, 'english', 'America/Swift_Current', 'America/Swift_Current'),
(869, 'english', 'America/Tegucigalpa', 'America/Tegucigalpa'),
(870, 'english', 'America/Thule', 'America/Thule'),
(871, 'english', 'America/Tijuana', 'America/Tijuana'),
(872, 'english', 'America/Toronto', 'America/Toronto'),
(873, 'english', 'America/Tortola', 'America/Tortola'),
(874, 'english', 'America/Vancouver', 'America/Vancouver'),
(875, 'english', 'America/Whitehorse', 'America/Whitehorse'),
(876, 'english', 'America/Winnipeg', 'America/Winnipeg'),
(877, 'english', 'America/Yakutat', 'America/Yakutat'),
(878, 'english', 'Antarctica/Casey', 'Antarctica/Casey'),
(879, 'english', 'Antarctica/Davis', 'Antarctica/Davis'),
(880, 'english', 'Antarctica/DumontDUrville', 'Antarctica/DumontDUrville'),
(881, 'english', 'Antarctica/Macquarie', 'Antarctica/Macquarie'),
(882, 'english', 'Antarctica/Mawson', 'Antarctica/Mawson'),
(883, 'english', 'Antarctica/McMurdo', 'Antarctica/McMurdo'),
(884, 'english', 'Antarctica/Palmer', 'Antarctica/Palmer'),
(885, 'english', 'Antarctica/Rothera', 'Antarctica/Rothera'),
(886, 'english', 'Antarctica/Syowa', 'Antarctica/Syowa'),
(887, 'english', 'Antarctica/Troll', 'Antarctica/Troll'),
(888, 'english', 'Antarctica/Vostok', 'Antarctica/Vostok'),
(889, 'english', 'Arctic/Longyearbyen', 'Arctic/Longyearbyen'),
(890, 'english', 'Asia/Aden', 'Asia/Aden'),
(891, 'english', 'Asia/Almaty', 'Asia/Almaty'),
(892, 'english', 'Asia/Amman', 'Asia/Amman'),
(893, 'english', 'Asia/Anadyr', 'Asia/Anadyr'),
(894, 'english', 'Asia/Aqtau', 'Asia/Aqtau'),
(895, 'english', 'Asia/Aqtobe', 'Asia/Aqtobe'),
(896, 'english', 'Asia/Ashgabat', 'Asia/Ashgabat'),
(897, 'english', 'Asia/Atyrau', 'Asia/Atyrau'),
(898, 'english', 'Asia/Baghdad', 'Asia/Baghdad'),
(899, 'english', 'Asia/Bahrain', 'Asia/Bahrain'),
(900, 'english', 'Asia/Baku', 'Asia/Baku'),
(901, 'english', 'Asia/Bangkok', 'Asia/Bangkok'),
(902, 'english', 'Asia/Barnaul', 'Asia/Barnaul'),
(903, 'english', 'Asia/Beirut', 'Asia/Beirut'),
(904, 'english', 'Asia/Bishkek', 'Asia/Bishkek'),
(905, 'english', 'Asia/Brunei', 'Asia/Brunei'),
(906, 'english', 'Asia/Chita', 'Asia/Chita'),
(907, 'english', 'Asia/Choibalsan', 'Asia/Choibalsan'),
(908, 'english', 'Asia/Colombo', 'Asia/Colombo'),
(909, 'english', 'Asia/Damascus', 'Asia/Damascus'),
(910, 'english', 'Asia/Dhaka', 'Asia/Dhaka'),
(911, 'english', 'Asia/Dili', 'Asia/Dili'),
(912, 'english', 'Asia/Dubai', 'Asia/Dubai'),
(913, 'english', 'Asia/Dushanbe', 'Asia/Dushanbe'),
(914, 'english', 'Asia/Famagusta', 'Asia/Famagusta'),
(915, 'english', 'Asia/Gaza', 'Asia/Gaza'),
(916, 'english', 'Asia/Hebron', 'Asia/Hebron'),
(917, 'english', 'Asia/Ho_Chi_Minh', 'Asia/Ho_Chi_Minh'),
(918, 'english', 'Asia/Hong_Kong', 'Asia/Hong_Kong'),
(919, 'english', 'Asia/Hovd', 'Asia/Hovd'),
(920, 'english', 'Asia/Irkutsk', 'Asia/Irkutsk'),
(921, 'english', 'Asia/Jakarta', 'Asia/Jakarta'),
(922, 'english', 'Asia/Jayapura', 'Asia/Jayapura'),
(923, 'english', 'Asia/Jerusalem', 'Asia/Jerusalem'),
(924, 'english', 'Asia/Kabul', 'Asia/Kabul'),
(925, 'english', 'Asia/Kamchatka', 'Asia/Kamchatka'),
(926, 'english', 'Asia/Karachi', 'Asia/Karachi'),
(927, 'english', 'Asia/Kathmandu', 'Asia/Kathmandu'),
(928, 'english', 'Asia/Khandyga', 'Asia/Khandyga'),
(929, 'english', 'Asia/Kolkata', 'Asia/Kolkata'),
(930, 'english', 'Asia/Krasnoyarsk', 'Asia/Krasnoyarsk'),
(931, 'english', 'Asia/Kuala_Lumpur', 'Asia/Kuala_Lumpur'),
(932, 'english', 'Asia/Kuching', 'Asia/Kuching'),
(933, 'english', 'Asia/Kuwait', 'Asia/Kuwait'),
(934, 'english', 'Asia/Macau', 'Asia/Macau'),
(935, 'english', 'Asia/Magadan', 'Asia/Magadan'),
(936, 'english', 'Asia/Makassar', 'Asia/Makassar'),
(937, 'english', 'Asia/Manila', 'Asia/Manila'),
(938, 'english', 'Asia/Muscat', 'Asia/Muscat'),
(939, 'english', 'Asia/Nicosia', 'Asia/Nicosia'),
(940, 'english', 'Asia/Novokuznetsk', 'Asia/Novokuznetsk'),
(941, 'english', 'Asia/Novosibirsk', 'Asia/Novosibirsk'),
(942, 'english', 'Asia/Omsk', 'Asia/Omsk'),
(943, 'english', 'Asia/Oral', 'Asia/Oral'),
(944, 'english', 'Asia/Phnom_Penh', 'Asia/Phnom_Penh'),
(945, 'english', 'Asia/Pontianak', 'Asia/Pontianak'),
(946, 'english', 'Asia/Pyongyang', 'Asia/Pyongyang'),
(947, 'english', 'Asia/Qatar', 'Asia/Qatar'),
(948, 'english', 'Asia/Qostanay', 'Asia/Qostanay'),
(949, 'english', 'Asia/Qyzylorda', 'Asia/Qyzylorda'),
(950, 'english', 'Asia/Riyadh', 'Asia/Riyadh'),
(951, 'english', 'Asia/Sakhalin', 'Asia/Sakhalin'),
(952, 'english', 'Asia/Samarkand', 'Asia/Samarkand'),
(953, 'english', 'Asia/Seoul', 'Asia/Seoul'),
(954, 'english', 'Asia/Shanghai', 'Asia/Shanghai'),
(955, 'english', 'Asia/Singapore', 'Asia/Singapore'),
(956, 'english', 'Asia/Srednekolymsk', 'Asia/Srednekolymsk'),
(957, 'english', 'Asia/Taipei', 'Asia/Taipei'),
(958, 'english', 'Asia/Tashkent', 'Asia/Tashkent'),
(959, 'english', 'Asia/Tbilisi', 'Asia/Tbilisi'),
(960, 'english', 'Asia/Tehran', 'Asia/Tehran'),
(961, 'english', 'Asia/Thimphu', 'Asia/Thimphu'),
(962, 'english', 'Asia/Tokyo', 'Asia/Tokyo'),
(963, 'english', 'Asia/Tomsk', 'Asia/Tomsk'),
(964, 'english', 'Asia/Ulaanbaatar', 'Asia/Ulaanbaatar'),
(965, 'english', 'Asia/Urumqi', 'Asia/Urumqi'),
(966, 'english', 'Asia/Ust-Nera', 'Asia/Ust-Nera'),
(967, 'english', 'Asia/Vientiane', 'Asia/Vientiane'),
(968, 'english', 'Asia/Vladivostok', 'Asia/Vladivostok'),
(969, 'english', 'Asia/Yakutsk', 'Asia/Yakutsk'),
(970, 'english', 'Asia/Yangon', 'Asia/Yangon'),
(971, 'english', 'Asia/Yekaterinburg', 'Asia/Yekaterinburg'),
(972, 'english', 'Asia/Yerevan', 'Asia/Yerevan'),
(973, 'english', 'Atlantic/Azores', 'Atlantic/Azores'),
(974, 'english', 'Atlantic/Bermuda', 'Atlantic/Bermuda'),
(975, 'english', 'Atlantic/Canary', 'Atlantic/Canary'),
(976, 'english', 'Atlantic/Cape_Verde', 'Atlantic/Cape_Verde'),
(977, 'english', 'Atlantic/Faroe', 'Atlantic/Faroe'),
(978, 'english', 'Atlantic/Madeira', 'Atlantic/Madeira'),
(979, 'english', 'Atlantic/Reykjavik', 'Atlantic/Reykjavik'),
(980, 'english', 'Atlantic/South_Georgia', 'Atlantic/South_Georgia'),
(981, 'english', 'Atlantic/St_Helena', 'Atlantic/St_Helena'),
(982, 'english', 'Atlantic/Stanley', 'Atlantic/Stanley'),
(983, 'english', 'Australia/Adelaide', 'Australia/Adelaide'),
(984, 'english', 'Australia/Brisbane', 'Australia/Brisbane'),
(985, 'english', 'Australia/Broken_Hill', 'Australia/Broken_Hill'),
(986, 'english', 'Australia/Darwin', 'Australia/Darwin'),
(987, 'english', 'Australia/Eucla', 'Australia/Eucla'),
(988, 'english', 'Australia/Hobart', 'Australia/Hobart'),
(989, 'english', 'Australia/Lindeman', 'Australia/Lindeman'),
(990, 'english', 'Australia/Lord_Howe', 'Australia/Lord_Howe'),
(991, 'english', 'Australia/Melbourne', 'Australia/Melbourne'),
(992, 'english', 'Australia/Perth', 'Australia/Perth'),
(993, 'english', 'Australia/Sydney', 'Australia/Sydney'),
(994, 'english', 'Europe/Amsterdam', 'Europe/Amsterdam'),
(995, 'english', 'Europe/Andorra', 'Europe/Andorra'),
(996, 'english', 'Europe/Astrakhan', 'Europe/Astrakhan'),
(997, 'english', 'Europe/Athens', 'Europe/Athens'),
(998, 'english', 'Europe/Belgrade', 'Europe/Belgrade'),
(999, 'english', 'Europe/Berlin', 'Europe/Berlin'),
(1000, 'english', 'Europe/Bratislava', 'Europe/Bratislava'),
(1001, 'english', 'Europe/Brussels', 'Europe/Brussels'),
(1002, 'english', 'Europe/Bucharest', 'Europe/Bucharest'),
(1003, 'english', 'Europe/Budapest', 'Europe/Budapest'),
(1004, 'english', 'Europe/Busingen', 'Europe/Busingen'),
(1005, 'english', 'Europe/Chisinau', 'Europe/Chisinau'),
(1006, 'english', 'Europe/Copenhagen', 'Europe/Copenhagen'),
(1007, 'english', 'Europe/Dublin', 'Europe/Dublin'),
(1008, 'english', 'Europe/Gibraltar', 'Europe/Gibraltar'),
(1009, 'english', 'Europe/Guernsey', 'Europe/Guernsey'),
(1010, 'english', 'Europe/Helsinki', 'Europe/Helsinki'),
(1011, 'english', 'Europe/Isle_of_Man', 'Europe/Isle_of_Man'),
(1012, 'english', 'Europe/Istanbul', 'Europe/Istanbul'),
(1013, 'english', 'Europe/Jersey', 'Europe/Jersey'),
(1014, 'english', 'Europe/Kaliningrad', 'Europe/Kaliningrad'),
(1015, 'english', 'Europe/Kirov', 'Europe/Kirov'),
(1016, 'english', 'Europe/Kyiv', 'Europe/Kyiv');
INSERT INTO `languages` (`id`, `identifier`, `phrase`, `translated`) VALUES
(1017, 'english', 'Europe/Lisbon', 'Europe/Lisbon'),
(1018, 'english', 'Europe/Ljubljana', 'Europe/Ljubljana'),
(1019, 'english', 'Europe/London', 'Europe/London'),
(1020, 'english', 'Europe/Luxembourg', 'Europe/Luxembourg'),
(1021, 'english', 'Europe/Madrid', 'Europe/Madrid'),
(1022, 'english', 'Europe/Malta', 'Europe/Malta'),
(1023, 'english', 'Europe/Mariehamn', 'Europe/Mariehamn'),
(1024, 'english', 'Europe/Minsk', 'Europe/Minsk'),
(1025, 'english', 'Europe/Monaco', 'Europe/Monaco'),
(1026, 'english', 'Europe/Moscow', 'Europe/Moscow'),
(1027, 'english', 'Europe/Oslo', 'Europe/Oslo'),
(1028, 'english', 'Europe/Paris', 'Europe/Paris'),
(1029, 'english', 'Europe/Podgorica', 'Europe/Podgorica'),
(1030, 'english', 'Europe/Prague', 'Europe/Prague'),
(1031, 'english', 'Europe/Riga', 'Europe/Riga'),
(1032, 'english', 'Europe/Rome', 'Europe/Rome'),
(1033, 'english', 'Europe/Samara', 'Europe/Samara'),
(1034, 'english', 'Europe/San_Marino', 'Europe/San_Marino'),
(1035, 'english', 'Europe/Sarajevo', 'Europe/Sarajevo'),
(1036, 'english', 'Europe/Saratov', 'Europe/Saratov'),
(1037, 'english', 'Europe/Simferopol', 'Europe/Simferopol'),
(1038, 'english', 'Europe/Skopje', 'Europe/Skopje'),
(1039, 'english', 'Europe/Sofia', 'Europe/Sofia'),
(1040, 'english', 'Europe/Stockholm', 'Europe/Stockholm'),
(1041, 'english', 'Europe/Tallinn', 'Europe/Tallinn'),
(1042, 'english', 'Europe/Tirane', 'Europe/Tirane'),
(1043, 'english', 'Europe/Ulyanovsk', 'Europe/Ulyanovsk'),
(1044, 'english', 'Europe/Vaduz', 'Europe/Vaduz'),
(1045, 'english', 'Europe/Vatican', 'Europe/Vatican'),
(1046, 'english', 'Europe/Vienna', 'Europe/Vienna'),
(1047, 'english', 'Europe/Vilnius', 'Europe/Vilnius'),
(1048, 'english', 'Europe/Volgograd', 'Europe/Volgograd'),
(1049, 'english', 'Europe/Warsaw', 'Europe/Warsaw'),
(1050, 'english', 'Europe/Zagreb', 'Europe/Zagreb'),
(1051, 'english', 'Europe/Zurich', 'Europe/Zurich'),
(1052, 'english', 'Indian/Antananarivo', 'Indian/Antananarivo'),
(1053, 'english', 'Indian/Chagos', 'Indian/Chagos'),
(1054, 'english', 'Indian/Christmas', 'Indian/Christmas'),
(1055, 'english', 'Indian/Cocos', 'Indian/Cocos'),
(1056, 'english', 'Indian/Comoro', 'Indian/Comoro'),
(1057, 'english', 'Indian/Kerguelen', 'Indian/Kerguelen'),
(1058, 'english', 'Indian/Mahe', 'Indian/Mahe'),
(1059, 'english', 'Indian/Maldives', 'Indian/Maldives'),
(1060, 'english', 'Indian/Mauritius', 'Indian/Mauritius'),
(1061, 'english', 'Indian/Mayotte', 'Indian/Mayotte'),
(1062, 'english', 'Indian/Reunion', 'Indian/Reunion'),
(1063, 'english', 'Pacific/Apia', 'Pacific/Apia'),
(1064, 'english', 'Pacific/Auckland', 'Pacific/Auckland'),
(1065, 'english', 'Pacific/Bougainville', 'Pacific/Bougainville'),
(1066, 'english', 'Pacific/Chatham', 'Pacific/Chatham'),
(1067, 'english', 'Pacific/Chuuk', 'Pacific/Chuuk'),
(1068, 'english', 'Pacific/Easter', 'Pacific/Easter'),
(1069, 'english', 'Pacific/Efate', 'Pacific/Efate'),
(1070, 'english', 'Pacific/Fakaofo', 'Pacific/Fakaofo'),
(1071, 'english', 'Pacific/Fiji', 'Pacific/Fiji'),
(1072, 'english', 'Pacific/Funafuti', 'Pacific/Funafuti'),
(1073, 'english', 'Pacific/Galapagos', 'Pacific/Galapagos'),
(1074, 'english', 'Pacific/Gambier', 'Pacific/Gambier'),
(1075, 'english', 'Pacific/Guadalcanal', 'Pacific/Guadalcanal'),
(1076, 'english', 'Pacific/Guam', 'Pacific/Guam'),
(1077, 'english', 'Pacific/Honolulu', 'Pacific/Honolulu'),
(1078, 'english', 'Pacific/Kanton', 'Pacific/Kanton'),
(1079, 'english', 'Pacific/Kiritimati', 'Pacific/Kiritimati'),
(1080, 'english', 'Pacific/Kosrae', 'Pacific/Kosrae'),
(1081, 'english', 'Pacific/Kwajalein', 'Pacific/Kwajalein'),
(1082, 'english', 'Pacific/Majuro', 'Pacific/Majuro'),
(1083, 'english', 'Pacific/Marquesas', 'Pacific/Marquesas'),
(1084, 'english', 'Pacific/Midway', 'Pacific/Midway'),
(1085, 'english', 'Pacific/Nauru', 'Pacific/Nauru'),
(1086, 'english', 'Pacific/Niue', 'Pacific/Niue'),
(1087, 'english', 'Pacific/Norfolk', 'Pacific/Norfolk'),
(1088, 'english', 'Pacific/Noumea', 'Pacific/Noumea'),
(1089, 'english', 'Pacific/Pago_Pago', 'Pacific/Pago_Pago'),
(1090, 'english', 'Pacific/Palau', 'Pacific/Palau'),
(1091, 'english', 'Pacific/Pitcairn', 'Pacific/Pitcairn'),
(1092, 'english', 'Pacific/Pohnpei', 'Pacific/Pohnpei'),
(1093, 'english', 'Pacific/Port_Moresby', 'Pacific/Port_Moresby'),
(1094, 'english', 'Pacific/Rarotonga', 'Pacific/Rarotonga'),
(1095, 'english', 'Pacific/Saipan', 'Pacific/Saipan'),
(1096, 'english', 'Pacific/Tahiti', 'Pacific/Tahiti'),
(1097, 'english', 'Pacific/Tarawa', 'Pacific/Tarawa'),
(1098, 'english', 'Pacific/Tongatapu', 'Pacific/Tongatapu'),
(1099, 'english', 'Pacific/Wake', 'Pacific/Wake'),
(1100, 'english', 'Pacific/Wallis', 'Pacific/Wallis'),
(1101, 'english', 'UTC', 'UTC'),
(1102, 'english', 'Purchase Code', 'Purchase Code'),
(1103, 'english', 'Footer Newsleter Title', 'Footer Newsleter Title'),
(1104, 'english', 'Footer Newsleter Short Description', 'Footer Newsleter Short Description'),
(1105, 'english', 'Email Verification', 'Email Verification'),
(1106, 'english', 'Select email verfication', 'Select email verfication'),
(1107, 'english', 'Enable', 'Enable'),
(1108, 'english', 'Disable', 'Disable'),
(1109, 'english', 'Footer Text', 'Footer Text'),
(1110, 'english', 'Footer Link', 'Footer Link'),
(1111, 'english', 'PRODUCT UPDATE', 'PRODUCT UPDATE'),
(1112, 'english', 'File', 'File'),
(1113, 'english', 'Recapcha Settings', 'Recapcha Settings'),
(1114, 'english', 'In Active', 'In Active'),
(1115, 'english', 'Site Key', 'Site Key'),
(1116, 'english', 'Secrect Key', 'Secrect Key'),
(1117, 'english', 'Update recapcha', 'Update recapcha'),
(1118, 'english', 'FRONTEND SETTINGS', 'FRONTEND SETTINGS'),
(1119, 'english', 'Website Hero Subtitle', 'Website Hero Subtitle'),
(1120, 'english', 'Website Subtitle', 'Website Subtitle'),
(1121, 'english', 'Feature City Title', 'Feature City Title'),
(1122, 'english', 'Feature City Subtitle', 'Feature City Subtitle'),
(1123, 'english', 'Real Estate Subtitle', 'Real Estate Subtitle'),
(1124, 'english', 'Feature Video Title', 'Feature Video Title'),
(1125, 'english', 'Feature Video Subtitle', 'Feature Video Subtitle'),
(1126, 'english', 'Feature Video Description', 'Feature Video Description'),
(1127, 'english', 'Feature Video Url', 'Feature Video Url'),
(1128, 'english', 'Directory Title', 'Directory Title'),
(1129, 'english', 'Footer Need Help Text', 'Footer Need Help Text'),
(1130, 'english', 'Instagram', 'Instagram'),
(1131, 'english', 'Footer Descripion', 'Footer Descripion'),
(1132, 'english', 'Header Light logo', 'Header Light logo'),
(1133, 'english', '(85 x 160)', '(85 x 160)'),
(1134, 'english', 'Header Dark logo', 'Header Dark logo'),
(1135, 'english', 'Favicon', 'Favicon'),
(1136, 'english', 'Footer logo', 'Footer logo'),
(1137, 'english', 'Banner Image', 'Banner Image'),
(1138, 'english', 'Choose a banner', 'Choose a banner'),
(1139, 'english', '(2000 x 500)', '(2000 x 500)'),
(1140, 'english', 'Video Image', 'Video Image'),
(1141, 'english', 'Choose a Video Image', 'Choose a Video Image'),
(1142, 'english', 'REAL-ESTATE SETTINGS', 'REAL-ESTATE SETTINGS'),
(1143, 'english', 'Real-Estate Title', 'Real-Estate Title'),
(1144, 'english', 'Real-Estate Subtitle', 'Real-Estate Subtitle'),
(1145, 'english', 'Listing Title', 'Listing Title'),
(1146, 'english', 'Faq Title', 'Faq Title'),
(1147, 'english', 'Faq Subtitle', 'Faq Subtitle'),
(1148, 'english', 'Manage SEO Settings', 'Manage SEO Settings'),
(1149, 'english', 'Click the enter button after writing your keyword', 'Click the enter button after writing your keyword'),
(1150, 'english', 'System Currency', 'System Currency'),
(1151, 'english', 'Global Currency', 'Global Currency'),
(1152, 'english', 'Select system currency', 'Select system currency'),
(1153, 'english', 'Currency Position', 'Currency Position'),
(1154, 'english', 'Left', 'Left'),
(1155, 'english', 'Right', 'Right'),
(1156, 'english', 'Left with a space', 'Left with a space'),
(1157, 'english', 'Right with a space', 'Right with a space'),
(1158, 'english', 'Update Currency', 'Update Currency'),
(1159, 'english', 'Stripe Settings', 'Stripe Settings'),
(1160, 'english', 'Mode', 'Mode'),
(1161, 'english', 'public key', 'public key'),
(1162, 'english', 'secret key', 'secret key'),
(1163, 'english', 'public live key', 'public live key'),
(1164, 'english', 'secret live key', 'secret live key'),
(1165, 'english', 'Paypal Settings', 'Paypal Settings'),
(1166, 'english', 'Protocol', 'Protocol'),
(1167, 'english', 'Smtp crypto', 'Smtp crypto'),
(1168, 'english', 'Smtp host', 'Smtp host'),
(1169, 'english', 'Smtp port', 'Smtp port'),
(1170, 'english', 'Smtp from email', 'Smtp from email'),
(1171, 'english', 'Smtp username', 'Smtp username'),
(1172, 'english', 'Smtp password', 'Smtp password'),
(1173, 'english', 'Write a Blog', 'Write a Blog'),
(1174, 'english', 'Add a new blog', 'Add a new blog'),
(1175, 'english', 'Back to blog list', 'Back to blog list'),
(1176, 'english', 'Choose a thumbnail', 'Choose a thumbnail'),
(1177, 'english', 'Choose your map', 'Choose your map'),
(1178, 'english', 'Openstreet Map', 'Openstreet Map'),
(1179, 'english', 'mapbox', 'mapbox'),
(1180, 'english', 'Map access Token ', 'Map access Token '),
(1181, 'english', 'Contact location', 'Contact location'),
(1182, 'english', 'Max Zoom Level', 'Max Zoom Level'),
(1183, 'english', 'Min zoom level on the listings page', 'Min zoom level on the listings page'),
(1184, 'english', 'Min zoom level on the directory page', 'Min zoom level on the directory page'),
(1185, 'english', 'Update Map', 'Update Map'),
(1186, 'english', 'Not found', 'Not found'),
(1187, 'english', 'About this application', 'About this application'),
(1188, 'english', 'Software version', 'Software version'),
(1189, 'english', 'Check update', 'Check update'),
(1190, 'english', 'PHP version', 'PHP version'),
(1191, 'english', 'Curl enable', 'Curl enable'),
(1192, 'english', 'Enabled', 'Enabled'),
(1193, 'english', 'Product license', 'Product license'),
(1194, 'english', 'Customer support status', 'Customer support status'),
(1195, 'english', 'Support expiry date', 'Support expiry date'),
(1196, 'english', 'Customer name', 'Customer name'),
(1197, 'english', 'Customer support', 'Customer support'),
(1198, 'english', 'Your Locus subscription receipt', 'Your Locus subscription receipt'),
(1199, 'english', 'Username', 'Username'),
(1200, 'english', 'Payment Method', 'Payment Method'),
(1201, 'english', 'Silver', 'Silver'),
(1202, 'english', 'Unlock Silver Facilities', 'Unlock Silver Facilities'),
(1203, 'english', 'Plan', 'Plan'),
(1204, 'english', 'Your current package price is', 'Your current package price is'),
(1205, 'english', 'It will exipired on ', 'It will exipired on '),
(1206, 'english', 'Invoicing', 'Invoicing'),
(1207, 'english', 'Last payment:', 'Last payment:'),
(1208, 'english', 'Modify Billing Information', 'Modify Billing Information'),
(1209, 'english', 'Billing History', 'Billing History'),
(1210, 'english', 'Reference', 'Reference'),
(1211, 'english', 'Date', 'Date'),
(1212, 'english', 'Download', 'Download'),
(1213, 'english', 'Package Name', 'Package Name'),
(1214, 'english', 'User', 'User'),
(1215, 'english', 'Purchase Date', 'Purchase Date'),
(1216, 'english', 'Expire Date', 'Expire Date'),
(1217, 'english', 'Video Chat', 'Video Chat'),
(1218, 'english', 'Enter valid purchase code', 'Enter valid purchase code'),
(1219, 'english', 'Invalid purchase code', 'Invalid purchase code'),
(1220, 'english', 'Purchase code has been updated', 'Purchase code has been updated'),
(1221, 'english', 'Company', 'Company'),
(1222, 'english', 'Choose your location', 'Choose your location'),
(1223, 'english', 'Choose your budget', 'Choose your budget'),
(1224, 'english', 'See All', 'See All'),
(1225, 'english', '1', '1'),
(1226, 'english', '2', '2'),
(1227, 'english', '3', '3'),
(1228, 'english', '4', '4'),
(1229, 'english', '5', '5'),
(1230, 'english', 'Sending', 'Sending'),
(1231, 'english', 'Show More', 'Show More'),
(1232, 'english', 'Confirm Password', 'Confirm Password'),
(1233, 'english', 'Current Password', 'Current Password'),
(1234, 'english', 'Password changed successfully', 'Password changed successfully'),
(1235, 'english', 'Your 6 Digit Code is', 'Your 6 Digit Code is'),
(1236, 'english', 'Verify Your Email', 'Verify Your Email'),
(1237, 'english', 'Verfication Code', 'Verfication Code'),
(1238, 'english', 'Verification', 'Verification'),
(1239, 'english', 'Resend', 'Resend'),
(1240, 'english', 'America/Yellowknife', 'America/Yellowknife'),
(1241, 'english', 'Usefull_s Links', 'Usefull_s Links'),
(1242, 'english', 'Usefull Links', 'Usefull Links'),
(1243, 'english', 'Help', 'Help'),
(1244, 'english', 'New South Wales', 'New South Wales'),
(1245, 'english', 'Document', 'Document'),
(1246, 'english', '(80 x 80)', '(80 x 80)'),
(1247, 'english', 'Send Email', 'Send Email'),
(1248, 'english', 'Call', 'Call'),
(1249, 'english', 'Company Agent at', 'Company Agent at'),
(1250, 'english', 'Total Property', 'Total Property'),
(1251, 'english', 'For Rent', 'For Rent'),
(1252, 'english', 'For Sell', 'For Sell'),
(1253, 'english', 'Popular', 'Popular'),
(1254, 'english', 'Old to New', 'Old to New'),
(1255, 'english', 'New to old', 'New to old'),
(1256, 'english', 'Price High To low', 'Price High To low'),
(1257, 'english', 'Price Low To High', 'Price Low To High'),
(1258, 'english', 'Version updated successfully', 'Version updated successfully');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `listing_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `listing_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `listing_arrtibute_type_id` bigint(20) UNSIGNED NOT NULL COMMENT 'category',
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci,
  `long_description` longtext COLLATE utf8mb4_unicode_ci,
  `year_build_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `bedroom` int(11) DEFAULT NULL,
  `bathroom` int(11) DEFAULT NULL,
  `garage` int(11) DEFAULT NULL,
  `gallery` longtext COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promo_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `additional_gallery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '{}',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'sell / rent',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `amenities` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '{}',
  `meta_title` longtext COLLATE utf8mb4_unicode_ci,
  `meta_keywords` longtext COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci,
  `near_by` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_title` longtext COLLATE utf8mb4_unicode_ci,
  `og_description` longtext COLLATE utf8mb4_unicode_ci,
  `json_ld` longtext COLLATE utf8mb4_unicode_ci,
  `og_image` longtext COLLATE utf8mb4_unicode_ci,
  `canonical` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listing_arrtibute_types`
--

CREATE TABLE `listing_arrtibute_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listring_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_awesome_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta_title` longtext COLLATE utf8mb4_unicode_ci,
  `meta_keywords` longtext COLLATE utf8mb4_unicode_ci,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci,
  `og_title` longtext COLLATE utf8mb4_unicode_ci,
  `og_description` longtext COLLATE utf8mb4_unicode_ci,
  `json_ld` longtext COLLATE utf8mb4_unicode_ci,
  `og_image` longtext COLLATE utf8mb4_unicode_ci,
  `canonical` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listing_attributes`
--

CREATE TABLE `listing_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_type_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_attributes`
--

INSERT INTO `listing_attributes` (`id`, `listing_type_id`, `attribute_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'category', NULL, NULL),
(2, 1, 'property_details', NULL, NULL),
(3, 1, 'amenities', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listing_attribute_values`
--

CREATE TABLE `listing_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_attribute_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listing_types`
--

CREATE TABLE `listing_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_types`
--

INSERT INTO `listing_types` (`id`, `title`, `slug`, `thumbnail`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Real Estate', 'real-estate', 'thumbnail.png', 1, 0, NULL, NULL),
(2, 'Restaurant', 'restaurant', 'thumbnail.png', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_thread_code` longtext,
  `message` longtext,
  `sender` longtext,
  `read_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message_thread`
--

CREATE TABLE `message_thread` (
  `message_thread_id` int(11) NOT NULL,
  `message_thread_code` longtext,
  `sender` bigint(20) UNSIGNED NOT NULL,
  `receiver` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nearby_location`
--

CREATE TABLE `nearby_location` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nearby_id` int(11) DEFAULT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `package_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_type` int(11) DEFAULT NULL,
  `services` longtext COLLATE utf8mb4_unicode_ci,
  `interval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_subscriptions`
--

CREATE TABLE `pending_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `transaction_keys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
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
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` longtext COLLATE utf8mb4_unicode_ci,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `dislike` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_meta_tags`
--

CREATE TABLE `seo_meta_tags` (
  `id` bigint(20) NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `og_title` longtext COLLATE utf8_unicode_ci,
  `og_description` longtext COLLATE utf8_unicode_ci,
  `json_ld` longtext COLLATE utf8_unicode_ci,
  `og_image` longtext COLLATE utf8_unicode_ci,
  `canonical` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seo_meta_tags`
--

INSERT INTO `seo_meta_tags` (`id`, `route`, `name_route`, `title`, `keywords`, `description`, `url`, `created_at`, `updated_at`, `og_title`, `og_description`, `json_ld`, `og_image`, `canonical`) VALUES
(1, 'Home', 'home', 'Welcome to locus.', 'creativeitem, best software company, smart solutions', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', '/', '2023-07-10 05:19:53', '2023-09-23 10:50:57', NULL, NULL, NULL, NULL, NULL),
(2, 'Listings', 'realeStateListings', 'Welcome to locus.', 'creativeitem, best software company, smart solutions', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', 'real-estate/listings', '2023-07-10 05:19:53', '2023-07-10 05:19:53', NULL, NULL, NULL, NULL, NULL),
(3, 'Pricing', 'subscriptionPackages', 'Welcome to locus.', 'creativeitem, best software company, smart solutions', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', 'pricing', '2023-07-10 05:19:53', '2023-07-10 05:19:53', NULL, NULL, NULL, NULL, NULL),
(4, 'Blog', 'blogGrid', 'Welcome to locus.', 'test', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', 'blog', '2023-07-10 05:19:53', '2023-08-23 01:39:16', NULL, NULL, NULL, NULL, NULL),
(5, 'Contact', 'contactUs', 'Welcome to locus.', 'creativeitem, best software company, smart solutions', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', 'contact', '2023-07-10 05:19:53', '2023-07-10 05:19:06', NULL, NULL, NULL, NULL, NULL),
(6, 'Login', 'login', 'Login to Locus.', 'creativeitem, best software company, smart solutions', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', 'login', '2023-07-10 05:19:53', '2023-07-10 05:18:49', NULL, NULL, NULL, NULL, NULL),
(7, 'Register', 'register', 'Register new user.', 'creativeitem, best software company, smart solutions', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', 'register', '2023-07-10 05:19:53', '2023-07-10 05:13:11', NULL, NULL, NULL, NULL, NULL),
(8, 'Forget-Password', 'password.request', 'Welcome to locus.', 'creativeitem, best software company, smart solutions', 'Creativeitem provides smart solutions for your business, offering software development services since 2011. Meet the team of top software engineers, designers, developers, and analysts to create complex IT products.', 'forget-password', '2023-07-10 05:19:53', '2023-07-10 05:19:53', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `expire_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL,
  `subscription_payment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_payments`
--

CREATE TABLE `subscription_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_type` varchar(255) DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `transaction_keys` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(11) NOT NULL,
  `key` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `key`, `value`) VALUES
(1, 'website_title', 'Locus'),
(2, 'system_title', 'Locus'),
(4, 'system_email', 'creativeitem@gmail.com'),
(5, 'address', 'Melbourne, Australia'),
(6, 'phone', '90050020067'),
(7, 'vat_percentage', NULL),
(8, 'country_id', '73'),
(9, 'text_align', NULL),
(10, 'currency_position', 'left'),
(11, 'language', 'english'),
(12, 'purchase_code', 'Enter-your-purchase-code'),
(13, 'timezone', 'Asia/Dhaka'),
(14, 'paypal', '{\"status\":\"1\",\"mode\":\"test\",\"test_client_id\":\"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"test_secret_key\":\"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"live_client_id\":\"pk_live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"live_secret_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\"}'),
(15, 'stripe', '{\"status\":\"1\",\"mode\":\"test\",\"test_key\":\"pk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"test_secret_key\":\"sk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"public_live_key\":\"pk_live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\",\"secret_live_key\":\"sk_live_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx\"}'),
(18, 'system_currency', 'USD'),
(19, 'paypal_currency', 'USD'),
(20, 'frontend_view', '1'),
(21, 'youtube_api_key', ''),
(22, 'vimeo_api_key', ''),
(23, 'smtp_protocol', 'SMTP'),
(24, 'smtp_host', 'smtp.gmail.com'),
(25, 'smtp_port', 'smtp port'),
(26, 'smtp_user', 'smtp.username'),
(27, 'smtp_pass', 'smtp password'),
(28, 'social_links', '{\"facebook\":\"\",\"twitter\":\"\",\"linkedin\":\"\"}'),
(29, 'about', ''),
(30, 'term_and_condition', ''),
(31, 'privacy_policy', ''),
(32, 'faq', ''),
(35, 'footer_text', 'Creativeitem'),
(36, 'footer_link', 'http://creativeitem.com/'),
(37, 'version', '1.3'),
(38, 'meta_keyword', 'business'),
(39, 'meta_description', 'Atlas business directory listing'),
(40, 'map_access_token', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
(41, 'max_zoom_level', '1'),
(42, 'min_zoom_listings_page', '2'),
(43, 'min_zoom_directory_page', '10'),
(44, 'default_location', '40.702210, -74.015880'),
(45, 'active_map', 'mapbox'),
(46, 'recaptcha_status', '0'),
(47, 'recaptcha_sitekey', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
(48, 'recaptcha_secretkey', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
(49, 'meta_pixel', 'your-pixel-id-goes-here'),
(50, 'smtp_crypto', 'tls'),
(51, 'zoom_api_key', 'YJL-mV1VRkOmOe8T1KUcgA'),
(52, 'signup_email_verification', '0'),
(53, 'agents_blog_permission', '1'),
(54, 'default_location', '40.702210, -74.015880'),
(55, 'newsleter_footer_text', 'Sign up to our newsletter'),
(56, 'newsleter_short_text', 'Stay up to date with the latest news, announcements, and articles.'),
(57, 'smtp_from_email', 'smtp.gmail.com'),
(58, 'timezone', 'Asia/Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `type`, `description`) VALUES
(2, 'active_theme', 'default'),
(3, 'default', '{\"version\":\"1.0\",\"thumbnail\":\"thumbnail.png\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wishlists` longtext COLLATE utf8mb4_unicode_ci,
  `verification_code` longtext COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_verified` int(11) DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `is_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agent_for` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wishlist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '{}',
  `following_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '{}',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` longtext COLLATE utf8mb4_unicode_ci,
  `archive` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zoom_settings`
--

CREATE TABLE `zoom_settings` (
  `id` int(11) NOT NULL,
  `zoom_api_key` varchar(255) DEFAULT NULL,
  `zoom_secrect_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent_payment_keys`
--
ALTER TABLE `agent_payment_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_payment_keys_user_id_foreign` (`user_id`);

--
-- Indexes for table `agent_review`
--
ALTER TABLE `agent_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_review_agent_id_foreign` (`agent_id`),
  ADD KEY `agent_review_user_id_foreign` (`user_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_listring_id_foreign` (`listing_id`),
  ADD KEY `appointments_customer_id_foreign` (`customer_id`),
  ADD KEY `appointments_agent_id_foreign` (`agent_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`),
  ADD KEY `blogs_blog_category_id_foreign` (`blog_category_id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calculator_attribute`
--
ALTER TABLE `calculator_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_subscribes`
--
ALTER TABLE `email_subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontend_settings`
--
ALTER TABLE `frontend_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listings_listing_type_id_foreign` (`listing_type_id`),
  ADD KEY `listings_user_id_foreign` (`user_id`),
  ADD KEY `listings_listing_attribute_id_foreign` (`listing_attribute_id`),
  ADD KEY `listings_listing_arrtibute_type_id_foreign` (`listing_arrtibute_type_id`),
  ADD KEY `listings_city_id_foreign` (`city_id`),
  ADD KEY `listings_state_id_foreign` (`state_id`),
  ADD KEY `listings_country_id_foreign` (`country_id`);

--
-- Indexes for table `listing_arrtibute_types`
--
ALTER TABLE `listing_arrtibute_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listing_arrtibute_types_listring_attribute_id_foreign` (`listring_attribute_id`) USING BTREE;

--
-- Indexes for table `listing_attributes`
--
ALTER TABLE `listing_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listing_attributes_listing_type_id_foreign` (`listing_type_id`);

--
-- Indexes for table `listing_attribute_values`
--
ALTER TABLE `listing_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listing_attribute_values_listing_attribute_type_id_foreign` (`listing_attribute_type_id`),
  ADD KEY `listing_attribute_values_listing_id_foreign` (`listing_id`);

--
-- Indexes for table `listing_types`
--
ALTER TABLE `listing_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `message_thread`
--
ALTER TABLE `message_thread`
  ADD PRIMARY KEY (`message_thread_id`),
  ADD KEY `message_thread_sender_foreign` (`sender`),
  ADD KEY `message_thread_receiver_foreign` (`receiver`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nearby_location`
--
ALTER TABLE `nearby_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nearby_location_listing_id_foreign` (`listing_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pending_subscriptions`
--
ALTER TABLE `pending_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pending_subscriptions_user_id_foreign` (`user_id`),
  ADD KEY `pending_subscriptions_package_id_foreign` (`package_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_listing_id_foreign` (`listing_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `seo_meta_tags`
--
ALTER TABLE `seo_meta_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_subscription_payment_id_foreign` (`subscription_payment_id`);

--
-- Indexes for table `subscription_payments`
--
ALTER TABLE `subscription_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_payments_package_id_foreign` (`package_id`),
  ADD KEY `subscription_payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `zoom_settings`
--
ALTER TABLE `zoom_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_payment_keys`
--
ALTER TABLE `agent_payment_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agent_review`
--
ALTER TABLE `agent_review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calculator_attribute`
--
ALTER TABLE `calculator_attribute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `email_subscribes`
--
ALTER TABLE `email_subscribes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontend_settings`
--
ALTER TABLE `frontend_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1259;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listing_arrtibute_types`
--
ALTER TABLE `listing_arrtibute_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listing_attributes`
--
ALTER TABLE `listing_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `listing_attribute_values`
--
ALTER TABLE `listing_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listing_types`
--
ALTER TABLE `listing_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_thread`
--
ALTER TABLE `message_thread`
  MODIFY `message_thread_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nearby_location`
--
ALTER TABLE `nearby_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pending_subscriptions`
--
ALTER TABLE `pending_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_meta_tags`
--
ALTER TABLE `seo_meta_tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_payments`
--
ALTER TABLE `subscription_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zoom_settings`
--
ALTER TABLE `zoom_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent_payment_keys`
--
ALTER TABLE `agent_payment_keys`
  ADD CONSTRAINT `agent_payment_keys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `agent_review`
--
ALTER TABLE `agent_review`
  ADD CONSTRAINT `agent_review_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `agent_review_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_listring_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_listing_arrtibute_type_id_foreign` FOREIGN KEY (`listing_arrtibute_type_id`) REFERENCES `listing_arrtibute_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_listing_attribute_id_foreign` FOREIGN KEY (`listing_attribute_id`) REFERENCES `listing_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_listing_type_id_foreign` FOREIGN KEY (`listing_type_id`) REFERENCES `listing_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_arrtibute_types`
--
ALTER TABLE `listing_arrtibute_types`
  ADD CONSTRAINT `listing_arrtibute_types_listring_attribute_id_foreign` FOREIGN KEY (`listring_attribute_id`) REFERENCES `listing_attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_attributes`
--
ALTER TABLE `listing_attributes`
  ADD CONSTRAINT `listing_attributes_listing_type_id_foreign` FOREIGN KEY (`listing_type_id`) REFERENCES `listing_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_attribute_values`
--
ALTER TABLE `listing_attribute_values`
  ADD CONSTRAINT `listing_attribute_values_listing_attribute_type_id_foreign` FOREIGN KEY (`listing_attribute_type_id`) REFERENCES `listing_arrtibute_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listing_attribute_values_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nearby_location`
--
ALTER TABLE `nearby_location`
  ADD CONSTRAINT `nearby_location_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pending_subscriptions`
--
ALTER TABLE `pending_subscriptions`
  ADD CONSTRAINT `pending_subscriptions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_subscription_payment_id_foreign` FOREIGN KEY (`subscription_payment_id`) REFERENCES `subscription_payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscription_payments`
--
ALTER TABLE `subscription_payments`
  ADD CONSTRAINT `subscription_payments_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscription_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
