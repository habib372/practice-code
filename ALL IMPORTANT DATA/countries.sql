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
(1, 'Afghanistan', 'AF', NULL, NULL, NULL),
(2, 'Åland Islands', 'AX', NULL, NULL, NULL),
(3, 'Albania', 'AL', NULL, NULL, NULL),
(4, 'Algeria', 'DZ', NULL, NULL, NULL),
(5, 'American Samoa', 'AS', NULL, NULL, NULL),
(6, 'Andorra', 'AD', NULL, NULL, NULL),
(7, 'Angola', 'AO', NULL, NULL, NULL),
(8, 'Anguilla', 'AI', NULL, NULL, NULL),
(9, 'Antarctica', 'AQ', NULL, NULL, NULL),
(10, 'Antigua and Barbuda', 'AG', NULL, NULL, NULL),
(11, 'Argentina', 'AR', NULL, NULL, NULL),
(12, 'Armenia', 'AM', NULL, NULL, NULL),
(13, 'Aruba', 'AW', NULL, NULL, NULL),
(14, 'Australia', 'AU', NULL, NULL, NULL),
(15, 'Austria', 'AT', NULL, NULL, NULL),
(16, 'Azerbaijan', 'AZ', NULL, NULL, NULL),
(17, 'Bahamas', 'BS', NULL, NULL, NULL),
(18, 'Bahrain', 'BH', NULL, NULL, NULL),
(19, 'Bangladesh', 'BD', NULL, NULL, NULL),
(20, 'Barbados', 'BB', NULL, NULL, NULL),
(21, 'Belarus', 'BY', NULL, NULL, NULL),
(22, 'Belgium', 'BE', NULL, NULL, NULL),
(23, 'Belize', 'BZ', NULL, NULL, NULL),
(24, 'Benin', 'BJ', NULL, NULL, NULL),
(25, 'Bermuda', 'BM', NULL, NULL, NULL),
(26, 'Bhutan', 'BT', NULL, NULL, NULL),
(27, 'Bolivia, Plurinational State of', 'BO', NULL, NULL, NULL),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ', NULL, NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL, NULL),
(33, 'British Indian Ocean Territory', 'IO', NULL, NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL, NULL),
(40, 'Canada', 'CA', NULL, NULL, NULL),
(41, 'Cape Verde', 'CV', NULL, NULL, NULL),
(42, 'Cayman Islands', 'KY', NULL, NULL, NULL),
(43, 'Central African Republic', 'CF', NULL, NULL, NULL),
(44, 'Chad', 'TD', NULL, NULL, NULL),
(45, 'Chile', 'CL', NULL, NULL, NULL),
(46, 'China', 'CN', NULL, NULL, NULL),
(47, 'Christmas Island', 'CX', NULL, NULL, NULL),
(48, 'Cocos (Keeling) Islands', 'CC', NULL, NULL, NULL),
(49, 'Colombia', 'CO', NULL, NULL, NULL),
(50, 'Comoros', 'KM', NULL, NULL, NULL),
(51, 'Congo', 'CG', NULL, NULL, NULL),
(52, 'Congo, the Democratic Republic of the', 'CD', NULL, NULL, NULL),
(53, 'Cook Islands', 'CK', NULL, NULL, NULL),
(54, 'Costa Rica', 'CR', NULL, NULL, NULL),
(55, 'Côte d\'Ivoire', 'CI', NULL, NULL, NULL),
(56, 'Croatia', 'HR', NULL, NULL, NULL),
(57, 'Cuba', 'CU', NULL, NULL, NULL),
(58, 'Curaçao', 'CW', NULL, NULL, NULL),
(59, 'Cyprus', 'CY', NULL, NULL, NULL),
(60, 'Czech Republic', 'CZ', NULL, NULL, NULL),
(61, 'Denmark', 'DK', NULL, NULL, NULL),
(62, 'Djibouti', 'DJ', NULL, NULL, NULL),
(63, 'Dominica', 'DM', NULL, NULL, NULL),
(64, 'Dominican Republic', 'DO', NULL, NULL, NULL),
(65, 'Ecuador', 'EC', NULL, NULL, NULL),
(66, 'Egypt', 'EG', NULL, NULL, NULL),
(67, 'El Salvador', 'SV', NULL, NULL, NULL),
(68, 'Equatorial Guinea', 'GQ', NULL, NULL, NULL),
(69, 'Eritrea', 'ER', NULL, NULL, NULL),
(70, 'Estonia', 'EE', NULL, NULL, NULL),
(71, 'Ethiopia', 'ET', NULL, NULL, NULL),
(72, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL, NULL),
(73, 'Faroe Islands', 'FO', NULL, NULL, NULL),
(74, 'Fiji', 'FJ', NULL, NULL, NULL),
(75, 'Finland', 'FI', NULL, NULL, NULL),
(76, 'France', 'FR', NULL, NULL, NULL),
(77, 'French Guiana', 'GF', NULL, NULL, NULL),
(78, 'French Polynesia', 'PF', NULL, NULL, NULL),
(79, 'French Southern Territories', 'TF', NULL, NULL, NULL),
(80, 'Gabon', 'GA', NULL, NULL, NULL),
(81, 'Gambia', 'GM', NULL, NULL, NULL),
(82, 'Georgia', 'GE', NULL, NULL, NULL),
(83, 'Germany', 'DE', NULL, NULL, NULL),
(84, 'Ghana', 'GH', NULL, NULL, NULL),
(85, 'Gibraltar', 'GI', NULL, NULL, NULL),
(86, 'Greece', 'GR', NULL, NULL, NULL),
(87, 'Greenland', 'GL', NULL, NULL, NULL),
(88, 'Grenada', 'GD', NULL, NULL, NULL),
(89, 'Guadeloupe', 'GP', NULL, NULL, NULL),
(90, 'Guam', 'GU', NULL, NULL, NULL),
(91, 'Guatemala', 'GT', NULL, NULL, NULL),
(92, 'Guernsey', 'GG', NULL, NULL, NULL),
(93, 'Guinea', 'GN', NULL, NULL, NULL),
(94, 'Guinea-Bissau', 'GW', NULL, NULL, NULL),
(95, 'Guyana', 'GY', NULL, NULL, NULL),
(96, 'Haiti', 'HT', NULL, NULL, NULL),
(97, 'Heard Island and McDonald Mcdonald Islands', 'HM', NULL, NULL, NULL),
(98, 'Holy See (Vatican City State)', 'VA', NULL, NULL, NULL),
(99, 'Honduras', 'HN', NULL, NULL, NULL),
(100, 'Hong Kong', 'HK', NULL, NULL, NULL),
(101, 'Hungary', 'HU', NULL, NULL, NULL),
(102, 'Iceland', 'IS', NULL, NULL, NULL),
(103, 'India', 'IN', NULL, NULL, NULL),
(104, 'Indonesia', 'ID', NULL, NULL, NULL),
(105, 'Iran, Islamic Republic of', 'IR', NULL, NULL, NULL),
(106, 'Iraq', 'IQ', NULL, NULL, NULL),
(107, 'Ireland', 'IE', NULL, NULL, NULL),
(108, 'Isle of Man', 'IM', NULL, NULL, NULL),
(109, 'Israel', 'IL', NULL, NULL, NULL),
(110, 'Italy', 'IT', NULL, NULL, NULL),
(111, 'Jamaica', 'JM', NULL, NULL, NULL),
(112, 'Japan', 'JP', NULL, NULL, NULL),
(113, 'Jersey', 'JE', NULL, NULL, NULL),
(114, 'Jordan', 'JO', NULL, NULL, NULL),
(115, 'Kazakhstan', 'KZ', NULL, NULL, NULL),
(116, 'Kenya', 'KE', NULL, NULL, NULL),
(117, 'Kiribati', 'KI', NULL, NULL, NULL),
(118, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL, NULL),
(119, 'Korea, Republic of', 'KR', NULL, NULL, NULL),
(120, 'Kuwait', 'KW', NULL, NULL, NULL),
(121, 'Kyrgyzstan', 'KG', NULL, NULL, NULL),
(122, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL, NULL),
(123, 'Latvia', 'LV', NULL, NULL, NULL),
(124, 'Lebanon', 'LB', NULL, NULL, NULL),
(125, 'Lesotho', 'LS', NULL, NULL, NULL),
(126, 'Liberia', 'LR', NULL, NULL, NULL),
(127, 'Libya', 'LY', NULL, NULL, NULL),
(128, 'Liechtenstein', 'LI', NULL, NULL, NULL),
(129, 'Lithuania', 'LT', NULL, NULL, NULL),
(130, 'Luxembourg', 'LU', NULL, NULL, NULL),
(131, 'Macao', 'MO', NULL, NULL, NULL),
(132, 'Macedonia, the Former Yugoslav Republic of', 'MK', NULL, NULL, NULL),
(133, 'Madagascar', 'MG', NULL, NULL, NULL),
(134, 'Malawi', 'MW', NULL, NULL, NULL),
(135, 'Malaysia', 'MY', NULL, NULL, NULL),
(136, 'Maldives', 'MV', NULL, NULL, NULL),
(137, 'Mali', 'ML', NULL, NULL, NULL),
(138, 'Malta', 'MT', NULL, NULL, NULL),
(139, 'Marshall Islands', 'MH', NULL, NULL, NULL),
(140, 'Martinique', 'MQ', NULL, NULL, NULL),
(141, 'Mauritania', 'MR', NULL, NULL, NULL),
(142, 'Mauritius', 'MU', NULL, NULL, NULL),
(143, 'Mayotte', 'YT', NULL, NULL, NULL),
(144, 'Mexico', 'MX', NULL, NULL, NULL),
(145, 'Micronesia, Federated States of', 'FM', NULL, NULL, NULL),
(146, 'Moldova, Republic of', 'MD', NULL, NULL, NULL),
(147, 'Monaco', 'MC', NULL, NULL, NULL),
(148, 'Mongolia', 'MN', NULL, NULL, NULL),
(149, 'Montenegro', 'ME', NULL, NULL, NULL),
(150, 'Montserrat', 'MS', NULL, NULL, NULL),
(151, 'Morocco', 'MA', NULL, NULL, NULL),
(152, 'Mozambique', 'MZ', NULL, NULL, NULL),
(153, 'Myanmar', 'MM', NULL, NULL, NULL),
(154, 'Namibia', 'NA', NULL, NULL, NULL),
(155, 'Nauru', 'NR', NULL, NULL, NULL),
(156, 'Nepal', 'NP', NULL, NULL, NULL),
(157, 'Netherlands', 'NL', NULL, NULL, NULL),
(158, 'New Caledonia', 'NC', NULL, NULL, NULL),
(159, 'New Zealand', 'NZ', NULL, NULL, NULL),
(160, 'Nicaragua', 'NI', NULL, NULL, NULL),
(161, 'Niger', 'NE', NULL, NULL, NULL),
(162, 'Nigeria', 'NG', NULL, NULL, NULL),
(163, 'Niue', 'NU', NULL, NULL, NULL),
(164, 'Norfolk Island', 'NF', NULL, NULL, NULL),
(165, 'Northern Mariana Islands', 'MP', NULL, NULL, NULL),
(166, 'Norway', 'NO', NULL, NULL, NULL),
(167, 'Oman', 'OM', NULL, NULL, NULL),
(168, 'Pakistan', 'PK', NULL, NULL, NULL),
(169, 'Palau', 'PW', NULL, NULL, NULL),
(170, 'Palestine, State of', 'PS', NULL, NULL, NULL),
(171, 'Panama', 'PA', NULL, NULL, NULL),
(172, 'Papua New Guinea', 'PG', NULL, NULL, NULL),
(173, 'Paraguay', 'PY', NULL, NULL, NULL),
(174, 'Peru', 'PE', NULL, NULL, NULL),
(175, 'Philippines', 'PH', NULL, NULL, NULL),
(176, 'Pitcairn', 'PN', NULL, NULL, NULL),
(177, 'Poland', 'PL', NULL, NULL, NULL),
(178, 'Portugal', 'PT', NULL, NULL, NULL),
(179, 'Puerto Rico', 'PR', NULL, NULL, NULL),
(180, 'Qatar', 'QA', NULL, NULL, NULL),
(181, 'Réunion', 'RE', NULL, NULL, NULL),
(182, 'Romania', 'RO', NULL, NULL, NULL),
(183, 'Russian Federation', 'RU', NULL, NULL, NULL),
(184, 'Rwanda', 'RW', NULL, NULL, NULL),
(185, 'Saint Barthélemy', 'BL', NULL, NULL, NULL),
(186, 'Saint Helena, Ascension and Tristan da Cunha', 'SH', NULL, NULL, NULL),
(187, 'Saint Kitts and Nevis', 'KN', NULL, NULL, NULL),
(188, 'Saint Lucia', 'LC', NULL, NULL, NULL),
(189, 'Saint Martin (French part)', 'MF', NULL, NULL, NULL),
(190, 'Saint Pierre and Miquelon', 'PM', NULL, NULL, NULL),
(191, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL, NULL),
(192, 'Samoa', 'WS', NULL, NULL, NULL),
(193, 'San Marino', 'SM', NULL, NULL, NULL),
(194, 'Sao Tome and Principe', 'ST', NULL, NULL, NULL),
(195, 'Saudi Arabia', 'SA', NULL, NULL, NULL),
(196, 'Senegal', 'SN', NULL, NULL, NULL),
(197, 'Serbia', 'RS', NULL, NULL, NULL),
(198, 'Seychelles', 'SC', NULL, NULL, NULL),
(199, 'Sierra Leone', 'SL', NULL, NULL, NULL),
(200, 'Singapore', 'SG', NULL, NULL, NULL),
(201, 'Sint Maarten (Dutch part)', 'SX', NULL, NULL, NULL),
(202, 'Slovakia', 'SK', NULL, NULL, NULL),
(203, 'Slovenia', 'SI', NULL, NULL, NULL),
(204, 'Solomon Islands', 'SB', NULL, NULL, NULL),
(205, 'Somalia', 'SO', NULL, NULL, NULL),
(206, 'South Africa', 'ZA', NULL, NULL, NULL),
(207, 'South Georgia and the South Sandwich Islands', 'GS', NULL, NULL, NULL),
(208, 'South Sudan', 'SS', NULL, NULL, NULL),
(209, 'Spain', 'ES', NULL, NULL, NULL),
(210, 'Sri Lanka', 'LK', NULL, NULL, NULL),
(211, 'Sudan', 'SD', NULL, NULL, NULL),
(212, 'Suriname', 'SR', NULL, NULL, NULL),
(213, 'Svalbard and Jan Mayen', 'SJ', NULL, NULL, NULL),
(214, 'Swaziland', 'SZ', NULL, NULL, NULL),
(215, 'Sweden', 'SE', NULL, NULL, NULL),
(216, 'Switzerland', 'CH', NULL, NULL, NULL),
(217, 'Syrian Arab Republic', 'SY', NULL, NULL, NULL),
(218, 'Taiwan', 'TW', NULL, NULL, NULL),
(219, 'Tajikistan', 'TJ', NULL, NULL, NULL),
(220, 'Tanzania, United Republic of', 'TZ', NULL, NULL, NULL),
(221, 'Thailand', 'TH', NULL, NULL, NULL),
(222, 'Timor-Leste', 'TL', NULL, NULL, NULL),
(223, 'Togo', 'TG', NULL, NULL, NULL),
(224, 'Tokelau', 'TK', NULL, NULL, NULL),
(225, 'Tonga', 'TO', NULL, NULL, NULL),
(226, 'Trinidad and Tobago', 'TT', NULL, NULL, NULL),
(227, 'Tunisia', 'TN', NULL, NULL, NULL),
(228, 'Turkey', 'TR', NULL, NULL, NULL),
(229, 'Turkmenistan', 'TM', NULL, NULL, NULL),
(230, 'Turks and Caicos Islands', 'TC', NULL, NULL, NULL),
(231, 'Tuvalu', 'TV', NULL, NULL, NULL),
(232, 'Uganda', 'UG', NULL, NULL, NULL),
(233, 'Ukraine', 'UA', NULL, NULL, NULL),
(234, 'United Arab Emirates', 'AE', NULL, NULL, NULL),
(235, 'United Kingdom', 'GB', NULL, NULL, NULL),
(236, 'United States', 'US', NULL, NULL, NULL),
(237, 'United States Minor Outlying Islands', 'UM', NULL, NULL, NULL),
(238, 'Uruguay', 'UY', NULL, NULL, NULL),
(239, 'Uzbekistan', 'UZ', NULL, NULL, NULL),
(240, 'Vanuatu', 'VU', NULL, NULL, NULL),
(241, 'Venezuela, Bolivarian Republic of', 'VE', NULL, NULL, NULL),
(242, 'Viet Nam', 'VN', NULL, NULL, NULL),
(243, 'Virgin Islands, British', 'VG', NULL, NULL, NULL),
(244, 'Virgin Islands, U.S.', 'VI', NULL, NULL, NULL),
(245, 'Wallis and Futuna', 'WF', NULL, NULL, NULL),
(246, 'Western Sahara', 'EH', NULL, NULL, NULL),
(247, 'Yemen', 'YE', NULL, NULL, NULL),
(248, 'Zambia', 'ZM', NULL, NULL, NULL),
(249, 'Zimbabwe', 'ZW', NULL, NULL, NULL);

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
