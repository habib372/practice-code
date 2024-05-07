-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 08:07 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediroam_update`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', 'AFN', NULL, NULL),
(2, 'Åland Islands', 'AX', 'EUR', NULL, NULL),
(3, 'Albania', 'AL', 'ALL', NULL, NULL),
(4, 'Algeria', 'DZ', 'DZD', NULL, NULL),
(5, 'Andorra', 'AD', 'EUR', NULL, NULL),
(6, 'Angola', 'AO', 'AOA', NULL, NULL),
(7, 'Anguilla', 'AI', 'XCD', NULL, NULL),
(8, 'Antarctica', 'AQ', NULL, NULL, NULL),
(9, 'Antigua & Barbuda', 'AG', 'XCD', NULL, NULL),
(10, 'Argentina', 'AR', 'ARS', NULL, NULL),
(11, 'Armenia', 'AM', 'AMD', NULL, NULL),
(12, 'Aruba', 'AW', 'AWG', NULL, NULL),
(13, 'Ascension Island', 'AC', NULL, NULL, NULL),
(14, 'Australia', 'AU', 'AUD', NULL, NULL),
(15, 'Austria', 'AT', 'EUR', NULL, NULL),
(16, 'Azerbaijan', 'AZ', 'AZN', NULL, NULL),
(17, 'Bahamas', 'BS', 'BSD', NULL, NULL),
(18, 'Bahrain', 'BH', 'BHD', NULL, NULL),
(19, 'Bangladesh', 'BD', 'BDT', NULL, NULL),
(20, 'Barbados', 'BB', 'BBD', NULL, NULL),
(21, 'Belarus', 'BY', 'BYN', NULL, NULL),
(22, 'Belgium', 'BE', 'EUR', NULL, NULL),
(23, 'Belize', 'BZ', 'BZD', NULL, NULL),
(24, 'Benin', 'BJ', 'XOF', NULL, NULL),
(25, 'Bermuda', 'BM', 'BMD', NULL, NULL),
(26, 'Bhutan', 'BT', 'BTN', NULL, NULL),
(27, 'Bolivia', 'BO', 'BOB', NULL, NULL),
(28, 'Bosnia & Herzegovina', 'BA', 'BAM', NULL, NULL),
(29, 'Botswana', 'BW', 'BWP', NULL, NULL),
(30, 'Bouvet Island', 'BV', NULL, NULL, NULL),
(31, 'Brazil', 'BR', 'BRL', NULL, NULL),
(32, 'British Indian Ocean Territory', 'IO', 'USD', NULL, NULL),
(33, 'British Virgin Islands', 'VG', 'USD', NULL, NULL),
(34, 'Brunei', 'BN', 'BND', NULL, NULL),
(35, 'Bulgaria', 'BG', 'BGN', NULL, NULL),
(36, 'Burkina Faso', 'BF', 'XOF', NULL, NULL),
(37, 'Burundi', 'BI', 'BIF', NULL, NULL),
(38, 'Cambodia', 'KH', 'KHR', NULL, NULL),
(39, 'Cameroon', 'CM', 'XAF', NULL, NULL),
(40, 'Canada', 'CA', 'CAD', NULL, NULL),
(41, 'Cape Verde', 'CV', 'CVE', NULL, NULL),
(42, 'Caribbean Netherlands', 'BQ', 'USD', NULL, NULL),
(43, 'Cayman Islands', 'KY', 'KYD', NULL, NULL),
(44, 'Central African Republic', 'CF', 'XAF', NULL, NULL),
(45, 'Chad', 'TD', 'XAF', NULL, NULL),
(46, 'Chile', 'CL', 'CLP', NULL, NULL),
(47, 'China', 'CN', 'CNY', NULL, NULL),
(48, 'Colombia', 'CO', 'COP', NULL, NULL),
(49, 'Comoros', 'KM', 'KMF', NULL, NULL),
(50, 'Congo - Brazzaville', 'CG', 'XAF', NULL, NULL),
(51, 'Congo - Kinshasa', 'CD', 'CDF', NULL, NULL),
(52, 'Cook Islands', 'CK', 'NZD', NULL, NULL),
(53, 'Costa Rica', 'CR', 'CRC', NULL, NULL),
(54, 'Côte d’Ivoire', 'CI', 'XOF', NULL, NULL),
(55, 'Croatia', 'HR', 'HRK', NULL, NULL),
(56, 'Curaçao', 'CW', 'ANG', NULL, NULL),
(57, 'Cyprus', 'CY', 'EUR', NULL, NULL),
(58, 'Czechia', 'CZ', 'CZK', NULL, NULL),
(59, 'Denmark', 'DK', 'DKK', NULL, NULL),
(60, 'Djibouti', 'DJ', 'DJF', NULL, NULL),
(61, 'Dominica', 'DM', 'XCD', NULL, NULL),
(62, 'Dominican Republic', 'DO', 'DOP', NULL, NULL),
(63, 'Ecuador', 'EC', 'USD', NULL, NULL),
(64, 'Egypt', 'EG', 'EGP', NULL, NULL),
(65, 'El Salvador', 'SV', 'USD', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', 'XAF', NULL, NULL),
(67, 'Eritrea', 'ER', 'ERN', NULL, NULL),
(68, 'Estonia', 'EE', 'EUR', NULL, NULL),
(69, 'Eswatini', 'SZ', 'SZL', NULL, NULL),
(70, 'Ethiopia', 'ET', 'ETB', NULL, NULL),
(71, 'Falkland Islands', 'FK', 'FKP', NULL, NULL),
(72, 'Faroe Islands', 'FO', 'DKK', NULL, NULL),
(73, 'Fiji', 'FJ', 'FJD', NULL, NULL),
(74, 'Finland', 'FI', 'EUR', NULL, NULL),
(75, 'France', 'FR', 'EUR', NULL, NULL),
(76, 'French Guiana', 'GF', 'EUR', NULL, NULL),
(77, 'French Polynesia', 'PF', 'XPF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL, NULL),
(79, 'Gabon', 'GA', 'XAF', NULL, NULL),
(80, 'Gambia', 'GM', 'GMD', NULL, NULL),
(81, 'Georgia', 'GE', 'GEL', NULL, NULL),
(82, 'Germany', 'DE', 'EUR', NULL, NULL),
(83, 'Ghana', 'GH', 'GHS', NULL, NULL),
(84, 'Gibraltar', 'GI', 'GIP', NULL, NULL),
(85, 'Greece', 'GR', 'EUR', NULL, NULL),
(86, 'Greenland', 'GL', 'DKK', NULL, NULL),
(87, 'Grenada', 'GD', 'XCD', NULL, NULL),
(88, 'Guadeloupe', 'GP', 'EUR', NULL, NULL),
(89, 'Guam', 'GU', 'USD', NULL, NULL),
(90, 'Guatemala', 'GT', 'GTQ', NULL, NULL),
(91, 'Guernsey', 'GG', 'GBP', NULL, NULL),
(92, 'Guinea', 'GN', 'GNF', NULL, NULL),
(93, 'Guinea-Bissau', 'GW', 'XOF', NULL, NULL),
(94, 'Guyana', 'GY', 'GYD', NULL, NULL),
(95, 'Haiti', 'HT', 'HTG', NULL, NULL),
(96, 'Honduras', 'HN', 'HNL', NULL, NULL),
(97, 'Hong Kong SAR China', 'HK', 'HKD', NULL, NULL),
(98, 'Hungary', 'HU', 'HUF', NULL, NULL),
(99, 'Iceland', 'IS', 'ISK', NULL, NULL),
(100, 'India', 'IN', 'INR', NULL, NULL),
(101, 'Indonesia', 'ID', 'IDR', NULL, NULL),
(102, 'Iraq', 'IQ', 'IQD', NULL, NULL),
(103, 'Ireland', 'IE', 'EUR', NULL, NULL),
(104, 'Isle of Man', 'IM', 'GBP', NULL, NULL),
(105, 'Israel', 'IL', 'ILS', NULL, NULL),
(106, 'Italy', 'IT', 'EUR', NULL, NULL),
(107, 'Jamaica', 'JM', 'JMD', NULL, NULL),
(108, 'Japan', 'JP', 'JPY', NULL, NULL),
(109, 'Jersey', 'JE', 'GBP', NULL, NULL),
(110, 'Jordan', 'JO', 'JOD', NULL, NULL),
(111, 'Kazakhstan', 'KZ', 'KZT', NULL, NULL),
(112, 'Kenya', 'KE', 'KES', NULL, NULL),
(113, 'Kiribati', 'KI', 'AUD', NULL, NULL),
(114, 'Kosovo', 'XK', 'EUR', NULL, NULL),
(115, 'Kuwait', 'KW', 'KWD', NULL, NULL),
(116, 'Kyrgyzstan', 'KG', 'KGS', NULL, NULL),
(117, 'Laos', 'LA', 'LAK', NULL, NULL),
(118, 'Latvia', 'LV', 'EUR', NULL, NULL),
(119, 'Lebanon', 'LB', 'LBP', NULL, NULL),
(120, 'Lesotho', 'LS', 'LSL', NULL, NULL),
(121, 'Liberia', 'LR', 'LRD', NULL, NULL),
(122, 'Libya', 'LY', 'LYD', NULL, NULL),
(123, 'Liechtenstein', 'LI', 'CHF', NULL, NULL),
(124, 'Lithuania', 'LT', 'EUR', NULL, NULL),
(125, 'Luxembourg', 'LU', 'EUR', NULL, NULL),
(126, 'Macao SAR China', 'MO', 'MOP', NULL, NULL),
(127, 'Madagascar', 'MG', 'MGA', NULL, NULL),
(128, 'Malawi', 'MW', 'MWK', NULL, NULL),
(129, 'Malaysia', 'MY', 'MYR', NULL, NULL),
(130, 'Maldives', 'MV', 'MVR', NULL, NULL),
(131, 'Mali', 'ML', 'XOF', NULL, NULL),
(132, 'Malta', 'MT', 'EUR', NULL, NULL),
(133, 'Martinique', 'MQ', 'EUR', NULL, NULL),
(134, 'Mauritania', 'MR', 'MRU', NULL, NULL),
(135, 'Mauritius', 'MU', 'MUR', NULL, NULL),
(136, 'Mayotte', 'YT', 'EUR', NULL, NULL),
(137, 'Mexico', 'MX', 'MXN', NULL, NULL),
(138, 'Moldova', 'MD', 'MDL', NULL, NULL),
(139, 'Monaco', 'MC', 'EUR', NULL, NULL),
(140, 'Mongolia', 'MN', 'MNT', NULL, NULL),
(141, 'Montenegro', 'ME', 'EUR', NULL, NULL),
(142, 'Montserrat', 'MS', 'XCD', NULL, NULL),
(143, 'Morocco', 'MA', 'MAD', NULL, NULL),
(144, 'Mozambique', 'MZ', 'MZN', NULL, NULL),
(145, 'Myanmar (Burma)', 'MM', 'MMK', NULL, NULL),
(146, 'Namibia', 'NA', 'NAD', NULL, NULL),
(147, 'Nauru', 'NR', 'AUD', NULL, NULL),
(148, 'Nepal', 'NP', 'NPR', NULL, NULL),
(149, 'Netherlands', 'NL', 'EUR', NULL, NULL),
(150, 'New Caledonia', 'NC', 'XPF', NULL, NULL),
(151, 'New Zealand', 'NZ', 'NZD', NULL, NULL),
(152, 'Nicaragua', 'NI', 'NIO', NULL, NULL),
(153, 'Niger', 'NE', 'XOF', NULL, NULL),
(154, 'Nigeria', 'NG', 'NGN', NULL, NULL),
(155, 'Niue', 'NU', 'NZD', NULL, NULL),
(156, 'North Macedonia', 'MK', 'MKD', NULL, NULL),
(157, 'Norway', 'NO', 'NOK', NULL, NULL),
(158, 'Oman', 'OM', 'OMR', NULL, NULL),
(159, 'Pakistan', 'PK', 'PKR', NULL, NULL),
(160, 'Palestinian Territories', 'PS', 'ILS', NULL, NULL),
(161, 'Panama', 'PA', 'PAB', NULL, NULL),
(162, 'Papua New Guinea', 'PG', 'PGK', NULL, NULL),
(163, 'Paraguay', 'PY', 'PYG', NULL, NULL),
(164, 'Peru', 'PE', 'PEN', NULL, NULL),
(165, 'Philippines', 'PH', 'PHP', NULL, NULL),
(166, 'Pitcairn Islands', 'PN', 'NZD', NULL, NULL),
(167, 'Poland', 'PL', 'PLN', NULL, NULL),
(168, 'Portugal', 'PT', 'EUR', NULL, NULL),
(169, 'Puerto Rico', 'PR', 'USD', NULL, NULL),
(170, 'Qatar', 'QA', 'QAR', NULL, NULL),
(171, 'Réunion', 'RE', 'EUR', NULL, NULL),
(172, 'Romania', 'RO', 'RON', NULL, NULL),
(173, 'Russia', 'RU', 'RUB', NULL, NULL),
(174, 'Rwanda', 'RW', 'RWF', NULL, NULL),
(175, 'Samoa', 'WS', 'WST', NULL, NULL),
(176, 'San Marino', 'SM', 'EUR', NULL, NULL),
(177, 'São Tomé & Príncipe', 'ST', 'STN', NULL, NULL),
(178, 'Saudi Arabia', 'SA', 'SAR', NULL, NULL),
(179, 'Senegal', 'SN', 'XOF', NULL, NULL),
(180, 'Serbia', 'RS', 'RSD', NULL, NULL),
(181, 'Seychelles', 'SC', 'SCR', NULL, NULL),
(182, 'Sierra Leone', 'SL', 'SLL', NULL, NULL),
(183, 'Singapore', 'SG', 'SGD', NULL, NULL),
(184, 'Sint Maarten', 'SX', 'ANG', NULL, NULL),
(185, 'Slovakia', 'SK', 'EUR', NULL, NULL),
(186, 'Slovenia', 'SI', 'EUR', NULL, NULL),
(187, 'Solomon Islands', 'SB', 'SBD', NULL, NULL),
(188, 'Somalia', 'SO', 'SOS', NULL, NULL),
(189, 'South Africa', 'ZA', 'ZAR', NULL, NULL),
(190, 'South Georgia & South Sandwich Islands', 'GS', 'GBP', NULL, NULL),
(191, 'South Korea', 'KR', 'KRW', NULL, NULL),
(192, 'South Sudan', 'SS', 'SSP', NULL, NULL),
(193, 'Spain', 'ES', 'EUR', NULL, NULL),
(194, 'Sri Lanka', 'LK', 'LKR', NULL, NULL),
(195, 'St. Barthélemy', 'BL', 'EUR', NULL, NULL),
(196, 'St. Helena', 'SH', 'SHP', NULL, NULL),
(197, 'St. Kitts & Nevis', 'KN', 'XCD', NULL, NULL),
(198, 'St. Lucia', 'LC', 'XCD', NULL, NULL),
(199, 'St. Martin', 'MF', 'EUR', NULL, NULL),
(200, 'St. Pierre & Miquelon', 'PM', 'EUR', NULL, NULL),
(201, 'St. Vincent & Grenadines', 'VC', 'XCD', NULL, NULL),
(202, 'Sudan', 'SD', 'SDG', NULL, NULL),
(203, 'Suriname', 'SR', 'SRD', NULL, NULL),
(204, 'Svalbard & Jan Mayen', 'SJ', 'NOK', NULL, NULL),
(205, 'Sweden', 'SE', 'SEK', NULL, NULL),
(206, 'Switzerland', 'CH', 'CHF', NULL, NULL),
(207, 'Taiwan', 'TW', 'TWD', NULL, NULL),
(208, 'Tajikistan', 'TJ', 'TJS', NULL, NULL),
(209, 'Tanzania', 'TZ', 'TZS', NULL, NULL),
(210, 'Thailand', 'TH', 'THB', NULL, NULL),
(211, 'Timor-Leste', 'TL', 'USD', NULL, NULL),
(212, 'Togo', 'TG', 'XOF', NULL, NULL),
(213, 'Tokelau', 'TK', 'NZD', NULL, NULL),
(214, 'Tonga', 'TO', 'TOP', NULL, NULL),
(215, 'Trinidad & Tobago', 'TT', 'TTD', NULL, NULL),
(216, 'Tristan da Cunha', 'TA', 'GBP', NULL, NULL),
(217, 'Tunisia', 'TN', 'TND', NULL, NULL),
(218, 'Turkey', 'TR', 'TRY', NULL, NULL),
(219, 'Turkmenistan', 'TM', 'TMT', NULL, NULL),
(220, 'Turks & Caicos Islands', 'TC', 'USD', NULL, NULL),
(221, 'Tuvalu', 'TV', 'AUD', NULL, NULL),
(222, 'Uganda', 'UG', 'UGX', NULL, NULL),
(223, 'Ukraine', 'UA', 'UAH', NULL, NULL),
(224, 'United Arab Emirates', 'AE', 'AED', NULL, NULL),
(225, 'United Kingdom', 'GB', 'GBP', NULL, NULL),
(226, 'United States', 'US', 'USD', NULL, NULL),
(227, 'Uruguay', 'UY', 'UYU', NULL, NULL),
(228, 'Uzbekistan', 'UZ', 'UZS', NULL, NULL),
(229, 'Vanuatu', 'VU', 'VUV', NULL, NULL),
(230, 'Vatican City', 'VA', 'EUR', NULL, NULL),
(231, 'Venezuela', 'VE', 'VES', NULL, NULL),
(232, 'Vietnam', 'VN', 'VND', NULL, NULL),
(233, 'Wallis & Futuna', 'WF', 'XPF', NULL, NULL),
(234, 'Western Sahara', 'EH', 'MAD', NULL, NULL),
(235, 'Yemen', 'YE', 'YER', NULL, NULL),
(236, 'Zambia', 'ZM', 'ZMW', NULL, NULL),
(237, 'Zimbabwe', 'ZW', 'ZWL', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_code_index` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
