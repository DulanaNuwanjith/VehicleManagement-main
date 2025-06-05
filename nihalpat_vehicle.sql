-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2025 at 08:54 AM
-- Server version: 8.0.41-cll-lve
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nihalpat_vehicle`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintainances`
--

CREATE TABLE `maintainances` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `mileage` int DEFAULT NULL,
  `done_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintainances`
--

INSERT INTO `maintainances` (`id`, `vehicle_id`, `date`, `description`, `cost`, `mileage`, `done_by`, `created_at`, `updated_at`) VALUES
(1, 11, '2025-02-27', 'Brake liner, Oil seal can, head, meter cable, brake liner plug, service', 9050.00, 0, 'N/A', '2025-04-24 04:13:45', '2025-04-24 04:13:45'),
(2, 6, '2025-02-20', 'Footrest front, starter motot XCD, Break pump pulser, gear padal, kick padal', 12000.00, 0, 'Mudalige Enterprises', '2025-04-24 04:15:51', '2025-04-24 04:15:51'),
(3, 7, '2025-02-21', 'Fork Oil, Winker unit - Passon, Speedo Cable - Hunk, Fork Tube - CD100, Seal oil, TH Cable - Glamour, Fork boot - Pulser', 10300.00, 0, 'Mudalige Enterprises', '2025-04-24 04:18:48', '2025-04-24 04:18:48'),
(4, 12, '2025-03-06', 'Back Break Washer', 1500.00, 0, 'N/A', '2025-04-24 04:20:21', '2025-04-24 04:20:21'),
(5, 12, '2025-03-28', 'Oil Leak Repair', 1500.00, 0, 'Anuhas Motors', '2025-04-24 04:20:52', '2025-04-24 04:20:52'),
(6, 12, '2025-01-18', 'CAM Flower Kit, PTO Face Packing, PTO Cover Packing, Gasket', 5500.00, 0, 'N/A', '2025-04-24 04:27:16', '2025-04-24 04:27:16'),
(7, 12, '2025-01-16', 'Silencer Repair, Lathe Work, Service charges', 6500.00, 0, 'N/A', '2025-04-24 04:28:00', '2025-04-24 04:28:00'),
(8, 12, '2025-04-09', 'Clutch Plate, Pressure Plate, Piston, Cylinder Boar, Piston Ring, Push Rod Seal, Tapet cover packing, Gasket, Silencer Packing, Oil Filter, Diesel Filter', 24900.00, 0, 'N/A', '2025-04-24 04:30:34', '2025-04-24 04:30:34'),
(9, 21, '2025-03-12', 'Hybrid Battery Repair, 1SG Unit repair, 5PK 778 Belt with labour', 25962.50, 0, 'Kings Auto Care', '2025-04-24 04:32:39', '2025-04-24 04:32:39'),
(10, 8, '2025-04-07', 'Sollanite switch, Bonnet cable, door lock repair, service charges', 15400.00, 0, 'Anuhas Motors', '2025-04-24 04:34:16', '2025-04-24 04:34:16'),
(11, 8, '2025-01-09', 'Oil change, break check, fan belt replacement', 6000.00, 0, 'N/A', '2025-04-24 04:35:10', '2025-04-24 04:35:10'),
(12, 5, '2025-02-03', 'Power Steering, Pressure horse, power oil, service charge', 8850.00, 0, 'N/A', '2025-04-24 04:37:37', '2025-04-24 04:37:37'),
(13, 5, '2025-02-10', 'Air cleaner 2, Radiator repair, Break washer back, Power pump replace, Engine mount, Power oil, Brake oil, Power pump, Service charge', 113215.00, 0, 'N/A', '2025-04-24 04:39:29', '2025-04-24 04:39:29'),
(14, 5, '2025-02-17', 'Trank oil, Seal, Injector pump, Side motors, Jacket', 15160.00, 0, 'N/A', '2025-04-24 04:40:27', '2025-04-24 04:40:27'),
(15, 5, '2025-02-19', 'Tyre change', 2150.00, 0, 'Delgoda wheel alignement', '2025-04-24 04:41:45', '2025-04-24 04:41:45'),
(16, 5, '2025-02-25', 'Driving set, AC idle repair', 4000.00, 0, 'Anuhas Motors', '2025-04-24 04:42:25', '2025-04-24 04:42:25'),
(17, 5, '2025-04-02', 'Body mount and front spring repair', 5500.00, 0, 'Anuhas Motors', '2025-04-24 04:43:11', '2025-04-24 04:43:11'),
(18, 15, '2025-03-10', 'Clutch Plate, Pressure Plate, Service charge, Left front dunu, dunu paper', 12050.00, 0, 'N/A', '2025-04-24 04:50:58', '2025-04-24 04:50:58'),
(19, 15, '2025-03-19', 'Injector Pump Repair', 57700.00, 0, 'HAS Diesel Engineering', '2025-04-24 04:51:44', '2025-04-24 04:51:44'),
(20, 15, '2025-01-17', 'Clutch Plate, pressure plate, pivot bearing replacement, engine oil rear seal, gear box rear oil, gear cable replacement, clutch master pump, clutch lower pump, gear cable fitting', 15000.00, 0, 'Anuhas Motors', '2025-04-24 04:55:10', '2025-04-24 04:55:10'),
(21, 15, '2025-01-17', 'Ply wheel fitting, crank oil seal, brake oil', 8900.00, 0, 'New Sooriyarachchi Motor house', '2025-04-24 04:56:32', '2025-04-24 04:56:32'),
(22, 13, '2025-02-15', 'Tyre change', 900.00, 0, 'Siyeto Tyre service', '2025-04-24 04:57:25', '2025-04-24 04:57:25'),
(23, 13, '2025-04-02', 'AC boot, AC oil seal, AC Pleat, Bell oring, RC Outler, Clutch Pleat, Pressure pleat, Spring, Bolt and Lock, Pushrod, oring, pin, Dish lock, Cluoth washer, RC Spring, Benjo washer, AXEL 200, Axel Plate, AXEL Bolt, Oil, Service Charge', 13600.00, 0, 'N/A', '2025-04-24 04:59:40', '2025-04-24 04:59:40'),
(24, 13, '2025-01-18', 'Gear Cable repair, Oil 2l, Roller cabin, Sock packing, Cam sharp repair, service charges', 15590.00, 0, 'N/A', '2025-04-24 05:00:42', '2025-04-24 05:00:42'),
(25, 18, '2025-03-09', 'Front left door tinker, bonnet, buffer, mudguard adjustment, mudflap inner guard fitting, front shock absorber replacement.', 14000.00, 0, 'Anuhas Motors', '2025-04-24 21:55:17', '2025-04-24 21:55:17'),
(26, 18, '2025-03-08', 'IM Pando cross fender front LH', 4000.00, 0, 'N/A', '2025-04-24 21:56:09', '2025-04-24 21:56:09'),
(27, 18, '2025-03-09', 'Shock front R, Shock Front L, Shock boot, IM GF CV Joint, Graphited Grease', 33377.70, 0, 'Isuru Motors', '2025-04-24 21:57:27', '2025-04-24 21:57:27'),
(28, 18, '2025-01-05', 'Spare parts, Service charges', 36445.00, 0, 'Ishan Engineering', '2025-04-24 22:11:36', '2025-04-24 22:11:36'),
(29, 2, '2025-04-24', 'Clutch Plate, clutch cover replacement, Engine rear oil seal replacement, Speedometer cable replace', 16500.00, 0, 'Anuhas Motors', '2025-04-24 22:14:56', '2025-04-24 22:14:56'),
(30, 5, '2025-04-24', 'Power Oil, Power horse repair, Service charges', 5900.00, 0, 'Anuhas Motors', '2025-04-24 22:17:05', '2025-04-24 22:17:05'),
(31, 2, '2025-02-19', 'Wheel Alignement', 1600.00, 0, 'Delgoda Wheel Alignment Center', '2025-04-24 22:20:40', '2025-04-24 22:20:40'),
(32, 2, '2025-04-18', 'Boot, Tyre Rob ball maintenance, 4PK belt, fan belt steam damper, DDCUM', 41350.00, 0, 'N/A', '2025-04-24 22:24:00', '2025-04-24 22:24:00'),
(33, 4, '2025-03-12', 'Fan Belt', 5000.00, 0, 'Hashini Auto Traders', '2025-04-24 22:24:52', '2025-04-24 22:24:52'),
(34, 4, '2025-03-16', 'Alternator Bearing, Oil Seal replacement, service charges', 10900.00, 0, 'Anuhas Motors', '2025-04-24 22:25:37', '2025-04-24 22:25:37'),
(35, 4, '2025-04-07', 'Crank Oil Seal, Service charges', 12100.00, 0, 'Anuhas Motors', '2025-04-24 22:26:43', '2025-04-24 22:26:43'),
(36, 4, '2025-04-10', 'Battery replace', 31000.00, 0, 'Sadagiri Battery Works', '2025-04-24 22:27:32', '2025-04-24 22:27:32'),
(37, 9, '2025-02-15', 'Back Brake Shoo Set, Damper rubber set, Brake valve set, Service charges', 3640.00, 0, 'Lakshan Motors', '2025-04-24 22:33:11', '2025-04-24 22:33:11'),
(39, 9, '2025-02-05', 'Tyre change', 6200.00, 0, 'Sadagiri battery and tyre works', '2025-04-24 22:33:44', '2025-04-24 22:33:44'),
(40, 1, '2025-01-04', 'Horn replacement', 6000.00, 0, 'Anuhas Motors', '2025-04-24 22:37:05', '2025-04-24 22:37:05'),
(41, 20, '2025-03-19', 'Scanning and diagnosing, Radiator fan shroud, 3RR and check Replace, radiator fan motor recondition', 21500.00, 0, 'New Motor Masters Kandana', '2025-04-24 22:39:24', '2025-04-24 22:39:24'),
(42, 20, '2025-04-05', 'Wheel Alignment, CEAT Tyre', 28000.00, 0, 'Delgoda Wheel Alignment Center', '2025-04-24 22:40:22', '2025-04-24 22:40:22'),
(43, 12, '2025-04-28', 'Kersoene', 300.00, 0, 'Gamini', '2025-04-28 01:18:11', '2025-04-28 01:18:11'),
(44, 12, '2025-04-26', 'Fixed Main Bush, Ejest Thrust Bearings, Cut Thrust keys, Repair PTO Cover', 3000.00, 0, 'Micro Auto Engineering', '2025-04-28 01:19:14', '2025-04-28 01:19:14'),
(45, 2, '2025-04-26', 'Super 4T 20W-50', 2800.00, 0, 'Makola Oil Mart', '2025-04-28 01:20:27', '2025-04-28 01:20:27'),
(46, 2, '2025-04-28', 'E/ Pump', 5500.00, 0, 'Wickrama Motors', '2025-04-28 01:21:01', '2025-04-28 01:21:01'),
(47, 2, '2025-04-26', 'Power Steering, Box R/ Kit', 8500.00, 0, 'Willys Trading Company', '2025-04-28 01:21:38', '2025-04-28 01:21:38'),
(48, 2, '2025-04-26', 'Power steering box repair', 8000.00, 0, 'Anuhas Motors', '2025-04-28 01:23:31', '2025-04-28 01:23:31'),
(49, 2, '2025-04-28', 'Fuel Pump Replacement', 3000.00, 0, 'Anuhas Motors', '2025-04-28 02:57:06', '2025-04-28 02:57:06'),
(50, 5, '2025-04-27', 'Tyre change, tyre patch, T.C, patch', 4800.00, 0, 'Siyetgo Tyre Service', '2025-04-28 04:39:31', '2025-04-28 04:39:31'),
(51, 25, '2025-05-02', '2 X 75 X 17 Tube', 2000.00, 0, 'Sigiri Tyre Works', '2025-05-01 22:13:14', '2025-05-01 22:13:14'),
(52, 19, '2025-04-11', 'Alternator Belt Replace, 6PK Belt', 10000.00, 0, 'Auto Lanka - Mr Malinda', '2025-05-02 00:55:23', '2025-05-02 00:55:23'),
(53, 13, '2025-05-02', 'DSI T/T Tyre, Tube', 10700.00, 0, 'Sandagiri Battery and Tyre Works', '2025-05-02 05:42:10', '2025-05-02 05:42:10'),
(54, 5, '2025-05-02', 'GT Grand Tour A/T 3 Tyre 3 year warranty (2 tyres), Spare wheel', 105500.00, 0, 'SBW Power Solutions', '2025-05-02 05:44:02', '2025-05-02 05:44:02'),
(55, 14, '2025-05-03', 'ISO F/W, C4M SLW, CHM Nut, SHM, CHM', 1730.00, 0, 'N/A', '2025-05-04 21:57:34', '2025-05-04 21:57:34'),
(56, 18, '2025-04-12', '18S Tyre, Service Charge', 13000.00, 0, 'Janaka Tyre Service', '2025-05-05 04:33:42', '2025-05-05 04:33:42'),
(57, 9, '2025-05-05', 'Tank Cap-CT100', 1350.00, 0, 'Mudalige Enterprises', '2025-05-05 21:58:06', '2025-05-05 21:58:06'),
(58, 12, '2025-05-05', 'Crank, Support, Trust washer, main bush, Rod, Packing set, Oring kit, Bearing, Sum Packing, Cam, Cam follow, Roller tappet, Gavana unit, Oil pump, Oil seal, Crank seal, Push rod rubber, Support nut, Gasket, Gajn pin, Head Washer, Silencer stud, ORG nut kit, Silencer bracket, Five finger pack, DC inner, AC, Bolt lock, Support stud, Oil kurg, Bell oring, Pushrod, pin, Fine wheel cover, Spring bolt, Stop inner, Small bata, Feed pump kura, Benjo, silencer, Nut/spring/pot, oil, Oil filter, Bether kit, Air filter, Tapet, Pump rack, val set, Silencer fix, potting and repair of back', 90570.00, 0, 'Kalyana', '2025-05-07 22:14:54', '2025-05-07 22:14:54'),
(60, 13, '2025-05-09', 'Exide Ultra MF Battery', 25800.00, 0, 'Sadagiri Battery Works', '2025-05-13 22:26:57', '2025-05-13 22:26:57'),
(61, 16, '2025-05-09', 'Teeth and Bolt', 4200.00, 0, 'SparkLit', '2025-05-14 03:30:30', '2025-05-14 03:30:30'),
(62, 15, '2025-05-17', 'CEAT LYF MAX 12PR Tyre 2, Tape, Tyre change and Tip', 81000.00, 0, 'Sandagiri Battery and Tyre Works', '2025-05-18 22:24:25', '2025-05-18 22:24:25'),
(63, 5, '2025-05-18', 'Injector pump current supply repair', 2800.00, 0, 'Anuhas Motors', '2025-05-18 22:25:44', '2025-05-18 22:25:44'),
(64, 15, '2025-05-18', 'Brake adjustment, Tie-rod replacement, Brake light repair, Service Charges', 13384.00, 0, 'Anuhas Motors', '2025-05-18 22:27:52', '2025-05-18 22:27:52'),
(65, 8, '2025-05-19', 'Vehicle License, Emission Test', 4650.00, 264440, 'Jothirathna', '2025-05-19 00:18:34', '2025-05-19 00:18:34'),
(67, 13, '2025-05-08', 'Copper leg, Silencer packing, Breaker, Engine back nails, Branty Fixing', 4260.00, 0, 'Opel Engineering', '2025-05-19 00:31:47', '2025-05-19 00:31:47'),
(68, 16, '2025-04-06', 'Super DS 15W-40, Sakura Oil filter', 14669.00, 0, 'SMH Motor Supply', '2025-05-19 00:33:37', '2025-05-19 00:33:37'),
(69, 16, '2025-04-05', '15W 40 Des. Engine Oil', 1200.00, 0, 'Mr. Lube OIl', '2025-05-19 00:34:44', '2025-05-19 00:34:44'),
(70, 16, '2025-04-06', 'RS Oil Hose repair, DS 40 (IOC)', 4150.00, 0, 'Welcome Hydraulic Hose and Fittings', '2025-05-19 00:36:57', '2025-05-19 00:36:57'),
(71, 6, '2025-04-01', 'Patch', 400.00, 0, 'Siyetgo Tyre Service', '2025-05-19 00:38:18', '2025-05-19 00:38:18'),
(72, 6, '2025-04-28', '2x75x17 Tube Fixing', 2000.00, 0, 'Sigiri Tyre Works', '2025-05-19 00:39:29', '2025-05-19 00:39:29'),
(73, 5, '2025-04-06', 'Holdnet Patch', 3000.00, 0, 'Siyetgo Tyre Service', '2025-05-19 00:41:44', '2025-05-19 00:41:44'),
(74, 13, '2025-04-25', '6004, 6002', 3600.00, 0, 'Chamara Electricals', '2025-05-19 00:45:30', '2025-05-19 00:45:30'),
(75, 5, '2025-05-03', 'Wheel Alignment', 16500.00, 302157, 'Delgoda wheel alignement', '2025-05-19 00:49:16', '2025-05-19 00:49:16'),
(76, 2, '2025-05-09', 'Power Oil', 750.00, 0, 'Suriyarachchi Motor House', '2025-05-19 00:50:40', '2025-05-19 00:50:40'),
(77, 2, '2025-04-23', 'Sealastic, Clutch Kit, Crank Seal, Fly/W/Bush, Box Mount, 1CV100000 Seal, Switch (4 wheel), Speedo cable, Packing sheets, Flywheel, Gear Oil', 78400.00, 0, 'Gamini', '2025-05-19 00:56:56', '2025-05-19 00:56:56'),
(78, 13, '2025-05-21', 'Inside cover, Back cover, Motor Bracket, Nut, Spring, Ply wheel, Cup Set, Ring cut, Grease, Handle nails, Gear Cable, Brake switch, Horn', 10395.00, 0, 'Jothirathna', '2025-05-21 04:29:37', '2025-05-21 04:29:37'),
(79, 5, '2025-05-21', 'Center Bolt, Dunu 2 maintenance', 8000.00, 0, 'Premasiri Iron Works', '2025-05-21 05:03:47', '2025-05-21 05:03:47'),
(80, 19, '2025-05-21', 'Wheel Alignment Checked', 1600.00, 0, 'Delgoda wheel alignement', '2025-05-22 02:59:31', '2025-05-22 02:59:31'),
(81, 19, '2025-04-25', 'D2V Horn (TW)', 6700.00, 0, 'Eksath Auto Accessories', '2025-05-22 03:00:32', '2025-05-22 03:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `meter_reads`
--

CREATE TABLE `meter_reads` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `mileage` int DEFAULT NULL,
  `given_by` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_23_034539_create_vehicles_table', 1),
(5, '2025_04_23_044153_create_services_table', 1),
(6, '2025_04_23_063255_create_maintainances_table', 1),
(7, '2025_04_23_073013_rename_car_id_to_vehicle_id_in_maintainances_table', 1);

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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `service_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `service_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_cost` double DEFAULT NULL,
  `mileage` int DEFAULT NULL,
  `next_service_mileage` int DEFAULT NULL,
  `next_service_date` date DEFAULT NULL,
  `service_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `done_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `vehicle_id`, `service_type`, `service_date`, `service_location`, `service_cost`, `mileage`, `next_service_mileage`, `next_service_date`, `service_notes`, `done_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Full Service', '2024-09-20', 'Ja-Ela Auto Service', 26885, 137787, 142787, '2024-12-20', 'Full Body wash\r\nEngine Oil (10W-30) 4l\r\nOil Filter\r\nUnder guard cdip\r\nEngine degreaser 1l', 'N/A', '2025-04-23 03:53:35', '2025-04-23 03:53:35'),
(3, 20, 'Full Service', '2025-02-15', 'Ja-Ela Auto Service', 30960, 245219, 250219, '2025-05-15', 'Auto Service Plus\r\nLukoil Luxe\r\nOil Filter\r\nBG CVT Fluid Conditioner\r\nDoor Shock\r\nEngine Degreaser', 'N/A', '2025-04-23 04:15:35', '2025-04-23 04:15:35'),
(4, 20, 'Full Service', '2025-04-05', 'Ja-Ela Auto Service', 31390, 251219, 256219, '2025-07-05', 'Service Charge\r\nCarpet papers\r\nAir Freshner\r\nEngine Degreaser 500ml\r\nSyntium 800 IN 10W-40 3l\r\nOil filter\r\nA/C filter\r\nRadiator Coolant', 'Mr. Kumara', '2025-04-23 04:18:36', '2025-04-23 04:18:36'),
(5, 2, 'Full Service', '2024-11-22', 'Anuhas Motors', 20137, 200000, 205000, '2025-02-22', 'Engine oil 7l\r\nOil filter\r\nSilastic\r\nLathe work\r\nOil sump\r\nService Charges', 'Gamini', '2025-04-23 04:26:04', '2025-04-23 04:26:04'),
(6, 9, 'Full Service', '2025-03-21', 'Athula Motors', 33310, 100000, 105000, '2025-06-21', 'Oil Seal can\r\nClutch plate set\r\nPresuure plate set\r\nClutch hub\r\nCluthc wheel\r\nClutch packing\r\nBack wheel hub\r\nLinear\r\nRazor\r\nHub fix\r\nClutch plate fixing', 'N/A', '2025-04-23 04:31:59', '2025-04-23 04:31:59'),
(7, 9, 'Full Service', '2025-02-24', 'Athula Motors', 14050, 100000, 105000, '2025-05-24', NULL, 'N/A', '2025-04-23 04:33:07', '2025-04-23 04:33:07'),
(9, 4, 'Full Service', '2024-11-29', 'C & M Auto Service', 15700, 630235, 635235, '2025-03-01', 'Oil Filter, Fuel filter, Detergent Kerosene, Silastic, Diffoil, vaccum, service, engine oil', 'N/A', '2025-04-23 04:40:47', '2025-04-23 04:40:47'),
(10, 4, 'Full Service', '2025-04-22', 'C & M Auto Service', 22500, 640281, 645281, '2025-07-22', 'DS (15W-40) 6l, oil filter, silastic, detergent, oil spray, lubrication, service, airl filter', 'N/A', '2025-04-23 04:43:14', '2025-04-23 04:43:14'),
(11, 19, 'Full Service', '2025-02-08', 'Ja-Ela Auto Sevice', 41085, 120718, 125718, '2025-05-08', 'Auto service, Syntium 800 IN 10W-30 3l, oil filter, air filter, A/C filter,mechanical item, labour charges, engine degreaser', 'N/A', '2025-04-23 04:49:54', '2025-04-23 04:49:54'),
(12, 5, 'Full Service', '2025-02-08', 'C & M Auto Service', 22150, 297012, 302012, '2025-05-08', 'DS(15W-40) 6l, oil filter, fuel filter, detergent kerosene, service, air filter, body wash', 'Gamini', '2025-04-23 05:15:06', '2025-04-23 05:15:06'),
(13, 21, 'Full Service', '2025-03-11', 'Ja-Ela Auto Service', 72627, 229014, 234014, '2025-06-11', 'Auto service plus, Syntium 800 IN 10W-40 3l, oil filter, air filter, A/C filter, under guard clips, tappet cover packing, piston, caliper kit, brake pad, labour charge, engine degreaser.', 'N/A', '2025-04-23 05:18:50', '2025-04-23 05:18:50'),
(14, 12, 'Full Service', '2025-04-09', 'Anuhas Motors', 11500, 48491, 53491, '2025-07-09', 'Engine oil, service charges.', 'Gamini', '2025-04-23 05:22:17', '2025-04-23 05:22:17'),
(15, 7, 'Full Service', '2025-02-21', 'Athula Motors', 7960, 100000, 105000, '2025-05-21', 'Oil loose, 63001 razor, service, fork oil seal', 'N/A', '2025-04-23 05:26:22', '2025-04-23 05:26:22'),
(16, 6, 'Full Service', '2025-02-20', 'Athula Motors', 9750, 179039, 184039, '2025-05-20', 'Oil loose, oil filter, back razor, back linear, brake oil, service, other', 'Gamini', '2025-04-23 05:28:44', '2025-04-23 05:28:44'),
(17, 18, 'Full Service', '2025-03-15', 'Auto Cleancare Express, Isuru Motors', 35678.62, 77648, 82648, '2025-06-15', 'Duel clutch oil change, Service charges, Labour Charges, Wurth Coolant Green, H2L EDC 600ml, Penetrating Lubricant Oil, Rapid windscreen cleaner, oil filter, air filter, AC cabin filter, Motor Oil SP/SN/CF10W30', 'Mr. Chanaka', '2025-04-24 22:10:16', '2025-04-24 22:10:16'),
(18, 2, 'Full Service', '2025-04-25', 'C and M Auto Service', 21950, 200000, 205000, '2025-07-25', 'Oil DS (15W-40), Oil filter, Detergent / Kerosene, full service, air filter clean', 'Gamini', '2025-04-25 03:01:19', '2025-04-25 03:01:19'),
(19, 1, 'Full Service', '2025-04-29', 'Ja-Ela Auto Service', 73965, 143145, 148145, '2025-07-29', 'Auto Service Plus,\r\nSyntium 800 IN 10W-40 4L,\r\nOil Filter,\r\nAir Filter,\r\nTotachi ATF WS 4l,\r\nNormal Drain Gear Oil Change,\r\nA/C Filter,\r\nDelphi Brake Fluid,\r\nBrake oil Change,\r\nUnder Body protection Wax,\r\nEngine Degreaser', 'N/A', '2025-05-01 21:49:40', '2025-05-01 21:49:40'),
(20, 15, 'Full Service', '2025-05-17', 'C and M Auto Service', 28200, 412132, 417132, '2025-08-17', 'DS (15W-40), Oil Filter, Gear Oil, Detergent Kerosene, Service, Air filter clean', 'Gamini', '2025-05-18 22:22:57', '2025-05-18 22:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7oLdJ7lW7S9oVKBnSHwsQhVVOyqmUurZzLsW5M6z', NULL, '10.55.8.135', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGZqbm1EWExLak5pQnFQUzNxUHZPNHdTTDhRdlhnVUtLUk5UUHYwbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly93d3cudmVoaWNsZW1hbmFnZW1lbnQubmloYWxwYXRoaXJnZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748055628),
('9Q122ZFbpJ7WvmTjr0ViKEiRY5NVKdnOpsbG5gce', NULL, '54.255.213.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTVZMzlRZWVyV0xUNTY1WlM3amV2UnNsMUJrbXVuZkZ0dXI0d1RwaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly92ZWhpY2xlbWFuYWdlbWVudC5uaWhhbHBhdGhpcmdlLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748170630),
('ai18Kzh2U5QIW1MImmVRojhkUbyA0Fu8wVe1vC97', 1, '124.43.249.170', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVUtEWHhBVFp1T1l3alNlaFBIYmU1TVl3OUQ5dU9US0F0MlRucFhWayI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUzOiJodHRwczovL3ZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1748402653),
('bb8TwYvnMAHAaVodqoO8RXuYNNCqSF4FXxFw6B8n', 1, '124.43.249.170', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVGl4WFRadTE4RVRKd2lHZDNMdlJGN1NZSGNVb1poOHBtMkRRaE0xRSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUzOiJodHRwczovL3ZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1747977752),
('cCPbb1TtQAXEvu0ubZPwbNmDdQAyYetnaGDsmsEB', 1, '124.43.249.170', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQk41Y0RQV1JXamIyOE9ibGRmR1JWdzRTTDRvUWtzUVpFaE42NFBMeSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUzOiJodHRwczovL3ZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1747887313),
('Cqs4KWJHRyaIgzoGfKPHZhx0Up62f6JLJT2ayn3w', NULL, '45.148.10.248', 'Mozilla/5.0 (X11; Fedora; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3178.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE9xQ1NFY09tb0o2NDNMalE4ZjN2UDBqUVl4OWU5YzAxM1ZoamQwWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vd3d3LnZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748372217),
('e3OxwsHhSoZZTc6Y7gb3HAniy63VPEg4UPGQwj6e', NULL, '205.210.31.106', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzhXcXpaQVhNSkowQUxjYzRmUUh0cU51RnlnempRMnBxNThDcklXVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly92ZWhpY2xlbWFuYWdlbWVudC5uaWhhbHBhdGhpcmdlLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748298522),
('htOXtm86LIIVfoTHdWJRP3CwjUVtcCUCIBEgnxOz', NULL, '205.210.31.58', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlBLZGc0UzhINkl5ODdiRnNCTjdIc0xJZkVqcGd1ZGgzYWhiblJkRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly93d3cudmVoaWNsZW1hbmFnZW1lbnQubmloYWxwYXRoaXJnZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748364729),
('IRRjwEb6E4bjg8OSe3OTE58nd826KzQpXVxIcrop', NULL, '198.235.24.76', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1BhVDR6OFdjQ3hXbmV0R3lnV1VRWDAzUVl2b0JJZkdiQUt2aTBJbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vdmVoaWNsZW1hbmFnZW1lbnQubmloYWxwYXRoaXJnZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748309070),
('ixmg3rPXKHW2y7Q0Z5OdnyU8B5pU3TpYLR0qxWWw', NULL, '45.148.10.248', 'Mozilla/5.0 (Linux; Android 4.4.4; Nexus 7 Build/KTU84P) AppleWebKit/537.36 (KHTML like Gecko) Chrome/36.0.1985.135 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0UyMGtqdFhwdWV4TkpQYUo1ZzBOdmd4ZlZacUMybHAxTWxLdUpKZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vdmVoaWNsZW1hbmFnZW1lbnQubmloYWxwYXRoaXJnZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748355911),
('JedBzhN2E9FSkaHf9sqTxEvFHLmRO44WkxCtWeit', NULL, '13.37.105.22', 'Mozilla/5.0 (Linux; Android 7.0; SM-G892A Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/60.0.3112.107 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHhmODAycXBjcXozcU9uWGlOcHZLaURiY3lUMmR4bFZZR0lMSXJGUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly92ZWhpY2xlbWFuYWdlbWVudC5uaWhhbHBhdGhpcmdlLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748352980),
('l2bbdO0Y7xd5z1ZiZw3QbaqD3bWZc0VybmBSxEEN', NULL, '147.185.132.111', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHhPMzg0QjBERk9jQ01XMnpsajd1OExUd3ZOVGdRS1ZzYnlyNlRLUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vd3d3LnZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748294722),
('PmvbfAarXQJDF5jRueJJbL0Sv8nqzpr2TybkggR0', 1, '124.43.249.170', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTVVlZ0g5cHVrdlhMWTVBQ2hRYmRjTVZoS2ZzOEZYRWRnVDhqNU55aCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUzOiJodHRwczovL3ZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1747916583),
('qlx62yC4edwf9RYiOk5Jo3xRQJRzuUaSkGRyzenY', 1, '124.43.249.170', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZkE0cjJuVzh6cUJlbkhpb2d1ZTdVMnZENXAzWHg1S2dSeWRSbHRXaCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUzOiJodHRwczovL3ZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1747902678),
('rjnYh115zhfZIjDzIeUNaNAGQHZwlNEpCtzPPdtW', 1, '124.43.249.170', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZnYxOEx0TG95R1k3UTRyc2lRQnpMU0praG1BbEI4VGdGTGZuWGdtRSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjU3OiJodHRwczovL3ZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tL21haW50YWluYW5jZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1747823627),
('RzbOL82Lj1on4z7Gke3QdbRP59jpfw4fVYDgwNh9', NULL, '44.203.78.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRE9COHQxM2Y5SnhhZTdSQUo2c1JET0dDT3VtbGlJV1NlTEhNMlpUQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vd3d3LnZlaGljbGVtYW5hZ2VtZW50Lm5paGFscGF0aGlyZ2UuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748187883),
('ufxLVnOwLPqEqBB1jgJ00PP3KdwTdiNHbLAN7l2m', NULL, '10.55.8.135', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWjBUSnRUdmZ5enRaVzQ5b1FZZVFHNzZ1Y1B2Q3VZWDRXSGdFeno5cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly93d3cudmVoaWNsZW1hbmFnZW1lbnQubmloYWxwYXRoaXJnZS5jb20iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1748187884);

-- --------------------------------------------------------

--
-- Table structure for table `travel_records`
--

CREATE TABLE `travel_records` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `driver_name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `start_location` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `end_location` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `distance` decimal(8,2) DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Amika', 'amixx2005@gmail.com', NULL, '$2y$12$A5T1AOGqf65Z0tPwdxj2j.cYGqXzFqUp6RZFSsOvRSB/CesHq9YZm', NULL, '2025-04-23 03:07:49', '2025-04-23 03:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_plate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `license_expiration_date` date DEFAULT NULL,
  `insurance_expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `make`, `model`, `year`, `color`, `license_plate`, `type`, `status`, `created_at`, `updated_at`, `license_expiration_date`, `insurance_expiration_date`) VALUES
(1, 'Toyota', 'Prius', '2014', 'Black', 'CAB-2916', 'car', 'available', '2025-04-23 03:10:00', '2025-04-23 03:10:00', NULL, NULL),
(2, 'Land Rover', 'Defender', '1985', 'White', '40-9106', 'other', 'available', '2025-04-23 03:10:46', '2025-04-23 03:10:46', NULL, NULL),
(3, 'Land Rover', 'Discovery', '1996', 'N/A', '65-0944', 'other', 'in_service', '2025-04-23 03:11:30', '2025-04-23 03:11:40', NULL, NULL),
(4, 'Mitsubishi', 'L300', '1999', 'White', 'HN-0994', 'van', 'available', '2025-04-23 03:12:14', '2025-04-23 03:12:14', NULL, NULL),
(5, 'Toyota', 'Hilux', '1991', 'Blue', '54-5861', 'truck', 'available', '2025-04-23 03:12:44', '2025-04-23 03:12:44', NULL, NULL),
(6, 'Bajaj', 'Pulsar', '2010', 'Black', 'WF-4674', 'motor_bike', 'available', '2025-04-23 03:13:56', '2025-04-23 03:15:30', NULL, NULL),
(7, 'Hero', 'Dawn', '2013', 'Black Red', 'BAT-2289', 'motor_bike', 'available', '2025-04-23 03:14:33', '2025-04-23 03:15:16', NULL, NULL),
(8, 'Toyota', 'Corolla', '1984', 'Blue', '14-3388', 'car', 'available', '2025-04-23 03:14:58', '2025-04-23 03:14:58', NULL, NULL),
(9, 'Bajaj', 'CT100', '2006', 'Red', 'TJ-8861', 'motor_bike', 'available', '2025-04-23 03:16:25', '2025-04-23 03:16:25', NULL, NULL),
(10, 'Honda', 'Dio', '2017', 'White Blue', 'BFZ-0471', 'motor_bike', 'available', '2025-04-23 03:17:26', '2025-04-23 03:17:26', NULL, NULL),
(11, 'Honda', 'Dio', '2017', 'Red', 'BEX-0874', 'motor_bike', 'available', '2025-04-23 03:17:58', '2025-04-23 03:17:58', NULL, NULL),
(12, 'Piaggio', 'APE', '2017', 'Black', 'ABQ-7722', 'other', 'available', '2025-04-23 03:18:35', '2025-04-23 03:18:35', NULL, NULL),
(13, 'Piaggio', 'APE', '2012', 'Red', 'YW-8764', 'other', 'available', '2025-04-23 03:18:57', '2025-04-23 03:18:57', NULL, NULL),
(14, 'Tractor', 'Tractor', '2000', 'N/A', 'Tractor', 'other', 'available', '2025-04-23 03:22:32', '2025-04-23 03:22:59', NULL, NULL),
(15, 'Isuzu', 'Lorry', '1979', 'White', '28-9319', 'truck', 'available', '2025-04-23 03:23:37', '2025-04-23 03:23:37', NULL, NULL),
(16, 'Escavator', 'Escavator', '2000', 'Yellow', 'Escavator', 'other', 'available', '2025-04-23 03:24:25', '2025-04-23 03:24:25', NULL, NULL),
(17, 'TVS', 'StarCity', '2003', 'Purple', 'MP-9520', 'motor_bike', 'available', '2025-04-23 03:26:08', '2025-04-23 03:26:08', NULL, NULL),
(18, 'Micro', 'Panda', '2000', 'White', 'CAX-4919', 'car', 'available', '2025-04-23 03:29:36', '2025-04-23 03:29:36', NULL, NULL),
(19, 'Suzuki', 'WagonR', '2014', 'White', 'CBC-2445', 'car', 'available', '2025-04-23 03:30:52', '2025-04-23 03:30:52', NULL, NULL),
(20, 'Suzuki', 'WagonR', '2014', 'White', 'CBC-2465', 'car', 'available', '2025-04-23 03:31:22', '2025-04-23 03:31:22', NULL, NULL),
(21, 'Suzuki', 'WagonR', '2014', 'White', 'CAL-7628', 'car', 'available', '2025-04-23 03:31:48', '2025-04-23 03:31:48', NULL, NULL),
(25, 'Bike', 'Bike', '2000', 'N/A', 'YW-4674', 'motor_bike', 'available', '2025-05-01 22:10:59', '2025-05-01 22:10:59', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintainances`
--
ALTER TABLE `maintainances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintainances_car_id_foreign` (`vehicle_id`);

--
-- Indexes for table `meter_reads`
--
ALTER TABLE `meter_reads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `travel_records`
--
ALTER TABLE `travel_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `travel_records_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_license_plate_unique` (`license_plate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintainances`
--
ALTER TABLE `maintainances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `meter_reads`
--
ALTER TABLE `meter_reads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `travel_records`
--
ALTER TABLE `travel_records`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maintainances`
--
ALTER TABLE `maintainances`
  ADD CONSTRAINT `maintainances_car_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
