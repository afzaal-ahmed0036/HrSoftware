-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2022 at 11:55 PM
-- Server version: 5.7.23-23
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `extbooks_ext_hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(8) NOT NULL,
  `FullName` varchar(75) DEFAULT NULL,
  `Email` varchar(75) DEFAULT NULL,
  `Password` varchar(55) DEFAULT NULL,
  `Active` varchar(10) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FullName`, `Email`, `Password`, `Active`) VALUES
(1, 'Kashif', 'kashif@inu.edu.pk', '123456', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `allowance_list`
--

CREATE TABLE `allowance_list` (
  `AllowanceListID` int(8) NOT NULL,
  `AllowanceTitle` varchar(75) DEFAULT NULL,
  `AllowanceType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance_list`
--

INSERT INTO `allowance_list` (`AllowanceListID`, `AllowanceTitle`, `AllowanceType`) VALUES
(1, 'Basic Salary', 'Basic'),
(2, 'Home Rent Allowance', 'Allowance'),
(3, 'Transport Allowance', 'Allowance'),
(4, 'Other Allowance', 'Other'),
(5, 'Increment', 'Salary'),
(14, 'Bonus/Comission', 'Bonus');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `EmployeeID` int(11) NOT NULL,
  `EmployeeName` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Department` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateTime` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `EmployeeID`, `EmployeeName`, `Department`, `Status`, `DateTime`, `created_at`, `updated_at`) VALUES
(1066, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-01 08:47:18', NULL, NULL),
(1067, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:15:18', NULL, NULL),
(1068, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:15:22', NULL, NULL),
(1069, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-02 08:37:21', NULL, NULL),
(1070, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:08:47', NULL, NULL),
(1071, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-03 08:39:35', NULL, NULL),
(1072, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-04 08:28:31', NULL, NULL),
(1073, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-04 20:52:39', NULL, NULL),
(1074, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:10:52', NULL, NULL),
(1075, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:06:30', NULL, NULL),
(1076, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:10:03', NULL, NULL),
(1077, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:01:57', NULL, NULL),
(1078, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:16:51', NULL, NULL),
(1079, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-09 08:57:58', NULL, NULL),
(1080, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:12:33', NULL, NULL),
(1081, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-09 19:12:43', NULL, NULL),
(1082, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:07:38', NULL, NULL),
(1083, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-11 08:45:05', NULL, NULL),
(1084, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:15:20', NULL, NULL),
(1085, 41, 'MBARAK', 'FCB/SIMBA', 'Check-in', '2021-08-12 09:55:23', NULL, NULL),
(1086, 41, 'MBARAK', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:13:00', NULL, NULL),
(1087, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-01 08:57:31', NULL, NULL),
(1088, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:15:03', NULL, NULL),
(1089, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:15:12', NULL, NULL),
(1090, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:03:52', NULL, NULL),
(1091, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:08:14', NULL, NULL),
(1092, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:08:25', NULL, NULL),
(1093, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:08:29', NULL, NULL),
(1094, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:08:43', NULL, NULL),
(1095, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:02:47', NULL, NULL),
(1096, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:13:15', NULL, NULL),
(1097, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:00:38', NULL, NULL),
(1098, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:06:43', NULL, NULL),
(1099, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:06:50', NULL, NULL),
(1100, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-06 13:54:08', NULL, NULL),
(1101, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-06 20:01:09', NULL, NULL),
(1102, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-08 08:56:13', NULL, NULL),
(1103, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:11:58', NULL, NULL),
(1104, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:01:59', NULL, NULL),
(1105, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:12:46', NULL, NULL),
(1106, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-10 08:57:14', NULL, NULL),
(1107, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:02:11', NULL, NULL),
(1108, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:15:09', NULL, NULL),
(1109, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:15:16', NULL, NULL),
(1110, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-12 09:01:21', NULL, NULL),
(1111, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:15:22', NULL, NULL),
(1112, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-16 08:57:50', NULL, NULL),
(1113, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-16 19:01:52', NULL, NULL),
(1114, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-17 08:49:57', NULL, NULL),
(1115, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-17 19:02:14', NULL, NULL),
(1116, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-in', '2021-08-18 08:53:59', NULL, NULL),
(1117, 42, 'AFSHAN', 'FCB/SIMBA', 'Check-out', '2021-08-18 19:05:20', NULL, NULL),
(1118, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:34:56', NULL, NULL),
(1119, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:01:21', NULL, NULL),
(1120, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:50:19', NULL, NULL),
(1121, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:37:35', NULL, NULL),
(1122, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:10:58', NULL, NULL),
(1123, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:36:35', NULL, NULL),
(1124, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:02:04', NULL, NULL),
(1125, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:37:50', NULL, NULL),
(1126, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:02:24', NULL, NULL),
(1127, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-06 13:44:28', NULL, NULL),
(1128, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-06 20:01:17', NULL, NULL),
(1129, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:25:48', NULL, NULL),
(1130, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:05:07', NULL, NULL),
(1131, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:47:57', NULL, NULL),
(1132, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:48:11', NULL, NULL),
(1133, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:02:38', NULL, NULL),
(1134, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:24:58', NULL, NULL),
(1135, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-10 19:08:35', NULL, NULL),
(1136, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:32:12', NULL, NULL),
(1137, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:07:55', NULL, NULL),
(1138, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:41:12', NULL, NULL),
(1139, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-16 19:01:37', NULL, NULL),
(1140, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-17 09:45:00', NULL, NULL),
(1141, 43, 'HALEN', 'FCB/SIMBA', 'Check-out', '2021-08-17 19:09:49', NULL, NULL),
(1142, 43, 'HALEN', 'FCB/SIMBA', 'Check-in', '2021-08-18 09:45:47', NULL, NULL),
(1143, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:12:15', NULL, NULL),
(1144, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-01 18:52:15', NULL, NULL),
(1145, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:20:48', NULL, NULL),
(1146, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:06:06', NULL, NULL),
(1147, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:06:35', NULL, NULL),
(1148, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:02:49', NULL, NULL),
(1149, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:21:33', NULL, NULL),
(1150, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-04 18:55:34', NULL, NULL),
(1151, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:11:45', NULL, NULL),
(1152, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-05 18:56:05', NULL, NULL),
(1153, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:33:47', NULL, NULL),
(1154, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-08 18:55:37', NULL, NULL),
(1155, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-09 10:03:50', NULL, NULL),
(1156, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:02:31', NULL, NULL),
(1157, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:25:12', NULL, NULL),
(1158, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-10 18:59:25', NULL, NULL),
(1159, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:48:03', NULL, NULL),
(1160, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:08:00', NULL, NULL),
(1161, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-12 08:43:28', NULL, NULL),
(1162, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-12 18:59:39', NULL, NULL),
(1163, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:11:56', NULL, NULL),
(1164, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-16 18:56:17', NULL, NULL),
(1165, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-17 08:50:14', NULL, NULL),
(1166, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-17 19:20:16', NULL, NULL),
(1167, 44, 'KARL', 'FCB/SIMBA', 'Check-in', '2021-08-18 08:59:16', NULL, NULL),
(1168, 44, 'KARL', 'FCB/SIMBA', 'Check-out', '2021-08-18 18:56:13', NULL, NULL),
(1169, 45, 'OLIVE', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:43:52', NULL, NULL),
(1170, 45, 'OLIVE', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:26:53', NULL, NULL),
(1171, 45, 'OLIVE', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:55:33', NULL, NULL),
(1172, 45, 'OLIVE', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:08:18', NULL, NULL),
(1173, 45, 'OLIVE', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:08:23', NULL, NULL),
(1174, 45, 'OLIVE', 'FCB/SIMBA', 'Check-in', '2021-08-06 14:31:24', NULL, NULL),
(1175, 45, 'OLIVE', 'FCB/SIMBA', 'Check-in', '2021-08-06 14:31:33', NULL, NULL),
(1176, 45, 'OLIVE', 'FCB/SIMBA', 'Check-out', '2021-08-06 16:34:51', NULL, NULL),
(1177, 45, 'OLIVE', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:55:25', NULL, NULL),
(1178, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:03:14', NULL, NULL),
(1179, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:03:18', NULL, NULL),
(1180, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:40:15', NULL, NULL),
(1181, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:05:07', NULL, NULL),
(1182, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:45:15', NULL, NULL),
(1183, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:05:21', NULL, NULL),
(1184, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:05:26', NULL, NULL),
(1185, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:31:59', NULL, NULL),
(1186, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:10:30', NULL, NULL),
(1187, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:10:35', NULL, NULL),
(1188, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:57:54', NULL, NULL),
(1189, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:07:04', NULL, NULL),
(1190, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:39:04', NULL, NULL),
(1191, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:07:29', NULL, NULL),
(1192, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-09 11:51:06', NULL, NULL),
(1193, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:17:46', NULL, NULL),
(1194, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:40:30', NULL, NULL),
(1195, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:43:18', NULL, NULL),
(1196, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:43:24', NULL, NULL),
(1197, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-in', '2021-08-12 09:39:23', NULL, NULL),
(1198, 47, 'SYLVERINE', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:07:03', NULL, NULL),
(1199, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:34:07', NULL, NULL),
(1200, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:47:50', NULL, NULL),
(1201, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:24:50', NULL, NULL),
(1202, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-out', '2021-08-10 20:07:57', NULL, NULL),
(1203, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:43:27', NULL, NULL),
(1204, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:07:47', NULL, NULL),
(1205, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-in', '2021-08-16 10:30:49', NULL, NULL),
(1206, 48, 'IFTIKHAR', 'FCB/SIMBA', 'Check-in', '2021-08-17 09:19:40', NULL, NULL),
(1207, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:43:44', NULL, NULL),
(1208, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:43:49', NULL, NULL),
(1209, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:02:40', NULL, NULL),
(1210, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:43:51', NULL, NULL),
(1211, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:14:21', NULL, NULL),
(1212, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:14:25', NULL, NULL),
(1213, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:41:03', NULL, NULL),
(1214, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:21:01', NULL, NULL),
(1215, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:38:41', NULL, NULL),
(1216, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:41:52', NULL, NULL),
(1217, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:01:15', NULL, NULL),
(1218, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:36:58', NULL, NULL),
(1219, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:19:01', NULL, NULL),
(1220, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:41:26', NULL, NULL),
(1221, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-12 11:17:35', NULL, NULL),
(1222, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:12:01', NULL, NULL),
(1223, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:45:03', NULL, NULL),
(1224, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-17 09:29:09', NULL, NULL),
(1225, 49, 'KAMAL', 'FCB/SIMBA', 'Check-in', '2021-08-18 09:39:11', NULL, NULL),
(1226, 49, 'KAMAL', 'FCB/SIMBA', 'Check-out', '2021-08-18 19:11:16', NULL, NULL),
(1227, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-01 10:00:00', NULL, NULL),
(1228, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:07:14', NULL, NULL),
(1229, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:51:20', NULL, NULL),
(1230, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:55:45', NULL, NULL),
(1231, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:05:30', NULL, NULL),
(1232, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:52:41', NULL, NULL),
(1233, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:10:43', NULL, NULL),
(1234, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:57:33', NULL, NULL),
(1235, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:10:07', NULL, NULL),
(1236, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:55:19', NULL, NULL),
(1237, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:55:22', NULL, NULL),
(1238, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:28:08', NULL, NULL),
(1239, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:53:18', NULL, NULL),
(1240, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:50:39', NULL, NULL),
(1241, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-10 19:06:03', NULL, NULL),
(1242, 50, 'YASHA', 'FCB/SIMBA', 'Overtime-Out', '2021-08-11 09:53:41', NULL, NULL),
(1243, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:53:45', NULL, NULL),
(1244, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:09:56', NULL, NULL),
(1245, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-12 10:02:30', NULL, NULL),
(1246, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:03:10', NULL, NULL),
(1247, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-17 19:42:21', NULL, NULL),
(1248, 50, 'YASHA', 'FCB/SIMBA', 'Check-in', '2021-08-18 10:02:23', NULL, NULL),
(1249, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-18 19:05:13', NULL, NULL),
(1250, 50, 'YASHA', 'FCB/SIMBA', 'Check-out', '2021-08-18 19:05:16', NULL, NULL),
(1251, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:53:44', NULL, NULL),
(1252, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:53:49', NULL, NULL),
(1253, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:53:54', NULL, NULL),
(1254, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:07:08', NULL, NULL),
(1255, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:07:29', NULL, NULL),
(1256, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:50:10', NULL, NULL),
(1257, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:06:42', NULL, NULL),
(1258, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:52:24', NULL, NULL),
(1259, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:45:56', NULL, NULL),
(1260, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:04:57', NULL, NULL),
(1261, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:51:56', NULL, NULL),
(1262, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:06:55', NULL, NULL),
(1263, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:06:59', NULL, NULL),
(1264, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-06 13:36:30', NULL, NULL),
(1265, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-06 19:03:22', NULL, NULL),
(1266, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:47:38', NULL, NULL),
(1267, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:47:43', NULL, NULL),
(1268, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:05:00', NULL, NULL),
(1269, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:47:40', NULL, NULL),
(1270, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:07:41', NULL, NULL),
(1271, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:48:36', NULL, NULL),
(1272, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:08:25', NULL, NULL),
(1273, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-12 09:56:26', NULL, NULL),
(1274, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:01:15', NULL, NULL),
(1275, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:48:42', NULL, NULL),
(1276, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-16 19:05:44', NULL, NULL),
(1277, 51, 'PALLAVI', 'FCB/SIMBA', 'Overtime-Out', '2021-08-17 19:05:12', NULL, NULL),
(1278, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-in', '2021-08-18 09:44:54', NULL, NULL),
(1279, 51, 'PALLAVI', 'FCB/SIMBA', 'Check-out', '2021-08-18 19:03:33', NULL, NULL),
(1280, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:53:57', NULL, NULL),
(1281, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:49:31', NULL, NULL),
(1282, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:49:34', NULL, NULL),
(1283, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:34:08', NULL, NULL),
(1284, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:31:09', NULL, NULL),
(1285, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:26:42', NULL, NULL),
(1286, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:26:45', NULL, NULL),
(1287, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-03 20:06:51', NULL, NULL),
(1288, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:41:02', NULL, NULL),
(1289, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-06 14:31:35', NULL, NULL),
(1290, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-06 20:31:41', NULL, NULL),
(1291, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-06 20:31:46', NULL, NULL),
(1292, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-06 20:31:48', NULL, NULL),
(1293, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-06 20:31:51', NULL, NULL),
(1294, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:25:28', NULL, NULL),
(1295, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:25:37', NULL, NULL),
(1296, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:23:19', NULL, NULL),
(1297, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:23:21', NULL, NULL),
(1298, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-09 20:03:08', NULL, NULL),
(1299, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-09 20:03:12', NULL, NULL),
(1300, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-10 11:42:10', NULL, NULL),
(1301, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-10 19:45:48', NULL, NULL),
(1302, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-10 19:45:50', NULL, NULL),
(1303, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:38:12', NULL, NULL),
(1304, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:38:14', NULL, NULL),
(1305, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-12 09:39:28', NULL, NULL),
(1306, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-12 09:39:32', NULL, NULL),
(1307, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:17:59', NULL, NULL),
(1308, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:18:02', NULL, NULL),
(1309, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:18:04', NULL, NULL),
(1310, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:18:07', NULL, NULL),
(1311, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:31:07', NULL, NULL),
(1312, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-16 19:35:23', NULL, NULL),
(1313, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-17 20:11:38', NULL, NULL),
(1314, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-17 20:11:43', NULL, NULL),
(1315, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-in', '2021-08-18 10:00:11', NULL, NULL),
(1316, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-18 20:14:58', NULL, NULL),
(1317, 52, 'SAMUEL', 'FCB/SIMBA', 'Check-out', '2021-08-18 20:15:00', NULL, NULL),
(1318, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-01 09:47:12', NULL, NULL),
(1319, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:49:53', NULL, NULL),
(1320, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:57:48', NULL, NULL),
(1321, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:30:56', NULL, NULL),
(1322, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:31:05', NULL, NULL),
(1323, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:44:53', NULL, NULL),
(1324, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-03 20:06:46', NULL, NULL),
(1325, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:43:29', NULL, NULL),
(1326, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:47:42', NULL, NULL),
(1327, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:49:08', NULL, NULL),
(1328, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:12:04', NULL, NULL),
(1329, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-06 14:30:44', NULL, NULL),
(1330, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-06 20:31:37', NULL, NULL),
(1331, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:57:50', NULL, NULL),
(1332, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:25:42', NULL, NULL),
(1333, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:48:35', NULL, NULL),
(1334, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-09 20:03:06', NULL, NULL),
(1335, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-09 20:03:54', NULL, NULL),
(1336, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:44:06', NULL, NULL),
(1337, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-10 19:33:16', NULL, NULL),
(1338, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-11 13:29:35', NULL, NULL),
(1339, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-11 13:29:40', NULL, NULL),
(1340, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:23:44', NULL, NULL),
(1341, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-16 10:03:00', NULL, NULL),
(1342, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-17 09:59:37', NULL, NULL),
(1343, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-17 20:11:34', NULL, NULL),
(1344, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-17 20:11:47', NULL, NULL),
(1345, 53, 'PETER', 'FCB/SIMBA', 'Check-in', '2021-08-18 09:59:15', NULL, NULL),
(1346, 53, 'PETER', 'FCB/SIMBA', 'Check-out', '2021-08-18 20:13:29', NULL, NULL),
(1347, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-01 18:31:21', NULL, NULL),
(1348, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:28:47', NULL, NULL),
(1349, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-02 18:37:50', NULL, NULL),
(1350, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-03 10:48:07', NULL, NULL),
(1351, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:36:02', NULL, NULL),
(1352, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:38:38', NULL, NULL),
(1353, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:27:16', NULL, NULL),
(1354, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-05 18:36:12', NULL, NULL),
(1355, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:38:28', NULL, NULL),
(1356, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:28:19', NULL, NULL),
(1357, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-09 18:36:30', NULL, NULL),
(1358, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:38:41', NULL, NULL),
(1359, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-10 18:33:51', NULL, NULL),
(1360, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:34:41', NULL, NULL),
(1361, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:33:11', NULL, NULL),
(1362, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-16 18:30:06', NULL, NULL),
(1363, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-17 18:32:23', NULL, NULL),
(1364, 56, 'NASSIR', 'FCB/SIMBA', 'Check-in', '2021-08-18 09:25:52', NULL, NULL),
(1365, 56, 'NASSIR', 'FCB/SIMBA', 'Check-out', '2021-08-18 18:35:38', NULL, NULL),
(1366, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:43:47', NULL, NULL),
(1367, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:22:02', NULL, NULL),
(1368, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:27:30', NULL, NULL),
(1369, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:30:13', NULL, NULL),
(1370, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:50:20', NULL, NULL),
(1371, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:33:20', NULL, NULL),
(1372, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:40:14', NULL, NULL),
(1373, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:27:09', NULL, NULL),
(1374, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-05 09:27:13', NULL, NULL),
(1375, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-05 19:09:33', NULL, NULL),
(1376, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-06 15:04:22', NULL, NULL),
(1377, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-06 21:03:12', NULL, NULL),
(1378, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:35:44', NULL, NULL),
(1379, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:11:38', NULL, NULL),
(1380, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:11:52', NULL, NULL),
(1381, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:24:47', NULL, NULL),
(1382, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-09 20:03:46', NULL, NULL),
(1383, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-09 20:03:50', NULL, NULL),
(1384, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:25:24', NULL, NULL),
(1385, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-11 09:29:07', NULL, NULL),
(1386, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-11 21:05:16', NULL, NULL),
(1387, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:39:43', NULL, NULL),
(1388, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-16 19:35:09', NULL, NULL),
(1389, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-16 19:35:21', NULL, NULL),
(1390, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-17 09:42:07', NULL, NULL),
(1391, 60, 'AYAH', 'FCB/SIMBA', 'Check-in', '2021-08-17 09:44:50', NULL, NULL),
(1392, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-17 20:14:55', NULL, NULL),
(1393, 60, 'AYAH', 'FCB/SIMBA', 'Check-out', '2021-08-18 20:00:58', NULL, NULL),
(1394, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-01 19:01:13', NULL, NULL),
(1395, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-02 09:39:15', NULL, NULL),
(1396, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-02 19:02:11', NULL, NULL),
(1397, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-03 09:34:23', NULL, NULL),
(1398, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-03 19:01:58', NULL, NULL),
(1399, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-04 09:39:28', NULL, NULL),
(1400, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:10:48', NULL, NULL),
(1401, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-04 19:10:51', NULL, NULL),
(1402, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-06 13:44:20', NULL, NULL),
(1403, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-08 09:46:35', NULL, NULL),
(1404, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:01:07', NULL, NULL),
(1405, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:01:12', NULL, NULL),
(1406, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-08 19:01:58', NULL, NULL),
(1407, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-09 09:48:14', NULL, NULL),
(1408, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-09 19:00:30', NULL, NULL),
(1409, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-10 09:56:45', NULL, NULL),
(1410, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-10 19:00:18', NULL, NULL),
(1411, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-11 10:11:17', NULL, NULL),
(1412, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-11 19:50:35', NULL, NULL),
(1413, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-12 09:35:37', NULL, NULL),
(1414, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-12 19:08:36', NULL, NULL),
(1415, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-16 09:49:59', NULL, NULL),
(1416, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-16 20:10:34', NULL, NULL),
(1417, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-17 09:38:41', NULL, NULL),
(1418, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-17 20:01:07', NULL, NULL),
(1419, 61, 'RAJ', 'FCB/SIMBA', 'Check-in', '2021-08-18 09:50:13', NULL, NULL),
(1420, 61, 'RAJ', 'FCB/SIMBA', 'Check-out', '2021-08-18 19:10:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BranchID` int(8) NOT NULL,
  `BranchName` varchar(150) DEFAULT NULL,
  `BranchContact` varchar(50) DEFAULT NULL,
  `BranchEmail` varchar(50) DEFAULT NULL,
  `BranchAddress` varchar(150) DEFAULT NULL,
  `BranchLogo` varchar(50) DEFAULT NULL,
  `CreatedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BranchID`, `BranchName`, `BranchContact`, `BranchEmail`, `BranchAddress`, `BranchLogo`, `CreatedDate`, `UpdatedDate`) VALUES
(2, 'Allianz Marketing Management', '+971551923008', 'hr@fcb.ae', 'Clover bay Tower Office #1212', '1667395197.jpg', '2022-11-02 13:19:57', '2022-11-02 13:19:57'),
(3, 'Grand Alliance Commercial Brokerage LLC', '045693717', 'hr@fcb.ae', 'Office No 303, Marasi Drive, Clover Bay Tower', '1667471486.jpg', '2022-11-03 10:31:26', NULL),
(4, 'Friends Marketing Management', '047170220', 'hr@fcb.ae', 'Clover Bay Tower, Office No 1807', '1667478735.jpg', '2022-11-03 12:32:15', NULL),
(5, 'Extensive IT Services', '047170220', 'hr@fcb.ae', 'Clover Bay Tower, Office No 1807', '1667478819.jpg', '2022-11-03 12:33:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(8) NOT NULL,
  `AID` int(12) DEFAULT NULL,
  `EmployeeID` int(8) DEFAULT NULL,
  `FTDAmount` int(12) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Compliant` varchar(25) DEFAULT NULL,
  `KYCSent` varchar(25) DEFAULT NULL,
  `DailerList` int(10) DEFAULT NULL,
  `UpdateBy` varchar(30) DEFAULT NULL,
  `UDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CompanyID` int(8) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `Name2` varchar(255) DEFAULT NULL,
  `TRN` varchar(150) DEFAULT NULL COMMENT 'tax registration no',
  `Currency` varchar(3) DEFAULT NULL,
  `Mobile` varchar(75) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Logo` varchar(255) DEFAULT NULL,
  `BackgroundLogo` varchar(255) DEFAULT NULL,
  `CreatedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Signature` varchar(255) DEFAULT NULL,
  `DigitalSignature` varchar(255) DEFAULT NULL,
  `EstimateInvoiceTitle` varchar(150) DEFAULT NULL,
  `SaleInvoiceTitle` varchar(150) DEFAULT NULL,
  `DeliveryChallanTitle` varchar(150) DEFAULT NULL,
  `CreditNoteTitle` varchar(150) DEFAULT NULL,
  `PurchaseInvoiceTitle` varchar(150) DEFAULT NULL,
  `DebitNoteTitle` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyID`, `Name`, `Name2`, `TRN`, `Currency`, `Mobile`, `Contact`, `Email`, `Website`, `Address`, `Logo`, `BackgroundLogo`, `CreatedDate`, `UpdatedDate`, `Signature`, `DigitalSignature`, `EstimateInvoiceTitle`, `SaleInvoiceTitle`, `DeliveryChallanTitle`, `CreditNoteTitle`, `PurchaseInvoiceTitle`, `DebitNoteTitle`) VALUES
(1, 'Allianz Marketing', 'Dubai', '123456789', 'AED', NULL, '+923349047993', 'info@eis.ae', 'www.eits.ae', 'Office #1807 Clover Bay Tower, Business Bay - Dubai', '1667396915.png', '1667396915.png', '2022-11-02 13:48:35', '2022-11-02 13:48:35', '1667375740.png', '<h2><strong>Finance Director,</strong></h2>\r\n\r\n<p><strong>Kashif</strong></p>', 'Quotation', 'Sale Inoice by', 'Delivery Note', 'Credit Note', 'Purchase Bill', 'Debit Note');

-- --------------------------------------------------------

--
-- Table structure for table `deduction_list`
--

CREATE TABLE `deduction_list` (
  `DeductionListID` int(8) NOT NULL,
  `DeductionTitle` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(8) NOT NULL,
  `DepartmentName` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `DepartmentName`) VALUES
(2, 'Sales'),
(4, 'Finance'),
(40, 'HR'),
(41, 'Admin'),
(42, 'Marketing'),
(43, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `DocumentID` int(10) NOT NULL,
  `DocumentCategoryID` int(12) DEFAULT NULL,
  `EmployeeID` int(10) DEFAULT NULL,
  `FileName` varchar(55) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `Cost` varchar(55) DEFAULT '',
  `File` varchar(55) DEFAULT NULL,
  `FileSize` varchar(12) DEFAULT NULL,
  `MimeType` varchar(55) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`DocumentID`, `DocumentCategoryID`, `EmployeeID`, `FileName`, `StartDate`, `ExpiryDate`, `Cost`, `File`, `FileSize`, `MimeType`, `eDate`) VALUES
(40, 1, NULL, 'new document', '2002-12-12', '2006-12-12', '125', '1667021325.jpg', '212.72 KB', 'image', '2022-10-29 05:28:45'),
(45, NULL, 117, 'Passport', NULL, NULL, '', '1667469844.pdf', '239.33 KB', NULL, '2022-11-03 10:04:04'),
(46, NULL, 117, 'Visa', NULL, NULL, '', '1667469947.pdf', '144.31 KB', NULL, '2022-11-03 10:05:47'),
(47, NULL, 117, 'CV', NULL, NULL, '', '1667469965.pdf', '196.21 KB', NULL, '2022-11-03 10:06:05'),
(48, NULL, 117, 'test', NULL, NULL, '', '1667470062.jpg', '32.51 KB', NULL, '2022-11-03 10:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `document_category`
--

CREATE TABLE `document_category` (
  `DocumentCategoryID` int(8) NOT NULL,
  `DocumentCategoryName` varchar(175) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_category`
--

INSERT INTO `document_category` (`DocumentCategoryID`, `DocumentCategoryName`, `eDate`) VALUES
(1, 'Office Document', '2022-10-27 02:07:40'),
(2, 'Staff Document', '2022-10-27 02:07:43'),
(3, 'Vehicle Document', '2022-10-27 02:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `educationlevel`
--

CREATE TABLE `educationlevel` (
  `EducationLevelID` int(8) NOT NULL,
  `EducationLevelName` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educationlevel`
--

INSERT INTO `educationlevel` (`EducationLevelID`, `EducationLevelName`) VALUES
(1, 'FA/FSC '),
(2, 'Bachelor'),
(3, 'Master'),
(4, 'MS/MPIL/PHD');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(8) NOT NULL,
  `BranchID` int(8) DEFAULT NULL,
  `Title` varchar(75) DEFAULT NULL,
  `IsSupervisor` varchar(3) DEFAULT NULL,
  `FirstName` varchar(88) DEFAULT NULL,
  `MiddleName` varchar(88) DEFAULT NULL,
  `LastName` varchar(88) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `VisaIssueDate` date DEFAULT NULL,
  `VisaExpiryDate` date DEFAULT NULL,
  `PassportNo` varchar(88) DEFAULT NULL,
  `PassportExpiry` date DEFAULT NULL,
  `EidNo` varchar(75) DEFAULT NULL,
  `EidExpiry` date DEFAULT NULL,
  `FullAddress` varchar(255) DEFAULT NULL,
  `MobileNo` varchar(35) DEFAULT NULL,
  `HomePhone` varchar(35) DEFAULT NULL,
  `Email` varchar(35) DEFAULT NULL,
  `Nationality` varchar(35) DEFAULT NULL,
  `Gender` varchar(35) DEFAULT NULL,
  `SSNorGID` varchar(35) DEFAULT NULL,
  `MaritalStatus` varchar(35) DEFAULT NULL,
  `SpouseName` varchar(50) DEFAULT NULL,
  `SpouseEmployer` varchar(52) DEFAULT NULL,
  `SpouseWorkPhone` varchar(33) DEFAULT NULL,
  `JobTitleID` varchar(33) DEFAULT NULL,
  `DepartmentID` int(8) DEFAULT NULL,
  `SupervisorID` int(8) DEFAULT NULL,
  `WorkLocation` varchar(55) DEFAULT NULL,
  `EmailOffical` varchar(55) DEFAULT NULL,
  `WorkPhone` varchar(55) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `Salary` double(10,2) DEFAULT NULL,
  `ExtraComission` double(10,2) DEFAULT NULL,
  `SalaryRemarks` longtext,
  `NextofKinName` varchar(75) DEFAULT NULL,
  `NextofKinAddress` varchar(255) DEFAULT NULL,
  `NextofKinPhone` varchar(55) DEFAULT NULL,
  `NextofKinRelationship` varchar(55) DEFAULT NULL,
  `EducationLevel` varchar(55) DEFAULT NULL,
  `LastDegree` varchar(75) DEFAULT NULL,
  `Picture` varchar(75) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `StaffType` varchar(25) DEFAULT NULL,
  `Password` varchar(25) DEFAULT '123456',
  `BankName` varchar(155) DEFAULT NULL,
  `IBAN` varchar(100) DEFAULT NULL,
  `AccountTitle` varchar(100) DEFAULT NULL,
  `SalaryType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `BranchID`, `Title`, `IsSupervisor`, `FirstName`, `MiddleName`, `LastName`, `DateOfBirth`, `VisaIssueDate`, `VisaExpiryDate`, `PassportNo`, `PassportExpiry`, `EidNo`, `EidExpiry`, `FullAddress`, `MobileNo`, `HomePhone`, `Email`, `Nationality`, `Gender`, `SSNorGID`, `MaritalStatus`, `SpouseName`, `SpouseEmployer`, `SpouseWorkPhone`, `JobTitleID`, `DepartmentID`, `SupervisorID`, `WorkLocation`, `EmailOffical`, `WorkPhone`, `StartDate`, `Salary`, `ExtraComission`, `SalaryRemarks`, `NextofKinName`, `NextofKinAddress`, `NextofKinPhone`, `NextofKinRelationship`, `EducationLevel`, `LastDegree`, `Picture`, `eDate`, `uDate`, `StaffType`, `Password`, `BankName`, `IBAN`, `AccountTitle`, `SalaryType`) VALUES
(80, 1, 'Mr.', 'Yes', 'Jude', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-16', NULL, '2001-01-01', NULL, NULL, NULL, 'kashif.mushtaq2050@gmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 109, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-09 13:38:25', '2021-12-23 13:57:33', 'Closer', '123456', NULL, NULL, NULL, NULL),
(81, 1, 'Mr.', 'Yes', 'John', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-16', NULL, '2001-01-01', NULL, NULL, NULL, 'kashif_mushtaq2008@hotmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 109, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-09 13:38:56', '2021-12-23 13:57:44', 'Closer', '123456', NULL, NULL, NULL, NULL),
(82, 1, 'Mr.', 'Yes', 'Mj', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-16', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 109, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-09 13:41:14', '2021-12-15 17:48:15', 'Closer', '123456', NULL, NULL, NULL, NULL),
(85, 1, 'Mr.', 'No', 'Jobita', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-15', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 79, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:54:39', '2021-12-15 17:48:03', 'Agent', '123456', NULL, NULL, NULL, NULL),
(86, 1, 'Mr.', 'No', 'Karen', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-15', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 80, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:55:00', '2021-12-15 17:48:04', 'Agent', '123456', NULL, NULL, NULL, NULL),
(89, 1, 'Mr.', 'No', 'Cindy', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-15', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 80, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:56:16', '2021-12-15 17:48:04', 'Agent', '123456', NULL, NULL, NULL, NULL),
(90, 1, 'Mr.', 'No', 'Gerald', NULL, 'mushtaq', '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-15', NULL, '2001-01-01', 'Kashif House, Khyber colony No 1, Tehkal Payan', '+923349047993', NULL, 'kaseeesssseehif@inu.edu.pk', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 99, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:56:44', '2021-12-15 17:48:05', 'Agent', '123456', NULL, NULL, NULL, NULL),
(92, 1, 'Mr.', 'No', 'Francis', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-15', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 79, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:57:47', '2021-12-15 17:48:05', 'Agent', '123456', NULL, NULL, NULL, NULL),
(93, 1, 'Mr.', 'No', 'Nelle', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-15', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 79, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:58:19', '2021-12-15 17:48:06', 'Agent', '123456', NULL, NULL, NULL, NULL),
(94, 1, 'Mr.', 'No', 'Jesna', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2022-01-15', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 79, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:58:41', '2021-12-15 17:48:07', 'Agent', '123456', NULL, NULL, NULL, NULL),
(95, 1, 'Mr.', 'No', 'Ashraf', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2001-01-01', NULL, '2001-01-01', NULL, NULL, NULL, 'Pakista@gmail.com', 'pakistannnn', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 81, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 02:59:01', '2021-12-14 17:31:54', 'Agent', '123456', NULL, NULL, NULL, NULL),
(97, 1, 'Mr.', 'No', 'Charissa', NULL, NULL, '2022-01-14', '2001-01-01', '2022-01-14', NULL, '2001-01-01', NULL, '2001-01-01', NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 79, NULL, NULL, NULL, '2001-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 03:00:14', '2021-12-14 17:31:55', 'Agent', '123456', NULL, NULL, NULL, NULL),
(98, 1, 'Mr.', 'No', 'April', 'nil', 'mushtaq', '2022-01-14', '2001-12-12', '2022-01-14', NULL, '2002-12-12', '111', '2001-12-12', 'Kashif House, Khyber colony No 1, Tehkal Payan', '+923349047993', '1111', 'kashif2@inu.edu.pk', 'XYZ', 'Male', '1', 'Single', '1', '1', '1', '1', 1, 80, '21', '21', '21', '2001-12-21', 25.75, 25.50, NULL, '12', '21', '21', '21', 'FA/FSC', '111', NULL, '2021-12-10 03:17:57', '2022-01-02 12:57:39', 'Agent', '12345678', NULL, NULL, NULL, NULL),
(99, 1, 'Mr.', 'Yes', 'Hillary', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, 'pl@gmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 109, NULL, NULL, NULL, '1970-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 04:37:56', '2022-11-03 07:46:06', 'Closer', '123456', NULL, NULL, NULL, NULL),
(100, 1, 'Mr.', 'No', 'Michael', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, 'k2@k.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 80, NULL, NULL, NULL, '1970-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 04:38:46', '2022-11-03 07:46:02', 'Agent', '123456', NULL, NULL, NULL, NULL),
(101, 1, 'Mr.', 'No', 'Harry', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, 'km@k.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 82, NULL, NULL, NULL, '1970-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 04:39:05', '2022-11-03 07:45:58', 'Agent', '123456', NULL, NULL, NULL, NULL),
(102, 1, 'Mr.', 'No', 'Priscillah', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, 'kllp@gmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 79, NULL, NULL, NULL, '1970-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 04:46:46', '2022-11-03 07:45:54', 'Agent', '123456', NULL, NULL, NULL, NULL),
(103, 1, 'Mr.', 'No', 'Johnson', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 81, NULL, NULL, NULL, NULL, 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 04:51:16', '2021-12-14 17:31:57', 'Agent', '123456', NULL, NULL, NULL, NULL),
(104, 1, 'Mr.', 'No', 'Tate', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, '1970-01-01', NULL, NULL, NULL, NULL, NULL, 'km@gmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, NULL, NULL, NULL, NULL, '1970-01-01', 2000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-10 04:57:52', '2022-11-03 07:45:50', 'Closer', '123456', NULL, NULL, NULL, NULL),
(107, 1, 'Mr.', 'No', 'John Bonus', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kmkdddm@gmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 81, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-12 17:10:45', '2021-12-14 17:31:58', 'Agent', '123456', NULL, NULL, NULL, NULL),
(108, 1, 'Mr.', 'No', 'Hillary Bonus', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kmkddddddm@gmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, 99, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-12 17:11:27', '2021-12-14 17:31:59', 'Agent', '123456', NULL, NULL, NULL, NULL),
(109, 1, 'Mr.', 'Yes', 'km', NULL, NULL, '2022-01-14', NULL, '2022-01-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kokok@k.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2021-12-12 17:25:29', '2021-12-14 17:32:00', 'Floor Manager', '123456', NULL, NULL, NULL, NULL),
(111, 2, 'Mr.', 'Yes', 'Syed', 'Umair', 'Alam', '1986-10-24', NULL, '1970-01-01', NULL, '1970-01-01', NULL, '1970-01-01', 'Flat No. 502, DAMAC Bay’s Edge, Marasi Dr, Business Bay, Dubai', '+971 562273539', NULL, 'syedalam2486@gmail.com', 'Pakistani', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 129, NULL, NULL, NULL, '2022-02-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, '1667460177.jpg', '2022-11-02 13:26:55', '2022-11-03 09:57:45', 'Floor Manager', '123456', NULL, NULL, NULL, NULL),
(112, 2, 'Mr.', 'No', 'Issac', NULL, 'Reigo', '1980-01-06', NULL, '1970-01-01', NULL, '1970-01-01', NULL, '1970-01-01', NULL, NULL, NULL, 'issacabc@gmail.com', 'Philippines', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-02 13:30:42', '2022-11-03 11:44:49', 'Closer', '123456', NULL, NULL, NULL, NULL),
(113, 2, 'Mr.', 'No', 'Sangeen', NULL, 'Khan', '1982-02-08', '2022-05-23', '2024-05-22', NULL, '2027-03-28', NULL, '1970-01-01', 'Deira Dubai Union metro station in day to day building', '0523239', NULL, 'sangeen34@gmail.com', 'Pakistani', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-01-04', 3000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, '1667455779.jpg', '2022-11-02 13:34:00', '2022-11-03 11:59:42', 'Agent', '123456', NULL, NULL, NULL, NULL),
(115, 2, 'Mr.', 'No', 'Muhammad', 'Eaz', 'Uddin', '1990-08-04', '2022-02-09', '2025-02-08', 'A02201487', '2031-08-11', NULL, '1970-01-01', 'Deira, Dubai', '0564865358', NULL, 'eaz.iiuc@gmail.com', 'Bangladesh', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-04-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-02 13:47:31', '2022-11-03 11:48:36', 'Closer', '123456', NULL, NULL, NULL, NULL),
(116, 2, 'Mr.', 'No', 'Muhammad', NULL, 'Amer', '1986-01-30', NULL, '1970-01-01', NULL, '1970-01-01', NULL, '1970-01-01', NULL, '+971-521816699', NULL, 'aamer.aldouri@gmail.com', NULL, 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-03-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-02 13:53:07', '2022-11-03 11:50:53', 'Agent', '123456', NULL, NULL, NULL, NULL),
(117, 2, 'Mr.', 'No', 'Abhijit', 'Yuvraj', 'Naykal', '1994-01-25', '2022-09-08', '2022-11-06', 'V6931823', '2032-03-22', NULL, '1970-01-01', 'Flat no - 1108, Building No -4,Right Medical Center, Abu Shagara,Sharjah,', '0509361920', NULL, 'abhi123naykal@gmail.com', 'India', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-10-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, '1667463765.jpg', '2022-11-03 05:17:20', '2022-11-03 11:33:32', 'Agent', '123456', NULL, NULL, NULL, NULL),
(118, 2, 'Mr.', 'No', 'Law', NULL, 'Mangate', '1992-05-12', '2022-08-29', '2022-06-12', NULL, '2022-11-02', NULL, '1970-01-01', '104 Sultana Building, Deira, Dubai', '0525489288', NULL, 'mangatelaw@gmail.com', 'Zimbabwe', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-10-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, '1667454250.png', '2022-11-03 05:29:58', '2022-11-03 11:39:14', 'Agent', '123456', NULL, NULL, NULL, NULL),
(119, 2, 'Mr.', 'No', 'Rohan', NULL, 'Laxman', '1998-02-13', '2022-06-09', '2024-06-08', NULL, '2029-09-12', '784-1998-9606943-4', '2022-06-08', 'Al ghubaiba', '0508573500', NULL, 'rohanln332@gmail.com', 'Indian', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-03-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, '1667455130.jpg', '2022-11-03 05:30:52', '2022-11-03 11:56:33', 'Agent', '123456', NULL, NULL, NULL, NULL),
(120, 2, 'Mr.', 'No', 'M.A', 'Visitacion', 'Sapitula', '1984-02-07', '2022-03-15', '2024-03-14', 'P3222881B', '2029-09-15', NULL, '1970-01-01', 'International City Dubai', '0564267699', NULL, 'vzriego@gmail.com', 'Phiiipines', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-08-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, '1667453828.jpg', '2022-11-03 05:37:08', '2022-11-03 11:43:43', 'Agent', '123456', NULL, NULL, NULL, NULL),
(121, 2, 'Mr.', 'No', 'Shrrinivasan', 'Natarajan', 'Vasudevan', '1996-08-28', '2022-04-12', '2024-11-04', 'R6702232', '2027-11-26', '784-1996-7804166-8', '2024-04-11', NULL, '0585398977', NULL, 'shrrinivas487@gmail.com', 'Indian', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2021-10-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 05:41:00', '2022-11-03 12:02:49', 'Agent', '123456', NULL, NULL, NULL, NULL),
(122, 2, 'Mr.', 'No', 'Otekpen', 'Daniel', 'Ali', '1995-07-06', '2022-03-18', '2025-03-17', NULL, '2026-08-17', NULL, '1970-01-01', NULL, '0527726099', NULL, 'Danielotekpen@gmail.com', 'Nigeria', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-10-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 05:50:38', '2022-11-03 11:55:07', 'Agent', '123456', NULL, NULL, NULL, NULL),
(123, 2, 'Ms.', 'No', 'Aisha', 'Muhammed', 'Saleem', '2003-08-08', '2021-10-19', '2022-10-18', 'T1695260', '2024-08-01', NULL, '1970-01-01', NULL, '050193 0502', NULL, 'ayeshamohd620@gmail.com', 'India', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-06-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 05:58:06', '2022-11-03 11:34:46', 'Agent', '123456', NULL, NULL, NULL, NULL),
(124, 2, 'Mr.', 'No', 'Zain', 'Muneer', 'Ahmad', '1998-12-15', '2022-05-24', '2024-05-23', 'DU0727301', '2025-10-06', '784-1998-4672468-2', '2024-05-23', NULL, NULL, NULL, 'zainmuneer777@gmail.com', 'Pakistan', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2021-12-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 06:25:37', '2022-11-03 12:01:33', 'Agent', '123456', NULL, NULL, NULL, NULL),
(125, 2, 'Mr.', 'No', 'Nauman', NULL, 'Faris', '1992-05-04', '2022-08-17', '2024-08-16', 'CS8915282', '2027-01-31', '784-1992-8910020-0', '2024-08-16', NULL, '052 348 0539', NULL, 'naumanfaris75@gmail.com', 'Pakistani', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 07:10:29', '2022-11-03 11:53:36', 'Agent', '123456', NULL, NULL, NULL, NULL),
(126, 2, 'Mr.', 'No', 'Mohd', 'Fardin', 'Sofi', '1999-10-10', '2022-10-05', '2024-10-04', 'V2988569', '2031-10-04', NULL, '1970-01-01', NULL, '0567376122', NULL, 'fardeensofi1786@gmail.com', 'Indian', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 07:23:49', '2022-11-03 11:50:04', 'Agent', '123456', NULL, NULL, NULL, NULL),
(127, 2, 'Mr.', 'No', 'Ojee', 'Ahmed', 'Sheikh', '1996-06-17', NULL, '1970-01-01', 'U3408083', '2031-07-27', NULL, '1970-01-01', NULL, '+971508982125', NULL, 'ojeeahmed@gmail.com', 'Indian', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-08-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 07:33:18', '2022-11-03 11:54:20', 'Agent', '123456', NULL, NULL, NULL, NULL),
(128, 2, 'Mr.', 'No', 'Muhammad', 'Sharukh', 'Amin', '1994-07-30', NULL, '1970-01-01', 'FR1202981', '2024-01-01', NULL, '1970-01-01', NULL, '050-3431209', NULL, 'Sshahrukh80@gmail.com', 'Pakistani', 'Male', NULL, 'Single', NULL, NULL, NULL, '1', 2, 111, NULL, NULL, NULL, '2022-07-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-03 08:27:11', '2022-11-03 11:51:37', 'Agent', '123456', NULL, NULL, NULL, NULL),
(129, 2, 'Mr.', 'Yes', 'Babar', 'Waseem', NULL, '1988-04-11', '2322-03-12', '3232-02-23', '2323232', '3232-02-23', '23232', '3232-02-23', '3123', '0504307012', '3132', 'xad@gmail.com', 'Pakistan', 'Male', NULL, 'Single', 'sdf', 'adfa', 'ada', '3', 2, NULL, NULL, NULL, NULL, '3454-04-21', 456546.00, NULL, NULL, '23232', '2323', '2323', '2323', 'FA/FSC', 'sdf', NULL, '2022-11-03 09:57:01', '2022-11-03 12:23:54', 'GM', '123456', NULL, NULL, NULL, NULL),
(130, 3, 'Mr.', 'No', 'Rafael', NULL, 'Sacayle', '1990-02-05', '2022-08-12', '2024-08-11', 'P8246720A', '2028-08-06', NULL, NULL, NULL, '0566236869', NULL, 'Rafael.c.sacayle@gmail.com', 'Philipino', 'Male', NULL, 'Single', NULL, NULL, NULL, '4', 2, NULL, NULL, NULL, NULL, '2022-01-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-04 08:19:05', NULL, 'Agent', '123456', NULL, NULL, NULL, NULL),
(131, 3, 'Mr.', 'No', 'Kyle Jasmine', 'Mirasol', 'Lumanog', '2000-05-06', '2022-09-13', '2024-09-12', 'P5864213B', '2030-11-25', '784-2000-7487676-2', '2024-09-12', NULL, '0509173759', NULL, 'Kylejasmine94@gmail.com', 'Filipino', 'Female', NULL, 'Single', NULL, NULL, NULL, '4', 2, NULL, NULL, NULL, NULL, '2022-03-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FA/FSC', NULL, NULL, '2022-11-04 08:25:39', NULL, 'Agent', '123456', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_copy`
--

CREATE TABLE `employee_copy` (
  `EmployeeID` int(8) NOT NULL,
  `BranchID` int(8) DEFAULT NULL,
  `Title` varchar(75) DEFAULT NULL,
  `IsSupervisor` varchar(3) DEFAULT NULL,
  `FirstName` varchar(88) DEFAULT NULL,
  `MiddleName` varchar(88) DEFAULT NULL,
  `LastName` varchar(88) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `VisaIssueDate` date DEFAULT NULL,
  `VisaExpiryDate` date DEFAULT NULL,
  `PassportNo` varchar(88) DEFAULT NULL,
  `PassportExpiry` date DEFAULT NULL,
  `EidNo` varchar(75) DEFAULT NULL,
  `EidExpiry` date DEFAULT NULL,
  `FullAddress` varchar(255) DEFAULT NULL,
  `MobileNo` varchar(35) DEFAULT NULL,
  `HomePhone` varchar(35) DEFAULT NULL,
  `Email` varchar(35) DEFAULT NULL,
  `Nationality` varchar(35) DEFAULT NULL,
  `Gender` varchar(35) DEFAULT NULL,
  `SSNorGID` varchar(35) DEFAULT NULL,
  `MaritalStatus` varchar(35) DEFAULT NULL,
  `SpouseName` varchar(50) DEFAULT NULL,
  `SpouseEmployer` varchar(52) DEFAULT NULL,
  `SpouseWorkPhone` varchar(33) DEFAULT NULL,
  `JobTitleID` varchar(33) DEFAULT NULL,
  `DepartmentID` int(8) DEFAULT NULL,
  `SupervisorID` int(8) DEFAULT NULL,
  `WorkLocation` varchar(55) DEFAULT NULL,
  `EmailOffical` varchar(55) DEFAULT NULL,
  `WorkPhone` varchar(55) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `Salary` int(8) DEFAULT NULL,
  `ExtraComission` int(10) DEFAULT NULL,
  `SalaryRemarks` longtext,
  `NextofKinName` varchar(75) DEFAULT NULL,
  `NextofKinAddress` varchar(255) DEFAULT NULL,
  `NextofKinPhone` varchar(55) DEFAULT NULL,
  `NextofKinRelationship` varchar(55) DEFAULT NULL,
  `EducationLevel` varchar(55) DEFAULT NULL,
  `LastDegree` varchar(75) DEFAULT NULL,
  `Picture` varchar(75) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `StaffType` varchar(25) DEFAULT NULL,
  `Password` varchar(25) DEFAULT '123456'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_allowance`
--

CREATE TABLE `emp_allowance` (
  `EmployeeAllowanceID` int(8) NOT NULL,
  `EmployeeID` int(8) DEFAULT NULL,
  `AllowanceListID` int(8) DEFAULT NULL,
  `Amount` int(8) DEFAULT NULL,
  `Active` varchar(3) DEFAULT 'Y',
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_allowance`
--

INSERT INTO `emp_allowance` (`EmployeeAllowanceID`, `EmployeeID`, `AllowanceListID`, `Amount`, `Active`, `eDate`) VALUES
(6, 110, 1, 2500, 'Yes', '2022-11-01 02:27:13'),
(10, 110, 11, 2500, 'Yes', '2022-11-02 02:24:22'),
(11, 110, 12, 2500, 'Yes', '2022-11-02 02:24:27'),
(12, 110, 14, 5000, 'No', '2022-11-02 02:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `emp_deduction`
--

CREATE TABLE `emp_deduction` (
  `EmployeeDeductionID` int(8) NOT NULL,
  `EmployeeSalaryID` int(8) DEFAULT NULL,
  `DeductionListID` int(8) DEFAULT NULL,
  `Amount` int(8) DEFAULT NULL,
  `Active` varchar(1) DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary`
--

CREATE TABLE `emp_salary` (
  `EmployeeAllowanceID` int(8) NOT NULL,
  `EmployeeID` int(8) DEFAULT NULL,
  `AllowanceListID` int(8) DEFAULT NULL,
  `Amount` int(8) DEFAULT NULL,
  `Active` varchar(3) DEFAULT 'Y',
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_salary`
--

INSERT INTO `emp_salary` (`EmployeeAllowanceID`, `EmployeeID`, `AllowanceListID`, `Amount`, `Active`, `eDate`) VALUES
(20, 117, 1, 2500, 'Yes', '2022-11-08 03:45:48'),
(21, 117, 2, 2500, 'Yes', '2022-11-08 03:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `eu`
--

CREATE TABLE `eu` (
  `EuID` int(8) NOT NULL,
  `MonthName` varchar(25) DEFAULT NULL,
  `BranchID` int(8) DEFAULT NULL,
  `No` int(8) DEFAULT NULL,
  `Sum` int(8) DEFAULT NULL,
  `NetDeposit` int(8) DEFAULT NULL,
  `FTD` int(8) DEFAULT NULL,
  `Per` int(8) DEFAULT NULL,
  `Total` int(8) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eu`
--

INSERT INTO `eu` (`EuID`, `MonthName`, `BranchID`, `No`, `Sum`, `NetDeposit`, `FTD`, `Per`, `Total`, `eDate`) VALUES
(15, 'Nov-2021', NULL, 108, 37495, 453761, 100, 34718, 269756, '2021-12-12 05:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `fcb`
--

CREATE TABLE `fcb` (
  `FCBID` int(12) NOT NULL,
  `BranchID` int(8) DEFAULT NULL,
  `ID` int(8) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `FTDAmount` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Compliant` varchar(25) DEFAULT NULL,
  `KYCSent` varchar(25) DEFAULT NULL,
  `Dialer` int(11) DEFAULT NULL,
  `Remarks` longtext,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fcb`
--

INSERT INTO `fcb` (`FCBID`, `BranchID`, `ID`, `EmployeeID`, `FTDAmount`, `Date`, `Compliant`, `KYCSent`, `Dialer`, `Remarks`, `eDate`) VALUES
(11, 1, 31316595, 85, 272, '2021-11-03', 'YES', 'YES', 7076, 'test', '2021-12-10 04:59:51'),
(12, 1, 30903090, 86, 250, '2021-11-03', 'YES', 'YES', 7038, NULL, '2021-12-10 05:00:17'),
(13, 1, 31315585, 97, 544, '2021-11-04', 'YES', 'YES', 7003, NULL, '2021-12-10 05:00:42'),
(14, 1, 31316321, 98, 1007, '2021-11-04', 'YES', 'YES', 8001, NULL, '2021-12-10 05:01:25'),
(15, 1, 31314948, 89, 1000, '2021-11-05', 'YES', 'YES', 400, NULL, '2021-12-10 05:01:51'),
(16, 1, 31327190, 97, 250, '2021-11-05', 'YES', 'YES', NULL, NULL, '2021-12-10 05:02:19'),
(17, 1, 31327513, 90, 517, '2021-11-07', 'YES', 'YES', NULL, NULL, '2021-12-10 05:03:17'),
(18, 1, 31334021, 90, 500, '2021-11-07', 'YES', 'YES', 7099, NULL, '2021-12-10 05:03:39'),
(19, 1, 31333798, 102, 300, '2021-11-07', 'YES', 'YES', 7047, NULL, '2021-12-10 05:04:26'),
(20, 1, 31252858, 98, 1007, '2021-11-07', 'YE', 'YES', 450000, NULL, '2021-12-10 05:04:59'),
(21, 1, 31340289, 92, 272, '2021-11-08', 'YES', 'YES', 70033, NULL, '2021-12-10 05:07:22'),
(22, 1, 31343188, 86, 1000, '2021-11-06', 'YES', 'YES', 450000, NULL, '2021-12-10 05:07:51'),
(23, 1, 31345310, 86, 250, '2021-11-09', 'YES', 'YES', 7076, NULL, '2021-12-10 05:08:14'),
(24, 1, 31347454, 102, 500, '2021-11-10', 'YES', 'YES', 12008, NULL, '2021-12-10 05:08:42'),
(25, 1, 31345591, 93, 272, '2021-11-10', 'YES', 'YES', 12022, NULL, '2021-12-10 05:10:37'),
(26, 1, 31349146, 94, 272, '2021-11-10', 'YES', 'YES', 12032, NULL, '2021-12-10 05:11:17'),
(27, 1, 31352184, 95, 250, '2021-11-11', 'YES', 'YES', 7082, NULL, '2021-12-10 05:11:38'),
(28, 1, 31352343, 89, 250, '2021-11-11', 'YES', 'YES', 70033, NULL, '2021-12-10 05:11:55'),
(29, 1, 31209846, 96, 1007, '2021-11-11', 'YES', 'YES', 890, NULL, '2021-12-10 05:12:11'),
(30, 1, 31361970, 97, 2014, '2021-11-14', 'YES', 'YES', NULL, NULL, '2021-12-10 05:12:31'),
(31, 1, 31362254, 103, 5172, '2021-11-14', 'YES', 'YES', 7004, NULL, '2021-12-10 05:18:28'),
(32, 1, 31370885, 104, 272, '2021-11-15', 'YES', 'YES', 450000, NULL, '2021-12-10 05:18:52'),
(33, 1, 31165432, 89, 250, '2011-11-15', 'YES', 'YES', NULL, NULL, '2021-12-10 05:19:53'),
(34, 1, 31371389, 102, 253, '2021-11-15', 'YES', 'YES', NULL, NULL, '2021-12-10 05:20:27'),
(35, 1, 31373859, 94, 250, '2021-11-16', 'YES', 'YES', 9000, NULL, '2021-12-10 05:20:47'),
(36, 1, 31370492, 100, 2041, '2021-11-17', 'YES', 'YES', 507, NULL, '2021-12-10 05:21:08'),
(37, 1, 31311489, 81, 1361, '2021-11-17', 'YES', 'YES', 7042, NULL, '2021-12-10 05:21:33'),
(38, 1, 31387417, 97, 1007, '2021-11-18', 'YES', 'YES', 7131, NULL, '2021-12-10 05:21:50'),
(39, 1, 31391611, 97, 250, '2021-11-19', 'YES', 'YES', 701, NULL, '2021-12-10 05:22:10'),
(40, 1, 31395707, 101, 5000, '2021-11-21', 'YES', 'YES', 7098, NULL, '2021-12-10 05:22:37'),
(41, 1, 31374300, 81, 272, '2021-11-22', 'YES', 'YES', 402, NULL, '2021-12-10 05:22:59'),
(42, 1, 30859648, 106, 272, '2021-11-22', 'YES', 'YES', 450000, NULL, '2021-12-10 05:23:20'),
(43, 1, 30798672, 106, 272, '2021-11-22', 'YES', 'YES', 7023, NULL, '2021-12-10 05:23:38'),
(44, 1, 31281028, 107, 272, '2021-11-23', 'YES', 'YES', 7005, NULL, '2021-12-10 05:24:08'),
(45, 1, 31311495, 85, 1000, '2021-11-23', 'YES', 'YES', 7112, NULL, '2021-12-10 05:24:31'),
(46, 1, 30870664, 108, 250, '2021-11-23', 'YES', 'YES', 12010, NULL, '2021-12-10 05:25:35'),
(47, 1, 31281979, 79, 3000, '2021-11-23', 'YES', 'YES', 7093, NULL, '2021-12-10 05:25:57'),
(48, 1, 31087126, 100, 250, '2021-11-23', 'YES', 'YES', 7177, NULL, '2021-12-10 05:27:06'),
(49, 1, 31243349, 101, 250, '2021-11-25', 'YES', 'YES', 12004, NULL, '2021-12-10 05:27:29'),
(50, 1, 31409818, 93, 816, '2021-11-26', 'YES', 'YES', 7003, NULL, '2021-12-10 05:27:47'),
(51, 1, 31426537, 90, 326, '2021-11-28', 'YES', 'YES', 450000, NULL, '2021-12-10 05:28:05'),
(52, 1, 30798672, 79, 1500, '2021-11-30', 'YES', 'YES', 740, '\"Remarks\" => $request->input(\'Remarks\'),', '2021-12-26 04:02:37'),
(53, 1, 5, 110, 6, '2022-11-29', 'Yes', 'Yes', 6, 'ahsan', '2022-11-02 13:13:49'),
(54, 2, 32914486, 127, 250, '2022-10-31', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:07:37'),
(55, 2, 32947529, 119, 500, '2022-10-05', 'YES', 'YES', NULL, NULL, '2022-11-04 11:11:28'),
(56, 2, 32914957, 125, 250, '2022-10-07', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:12:11'),
(57, 2, 32905804, 125, 272, '2022-10-12', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:20:50'),
(58, 2, 32986923, 125, 272, '2022-10-12', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:21:24'),
(59, 2, 32973241, 127, 272, '2022-10-14', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:22:06'),
(60, 2, 32644514, 123, 250, '2022-10-14', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:23:11'),
(61, 2, 33005998, 123, 258, '2022-10-17', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:23:57'),
(62, 2, 33011406, 125, 272, '2022-10-19', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:24:23'),
(63, 2, 33033464, 125, 544, '2022-10-24', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:25:31'),
(64, 2, 32947823, 125, 300, '2022-10-25', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:26:36'),
(65, 2, 33036724, 119, 250, '2022-10-25', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:27:19'),
(66, 2, 33049900, 125, 326, '2022-10-26', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:28:00'),
(67, 2, 33044609, 123, 500, '2022-10-29', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:29:30'),
(68, 2, 33022368, 117, 272, '2022-10-31', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:30:38'),
(69, 2, 32985756, 123, 250, '2022-10-31', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:31:08'),
(72, 2, 32935065, 126, 250, '2022-10-04', 'No', 'No', NULL, NULL, '2022-11-04 11:50:30'),
(73, 2, 32985503, 126, 250, '2022-10-12', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:52:01'),
(74, 2, 32020605, 116, 250, '2022-10-14', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:52:28'),
(75, 2, 32663649, 115, 250, '2022-10-19', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:53:12'),
(76, 2, 32900052, 115, 258, '2022-10-19', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:53:35'),
(77, 2, 32450532, 115, 250, '2022-10-20', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:53:59'),
(78, 2, 33010946, 126, 272, '2022-10-25', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:55:13'),
(79, 2, 33039114, 115, 258, '2022-10-25', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:55:39'),
(80, 2, 33048314, 115, 272, '2022-10-27', 'Yes', 'Yes', NULL, NULL, '2022-11-04 11:56:07'),
(83, 2, 33064336, 115, 272, '2022-10-31', 'Yes', 'Yes', NULL, NULL, '2022-11-04 12:24:16'),
(84, 2, 33064822, 115, 258, '2022-10-31', 'Yes', 'Yes', NULL, NULL, '2022-11-04 12:24:53'),
(85, 2, 33049629, 115, 302, '2022-10-27', 'Yes', 'Yes', NULL, NULL, '2022-11-04 12:26:38'),
(86, 2, 32968392, 120, 544, '2022-10-09', 'Yes', 'Yes', NULL, NULL, '2022-11-04 13:47:12'),
(87, 2, 33051306, 120, 503, '2022-10-27', 'WithD', 'Yes', NULL, NULL, '2022-11-04 14:06:54'),
(88, 2, 33065163, 126, 544, '2022-10-31', 'No', 'No', NULL, NULL, '2022-11-04 14:07:34'),
(89, 2, 33051627, 126, 250, '2022-10-27', 'Yes', 'Yes', NULL, NULL, '2022-11-04 14:08:42'),
(90, 2, 33051680, 126, 250, '2022-10-27', 'Yes', 'Yes', NULL, NULL, '2022-11-04 14:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `fleet_detail`
--

CREATE TABLE `fleet_detail` (
  `FleetDetailID` int(12) NOT NULL,
  `FleetMasterID` int(12) NOT NULL,
  `RegistrationStartDate` date DEFAULT NULL,
  `RegistrationEndDate` date DEFAULT NULL,
  `InsuranceStartDate` date DEFAULT NULL,
  `InsuranceEndDate` date DEFAULT NULL,
  `InsuranceCompanyName` varchar(255) DEFAULT NULL,
  `OilChangeDate` date DEFAULT NULL,
  `LastReading` varchar(255) DEFAULT NULL,
  `OilDueDate` date DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fleet_master`
--

CREATE TABLE `fleet_master` (
  `FleetMasterID` int(8) NOT NULL,
  `VehicleModel` varchar(155) DEFAULT NULL,
  `OwnerName` varchar(255) DEFAULT NULL,
  `Picure` varchar(255) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fleet_master`
--

INSERT INTO `fleet_master` (`FleetMasterID`, `VehicleModel`, `OwnerName`, `Picure`, `eDate`) VALUES
(10, 'lk', 'lk', NULL, '2022-10-29 10:18:12'),
(11, '654', '654', NULL, '2022-10-29 10:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `issue_letter`
--

CREATE TABLE `issue_letter` (
  `IssueLetterID` int(8) NOT NULL,
  `LetterID` int(8) DEFAULT NULL,
  `EmployeeID` int(8) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Content` longtext,
  `UserID` int(8) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_letter`
--

INSERT INTO `issue_letter` (`IssueLetterID`, `LetterID`, `EmployeeID`, `Title`, `Content`, `UserID`, `eDate`) VALUES
(20, 2, 44, 'Appointment Letter', '<p align=\"right\"><strong>Office Copy</strong></p>\r\n<p>Name: kashif<br />F/Name: ^FNAME^<br />Address: ^ADDRESS^<br />NIC #: ^CNIC^<br />Mobile #: ^CONTACT^<br />Property #: ^PLOT_NO^<br />Registration #:&nbsp; ^REG_NO^<br />Category# ^CATEGORY^<br /><br />Date: ^BOOKING_DATE^</p>\r\n<p><strong>Dear kashif</strong>,<br />The management of ___________________________ is pleased to allot you the above commercial shop in payment.<br />Duplicate copy of this letter must be signed and delivered to the head office of __________________.<br />Note: The allotment letter can becancelled if the client not follows the terms and condition already mentioned in the application form.</p>\r\n<p>&nbsp;</p>\r\n<table border=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"48%\"><strong>Managing Director</strong><br />PERSON NAME</td>\r\n<td valign=\"top\" width=\"52%\">\r\n<div align=\"right\"><strong>Customer</strong></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, '2021-10-18 02:42:07'),
(22, 2, 44, 'Appointment Letters', '<p align=\"right\"><strong>Office Copy</strong></p>\r\n<p>Name: kashif Mushtaq<br />F/Name: ^FNAME^<br />Address: ^ADDRESS^<br />NIC #: ^CNIC^<br />Mobile #: ^CONTACT^<br />Property #: ^PLOT_NO^<br />Registration #:&nbsp; ^REG_NO^<br />Category# ^CATEGORY^<br /><br />Date: ^BOOKING_DATE^</p>\r\n<p><strong>Dear kashif</strong>,<br />The management of ___________________________ is pleased to allot you the above commercial shop in payment.<br />Duplicate copy of this letter must be signed and delivered to the head office of __________________.<br />Note: The allotment letter can becancelled if the client not follows the terms and condition already mentioned in the application form.</p>\r\n<p>&nbsp;</p>\r\n<table border=\"0\" width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"48%\"><strong>Managing Director</strong><br />PERSON NAME</td>\r\n<td valign=\"top\" width=\"52%\">\r\n<div align=\"right\"><strong>Customer</strong></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, '2021-10-19 04:07:10'),
(23, 1, 44, 'Offer Letter', '<p><strong>Kashif Ur Mushtaq</strong><br />Filipino Passport:</p>\r\n<p>Dear Kashif;</p>\r\n<p align=\"center\"><strong><u>EMPLOYMENT OFFER</u></strong></p>\r\n<p>We are glad to offer you employment in our company on the following terms and conditions:</p>\r\n<table border=\"0\" width=\"1056\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"25\">1.</td>\r\n<td valign=\"top\" width=\"213\">Position&nbsp;</td>\r\n<td valign=\"top\" width=\"818\">: Sale Manager</td>\r\n</tr>\r\n<tr>\r\n<td>2.</td>\r\n<td valign=\"top\">Location</td>\r\n<td valign=\"top\">: Dubai 1</td>\r\n</tr>\r\n<tr>\r\n<td>3.</td>\r\n<td valign=\"top\">Total Monthly Salary</td>\r\n<td valign=\"top\">: AED: ^Salary^</td>\r\n</tr>\r\n<tr>\r\n<td>4.</td>\r\n<td valign=\"top\">Bonus/Commission</td>\r\n<td valign=\"top\">: Upon company discretion</td>\r\n</tr>\r\n<tr>\r\n<td>5.</td>\r\n<td valign=\"top\">Accommodation</td>\r\n<td valign=\"top\">: to be arranged by Employee</td>\r\n</tr>\r\n<tr>\r\n<td>6.</td>\r\n<td valign=\"top\">Transportation</td>\r\n<td valign=\"top\">: to be arranged by Employee</td>\r\n</tr>\r\n<tr>\r\n<td>7.</td>\r\n<td valign=\"top\">Contract period</td>\r\n<td valign=\"top\">: Two years, UNLIMITED</td>\r\n</tr>\r\n<tr>\r\n<td>8.</td>\r\n<td valign=\"top\">Probation period</td>\r\n<td valign=\"top\">: (6) months</td>\r\n</tr>\r\n<tr>\r\n<td>9.</td>\r\n<td valign=\"top\">Working hours</td>\r\n<td valign=\"top\">: 8 hours/day, 6 days/week</td>\r\n</tr>\r\n<tr>\r\n<td>10.</td>\r\n<td valign=\"top\">Vacation</td>\r\n<td valign=\"top\">: 30 days per year</td>\r\n</tr>\r\n<tr>\r\n<td>11.</td>\r\n<td valign=\"top\">Increment after probation</td>\r\n<td valign=\"top\">: AED 1,000</td>\r\n</tr>\r\n<tr>\r\n<td>12.</td>\r\n<td valign=\"top\">Air Ticket</td>\r\n<td valign=\"top\">: Upon renewal the contract you can take returned ticket from DXB to your home country.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">&nbsp;</td>\r\n<td valign=\"top\">: If you will not renew you can only avail returned ticket to your home country</td>\r\n</tr>\r\n<tr>\r\n<td>13.</td>\r\n<td valign=\"top\">Medical, Insurance</td>\r\n<td valign=\"top\">: As per U.A.E. Labor Law</td>\r\n</tr>\r\n<tr>\r\n<td>14.</td>\r\n<td valign=\"top\">End of Service Benefits</td>\r\n<td valign=\"top\">: As per U.A.E. Labor Law</td>\r\n</tr>\r\n<tr>\r\n<td valign=\"top\">15</td>\r\n<td valign=\"top\">Others</td>\r\n<td valign=\"top\">: The U.A.E. Federal Labor Law No (8) of 1980 will apply to any matter which is not mentioned in this Letter of Employment Offer</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>Should you accept our offer based on the above conditions, please sign and return copy of this letter as a token of your acceptance. The joining date will be on July 17th and if failed to come this offer will be null and void.</p>\r\n<p>This Offer is subject to your visa approval, medical fitness and you&rsquo;re reporting to duty on agreed date.</p>\r\n<p>This Offer is valid for 7 days from date of issuing.</p>\r\n<p>We welcome you to <strong>Friends Commodity Brokerage LLC</strong> and wish you good luck.</p>\r\n<p>&nbsp;</p>\r\n<p>For <strong>Friends Commodity Brokerage LLC</strong></p>\r\n<p><strong>&nbsp;</strong></p>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"50%\"><strong>Muhammad Asim Jan</strong></td>\r\n<td width=\"50%\"><em>Accepted: _____________________</em></td>\r\n</tr>\r\n<tr>\r\n<td width=\"50%\"><em>Managing Director</em></td>\r\n<td width=\"50%\"><em>Date:</em></td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, '2021-10-23 11:32:06'),
(24, 7, 101, 'End of Services', '<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"50%\">Ref: FCB/L/2021-82&nbsp;</td>\r\n<td width=\"50%\">\r\n<div align=\"right\">Date: May 23, 2021</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p align=\"center\"><strong><u>END OF SERVICE SETTLEMENT</u></strong></p>\r\n<p><strong>Harry </strong><br /><strong>Nationality: ^Nationality^</strong></p>\r\n<p>Passport:</p>\r\n<p>Dear Harry,<br />Your resignation from your position has been accepted, effective on July 25, 2021 as requested.<br />It has been a pleasure to work with you, and on behalf of our entire team, I would like to wish you the best in your future endeavours. <br />This letter acknowledges an amount of <strong><em>AED 2,180.00</em></strong>/- towards payment of amount in full and final settlement against your employment with this company.<br />&nbsp;With this, your account is settled with our company and nothing is due from the company to you. <br />You are required to return any of the company&rsquo;s material, documents or equipment to which you had access during the period your contract.<br />We would like to thank you for your contribution&nbsp;and we wish you all the best for the future.</p>\r\n<p>Thank you<br />Best Regards</p>\r\n<p>&nbsp;</p>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"50%\"><strong>Jeny Jane Aquino</strong></td>\r\n<td width=\"50%\">\r\n<div align=\"left\"><strong>Malvern Tendai Kurehwa</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>HR Administrator&nbsp;</strong></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, '2021-12-12 11:58:26'),
(26, 1, 98, 'Offer Letter', '<p><strong>April nil mushtaq</strong><br />Filipino Passport: <strong>KM105245</strong></p>\r\n<p>Dear April;</p>\r\n<p align=\"center\"><strong><u>EMPLOYMENT OFFER</u></strong></p>\r\n<p>We are glad to offer you employment in our company on the following terms and conditions:</p>\r\n<table border=\"0\" width=\"1056\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"25\">1.</td>\r\n<td valign=\"top\" width=\"213\">Position&nbsp;</td>\r\n<td valign=\"top\" width=\"818\">: Sale Manager</td>\r\n</tr>\r\n<tr>\r\n<td>2.</td>\r\n<td valign=\"top\">Location</td>\r\n<td valign=\"top\">: Dubai 2</td>\r\n</tr>\r\n<tr>\r\n<td>3.</td>\r\n<td valign=\"top\">Total Monthly Salary</td>\r\n<td valign=\"top\">: AED: 2000</td>\r\n</tr>\r\n<tr>\r\n<td>4.</td>\r\n<td valign=\"top\">Bonus/Commission</td>\r\n<td valign=\"top\">: Upon company discretion</td>\r\n</tr>\r\n<tr>\r\n<td>5.</td>\r\n<td valign=\"top\">Accommodation</td>\r\n<td valign=\"top\">: to be arranged by Employee</td>\r\n</tr>\r\n<tr>\r\n<td>6.</td>\r\n<td valign=\"top\">Transportation</td>\r\n<td valign=\"top\">: to be arranged by Employee</td>\r\n</tr>\r\n<tr>\r\n<td>7.</td>\r\n<td valign=\"top\">Contract period</td>\r\n<td valign=\"top\">: Two years, UNLIMITED</td>\r\n</tr>\r\n<tr>\r\n<td>8.</td>\r\n<td valign=\"top\">Probation period</td>\r\n<td valign=\"top\">: (6) months</td>\r\n</tr>\r\n<tr>\r\n<td>9.</td>\r\n<td valign=\"top\">Working hours</td>\r\n<td valign=\"top\">: 8 hours/day, 6 days/week</td>\r\n</tr>\r\n<tr>\r\n<td>10.</td>\r\n<td valign=\"top\">Vacation</td>\r\n<td valign=\"top\">: 30 days per year</td>\r\n</tr>\r\n<tr>\r\n<td>11.</td>\r\n<td valign=\"top\">Increment after probation</td>\r\n<td valign=\"top\">: AED 1,000</td>\r\n</tr>\r\n<tr>\r\n<td>12.</td>\r\n<td valign=\"top\">Air Ticket</td>\r\n<td valign=\"top\">: Upon renewal the contract you can take returned ticket from DXB to your home country.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">&nbsp;</td>\r\n<td valign=\"top\">: If you will not renew you can only avail returned ticket to your home country</td>\r\n</tr>\r\n<tr>\r\n<td>13.</td>\r\n<td valign=\"top\">Medical, Insurance</td>\r\n<td valign=\"top\">: As per U.A.E. Labor Law</td>\r\n</tr>\r\n<tr>\r\n<td>14.</td>\r\n<td valign=\"top\">End of Service Benefits</td>\r\n<td valign=\"top\">: As per U.A.E. Labor Law</td>\r\n</tr>\r\n<tr>\r\n<td valign=\"top\">15</td>\r\n<td valign=\"top\">Others</td>\r\n<td valign=\"top\">: The U.A.E. Federal Labor Law No (8) of 1980 will apply to any matter which is not mentioned in this Letter of Employment Offer</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>Should you accept our offer based on the above conditions, please sign and return copy of this letter as a token of your acceptance. The joining date will be on July 17th and if failed to come this offer will be null and void.</p>\r\n<p>This Offer is subject to your visa approval, medical fitness and you&rsquo;re reporting to duty on agreed date.</p>\r\n<p>This Offer is valid for 7 days from date of issuing.</p>\r\n<p>We welcome you to <strong>Friends Commodity Brokerage LLC</strong> and wish you good luck.</p>\r\n<p>&nbsp;</p>\r\n<p>For <strong>Friends Commodity Brokerage LLC</strong></p>\r\n<p><strong>&nbsp;</strong></p>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"50%\"><strong>Muhammad Asim Jan</strong></td>\r\n<td width=\"50%\"><em>Accepted: _____________________</em></td>\r\n</tr>\r\n<tr>\r\n<td width=\"50%\"><em>Managing Director</em></td>\r\n<td width=\"50%\"><em>Date:</em></td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, '2021-12-15 09:26:14'),
(27, 1, 79, 'Offer Letter', '<p><strong>Umair nil nil</strong><br />\r\nFilipino Passport: <strong></strong></p>\r\n<p>Dear Umair;<strong></strong></p>\r\n<p align=\"center\"><strong><u>EMPLOYMENT  OFFER</u></strong></p>\r\n<p>We are glad to offer you  employment in our company on the following terms and conditions:</p>\r\n<table width=\"1056\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"25\">1.</td>\r\n    <td width=\"213\" valign=\"top\">Position </td>\r\n    <td width=\"818\" valign=\"top\">:       Sale Manager</td>\r\n  </tr>\r\n  <tr>\r\n    <td>2.</td>\r\n    <td valign=\"top\">Location</td>\r\n    <td valign=\"top\">: Dubai 2</td>\r\n  </tr>\r\n  <tr>\r\n    <td>3.</td>\r\n    <td valign=\"top\">Total Monthly Salary</td>\r\n    <td valign=\"top\">:       AED: 3000</td>\r\n  </tr>\r\n  <tr>\r\n    <td>4.</td>\r\n    <td valign=\"top\">Bonus/Commission</td>\r\n    <td valign=\"top\"> : Upon company discretion</td>\r\n  </tr>\r\n  <tr>\r\n    <td>5.</td>\r\n    <td valign=\"top\">Accommodation</td>\r\n    <td valign=\"top\"> : to be arranged by Employee</td>\r\n  </tr>\r\n  <tr>\r\n    <td>6.</td>\r\n    <td valign=\"top\">Transportation</td>\r\n    <td valign=\"top\"> : to be arranged by Employee </td>\r\n  </tr>\r\n  <tr>\r\n    <td>7.</td>\r\n    <td valign=\"top\">Contract       period</td>\r\n    <td valign=\"top\">: Two       years, UNLIMITED</td>\r\n  </tr>\r\n  <tr>\r\n    <td>8.</td>\r\n    <td valign=\"top\">Probation       period</td>\r\n    <td valign=\"top\">: (6)       months</td>\r\n  </tr>\r\n  <tr>\r\n    <td>9.</td>\r\n    <td valign=\"top\">Working       hours</td>\r\n    <td valign=\"top\">: 8 hours/day, 6 days/week</td>\r\n  </tr>\r\n  <tr>\r\n    <td>10.</td>\r\n    <td valign=\"top\">Vacation</td>\r\n    <td valign=\"top\"> : 30       days per year</td>\r\n  </tr>\r\n  <tr>\r\n    <td>11.</td>\r\n    <td valign=\"top\">Increment       after probation</td>\r\n    <td valign=\"top\">: AED 1,000</td>\r\n  </tr>\r\n  <tr>\r\n    <td>12.</td>\r\n    <td valign=\"top\">Air       Ticket</td>\r\n    <td valign=\"top\">:       Upon renewal the contract you can take returned ticket  from DXB to your home country.</td>\r\n  </tr>\r\n  <tr>\r\n    <td> </td>\r\n    <td valign=\"top\"> </td>\r\n    <td valign=\"top\"> :  If you will not renew you can only avail returned ticket  to your home country</td>\r\n  </tr>\r\n  <tr>\r\n    <td>13.</td>\r\n    <td valign=\"top\">Medical,       Insurance </td>\r\n    <td valign=\"top\"> : As per       U.A.E. Labor Law</td>\r\n  </tr>\r\n  <tr>\r\n    <td>14.</td>\r\n    <td valign=\"top\">End       of Service Benefits</td>\r\n    <td valign=\"top\">: As       per U.A.E. Labor Law</td>\r\n  </tr>\r\n  <tr>\r\n    <td valign=\"top\">15</td>\r\n    <td valign=\"top\">Others</td>\r\n    <td valign=\"top\">: The  U.A.E. Federal Labor Law No (8) of 1980 will apply to any matter which is not mentioned  in this Letter of Employment  Offer    </td>\r\n  </tr>\r\n</table>\r\n<p>Should you accept our offer based on  the above conditions, please sign and return copy of this letter as a token of  your acceptance. The joining date will be on July 17th and if failed  to come this offer will be null and void.</p>\r\n<p>This  Offer is subject to your visa approval, medical fitness and you’re reporting to  duty on agreed date. </p>\r\n<p>This  Offer is valid for 7 days from date of issuing. </p>\r\n<p>We  welcome you to <strong>Friends Commodity  Brokerage LLC</strong> and wish you good luck.</p>\r\n<p> </p>\r\n<p>For   <strong>Friends Commodity Brokerage LLC</strong></p>\r\n<p><strong> </strong></p>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\"><strong>Muhammad Asim Jan</strong></td>\r\n    <td width=\"50%\"><em>Accepted:  _____________________</em></td>\r\n  </tr>\r\n  <tr>\r\n    <td width=\"50%\"><em>Managing  Director</em></td>\r\n    <td width=\"50%\"><em>Date:</em></td>\r\n  </tr>\r\n</table>', 1, '2021-12-17 13:57:05'),
(28, 7, 110, 'End of Services', '<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"50%\">Ref: FCB/L/2021-82&nbsp;</td>\r\n<td width=\"50%\">\r\n<div align=\"right\">Date: May 23, 2021</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p align=\"center\"><strong><u>END OF SERVICE SETTLEMENT</u></strong></p>\r\n<p><strong>kashif mushtaq</strong><br /><strong>Nationality: </strong></p>\r\n<p>Passport:</p>\r\n<p>Dear kashif,<br />Your resignation from your position has been accepted, effective on July 25, 2021 as requested.<br />It has been a pleasure to work with you, and on behalf of our entire team, I would like to wish you the best in your future endeavours. <br />This letter acknowledges an amount of <strong><em>AED 2,180.00</em></strong>/- towards payment of amount in full and final settlement against your employment with this company.<br />&nbsp;With this, your account is settled with our company and nothing is due from the company to you. <br />You are required to return any of the company&rsquo;s material, documents or equipment to which you had access during the period your contract.<br />We would like to thank you for your contribution&nbsp;and we wish you all the best for the future.</p>\r\n<p>Thank you<br />Best Regards</p>\r\n<p>&nbsp;</p>\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"50%\"><strong>Jeny Jane Aquino</strong></td>\r\n<td width=\"50%\">\r\n<div align=\"left\"><strong>Malvern Tendai Kurehwa</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>HR Administrator&nbsp;</strong></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, '2022-04-21 06:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `jobtitle`
--

CREATE TABLE `jobtitle` (
  `JobTitleID` int(8) NOT NULL,
  `JobTitleName` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobtitle`
--

INSERT INTO `jobtitle` (`JobTitleID`, `JobTitleName`) VALUES
(4, 'Accountant'),
(5, 'CEO'),
(6, 'Closer/Team Leader'),
(7, 'COO'),
(8, 'COO - BD'),
(9, 'Floor Manager'),
(10, 'Sales Agent'),
(11, 'Sr. Accountant'),
(12, 'HR & Admin Executive'),
(13, 'HR Director'),
(14, 'Office Boy'),
(15, 'Operations Manager'),
(16, 'Floor Manager');

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE `leave` (
  `LeaveID` int(8) NOT NULL,
  `LeaveTypeID` int(8) DEFAULT NULL,
  `BranchID` int(8) DEFAULT NULL,
  `EmployeeID` int(8) DEFAULT NULL,
  `FromDate` date DEFAULT NULL,
  `ToDate` date DEFAULT NULL,
  `Reason` longtext,
  `DaysApproved` int(3) DEFAULT NULL,
  `DaysRemaining` int(3) DEFAULT NULL,
  `OMStatus` varchar(20) DEFAULT 'Pending',
  `OMStatusDate` timestamp NULL DEFAULT NULL,
  `OMRemarks` longtext,
  `HRStatus` varchar(20) DEFAULT 'Pending',
  `HRStatusDate` timestamp NULL DEFAULT NULL,
  `HRRemarks` longtext,
  `GMStatus` varchar(20) DEFAULT 'Pending',
  `GMRemarks` longtext,
  `GMStatusDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave`
--

INSERT INTO `leave` (`LeaveID`, `LeaveTypeID`, `BranchID`, `EmployeeID`, `FromDate`, `ToDate`, `Reason`, `DaysApproved`, `DaysRemaining`, `OMStatus`, `OMStatusDate`, `OMRemarks`, `HRStatus`, `HRStatusDate`, `HRRemarks`, `GMStatus`, `GMRemarks`, `GMStatusDate`) VALUES
(20, NULL, 1, 98, '2002-12-12', '2003-12-12', '333', NULL, NULL, 'Yes', '2021-12-25 18:13:03', 'plz allow', 'Yes', '2021-12-25 18:13:03', 'ok done', 'Yes', 'OK', '2021-12-25 18:13:03'),
(22, NULL, 1, 79, '2021-12-01', '2021-12-02', 'hello', NULL, NULL, 'NO', '2021-12-25 13:55:50', 'dfsdfsd', 'Pending', NULL, NULL, 'No', 'ddfffFFF', '2021-12-25 14:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `leave_status`
--

CREATE TABLE `leave_status` (
  `LeaveStatusID` int(8) NOT NULL,
  `LeaveStatus` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_status`
--

INSERT INTO `leave_status` (`LeaveStatusID`, `LeaveStatus`) VALUES
(1, 'Pending'),
(2, 'Approved'),
(3, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `LeaveTypeID` int(8) NOT NULL,
  `LeaveTypeName` varchar(35) DEFAULT NULL,
  `DaysAllowed` varchar(255) DEFAULT NULL,
  `NoOfDays` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`LeaveTypeID`, `LeaveTypeName`, `DaysAllowed`, `NoOfDays`) VALUES
(1, 'Casual Leave', '30 days', 30),
(2, 'Short Leave', '7 days', 7),
(3, 'Sick Leave', '15 days\' full pay, 15 dyas half pay, 45 days unpaid', 15),
(4, 'Maternity', '45 days', 45),
(5, 'Bereavement', '3 days for blood relation', 3),
(6, 'Emergency', '7 days', 7),
(7, 'Paternity', '3 days', 3),
(8, 'Hajj', 'Unpaid', 0),
(9, 'Umran', 'Unpaid', 0);

-- --------------------------------------------------------

--
-- Table structure for table `letter`
--

CREATE TABLE `letter` (
  `LetterID` int(8) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Content` longtext,
  `UserID` int(8) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `letter`
--

INSERT INTO `letter` (`LetterID`, `Title`, `Content`, `UserID`, `eDate`) VALUES
(1, 'Offer Letter', '\r\n<p><strong>^FullName^</strong><br />\r\nFilipino Passport: <strong>^Passport^</strong></p>\r\n<p>Dear ^FirstName^;<strong></strong></p>\r\n<p align=\"center\"><strong><u>EMPLOYMENT  OFFER</u></strong></p>\r\n<p>We are glad to offer you  employment in our company on the following terms and conditions:</p>\r\n<table width=\"1056\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"25\">1.</td>\r\n    <td width=\"213\" valign=\"top\">Position&nbsp;</td>\r\n    <td width=\"818\" valign=\"top\">:       ^Designation^</td>\r\n  </tr>\r\n  <tr>\r\n    <td>2.</td>\r\n    <td valign=\"top\">Location</td>\r\n    <td valign=\"top\">: ^Location^</td>\r\n  </tr>\r\n  <tr>\r\n    <td>3.</td>\r\n    <td valign=\"top\">Total Monthly Salary</td>\r\n    <td valign=\"top\">:       AED: ^Salary^</td>\r\n  </tr>\r\n  <tr>\r\n    <td>4.</td>\r\n    <td valign=\"top\">Bonus/Commission</td>\r\n    <td valign=\"top\"> : Upon company discretion</td>\r\n  </tr>\r\n  <tr>\r\n    <td>5.</td>\r\n    <td valign=\"top\">Accommodation</td>\r\n    <td valign=\"top\"> : to be arranged by Employee</td>\r\n  </tr>\r\n  <tr>\r\n    <td>6.</td>\r\n    <td valign=\"top\">Transportation</td>\r\n    <td valign=\"top\"> : to be arranged by Employee </td>\r\n  </tr>\r\n  <tr>\r\n    <td>7.</td>\r\n    <td valign=\"top\">Contract       period</td>\r\n    <td valign=\"top\">: Two       years, UNLIMITED</td>\r\n  </tr>\r\n  <tr>\r\n    <td>8.</td>\r\n    <td valign=\"top\">Probation       period</td>\r\n    <td valign=\"top\">: (6)       months</td>\r\n  </tr>\r\n  <tr>\r\n    <td>9.</td>\r\n    <td valign=\"top\">Working       hours</td>\r\n    <td valign=\"top\">: 8 hours/day, 6 days/week</td>\r\n  </tr>\r\n  <tr>\r\n    <td>10.</td>\r\n    <td valign=\"top\">Vacation</td>\r\n    <td valign=\"top\"> : 30       days per year</td>\r\n  </tr>\r\n  <tr>\r\n    <td>11.</td>\r\n    <td valign=\"top\">Increment       after probation</td>\r\n    <td valign=\"top\">: AED 1,000</td>\r\n  </tr>\r\n  <tr>\r\n    <td>12.</td>\r\n    <td valign=\"top\">Air       Ticket</td>\r\n    <td valign=\"top\">:       Upon renewal the contract you can take returned ticket  from DXB to your home country.</td>\r\n  </tr>\r\n  <tr>\r\n    <td>&nbsp;</td>\r\n    <td valign=\"top\">&nbsp;</td>\r\n    <td valign=\"top\"> :  If you will not renew you can only avail returned ticket  to your home country</td>\r\n  </tr>\r\n  <tr>\r\n    <td>13.</td>\r\n    <td valign=\"top\">Medical,       Insurance </td>\r\n    <td valign=\"top\"> : As per       U.A.E. Labor Law</td>\r\n  </tr>\r\n  <tr>\r\n    <td>14.</td>\r\n    <td valign=\"top\">End       of Service Benefits</td>\r\n    <td valign=\"top\">: As       per U.A.E. Labor Law</td>\r\n  </tr>\r\n  <tr>\r\n    <td valign=\"top\">15</td>\r\n    <td valign=\"top\">Others</td>\r\n    <td valign=\"top\">: The  U.A.E. Federal Labor Law No (8) of 1980 will apply to any matter which is not mentioned  in this Letter of Employment  Offer    </td>\r\n  </tr>\r\n</table>\r\n<p>Should you accept our offer based on  the above conditions, please sign and return copy of this letter as a token of  your acceptance. The joining date will be on July 17th and if failed  to come this offer will be null and void.</p>\r\n<p>This  Offer is subject to your visa approval, medical fitness and you&rsquo;re reporting to  duty on agreed date. </p>\r\n<p>This  Offer is valid for 7 days from date of issuing. </p>\r\n<p>We  welcome you to <strong>Friends Commodity  Brokerage LLC</strong> and wish you good luck.</p>\r\n<p>&nbsp;</p>\r\n<p>For   <strong>Friends Commodity Brokerage LLC</strong></p>\r\n<p><strong>&nbsp;</strong></p>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\"><strong>Muhammad Asim Jan</strong></td>\r\n    <td width=\"50%\"><em>Accepted:  _____________________</em></td>\r\n  </tr>\r\n  <tr>\r\n    <td width=\"50%\"><em>Managing  Director</em></td>\r\n    <td width=\"50%\"><em>Date:</em></td>\r\n  </tr>\r\n</table>\r\n \r\n', NULL, '2021-10-19 14:03:41'),
(2, 'NOC', 'Ref: FCB/L/2021-82 \r\n\r\nDate: May 23, 2021\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nNO OBJECTION CERTIFICATE\r\n\r\nWe, FRIENDS COMMODITY BROKERAGE LLC, sponsor of ^FullName^, a ^Nationality^ nationality with Passport no. ^Passport^ have no objection to deposit the salary into his bank account.\r\nAccounts details given below:\r\nAccount Name: ^FullName^\r\nAccount Number: xxxxxxxxxxxxxxx\r\nBank: ADCB\r\nThis letter has been given upon request to be presented to your organization.\r\nWe highly appreciate your cooperation in this regard.\r\n\r\nThank you;\r\n\r\nSincerely yours;\r\n\r\n\r\n\r\n\r\n\r\nSyeda Rubab Ali Kazmi\r\nHR Manager \r\n\r\n', NULL, '2021-10-19 14:18:40'),
(3, 'Increment Letter', '\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\">Ref:  FCB/L/2021-82&nbsp;</td>\r\n    <td width=\"50%\"><div align=\"right\">Date:  May 23, 2021</div></td>\r\n  </tr>\r\n</table>\r\n<p align=\"center\">&nbsp;</p>\r\n<p>^FullName^,<br />\r\nPassport No: ^Passport^<br />\r\nNationality: ^Nationality^<br />\r\n^Designation^<br />\r\nFriends Commodities Brokerage LLC</p>\r\n<p>&nbsp;</p>\r\n<p>Subject: <strong><u>Employee  Appreciation and performance bonus</u></strong></p>\r\n<p>Dear ^FirstName^,</p>\r\n<p>After reviewing your performance in the last three months  carefully, the management of Friends Commodities Brokerage is glad to offer you  an increment for achieving the sales targets as expected. The effective date of  this increase is August 1, 2021 and the increase will appear as follow;</p>\r\n<p>Basic Salary: AED 2500<br />\r\n  Performance Increment: AED 1000<br />\r\n  Gross Salary: AED 3500</p>\r\n<p>We hope this will encourage you to perform even better,  and please note that the company will have the complete right to halt the bonus  at any time in case your performances fall. </p>\r\n<p>Thank you for your commitment and dedication. Keep up the  good work.</p>\r\n<p>&nbsp;</p>\r\n<p>Sincerely,</p>\r\n<p>Approved By:</p>\r\n<p>Andrei Bogdan &ndash; Operation  Manager&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ___________________</p>\r\n<p>Jeny Jane Aquino &ndash; HR  Administrator&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  ___________________</p>\r\n<p>Muhammad Asim Jan &ndash; Managing  Director: ___________________</p>\r\n<p>&nbsp;</p>\r\n<p>I have read, fully understand and accept the terms and  conditions mentioned herein<br />\r\n  Full Name: _____________________________<br />\r\n  Signature: _____________________________Date:  ______________________</p>\r\n', NULL, '2021-10-19 14:21:12'),
(4, 'Approval for Visit Visa', 'Ref: FCB/L/2021-82 \r\n\r\nDate: May 23, 2021\r\n\r\n\r\n\r\n\r\n\r\nAPPROVAL FOR VISIT VISA\r\n\r\nWe are writing this letter in response with your request for paying fee of AED 1400/-for 3 months visit visa. We accept your request and Falak Travel and Tourism LLC will pay a fee of AED 1400/-on your behalf.\r\nThe Criteria for returning the AED 1400/- back to Falak Travel and Tourism LLC should be that, we will deduct AED 1400/- in month of June salary.\r\n\r\nSincerely Yours,\r\n\r\n\r\n\r\n\r\n\r\nSyeda Rubab Ali Kazmi \r\n\r\nAcknowledged By: ______________________\r\n\r\n\r\n\r\nHR Manager \r\n\r\nAntony Mugadza\r\n\r\n\r\n\r\n\r\n\r\n', NULL, '2021-10-19 13:43:48'),
(5, 'Salary Letter', '\r\n<p align=\"center\" class=\"style1\">Salary  Certificate</p>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\">Ref:  FCB/L/2021-82&nbsp;</td>\r\n    <td width=\"50%\"><div align=\"right\">Date:  May 23, 2021</div></td>\r\n  </tr>\r\n</table>\r\n<p align=\"center\">&nbsp;</p>\r\n<p>To  whom it may concern;<br />\r\n  This  is to certify that <strong>^FullName^ </strong>holding Passport number <strong>^Passport^</strong> is working with our reputed company <strong>Friends  Commodity Brokerage LLC</strong> as a Marketing Specialist. He has been working with  us since 1st August 2019 and proved to be a very dedicated resource  that has been very loyal to the company.<br />\r\n  We  are issuing this letter on the request of <strong>^FullName^ </strong>and do not hold any liability on behalf of this  letter or part of this letter on our company.<br />\r\n  This  certificate can be used for the purpose of opening bank accounts only.<br />\r\n  His  salary particulars are given below:</p>\r\n<p>Basic  Salary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AED 5000.00<br />\r\n  House  Rent Allowance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AED 3000.00<br />\r\n  <u>Transport  Allowance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AED 2000.00</u><br />\r\n  <strong>Net Salary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AED 10,000.00</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Sincerely  yours,</p>\r\n<p><strong><u>Jeny Jane Aquino</u></strong><br />\r\n    <em><u>HR  Administrator</u></em><br />\r\n    <em><u>04-  580 7617</u></em></p>\r\n', NULL, '2021-10-19 14:23:37'),
(6, 'Warning Letter', '\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\">Name of  Employee: <strong>&nbsp;^FullName^</strong></td>\r\n    <td width=\"50%\"><div align=\"right\">Date:  May 23, 2021</div></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Passport No: <strong>^Passport^</strong></td>\r\n    <td><div align=\"right\">Ref:  FCB/L/2021-82&nbsp;</div></td>\r\n  </tr>\r\n  <tr>\r\n    <td>Nationality: ^Nationality^</td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p><strong>Subject :</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><u>Third Written Warning</u></strong><strong><u> </u></strong></p>\r\n<p>&nbsp;</p>\r\n<p>Dear <strong>^FirstName^</strong>,<br />\r\n  The management has been observing your  performance for a couple of months, and unfortunately we noticed that you were  not able to meet the minimum target which has been set for you. &nbsp;We are very clear and you were informed  beforehand that accomplishment of daily targets by each employee has a huge  importance to the company&rsquo;s growth. <br />\r\n  You are advised to achieve a desired  sales target of at least <strong>2 FTD from  today until the 22nd day of the month of September.</strong><br />\r\n  Please be reminded that your  performance would be strictly evaluated at the end of this month and <strong><em>failure  to comply with the said target may lead into corrective action up to  termination</em></strong>. So kindly do all your best and hoping that you will  achieve the sales target required by the management.</p>\r\n<p>This is for your kind information.</p>\r\n<p>Sincerely yours;</p>\r\n<p>&nbsp;</p>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\"><strong>Jeny Jane Aquino</strong></td>\r\n    <td width=\"50%\"><strong>Acknowledge By: ______________</strong><strong>___</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td width=\"50%\"><strong>HR Administrator</strong>&nbsp;&nbsp;</td>\r\n    <td width=\"50%\"><strong>^FirstName^</strong></td>\r\n  </tr>\r\n</table>\r\n \r\n', NULL, '2021-10-19 14:25:52'),
(7, 'End of Services', '\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\">Ref:  FCB/L/2021-82&nbsp;</td>\r\n    <td width=\"50%\"><div align=\"right\">Date:  May 23, 2021</div></td>\r\n  </tr>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p align=\"center\"><strong><u>END OF SERVICE  SETTLEMENT</u></strong></p>\r\n<p><strong>^FullName^</strong><br />\r\n    <strong>Nationality: ^Nationality^</strong></p>\r\n<p>Passport: <strong>^Passport^</strong></p>\r\n<p>Dear ^FirstName^,<br />\r\n  Your resignation from your position  has been accepted, effective on July 25, 2021 as requested.<br />\r\n  It has been a pleasure to work  with you, and on behalf of our entire team, I would like to wish you the best  in your future endeavours. <br />\r\n  This letter acknowledges an amount  of <strong><em>AED  2,180.00</em></strong>/- towards payment of amount in full and final settlement  against your employment with this company.<br />\r\n  &nbsp;With this, your account is  settled with our company and nothing is due from the company to you. <br />\r\n  You are required to return any of the company&rsquo;s  material, documents or equipment to which you had access during the period your  contract.<br />\r\n  We would like to thank you for your  contribution&nbsp;and we wish you all the best for the future.<br />\r\n</p>\r\n<p>Thank you<br />\r\n  Best Regards</p>\r\n<p>&nbsp;</p>\r\n<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n  <tr>\r\n    <td width=\"50%\"><strong>Jeny Jane Aquino</strong></td>\r\n    <td width=\"50%\"><div align=\"left\"><strong>Malvern Tendai Kurehwa</strong></div></td>\r\n  </tr>\r\n  <tr>\r\n    <td><strong>HR Administrator&nbsp;</strong></td>\r\n    <td>&nbsp;</td>\r\n  </tr>\r\n</table>\r\n \r\n', NULL, '2021-10-19 14:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `LoanID` int(8) NOT NULL,
  `EmployeeID` int(8) DEFAULT NULL,
  `RequestDate` date DEFAULT NULL,
  `Amount` int(8) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `DateAccepted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`LoanID`, `EmployeeID`, `RequestDate`, `Amount`, `Remarks`, `DateAccepted`) VALUES
(2, 110, '2022-04-01', 150000, 'con', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_deduction`
--

CREATE TABLE `loan_deduction` (
  `LoanDeductionID` int(8) NOT NULL,
  `LoanID` int(8) DEFAULT NULL,
  `EmployeeID` int(10) DEFAULT NULL,
  `LoanDeductionDate` date DEFAULT NULL,
  `Amount` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_deduction`
--

INSERT INTO `loan_deduction` (`LoanDeductionID`, `LoanID`, `EmployeeID`, `LoanDeductionDate`, `Amount`) VALUES
(7, 10, 110, '2022-02-01', 833),
(8, 10, 110, '2022-03-01', 833),
(9, 10, 110, '2022-04-01', 833),
(10, 11, 110, '2022-01-18', 0),
(11, 11, 110, '2022-02-18', 0),
(12, 11, 110, '2022-03-18', 0),
(13, 12, 110, '2022-01-19', 833),
(14, 12, 110, '2022-02-19', 833),
(15, 12, 110, '2022-03-19', 833),
(16, 1, 110, '2022-05-01', 15000),
(17, 1, 110, '2022-06-01', 15000),
(18, 1, 110, '2022-07-01', 15000),
(19, 1, 110, '2022-08-01', 15000),
(20, 1, 110, '2022-09-01', 15000),
(21, 1, 110, '2022-10-01', 15000),
(22, 1, 110, '2022-11-01', 15000),
(23, 1, 110, '2022-12-01', 15000),
(24, 1, 110, '2023-01-01', 15000),
(25, 1, 110, '2023-02-01', 15000),
(26, 2, 110, '2022-05-01', 10000),
(27, 2, 110, '2022-06-01', 10000),
(28, 2, 110, '2022-07-01', 10000),
(29, 2, 110, '2022-08-01', 10000),
(30, 2, 110, '2022-09-01', 10000),
(31, 2, 110, '2022-10-01', 10000),
(32, 2, 110, '2022-11-01', 10000),
(33, 2, 110, '2022-12-01', 10000),
(34, 2, 110, '2023-01-01', 10000),
(35, 2, 110, '2023-02-01', 10000),
(36, 2, 110, '2023-03-01', 10000),
(37, 2, 110, '2023-04-01', 10000),
(38, 2, 110, '2023-05-01', 10000),
(39, 2, 110, '2023-06-01', 10000),
(40, 2, 110, '2023-07-01', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_10_10_143303_create_attendances_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthname`
--

CREATE TABLE `monthname` (
  `MonthID` int(8) NOT NULL,
  `MonthName` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthname`
--

INSERT INTO `monthname` (`MonthID`, `MonthName`) VALUES
(10, 'Oct-2021'),
(11, 'Nov-2021'),
(12, 'Dec-2021'),
(13, 'Jan-2022'),
(14, 'Feb-2022'),
(15, 'Mar-2022'),
(16, 'Apr-2022'),
(17, 'May-2022'),
(18, 'Jun-2022'),
(19, 'Jul-2022'),
(20, 'Aug-2022'),
(21, 'Sep-2022'),
(22, 'Oct-2022'),
(23, 'Nov-2022'),
(24, 'Dec-2022'),
(25, 'Jan-2023'),
(26, 'Feb-2023'),
(27, 'Mar-2023'),
(28, 'Apr-2023'),
(29, 'May-2023'),
(30, 'Jun-2023'),
(31, 'Jul-2023'),
(32, 'Aug-2023'),
(33, 'Sep-2023'),
(34, 'Oct-2023'),
(35, 'Nov-2023'),
(36, 'Dec-2023');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int(8) NOT NULL,
  `Table` varchar(55) DEFAULT NULL,
  `Action` varchar(55) DEFAULT NULL,
  `Allow` varchar(1) DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `Table`, `Action`, `Allow`) VALUES
(1, 'Employee', 'View', 'Y'),
(12, 'Employee', 'Create', 'Y'),
(13, 'Employee', 'Update', 'Y'),
(14, 'Employee', 'Delete', 'Y'),
(15, 'Employee', 'List', 'Y'),
(16, 'Employee', 'Detail', 'Y'),
(17, 'Deposit', 'View', 'Y'),
(18, 'Deposit', 'Create/List', 'Y'),
(19, 'Deposit', 'Update', 'Y'),
(20, 'Deposit', 'Delete', 'Y'),
(21, 'Deposit', 'List', 'Y'),
(22, 'Import Attendance', 'Import', 'Y'),
(23, 'Salary', 'Make', 'Y'),
(24, 'Search Salary', 'List', 'Y'),
(25, 'Search Salary', 'Delete', 'Y'),
(26, 'Operation Manager', 'List/Create', 'Y'),
(27, 'Operation Manager', 'Update', 'Y'),
(28, 'Operation Manager', 'Delete', 'Y'),
(29, 'Operation Manager', 'View', 'Y'),
(30, 'Branch', 'Create/List', 'Y'),
(31, 'Branch', 'Update', 'Y'),
(32, 'Branch', 'Delete', 'Y'),
(33, 'Department', 'Create/List', 'Y'),
(34, 'Department', 'Update', 'Y'),
(35, 'Department', 'Delete', 'Y'),
(36, 'Job Title', 'Create/List', 'Y'),
(37, 'Job Title', 'Update', 'Y'),
(38, 'Job Title', 'Delete', 'Y'),
(39, 'Letter Template', 'Create / List', 'Y'),
(40, 'Letter Template', 'Update', 'Y'),
(41, 'Letter Template', 'Delete', 'Y'),
(42, 'Team Structure', 'List', 'Y'),
(43, 'Users', 'Create / List', 'Y'),
(44, 'Users', 'Update', 'Y'),
(45, 'Users', 'Delete', 'Y'),
(46, 'Employee Detail', 'List', 'Y'),
(47, 'Employee Detail', 'Files Upload/List', 'Y'),
(48, 'Employee Detail', 'File Delete', 'Y'),
(49, 'Employee Detail', 'Salary View', 'Y'),
(50, 'Employee Detail', 'Salary Commission View', 'Y'),
(51, 'Employee Detail', 'Letter Issue / Letter Issued', 'Y'),
(52, 'Employee Detail', 'Delete Issued Letter', 'Y'),
(53, 'Employee Detail', 'Print Issued Letter', 'Y'),
(54, 'Employee Detail', 'Leave Create / List', 'Y'),
(55, 'Employee Detail', 'Leave Delete', 'Y'),
(56, 'Employee Detail', 'Leave Edit', 'Y'),
(57, 'Employee Detail', 'Attendance View', 'Y'),
(58, 'Employee Detail', 'Warning Letter List', 'Y'),
(59, 'Employee Detail', 'Deposit', 'Y'),
(60, 'Employee Detail', 'Supervising', 'Y'),
(61, 'Team Hierarchy', 'View', 'Y'),
(62, 'Employee Detail', 'Issued Letter Update', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `SalaryID` int(11) NOT NULL,
  `BranchID` int(11) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `EmployeeName` varchar(75) DEFAULT NULL,
  `JobTitle` varchar(75) DEFAULT NULL,
  `Department` varchar(75) DEFAULT NULL,
  `MonthName` varchar(255) DEFAULT NULL,
  `StaffType` varchar(25) DEFAULT NULL,
  `DaysPresent` double(12,2) DEFAULT NULL,
  `LWPay` double(12,2) DEFAULT NULL,
  `PerDay` double(12,2) DEFAULT NULL,
  `BasicSalary` double(12,2) DEFAULT NULL,
  `HRA` double(12,2) DEFAULT NULL,
  `Transport` double(12,2) DEFAULT NULL,
  `OtherAllowance` double(12,2) DEFAULT NULL,
  `AdvanceLoan` double(12,2) DEFAULT NULL,
  `LeaveDeduction` double(12,2) DEFAULT NULL,
  `TotalDeduction` double(12,2) DEFAULT NULL,
  `GrandSalary` double(12,2) DEFAULT NULL,
  `NetSalary` double(12,2) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UserID` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stafftype`
--

CREATE TABLE `stafftype` (
  `StaffTypeID` int(8) NOT NULL,
  `StaffType` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stafftype`
--

INSERT INTO `stafftype` (`StaffTypeID`, `StaffType`) VALUES
(1, 'Agent'),
(2, 'Closer'),
(3, 'Floor Manager'),
(4, 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `StaffTypeID` int(8) NOT NULL,
  `StaffType` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_type`
--

INSERT INTO `staff_type` (`StaffTypeID`, `StaffType`) VALUES
(1, 'Agent'),
(2, 'Closer'),
(3, 'Floor Manager'),
(4, 'Regular'),
(5, 'HR'),
(6, 'GM'),
(7, 'OM'),
(8, 'Inactive'),
(9, 'Noel'),
(10, 'Admin'),
(11, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `t1`
--

CREATE TABLE `t1` (
  `EmployeeID` int(11) DEFAULT NULL,
  `EmployeeName` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CheckIn` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CheckOut` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t2`
--

CREATE TABLE `t2` (
  `EmployeeID` int(11) DEFAULT NULL,
  `EmployeeName` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CheckIn` time(6) DEFAULT NULL,
  `CheckOut` time(6) DEFAULT NULL,
  `Date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FinalTime` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `TitleID` int(8) NOT NULL,
  `Title` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`TitleID`, `Title`) VALUES
(1, 'Mr.'),
(2, 'Mrs.'),
(3, 'Miss.'),
(4, 'Ms.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(8) NOT NULL,
  `BranchID` int(8) DEFAULT NULL,
  `FullName` varchar(55) DEFAULT NULL,
  `Email` varchar(55) DEFAULT NULL,
  `Password` varchar(75) DEFAULT NULL,
  `UserType` varchar(25) DEFAULT NULL,
  `eDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Active` varchar(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `BranchID`, `FullName`, `Email`, `Password`, `UserType`, `eDate`, `Active`) VALUES
(1, 1, 'Kashif Mushtaq', 'gm@eits.ae', '123456', 'GM', '2022-11-02 12:02:52', 'Y'),
(2, 1, 'ASIM', 'hr@eits.ae', '123456', 'HR', '2022-11-02 12:05:39', 'Y'),
(7, 1, 'khalid khalil', 'khalid@inu.edu.pk', 'Password', 'User', '2021-06-21 05:48:00', 'Y'),
(8, 1, 'Rasheed2', 'rasheed3@inu.edu.pk', '333333', 'User', '2021-12-16 04:39:38', 'Y'),
(9, 1, 'kashif mushtaq', 'kashif@obexpert.com.pk', 'mmmmmm', 'Admin', '2021-12-21 07:49:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `RoleId` int(8) NOT NULL,
  `BranchID` int(8) DEFAULT NULL,
  `UserID` int(8) DEFAULT NULL,
  `Table` varchar(55) DEFAULT NULL,
  `Action` varchar(55) DEFAULT NULL,
  `Allow` varchar(10) DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`RoleId`, `BranchID`, `UserID`, `Table`, `Action`, `Allow`) VALUES
(3121, 1, 1, 'Employee', 'View', 'Y'),
(3122, 1, 1, 'Employee', 'Create', 'Y'),
(3123, 1, 1, 'Employee', 'Update', 'Y'),
(3124, 1, 1, 'Employee', 'Delete', 'Y'),
(3125, 1, 1, 'Employee', 'List', 'Y'),
(3126, 1, 1, 'Employee', 'Detail', 'Y'),
(3127, 1, 1, 'Deposit', 'View', 'Y'),
(3128, 1, 1, 'Deposit', 'Create/List', 'Y'),
(3129, 1, 1, 'Deposit', 'Update', 'Y'),
(3130, 1, 1, 'Deposit', 'Delete', 'Y'),
(3131, 1, 1, 'Deposit', 'List', 'Y'),
(3132, 1, 1, 'Import Attendance', 'Import', 'Y'),
(3133, 1, 1, 'Salary', 'Make', 'Y'),
(3134, 1, 1, 'Search Salary', 'List', 'Y'),
(3135, 1, 1, 'Search Salary', 'Delete', 'Y'),
(3136, 1, 1, 'Operation Manager', 'List/Create', 'Y'),
(3137, 1, 1, 'Operation Manager', 'Update', 'Y'),
(3138, 1, 1, 'Operation Manager', 'Delete', 'Y'),
(3139, 1, 1, 'Operation Manager', 'View', 'Y'),
(3140, 1, 1, 'Branch', 'Create/List', 'Y'),
(3141, 1, 1, 'Branch', 'Update', 'Y'),
(3142, 1, 1, 'Branch', 'Delete', 'Y'),
(3143, 1, 1, 'Department', 'Create/List', 'Y'),
(3144, 1, 1, 'Department', 'Update', 'Y'),
(3145, 1, 1, 'Department', 'Delete', 'Y'),
(3146, 1, 1, 'Job Title', 'Create/List', 'Y'),
(3147, 1, 1, 'Job Title', 'Update', 'Y'),
(3148, 1, 1, 'Job Title', 'Delete', 'Y'),
(3149, 1, 1, 'Letter Template', 'Create / List', 'Y'),
(3150, 1, 1, 'Letter Template', 'Update', 'Y'),
(3151, 1, 1, 'Letter Template', 'Delete', 'Y'),
(3152, 1, 1, 'Team Structure', 'List', 'Y'),
(3153, 1, 1, 'Users', 'Create / List', 'Y'),
(3154, 1, 1, 'Users', 'Update', 'Y'),
(3155, 1, 1, 'Users', 'Delete', 'Y'),
(3156, 1, 1, 'Employee Detail', 'List', 'Y'),
(3157, 1, 1, 'Employee Detail', 'Files Upload/List', 'Y'),
(3158, 1, 1, 'Employee Detail', 'File Delete', 'Y'),
(3159, 1, 1, 'Employee Detail', 'Salary View', 'Y'),
(3160, 1, 1, 'Employee Detail', 'Salary Commission View', 'Y'),
(3161, 1, 1, 'Employee Detail', 'Letter Issue / Letter Issued', 'Y'),
(3162, 1, 1, 'Employee Detail', 'Delete Issued Letter', 'Y'),
(3163, 1, 1, 'Employee Detail', 'Print Issued Letter', 'Y'),
(3164, 1, 1, 'Employee Detail', 'Leave Create / List', 'Y'),
(3165, 1, 1, 'Employee Detail', 'Leave Delete', 'Y'),
(3166, 1, 1, 'Employee Detail', 'Leave Edit', 'Y'),
(3167, 1, 1, 'Employee Detail', 'Attendance View', 'Y'),
(3168, 1, 1, 'Employee Detail', 'Warning Letter List', 'Y'),
(3169, 1, 1, 'Employee Detail', 'Deposit', 'Y'),
(3170, 1, 1, 'Employee Detail', 'Supervising', 'Y'),
(3171, 1, 1, 'Employee Detail', 'Issued Letter Update', 'Y'),
(3172, 1, 1, 'Team Hierarchy', 'View', 'Y'),
(3225, 1, 14, 'Employee', 'View', 'Y'),
(3226, 1, 14, 'Employee', 'Create', 'Y'),
(3227, 1, 14, 'Employee', 'Update', 'Y'),
(3228, 1, 14, 'Employee', 'Delete', 'Y'),
(3229, 1, 14, 'Employee', 'List', 'Y'),
(3230, 1, 14, 'Employee', 'Detail', 'Y'),
(3231, 1, 14, 'Deposit', 'View', 'Y'),
(3232, 1, 14, 'Deposit', 'Create/List', 'Y'),
(3233, 1, 14, 'Deposit', 'Update', 'Y'),
(3234, 1, 14, 'Deposit', 'Delete', 'Y'),
(3235, 1, 14, 'Deposit', 'List', 'Y'),
(3236, 1, 14, 'Import Attendance', 'Import', 'Y'),
(3237, 1, 14, 'Salary', 'Make', 'Y'),
(3238, 1, 14, 'Search Salary', 'List', 'Y'),
(3239, 1, 14, 'Search Salary', 'Delete', 'Y'),
(3240, 1, 14, 'Operation Manager', 'List/Create', 'Y'),
(3241, 1, 14, 'Operation Manager', 'Update', 'Y'),
(3242, 1, 14, 'Operation Manager', 'Delete', 'Y'),
(3243, 1, 14, 'Operation Manager', 'View', 'Y'),
(3244, 1, 14, 'Branch', 'Create/List', 'Y'),
(3245, 1, 14, 'Branch', 'Update', 'Y'),
(3246, 1, 14, 'Branch', 'Delete', 'Y'),
(3247, 1, 14, 'Department', 'Create/List', 'Y'),
(3248, 1, 14, 'Department', 'Update', 'Y'),
(3249, 1, 14, 'Department', 'Delete', 'Y'),
(3250, 1, 14, 'Job Title', 'Create/List', 'Y'),
(3251, 1, 14, 'Job Title', 'Update', 'Y'),
(3252, 1, 14, 'Job Title', 'Delete', 'Y'),
(3253, 1, 14, 'Letter Template', 'Create / List', 'Y'),
(3254, 1, 14, 'Letter Template', 'Update', 'Y'),
(3255, 1, 14, 'Letter Template', 'Delete', 'Y'),
(3256, 1, 14, 'Team Structure', 'List', 'Y'),
(3257, 1, 14, 'Users', 'Create / List', 'Y'),
(3258, 1, 14, 'Users', 'Update', 'Y'),
(3259, 1, 14, 'Users', 'Delete', 'Y'),
(3260, 1, 14, 'Employee Detail', 'List', 'Y'),
(3261, 1, 14, 'Employee Detail', 'Files Upload/List', 'Y'),
(3262, 1, 14, 'Employee Detail', 'File Delete', 'Y'),
(3263, 1, 14, 'Employee Detail', 'Salary View', 'Y'),
(3264, 1, 14, 'Employee Detail', 'Salary Commission View', 'Y'),
(3265, 1, 14, 'Employee Detail', 'Letter Issue / Letter Issued', 'Y'),
(3266, 1, 14, 'Employee Detail', 'Delete Issued Letter', 'Y'),
(3267, 1, 14, 'Employee Detail', 'Print Issued Letter', 'Y'),
(3268, 1, 14, 'Employee Detail', 'Leave Create / List', 'Y'),
(3269, 1, 14, 'Employee Detail', 'Leave Delete', 'Y'),
(3270, 1, 14, 'Employee Detail', 'Leave Edit', 'Y'),
(3271, 1, 14, 'Employee Detail', 'Attendance View', 'Y'),
(3272, 1, 14, 'Employee Detail', 'Warning Letter List', 'Y'),
(3273, 1, 14, 'Employee Detail', 'Deposit', 'Y'),
(3274, 1, 14, 'Employee Detail', 'Supervising', 'Y'),
(3275, 1, 14, 'Employee Detail', 'Issued Letter Update', 'Y'),
(3276, 1, 14, 'Team Hierarchy', 'View', 'Y'),
(3277, 1, 2, 'Employee', 'View', 'Y'),
(3278, 1, 2, 'Employee', 'Create', 'Y'),
(3279, 1, 2, 'Employee', 'Update', 'Y'),
(3280, 1, 2, 'Employee', 'Delete', 'Y'),
(3281, 1, 2, 'Employee', 'List', 'Y'),
(3282, 1, 2, 'Employee', 'Detail', 'Y'),
(3283, 1, 2, 'Deposit', 'View', 'Y'),
(3284, 1, 2, 'Deposit', 'Create/List', 'Y'),
(3285, 1, 2, 'Deposit', 'Update', 'Y'),
(3286, 1, 2, 'Deposit', 'Delete', 'Y'),
(3287, 1, 2, 'Deposit', 'List', 'Y'),
(3288, 1, 2, 'Import Attendance', 'Import', 'Y'),
(3289, 1, 2, 'Salary', 'Make', 'Y'),
(3290, 1, 2, 'Search Salary', 'List', 'Y'),
(3291, 1, 2, 'Search Salary', 'Delete', 'Y'),
(3292, 1, 2, 'Operation Manager', 'List/Create', 'Y'),
(3293, 1, 2, 'Operation Manager', 'Update', 'Y'),
(3294, 1, 2, 'Operation Manager', 'Delete', 'Y'),
(3295, 1, 2, 'Operation Manager', 'View', 'Y'),
(3296, 1, 2, 'Branch', 'Create/List', 'Y'),
(3297, 1, 2, 'Branch', 'Update', 'Y'),
(3298, 1, 2, 'Branch', 'Delete', 'Y'),
(3299, 1, 2, 'Department', 'Create/List', 'Y'),
(3300, 1, 2, 'Department', 'Update', 'Y'),
(3301, 1, 2, 'Department', 'Delete', 'Y'),
(3302, 1, 2, 'Job Title', 'Create/List', 'Y'),
(3303, 1, 2, 'Job Title', 'Update', 'Y'),
(3304, 1, 2, 'Job Title', 'Delete', 'Y'),
(3305, 1, 2, 'Letter Template', 'Create / List', 'Y'),
(3306, 1, 2, 'Letter Template', 'Update', 'Y'),
(3307, 1, 2, 'Letter Template', 'Delete', 'Y'),
(3308, 1, 2, 'Team Structure', 'List', 'Y'),
(3309, 1, 2, 'Users', 'Create / List', 'Y'),
(3310, 1, 2, 'Users', 'Update', 'Y'),
(3311, 1, 2, 'Users', 'Delete', 'Y'),
(3312, 1, 2, 'Employee Detail', 'List', 'Y'),
(3313, 1, 2, 'Employee Detail', 'Files Upload/List', 'Y'),
(3314, 1, 2, 'Employee Detail', 'File Delete', 'Y'),
(3315, 1, 2, 'Employee Detail', 'Salary View', 'Y'),
(3316, 1, 2, 'Employee Detail', 'Salary Commission View', 'Y'),
(3317, 1, 2, 'Employee Detail', 'Letter Issue / Letter Issued', 'Y'),
(3318, 1, 2, 'Employee Detail', 'Delete Issued Letter', 'Y'),
(3319, 1, 2, 'Employee Detail', 'Print Issued Letter', 'Y'),
(3320, 1, 2, 'Employee Detail', 'Leave Create / List', 'Y'),
(3321, 1, 2, 'Employee Detail', 'Leave Delete', 'Y'),
(3322, 1, 2, 'Employee Detail', 'Leave Edit', 'Y'),
(3323, 1, 2, 'Employee Detail', 'Attendance View', 'Y'),
(3324, 1, 2, 'Employee Detail', 'Warning Letter List', 'Y'),
(3325, 1, 2, 'Employee Detail', 'Deposit', 'Y'),
(3326, 1, 2, 'Employee Detail', 'Supervising', 'Y'),
(3327, 1, 2, 'Employee Detail', 'Issued Letter Update', 'Y'),
(3328, 1, 2, 'Team Hierarchy', 'View', 'Y');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vvv`
-- (See below for the actual view)
--
CREATE TABLE `vvv` (
`EmployeeID` int(11)
,`CheckIn` varchar(10)
,`CheckOut` varchar(10)
,`Date` varchar(10)
,`EmployeeName` varchar(55)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_agent_salary`
-- (See below for the actual view)
--
CREATE TABLE `v_agent_salary` (
`BranchID` int(8)
,`EmployeeID` int(11)
,`FTDAmount` decimal(32,0)
,`MonthName` varchar(37)
,`SupervisorID` int(8)
,`Total` bigint(21)
,`StaffType` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_alerts`
-- (See below for the actual view)
--
CREATE TABLE `v_alerts` (
`VisaExpiry` bigint(21)
,`PassportExpiry` bigint(21)
,`BranchID` int(8)
,`EmployeeID` int(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_attendance`
-- (See below for the actual view)
--
CREATE TABLE `v_attendance` (
`EmployeeID` int(11)
,`CheckIn` varchar(10)
,`CheckOut` varchar(10)
,`Date` varchar(10)
,`EmployeeName` varchar(55)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_closer_salary`
-- (See below for the actual view)
--
CREATE TABLE `v_closer_salary` (
`BranchID` int(8)
,`EmployeeID` int(8)
,`FTDAmount` decimal(54,0)
,`MonthName` varchar(37)
,`SupervisorID` int(8)
,`Total` decimal(42,0)
,`StaffType` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_documents`
-- (See below for the actual view)
--
CREATE TABLE `v_documents` (
`DocumentID` int(10)
,`EmployeeID` int(10)
,`FileName` varchar(55)
,`File` varchar(55)
,`FileSize` varchar(12)
,`eDate` varchar(23)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_employee`
-- (See below for the actual view)
--
CREATE TABLE `v_employee` (
`FirstName` varchar(88)
,`MiddleName` varchar(88)
,`LastName` varchar(88)
,`JobTitleName` varchar(99)
,`DepartmentName` varchar(75)
,`BranchName` varchar(150)
,`EmployeeID` int(8)
,`Picture` varchar(75)
,`Email` varchar(35)
,`MobileNo` varchar(35)
,`BranchID` int(8)
,`IsSupervisor` varchar(3)
,`DateOfBirth` date
,`VisaIssueDate` date
,`VisaExpiryDate` date
,`PassportNo` varchar(88)
,`PassportExpiry` date
,`EidNo` varchar(75)
,`EidExpiry` date
,`FullAddress` varchar(255)
,`HomePhone` varchar(35)
,`Gender` varchar(35)
,`SSNorGID` varchar(35)
,`MaritalStatus` varchar(35)
,`SpouseName` varchar(50)
,`SpouseEmployer` varchar(52)
,`SpouseWorkPhone` varchar(33)
,`JobTitleID` varchar(33)
,`DepartmentID` int(8)
,`SupervisorID` int(8)
,`WorkLocation` varchar(55)
,`EmailOffical` varchar(55)
,`WorkPhone` varchar(55)
,`StartDate` date
,`Salary` double(10,2)
,`NextofKinName` varchar(75)
,`NextofKinAddress` varchar(255)
,`NextofKinPhone` varchar(55)
,`NextofKinRelationship` varchar(55)
,`EducationLevel` varchar(55)
,`LastDegree` varchar(75)
,`eDate` timestamp
,`uDate` timestamp
,`Title` varchar(75)
,`ExtraComission` double(10,2)
,`SalaryRemarks` longtext
,`StaffType` varchar(25)
,`Nationality` varchar(35)
,`Password` varchar(25)
,`BankName` varchar(155)
,`IBAN` varchar(100)
,`AccountTitle` varchar(100)
,`SalaryType` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_emp_salary`
-- (See below for the actual view)
--
CREATE TABLE `v_emp_salary` (
`AllowanceTitle` varchar(75)
,`AllowanceType` varchar(15)
,`EmployeeAllowanceID` int(8)
,`EmployeeID` int(8)
,`AllowanceListID` int(8)
,`Amount` int(8)
,`Active` varchar(3)
,`eDate` timestamp
,`eDate1` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_fcb`
-- (See below for the actual view)
--
CREATE TABLE `v_fcb` (
`FCBID` int(12)
,`ID` int(8)
,`FTDAmount` int(11)
,`Date` varchar(10)
,`MonthName` varchar(37)
,`Compliant` varchar(25)
,`KYCSent` varchar(25)
,`FirstName` varchar(88)
,`MiddleName` varchar(88)
,`LastName` varchar(88)
,`Dialer` int(11)
,`EmployeeID` int(11)
,`BranchID` int(8)
,`Remarks` longtext
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_fcb_summary`
-- (See below for the actual view)
--
CREATE TABLE `v_fcb_summary` (
`BranchID` int(8)
,`EmployeeID` int(11)
,`FTDAmount` int(11)
,`MonthName` varchar(37)
,`Total` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_floor_manager_salary`
-- (See below for the actual view)
--
CREATE TABLE `v_floor_manager_salary` (
`BranchID` int(8)
,`EmployeeID` int(8)
,`FTDAmount` decimal(54,0)
,`MonthName` varchar(37)
,`SupervisorID` int(8)
,`Total` decimal(42,0)
,`StaffType` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_leave`
-- (See below for the actual view)
--
CREATE TABLE `v_leave` (
`LeaveID` int(8)
,`BranchName` varchar(150)
,`EmployeeID` int(8)
,`FirstName` varchar(88)
,`MiddleName` varchar(88)
,`LastName` varchar(88)
,`JobTitleName` varchar(99)
,`DepartmentName` varchar(75)
,`FromDate` date
,`ToDate` date
,`NoOfDays` int(7)
,`Reason` longtext
,`DaysApproved` int(3)
,`DaysRemaining` int(3)
,`OMStatus` varchar(20)
,`HRStatus` varchar(20)
,`GMStatus` varchar(20)
,`BranchID` int(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_passportexpiry`
-- (See below for the actual view)
--
CREATE TABLE `v_passportexpiry` (
`Total` bigint(21)
,`BranchID` int(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_passport_expiry_list`
-- (See below for the actual view)
--
CREATE TABLE `v_passport_expiry_list` (
`FirstName` varchar(88)
,`MiddleName` varchar(88)
,`LastName` varchar(88)
,`DepartmentName` varchar(75)
,`BranchName` varchar(150)
,`EmployeeID` int(8)
,`Picture` varchar(75)
,`Email` varchar(35)
,`MobileNo` varchar(35)
,`BranchID` int(8)
,`IsSupervisor` varchar(3)
,`DateOfBirth` date
,`VisaIssueDate` date
,`VisaExpiryDate` date
,`PassportNo` varchar(88)
,`PassportExpiry` date
,`EidNo` varchar(75)
,`EidExpiry` date
,`FullAddress` varchar(255)
,`HomePhone` varchar(35)
,`Gender` varchar(35)
,`SSNorGID` varchar(35)
,`MaritalStatus` varchar(35)
,`SpouseName` varchar(50)
,`SpouseEmployer` varchar(52)
,`SpouseWorkPhone` varchar(33)
,`JobTitleID` varchar(33)
,`DepartmentID` int(8)
,`SupervisorID` int(8)
,`WorkLocation` varchar(55)
,`EmailOffical` varchar(55)
,`WorkPhone` varchar(55)
,`StartDate` date
,`Salary` double(10,2)
,`NextofKinName` varchar(75)
,`NextofKinAddress` varchar(255)
,`NextofKinPhone` varchar(55)
,`NextofKinRelationship` varchar(55)
,`EducationLevel` varchar(55)
,`LastDegree` varchar(75)
,`eDate` timestamp
,`uDate` timestamp
,`Title` varchar(75)
,`ExtraComission` double(10,2)
,`SalaryRemarks` longtext
,`StaffType` varchar(25)
,`Nationality` varchar(35)
,`JobTitleName` varchar(99)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_supervisor`
-- (See below for the actual view)
--
CREATE TABLE `v_supervisor` (
`EmployeeID` int(8)
,`IsSupervisor` varchar(3)
,`Title` varchar(75)
,`FirstName` varchar(88)
,`MiddleName` varchar(88)
,`LastName` varchar(88)
,`BranchID` int(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_union_salary`
-- (See below for the actual view)
--
CREATE TABLE `v_union_salary` (
`BranchID` int(11)
,`EmployeeID` int(11)
,`FTDAmount` decimal(54,0)
,`MonthName` varchar(37)
,`SupervisorID` int(11)
,`Total` decimal(42,0)
,`StaffType` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_users`
-- (See below for the actual view)
--
CREATE TABLE `v_users` (
`UserID` int(8)
,`BranchID` int(8)
,`FullName` varchar(55)
,`Email` varchar(55)
,`Password` varchar(75)
,`UserType` varchar(25)
,`eDate` timestamp
,`Active` varchar(1)
,`BranchName` varchar(150)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_visaexpiry`
-- (See below for the actual view)
--
CREATE TABLE `v_visaexpiry` (
`Total` bigint(21)
,`BranchID` int(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_visa_expiry_list`
-- (See below for the actual view)
--
CREATE TABLE `v_visa_expiry_list` (
`FirstName` varchar(88)
,`MiddleName` varchar(88)
,`LastName` varchar(88)
,`JobTitleName` varchar(99)
,`DepartmentName` varchar(75)
,`BranchName` varchar(150)
,`EmployeeID` int(8)
,`Picture` varchar(75)
,`Email` varchar(35)
,`MobileNo` varchar(35)
,`BranchID` int(8)
,`IsSupervisor` varchar(3)
,`DateOfBirth` date
,`VisaIssueDate` date
,`VisaExpiryDate` date
,`PassportNo` varchar(88)
,`PassportExpiry` date
,`EidNo` varchar(75)
,`EidExpiry` date
,`FullAddress` varchar(255)
,`HomePhone` varchar(35)
,`Gender` varchar(35)
,`SSNorGID` varchar(35)
,`MaritalStatus` varchar(35)
,`SpouseName` varchar(50)
,`SpouseEmployer` varchar(52)
,`SpouseWorkPhone` varchar(33)
,`JobTitleID` varchar(33)
,`DepartmentID` int(8)
,`SupervisorID` int(8)
,`WorkLocation` varchar(55)
,`EmailOffical` varchar(55)
,`WorkPhone` varchar(55)
,`StartDate` date
,`Salary` double(10,2)
,`NextofKinName` varchar(75)
,`NextofKinAddress` varchar(255)
,`NextofKinPhone` varchar(55)
,`NextofKinRelationship` varchar(55)
,`EducationLevel` varchar(55)
,`LastDegree` varchar(75)
,`eDate` timestamp
,`uDate` timestamp
,`Title` varchar(75)
,`ExtraComission` double(10,2)
,`SalaryRemarks` longtext
,`StaffType` varchar(25)
,`Nationality` varchar(35)
);

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `YearID` int(8) NOT NULL,
  `YearName` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`YearID`, `YearName`) VALUES
(1, 2021),
(2, 2022),
(3, 2023),
(4, 2024),
(5, 2025),
(6, 2026),
(7, 2027),
(8, 2028),
(9, 2029),
(10, 2030);

-- --------------------------------------------------------

--
-- Structure for view `vvv`
--
DROP TABLE IF EXISTS `vvv`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vvv`  AS SELECT `v_attendance`.`EmployeeID` AS `EmployeeID`, `v_attendance`.`CheckIn` AS `CheckIn`, `v_attendance`.`CheckOut` AS `CheckOut`, `v_attendance`.`Date` AS `Date`, `v_attendance`.`EmployeeName` AS `EmployeeName` FROM `v_attendance` WHERE (`v_attendance`.`EmployeeID` = 41) GROUP BY `v_attendance`.`EmployeeID`, `v_attendance`.`CheckIn`, `v_attendance`.`CheckOut`, `v_attendance`.`Date`, `v_attendance`.`EmployeeName` ORDER BY `v_attendance`.`Date` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_agent_salary`
--
DROP TABLE IF EXISTS `v_agent_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_agent_salary`  AS SELECT `fcb`.`BranchID` AS `BranchID`, `fcb`.`EmployeeID` AS `EmployeeID`, sum(`fcb`.`FTDAmount`) AS `FTDAmount`, date_format(`fcb`.`Date`,'%b-%Y') AS `MonthName`, `employee`.`SupervisorID` AS `SupervisorID`, count(`fcb`.`FCBID`) AS `Total`, `employee`.`StaffType` AS `StaffType` FROM (`employee` join `fcb` on((`fcb`.`EmployeeID` = `employee`.`EmployeeID`))) WHERE ((`employee`.`StaffType` = 'Agent') AND (`fcb`.`Compliant` = 'YES') AND (`fcb`.`KYCSent` = 'YES')) GROUP BY `employee`.`SupervisorID`, `fcb`.`BranchID`, `fcb`.`EmployeeID`, date_format(`fcb`.`Date`,'%b-%Y'), `employee`.`StaffType` ;

-- --------------------------------------------------------

--
-- Structure for view `v_alerts`
--
DROP TABLE IF EXISTS `v_alerts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_alerts`  AS SELECT timestampdiff(DAY,sysdate(),`employee`.`VisaExpiryDate`) AS `VisaExpiry`, timestampdiff(DAY,sysdate(),`employee`.`PassportExpiry`) AS `PassportExpiry`, `employee`.`BranchID` AS `BranchID`, `employee`.`EmployeeID` AS `EmployeeID` FROM `employee` ;

-- --------------------------------------------------------

--
-- Structure for view `v_attendance`
--
DROP TABLE IF EXISTS `v_attendance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_attendance`  AS SELECT `attendance`.`EmployeeID` AS `EmployeeID`, if((`attendance`.`Status` = 'Check-in'),date_format(`attendance`.`DateTime`,'%H:%i'),0) AS `CheckIn`, if((`attendance`.`Status` = 'Check-out'),date_format(`attendance`.`DateTime`,'%H:%i'),0) AS `CheckOut`, date_format(`attendance`.`DateTime`,'%d-%m-%Y') AS `Date`, `attendance`.`EmployeeName` AS `EmployeeName` FROM `attendance` GROUP BY `attendance`.`EmployeeID`, `attendance`.`EmployeeName`, `attendance`.`DateTime`, `attendance`.`Status` ;

-- --------------------------------------------------------

--
-- Structure for view `v_closer_salary`
--
DROP TABLE IF EXISTS `v_closer_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_closer_salary`  AS SELECT `employee`.`BranchID` AS `BranchID`, `employee`.`EmployeeID` AS `EmployeeID`, sum(`v_agent_salary`.`FTDAmount`) AS `FTDAmount`, `v_agent_salary`.`MonthName` AS `MonthName`, `employee`.`SupervisorID` AS `SupervisorID`, sum(`v_agent_salary`.`Total`) AS `Total`, `employee`.`StaffType` AS `StaffType` FROM (`employee` join `v_agent_salary` on((`employee`.`EmployeeID` = `v_agent_salary`.`SupervisorID`))) WHERE (`employee`.`StaffType` = 'Closer') GROUP BY `employee`.`EmployeeID`, `employee`.`BranchID`, `v_agent_salary`.`MonthName`, `employee`.`StaffType`, `employee`.`SupervisorID` ;

-- --------------------------------------------------------

--
-- Structure for view `v_documents`
--
DROP TABLE IF EXISTS `v_documents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_documents`  AS SELECT `documents`.`DocumentID` AS `DocumentID`, `documents`.`EmployeeID` AS `EmployeeID`, `documents`.`FileName` AS `FileName`, `documents`.`File` AS `File`, `documents`.`FileSize` AS `FileSize`, date_format(`documents`.`eDate`,'%d-%m-%Y,  %H:%i') AS `eDate` FROM `documents` ;

-- --------------------------------------------------------

--
-- Structure for view `v_employee`
--
DROP TABLE IF EXISTS `v_employee`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_employee`  AS SELECT `employee`.`FirstName` AS `FirstName`, `employee`.`MiddleName` AS `MiddleName`, `employee`.`LastName` AS `LastName`, `jobtitle`.`JobTitleName` AS `JobTitleName`, `department`.`DepartmentName` AS `DepartmentName`, `branch`.`BranchName` AS `BranchName`, `employee`.`EmployeeID` AS `EmployeeID`, `employee`.`Picture` AS `Picture`, `employee`.`Email` AS `Email`, `employee`.`MobileNo` AS `MobileNo`, `employee`.`BranchID` AS `BranchID`, `employee`.`IsSupervisor` AS `IsSupervisor`, `employee`.`DateOfBirth` AS `DateOfBirth`, `employee`.`VisaIssueDate` AS `VisaIssueDate`, `employee`.`VisaExpiryDate` AS `VisaExpiryDate`, `employee`.`PassportNo` AS `PassportNo`, `employee`.`PassportExpiry` AS `PassportExpiry`, `employee`.`EidNo` AS `EidNo`, `employee`.`EidExpiry` AS `EidExpiry`, `employee`.`FullAddress` AS `FullAddress`, `employee`.`HomePhone` AS `HomePhone`, `employee`.`Gender` AS `Gender`, `employee`.`SSNorGID` AS `SSNorGID`, `employee`.`MaritalStatus` AS `MaritalStatus`, `employee`.`SpouseName` AS `SpouseName`, `employee`.`SpouseEmployer` AS `SpouseEmployer`, `employee`.`SpouseWorkPhone` AS `SpouseWorkPhone`, `employee`.`JobTitleID` AS `JobTitleID`, `employee`.`DepartmentID` AS `DepartmentID`, `employee`.`SupervisorID` AS `SupervisorID`, `employee`.`WorkLocation` AS `WorkLocation`, `employee`.`EmailOffical` AS `EmailOffical`, `employee`.`WorkPhone` AS `WorkPhone`, `employee`.`StartDate` AS `StartDate`, `employee`.`Salary` AS `Salary`, `employee`.`NextofKinName` AS `NextofKinName`, `employee`.`NextofKinAddress` AS `NextofKinAddress`, `employee`.`NextofKinPhone` AS `NextofKinPhone`, `employee`.`NextofKinRelationship` AS `NextofKinRelationship`, `employee`.`EducationLevel` AS `EducationLevel`, `employee`.`LastDegree` AS `LastDegree`, `employee`.`eDate` AS `eDate`, `employee`.`uDate` AS `uDate`, `employee`.`Title` AS `Title`, `employee`.`ExtraComission` AS `ExtraComission`, `employee`.`SalaryRemarks` AS `SalaryRemarks`, `employee`.`StaffType` AS `StaffType`, `employee`.`Nationality` AS `Nationality`, `employee`.`Password` AS `Password`, `employee`.`BankName` AS `BankName`, `employee`.`IBAN` AS `IBAN`, `employee`.`AccountTitle` AS `AccountTitle`, `employee`.`SalaryType` AS `SalaryType` FROM (((`employee` left join `jobtitle` on((`employee`.`JobTitleID` = `jobtitle`.`JobTitleID`))) left join `department` on((`employee`.`DepartmentID` = `department`.`DepartmentID`))) left join `branch` on((`employee`.`BranchID` = `branch`.`BranchID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_emp_salary`
--
DROP TABLE IF EXISTS `v_emp_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cpses_ex9y2q5xyc`@`localhost` SQL SECURITY DEFINER VIEW `v_emp_salary`  AS SELECT `allowance_list`.`AllowanceTitle` AS `AllowanceTitle`, `allowance_list`.`AllowanceType` AS `AllowanceType`, `emp_salary`.`EmployeeAllowanceID` AS `EmployeeAllowanceID`, `emp_salary`.`EmployeeID` AS `EmployeeID`, `emp_salary`.`AllowanceListID` AS `AllowanceListID`, `emp_salary`.`Amount` AS `Amount`, `emp_salary`.`Active` AS `Active`, `emp_salary`.`eDate` AS `eDate`, date_format(`emp_salary`.`eDate`,'%d/%m/%Y') AS `eDate1` FROM (`allowance_list` join `emp_salary` on((`allowance_list`.`AllowanceListID` = `emp_salary`.`AllowanceListID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_fcb`
--
DROP TABLE IF EXISTS `v_fcb`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_fcb`  AS SELECT `fcb`.`FCBID` AS `FCBID`, `fcb`.`ID` AS `ID`, `fcb`.`FTDAmount` AS `FTDAmount`, date_format(`fcb`.`Date`,'%d/%m/%Y') AS `Date`, date_format(`fcb`.`Date`,'%b-%Y') AS `MonthName`, `fcb`.`Compliant` AS `Compliant`, `fcb`.`KYCSent` AS `KYCSent`, `employee`.`FirstName` AS `FirstName`, `employee`.`MiddleName` AS `MiddleName`, `employee`.`LastName` AS `LastName`, `fcb`.`Dialer` AS `Dialer`, `fcb`.`EmployeeID` AS `EmployeeID`, `fcb`.`BranchID` AS `BranchID`, `fcb`.`Remarks` AS `Remarks` FROM (`fcb` join `employee` on((`fcb`.`EmployeeID` = `employee`.`EmployeeID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_fcb_summary`
--
DROP TABLE IF EXISTS `v_fcb_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_fcb_summary`  AS SELECT `fcb`.`BranchID` AS `BranchID`, `fcb`.`EmployeeID` AS `EmployeeID`, `fcb`.`FTDAmount` AS `FTDAmount`, date_format(`fcb`.`Date`,'%b-%Y') AS `MonthName`, count(`fcb`.`FCBID`) AS `Total` FROM `fcb` GROUP BY `fcb`.`BranchID`, `fcb`.`EmployeeID`, date_format(`fcb`.`Date`,'%b-%Y') ;

-- --------------------------------------------------------

--
-- Structure for view `v_floor_manager_salary`
--
DROP TABLE IF EXISTS `v_floor_manager_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_floor_manager_salary`  AS SELECT `employee`.`BranchID` AS `BranchID`, `employee`.`EmployeeID` AS `EmployeeID`, `v_closer_salary`.`FTDAmount` AS `FTDAmount`, `v_closer_salary`.`MonthName` AS `MonthName`, `v_closer_salary`.`SupervisorID` AS `SupervisorID`, `v_closer_salary`.`Total` AS `Total`, `employee`.`StaffType` AS `StaffType` FROM (`v_closer_salary` join `employee` on((`employee`.`EmployeeID` = `v_closer_salary`.`SupervisorID`))) WHERE (`employee`.`StaffType` = 'Floor Manager') GROUP BY `employee`.`StaffType`, `employee`.`SupervisorID`, `employee`.`BranchID`, `employee`.`EmployeeID`, `v_closer_salary`.`FTDAmount`, `v_closer_salary`.`MonthName`, `v_closer_salary`.`SupervisorID`, `v_closer_salary`.`Total` ;

-- --------------------------------------------------------

--
-- Structure for view `v_leave`
--
DROP TABLE IF EXISTS `v_leave`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_leave`  AS SELECT `leave`.`LeaveID` AS `LeaveID`, `branch`.`BranchName` AS `BranchName`, `leave`.`EmployeeID` AS `EmployeeID`, `v_employee`.`FirstName` AS `FirstName`, `v_employee`.`MiddleName` AS `MiddleName`, `v_employee`.`LastName` AS `LastName`, `v_employee`.`JobTitleName` AS `JobTitleName`, `v_employee`.`DepartmentName` AS `DepartmentName`, `leave`.`FromDate` AS `FromDate`, `leave`.`ToDate` AS `ToDate`, (to_days(`leave`.`ToDate`) - to_days(`leave`.`FromDate`)) AS `NoOfDays`, `leave`.`Reason` AS `Reason`, `leave`.`DaysApproved` AS `DaysApproved`, `leave`.`DaysRemaining` AS `DaysRemaining`, `leave`.`OMStatus` AS `OMStatus`, `leave`.`HRStatus` AS `HRStatus`, `leave`.`GMStatus` AS `GMStatus`, `leave`.`BranchID` AS `BranchID` FROM ((`leave` join `branch` on((`leave`.`BranchID` = `branch`.`BranchID`))) join `v_employee` on((`leave`.`EmployeeID` = `v_employee`.`EmployeeID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_passportexpiry`
--
DROP TABLE IF EXISTS `v_passportexpiry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_passportexpiry`  AS SELECT count(`v_alerts`.`PassportExpiry`) AS `Total`, `v_alerts`.`BranchID` AS `BranchID` FROM `v_alerts` WHERE (`v_alerts`.`PassportExpiry` <= 30) GROUP BY `v_alerts`.`BranchID` ;

-- --------------------------------------------------------

--
-- Structure for view `v_passport_expiry_list`
--
DROP TABLE IF EXISTS `v_passport_expiry_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_passport_expiry_list`  AS SELECT `v_employee`.`FirstName` AS `FirstName`, `v_employee`.`MiddleName` AS `MiddleName`, `v_employee`.`LastName` AS `LastName`, `v_employee`.`DepartmentName` AS `DepartmentName`, `v_employee`.`BranchName` AS `BranchName`, `v_employee`.`EmployeeID` AS `EmployeeID`, `v_employee`.`Picture` AS `Picture`, `v_employee`.`Email` AS `Email`, `v_employee`.`MobileNo` AS `MobileNo`, `v_employee`.`BranchID` AS `BranchID`, `v_employee`.`IsSupervisor` AS `IsSupervisor`, `v_employee`.`DateOfBirth` AS `DateOfBirth`, `v_employee`.`VisaIssueDate` AS `VisaIssueDate`, `v_employee`.`VisaExpiryDate` AS `VisaExpiryDate`, `v_employee`.`PassportNo` AS `PassportNo`, `v_employee`.`PassportExpiry` AS `PassportExpiry`, `v_employee`.`EidNo` AS `EidNo`, `v_employee`.`EidExpiry` AS `EidExpiry`, `v_employee`.`FullAddress` AS `FullAddress`, `v_employee`.`HomePhone` AS `HomePhone`, `v_employee`.`Gender` AS `Gender`, `v_employee`.`SSNorGID` AS `SSNorGID`, `v_employee`.`MaritalStatus` AS `MaritalStatus`, `v_employee`.`SpouseName` AS `SpouseName`, `v_employee`.`SpouseEmployer` AS `SpouseEmployer`, `v_employee`.`SpouseWorkPhone` AS `SpouseWorkPhone`, `v_employee`.`JobTitleID` AS `JobTitleID`, `v_employee`.`DepartmentID` AS `DepartmentID`, `v_employee`.`SupervisorID` AS `SupervisorID`, `v_employee`.`WorkLocation` AS `WorkLocation`, `v_employee`.`EmailOffical` AS `EmailOffical`, `v_employee`.`WorkPhone` AS `WorkPhone`, `v_employee`.`StartDate` AS `StartDate`, `v_employee`.`Salary` AS `Salary`, `v_employee`.`NextofKinName` AS `NextofKinName`, `v_employee`.`NextofKinAddress` AS `NextofKinAddress`, `v_employee`.`NextofKinPhone` AS `NextofKinPhone`, `v_employee`.`NextofKinRelationship` AS `NextofKinRelationship`, `v_employee`.`EducationLevel` AS `EducationLevel`, `v_employee`.`LastDegree` AS `LastDegree`, `v_employee`.`eDate` AS `eDate`, `v_employee`.`uDate` AS `uDate`, `v_employee`.`Title` AS `Title`, `v_employee`.`ExtraComission` AS `ExtraComission`, `v_employee`.`SalaryRemarks` AS `SalaryRemarks`, `v_employee`.`StaffType` AS `StaffType`, `v_employee`.`Nationality` AS `Nationality`, `v_employee`.`JobTitleName` AS `JobTitleName` FROM `v_employee` WHERE (timestampdiff(DAY,sysdate(),`v_employee`.`PassportExpiry`) <= 3030) ;

-- --------------------------------------------------------

--
-- Structure for view `v_supervisor`
--
DROP TABLE IF EXISTS `v_supervisor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_supervisor`  AS SELECT `employee`.`EmployeeID` AS `EmployeeID`, `employee`.`IsSupervisor` AS `IsSupervisor`, `employee`.`Title` AS `Title`, `employee`.`FirstName` AS `FirstName`, `employee`.`MiddleName` AS `MiddleName`, `employee`.`LastName` AS `LastName`, `employee`.`BranchID` AS `BranchID` FROM `employee` WHERE (`employee`.`IsSupervisor` = 'Yes') ;

-- --------------------------------------------------------

--
-- Structure for view `v_union_salary`
--
DROP TABLE IF EXISTS `v_union_salary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_union_salary`  AS SELECT `v_agent_salary`.`BranchID` AS `BranchID`, `v_agent_salary`.`EmployeeID` AS `EmployeeID`, `v_agent_salary`.`FTDAmount` AS `FTDAmount`, `v_agent_salary`.`MonthName` AS `MonthName`, `v_agent_salary`.`SupervisorID` AS `SupervisorID`, `v_agent_salary`.`Total` AS `Total`, `v_agent_salary`.`StaffType` AS `StaffType` FROM `v_agent_salary` ;

-- --------------------------------------------------------

--
-- Structure for view `v_users`
--
DROP TABLE IF EXISTS `v_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_users`  AS SELECT `users`.`UserID` AS `UserID`, `users`.`BranchID` AS `BranchID`, `users`.`FullName` AS `FullName`, `users`.`Email` AS `Email`, `users`.`Password` AS `Password`, `users`.`UserType` AS `UserType`, `users`.`eDate` AS `eDate`, `users`.`Active` AS `Active`, `branch`.`BranchName` AS `BranchName` FROM (`users` join `branch` on((`users`.`BranchID` = `branch`.`BranchID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_visaexpiry`
--
DROP TABLE IF EXISTS `v_visaexpiry`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_visaexpiry`  AS SELECT count(`v_alerts`.`VisaExpiry`) AS `Total`, `v_alerts`.`BranchID` AS `BranchID` FROM `v_alerts` WHERE (`v_alerts`.`VisaExpiry` <= 30) GROUP BY `v_alerts`.`BranchID` ;

-- --------------------------------------------------------

--
-- Structure for view `v_visa_expiry_list`
--
DROP TABLE IF EXISTS `v_visa_expiry_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_visa_expiry_list`  AS SELECT `v_employee`.`FirstName` AS `FirstName`, `v_employee`.`MiddleName` AS `MiddleName`, `v_employee`.`LastName` AS `LastName`, `v_employee`.`JobTitleName` AS `JobTitleName`, `v_employee`.`DepartmentName` AS `DepartmentName`, `v_employee`.`BranchName` AS `BranchName`, `v_employee`.`EmployeeID` AS `EmployeeID`, `v_employee`.`Picture` AS `Picture`, `v_employee`.`Email` AS `Email`, `v_employee`.`MobileNo` AS `MobileNo`, `v_employee`.`BranchID` AS `BranchID`, `v_employee`.`IsSupervisor` AS `IsSupervisor`, `v_employee`.`DateOfBirth` AS `DateOfBirth`, `v_employee`.`VisaIssueDate` AS `VisaIssueDate`, `v_employee`.`VisaExpiryDate` AS `VisaExpiryDate`, `v_employee`.`PassportNo` AS `PassportNo`, `v_employee`.`PassportExpiry` AS `PassportExpiry`, `v_employee`.`EidNo` AS `EidNo`, `v_employee`.`EidExpiry` AS `EidExpiry`, `v_employee`.`FullAddress` AS `FullAddress`, `v_employee`.`HomePhone` AS `HomePhone`, `v_employee`.`Gender` AS `Gender`, `v_employee`.`SSNorGID` AS `SSNorGID`, `v_employee`.`MaritalStatus` AS `MaritalStatus`, `v_employee`.`SpouseName` AS `SpouseName`, `v_employee`.`SpouseEmployer` AS `SpouseEmployer`, `v_employee`.`SpouseWorkPhone` AS `SpouseWorkPhone`, `v_employee`.`JobTitleID` AS `JobTitleID`, `v_employee`.`DepartmentID` AS `DepartmentID`, `v_employee`.`SupervisorID` AS `SupervisorID`, `v_employee`.`WorkLocation` AS `WorkLocation`, `v_employee`.`EmailOffical` AS `EmailOffical`, `v_employee`.`WorkPhone` AS `WorkPhone`, `v_employee`.`StartDate` AS `StartDate`, `v_employee`.`Salary` AS `Salary`, `v_employee`.`NextofKinName` AS `NextofKinName`, `v_employee`.`NextofKinAddress` AS `NextofKinAddress`, `v_employee`.`NextofKinPhone` AS `NextofKinPhone`, `v_employee`.`NextofKinRelationship` AS `NextofKinRelationship`, `v_employee`.`EducationLevel` AS `EducationLevel`, `v_employee`.`LastDegree` AS `LastDegree`, `v_employee`.`eDate` AS `eDate`, `v_employee`.`uDate` AS `uDate`, `v_employee`.`Title` AS `Title`, `v_employee`.`ExtraComission` AS `ExtraComission`, `v_employee`.`SalaryRemarks` AS `SalaryRemarks`, `v_employee`.`StaffType` AS `StaffType`, `v_employee`.`Nationality` AS `Nationality` FROM `v_employee` WHERE (timestampdiff(DAY,sysdate(),`v_employee`.`VisaExpiryDate`) <= 3030) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `allowance_list`
--
ALTER TABLE `allowance_list`
  ADD PRIMARY KEY (`AllowanceListID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BranchID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `deduction_list`
--
ALTER TABLE `deduction_list`
  ADD PRIMARY KEY (`DeductionListID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DocumentID`);

--
-- Indexes for table `document_category`
--
ALTER TABLE `document_category`
  ADD PRIMARY KEY (`DocumentCategoryID`);

--
-- Indexes for table `educationlevel`
--
ALTER TABLE `educationlevel`
  ADD PRIMARY KEY (`EducationLevelID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `employee_copy`
--
ALTER TABLE `employee_copy`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `emp_allowance`
--
ALTER TABLE `emp_allowance`
  ADD PRIMARY KEY (`EmployeeAllowanceID`);

--
-- Indexes for table `emp_deduction`
--
ALTER TABLE `emp_deduction`
  ADD PRIMARY KEY (`EmployeeDeductionID`);

--
-- Indexes for table `emp_salary`
--
ALTER TABLE `emp_salary`
  ADD PRIMARY KEY (`EmployeeAllowanceID`);

--
-- Indexes for table `eu`
--
ALTER TABLE `eu`
  ADD PRIMARY KEY (`EuID`);

--
-- Indexes for table `fcb`
--
ALTER TABLE `fcb`
  ADD PRIMARY KEY (`FCBID`);

--
-- Indexes for table `fleet_detail`
--
ALTER TABLE `fleet_detail`
  ADD PRIMARY KEY (`FleetDetailID`);

--
-- Indexes for table `fleet_master`
--
ALTER TABLE `fleet_master`
  ADD PRIMARY KEY (`FleetMasterID`);

--
-- Indexes for table `issue_letter`
--
ALTER TABLE `issue_letter`
  ADD PRIMARY KEY (`IssueLetterID`);

--
-- Indexes for table `jobtitle`
--
ALTER TABLE `jobtitle`
  ADD PRIMARY KEY (`JobTitleID`);

--
-- Indexes for table `leave`
--
ALTER TABLE `leave`
  ADD PRIMARY KEY (`LeaveID`);

--
-- Indexes for table `leave_status`
--
ALTER TABLE `leave_status`
  ADD PRIMARY KEY (`LeaveStatusID`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`LeaveTypeID`);

--
-- Indexes for table `letter`
--
ALTER TABLE `letter`
  ADD PRIMARY KEY (`LetterID`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`LoanID`);

--
-- Indexes for table `loan_deduction`
--
ALTER TABLE `loan_deduction`
  ADD PRIMARY KEY (`LoanDeductionID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthname`
--
ALTER TABLE `monthname`
  ADD PRIMARY KEY (`MonthID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`SalaryID`);

--
-- Indexes for table `stafftype`
--
ALTER TABLE `stafftype`
  ADD PRIMARY KEY (`StaffTypeID`);

--
-- Indexes for table `staff_type`
--
ALTER TABLE `staff_type`
  ADD PRIMARY KEY (`StaffTypeID`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`TitleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `office_id` (`BranchID`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`YearID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowance_list`
--
ALTER TABLE `allowance_list`
  MODIFY `AllowanceListID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1421;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `BranchID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `CompanyID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deduction_list`
--
ALTER TABLE `deduction_list`
  MODIFY `DeductionListID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DepartmentID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `DocumentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `document_category`
--
ALTER TABLE `document_category`
  MODIFY `DocumentCategoryID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `educationlevel`
--
ALTER TABLE `educationlevel`
  MODIFY `EducationLevelID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `employee_copy`
--
ALTER TABLE `employee_copy`
  MODIFY `EmployeeID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_allowance`
--
ALTER TABLE `emp_allowance`
  MODIFY `EmployeeAllowanceID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `emp_deduction`
--
ALTER TABLE `emp_deduction`
  MODIFY `EmployeeDeductionID` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_salary`
--
ALTER TABLE `emp_salary`
  MODIFY `EmployeeAllowanceID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `eu`
--
ALTER TABLE `eu`
  MODIFY `EuID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fcb`
--
ALTER TABLE `fcb`
  MODIFY `FCBID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `fleet_detail`
--
ALTER TABLE `fleet_detail`
  MODIFY `FleetDetailID` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fleet_master`
--
ALTER TABLE `fleet_master`
  MODIFY `FleetMasterID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `issue_letter`
--
ALTER TABLE `issue_letter`
  MODIFY `IssueLetterID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jobtitle`
--
ALTER TABLE `jobtitle`
  MODIFY `JobTitleID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `leave`
--
ALTER TABLE `leave`
  MODIFY `LeaveID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leave_status`
--
ALTER TABLE `leave_status`
  MODIFY `LeaveStatusID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `LeaveTypeID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `letter`
--
ALTER TABLE `letter`
  MODIFY `LetterID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `LoanID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_deduction`
--
ALTER TABLE `loan_deduction`
  MODIFY `LoanDeductionID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monthname`
--
ALTER TABLE `monthname`
  MODIFY `MonthID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `SalaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `stafftype`
--
ALTER TABLE `stafftype`
  MODIFY `StaffTypeID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `StaffTypeID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `TitleID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `RoleId` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3329;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `YearID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
