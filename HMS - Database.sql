-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2025 at 10:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
(1, 8, 1, 'Weekly Checkup!!', 'Done', '2025-08-10', '21:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_to`
--

CREATE TABLE `assigned_to` (
  `pat_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 1),
(3, 2),
(3, 3),
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
(11, 'Excessive Blood loss , Urgent Visit request ! ', 4, 3, '2025-08-06 18:15:00'),
(12, 'Loss of Consciousness Due to heart problems , urgent visit required !', 3, 4, '2025-08-06 18:15:33');

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
(3, 'Hamza Shah', 42, 'M', 'Chest pain and shortness of breath', 10003, 'High', 0),
(4, 'Areeba Khan', 23, 'F', 'Burn injuries on arm', 10004, 'Moderate', 1),
(5, 'Bilal Saeed', 55, 'M', 'Diabetes-related complication', 10005, 'Low', 0),
(6, 'Ahmad', 25, 'm', 'shefb', 3453, 'Moderate', 0),
(8, 'Asad', 29, 'm', 'Asthma', 65564, 'Moderate', 0);

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
(3, '03331234567'),
(4, '03051239876'),
(5, '03461239876'),
(6, '37567846'),
(8, '034667765');

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
(3, 'Sara Malik', 3, 'sara.caretaker3@example.com', 'mypassword', 'sana.malik', '20:03:00'),
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
(3, '03059988776'),
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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discharge_sheet`
--
ALTER TABLE `discharge_sheet`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient_report`
--
ALTER TABLE `patient_report`
  MODIFY `rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
