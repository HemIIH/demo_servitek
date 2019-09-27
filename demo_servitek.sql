-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 12, 2019 at 11:56 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.22-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_servitek`
--

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charge_rates`
--

CREATE TABLE `charge_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date DEFAULT NULL,
  `editor` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_contract` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `function` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personnel_planning` tinyint(1) DEFAULT '0',
  `accounting` tinyint(1) DEFAULT '0',
  `other` tinyint(1) DEFAULT '0',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_invoice`
--

CREATE TABLE `contact_invoice` (
  `contact_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_order`
--

CREATE TABLE `contact_order` (
  `contact_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`code`, `name`) VALUES
('AF', 'Afghanistan'),
('EG', 'Ägypten'),
('AX', 'Åland-Inseln'),
('AL', 'Albanien'),
('DZ', 'Algerien'),
('UM', 'Amerikanisch-Ozeanien'),
('AS', 'Amerikanisch-Samoa'),
('VI', 'Amerikanische Jungferninseln'),
('AD', 'Andorra'),
('AO', 'Angola'),
('AI', 'Anguilla'),
('AQ', 'Antarktis'),
('AG', 'Antigua und Barbuda'),
('GQ', 'Äquatorialguinea'),
('AR', 'Argentinien'),
('AM', 'Armenien'),
('AW', 'Aruba'),
('AC', 'Ascension'),
('AZ', 'Aserbaidschan'),
('ET', 'Äthiopien'),
('AU', 'Australien'),
('BS', 'Bahamas'),
('BH', 'Bahrain'),
('BD', 'Bangladesch'),
('BB', 'Barbados'),
('BY', 'Belarus'),
('BE', 'Belgien'),
('BZ', 'Belize'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BT', 'Bhutan'),
('BO', 'Bolivien'),
('BA', 'Bosnien und Herzegowina'),
('BW', 'Botsuana'),
('BR', 'Brasilien'),
('VG', 'Britische Jungferninseln'),
('IO', 'Britisches Territorium im Indischen Ozean'),
('BN', 'Brunei Darussalam'),
('BG', 'Bulgarien'),
('BF', 'Burkina Faso'),
('BI', 'Burundi'),
('EA', 'Ceuta und Melilla'),
('CL', 'Chile'),
('CN', 'China'),
('CK', 'Cookinseln'),
('CR', 'Costa Rica'),
('CI', 'Côte d’Ivoire'),
('CW', 'Curaçao'),
('DK', 'Dänemark'),
('KP', 'Demokratische Volksrepublik Korea'),
('DE', 'Deutschland'),
('DG', 'Diego Garcia'),
('DM', 'Dominica'),
('DO', 'Dominikanische Republik'),
('DJ', 'Dschibuti'),
('EC', 'Ecuador'),
('SV', 'El Salvador'),
('ER', 'Eritrea'),
('EE', 'Estland'),
('FK', 'Falklandinseln'),
('FO', 'Färöer'),
('FJ', 'Fidschi'),
('FI', 'Finnland'),
('FR', 'Frankreich'),
('GF', 'Französisch-Guayana'),
('PF', 'Französisch-Polynesien'),
('TF', 'Französische Süd- und Antarktisgebiete'),
('GA', 'Gabun'),
('GM', 'Gambia'),
('GE', 'Georgien'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GD', 'Grenada'),
('GR', 'Griechenland'),
('GL', 'Grönland'),
('GP', 'Guadeloupe'),
('GU', 'Guam'),
('GT', 'Guatemala'),
('GG', 'Guernsey'),
('GN', 'Guinea'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HT', 'Haiti'),
('HN', 'Honduras'),
('IN', 'Indien'),
('ID', 'Indonesien'),
('IQ', 'Irak'),
('IR', 'Iran'),
('IE', 'Irland'),
('IS', 'Island'),
('IM', 'Isle of Man'),
('IL', 'Israel'),
('IT', 'Italien'),
('JM', 'Jamaika'),
('JP', 'Japan'),
('YE', 'Jemen'),
('JE', 'Jersey'),
('JO', 'Jordanien'),
('KY', 'Kaimaninseln'),
('KH', 'Kambodscha'),
('CM', 'Kamerun'),
('CA', 'Kanada'),
('IC', 'Kanarische Inseln'),
('CV', 'Kap Verde'),
('BQ', 'Karibische Niederlande'),
('KZ', 'Kasachstan'),
('QA', 'Katar'),
('KE', 'Kenia'),
('KG', 'Kirgisistan'),
('KI', 'Kiribati'),
('CC', 'Kokosinseln'),
('CO', 'Kolumbien'),
('KM', 'Komoren'),
('CG', 'Kongo-Brazzaville'),
('CD', 'Kongo-Kinshasa'),
('XK', 'Kosovo'),
('HR', 'Kroatien'),
('CU', 'Kuba'),
('KW', 'Kuwait'),
('LA', 'Laos'),
('LS', 'Lesotho'),
('LV', 'Lettland'),
('LB', 'Libanon'),
('LR', 'Liberia'),
('LY', 'Libyen'),
('LI', 'Liechtenstein'),
('LT', 'Litauen'),
('LU', 'Luxemburg'),
('MG', 'Madagaskar'),
('MW', 'Malawi'),
('MY', 'Malaysia'),
('MV', 'Malediven'),
('ML', 'Mali'),
('MT', 'Malta'),
('MA', 'Marokko'),
('MH', 'Marshallinseln'),
('MQ', 'Martinique'),
('MR', 'Mauretanien'),
('MU', 'Mauritius'),
('YT', 'Mayotte'),
('MK', 'Mazedonien'),
('MX', 'Mexiko'),
('FM', 'Mikronesien'),
('MC', 'Monaco'),
('MN', 'Mongolei'),
('ME', 'Montenegro'),
('MS', 'Montserrat'),
('MZ', 'Mosambik'),
('MM', 'Myanmar'),
('NA', 'Namibia'),
('NR', 'Nauru'),
('NP', 'Nepal'),
('NC', 'Neukaledonien'),
('NZ', 'Neuseeland'),
('NI', 'Nicaragua'),
('NL', 'Niederlande'),
('NE', 'Niger'),
('NG', 'Nigeria'),
('NU', 'Niue'),
('MP', 'Nördliche Marianen'),
('NF', 'Norfolkinsel'),
('NO', 'Norwegen'),
('OM', 'Oman'),
('AT', 'Österreich'),
('PK', 'Pakistan'),
('PS', 'Palästinensische Autonomiegebiete'),
('PW', 'Palau'),
('PA', 'Panama'),
('PG', 'Papua-Neuguinea'),
('PY', 'Paraguay'),
('PE', 'Peru'),
('PH', 'Philippinen'),
('PN', 'Pitcairninseln'),
('PL', 'Polen'),
('PT', 'Portugal'),
('PR', 'Puerto Rico'),
('KR', 'Republik Korea'),
('MD', 'Republik Moldau'),
('RE', 'Réunion'),
('RW', 'Ruanda'),
('RO', 'Rumänien'),
('RU', 'Russische Föderation'),
('SB', 'Salomonen'),
('ZM', 'Sambia'),
('WS', 'Samoa'),
('SM', 'San Marino'),
('ST', 'São Tomé und Príncipe'),
('SA', 'Saudi-Arabien'),
('SE', 'Schweden'),
('CH', 'Schweiz'),
('SN', 'Senegal'),
('RS', 'Serbien'),
('SC', 'Seychellen'),
('SL', 'Sierra Leone'),
('ZW', 'Simbabwe'),
('SG', 'Singapur'),
('SX', 'Sint Maarten'),
('SK', 'Slowakei'),
('SI', 'Slowenien'),
('SO', 'Somalia'),
('MO', 'Sonderverwaltungsregion Macau'),
('HK', 'Sonderverwaltungszone Hongkong'),
('ES', 'Spanien'),
('LK', 'Sri Lanka'),
('BL', 'St. Barthélemy'),
('SH', 'St. Helena'),
('KN', 'St. Kitts und Nevis'),
('LC', 'St. Lucia'),
('MF', 'St. Martin'),
('PM', 'St. Pierre und Miquelon'),
('VC', 'St. Vincent und die Grenadinen'),
('ZA', 'Südafrika'),
('SD', 'Sudan'),
('GS', 'Südgeorgien und die Südlichen Sandwichinseln'),
('SS', 'Südsudan'),
('SR', 'Suriname'),
('SJ', 'Svalbard und Jan Mayen'),
('SZ', 'Swasiland'),
('SY', 'Syrien'),
('TJ', 'Tadschikistan'),
('TW', 'Taiwan'),
('TZ', 'Tansania'),
('TH', 'Thailand'),
('TL', 'Timor-Leste'),
('TG', 'Togo'),
('TK', 'Tokelau'),
('TO', 'Tonga'),
('TT', 'Trinidad und Tobago'),
('TA', 'Tristan da Cunha'),
('TD', 'Tschad'),
('CZ', 'Tschechische Republik'),
('TN', 'Tunesien'),
('TR', 'Türkei'),
('TM', 'Turkmenistan'),
('TC', 'Turks- und Caicosinseln'),
('TV', 'Tuvalu'),
('UG', 'Uganda'),
('UA', 'Ukraine'),
('HU', 'Ungarn'),
('UY', 'Uruguay'),
('UZ', 'Usbekistan'),
('VU', 'Vanuatu'),
('VA', 'Vatikanstadt'),
('VE', 'Venezuela'),
('AE', 'Vereinigte Arabische Emirate'),
('US', 'Vereinigte Staaten'),
('GB', 'Vereinigtes Königreich'),
('VN', 'Vietnam'),
('WF', 'Wallis und Futuna'),
('CX', 'Weihnachtsinsel'),
('EH', 'Westsahara'),
('CF', 'Zentralafrikanische Republik'),
('CY', 'Zypern');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `with_documents_id` int(10) UNSIGNED NOT NULL,
  `with_documents_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_to` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `married` tinyint(1) NOT NULL DEFAULT '0',
  `children` int(11) NOT NULL DEFAULT '0',
  `disability` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `education_level` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locations` json NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_health_insurance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_insurance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_security_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_class` int(11) DEFAULT NULL,
  `account_holder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `applicant` tinyint(1) NOT NULL DEFAULT '0',
  `occupation_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contractual_working_hours` int(11) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `working_time_account` double(8,2) NOT NULL DEFAULT '0.00',
  `car` tinyint(1) NOT NULL DEFAULT '0',
  `driving_license` tinyint(1) NOT NULL DEFAULT '0',
  `public_transportation` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_order`
--

CREATE TABLE `employee_order` (
  `employee_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `working_area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `approved_by_employee` tinyint(1) DEFAULT NULL,
  `rejected_by_employee` tinyint(1) DEFAULT NULL,
  `employee_available` datetime DEFAULT NULL,
  `employee_not_available` datetime DEFAULT NULL,
  `meeting_point` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_time` time DEFAULT NULL,
  `sent` datetime DEFAULT NULL,
  `sent_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edited_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `employee_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `hourly_wage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extra_business`
--

CREATE TABLE `extra_business` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hours` double(8,2) NOT NULL,
  `total_min` int(11) NOT NULL,
  `information` text COLLATE utf8mb4_unicode_ci,
  `editor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_addition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `outro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_period` int(11) NOT NULL,
  `sum` double(8,2) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `pay_date` date DEFAULT NULL,
  `sent` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_data`
--

CREATE TABLE `invoice_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_addition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `outro` text COLLATE utf8mb4_unicode_ci,
  `default_tax_rate` int(11) NOT NULL DEFAULT '19',
  `payment_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `service` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `tax_rate` int(11) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL DEFAULT '0',
  `sum` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legal_salaries`
--

CREATE TABLE `legal_salaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_group` int(11) NOT NULL,
  `base_amount` double(8,2) NOT NULL,
  `extra_pay` double(8,2) NOT NULL,
  `valid_from` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `legal_salaries`
--

INSERT INTO `legal_salaries` (`id`, `region`, `salary_group`, `base_amount`, `extra_pay`, `valid_from`, `created_at`, `updated_at`) VALUES
(1, 'West', 1, 9.23, 0.20, '2017-03-01', NULL, NULL),
(2, 'West', 2, 9.85, 0.20, '2017-03-01', NULL, NULL),
(3, 'West', 3, 11.51, 0.20, '2017-03-01', NULL, NULL),
(4, 'West', 4, 12.18, 0.20, '2017-03-01', NULL, NULL),
(5, 'West', 5, 13.75, 0.35, '2017-03-01', NULL, NULL),
(6, 'West', 6, 15.47, 0.35, '2017-03-01', NULL, NULL),
(7, 'West', 7, 18.06, 0.35, '2017-03-01', NULL, NULL),
(8, 'West', 8, 19.43, 0.35, '2017-03-01', NULL, NULL),
(9, 'West', 9, 20.50, 0.35, '2017-03-01', NULL, NULL),
(10, 'West', 1, 9.49, 0.20, '2018-04-01', NULL, NULL),
(11, 'West', 2, 10.13, 0.20, '2018-04-01', NULL, NULL),
(12, 'West', 3, 11.83, 0.20, '2018-04-01', NULL, NULL),
(13, 'West', 4, 12.52, 0.20, '2018-04-01', NULL, NULL),
(14, 'West', 5, 14.13, 0.35, '2018-04-01', NULL, NULL),
(15, 'West', 6, 15.90, 0.35, '2018-04-01', NULL, NULL),
(16, 'West', 7, 18.57, 0.35, '2018-04-01', NULL, NULL),
(17, 'West', 8, 19.98, 0.35, '2018-04-01', NULL, NULL),
(18, 'West', 9, 21.07, 0.35, '2018-04-01', NULL, NULL),
(19, 'West', 1, 9.79, 0.20, '2019-04-01', NULL, NULL),
(20, 'West', 2, 10.45, 0.20, '2019-04-01', NULL, NULL),
(21, 'West', 3, 12.19, 0.20, '2019-04-01', NULL, NULL),
(22, 'West', 4, 12.89, 0.20, '2019-04-01', NULL, NULL),
(23, 'West', 5, 14.55, 0.35, '2019-04-01', NULL, NULL),
(24, 'West', 6, 16.38, 0.35, '2019-04-01', NULL, NULL),
(25, 'West', 7, 19.12, 0.35, '2019-04-01', NULL, NULL),
(26, 'West', 8, 20.58, 0.35, '2019-04-01', NULL, NULL),
(27, 'West', 9, 21.71, 0.35, '2019-04-01', NULL, NULL),
(28, 'West', 1, 9.96, 0.20, '2019-10-01', NULL, NULL),
(29, 'West', 2, 10.62, 0.20, '2019-10-01', NULL, NULL),
(30, 'West', 3, 12.19, 0.20, '2019-10-01', NULL, NULL),
(31, 'West', 4, 12.89, 0.20, '2019-10-01', NULL, NULL),
(32, 'West', 5, 14.55, 0.35, '2019-10-01', NULL, NULL),
(33, 'West', 6, 16.38, 0.35, '2019-10-01', NULL, NULL),
(34, 'West', 7, 19.12, 0.35, '2019-10-01', NULL, NULL),
(35, 'West', 8, 20.58, 0.35, '2019-10-01', NULL, NULL),
(36, 'West', 9, 21.71, 0.35, '2019-10-01', NULL, NULL),
(37, 'Ost', 1, 8.91, 0.20, '2017-03-01', NULL, NULL),
(38, 'Ost', 2, 9.01, 0.20, '2017-03-01', NULL, NULL),
(39, 'Ost', 3, 10.52, 0.20, '2017-03-01', NULL, NULL),
(40, 'Ost', 4, 11.14, 0.20, '2017-03-01', NULL, NULL),
(41, 'Ost', 5, 12.58, 0.35, '2017-03-01', NULL, NULL),
(42, 'Ost', 6, 14.15, 0.35, '2017-03-01', NULL, NULL),
(43, 'Ost', 7, 16.52, 0.35, '2017-03-01', NULL, NULL),
(44, 'Ost', 8, 17.78, 0.35, '2017-03-01', NULL, NULL),
(45, 'Ost', 9, 18.75, 0.35, '2017-03-01', NULL, NULL),
(46, 'Ost', 1, 9.27, 0.20, '2018-04-01', NULL, NULL),
(47, 'Ost', 2, 9.37, 0.20, '2018-04-01', NULL, NULL),
(48, 'Ost', 3, 10.95, 0.20, '2018-04-01', NULL, NULL),
(49, 'Ost', 4, 11.58, 0.20, '2018-04-01', NULL, NULL),
(50, 'Ost', 5, 13.09, 0.35, '2018-04-01', NULL, NULL),
(51, 'Ost', 6, 14.72, 0.35, '2018-04-01', NULL, NULL),
(52, 'Ost', 7, 17.18, 0.35, '2018-04-01', NULL, NULL),
(53, 'Ost', 8, 18.47, 0.35, '2018-04-01', NULL, NULL),
(54, 'Ost', 9, 19.50, 0.35, '2018-04-01', NULL, NULL),
(55, 'Ost', 1, 9.49, 0.20, '2019-01-01', NULL, NULL),
(56, 'Ost', 2, 9.73, 0.20, '2019-01-01', NULL, NULL),
(57, 'Ost', 3, 10.95, 0.20, '2019-01-01', NULL, NULL),
(58, 'Ost', 4, 11.58, 0.20, '2019-01-01', NULL, NULL),
(59, 'Ost', 5, 13.09, 0.35, '2019-01-01', NULL, NULL),
(60, 'Ost', 6, 14.75, 0.35, '2019-01-01', NULL, NULL),
(61, 'Ost', 7, 17.18, 0.35, '2019-01-01', NULL, NULL),
(62, 'Ost', 8, 18.47, 0.35, '2019-01-01', NULL, NULL),
(63, 'Ost', 9, 19.50, 0.35, '2019-01-01', NULL, NULL),
(64, 'Ost', 1, 9.49, 0.20, '2019-04-01', NULL, NULL),
(65, 'Ost', 2, 9.73, 0.20, '2019-04-01', NULL, NULL),
(66, 'Ost', 3, 11.33, 0.20, '2019-04-01', NULL, NULL),
(67, 'Ost', 4, 11.99, 0.20, '2019-04-01', NULL, NULL),
(68, 'Ost', 5, 13.55, 0.35, '2019-04-01', NULL, NULL),
(69, 'Ost', 6, 15.24, 0.35, '2019-04-01', NULL, NULL),
(70, 'Ost', 7, 17.78, 0.35, '2019-04-01', NULL, NULL),
(71, 'Ost', 8, 19.12, 0.35, '2019-04-01', NULL, NULL),
(72, 'Ost', 9, 20.18, 0.35, '2019-04-01', NULL, NULL),
(73, 'Ost', 1, 9.66, 0.20, '2019-10-01', NULL, NULL),
(74, 'Ost', 2, 9.90, 0.20, '2019-10-01', NULL, NULL),
(75, 'Ost', 3, 11.33, 0.20, '2019-10-01', NULL, NULL),
(76, 'Ost', 4, 11.99, 0.20, '2019-10-01', NULL, NULL),
(77, 'Ost', 5, 13.55, 0.35, '2019-10-01', NULL, NULL),
(78, 'Ost', 6, 15.24, 0.35, '2019-10-01', NULL, NULL),
(79, 'Ost', 7, 17.78, 0.35, '2019-10-01', NULL, NULL),
(80, 'Ost', 8, 19.12, 0.35, '2019-10-01', NULL, NULL),
(81, 'Ost', 9, 20.18, 0.35, '2019-10-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `legal_texts`
--

CREATE TABLE `legal_texts` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `legal_texts`
--

INSERT INTO `legal_texts` (`id`, `type`, `sub_type`, `section`, `title`, `body`) VALUES
(1, 'igz', 'Entgelttarifvertrag', 'scope', 'Geltungsbereich', '\n                    <p>Dieser Tarifvertrag gilt:</p>\n                    <p>1. räumlich für das Gebiet der Bundesrepublik Deutschland,</p>\n                    <p>2. fachlich für alle ordentlichen Mitglieder des Interessenverbandes Deutscher Zeitarbeitsunternehmen (iGZ e.V.),</p>\n                    <p>3. persönlich für alle Arbeitnehmer, die im Rahmen der Arbeitnehmerüberlassung an Kundenbetriebe überlassen werden und Mitglied einer der vertragsschließenden Gewerkschaften sind.</p>\n                    \n                    <p>Der Tarifvertrag findet keine Anwendung auf Zeitarbeitsunternehmen und -unternehmensteile, die mit dem Kundenunternehmen einen Konzern im Sinne des § 18 Aktiengesetz bilden, wenn</p>\n                    <p>a) das Zeitarbeitsunternehmen in einem ins Gewicht fallenden Maße zuvor beim Kundenunternehmen beschäftigte Arbeitnehmer übernimmt und</p>\n                    <p>b) die betroffenen Arbeitnehmer auf ihrem ursprünglichen oder einem vergleichbaren Arbeitsplatz im Kundenunternehmen eingesetzt werden und</p>\n                    <p>c) dadurch bestehende im Kundenunternehmen wirksame Entgelttarifverträge zuungunsten der betroffenen Arbeitnehmer umgangen werden.</p>\n                    \n                    <p>Die in diesem Vertragstext verwendete Bezeichnung „Arbeitnehmer“ umfasst weibliche und männliche Beschäftigte. Sie wird ausschließlich aus Gründen der besseren Lesbarkeit verwendet.</p>\n                '),
(2, 'igz', 'Entgelttarifvertrag', 'special_regulation', '§3 Sonderregelung', '\n                    <p>Für Arbeitnehmer, die in Betriebe in den Bundesländern Mecklenburg-Vorpommern, Brandenburg, Berlin, Sachsen-Anhalt, Thüringen und Sachsen überlassen werden, richten sich die Entgelte nach den in diesem Tarifvertrag abgebildeten Entgelttabellen Ost.</p>\n                    <p>Ab 01. April 2021 wird der Geltungsbereich der Entgelttabelle West auf das gesamte Bundesgebiet erweitert. Damit entfällt die bisherige Entgelttabelle Ost. Der letzte Anpassungsschritt der Ost/West-Angleichung erfolgt im Rahmen der nächsten Entgelttarifverhandlungen.</p>\n                '),
(3, 'igz', 'Entgelttarifvertrag', 'betterment_agreement', '§4 Besserstellungsvereinbarung', '\n                    <p>Zwischen den Tarifvertragsparteien dieses Tarifvertrages und dem Arbeitgeber des Kundenbetriebes kann eine tarifliche Regelung zur Vergütung der Einsatzzeiten in diesem Kundenbetrieb getroffen werden (dreiseitige Vereinbarung), wenn diese für die dort eingesetzten Mitarbeiter des Zeitarbeitsunternehmens günstiger ist.</p> \n                '),
(4, 'igz', 'Entgelttarifvertrag', 'inception_termination', '§5 Inkrafttreten und Kündigung', '\n                    <p>Dieser Vertrag tritt am 01. Januar 2017 für alle tarifgebundenen Mitglieder der Vertragsparteien in Kraft und kann mit einer Frist von sechs Monaten zum Monatsende, erstmals jedoch zum 31. Dezember 2019, gekündigt werden.<p/> \n                '),
(5, 'igz', 'Entgelttarifvertrag', 'severability_clause', '§6 Salvatorische Klausel', '\n                    <p>Sollten einzelne Bestimmungen dieses Vertrages, gleich aus welchem Grund, unwirksam sein oder werden, so soll hierdurch die Gültigkeit der übrigen Bestimmungen des Vertrages nicht berührt werden. Anstelle der unwirksamen Bestimmung soll jene angemessene Bestimmung treten, die dem am nächsten kommt, was die Parteien nach Sinn und Zweck des Vertrages gewollt haben.</p> \n                '),
(6, 'igz', 'Entgelttarifvertrag', 'notes', 'Protokllnotizen', '\n                    <p>1. Der Tarifvertrag entfaltet keine Bindung für Fördermitglieder des iGZ.</p>\n                    <p>2. Im gegenseitigen Einvernehmen können Ergänzungen jederzeit vorgenommen werden.</p>\n                    <p>3. Durch den Tarifvertrag werden gesetzliche Mindestlohnansprüche nach dem ArbeitnehmerEntsendegesetz nicht berührt.</p>\n                    <p>Berlin, den 30. November 2016</p>\n                '),
(7, 'igz', 'Manteltarifvertrag', 'scope', '§1 Geltungsbereich', '\n                    <p>Dieser Tarifvertrag gilt:</p>\n                    <p>1. räumlich für das Gebiet der Bundesrepublik Deutschland,</p>\n                    <p>2. fachlich für alle ordentlichen Mitglieder des Interessenverbandes Deutscher Zeitarbeitsunternehmen (iGZ e.V.),</p>\n                    <p>3. persönlich für alle Arbeitnehmer, die im Rahmen der Arbeitnehmerüberlassung an Kundenbetriebe überlassen werden und Mitglied einer der vertragsschließenden Gewerkschaften sind.</p>\n                    <p>Der Tarifvertrag findet keine Anwendung auf Zeitarbeitsunternehmen und -unternehmensteile, die mit dem Kundenunternehmen einen Konzern im Sinne des § 18 Aktiengesetz bilden, wenn</p>\n                    <p>a) das Zeitarbeitsunternehmen in einem ins Gewicht fallenden Maße zuvor beim Kundenunternehmen beschäftigte Arbeitnehmer übernimmt und</p>\n                    <p>b) die betroffenen Arbeitnehmer auf ihrem ursprünglichen oder einem vergleichbaren Arbeitsplatz im Kundenunternehmen eingesetzt werden und</p>\n                    <p>c) dadurch bestehende im Kundenunternehmen wirksame Entgelttarifverträge zuungunsten der betroffenen Arbeitnehmer umgangen werden.</p>\n                    <p>Die in diesem Vertragstext verwendete Bezeichnung „Arbeitnehmer“ umfasst weibliche und männliche Beschäftigte. Sie wird ausschließlich aus Gründen der besseren Lesbarkeit verwendet.</p>\n                '),
(8, 'igz', 'Manteltarifvertrag', 'employment', '§2 Beginn und Ende des Beschäftigungsverhältnisses', '\n                    <h4>2.1. Arbeitsvertrag und Altersgrenze</h4>\n                    <p>Der Arbeitgeber hat mit dem Arbeitnehmer einen schriftlichen Arbeitsvertrag abzuschließen. Erscheint der Arbeitnehmer am ersten Arbeitstag nicht und benachrichtigt den Arbeitgeber nicht unverzüglich über die Verhinderung am ersten Arbeitstag, so gilt das Beschäftigungsverhältnis als nicht zustande gekommen.</p>\n                    <p>Das Beschäftigungsverhältnis endet mit dem Ablauf des Kalendermonats, in dem der Arbeitnehmer erstmals Anspruch auf ungekürzte Regelaltersrente nach den Bestimmungen der gesetzlichen Rentenversicherung hat oder haben würde, wenn er in der gesetzlichen Rentenversicherung versichert wäre.</p>\n                    <h4>2.2. Probezeit und Kündigungsfristen</h4>\n                    <p>Die ersten sechs Monate des Beschäftigungsverhältnisses gelten als Probezeit. In den ersten vier Wochen der Probezeit kann das Beschäftigungsverhältnis mit einer Frist von 2 Arbeitstagen gekündigt werden. Von der fünften Woche an bis zum Ablauf des zweiten Monats beträgt die Kündigungsfrist 1 Woche, vom dritten Monat bis zum sechsten Monat des Beschäftigungsverhältnisses 2 Wochen.</p>\n                    <p>Vom siebten Monat des Beschäftigungsverhältnisses an gelten die gesetzlichen Kündigungsfristen. Diese gesetzlichen Kündigungsfristen gelten beiderseits.</p>\n                    <p>Probezeit und Kündigungsfristen gelten gleichermaßen für befristete Beschäftigungsverhältnisse.</p>\n                '),
(9, 'igz', 'Manteltarifvertrag', 'working_hours', '§3 Arbeitszeit', '\n                    <h4>3.1. Arbeitszeit</h4>\n                    <p>3.1.1. Die individuelle regelmäßige monatliche Arbeitszeit beträgt für Vollzeitbeschäftigte 151,67 Stunden. Das entspricht einer durchschnittlichen wöchentlichen Arbeitszeit von 35 Stunden. Teilzeitarbeit liegt vor, wenn die vertraglich vereinbarte Arbeitszeit des Arbeitnehmers geringer ist als die tarifliche Arbeitszeit eines Vollzeitbeschäftigten. Teilzeitbeschäftigte haben im Rahmen ihres Arbeitsvertrages die gleichen tariflichen Rechte und Pflichten wie Vollzeitbeschäftigte, soweit sich aus den Tarifverträgen nichts anderes ergibt.\n                    <p>3.1.2. Die individuelle regelmäßige Arbeitszeit pro Monat richtet sich nach der Anzahl der Arbeitstage.\n                    <p>In Monaten mit\n                    <ul>\n                        <li>20 Arbeitstagen beträgt die Monatsarbeitszeit 140 Std.</li>\n                        <li>21 Arbeitstagen beträgt die Monatsarbeitszeit 147 Std.</li>\n                        <li>22 Arbeitstagen beträgt die Monatsarbeitszeit 154 Std.</li>\n                        <li>23 Arbeitstagen beträgt die Monatsarbeitszeit 161 Std.</li>\n                    </ul>\n                    <p>Bei Teilzeitarbeit berechnet sich die regelmäßige Arbeitszeit pro Monat anteilig.</p>\n                    <p>3.1.3. Die monatliche Arbeitszeit wird an die des Entleihers angepasst. Beginn und Ende der täglichen Arbeitszeit einschließlich der Pausen und die Verteilung der Arbeitszeit auf die einzelnen Wochentage richten sich nach den im jeweiligen Entleiherbetrieb gültigen Regelungen bzw. Anforderungen des Entleihers.</p>\n                    <p>Die Tarifvertragsparteien sind darüber einig, dass die Anpassung der monatlichen Arbeitszeit an die des Entleihbetriebes gem. § 3.1.3 Manteltarifvertrag auch auf Zeiten der Betriebsruhe beim Entleihbetrieb Anwendung finden kann. In diesen Fällen können die Regelungen des § 7.2 Manteltarifvertrag analog angewendet werden mit der Maßgabe, dass ein dadurch verursachtes negatives Arbeitszeitkontensaldo, das über 21 Minusstunden hinausgeht, bei Beendigung des Arbeitsverhältnisses nicht mit Entgeltansprüchen verrechnet werden darf bzw. nicht zurückgezahlt werden muss.</p>\n                    <p>Berechtigte Wünsche der Arbeitnehmer bezüglich der Lage und der Aufteilung zwischen Belastung des Arbeitszeitkontos und Urlaub oder eines alternativen Einsatzes sind nach Möglichkeit zu berücksichtigen.</p>\n                    <p>3.1.4. Bei Einsatz in vollkontinuierlicher Schichtarbeit (Contischicht) oder einem vergleichbaren anderen Schichtmodell des Entleihers gilt für den Arbeitnehmer das Arbeitszeit-/Zuschlagsmodell des Entleihers nur, wenn ein voller Zyklus durchlaufen wird. Wird kein voller Zyklus durchlaufen, gilt für diesen Zeitraum der Durchschnitt der monatlichen Arbeitszeit zur Berechnung der geleisteten Stunden.</p>\n                    <p>3.1.5. An Heiligabend und Silvester endet die Arbeitszeit um 14.00 Uhr. Für Arbeiten darüber hinaus gilt die Zuschlagsregelung für Feiertage. Beide Tage können unabhängig von den Bestimmungen gemäß § 3.2.3 über das Arbeitszeitkonto oder das Urlaubskonto als freie Tage entgolten werden.</p>\n                    <h4>3.2. Arbeitszeitkonto</h4>\n                    <p>3.2.1. Für jeden Arbeitnehmer wird ein Arbeitszeitkonto eingerichtet. Auf dieses Konto werden die Stunden übertragen, die über die regelmäßige Arbeitszeit pro Monat hinaus abgerechnet werden. Zulässig ist gleichermaßen die Übertragung von Minusstunden.</p>\n                    <p>3.2.2. Es dürfen nur so viele Stunden auf das Arbeitszeitkonto übertragen werden, dass die Grenzwerte von maximal 150 Plusstunden und 21 Minusstunden nicht überschritten werden. Bei Teilzeitbeschäftigung wird die Plusstundenobergrenze der Arbeitszeitkonten im Verhältnis zur arbeitsvertraglich vereinbarten Arbeitszeit angepasst.</p> \n                    <p>3.2.3. Die auf dem Arbeitszeitkonto aufgelaufenen Stunden werden in der Regel durch Freizeit ausgeglichen (vgl. PN 8). Dabei können der Arbeitgeber und der Arbeitnehmer in jedem Kalendermonat über jeweils zwei Arbeitstage Zeitguthaben frei verfügen. Eine Verfügung durch den Arbeitgeber darf nicht zu einem negativen Zeitguthaben des Arbeitnehmers führen.</p>\n                    <p>Die Freizeitgewährung ist spätestens 2 Arbeitstage vor Antritt vom Arbeitnehmer beim Arbeitgeber zu beantragen und kann nur aus dringenden betrieblichen Gründen abgelehnt werden. In einem solchen Falle hat der Arbeitgeber innerhalb von 4 Wochen</p>\n                    <p>dem Freizeitersuchen nachzukommen. Eine vom Arbeitnehmer beanspruchte Freistellung zum Abbau von Guthabenstunden aus dem Arbeitszeitkonto wird nicht durch Zuteilung eines neuen Einsatzes unterbrochen. Bei Arbeitsunfähigkeit während eines beanspruchten Freizeitausgleichs werden Zeiten auf das Arbeitszeitkonto rückübertragen.</p>\n                    <p>Darüber hinaus erfolgt der Freizeitausgleich nach den Wünschen des Arbeitnehmers in Absprache mit dem Arbeitgeber und unter Berücksichtigung betrieblicher Belange. Der Freizeitausgleich ist durch den Arbeitnehmer zu beantragen und bedarf der Genehmigung durch den Arbeitgeber.</p>\n                    <p>3.2.4. Bei Ausscheiden wird ein positives Zeitguthaben ausgezahlt, ein negatives Zeitguthaben wird mit Entgeltansprüchen verrechnet bzw. ist zurückzuzahlen. Der Arbeitgeber hat dem Arbeitnehmer die Möglichkeit zu geben, ein negatives Zeitguthaben auch durch Arbeit auszugleichen.</p>\n                    <p>3.2.5. Nach Ausspruch einer Kündigung ist der Arbeitgeber berechtigt, den Arbeitnehmer unter Fortzahlung seines Entgeltes und unter Anrechnung etwaiger Urlaubsansprüche und Guthaben aus dem Arbeitszeitkonto freizustellen. Im Falle iner betriebsbedingten Kündigung ist eine Freistellung zum Abbau des Arbeitszeitkontos nur mit Zustimmung des Arbeitnehmers möglich.</p> \n                    <p>3.2.6. Die Zulagen und Zuschläge werden jeweils mit dem Entgelt für den Monat ausgezahlt, in dem sie anfallen und werden nicht auf das Arbeitszeitkonto übertragen. Die Auszahlung der Stunden aus dem Arbeitszeitkonto erfolgt stets nur in Höhe der tariflichen Eingangsstufe ohne erücksichtigung von Branchenzuschlägen und sonstigen Zulagen und Zuschlägen.</p> \n                    <p>3.2.7. Auf Verlangen des Arbeitnehmers werden Stunden aus dem Arbeitszeitkonto, die über 105 Plusstunden hinausgehen, ausbezahlt. Bei Teilzeitbeschäftigten richtet sich die Anzahl der Plusstunden anteilig nach der jeweils arbeitsvertraglich vereinbarten Arbeitszeit.</p>\n                '),
(10, 'igz', 'Manteltarifvertrag', 'surcharges', '§4 Zuschläge', '\n                    <h4>4.1. Mehrarbeit</h4>\n                    <p>4.1.1. Mehrarbeit ist die über die regelmäßige monatliche Arbeitszeit hinausgehende Arbeitszeit.</p>\n                    <p>4.1.2. Mehrarbeitszuschläge werden für Zeiten gezahlt, die in Monaten mit</p>\n                    <ul>\n                        <li>20 Arbeitstagen über 160 geleistete Stunden</li>\n                        <li>21 Arbeitstagen über 168 geleistete Stunden</li>\n                        <li>22 Arbeitstagen über 176 geleistete Stunden</li>\n                        <li>23 Arbeitstagen über 184 geleistete Stunden</li>                \n                    </ul>\n                    <p>hinausgehen.</p>\n                    <p>Der Mehrarbeitszuschlag beträgt 25 Prozent.</p>\n                    <p>Diese Regelungen gelten gleichermaßen für Teilzeitbeschäftigte.</p>\n                    <h4>4.2. Nachtarbeit</h4>\n                    <p>Zuschläge für Nachtarbeit werden für Arbeit in der Zeit von 23.00 bis 6.00 Uhr gewährt, sofern mehr als 2 Stunden innerhalb dieser Nachtzeit gearbeitet wurde. Der Zuschlag für Nachtarbeit beträgt 25 Prozent. Regelmäßige Nachtarbeit (Dauernachtschicht) wird mit einem Zuschlag von 20 Prozent vergütet.</p>\n                    <p>Für Tätigkeiten, die aus sachlichen Gründen typischerweise nachts verrichtet werden müssen (z.B. Bewachungsdienste), werden keine Zuschläge vergütet.</p>\n                    <h4>4.3. Sonntagsarbeit</h4>\n                    <p>Der Zuschlag für Sonntagsarbeit beträgt 50 Prozent, sofern die Arbeit an Sonntagen nicht zur Regelarbeitszeit zählt (vgl. PN 7).</p>\n                    <h4>4.4. Feiertagsarbeit</h4>\n                    <p>Der Zuschlag für Feiertagsarbeit beträgt 100 Prozent, sofern die Arbeit an Feiertagen nicht zur Regelarbeitszeit zählt (vgl. PN 7).</p>\n                    <p>Es gilt die gesetzliche Feiertagsregelung am jeweiligen Einsatzort.</p>\n                    <h4>4.5. Sonstige Zuschlagsvereinbarungen</h4>\n                    <p>4.5.1. Treffen mehrere Zuschläge für die gleiche Arbeitszeit zusammen, so wird nur der jeweils höhere Zuschlag gezahlt.</p>\n                    <p>4.5.2. Die prozentuale Zuschlagsberechnung bezieht sich auf die Vergütung gemäß aktueller Entgeltgruppe und -stufe gemäß § 2 des Entgelttarifvertrages. Die Zuschlagsberechnung bezieht sich nicht auf die einsatzbezogene Zulage oder etwaige außertarifliche Zulagen.</p>\n                    <p>4.5.3. Abweichend von den Ziffern 4.1. bis 4.4. werden für Tätigkeiten im medizinischen/ärztlichen Bereich folgende Zuschläge vereinbart:</p>\n                    <ul>\n                        <li>Nachtarbeit 15,0 Prozent</li>\n                        <li>Sonntagsarbeit 25,0 Prozent</li>\n                        <li>Feiertagsarbeit 35,0 Prozent</li>\n                        <li>Samstagsarbeit in der  Zeit von 13.00–23.00 Uhr 7,5 Prozent</li>\n                    </ul>\n                    <p>4.5.4. Abweichend von den Ziffern 4.1. bis 4.4. richten sich für Tätigkeiten im gastronomischen Bereich die Zuschläge für Nacht-, Sonn- und Feiertagsarbeit nach der jeweiligen Zuschlagsregelung im Entleihbetrieb.</p>\n                '),
(11, 'igz', 'Manteltarifvertrag', 'time_off', '§5 Arbeitsbefreiung', '\n                    <p>5.1. Soweit dieser Tarifvertrag nichts anderes bestimmt, gilt der Grundsatz, dass nur geleistete Arbeit vergütet wird.</p> \n                    <p>5.2. In unmittelbarem Zusammenhang mit den nachstehenden Ereignissen ist dem Arbeitnehmer bezahlte Freistellung von der Arbeit ohne Anrechnung auf den Urlaub zu gewähren:\n                    <p>a) bei eigener Eheschließung oder Eintragung einer eingetragenen Lebensgemeinschaft 1 Tag</p> \n                    <p>b) bei Niederkunft der Ehefrau 1 Tag</p> \n                    <p>c) bei Tod des mit dem Arbeitnehmer in häuslicher Gemeinschaft lebenden Ehegatten oder eingetragenen Lebenspartners 2 Tage</p>\n                    <p>d) bei Tod eines Elternteils oder eines Kindes 1 Tag</p>\n                    <p>e) bei Umzug auf Veranlassung des Arbeitgebers 1 Tag</p>\n                    <p>f) bei Erfüllung gesetzlich auferlegter Pflichten aus öffentlichen Ehrenämtern für die notwendige ausfallende Arbeitszeit. Soweit Erstattungsanspruch besteht, entfällt in dieser Höhe der Anspruch auf das Arbeitsentgelt.</p>\n                    <p>Bezüglich der Buchstaben b), c) und d) gelten die Regelungen entsprechend auch für Arbeitnehmer in eheähnlicher Lebensgemeinschaft.</p>\n                    <p>Die Ansprüche auf Freistellung nach Buchstaben a) bis d) bestehen nach einer Betriebszugehörigkeit von 6 Monaten.</p>\n                    <p>Bezahlte Freistellung wird auf vorherigen schriftlichen Antrag gewährt und ist vom Arbeitnehmer mit Dokumenten nachzuweisen. Der Nachweis ist spätestens innerhalb von zwei Wochen nach dem Ereignis beizubringen.</p>\n                    <p>Damit sind alle Anlässe aus § 616 BGB kompensiert.</p>\n                '),
(12, 'igz', 'Manteltarifvertrag', 'holiday', '§6 Urlaub', '\n                    <h4>6.1. Urlaubsgewährung</h4>\n                    <p></p>Die Urlaubsgewährung richtet sich nach den Regelungen des Bundesurlaubsgesetzes. Urlaubstermine können jeweils nur im Einvernehmen mit dem Arbeitgeber festgelegt werden.\n                    <h4>6.2. Urlaubsanspruch</h4>\n                    <p>6.2.1. Der Urlaubsanspruch des Arbeitnehmers erhöht sich mit zunehmender Dauer der Betriebszugehörigkeit.</p>\n                    <p>Der Arbeitnehmer erhält, berechnet nach der Dauer des ununterbrochenen Bestehens des Arbeitsverhältnisses (vgl. PN 5;6)</p>\n                    <ul>\n                        <li>im ersten Jahr einen Jahresurlaub von 24 Arbeitstagen,</li>\n                        <li>im zweiten Jahr einen Jahresurlaub von 25 Arbeitstagen,</li>\n                        <li>im dritten Jahr einen Jahresurlaub von 26 Arbeitstagen,</li>\n                        <li>im vierten Jahr einen Jahresurlaub von 28 Arbeitstagen,</li>\n                        <li>ab dem fünften Jahr einen Jahresurlaub von 30 Arbeitstagen.</li>\n                    </ul>\n                    <p>Bei Ausscheiden innerhalb der ersten sechs Monate des Bestehens des Beschäftigungsverhältnisses erwirbt der Arbeitnehmer Urlaubsanspruch gemäß Bundesurlaubsgesetz.</p>\n                    \n                    <p>Bezahlte Freistellung wird auf vorherigen schriftlichen Antrag gewährt und ist vom Arbeitnehmer mit Dokumenten nachzuweisen. Der Nachweis ist spätestens innerhalb von zwei Wochen nach dem Ereignis beizubringen.\n                    <p>6.2.2. Für Teilzeitbeschäftigte ist der Jahresurlaub anteilig zu berechnen.</p>\n                    <p>6.2.3. Scheidet der Arbeitnehmer im Laufe eines Kalenderjahres aus dem Unternehmen aus oder tritt er im Laufe eines Kalenderjahres ein, so erhält er für jeden vollen Monat des Bestehens des Beschäftigungsverhältnisses ein Zwölftel des ihm zustehenden Jahresurlaubs.</p>\n                    <p>6.2.4. Der Urlaubsanspruch erlischt nach Ablauf des Kalenderjahres, wenn er nicht zuvor erfolglos geltend gemacht wurde oder aus betrieblichen Gründen oder wegen Krankheit nicht genommen werden konnte. In den genannten Fällen wird der Resturlaub in das Folgejahr übertragen.</p>\n                    <p>Wird dieser Resturlaub durch den Arbeitnehmer nicht bis spätestens zum 31. März des Folgejahres in Anspruch genommen, erlischt der Anspruch zu diesem Zeitpunkt.</p>\n                    <p>Wenn Urlaub wegen einer Langzeitarbeitsunfähigkeit nicht genommen werden konnte, auch nicht bis zum 31. März des Folgejahres, so verfällt der Anspruch.</p>\n                '),
(13, 'igz', 'Manteltarifvertrag', 'charges', '§6a Urlaubsentgelt und Entgeltfortzahlung', '\n                    <p>Für die Berechnung der Entgeltfortzahlung im Krankheitsfall und des Urlaubsentgelts sind für jeden nach den gesetzlichen und tariflichen Bestimmungen zu vergütenden Krankheits- bzw. Urlaubstag für die Höhe des fortzuzahlenden Entgelts der durchschnittliche Arbeitsverdienst und die durchschnittliche Arbeitszeit der letzten drei abgerechneten Monate (Referenzzeitraum) vor Beginn der Arbeitsunfähigkeit bzw. des Urlaubsantritts zugrunde zu legen. Hierfür gilt:</p> \n                    <p>a) Es ist der durchschnittliche Arbeitsverdienst des Referenzzeitraums auf Grundlage der individuellen regelmäßigen Arbeitszeit zu bilden. Zum Arbeitsverdienst zählen die Entgeltbestandteile gemäß § 2 Entgelttarifvertrag iGZ sowie sonstige Zulagen und Zuschläge (ohne Mehrarbeitszuschläge) gemäß den Bestimmungen des Bundesurlaubsgesetzes.</p> \n                    <p>b) Zusätzlich finden die durchschnittlich im Referenzzeitraum erarbeiteten Zulagen und Zuschläge (ohne Mehrarbeitszuschläge) auf Grundlage der durchschnittlichen tatsächlichen Arbeitszeit Berücksichtigung, die über die individuelle regelmäßige Arbeitszeit hinausgeht.</p>\n                    <p>c) Für die im Arbeitszeitkonto zu berücksichtigenden Stunden ist die im Referenzzeitraum durchschnittlich ermittelte Arbeitszeit gemäß Buchstabe b) maßgeblich (vgl. § 3.2.1.).</p> \n                    <p>Liegen im Referenzzeitraum Verdienstkürzungen aufgrund von Kurzarbeit, Krankheitstagen, für die wegen Überschreitung der 6-Wochen-Frist kein Entgeltfortzahlungsanspruch besteht, unverschuldeten Arbeitsversäumnissen oder Zeiten, in denen das Arbeitsverhältnis ruht, bleiben diese für die Berechnung außer Betracht.</p> \n                    <p>Bestehende, für den Arbeitnehmer günstigere, betriebliche Vereinbarungen bleiben unberührt. </p>\n                    <p>Die in der Protokollnotiz enthaltenen Berechnungsbeispiele sind verbindliche Bestandteile des Tarifvertrages. Die Entgeltfortzahlung bei Maßnahmen der medizinischen Vorsorge und Rehabilitation richtet sich nach den Bestimmungen des Entgeltfortzahlungsgesetzes.</p>\n                    <p>Die Tarifvertragsparteien einigen sich auf folgende Berechnungsbeispiele:</p>\n                    <p>Beispiel 1 (auf Grundlage der individuellen regelmäßigen monatlichen Arbeitszeit):</p>\n                    <p>In den letzten drei abgerechneten Monaten (65 Tage) vor dem Arbeitsausfall hat der Arbeitnehmer einen Stundenverdienst von 10,22 Euro (EG 3 bis 31.12.2013). Er hat 30 Tage à 7 Std. mit einem Branchenzuschlag von 1,53 Euro (Branchenzuschlag TV BZ M+E) gearbeitet.</p> \n                    <p>Er kehrt dann in einen zuvor ausgeübten Einsatz in der Chemieindustrie zurück und arbeitet dort an 35 Tagen à 8 Std. mit einem Branchenzuschlag von 1,02 Euro (Branchenzuschlag TV BZ Chemie).</p>\n                    <p>Hieraus ergibt sich folgende Berechnung für das Urlaubsentgelt und die Entgeltfortzahlung im Krankheitsfall:</p> \n                    <p>a) 151,67 Std. x 3 Monate x 10,22 Euro = 4.650,20 Euro</p>\n                    <p>(tarifliches Grundentgelt ohne Zuschläge auf Grundlage der individuellen regelmäßigen monatlichen Arbeitszeit im Referenzzeitraum)</p>\n                    <p>b) 30 Tage x 7 Std. x 1,53 Euro = 321,30 Euro (Zulagen/Zuschläge auf der Grundlage der tatsächlichen Arbeitszeit) + 35 Tage x 8 Std. x 1,02 Euro = 285,60 Euro = 606,90 Euro</p>\n                    <p>c) 4.650,20 Euro + 606,90 Euro = 5.257,10 Euro d) 5.257,10 Euro / 65 Tage = 80,88 Euro/Tag Für jeden Urlaubs-/Krankheitstag werden 80,88 Euro ausgezahlt.</p>\n                    <p>e) (30 Tage x 7 Std. + 35 Tage x 8 Std.) / 65 Tage = 7,54 Std.</p>\n                    <p>Für jeden Urlaubs-/Krankheitstag werden 7,54 Std. in der Zeiterfassung berücksichtigt.</p>\n                    <p>Beispiel 2 (auf Grundlage der individuellen regelmäßigen Arbeitszeit pro Monat):\n                    <p>Der Arbeitnehmer hat einen Stundenverdienst von 10,22 Euro (EG 3 bis 31.12.2013) und eine übertarifliche Zulage von 1,78 Euro, so dass er einen Gesamtverdienst pro Std. von 12 Euro hat. Er hat durchschnittlich 7,5 Std. in den letzten drei abgerechneten Monaten (65 Tage) vor dem Arbeitsausfall gearbeitet.</p> \n                    <p>Hieraus ergibt sich folgende Berechnung für das Urlaubsentgelt und die Entgeltfortzahlung im Krankheitsfall:</p>\n                    <p>a) 65 Tage x 7 Std. x 10,22 Euro = 4.650,10 Euro (tarifliches Grundentgelt ohne Zuschläge auf Grundlage der regelmäßigen Arbeitszeit pro Monat im Referenzzeitraum)</p>\n                    <p>b) 65 Tage x 7,5 Std. x 1,78 Euro = 867,75 Euro (Zulagen/Zuschläge auf der Grundlage der tatsächlichen Arbeitszeit)</p>\n                    <p>c) 4.650,10 Euro + 867,75 Euro (Addition der Ergebnisse aus a) und b)) = 5.517,85 Euro</p>\n                    <p>d) 5.517,85 Euro / 65 Tage = 84,89 Euro/Tag</p> \n                    <p>Für jeden Urlaubs-/Krankheitstag werden 84,89 Euro ausgezahlt. Für jeden Urlaubs-/Krankheitstag werden 7,5 Std. in der Zeiterfassung berücksichtigt.</p>\n                '),
(14, 'igz', 'Manteltarifvertrag', 'bridging_days', '§7 Brückentage/Betriebsruhe', '\n                    <p>7.1. Um den Arbeitnehmern in Verbindung mit Feiertagen und Wochenenden (sog. Brückentage) eine längere zusammenhängende Freizeit zu gewähren, können Arbeitstage vor oder im Anschluss an Feiertage festgelegt werden, an denen nicht gearbeitet wird.</p>\n                    <p>7.2. Für einen zusammenhängenden Zeitraum – von höchstens 14 Kalendertagen – kann Betriebsruhe angeordnet werden. Dazu benötigte Zeit kann vom Arbeitszeitkonto oder vom Jahresurlaub übertragen werden. Ausschließlich für diesen Zweck können auf dem Arbeitszeitkonto bis zu 50 Minusstunden angesammelt werden.</p>\n                    <p>Für die Lage der Betriebsruhe sind nach Möglichkeit die Wünsche der Mitarbeiter zu berücksichtigen.</p>\n                '),
(15, 'igz', 'Manteltarifvertrag', 'annual_special_payment', '§8 Jahressonderzahlungen', '\n                    <p>Nach dem sechsten Monat des ununterbrochenen Bestehens des Beschäftigungsverhältnisses (vgl. PN 5;6) hat der Arbeitnehmer Anspruch auf Jahressonderzahlungen in Form von zusätzlichem Urlaubs- und Weihnachtsgeld. Die Auszahlung des zusätzlichen Urlaubsgeldes erfolgt mit der Abrechnung für den Monat Juni eines jeden Jahres, die Auszahlung des Weihnachtsgeldes erfolgt mit der Abrechnung für den Monat November eines jeden Jahres.</p>\n                    <p>Zusätzliches Urlaubs- und Weihnachtsgeld erhöhen sich mit zunehmender Dauer der Betriebszugehörigkeit, berechnet auf die Stichtage 30. Juni und 30. November.</p> \n                    <p>Das zusätzliche Urlaubs- und Weihnachtsgeld beträgt, abhängig von der Dauer des ununterbrochenen Bestehens des Arbeitsverhältnisses (vgl. PN 5;6)</p>\n                    <ul>\n                        <li>nach dem sechsten Monat jeweils 150 Euro brutto,</li>\n                        <li>im dritten und vierten Jahr jeweils 200 Euro brutto,</li>\n                        <li>ab dem fünften Jahr jeweils 300 Euro brutto.</li>\n                    </ul>\n                    <p>Voraussetzung für den Anspruch auf Auszahlung der Sonderzahlungen ist das Bestehen eines ungekündigten Beschäftigungsverhältnisses zum Auszahlungszeitpunkt.</p>\n                    <p>Teilzeitbeschäftigte erhalten die Sonderzahlungen anteilig entsprechend der vereinbarten regelmäßigen monatlichen Arbeitszeit.</p>\n                    <p>Arbeitnehmer, die bis zum 31. März des Folgejahres aus dem Arbeitgeberbetrieb ausscheiden, haben das Weihnachtsgeld zurückzuzahlen. Dies gilt nicht im Fall einer betriebsbedingten Kündigung durch den Arbeitgeber.</p>\n                '),
(16, 'igz', 'Manteltarifvertrag', 'conciliation_board', '§9 Tarifliche Schlichtungsstelle', '\n                    <p>9.1. Bei Meinungsverschiedenheiten zwischen Arbeitgeber und Arbeitnehmer über die Durchführung und Anwendung dieses Tarifvertrages sind die Tarifvertragsparteien hinzuzuziehen. Der streitige Sachverhalt ist schriftlich mitzuteilen. Kann die Meinungsverschiedenheit auch mit Hilfe der Tarifvertragsparteien nicht innerhalb einer Frist von 6 Wochen vom Zeitpunkt der Mitteilung an beigelegt werden, steht der Rechtsweg offen.</p> \n                    <p>9.2. Bei Meinungsverschiedenheiten zwischen Arbeitgeber und Arbeitnehmer über die Auslegung von Bestimmungen dieses Tarifvertrages gelten die obigen Vorschriften entsprechend. Sind die Tarifvertragsparteien übereinstimmend der Auffassung, dass die Meinungsverschiedenheit grundsätzliche Bedeutung hat oder kann darüber keine Übereinstimmung erzielt werden, so entscheidet das Schiedsgericht über die Meinungsverschiedenheit unter Ausschluss der Arbeitsgerichtsbarkeit. Im anderen Fall steht der Rechtsweg offen.</p>\n                    <p>Das Schiedsgericht setzt sich paritätisch aus je zwei, höchstens je drei Beisitzern zusammen. Die Arbeitgeberbeisitzer werden von dem iGZ, die Arbeitnehmerbeisitzer von der DGB-Tarifgemeinschaft von Fall zu Fall benannt.</p> \n                    <p>9.3. Das Schiedsgericht tritt innerhalb einer Frist von einem Monat ab der Feststellung gemäß § 9.2 Satz 2 zusammen.</p> \n                    <p>Kommt eine Mehrheitsentscheidung des Schiedsgerichts nicht zustande, so ist ein unparteiischer Vorsitzender hinzuzuziehen.</p> \n                    <p>Nach der Benennung des Vorsitzenden tritt das Schiedsgericht spätestens innerhalb einer Frist von einem Monat zusammen.</p> \n                    <p>Die Entscheidungen des Schiedsgerichts über die Auslegung dieses Tarifvertrages sind in Rechtsstreitigkeiten zwischen den tarifgebundenen Parteien bindend.</p>\n                '),
(17, 'igz', 'Manteltarifvertrag', 'limitation_period', '§10 Ausschlussfrist', '\n                    <p>Ansprüche aus dem Arbeitsverhältnis verfallen, wenn sie nicht innerhalb einer Ausschlussfrist von drei Monaten nach Fälligkeit gegenüber der anderen Vertragspartei schriftlich geltend gemacht werden.</p> \n                    <p>Lehnt die Gegenpartei die Ansprüche schriftlich ab, sind die Ansprüche innerhalb einer weiteren Ausschlussfrist von drei Monaten ab Zugang der schriftlichen Ablehnung gerichtlich geltend zu machen.</p> \n                    <p>Ansprüche, die nicht innerhalb dieser Fristen geltend gemacht werden, sind ausgeschlossen.</p> \n                '),
(18, 'igz', 'Manteltarifvertrag', 'due_date_charges', '§11 Fälligkeit von Entgeltansprüchen', '\n                    <p>Die Arbeitnehmer erhalten ein Monatsentgelt auf der Basis der individuellen regelmäßigen monatlichen Arbeitszeit oder der regelmäßigen Arbeitszeit pro Monat, das spätestens bis zum 15. Bankarbeitstag des auf den Abrechnungsmonat folgenden Monats fällig wird.</p> \n                    <p>Auf Verlangen des Arbeitnehmers wird mit rechtzeitiger Ankündigung am Ende eines jeweiligen Abrechnungsmonats ein Abschlag von bis zu 80 Prozent des zu erwartenden Netto-Einkommens ausgezahlt. Bereits gezahlte Abschläge werden angerechnet. Sofern das Beschäftigungsverhältnis nach dem 20. des betreffenden Abrechnungsmonats beginnt sowie im Austrittsmonat besteht kein Anspruch auf eine Abschlagszahlung. Diese Abschlagsregelung findet Anwendung ab dem 01. Juli 2014.</p> \n                '),
(19, 'igz', 'Manteltarifvertrag', 'strike_clause', '§12 Streikklausel', '\n                    <p>\n                        Arbeitnehmer werden im Umfang eines Streikaufrufs einer Mitgliedsgewerkschaft der DGB Tarifgemeinschaft Zeitarbeit nicht in Betrieben oder Betriebsteilen eingesetzt, die ordnungsgemäß bestreikt werden. \n                        Dies gilt auch für Arbeitnehmer, die bereits vor Beginn der Arbeitskampfmaßnahme in dem Betrieb eingesetzt wurden. Hiervon können die Parteien des Arbeitskampfes im Einzelfall abweichende Vereinbarungen treffen (z.B. Notdienstvereinbarungen). \n                        Die Regelung des § 11 Abs. 5 AÜG bleibt unberührt.\n                     </p>\n                '),
(20, 'igz', 'Manteltarifvertrag', 'inception_termination', '§13 Inkrafttreten und Kündigung', '\n                    <p>Dieser Vertrag tritt am 01. Januar 2004 für alle tarifgebundenen Mitglieder der Vertragsparteien in Kraft. Die Änderungen aus dem Verhandlungsergebnis vom 17. September 2013 treten am 01. November 2013 für alle tarifgebundenen Mitglieder der Vertragsparteien in Kraft.</p> \n                    <p>Dieser Vertrag kann unter Einhaltung einer Frist von sechs Monaten zum Monatsende, erstmals jedoch zum 31. Dezember 2016, gekündigt werden.</p>\n                '),
(21, 'igz', 'Manteltarifvertrag', 'severability_clause', '§14 Salvatorische Klausel', '\n                    <p>Sollten einzelne Bestimmungen dieses Vertrages, gleich aus welchem Grund, unwirksam sein oder werden, so soll hierdurch die Gültigkeit der übrigen Bestimmungen des Vertrages nicht berührt werden. Anstelle der unwirksamen Bestimmung soll jene angemessene Bestimmung treten, die dem am nächsten kommt, was die Parteien nach Sinn und Zweck des Vertrages gewollt haben.</p>\n                '),
(22, 'igz', 'Manteltarifvertrag', 'notes', 'Protokollnotizen', '\n                    <p>1. Der Tarifvertrag entfaltet keine Bindung für Fördermitglieder des iGZ.</p>\n                    <p>2. Der Begriff Beschäftigungsverhältnis ist gleichzusetzen mit dem Begriff des Arbeitsverhältnisses.</p>\n                    <p>3. Im gegenseitigen Einvernehmen können Ergänzungen jederzeit vorgenommen werden.</p>\n                    <p>4. Mit den Regelungen nach § 3.2.3, § 6 und § 7 wird das Mitbestimmungsrecht des Betriebsrats nicht eingeschränkt.</p>\n                    <p>5.Übergangsregelung aufgrund der Neueinführung dieses Tarifvertrages: Die Berechnung des ununterbrochenen Bestehens des Beschäftigungsverhältnisses erfolgt ab Stichtag 01. Januar 2002.</p>\n                    <p>6. Bei der Berechnung der Dauer des ununterbrochenen Bestehens des Arbeitsverhältnisses werden Zeiten, in denen das Arbeitsverhältnis ruht, nicht mitgerechnet. Ausgenommen sind arbeitsbedingte Erkrankungen und Arbeitsunfälle bis zu einem Zeitraum von 12 Monaten nach Ablauf der</p>\n                    <p>Entgeltfortzahlung. Die Jahressonderzahlungen gemäß § 8 werden auch bei ruhendem Arbeitsverhältnis anteilig gezahlt für die Zeiten, in denen ein sozialversicherungspflichtiges Arbeitsentgelt erzielt wurde. Satz 2 gilt dementsprechend.</p>\n                    <p>7. Die Zuschläge für Arbeit an Sonn- und Feiertagen, soweit diese zur Regelarbeitszeit zählen, richten sich nach der Zuschlagsregelung im Entleihbetrieb, siehe auch § 3.1.4.</p>\n                    <p>8. Auf Wunsch des Arbeitnehmers kann mit Zustimmung des Arbeitgebers eine individuelle Regelung über die Auszahlung von Arbeitszeitguthaben bis höchstens 20 Stunden pro Monat vereinbart werden.</p>\n                ');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'Bonn'),
(2, 'Köln'),
(3, 'Düsseldorf');

-- --------------------------------------------------------

--
-- Table structure for table `mail_log`
--

CREATE TABLE `mail_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `sent_id` int(11) NOT NULL,
  `sent_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `information` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(231, '2014_10_12_000000_create_users_table', 1),
(232, '2014_10_12_100000_create_password_resets_table', 1),
(233, '2017_08_03_195131_create_orders_table', 1),
(234, '2017_08_03_195602_create_employees_table', 1),
(235, '2017_08_03_195822_create_employee_order_table', 1),
(236, '2017_08_09_214953_create_clients_table', 1),
(237, '2017_08_18_230855_create_contacts_table', 1),
(238, '2017_08_20_171017_create_contact_order_table', 1),
(239, '2017_08_21_222947_create_timetrackings_table', 1),
(240, '2017_08_21_231158_create_notes_table', 1),
(241, '2017_08_22_154959_create_invoices_table', 1),
(242, '2017_08_22_163008_create_invoice_items_table', 1),
(243, '2017_08_23_130027_create_invoice_data_table', 1),
(244, '2017_08_23_155309_create_charge_rates_table', 1),
(245, '2017_08_24_121956_create_contact_invoice_table', 1),
(246, '2017_09_01_235028_create_locations_table', 1),
(247, '2017_09_02_101350_create_roles_table', 1),
(248, '2017_09_04_112843_create_employee_role_table', 1),
(249, '2017_09_06_115853_create_time_off_table', 1),
(250, '2017_09_06_124544_create_wages_table', 1),
(251, '2017_09_06_152704_create_templates_table', 1),
(252, '2017_09_07_094541_create_extra_business_table', 1),
(253, '2017_09_07_104256_create_payroll_modifications_table', 1),
(254, '2017_09_11_123349_create_textblocks_table', 1),
(255, '2017_10_04_151202_create_blacklist_table', 1),
(256, '2017_10_27_123030_create_time_off_request', 1),
(257, '2017_11_02_125146_create_countries_table', 1),
(258, '2017_11_02_141132_create_user_roles', 1),
(259, '2017_11_02_141426_create_user_role', 1),
(260, '2017_11_28_141659_create_documents_table', 1),
(261, '2017_11_30_111652_create_mail_log_table', 1),
(262, '2017_12_18_124850_create_order_calculation', 1),
(263, '2017_12_21_173316_create_user_activations_table', 1),
(264, '2018_01_05_101136_create_notifications_table', 1),
(265, '2018_01_12_113343_create_working_time_accounts_table', 1),
(266, '2018_01_25_161628_create_legal_salaries_table', 1),
(267, '2018_01_29_143934_create_legal_texts_table', 1),
(268, '2018_01_30_135752_create_working_hours_table', 1),
(269, '2019_08_31_052611_create_portal_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `loggable_id` int(10) UNSIGNED NOT NULL,
  `loggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `information` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `editor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `work_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_point` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_time` time NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `important_change` json DEFAULT NULL,
  `staff_planned` int(11) NOT NULL DEFAULT '0',
  `staff_required` int(11) NOT NULL,
  `status` enum('active','requested','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `time_recorded` tinyint(1) NOT NULL DEFAULT '0',
  `billed` tinyint(1) NOT NULL DEFAULT '0',
  `sent` datetime DEFAULT NULL,
  `total_min` int(11) NOT NULL DEFAULT '0',
  `total_income` double(8,2) NOT NULL DEFAULT '0.00',
  `total_wage` double(8,2) NOT NULL DEFAULT '0.00',
  `total_cost` double(8,2) NOT NULL DEFAULT '0.00',
  `other_costs` double(8,2) NOT NULL DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `edited_by` int(11) DEFAULT NULL,
  `requested_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_calculation`
--

CREATE TABLE `order_calculation` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `hours` double(8,2) NOT NULL,
  `other_costs` double(8,2) NOT NULL DEFAULT '0.00',
  `total_income` double(8,2) NOT NULL DEFAULT '0.00',
  `total_costs` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll_modifications`
--

CREATE TABLE `payroll_modifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `information` text COLLATE utf8mb4_unicode_ci,
  `editor` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portal_settings`
--

CREATE TABLE `portal_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `expired_at` datetime DEFAULT NULL,
  `last_renew` datetime DEFAULT NULL,
  `status` enum('trail','active','deactive','past_due','suspend') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_setup` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portal_settings`
--

INSERT INTO `portal_settings` (`id`, `expired_at`, `last_renew`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'deactive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortcut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `shortcut`) VALUES
(1, 'Teamleiter', 'TL'),
(2, 'Cashkellner', 'CK'),
(3, 'Kellner', 'KL'),
(4, 'Service', 'SR');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `type`, `name`, `title`, `text`) VALUES
(1, 'basic', 'termination', 'Kündigung', '\n                    <p><strong>Betreff:</strong> Ordentliche Kündigung des Arbeitsverhältnisses</p>\n\n                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>\n            \n                    <p>Hiermit kündigen wir Ihnen den am {DATE_OF_CONTRACT} abgeschlossenen Arbeitsvertrag. Vorsorglich sprechen wir auf diesem Wege zusätzlich eine ordentliche Kündigung zum {NOTICE_TO} aus.</p>\n            \n                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>\n            \n                    <p>Mit freundlichen Grüßen</p>\n            \n                    <p>GF.: {SIGNATURE}</p>\n                '),
(2, 'basic', 'termination_without_notice', 'Fristlose Kündigung', '\n                    <p><strong>Betreff:</strong> Fristlose Kündigung des Arbeitsverhältnisses</p>\n\n                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>\n            \n                    <p>Hiermit kündigen wir Ihnen den am {DATE_OF_CONTRACT} abgeschlossenen Arbeitsvertrag fristlos.</p>\n            \n                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>\n            \n                    <p>Mit freundlichen Grüßen</p>\n            \n                    <p>GF.: {SIGNATURE}</p>\n                '),
(3, 'basic', 'termination_within_probation', 'Kündigung in der Probezeit', '\n                    <p><strong>Betreff:</strong> Kündigung innerhalb  der Probezeit</p>\n\n                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>\n                    \n                    <p>Hiermit kündigen wir Ihnen den am {DATE_OF_CONTRACT} abgeschlossenen Arbeitsvertrag fristlos.</p>\n                    \n                    <p>Vorsorglich sprechen wir auf diesem Wege zusätzlich eine Kündigung in der Probezeit zum {NOTICE_TO} aus.</p>\n                        \n                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>\n            \n                    <p>Wir wünschen Ihnen für Ihren weiteren privaten und beruflichen Lebensweg alles Gute.</p>\n            \n                    <p>Mit freundlichen Grüßen</p>\n            \n                    <p>GF.: {SIGNATURE}</p>\n                '),
(4, 'contract', 'contract_temporary', 'Vertrag - Geringfügige Beschäftigung', '\n                    <div style=\"text-align: center;\"><h2>Arbeitsvertrag für eine geringfügige Beschäftigung</h2></div>\n            \n                    <div style=\"text-align: center;\">\n                        Zwischen <br><br>\n            \n                        <strong>Servite GmbH</strong><br>\n                        <strong>Hohenzollernring 57</strong><br>\n                        <strong>50674 Köln</strong><br><br>\n            \n                        (im folgenden Arbeitgeber genannt)<br>\n            \n                        <br>\n            \n                        und <br><br>\n                    </div>\n            \n                    <div style=\"text-align: center;\">\n                        <strong>{LAST_NAME}, {FIRST_NAME}</strong><br>\n                        <strong>{STREET}, {POSTAL_CODE} {CITY}</strong><br>\n                        <strong>{MOBILE}</strong><br>\n                        <strong>{EMAIL}</strong><br><br>\n            \n                        (im folgenden Mitarbeiter genannt)<br>\n                    </div>\n            \n                    <br>\n            \n                    <div class=\"center\">§ 1 Erlaubnis</div>\n                    <p>\n                        Der Arbeitgeber überlässt als Verleiher Dritten (Entleihern) Arbeitnehmer (Leiharbeitnehmer) im Rahmen\n                        ihrer wirtschaftlichen Tätigkeit zur Arbeitsleistung . Der Arbeitnehmer wird an wechselnden Einsatzstellen in\n                        Kundenbetrieben und bei wechselnden Kundenbetrieben eingesetzt.\n                        Die entsprechende Erlaubnis nach § 1 des Gesetzes zur Regelung der Arbeitnehmerüberlassung\n                        (Arbeitnehmerüberlassungsgesetz - AÜG) wurde dem Arbeitgeber am 14.01.2005 von der Bundesagentur\n                        für Arbeit in Düsseldorf erteilt.\n                    </p>\n            \n                    <div class=\"center\">§ 2 Beginn und Inhalt des Arbeitsverhältnisses</div>\n                    <p>\n                        2.1 Der Arbeitnehmer ist im Rahmen dieses Vertrages bei dem Arbeitgeber geringfügig gemäß §8 Abs. 1 Nr. 1 SGB IV angestellt. Die Überlassung an den\n                        Entleiher erfolgt vorübergehend. Eine Höchstüberlassungsdauer besteht dabei nicht.\n                    </p>\n                    <p>\n                        2.2 Das Arbeitsverhältnis beginnt am {ENTRY_DATE} und gilt auf unbestimmte Zeit geschlossen.\n                    </p>\n                    <p>\n                        2.3 Bei unentschuldigtem Fehlen am ersten Arbeitstag gilt dieser Vertrag als nicht zustande gekommen. In\n                        diesem Fall haftet der Arbeitnehmer für einen nachweislich dadurch entstandenen Schaden.\n                    </p>\n            \n                    <div class=\"center\">§ 3 Probezeit und Beendigung des Arbeitsverhältnisses</div>\n                    <p>\n                        3.1 Es ist eine Probezeit von 6 Monaten vereinbart. Entsprechend des Manteltarifvertrages des\n                        Interessenverbandes Deutscher Zeitarbeitsunternehmen e.V., § 2.2, kann während der ersten vier Wochen\n                        des Arbeitsverhältnisses mit einer Kündigungsfrist von zwei Arbeitstagen gekündigt werden. Von der fünf ten\n                        Woche bis zum Ablauf des zweiten Monats beträgt die Kündigungsfrist eine Woche, vom dritten bis zum\n                        sechsten Monat zwei Wochen. Nach Beendigung der Probe zeit gelten die gesetzlichen Kündigungsfristen\n                        entsprechend § 622 BGB.\n                    </p>\n            \n                    <p>\n                        3.2 Das Recht zur außerordentlichen Kündigung bleibt hiervon unberührt.\n                    </p>\n            \n                    <p>\n                        3.3 Die Kündigung bedarf der Schriftform.\n                    </p>\n            \n                    <div class=\"center\">§ 4 Tätigkeiten und Pflichten des Arbeitnehmers</div>\n                    <p>\n                        4.1 Der Arbeitnehmer wird entsprechend der Tätigkeit im Einsatzbetrieb als Servicemitarbeiter\n                        (Servicehilfskraft) eingestellt.\n                    </p>\n                    <p>\n                        4.2 Diese Tätigkeit umfasst folgende Aufgaben (nicht abschließend): Servieren von Speisen und Getränken,\n                        Vorbereiten der Serviceperioden, allgemeine Aufräum - und Reinigungsarbeiten.\n                    </p>\n                    <p>\n                        4.3 Der Arbeitnehmer wird an verschiedenen Einsatzort en beschäftigt. Der Arbeitgeber kann den\n                        Arbeitnehmer jederzeit von seinem Einsatzort abberu fen und anderweitig einsetzen. Während des Einsatzes\n                        beim Kunden des Arbeitgebers unterliegt der Arbeitn ehmer dessen Weisungsrecht im Rahmen des\n                        Vertrages. Änderungen der Einsatzdauer, Arbeitszeit , Art der Tätigkeit und Vergütung können nur zwische n\n                        dem Arbeitnehmer und dem Arbeitgeber vereinbart werden.\n                    </p>\n            \n                    <div class=\"center\">§ 5 Sonstige Pflichten des Arbeitnehmers</div>\n                    <p>\n                        5.1 Der Arbeitnehmer verpflichtet sich, sämtliche notwendigen Einstellungsunterlagen innerhalb von zwei\n                        Wochen nach Abschluss des Arbeitsvertrages vorzulegen.\n                    </p>\n                    <p>\n                        5.2 Die Einstellung erfolgt unter der Voraussetzung fachlicher, persönlicher und gesundheitlicher Eignung.\n                        Der Arbeitgeber ist berechtigt, hierfür notwendige Nachweise, insbesondere ein Führungs- und\n                        Gesundheitszeugnis vom Arbeitnehmer zu fordern. Sofern entsprechende Nachweise erst nach\n                        Arbeitsaufnahme vorgelegt werden können und dadurch Gründe bekannt werden, die dem Abschluss des\n                        Arbeitsvertrages entgegenstehen, gilt der Vertrag als von Anfang an nicht geschlossen. Zur Abwicklung\n                        gelten die Grundsätze des fehlerhaften Arbeitsvertrages.\n                    </p>\n                    <p>\n                        5.3 Die bei einem Kunden geleisteten Arbeitsstunden (Dienstbeginn, Dienstende, Pausen) bestätigt der\n                        Arbeitnehmer beim Kunden vor Ort mit seiner Unterschrift in der jeweiligen Anwesenheitsliste.\n                    </p>\n                    <p>\n                        5.4 Der Arbeitnehmer verpflichtet sich, über alle Betriebs- und Geschäftsgeheimnisse, sowohl während der\n                        Dauer des Arbeitsverhältnisses als auch nach seiner Beendigung Stillschweigen zu bewahren. Die\n                        Geheimhaltungspflicht erstreckt sich nicht auf solche Kenntnisse, die jedermann zugänglich sind oder d eren\n                        Weitergabe für den Arbeitgeber ersichtlich ohne Nachteile für ist. Im Zweifelsfalle sind jedoch technische,\n                        kaufmännische und persönliche Vorgänge und Verhältnisse, die dem Arbeitnehmer im Zusammenhang mit\n                        seiner Tätigkeit bekannt werden, als Unternehmensgehe imnisse zu behandeln. In solchen Fällen ist der\n                        Arbeitnehmer vor der Offenlegung gegenüber Dritten v erpflichtet, eine Weisung der Geschäftsleitung\n                        einzuholen, ob eine bestimmte Tatsache vertraulich zu behandeln ist oder nicht. Die Schweigepflicht erst\n                        reckt sich auch auf die Entleiher, bei denen der Arbeitnehmer eingesetzt ist.\n                    </p>\n                    <p>\n                        5.5 Für jeden Verstoß gegen die in § 5.4 vereinbarte Verschwiegenheitserklärung ist eine Vertragsstrafe in\n                        Höhe eines Bruttomonatsgehaltes vereinbart. Dem Arbei tnehmer bleibt nachzuweisen, dass der Arbeitgeber\n                        durch die Vertragsverletzung einen geringeren Schaden erlitten hat.\n                    </p>\n            \n                    <div class=\"center\">§ 6 Arbeitszeit</div>\n                    <p>\n                        6.1 Die individuelle, regelmäßige monatliche Arbeitszeit beträgt {CONTRACTUAL_WORKING_HOURS} Stunden gemäß § 12 Teilzeit-\n                        und Befristungsgesetz. Sollte der Arbeitnehmer nicht für die genannte Dauer der vereinbarten Arbeitszeit\n                        verliehen werden können, wird für die nicht geleisteten Stunden der vereinbarte Tariflohn gezahlt. Beträgt\n                        die Arbeitszeit des Arbeitnehmers aus von ihm zu vertretenden Gründen weniger als die vereinbarte\n                        Stundenzahl, entfällt für diese Zeiträume der Entgeltanspruch.\n                    </p>\n                    <p>\n                        6.2 Der Umfang der wöchentlichen und täglichen Arbeitsleistung des Arbeitnehmers richtet sich nach dem\n                        jeweiligen Arbeitsanfall. Die Arbeitsleistung kann vom Arbeitgeber individuell abgerufen werden. Zwischen\n                        dem Abruf der Arbeitsleistung und dem Arbeitsantritt müssen mindestens vier Tage liegen.\n                    </p>\n                    <p>\n                        6.3 Es ist die Wege-Zeit zu vergüten, die die Dauer von 2,50 Stunden für die einfache Wegstrecke von der\n                        Wohnung zu der Tätigkeitsstätte auf dem zeitlich günstigsten Weg überschreitet, sofern er diese Wege-Zeit\n                        tatsächlich aufgewendet hat.\n                    </p>\n                    <p>\n                        6.4 Der Arbeitgeber richtet für den Arbeitnehmer gemäß § 3.2 Manteltarifvertrag iGZ ein Arbeitszeitkonto mit\n                        den dort aufgeführten Abwicklungsmodalitäten ein.\n                    </p>\n            \n                    <div class=\"center\">§ 6 Arbeitszeit</div>\n                    <p>\n                        Der Arbeitnehmer verpflichtet sich gemäß § 2a Schwarzarbeitsbekämpfungsgesetz seinen\n                        Personalausweis oder Pass oder Pass- oder Ausweisersatz sowie die Papiere der Aufenthalts- und\n                        Arbeitserlaubnis stets mitzuführen und bei Kontrollen den Behörden auf Verlangen vorzulegen.\n                    </p>\n            \n                    <div class=\"center\">§ 8 Vergütung und Fälligkeit</div>\n                    <p>\n                        8.1 Der Arbeitnehmer wird im Rahmen einer geringfügigen Beschäftigung gemäß § 8 Abs. 1 Nr. 1 SGB IV eingesetzt. \n                        Der Arbeitnehmer kann sich jedoch durch schriftlichen Antrag beim Arbeitgeber von der Rentenversicherungspflicht befreien lassen. \n                        In diesem Fall gilt die Befreiung von der Rentenversicherungspflicht für die gesamte Dauer des Beschäftigungsverhältnisses.\n                    </p>\n                    <p>\n                        8.2 Gemäß den in § 2 Absatz 1 EGRTV festgelegten Tätigkeitsbezeichnungen wird der Arbeitnehmer in die\n                        Entgeltgruppe 1 des § 3 EGRTV eingruppiert. Der Arbeitnehmer erhält {WAGE} €/Std.\n                        - ein tarifliches Entgelt, dessen Höhe sich nach den Bestimmungen des § 2 EGRTV i. V. m. §§ 4, 5 EGRTV\n                        bemisst.\n                        - eine übertarifliche Zulage pro geleisteter Arbeitsstunde in Höhe von {BONUS} €/Std.\n                        Der Bruttostundenlohn beträgt {GROSS} €/Std.\n                    </p>\n                    <p>\n                        8.3 Die Vergütung ist jeweils zum 15. Bankarbeitstag des Folgemonats auf ein vom Mitarbeiter\n                        anzugebendes Konto zu überweisen. Soweit der Arbeitnehmer seiner Verpflichtung nach § 4.3 nicht oder\n                        nicht rechtzeitig nachkommt, kann sich die Abrechnung und die Auszahlung verzögern. Diese Verzögerung\n                        geht nicht zu Lasten des Arbeitgebers.\n                    </p>\n                    <p>\n                        8.4 Die Höhe etwaiger Zuschläge, die in Abhängigkeit von der Dauer oder der Lage der Arbeitszeit geleistet\n                        werden, richtet sich nach der Zuschlagsreglung des Entleihers und ist im Tarifvertrag § 4 Ziffer 4.5.4\n                        geregelt.\n                    </p>\n                    <p>\n                        8.5 Der Mitarbeiter verpflichtet sich, Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene\n                        Bereicherung zurückzuzahlen.\n                    </p>\n                    <p>\n                        8.6 Der Mitarbeiter darf seine Vergütungsansprüche weder verpfänden noch abtreten. Der Arbeitgeber\n                        behält sich vor, nachträglich vertragswidrig vorgenommene Abtretungen oder Verpfändungen zu\n                        genehmigen. Die Kosten, die dem Arbeitgeber durch die Bearbeitung von Verpfändungen und Abtretungen\n                        der Vergütungsansprüche des Mitarbeiters entstehen, trägt der Mitarbeiter. Diese Kosten werden\n                        pauschaliert mit 8,00 € pro Pfändung, Abtretung und Verpfändung sowie ggf. zusätzlich 4,- € für jedes\n                        Schreiben sowie 1 € pro Überweisung. Bei Nachweis höherer tatsächlicher Kosten ist der Arbeitgeber\n                        berechtigt, diese in Ansatz zu bringen.\n                    </p>\n            \n            \n                    <div class=\"center\">§ 9 Urlaub</div>\n                    <p>\n                        9.1 Je Kalenderjahr hat der Arbeitnehmer Anspruch auf bezahlten Erholungsurlaub, der ggf. anteilig\n                        gewährt wird. Die Anzahl der Urlaubstage richtet sich nach § 6 des Manteltarifvertrages. Der Zeitpunkt des\n                        Urlaubsantrittes erfolgt im Einvernehmen mit dem Arbeitgeber.\n                    </p>\n                    <p>\n                        9.2 Das Urlaubsentgelt ergibt sich aus den tariflichen Vereinbarungen und errechnet sich aus dem\n                        Tarifentgelt auf der Basis der regelmäßigen monatlichen Arbeitszeit, wobei Zuschläge für die besondere\n                        Lage der Arbeitszeit bei der Berechnung zu berücksichtigen sind.\n                    </p>\n                    <p>\n                        9.3 Nach dem 6. Monat des ununterbrochenen Bestehens des Beschäftigungsverhältnisses hat der\n                        Arbeitnehmer Anspruch auf Jahressonderzahlungen in Form von zusätzlichem Urlaubs- und\n                        Weihnachtsgeld. Die zu gewährende Jahressonderzahlung richtet sich nach § 8 MTV.\n                    </p>\n            \n                    <div class=\"center\">§ 10 Arbeitsverhinderung</div>\n                    <p>\n                        10.1 Bei krankheitsbedingter Arbeitsunfähigkeit ist der Arbeitnehmer verpflichtet, den Arbeitgeber\n                        unverzüglich zu unterrichten. Dies gilt auch bei sonstiger Arbeitsverhinderung. Darüber hinaus hat der\n                        Mitarbeiter bei krankheitsbedingter Arbeitsverhinderung spätestens nach Ablauf des 3. Kalendertages nach\n                        Beginn der Arbeitsunfähigkeit dem Arbeitgeber eine ärztliche Arbeitsunfähigkeitsbescheinigung\n                        einzureichen. Dauert die Arbeitsunfähigkeit länger als in der Bescheinigung angegeben an, so ist der\n                        Arbeitnehmer verpflichtet, eine neue ärztliche Arbeitsunfähigkeitsbescheinigung einzureichen. Gleichzeitig\n                        hat der den Arbeitgeber darüber unverzüglich zu unterrichten.\n                    </p>\n            \n                    <p>\n                        10.2 Die Pflicht, den Arbeitgeber unverzüglich über Arbeitsverhinderung und die Gründe zu unterrichten, gilt\n                        auch bei sonstiger Arbeitsverhinderung.\n                    </p>\n            \n                    <div class=\"center\">§ 11 Nebentätigkeiten</div>\n                    <p>\n                        11.1 Sofern er sich bei der vorliegenden Tätigkeit um eine Nebentätigkeit handelt, hat der Arbeitnehmer den\n                        Arbeitgeber bei Vertragsschluss über die Haupttätigkeit zu unterrichten.\n                    </p>\n                    <p>\n                        11.2 Jede Nebentätigkeit, gleichgültig ob sie entgeltlich oder unentgeltlich ausgeübt wird, bedarf der\n                        vorherigen Zustimmung des Arbeitgebers. Die Zustimmung ist zu erteilen, wenn die Nebentätigkeit die\n                        Wahrnehmung der dienstlichen Aufgaben zeitlich nicht oder allenfalls unwesentlich behindert und sonstige\n                        berechtigte Interessen des Arbeitgebers nicht beeinträchtigt werden.\n                    </p>\n                    <p>\n                        11.3 Der Arbeitgeber hat die Entscheidung über den Antrag des Arbeitnehmers auf Zustimmung zur\n                        Nebentätigkeit innerhalb von vier Wochen nach Eingang des Antrags zu treffen. Wird innerhalb dieser Frist\n                        eine Entscheidung nicht gefällt, gilt die Zustimmung als erteilt.\n                    </p>\n            \n                    <div class=\"center\">§ 12 Unfallverhütung/Arbeitsschutz</div>\n                    <p>\n                        Der Arbeitnehmer erklärt, dass er die für den jeweiligen Arbeitsplatz geltenden Unfallverhütungsvorschriften\n                        beachten und verfolgen wird. Der Arbeitgeber wird ihm die jeweils geltenden Unfallverhütungsvorschriften\n                        vor jedem Einsatz zur Kenntnis geben und dafür Sorge tragen, dass er vor dem ersten Tätigwerden am\n                        Arbeitsplatz entsprechend eingewiesen wird. Der Arbeitgeber wird dafür Sorge tragen, dass der\n                        Arbeitnehmer die für die jeweilige Arbeit vorgeschriebene, erforderliche Schutzausrüstung kostenlos erhält.\n                        Bei Betriebs- und Wegeunfällen wird der Arbeitnehmer beim Arbeitgeber unverzüglich eine Unfallmeldung\n                        erstatten.\n                    </p>\n            \n                    <div class=\"center\">§ 14 Vertragsstrafe</div>\n                    <div>14.1 Der Arbeitnehmer hat eine Vertragsstrafe an den Arbeitgeber zu zahlen, wenn\n                        <ul>\n                            <li>er die Arbeit im laufenden Arbeitsverhältnis rechtswidrig nicht oder wiederholt verspätet\n                                aufnimmt,\n                            </li>\n                            <li>er das Arbeitsverhältnis rechtswidrig ohne Einhaltung der maßgeblichen Kündigungsfrist auslöst,</li>\n                            <li>er vorrübergehend die Arbeit rechtswidrig verweigert oder Arbeitsbummelei begeht,</li>\n                            <li>er wiederholt Tätigkeitsnachweise oder Arbeitsunfähigkeitsbescheinigungen nicht rechtzeitig\n                                einreicht,\n                            </li>\n                            <li>er Straftaten oder Ordnungswidrigkeiten zum Nachteil des Arbeitgebers, des Entleihers oder zum\n                                Nachteil\n                                von anderen Arbeitnehmern begeht,\n                            </li>\n                            <li>er eigenmächtig seinen Urlaub antritt,</li>\n                            <li>er mit Krankheit droht,</li>\n                            <li>er wiederholt Nachweis- oder Meldepflichten schuldhaft nicht nachkommt oder unentschuldigt fehlt\n                                oder\n                                schuldhaft nicht erreichbar ist,\n                            </li>\n                            <li>er unter Alkohol- oder Drogeneinfluss am Arbeitsplatz angetroffen wird,</li>\n                            <li>er einer nicht genehmigungsfähigen Nebentätigkeit nachgeht,</li>\n                            <li>er schuldhaft eine unverwertbare Arbeitsleistung erbringt.</li>\n                        </ul>\n                    </div>\n                    <p>\n                        14.2 Die Vertragsstrafe wird nur fällig, wenn der Arbeitnehmer grob fahrlässig oder vorsätzlich gehandelt\n                        hat.\n                    </p>\n                    <p>\n                        14.3 Als Vertragsstrafe ist für die Fälle der rechtswidrigen Auflösung des Arbeitsverhältnisses ohne\n                        Einhaltung der maßgeblichen Kündigungsfrist durch den Arbeitnehmer und der Veranlassung des\n                        Arbeitgebers zu einer fristlosen Kündigung wegen schwerwiegender Vertragsverstöße des Arbeitnehmers\n                        eine Vertragsstrafe des ansonsten in der maßgeblichen Kündigungsfrist enthaltenen Arbeitsentgeltes\n                    </p>\n            \n                    <div class=\"center\">§ 15 Datenschutz</div>\n                    <p>\n                        Der Arbeitnehmer erklärt sein Einverständnis damit, dass seine persönlichen Daten, soweit sie dem\n                        Arbeitgeber bekannt sind, in EDV-Anlagen beim Arbeitgeber oder einem Beauftragten gespeichert und\n                        verarbeitet werden dürfen.\n                    </p>\n            \n                    <div class=\"center\">§ 16 Sonstiges</div>\n                    <p>\n                        16.1 Änderungen des Vertrages und Nebenabreden bedürfen zu ihrer Wirksamkeit der Schriftform.\n                    </p>\n                    <p>\n                        16.2   Der   Arbeitnehmer   bestätigt   durch   seine   Unterschrift,   vom   Arbeitgeber   das   Merkblatt   der\n                        Bundesagentur für Arbeit über den wesentlichen Inhalt des Arbeitnehmerüberlassungsgesetzes und eine\n                        Kurzfassung der Unfallverhütungsvorschriften erhalten zu haben.\n                    </p>\n                    <p>\n                        16.3   Der   bei   der   Einstellung   ausgefüllte   Personalfragebogen   ist   Bestandteil   dieses   Vertrages.   Im\n                        Fragebogen gemachte, unrichtige Angaben berechtigen den Arbeitgeber zur fristlosen Kündigung.\n                    </p>\n                    <p>\n                        16.4 Dieser Vertrag wird in 2 Ausführungen erstellt und von beiden Vertragsparteien unterschrieben. Der\n                        Arbeitnehmer bestätigt, eine gleichlautende Ausfertigung erhalten zu haben.\n                    </p>\n                    <p>\n                        16.5 Zur Aufrechterhaltung ungekürzter Ansprüche auf Arbeitslosengeld ist der Arbeitnehmer verpflichtet,\n                        sich 3 Monate vor Ablauf des Vertragsverhältnisses persönlich beim Arbeitsamt arbeitssuchend zu melden.\n                        Weiterhin ist er verpflichtet, aktiv nach einer Beschäftigung zu suchen.\n                    </p>\n                    <p>\n                        16.6 Gerichtsstand ist Köln\n                    </p>\n                    <p>\n                        16.7   Sollte   eine   Bestimmung   dieser   Vereinbarung   unwirksam   sein,   bleibt   die   Wirksamkeit   der   übrigen\n                        Bestimmungen hiervon unberührt. Die Parteien verpflichten sich, die unwirksame Bestimmung durch eine -\n                        dieser in Interessenslage und Bedeutung möglichst entsprechende  -  wirksame Bestimmung zu ersetzen.\n                    </p>\n                ');
INSERT INTO `templates` (`id`, `type`, `name`, `title`, `text`) VALUES
(5, 'contract', 'contract_parttime', 'Vertrag - Teilzeit', '\n                    \n                       <div class=\"center\"><h2>Arbeitsvertrag für eine Teilzeit-Beschäftigung</h2></div>\n            \n                    <div style=\"text-align: center;\">\n                        Zwischen <br><br>\n            \n                        <strong>Servite GmbH</strong><br>\n                        <strong>Hohenzollernring 57</strong><br>\n                        <strong>50674 Köln</strong><br><br>\n            \n                        (im folgenden Arbeitgeber genannt)<br>\n            \n                        <br>\n            \n                        und <br><br>\n                    </div>\n            \n                    <div style=\"text-align: center;\">\n                        <strong>{LAST_NAME}, {FIRST_NAME}</strong><br>\n                        <strong>{STREET}, {POSTAL_CODE} {CITY}</strong><br>\n                        <strong>{MOBILE}</strong><br>\n                        <strong>{EMAIL}</strong><br><br>\n            \n                        (im folgenden Mitarbeiter genannt)<br>\n                    </div>\n            \n                    <br>\n            \n                    <div class=\"center\">§ 1 Erlaubnis</div>\n                    <p>\n                        Der Arbeitgeber überlässt als Verleiher Dritten (Entleihern) Arbeitnehmer (Leiharbeitnehmer) im Rahmen\n                        ihrer wirtschaftlichen Tätigkeit zur Arbeitsleistung . Der Arbeitnehmer wird an wechselnden Einsatzstellen in\n                        Kundenbetrieben und bei wechselnden Kundenbetrieben eingesetzt.\n                        Die entsprechende Erlaubnis nach § 1 des Gesetzes zur Regelung der Arbeitnehmerüberlassung\n                        (Arbeitnehmerüberlassungsgesetz - AÜG) wurde dem Arbeitgeber am 14.01.2005 von der Bundesagentur\n                        für Arbeit in Düsseldorf erteilt.\n                    </p>\n            \n                    <div class=\"center\">§ 2 Beginn und Inhalt des Arbeitsverhältnisses</div>\n                    <p>\n                        2.1 Der Arbeitnehmer ist im Rahmen dieses Vertrages bei dem Arbeitgeber angestellt. Die Überlassung an den\n                        Entleiher erfolgt vorübergehend. Eine Höchstüberlassungsdauer besteht dabei nicht.\n                    </p>\n                    <p>\n                        2.2 Das Arbeitsverhältnis beginnt am {ENTRY_DATE} und gilt auf unbestimmte Zeit geschlossen.\n                    </p>\n                    <p>\n                        2.3 Bei unentschuldigtem Fehlen am ersten Arbeitstag gilt dieser Vertrag als nicht zustande gekommen. In\n                        diesem Fall haftet der Arbeitnehmer für einen nachweislich dadurch entstandenen Schaden.\n                    </p>\n            \n                    <div class=\"center\">§ 3 Probezeit und Beendigung des Arbeitsverhältnisses</div>\n                    <p>\n                        3.1 Es ist eine Probezeit von 6 Monaten vereinbart. Entsprechend des Manteltarifvertrages des\n                        Interessenverbandes Deutscher Zeitarbeitsunternehmen e.V., § 2.2, kann während der ersten vier Wochen\n                        des Arbeitsverhältnisses mit einer Kündigungsfrist von zwei Arbeitstagen gekündigt werden. Von der fünf ten\n                        Woche bis zum Ablauf des zweiten Monats beträgt die Kündigungsfrist eine Woche, vom dritten bis zum\n                        sechsten Monat zwei Wochen. Nach Beendigung der Probe zeit gelten die gesetzlichen Kündigungsfristen\n                        entsprechend § 622 BGB.\n                    </p>\n            \n                    <p>\n                        3.2 Das Recht zur außerordentlichen Kündigung bleibt hiervon unberührt.\n                    </p>\n            \n                    <p>\n                        3.3 Die Kündigung bedarf der Schriftform.\n                    </p>\n            \n                    <div class=\"center\">§ 4 Tätigkeiten und Pflichten des Arbeitnehmers</div>\n                    <p>\n                        4.1 Der Arbeitnehmer wird entsprechend der Tätigkeit im Einsatzbetrieb als Servicemitarbeiter\n                        (Servicehilfskraft) eingestellt.\n                    </p>\n                    <p>\n                        4.2 Diese Tätigkeit umfasst folgende Aufgaben (nicht abschließend): Servieren von Speisen und Getränken,\n                        Vorbereiten der Serviceperioden, allgemeine Aufräum - und Reinigungsarbeiten.\n                    </p>\n                    <p>\n                        4.3 Der Arbeitnehmer wird an verschiedenen Einsatzort en beschäftigt. Der Arbeitgeber kann den\n                        Arbeitnehmer jederzeit von seinem Einsatzort abberu fen und anderweitig einsetzen. Während des Einsatzes\n                        beim Kunden des Arbeitgebers unterliegt der Arbeitn ehmer dessen Weisungsrecht im Rahmen des\n                        Vertrages. Änderungen der Einsatzdauer, Arbeitszeit , Art der Tätigkeit und Vergütung können nur zwische n\n                        dem Arbeitnehmer und dem Arbeitgeber vereinbart werden.\n                    </p>\n            \n                    <div class=\"center\">§ 5 Sonstige Pflichten des Arbeitnehmers</div>\n                    <p>\n                        5.1 Der Arbeitnehmer verpflichtet sich, sämtliche notwendigen Einstellungsunterlagen innerhalb von zwei\n                        Wochen nach Abschluss des Arbeitsvertrages vorzulegen.\n                    </p>\n                    <p>\n                        5.2 Die Einstellung erfolgt unter der Voraussetzung fachlicher, persönlicher und gesundheitlicher Eignung.\n                        Der Arbeitgeber ist berechtigt, hierfür notwendige Nachweise, insbesondere ein Führungs- und\n                        Gesundheitszeugnis vom Arbeitnehmer zu fordern. Sofern entsprechende Nachweise erst nach\n                        Arbeitsaufnahme vorgelegt werden können und dadurch Gründe bekannt werden, die dem Abschluss des\n                        Arbeitsvertrages entgegenstehen, gilt der Vertrag als von Anfang an nicht geschlossen. Zur Abwicklung\n                        gelten die Grundsätze des fehlerhaften Arbeitsvertrages.\n                    </p>\n                    <p>\n                        5.3 Die bei einem Kunden geleisteten Arbeitsstunden (Dienstbeginn, Dienstende, Pausen) bestätigt der\n                        Arbeitnehmer beim Kunden vor Ort mit seiner Unterschrift in der jeweiligen Anwesenheitsliste.\n                    </p>\n                    <p>\n                        5.4 Der Arbeitnehmer verpflichtet sich, über alle Betriebs- und Geschäftsgeheimnisse, sowohl während der\n                        Dauer des Arbeitsverhältnisses als auch nach seiner Beendigung Stillschweigen zu bewahren. Die\n                        Geheimhaltungspflicht erstreckt sich nicht auf solche Kenntnisse, die jedermann zugänglich sind oder d eren\n                        Weitergabe für den Arbeitgeber ersichtlich ohne Nachteile für ist. Im Zweifelsfalle sind jedoch technische,\n                        kaufmännische und persönliche Vorgänge und Verhältnisse, die dem Arbeitnehmer im Zusammenhang mit\n                        seiner Tätigkeit bekannt werden, als Unternehmensgehe imnisse zu behandeln. In solchen Fällen ist der\n                        Arbeitnehmer vor der Offenlegung gegenüber Dritten v erpflichtet, eine Weisung der Geschäftsleitung\n                        einzuholen, ob eine bestimmte Tatsache vertraulich zu behandeln ist oder nicht. Die Schweigepflicht erst\n                        reckt sich auch auf die Entleiher, bei denen der Arbeitnehmer eingesetzt ist.\n                    </p>\n                    <p>\n                        5.5 Für jeden Verstoß gegen die in § 5.4 vereinbarte Verschwiegenheitserklärung ist eine Vertragsstrafe in\n                        Höhe eines Bruttomonatsgehaltes vereinbart. Dem Arbei tnehmer bleibt nachzuweisen, dass der Arbeitgeber\n                        durch die Vertragsverletzung einen geringeren Schaden erlitten hat.\n                    </p>\n            \n                    <div class=\"center\">§ 6 Arbeitszeit</div>\n                    <p>\n                        6.1 Die individuelle, regelmäßige monatliche Arbeitszeit beträgt {CONTRACTUAL_WORKING_HOURS} Stunden gemäß § 12 Teilzeit-\n                        und Befristungsgesetz. Sollte der Arbeitnehmer nicht für die genannte Dauer der vereinbarten Arbeitszeit\n                        verliehen werden können, wird für die nicht geleisteten Stunden der vereinbarte Tariflohn gezahlt. Beträgt\n                        die Arbeitszeit des Arbeitnehmers aus von ihm zu vertretenden Gründen weniger als die vereinbarte\n                        Stundenzahl, entfällt für diese Zeiträume der Entgeltanspruch.\n                    </p>\n                    <p>\n                        6.2 Der Umfang der wöchentlichen und täglichen Arbeitsleistung des Arbeitnehmers richtet sich nach dem\n                        jeweiligen Arbeitsanfall. Die Arbeitsleistung kann vom Arbeitgeber individuell abgerufen werden. Zwischen\n                        dem Abruf der Arbeitsleistung und dem Arbeitsantritt müssen mindestens vier Tage liegen.\n                    </p>\n                    <p>\n                        6.3 Es ist die Wege-Zeit zu vergüten, die die Dauer von 2,50 Stunden für die einfache Wegstrecke von der\n                        Wohnung zu der Tätigkeitsstätte auf dem zeitlich günstigsten Weg überschreitet, sofern er diese Wege-Zeit\n                        tatsächlich aufgewendet hat.\n                    </p>\n                    <p>\n                        6.4 Der Arbeitgeber richtet für den Arbeitnehmer gemäß § 3.2 Manteltarifvertrag iGZ ein Arbeitszeitkonto mit\n                        den dort aufgeführten Abwicklungsmodalitäten ein.\n                    </p>\n            \n                    <div class=\"center\">§ 6 Arbeitszeit</div>\n                    <p>\n                        Der Arbeitnehmer verpflichtet sich gemäß § 2a Schwarzarbeitsbekämpfungsgesetz seinen\n                        Personalausweis oder Pass oder Pass- oder Ausweisersatz sowie die Papiere der Aufenthalts- und\n                        Arbeitserlaubnis stets mitzuführen und bei Kontrollen den Behörden auf Verlangen vorzulegen.\n                    </p>\n            \n                    <div class=\"center\">§ 8 Vergütung und Fälligkeit</div>\n                    <p>\n                        8.1 Gemäß den in § 2 Absatz 1 EGRTV festgelegten Tätigkeitsbezeichnungen wird der Arbeitnehmer in die\n                        Entgeltgruppe 1 des § 3 EGRTV eingruppiert.\n                    </p>\n                    <p>\n                        8.2 Der Arbeitnehmer erhält {WAGE} €/Std.\n                        - ein tarifliches Entgelt, dessen Höhe sich nach den Bestimmungen des § 2 EGRTV i. V. m. §§ 4, 5 EGRTV\n                        bemisst.\n                        - eine übertarifliche Zulage pro geleisteter Arbeitsstunde in Höhe von {BONUS} €/Std.\n                        Der Bruttostundenlohn beträgt {GROSS} €/Std.\n                    </p>\n                    <p>\n                        8.3 Die Vergütung ist jeweils zum 15. Bankarbeitstag des Folgemonats auf ein vom Mitarbeiter\n                        anzugebendes Konto zu überweisen. Soweit der Arbeitnehmer seiner Verpflichtung nach § 4.3 nicht oder\n                        nicht rechtzeitig nachkommt, kann sich die Abrechnung und die Auszahlung verzögern. Diese Verzögerung\n                        geht nicht zu Lasten des Arbeitgebers.\n                    </p>\n                    <p>\n                        8.4 Die Höhe etwaiger Zuschläge, die in Abhängigkeit von der Dauer oder der Lage der Arbeitszeit geleistet\n                        werden, richtet sich nach der Zuschlagsreglung des Entleihers und ist im Tarifvertrag § 4 Ziffer 4.5.4\n                        geregelt.\n                    </p>\n                    <p>\n                        8.5 Der Mitarbeiter verpflichtet sich, Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene\n                        Bereicherung zurückzuzahlen.\n                    </p>\n                    <p>\n                        8.6 Der Mitarbeiter darf seine Vergütungsansprüche weder verpfänden noch abtreten. Der Arbeitgeber\n                        behält sich vor, nachträglich vertragswidrig vorgenommene Abtretungen oder Verpfändungen zu\n                        genehmigen. Die Kosten, die dem Arbeitgeber durch die Bearbeitung von Verpfändungen und Abtretungen\n                        der Vergütungsansprüche des Mitarbeiters entstehen, trägt der Mitarbeiter. Diese Kosten werden\n                        pauschaliert mit 8,00 € pro Pfändung, Abtretung und Verpfändung sowie ggf. zusätzlich 4,- € für jedes\n                        Schreiben sowie 1 € pro Überweisung. Bei Nachweis höherer tatsächlicher Kosten ist der Arbeitgeber\n                        berechtigt, diese in Ansatz zu bringen.\n                    </p>\n            \n            \n                    <div class=\"center\">§ 9 Urlaub</div>\n                    <p>\n                        9.1 Je Kalenderjahr hat der Arbeitnehmer Anspruch auf bezahlten Erholungsurlaub, der ggf. anteilig\n                        gewährt wird. Die Anzahl der Urlaubstage richtet sich nach § 6 des Manteltarifvertrages. Der Zeitpunkt des\n                        Urlaubsantrittes erfolgt im Einvernehmen mit dem Arbeitgeber.\n                    </p>\n                    <p>\n                        9.2 Das Urlaubsentgelt ergibt sich aus den tariflichen Vereinbarungen und errechnet sich aus dem\n                        Tarifentgelt auf der Basis der regelmäßigen monatlichen Arbeitszeit, wobei Zuschläge für die besondere\n                        Lage der Arbeitszeit bei der Berechnung zu berücksichtigen sind.\n                    </p>\n                    <p>\n                        9.3 Nach dem 6. Monat des ununterbrochenen Bestehens des Beschäftigungsverhältnisses hat der\n                        Arbeitnehmer Anspruch auf Jahressonderzahlungen in Form von zusätzlichem Urlaubs- und\n                        Weihnachtsgeld. Die zu gewährende Jahressonderzahlung richtet sich nach § 8 MTV.\n                    </p>\n            \n                    <div class=\"center\">§ 10 Arbeitsverhinderung</div>\n                    <p>\n                        10.1 Bei krankheitsbedingter Arbeitsunfähigkeit ist der Arbeitnehmer verpflichtet, den Arbeitgeber\n                        unverzüglich zu unterrichten. Dies gilt auch bei sonstiger Arbeitsverhinderung. Darüber hinaus hat der\n                        Mitarbeiter bei krankheitsbedingter Arbeitsverhinderung spätestens nach Ablauf des 3. Kalendertages nach\n                        Beginn der Arbeitsunfähigkeit dem Arbeitgeber eine ärztliche Arbeitsunfähigkeitsbescheinigung\n                        einzureichen. Dauert die Arbeitsunfähigkeit länger als in der Bescheinigung angegeben an, so ist der\n                        Arbeitnehmer verpflichtet, eine neue ärztliche Arbeitsunfähigkeitsbescheinigung einzureichen. Gleichzeitig\n                        hat der den Arbeitgeber darüber unverzüglich zu unterrichten.\n                    </p>\n            \n                    <p>\n                        10.2 Die Pflicht, den Arbeitgeber unverzüglich über Arbeitsverhinderung und die Gründe zu unterrichten, gilt\n                        auch bei sonstiger Arbeitsverhinderung.\n                    </p>\n            \n                    <div class=\"center\">§ 11 Nebentätigkeiten</div>\n                    <p>\n                        11.1 Sofern er sich bei der vorliegenden Tätigkeit um eine Nebentätigkeit handelt, hat der Arbeitnehmer den\n                        Arbeitgeber bei Vertragsschluss über die Haupttätigkeit zu unterrichten.\n                    </p>\n                    <p>\n                        11.2 Jede Nebentätigkeit, gleichgültig ob sie entgeltlich oder unentgeltlich ausgeübt wird, bedarf der\n                        vorherigen Zustimmung des Arbeitgebers. Die Zustimmung ist zu erteilen, wenn die Nebentätigkeit die\n                        Wahrnehmung der dienstlichen Aufgaben zeitlich nicht oder allenfalls unwesentlich behindert und sonstige\n                        berechtigte Interessen des Arbeitgebers nicht beeinträchtigt werden.\n                    </p>\n                    <p>\n                        11.3 Der Arbeitgeber hat die Entscheidung über den Antrag des Arbeitnehmers auf Zustimmung zur\n                        Nebentätigkeit innerhalb von vier Wochen nach Eingang des Antrags zu treffen. Wird innerhalb dieser Frist\n                        eine Entscheidung nicht gefällt, gilt die Zustimmung als erteilt.\n                    </p>\n            \n                    <div class=\"center\">§ 12 Unfallverhütung/Arbeitsschutz</div>\n                    <p>\n                        Der Arbeitnehmer erklärt, dass er die für den jeweiligen Arbeitsplatz geltenden Unfallverhütungsvorschriften\n                        beachten und verfolgen wird. Der Arbeitgeber wird ihm die jeweils geltenden Unfallverhütungsvorschriften\n                        vor jedem Einsatz zur Kenntnis geben und dafür Sorge tragen, dass er vor dem ersten Tätigwerden am\n                        Arbeitsplatz entsprechend eingewiesen wird. Der Arbeitgeber wird dafür Sorge tragen, dass der\n                        Arbeitnehmer die für die jeweilige Arbeit vorgeschriebene, erforderliche Schutzausrüstung kostenlos erhält.\n                        Bei Betriebs- und Wegeunfällen wird der Arbeitnehmer beim Arbeitgeber unverzüglich eine Unfallmeldung\n                        erstatten.\n                    </p>\n            \n                    <div class=\"center\">§ 14 Vertragsstrafe</div>\n                    <div>14.1 Der Arbeitnehmer hat eine Vertragsstrafe an den Arbeitgeber zu zahlen, wenn\n                        <ul>\n                            <li>er die Arbeit im laufenden Arbeitsverhältnis rechtswidrig nicht oder wiederholt verspätet\n                                aufnimmt,\n                            </li>\n                            <li>er das Arbeitsverhältnis rechtswidrig ohne Einhaltung der maßgeblichen Kündigungsfrist auslöst,</li>\n                            <li>er vorrübergehend die Arbeit rechtswidrig verweigert oder Arbeitsbummelei begeht,</li>\n                            <li>er wiederholt Tätigkeitsnachweise oder Arbeitsunfähigkeitsbescheinigungen nicht rechtzeitig\n                                einreicht,\n                            </li>\n                            <li>er Straftaten oder Ordnungswidrigkeiten zum Nachteil des Arbeitgebers, des Entleihers oder zum\n                                Nachteil\n                                von anderen Arbeitnehmern begeht,\n                            </li>\n                            <li>er eigenmächtig seinen Urlaub antritt,</li>\n                            <li>er mit Krankheit droht,</li>\n                            <li>er wiederholt Nachweis- oder Meldepflichten schuldhaft nicht nachkommt oder unentschuldigt fehlt\n                                oder\n                                schuldhaft nicht erreichbar ist,\n                            </li>\n                            <li>er unter Alkohol- oder Drogeneinfluss am Arbeitsplatz angetroffen wird,</li>\n                            <li>er einer nicht genehmigungsfähigen Nebentätigkeit nachgeht,</li>\n                            <li>er schuldhaft eine unverwertbare Arbeitsleistung erbringt.</li>\n                        </ul>\n                    </div>\n                    <p>\n                        14.2 Die Vertragsstrafe wird nur fällig, wenn der Arbeitnehmer grob fahrlässig oder vorsätzlich gehandelt\n                        hat.\n                    </p>\n                    <p>\n                        14.3 Als Vertragsstrafe ist für die Fälle der rechtswidrigen Auflösung des Arbeitsverhältnisses ohne\n                        Einhaltung der maßgeblichen Kündigungsfrist durch den Arbeitnehmer und der Veranlassung des\n                        Arbeitgebers zu einer fristlosen Kündigung wegen schwerwiegender Vertragsverstöße des Arbeitnehmers\n                        eine Vertragsstrafe des ansonsten in der maßgeblichen Kündigungsfrist enthaltenen Arbeitsentgeltes\n                    </p>\n            \n                    <div class=\"center\">§ 15 Datenschutz</div>\n                    <p>\n                        Der Arbeitnehmer erklärt sein Einverständnis damit, dass seine persönlichen Daten, soweit sie dem\n                        Arbeitgeber bekannt sind, in EDV-Anlagen beim Arbeitgeber oder einem Beauftragten gespeichert und\n                        verarbeitet werden dürfen.\n                    </p>\n            \n                    <div class=\"center\">§ 16 Sonstiges</div>\n                    <p>\n                        16.1 Änderungen des Vertrages und Nebenabreden bedürfen zu ihrer Wirksamkeit der Schriftform.\n                    </p>\n                    <p>\n                        16.2   Der   Arbeitnehmer   bestätigt   durch   seine   Unterschrift,   vom   Arbeitgeber   das   Merkblatt   der\n                        Bundesagentur für Arbeit über den wesentlichen Inhalt des Arbeitnehmerüberlassungsgesetzes und eine\n                        Kurzfassung der Unfallverhütungsvorschriften erhalten zu haben.\n                    </p>\n                    <p>\n                        16.3   Der   bei   der   Einstellung   ausgefüllte   Personalfragebogen   ist   Bestandteil   dieses   Vertrages.   Im\n                        Fragebogen gemachte, unrichtige Angaben berechtigen den Arbeitgeber zur fristlosen Kündigung.\n                    </p>\n                    <p>\n                        16.4 Dieser Vertrag wird in 2 Ausführungen erstellt und von beiden Vertragsparteien unterschrieben. Der\n                        Arbeitnehmer bestätigt, eine gleichlautende Ausfertigung erhalten zu haben.\n                    </p>\n                    <p>\n                        16.5 Zur Aufrechterhaltung ungekürzter Ansprüche auf Arbeitslosengeld ist der Arbeitnehmer verpflichtet,\n                        sich 3 Monate vor Ablauf des Vertragsverhältnisses persönlich beim Arbeitsamt arbeitssuchend zu melden.\n                        Weiterhin ist er verpflichtet, aktiv nach einer Beschäftigung zu suchen.\n                    </p>\n                    <p>\n                        16.6 Gerichtsstand ist Köln\n                    </p>\n                    <p>\n                        16.7   Sollte   eine   Bestimmung   dieser   Vereinbarung   unwirksam   sein,   bleibt   die   Wirksamkeit   der   übrigen\n                        Bestimmungen hiervon unberührt. Die Parteien verpflichten sich, die unwirksame Bestimmung durch eine -\n                        dieser in Interessenslage und Bedeutung möglichst entsprechende  -  wirksame Bestimmung zu ersetzen.\n                    </p>\n                '),
(6, 'basic', 'warning', 'Abmahnung', '\n                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME},</p>\n                    <p>\n                        zu unserem Bedauern mussten wir feststellen, dass Sie Ihre arbeitsvertraglichen Pflichten in schwerwiegender Weise verletzt haben. Ihr im Folgenden geschildertes Verhalten veranlasst uns,\n                        Sie auf die ordnungsgemäße Erfüllung Ihrer arbeitsvertraglichen Pflichten hinzuweisen.\n                    </p>\n                    <p>\n                        Wir sind am {DATE_OF_NOTICE} darüber informiert worden, dass Sie sich entgegen der arbeitsvertraglichen Verpflichtungen verhalten haben.\n                        Der Arbeitnehmer hat eine Vertragsstrafe §14.1 an den Arbeitgeber zu zahlen, wenn\n                    </p>\n                    \n                    {REASON}\n                    \n                    <p>Tag des Verstoßes:</p>\n                    \n                    <br>\n            \n                    <p>am {DATE_OF_VIOLATION} - Vertragsstrafe beträgt: {AMOUNT} Euro</p>\n            \n            \n                    <p>Hinweis: {NOTE}</p>\n            \n                    <p>\n                        Für alle übrigen in § 14.1 genannten Fälle ist ein Bruttotagesentgelt für jeden Tag der Zuwiderhandlung verwirkt. Sie haben damit Ihre Pflichten aus dem Arbeitsvertrag verletzt. Wir erwarten, dass Sie dieses Verhalten  in dem oben geschilderten Umfang einstellen, weil Sie andernfalls gegen das Arbeitsvertrag verstoßen.\n                        Wir fordern Sie deshalb ausdrücklich auf, das oben geschilderte Verhalten zukünftig zu unterlassen und Ihre Pflichten aus dem Arbeitsvertrag zu erfüllen.\n                        Im Falle der Wiederholung des in dieser Abmahnung gerügten Verhaltens behalten wir uns vor, Ihr Arbeitsverhältnis ordentlich, gegebenenfalls auch außerordentlich fristlos zu kündigen.\n                    </p>\n            \n                    <p>\n                        Eine Durchschrift dieser Abmahnung legen wir in der Personalakte ab.\n                    </p>\n                '),
(7, 'basic', 'reminder', 'Erinnerung', '\n                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME},</p>\n                    <p>\n                        zu unserem Bedauern mussten wir feststellen, dass Sie Ihre arbeitsvertraglichen Pflichten in schwerwiegender Weise verletzt haben. Ihr im Folgenden geschildertes Verhalten veranlasst uns,\n                        Sie auf die ordnungsgemäße Erfüllung Ihrer arbeitsvertraglichen Pflichten hinzuweisen.\n                    </p>\n                    <p>\n                        Wir sind am {DATE_OF_NOTICE} darüber informiert worden, dass Sie sich entgegen der arbeitsvertraglichen Verpflichtungen verhalten haben.\n                        Der Arbeitnehmer hat eine Vertragsstrafe §14.1 an den Arbeitgeber zu zahlen, wenn\n                    </p>\n                    \n                    {REASON}\n                    \n                    <p>Tag des Verstoßes:</p>\n                    \n                    <br>\n            \n                    <p>am {DATE_OF_VIOLATION} - Vertragsstrafe beträgt: {AMOUNT} Euro</p>\n            \n            \n                    <p>Hinweis: {NOTE}</p>\n            \n                    <p>\n                        Für alle übrigen in § 14.1 genannten Fälle ist ein Bruttotagesentgelt für jeden Tag der Zuwiderhandlung verwirkt. Sie haben damit Ihre Pflichten aus dem Arbeitsvertrag verletzt. Wir erwarten, dass Sie dieses Verhalten  in dem oben geschilderten Umfang einstellen, weil Sie andernfalls gegen das Arbeitsvertrag verstoßen.\n                        Wir fordern Sie deshalb ausdrücklich auf, das oben geschilderte Verhalten zukünftig zu unterlassen und Ihre Pflichten aus dem Arbeitsvertrag zu erfüllen.\n                        Im Falle der Wiederholung des in dieser Abmahnung gerügten Verhaltens behalten wir uns vor, Ihr Arbeitsverhältnis ordentlich, gegebenenfalls auch außerordentlich fristlos zu kündigen.\n                    </p>\n            \n                    <p>\n                        Eine Durchschrift dieser Erinnerung legen wir in der Personalakte ab.\n                    </p>\n                '),
(8, 'basic', 'withdrawal_receipt', 'Kündigungsbestätigung', '\n                    <p><strong>Betreff:</strong> Kündigungsbestätigung des Arbeitsverhältnisses</p>\n\n                    <p>{SALUTATION} {FIRST_NAME} {LAST_NAME} ,</p>\n            \n                    <p>Hiermit bestätigen wir, dass wir Ihre Kündigung vom {DATE_OF_CREATION}  am {DATE_OF_RECEIPT} erhalten haben und dass Ihr Arbeitsverhältnis wie gewünscht zum {NOTICE_TO} enden wird.</p>\n            \n                    <p>Gemäß § 6.6 des Arbeitsvertrages sind Sie verpflichtet, etwaige Gehaltsüberzahlungen ohne Rücksicht auf eine noch vorhandene Bereicherung zurückzuzahlen. Bitte informieren Sie uns in diesem Falle, bis wann bzw. wie Sie den ausstehenden Betrag zurückzahlen werden. Sollten wir diesbezüglich nichts von Ihnen hören, werden wir weitere rechtliche Schritte gegen Sie einleiten.</p>\n            \n                    <p>Wir wünschen Ihnen für Ihren weiteren privaten und beruflichen Lebensweg alles Gute.</p>\n            \n                    <p>Mit freundlichen Grüßen</p>\n            \n                    <p>GF.: {SIGNATURE}</p>\n                ');

-- --------------------------------------------------------

--
-- Table structure for table `textblocks`
--

CREATE TABLE `textblocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `textblocks`
--

INSERT INTO `textblocks` (`id`, `type`, `name`, `label`, `value`) VALUES
(1, 'signature', 'company_name', 'Firmenname', 'Servite GmbH'),
(2, 'signature', 'street', 'Straße', 'Hohenzollenring 57'),
(3, 'signature', 'postal_code', 'PLZ', '50672'),
(4, 'signature', 'city', 'Stadt', 'Köln'),
(5, 'signature', 'email', 'E-Mail', 'info@servite.de'),
(6, 'signature', 'phone', 'Telefon', '0221 16025 152'),
(7, 'signature', 'fax', 'Fax', '0221 16867 124'),
(8, 'signature', 'website', 'Webseite', 'www.servite.de'),
(9, 'signature', 'iban', 'IBAN', 'DE24 3704 0044 0129 7639 00'),
(10, 'signature', 'bic', 'BIC', 'COBADEFFXXX'),
(11, 'signature', 'tax_number', 'Steuernummer', '123/4354/1212'),
(12, 'signature', 'tax_id', 'Umsatzsteuer ID', 'DE4354684354'),
(13, 'operation_plan', 'disclaimer', 'Hinweise', '<p>Der Mitarbeiter wird als Leiharbeitnehmer bei Kunden im Rahmen der Arbeitnehmerüberlasung eingesetzt.\n                            <br />Bei allen Veranstaltungen ist die Uniform immer komplett und sauber mitzuführen. Bitte immer an Arbeitsutensilien wie Kellnermesser, Kugelschreiber, Block und Feuerzeug denken!</p>\n                            <ul>\n                            <li>Mit jeder Bestätigung des Einsatzes verpflichtet sich der/die Mitarbeiter/-in im Auftrag der Servite GmbH pünktlich beim Kunden oder am Treffpunkt zu erscheinen.</li>\n                            <li>Emails müssen immer schriftlich bestätigt werden.</li>\n                            <li>Einsätze enden nicht mit der letzten Bahn.</li>\n                            <li>Absagen werden ausschließlich telefonisch von Servite entgegengenommen.</li>\n                            <li>Während der Arbeit ist das Handy auszuschalten oder auf Flugmodus umzustellen</li>\n                            </ul>'),
(14, 'operation_plan', 'signature', 'Signatur', ' <p>Mit besten Grüßen, <br />Payam R. Monfared, Chem. Ing. <br /><br />\n                            Email: pmonfared@servite.de<br />\n                            Tel: 0178 - 888 - 3058<br /> <br /> \n                            Servite GmbH<br /> \n                            Hohenzollernring 57<br /> \n                            50672 Köln<br /> <br /> \n                            Tel.: 0221/16025-152<br /> Fax: 0221/16867 124<br /> <br /> \n                            E-Mail: info@servite.de<br /> www: www.servite.de<br /> <br /> \n                            Geschäftsführer: Georg Hüwel und Dino Pergola<br /> <br /> HR 82474, Registergericht Köln<br /> \n                            Steuernummer: 215/5839/3539<br /> UST-ID: DE29 724 6540<br /> <br /> \n                            Diese E-Mail enthält vertrauliche und/oder rechtlich geschützte Informationen. Wenn Sie nicht der richtige Adressat sind oder diese E-Mail irrtümlich erhalten haben, informieren Sie bitte sofort den Absender und vernichten Sie diese E-Mail. Das unerlaubte Kopieren sowie die unbefugte Weitergabe dieser E-Mail ist nicht gestattet.<br /> <br /> \n                            This e-mail may contain confidential and/or privileged information. If you are not the intended recipient (or have received this e-mail in error) please notify the sender immediately and destroy this e-mail. Any unauthorised copying, disclosure or distribution of the material in this e-mail is strictly forbidden.</p>'),
(15, 'attendance_list', 'mail_body', 'Mail - Anschreiben', '<p>Sehr geehrte Damen und Herren,</p>\n                            <p>anbei senden wir Ihnen die Stundenzettel zur Ihrer Veranstaltung. Bitte senden Sie uns diese schnellstmöglich nach Beendigung des Events unterschrieben zurück.</p>\n                            <p>Vielen Dank für Ihren Auftrag.</p>\n                            '),
(16, 'attendance_list', 'header', 'Kopfbereich', ' <p>Der Verleiher verpflichtet sich, dem Entleiher die in dieser Anwesenheitsliste aufgeführten Arbeitnehmer zur Arbeitnehmerleistung zu überlassen. Die Arbeitnehmerüberlassung gilt für die</p>'),
(17, 'attendance_list', 'call_to_action', 'Anweisung', '<p>Bitte Trainees (TR) und Standby (STB) nach vier Stunden auschecken. Bei länger andauernden Einsätzen werden die Folgestunden berechnet.</p>\n                            <p><strong>Unterschrift Auftraggeber:</strong>............................................................. (Bitte Namen auch in Druckbuchstaben angeben)</p>\n                            <p>Bitte senden Sie uns diese Anwesenheitsliste nach Veranstaltungsende an folgende Faxnummer: 0221 - 16867 124 oder per E-Mail an fax@servite.de</p>'),
(18, 'attendance_list', 'disclaimer', 'Hinweise', '</p>Der Entleiher verpflichtet sich, die sich aus § 618 BGB ergebenden Fürsorgepflichten einzuhalten. Insbesondere wird darauf geachtet, dass die Unfallverhütungsvorschriften Beachtung finden. Der Entleiher verpflichtet sich zur Unterrichtung, der für seinen Betrieb geltenden Arbeitsschutz- und Unfallverhütungsvorschriften. Der Verleiher übernimmt keine Verpflegungskosten. Der Entleiher akzeptiert die AGB der Servite GmbH.</p>'),
(19, 'invoice', 'mail_body', 'Mail - Anschreiben', '<p>Sehr geehrte Damen und Herren,</p>\n                            <p>wir bedanken uns für die gute Zusammenarbeit und stellen Ihnen wie vereinbart folgende Leistungen in Rechnung. Rechnung und Stundennachweis sind beigefügt als PDF.</p>'),
(20, 'invoice', 'intro', 'Rechnung - Einleitender Text', '<p>Wir bedanken uns für die gute Zusammenarbeit und stellen Ihnen wie vereinbart folgende Leistungen in Rechnung.</p>'),
(21, 'invoice', 'outro', 'Rechnung - Schließender Text', '<p>Innerhalb von 14 Tagen ab Rechnungsdatum netto ohne Abzug.</p>\n                            <p>Bitte geben Sie als Verwendungszweck unbedingt die Rechnungs-Nr. an.</p>'),
(22, 'invoice', 'reminder', 'Zahlungserinnerung', '<p>Sehr geehrte Damen und Herren,<br /><br />\n                            nach Durchsicht unserer Konten haben wir festgestellt, dass die Rechnung anbei noch offen ist.<br /><br />\n                            Wir bitten um schnellstmöglichen Ausgleich der Rechnung auf unser Konto<br /><br />Sollte sich diese Zahlungserinnerung mit Ihrer Zahlung überschnitten haben, bitten wir, dieses Schreiben als gegenstandslos zu betrachten.</p>'),
(23, 'invoice', 'payment_period', 'Zahlungsfrist (in Tagen)', '14'),
(24, 'client_warning', 'mail_body', 'Mail - Anschreiben', 'Sehr geehrter Herr ..., '),
(25, 'document', 'subject', 'Mail - Betreff', 'Ihre Unterlagen'),
(26, 'document', 'mail_body', 'Mail - Anschreiben', 'Sehr geehrter Herr ..., ');

-- --------------------------------------------------------

--
-- Table structure for table `timetrackings`
--

CREATE TABLE `timetrackings` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `break` int(11) DEFAULT NULL,
  `total_min` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_off`
--

CREATE TABLE `time_off` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `information` text COLLATE utf8mb4_unicode_ci,
  `editor` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_off_request`
--

CREATE TABLE `time_off_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `information` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cc_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `locations` json DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `email`, `cc_email`, `password`, `remember_token`, `photo`, `street`, `postal_code`, `city`, `signature`, `active`, `activated`, `locations`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'internal', 'servite24', 'servite@servite.de', 'pmonfared@servite.de', '$2y$10$O0LO9OLwRF8iHHexTVZXgupcjQE2j8MzvXv3peeoZlDfv1oPifpra', '7b2MZObues', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, '2019-09-12 00:53:56', '2019-09-12 00:53:56'),
(2, 'internal', 'Georg Hüwel', 'ghuewel@servite.de', 'pmonfared@servite.de', '$2y$10$rR3c48ErdMDdN8IBZxCHeu7X04ZgC5xaFcbym2GmwYb9T/OMa.seG', 'dfA9eMH7PN', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, '2019-09-12 00:53:56', '2019-09-12 00:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_activations`
--

CREATE TABLE `user_activations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `display_name`, `description`) VALUES
(1, 'master_admin', 'Master Admin', NULL),
(2, 'dispomanager', 'Dispo-Manager', NULL),
(3, 'local_manager', 'Filialleiter', NULL),
(4, 'accountant', 'Lohnbuchhalter', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wages`
--

CREATE TABLE `wages` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date DEFAULT NULL,
  `editor` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE `working_hours` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `hours` double(8,2) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date DEFAULT NULL,
  `editor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `working_time_accounts`
--

CREATE TABLE `working_time_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `target` double(8,2) NOT NULL,
  `actual` double(8,2) NOT NULL DEFAULT '0.00',
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `starting_value` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`client_id`,`employee_id`);

--
-- Indexes for table `charge_rates`
--
ALTER TABLE `charge_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_with_documents_id_with_documents_type_index` (`with_documents_id`,`with_documents_type`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_business`
--
ALTER TABLE `extra_business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_data`
--
ALTER TABLE `invoice_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legal_salaries`
--
ALTER TABLE `legal_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legal_texts`
--
ALTER TABLE `legal_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_log`
--
ALTER TABLE `mail_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_loggable_id_loggable_type_index` (`loggable_id`,`loggable_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_calculation`
--
ALTER TABLE `order_calculation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payroll_modifications`
--
ALTER TABLE `payroll_modifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portal_settings`
--
ALTER TABLE `portal_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textblocks`
--
ALTER TABLE `textblocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetrackings`
--
ALTER TABLE `timetrackings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_off`
--
ALTER TABLE `time_off`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_off_request`
--
ALTER TABLE `time_off_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_activations`
--
ALTER TABLE `user_activations`
  ADD KEY `user_activations_token_index` (`token`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_name_unique` (`name`);

--
-- Indexes for table `wages`
--
ALTER TABLE `wages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_time_accounts`
--
ALTER TABLE `working_time_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charge_rates`
--
ALTER TABLE `charge_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `extra_business`
--
ALTER TABLE `extra_business`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_data`
--
ALTER TABLE `invoice_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `legal_salaries`
--
ALTER TABLE `legal_salaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `legal_texts`
--
ALTER TABLE `legal_texts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mail_log`
--
ALTER TABLE `mail_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_calculation`
--
ALTER TABLE `order_calculation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payroll_modifications`
--
ALTER TABLE `payroll_modifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portal_settings`
--
ALTER TABLE `portal_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `textblocks`
--
ALTER TABLE `textblocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `timetrackings`
--
ALTER TABLE `timetrackings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_off`
--
ALTER TABLE `time_off`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `time_off_request`
--
ALTER TABLE `time_off_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wages`
--
ALTER TABLE `wages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `working_time_accounts`
--
ALTER TABLE `working_time_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
