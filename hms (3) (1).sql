-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 05:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Adm_ID` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `username` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Adm_ID`, `Email`, `Password`, `username`) VALUES
(1, 'fahad.admin@example.com', 'fahad321', 'Fahad.Ali');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `appointment_date` date DEFAULT curdate(),
  `appointment_time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `pat_id`, `doc_id`, `description`, `status`, `appointment_date`, `appointment_time`) VALUES
(24, 6, 1, 'jsldsaj', 'Done', '2025-08-09', '23:20:04'),
(29, 5, 1, ',dm', 'Done', '2025-08-10', '00:26:29'),
(30, 2, 1, 'ewqwqjewj', 'Pending', '2025-08-10', '00:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_to`
--

CREATE TABLE `assigned_to` (
  `pat_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assigned_to`
--

INSERT INTO `assigned_to` (`pat_id`, `doc_id`, `assigned_at`) VALUES
(5, 1, '2025-08-06 18:13:43'),
(5, 4, '2025-08-06 18:13:35'),
(7, 1, '2025-08-09 19:05:02'),
(8, 1, '2025-08-09 13:53:47'),
(9, 1, '2025-08-09 17:26:04'),
(10, 1, '2025-08-09 17:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `food_charges` int(11) DEFAULT NULL,
  `doc_fee` int(11) NOT NULL,
  `lab_fee` int(11) DEFAULT NULL,
  `icu_fee` int(11) DEFAULT NULL,
  `medicine_fee` int(11) DEFAULT NULL,
  `surgeon_fee` int(11) DEFAULT NULL,
  `ward_charges` int(11) DEFAULT NULL,
  `theatre_fee` int(11) DEFAULT NULL,
  `stayed_days` int(11) DEFAULT NULL,
  `room_charges` int(11) DEFAULT NULL,
  `total_charges` int(11) NOT NULL,
  `pat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `food_charges`, `doc_fee`, `lab_fee`, `icu_fee`, `medicine_fee`, `surgeon_fee`, `ward_charges`, `theatre_fee`, `stayed_days`, `room_charges`, `total_charges`, `pat_id`) VALUES
(2, 432, 324324, 423243, 234, 324, 234243, 2442, 423324, 42342, 34244, 1451368014, 2);

-- --------------------------------------------------------

--
-- Table structure for table `collab_with`
--

CREATE TABLE `collab_with` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collab_with`
--

INSERT INTO `collab_with` (`id`, `doc_id`) VALUES
(1, 2),
(2, 2),
(5, 2),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `discharge_sheet`
--

CREATE TABLE `discharge_sheet` (
  `dis_id` int(11) NOT NULL,
  `revisit_date` date DEFAULT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `bill_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discharge_sheet`
--

INSERT INTO `discharge_sheet` (`dis_id`, `revisit_date`, `pat_id`, `bill_id`) VALUES
(2, '2025-08-20', 2, 2),
(3, '2025-08-20', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doc_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `name`, `username`, `password`, `gender`, `specialization`, `email`) VALUES
(1, 'Dr. Ahsan Malik', 'ahsan.malik', 'pass1234', 'M', 'Cardiologist', 'ahsan@gmail.com'),
(2, 'Dr. Sana Tariq', 'sana.tariq', 'secure567', 'F', 'Dermatologist', 'sana@gmail.com'),
(3, 'Dr. Faisal Qureshi', 'faisal.q', 'qwerty789', 'M', 'Orthopedic Surgeon', 'faisal@gmail.com'),
(4, 'Dr. Hira Aslam', 'hira.aslam', 'hira2023', 'F', 'Neurologist', 'hira@gmail.com'),
(5, 'Dr. Usman Bashir', 'usman.b', 'ubpass432', 'M', 'Emergency Medicine', 'usman@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_ph_nmbr`
--

CREATE TABLE `doctor_ph_nmbr` (
  `doc_id` int(11) NOT NULL,
  `ph_Nmbr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_ph_nmbr`
--

INSERT INTO `doctor_ph_nmbr` (`doc_id`, `ph_Nmbr`) VALUES
(1, '03331234567'),
(2, '03441234567'),
(3, '03551234567'),
(4, '03661234567'),
(5, '03771234567');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `description`, `doc_id`, `pat_id`, `timestamp`) VALUES
(10, 'Urgent care visit!', 5, 2, '2025-08-06 18:14:27'),
(16, 'Very Critical condition , Urgent visit required!', 1, 8, '2025-08-09 13:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pat_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Medical_Condition` text DEFAULT NULL,
  `SSN` int(11) NOT NULL,
  `Srs_Level` varchar(50) NOT NULL,
  `Police_Case` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pat_id`, `Name`, `Age`, `Gender`, `Medical_Condition`, `SSN`, `Srs_Level`, `Police_Case`) VALUES
(2, 'Zainab Ali', 28, 'F', 'Severe asthma attack', 10002, 'Critical', 0),
(5, 'Bilal Saeed', 55, 'M', 'Diabetes-related complication', 10005, 'Low', 0),
(6, 'Talha', 25, 'm', 'twfdra', 342, 'Moder', 1),
(7, 'Junaid', 16, 'm', 'Fracture bones', 342134, 'Critical', 1),
(8, 'Davis', 19, 'm', 'Liver syrosis', 231623, 'Critical', 0),
(9, 'Rana', 19, 'm', 'Digestion problem', 8328723, 'Medium', 1),
(10, 'BADAR', 12, 'm', 'BAD', 121312, 'iejdijasidas', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_ph_nmbr`
--

CREATE TABLE `patient_ph_nmbr` (
  `pat_id` int(11) NOT NULL,
  `ph_Nmbr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_ph_nmbr`
--

INSERT INTO `patient_ph_nmbr` (`pat_id`, `ph_Nmbr`) VALUES
(2, '03229876543'),
(5, '03461239876'),
(6, '873467523'),
(7, '47332772'),
(8, '216216'),
(9, '321713'),
(10, '24342432');

-- --------------------------------------------------------

--
-- Table structure for table `patient_report`
--

CREATE TABLE `patient_report` (
  `rep_id` int(11) NOT NULL,
  `cnd_before` varchar(50) DEFAULT NULL,
  `cnd_after` varchar(50) DEFAULT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `instructions` varchar(100) DEFAULT NULL,
  `lab_test` tinyint(1) DEFAULT 0,
  `medicine_given` varchar(150) DEFAULT NULL,
  `treatment_given` varchar(150) DEFAULT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_report`
--

INSERT INTO `patient_report` (`rep_id`, `cnd_before`, `cnd_after`, `pat_id`, `doc_id`, `instructions`, `lab_test`, `medicine_given`, `treatment_given`, `report_date`) VALUES
(1, 'Blood pressure', 'low pulse rate', 2, 1, 'Stay in Emergency', 0, 'tachycardia', 'Regular monitoring of BP is advised', '2025-08-04 06:12:58'),
(5, 'Severe', 'Better', 8, 1, '', 0, 'COding', 'I dont know', '2025-08-09 13:54:48'),
(6, 'Digestion problem with vomiting', 'Stoppage of vomit triggering and better health', 9, 1, '', 0, 'Entamezol', 'digestion injection', '2025-08-09 18:16:58'),
(10, 'ww', 'ff', 5, 1, '', 1, 'ww', 'dassd', '2025-08-09 19:27:10'),
(11, 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaa', 8, 1, '', 1, 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaa', '2025-08-11 06:10:15'),
(13, 'rrrrrrrrrrrrrrrrrrr', 'rrrrrrrrrrrrrrrrrrrrrrr', 9, 1, 'Stay in Emergency', 1, 'rrrrrrrrrrrrrrrrrrr', 'rrrrrrrrrrrrrrr', '2025-08-11 08:32:41'),
(14, 'fffffffffffffffffff', 'fffffffffffffffffffff', 5, 1, 'Transfer to ICU', 1, 'ffffffffffffffffffff', 'ffffffffffffffffffffff', '2025-08-11 08:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `pat_caretaker`
--

CREATE TABLE `pat_caretaker` (
  `id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `pat_id` int(11) DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `shift_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pat_caretaker`
--

INSERT INTO `pat_caretaker` (`id`, `Name`, `pat_id`, `Email`, `Password`, `username`, `shift_time`) VALUES
(1, 'Ayesha Khan', NULL, 'ayesha.caretaker1@example.com', 'pass1234', 'ayesha.khan', NULL),
(2, 'Imran Ali', 2, 'imran.caretaker2@example.com', 'secure456', 'imran.ali', '19:57:00'),
(4, 'Bilal Qureshi', NULL, 'bilal.caretaker4@example.com', 'qwerty789', 'bilal.qureshi', NULL),
(5, 'Nida Hassan', NULL, 'nida.caretaker5@example.com', 'letmein12', 'nida.hassan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pat_caretaker_ph_nmbr`
--

CREATE TABLE `pat_caretaker_ph_nmbr` (
  `id` int(11) NOT NULL,
  `ph_Nmbr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pat_caretaker_ph_nmbr`
--

INSERT INTO `pat_caretaker_ph_nmbr` (`id`, `ph_Nmbr`) VALUES
(1, '03174567890'),
(2, '03412345678'),
(4, '03324455667'),
(5, '03501122334');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Adm_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD UNIQUE KEY `unique_appointment` (`doc_id`,`pat_id`,`appointment_date`),
  ADD KEY `appointments_ibfk_1` (`pat_id`);

--
-- Indexes for table `assigned_to`
--
ALTER TABLE `assigned_to`
  ADD PRIMARY KEY (`pat_id`,`doc_id`),
  ADD KEY `FK_doctor` (`doc_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `pat_id` (`pat_id`);

--
-- Indexes for table `collab_with`
--
ALTER TABLE `collab_with`
  ADD PRIMARY KEY (`id`,`doc_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `discharge_sheet`
--
ALTER TABLE `discharge_sheet`
  ADD PRIMARY KEY (`dis_id`),
  ADD KEY `pat_id` (`pat_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doc_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `doctor_ph_nmbr`
--
ALTER TABLE `doctor_ph_nmbr`
  ADD PRIMARY KEY (`doc_id`,`ph_Nmbr`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD UNIQUE KEY `doc_id` (`doc_id`,`pat_id`),
  ADD KEY `pat_id` (`pat_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pat_id`),
  ADD UNIQUE KEY `SSN` (`SSN`);

--
-- Indexes for table `patient_ph_nmbr`
--
ALTER TABLE `patient_ph_nmbr`
  ADD PRIMARY KEY (`pat_id`,`ph_Nmbr`);

--
-- Indexes for table `patient_report`
--
ALTER TABLE `patient_report`
  ADD PRIMARY KEY (`rep_id`),
  ADD UNIQUE KEY `unique_doc_pat_date` (`doc_id`,`pat_id`,`report_date`),
  ADD KEY `pat_id` (`pat_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `pat_caretaker`
--
ALTER TABLE `pat_caretaker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `pat_id` (`pat_id`);

--
-- Indexes for table `pat_caretaker_ph_nmbr`
--
ALTER TABLE `pat_caretaker_ph_nmbr`
  ADD PRIMARY KEY (`id`,`ph_Nmbr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Adm_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discharge_sheet`
--
ALTER TABLE `discharge_sheet`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patient_report`
--
ALTER TABLE `patient_report`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pat_caretaker`
--
ALTER TABLE `pat_caretaker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_appointments_patient` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE;

--
-- Constraints for table `assigned_to`
--
ALTER TABLE `assigned_to`
  ADD CONSTRAINT `FK_doctor` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_assigned_to_patient` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_patient_bill` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE;

--
-- Constraints for table `collab_with`
--
ALTER TABLE `collab_with`
  ADD CONSTRAINT `collab_with_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pat_caretaker` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collab_with_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`) ON DELETE CASCADE;

--
-- Constraints for table `discharge_sheet`
--
ALTER TABLE `discharge_sheet`
  ADD CONSTRAINT `discharge_sheet_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_patient_discharge_sheet` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_ph_nmbr`
--
ALTER TABLE `doctor_ph_nmbr`
  ADD CONSTRAINT `doctor_ph_nmbr_ibfk_1` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_patient_message` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_ph_nmbr`
--
ALTER TABLE `patient_ph_nmbr`
  ADD CONSTRAINT `fk_patient_ph_nmbr` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_report`
--
ALTER TABLE `patient_report`
  ADD CONSTRAINT `fk_patient_patient_report` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_report_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `doctor` (`doc_id`) ON DELETE CASCADE;

--
-- Constraints for table `pat_caretaker`
--
ALTER TABLE `pat_caretaker`
  ADD CONSTRAINT `fk_patient_pat_caretaker` FOREIGN KEY (`pat_id`) REFERENCES `patient` (`pat_id`) ON DELETE CASCADE;

--
-- Constraints for table `pat_caretaker_ph_nmbr`
--
ALTER TABLE `pat_caretaker_ph_nmbr`
  ADD CONSTRAINT `pat_caretaker_ph_nmbr_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pat_caretaker` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
