-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2020 at 05:21 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yamahav2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmins`
--

CREATE TABLE `tbladmins` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserCrtd` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmins`
--

INSERT INTO `tbladmins` (`Username`, `Password`, `UserCrtd`) VALUES
('admin', '7198570c8aba3cd9bfd6143615085858', '2020-06-08 23:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `SelectionID` int(15) NOT NULL,
  `ProductID` int(10) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Quantity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`SelectionID`, `ProductID`, `Username`, `Quantity`) VALUES
(101, 240, 't', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryDescription` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`CategoryID`, `CategoryName`, `CategoryDescription`) VALUES
(1, 'Body & Fenders', 'Body And Fenders will be avaialbel'),
(2, 'Control & Brakes', 'This category is now available'),
(3, 'Electrical', 'This category is now available'),
(4, 'Engine & Exhaust', 'This category is now available');

-- --------------------------------------------------------

--
-- Table structure for table `tbldelivery`
--

CREATE TABLE `tbldelivery` (
  `DeliveryID` int(15) NOT NULL,
  `RecipientName` varchar(50) NOT NULL,
  `RecipientPhone` varchar(50) NOT NULL,
  `DeliveryAddress` varchar(50) DEFAULT NULL,
  `DeliveryCity` varchar(50) NOT NULL,
  `LocationType` varchar(50) NOT NULL,
  `ShippingCharge` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `TotalPrice` decimal(13,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldelivery`
--

INSERT INTO `tbldelivery` (`DeliveryID`, `RecipientName`, `RecipientPhone`, `DeliveryAddress`, `DeliveryCity`, `LocationType`, `ShippingCharge`, `Username`, `TotalPrice`) VALUES
(6090, 'faza', 'gfaza', 'dssadf', 'Colombo', 'workplace', 200, 'Bayu', '133554.0000'),
(21410, 'Faza', '65168', 'sdfsdf', 'Kurunegala', 'home', 0, 'Bayu', '127455.0000'),
(83173, 'sdf', 'sdfs', 'df', 'Colombo', 'home', 0, 'Bayu', '188185.0000');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `OrderID` int(15) NOT NULL,
  `ProductID` int(15) NOT NULL,
  `Quantity` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `DeliveryID` int(15) NOT NULL,
  `OrderDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`OrderID`, `ProductID`, `Quantity`, `Username`, `DeliveryID`, `OrderDate`) VALUES
(170, 4, '6', 'Bayu', 6090, '2020-06-07 21:22:20'),
(171, 3, '1', 'Bayu', 83173, '2020-06-07 21:23:03'),
(172, 4, '8', 'Bayu', 83173, '2020-06-07 21:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblordertrack`
--

CREATE TABLE `tblordertrack` (
  `TrackID` int(11) NOT NULL,
  `OrderID` int(15) NOT NULL,
  `DeliveryID` int(15) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Remark` mediumtext DEFAULT NULL,
  `RemarkedDate` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblordertrack`
--

INSERT INTO `tblordertrack` (`TrackID`, `OrderID`, `DeliveryID`, `Status`, `Remark`, `RemarkedDate`) VALUES
(12, 170, 6090, 'In Progress', 'Orders Has Been Received And Is Currently Being Processed', '2020-06-10 13:55:29'),
(13, 171, 83173, 'In Progress', 'Orders Has Been Received And Is Currently Being Processed', '2020-06-10 13:55:26'),
(14, 172, 83173, 'On Hold', 'Orders Has Been Received And Is Currently Being Processed', '2020-06-10 01:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblproductreviews`
--

CREATE TABLE `tblproductreviews` (
  `ReviewID` int(11) NOT NULL,
  `ProductID` int(15) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Review` longtext DEFAULT NULL,
  `ReviewDate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproductreviews`
--

INSERT INTO `tblproductreviews` (`ReviewID`, `ProductID`, `Username`, `Review`, `ReviewDate`) VALUES
(1, 3, 'f', 'yvghvg', '2020-06-04 14:49:00'),
(2, 240, 't', 'asdasd', '2020-06-11 04:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `ProductID` int(15) NOT NULL,
  `ProductName` varchar(250) NOT NULL,
  `ProductPrice` decimal(13,1) DEFAULT NULL,
  `InitialProductPrice` decimal(13,1) DEFAULT NULL,
  `ProductImage` varchar(300) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `ProductBrand` varchar(50) NOT NULL,
  `Colour` varchar(50) DEFAULT NULL,
  `Dimensions` varchar(50) DEFAULT NULL,
  `ProductDesignType` varchar(50) DEFAULT NULL,
  `ProductDiscountAmount` varchar(50) NOT NULL,
  `ProductBikeType` varchar(50) NOT NULL,
  `CreatedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ProductAvailability` varchar(50) DEFAULT NULL,
  `UpdatedDate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`ProductID`, `ProductName`, `ProductPrice`, `InitialProductPrice`, `ProductImage`, `CategoryID`, `ProductBrand`, `Colour`, `Dimensions`, `ProductDesignType`, `ProductDiscountAmount`, `ProductBikeType`, `CreatedDate`, `ProductAvailability`, `UpdatedDate`) VALUES
(239, 'Tank', '21660.0', '22800.0', 'Resources/products/Tank.jpg', 1, 'Bikers Choice', 'Chrome', '10 Inch', 'Diamond', '5', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(240, 'Keiti Tank Protector', '475.0', '500.0', 'Resources/products/KeitiTankProtector.jpg', 1, 'Keiti', 'Black', '6 Inch', 'Heavy Duty', '5', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(241, 'Mirror Adapters', '1330.0', '1400.0', 'Resources/products/MirrorAdapters.jpg', 1, 'Keiti', 'Chrome', '10 Inch', 'Smooth', '5', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(242, 'Supersport Mirrors', '2090.0', '2200.0', 'Resources/products/SupersportMirrors.jpg', 1, 'Bikemaster', 'Black', '10 Inch', 'Left', '5', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(243, 'Tire', '14288.0', '15040.0', 'Resources/products/Tire.jpg', 1, 'Dunlop', 'Black', '6 Inch', 'Sport', '5', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(244, 'Fuel Gauge Cap', '1757.5', '1850.0', 'Resources/products/FuelGaugeCap.jpg', 1, 'Bikemaster', 'Black', '6 Inch', 'Heavyduty', '5', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(245, 'Mid Controls', '9837.3', '10355.0', 'Resources/products/MidControls.jpg', 2, 'Roland', 'Silver', '6 Inch', 'Black Ops', '5', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(246, 'Control Extension Set', '17385.0', '18300.0', 'Resources/products/FootControlExtensionSet.jpg', 2, 'Baron', 'Silver', '6 Inch', 'Floorboards Forward', '5', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(247, 'Cruise Control', '3681.3', '3875.0', 'Resources/products/CruiseControl.jpg', 2, 'Nep', 'Silver', '10 Inch', 'Wrench', '5', '2020 YAMAHA BOLT R-SPEC XVS95CLS', '2020-06-08 14:26:56', 'In Stock', NULL),
(248, 'Fuel Controller', '29845.2', '31416.0', 'Resources/products/FuelManagementController.jpg', 2, 'Wiseco', 'Silver', '10 Inch', 'Pushbutton Operation', '5', '2020 YAMAHA BOLT R-SPEC XVS95CLS', '2020-06-08 14:26:56', 'In Stock', NULL),
(249, 'Control Lever', '735.0', '1470.0', 'Resources/products/ControlLever.jpg', 2, 'Motion Pro', 'Silver Polished', '10 Inch', 'Lever', '50', '2020 YAMAHA BOLT R-SPEC XVS95CLS', '2020-06-08 14:26:56', 'In Stock', NULL),
(250, 'Dual Control Brake System', '1600.0', '3200.0', 'Resources/products/DualControlBrakeSystem.jpg', 2, 'Altrider', 'Silver', '22mm/32mm Kit', 'Stainless Steel', '50', '2020 YAMAHA BOLT R-SPEC XVS95CLS', '2020-06-08 14:26:56', 'In Stock', NULL),
(251, 'Control Cable', '925.0', '1850.0', 'Resources/products/ControlCable.jpg', 2, 'Altrider', 'Silver', '10 Inch', 'Brake Choke', '50', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(252, 'Brake Shoes', '1850.0', '3700.0', 'Resources/products/BrakeShoes.jpg', 2, 'Dp Brakes', 'Silver', '10 Inch', 'Lasting Durability', '50', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'Out Of Stock', NULL),
(253, 'Brake Pads', '1800.0', '3600.0', 'Resources/products/BrakePads.jpg', 2, 'Braking', 'Silver', '10 Inch', 'Semi Metallic', '50', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'Out Of Stock', NULL),
(254, 'Brake Disk', '5400.0', '18000.0', 'Resources/products/BrakeDisk.jpg', 2, 'Braking', 'Silver', '10 Inch', 'Fade Free', '50', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'Out Of Stock', NULL),
(255, 'Headlight', '2775.0', '9250.0', 'Resources/products/Headlight.jpg', 3, 'Emgo', 'Black Chrome', '4 Inch', 'Floating', '20', '2020 YAMAHA BOLT R-SPEC XVS95CLS', '2020-06-08 14:26:56', 'In Stock', NULL),
(256, 'Turn Signal', '943.5', '3145.0', 'Resources/products/TurnSignal.jpg', 3, 'Bikemaster', 'Black', '0.22 Inch', 'Lasting Durability', '20', '2020 YAMAHA BOLT R-SPEC XVS95CLS', '2020-06-08 14:26:56', 'In Stock', NULL),
(257, 'MultiSwitch', '3240.0', '10800.0', 'Resources/products/MultiSwitch.jpg', 3, 'K&S', 'Black', '8 Inch', 'Right', '20', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(258, 'Solenoid', '1200.0', '4000.0', 'Resources/products/Solenoid.jpg', 3, 'Quadboss', 'Black', '0.22 Inch', 'Round Housing', '20', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(259, 'Battery', '5197.5', '9450.0', 'Resources/products/Battery.jpg', 3, 'Yuasa', 'Black', '6 Inch', 'Maintenance Free', '20', '2020 YAMAHA BOLT R-SPEC XVS95CLS', '2020-06-08 14:26:56', 'In Stock', NULL),
(260, 'Rectifier', '3465.0', '6300.0', 'Resources/products/Rectifier.jpg', 3, 'Moose Racing', 'Black', '0.22 Inch', 'Oem Style', '20', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(261, 'CDI Boxes', '1595.0', '2900.0', 'Resources/products/CDIBoxes.jpg', 3, 'Quadboss', 'Red', '10 Inch', 'Monocurve', '20', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(262, 'ECU Box', '13736.3', '24975.0', 'Resources/products/ECUBox.jpg', 3, 'Quadboss', 'Green', '10 Inch', 'Completely Reprogrammable', '0', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(263, 'Starter Motor', '12375.0', '22500.0', 'Resources/products/StarterMotor.jpg', 3, 'Twin Power', 'Black', '10 Inch', 'O.E.M. Interchangeable', '0', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(264, 'Fuel Pump', '5900.0', '5900.0', 'Resources/products/FuelPump.jpg', 3, 'Mikuni', 'Black', '10 Inch', 'Round Multicurve', '0', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(265, 'Oil Filter', '2516.0', '3145.0', 'Resources/products/OilFilter.jpg', 4, 'K&A', 'Black', '10 Inch', 'High Quality Metal', '2', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(266, 'Cylinder bore', '45732.0', '57165.0', 'Resources/products/Cylinderbore.jpg', 4, 'Cylinder Works', 'Black', '255CC', 'Standard & Big Bore', '2', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(267, 'Cylinder sleeve', '14652.0', '18315.0', 'Resources/products/Cylindersleeve.jpg', 4, 'L.A.', 'Black', '255CC', 'High Quality Steel', '2', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(268, 'Rods Crankshaft', '9600.0', '12000.0', 'Resources/products/RodsCrankshaft.jpg', 4, 'Hot Rods', 'Black', '3 Inch', 'Crankshafts', '2', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(269, 'Valve and Spring Intake Kit', '18000.0', '22500.0', 'Resources/products/ValveandSpringIntakeKit.jpg', 4, 'Pro X', 'Black', '3 Inch', 'High Quality Steel', '2', '2020 YAMAHA BOLT XVS95CLB', '2020-06-08 14:26:56', 'In Stock', NULL),
(270, 'R304 Shorty TI2 Silencer', '24000.0', '24000.0', 'Resources/products/R304ShortyTI2Silencer.jpg', 4, 'Pro Circuit', 'Black', '3 Inch', 'Lightweight 6061T6 Aluminum', '2', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(271, 'Spark Plug', '540.0', '540.0', 'Resources/products/SparkPlug.jpg', 4, 'Ngk', 'Black', '3 Inch', 'Superior Construction', '2', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(272, 'Bearing Seal Kit', '4400.0', '4400.0', 'Resources/products/CrankshaftBearingandSealKits.jpg', 4, 'Ngk', 'Black', '10 Inch', 'High Quality Metal', '2', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(273, 'Cam Chains', '8600.0', '8600.0', 'Resources/products/CamChains.JPG', 4, 'Wiseco', 'Black', '10 Inch', 'Material Reduce Friction', '2', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL),
(274, 'Top End Bearing', '3135.0', '3135.0', 'Resources/products/TopEndBearing.jpg', 4, 'Wiseco', 'Black', '14.5 Inch', 'Maximum Perfomance', '2', '2020 YAMAHA KODIAK 450 YFM45KDXLR', '2020-06-08 14:26:56', 'In Stock', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbluserlog`
--

CREATE TABLE `tbluserlog` (
  `LogID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `LoginTime` timestamp NULL DEFAULT current_timestamp(),
  `Logout` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserlog`
--

INSERT INTO `tbluserlog` (`LogID`, `Username`, `LoginTime`, `Logout`, `Status`) VALUES
(4, 'admin', '0000-00-00 00:00:00', NULL, 1),
(5, 'f', '0000-00-00 00:00:00', NULL, 1),
(6, 'f', '0000-00-00 00:00:00', NULL, 1),
(7, 'f', '0000-00-00 00:00:00', NULL, 1),
(8, 'f', '0000-00-00 00:00:00', NULL, 1),
(9, 'f', '0000-00-00 00:00:00', NULL, 1),
(10, 'f', '0000-00-00 00:00:00', NULL, 1),
(11, 'f', '0000-00-00 00:00:00', NULL, 1),
(12, 'f', '0000-00-00 00:00:00', NULL, 1),
(13, 'f', '0000-00-00 00:00:00', NULL, 1),
(14, 'f', '0000-00-00 00:00:00', NULL, 1),
(15, 'f', '0000-00-00 00:00:00', NULL, 1),
(16, 'f', '0000-00-00 00:00:00', NULL, 1),
(17, 'f', '0000-00-00 00:00:00', NULL, 1),
(18, 'f', '0000-00-00 00:00:00', NULL, 1),
(19, 'f', '0000-00-00 00:00:00', NULL, 1),
(20, 'f', '0000-00-00 00:00:00', NULL, 1),
(21, 'f', '0000-00-00 00:00:00', NULL, 1),
(22, 'f', '0000-00-00 00:00:00', NULL, 1),
(23, 'f', '0000-00-00 00:00:00', NULL, 1),
(24, 'f', '0000-00-00 00:00:00', NULL, 1),
(25, 'f', '0000-00-00 00:00:00', NULL, 1),
(26, 'f', '0000-00-00 00:00:00', NULL, 1),
(27, 'f', '0000-00-00 00:00:00', NULL, 1),
(28, 'f', '0000-00-00 00:00:00', NULL, 1),
(29, 'f', '0000-00-00 00:00:00', NULL, 1),
(30, 'f', '0000-00-00 00:00:00', NULL, 1),
(31, 'f', '0000-00-00 00:00:00', NULL, 1),
(32, 'f', '0000-00-00 00:00:00', NULL, 1),
(33, 'f', '0000-00-00 00:00:00', NULL, 1),
(34, 'f', '0000-00-00 00:00:00', NULL, 1),
(35, 'f', '0000-00-00 00:00:00', NULL, 1),
(36, 'f', '0000-00-00 00:00:00', NULL, 1),
(37, 'f', '0000-00-00 00:00:00', NULL, 1),
(38, 'f', '0000-00-00 00:00:00', NULL, 1),
(39, 'f', '0000-00-00 00:00:00', NULL, 1),
(40, 'f', '0000-00-00 00:00:00', NULL, 1),
(41, 'f', '0000-00-00 00:00:00', NULL, 1),
(42, 'f', '0000-00-00 00:00:00', NULL, 1),
(43, 'f', '0000-00-00 00:00:00', NULL, 1),
(44, 'f', '0000-00-00 00:00:00', NULL, 1),
(45, 'f', '0000-00-00 00:00:00', NULL, 1),
(46, 'f', '0000-00-00 00:00:00', NULL, 1),
(47, 'f', '0000-00-00 00:00:00', NULL, 1),
(48, 'f', '0000-00-00 00:00:00', NULL, 1),
(49, 'f', '0000-00-00 00:00:00', NULL, 1),
(50, 'f', '0000-00-00 00:00:00', NULL, 1),
(51, 'f', '0000-00-00 00:00:00', NULL, 1),
(52, 'f', '0000-00-00 00:00:00', NULL, 1),
(53, 'f', '0000-00-00 00:00:00', NULL, 1),
(54, 'F', '0000-00-00 00:00:00', NULL, 1),
(55, 'f', '0000-00-00 00:00:00', NULL, 1),
(56, 'f', '0000-00-00 00:00:00', NULL, 1),
(57, 'f', '0000-00-00 00:00:00', NULL, 1),
(58, 'f', '0000-00-00 00:00:00', NULL, 1),
(59, 'f', '0000-00-00 00:00:00', NULL, 1),
(60, 'f', '0000-00-00 00:00:00', NULL, 1),
(61, 'f', '0000-00-00 00:00:00', NULL, 1),
(62, 'f', '0000-00-00 00:00:00', NULL, 1),
(63, 'f', '0000-00-00 00:00:00', NULL, 1),
(64, 'f', '0000-00-00 00:00:00', NULL, 1),
(65, 'f', '0000-00-00 00:00:00', NULL, 1),
(66, 'f', '0000-00-00 00:00:00', NULL, 1),
(67, 'f', '0000-00-00 00:00:00', NULL, 1),
(68, 'f', '0000-00-00 00:00:00', NULL, 1),
(69, 'f', '0000-00-00 00:00:00', NULL, 1),
(70, 'F', '0000-00-00 00:00:00', NULL, 1),
(71, 'f', '0000-00-00 00:00:00', NULL, 1),
(72, 'f', '0000-00-00 00:00:00', NULL, 1),
(73, 'f', '0000-00-00 00:00:00', NULL, 1),
(74, 'f', '0000-00-00 00:00:00', NULL, 1),
(75, 'f', '0000-00-00 00:00:00', NULL, 1),
(76, 'f', '0000-00-00 00:00:00', NULL, 1),
(77, 'f', '0000-00-00 00:00:00', NULL, 1),
(78, 'f', '0000-00-00 00:00:00', NULL, 1),
(79, 'f', '0000-00-00 00:00:00', NULL, 1),
(80, 'f', '0000-00-00 00:00:00', NULL, 1),
(81, 'f', '0000-00-00 00:00:00', NULL, 1),
(82, 'f', '0000-00-00 00:00:00', NULL, 1),
(83, 'f', '0000-00-00 00:00:00', NULL, 1),
(84, 'F', '0000-00-00 00:00:00', NULL, 1),
(85, 'f', '0000-00-00 00:00:00', NULL, 1),
(86, 'f', '0000-00-00 00:00:00', NULL, 1),
(87, 'F', '0000-00-00 00:00:00', NULL, 1),
(88, 'f', '0000-00-00 00:00:00', NULL, 1),
(89, 'f', '0000-00-00 00:00:00', NULL, 1),
(90, 'f', '0000-00-00 00:00:00', NULL, 1),
(91, 'f', '0000-00-00 00:00:00', NULL, 1),
(92, 'f', '0000-00-00 00:00:00', NULL, 1),
(93, 'f', '0000-00-00 00:00:00', NULL, 1),
(94, 'w', '0000-00-00 00:00:00', NULL, 1),
(95, '2', '0000-00-00 00:00:00', NULL, 1),
(96, '8', '0000-00-00 00:00:00', NULL, 1),
(97, '7', '0000-00-00 00:00:00', NULL, 1),
(98, '7', '0000-00-00 00:00:00', NULL, 1),
(99, '8', '0000-00-00 00:00:00', NULL, 1),
(100, '9', '0000-00-00 00:00:00', NULL, 1),
(101, '9', '0000-00-00 00:00:00', NULL, 1),
(102, 'f', '0000-00-00 00:00:00', NULL, 1),
(103, 'f', '0000-00-00 00:00:00', NULL, 1),
(104, 'k', '0000-00-00 00:00:00', NULL, 1),
(105, 'Bayu', '0000-00-00 00:00:00', NULL, 1),
(106, 'bayu', '0000-00-00 00:00:00', NULL, 1),
(107, 'admin', '0000-00-00 00:00:00', NULL, 1),
(108, 'admin', '0000-00-00 00:00:00', NULL, 1),
(109, 'admin', '0000-00-00 00:00:00', NULL, 1),
(110, 'admin', '0000-00-00 00:00:00', NULL, 1),
(111, 'admin', '0000-00-00 00:00:00', NULL, 1),
(112, 'admin', '0000-00-00 00:00:00', NULL, 1),
(113, 'admin', '0000-00-00 00:00:00', NULL, 1),
(114, 'admin', '0000-00-00 00:00:00', NULL, 1),
(115, 'admin', '0000-00-00 00:00:00', NULL, 1),
(116, 'admin', '0000-00-00 00:00:00', NULL, 1),
(117, 't', '0000-00-00 00:00:00', NULL, 1),
(118, 't', '0000-00-00 00:00:00', NULL, 1),
(119, 't', '0000-00-00 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `Username` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailAddress` varchar(50) NOT NULL,
  `PhoneNumber` varchar(40) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `SecurityQuestion` varchar(250) DEFAULT NULL,
  `SecurityAnswer` varchar(250) DEFAULT NULL,
  `UserCrtd` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`Username`, `FirstName`, `LastName`, `EmailAddress`, `PhoneNumber`, `Password`, `SecurityQuestion`, `SecurityAnswer`, `UserCrtd`) VALUES
('bayu', 'bayu', 'bayu', 'bayu@outlook.com', '07615074', '6ebe76c9fb411be97b3b0d48b791a7c9', '1', 'bay', '2020-06-08 04:07:35'),
('k', 'k', 'k', 'k', '234', '4c93008615c2d041e33ebac605d14b5b', 'k', 'k', '2020-06-04 22:56:48'),
('t', 't', 't', 't@gmail.com', '0761507471', '25f9e794323b453885f5181f1b624d0b', '7', 't', '2020-06-10 20:48:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmins`
--
ALTER TABLE `tbladmins`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`SelectionID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `tbldelivery`
--
ALTER TABLE `tbldelivery`
  ADD PRIMARY KEY (`DeliveryID`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `DeliveryID` (`DeliveryID`);

--
-- Indexes for table `tblordertrack`
--
ALTER TABLE `tblordertrack`
  ADD PRIMARY KEY (`TrackID`);

--
-- Indexes for table `tblproductreviews`
--
ALTER TABLE `tblproductreviews`
  ADD PRIMARY KEY (`ReviewID`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `tbluserlog`
--
ALTER TABLE `tbluserlog`
  ADD PRIMARY KEY (`LogID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `SelectionID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `OrderID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `tblordertrack`
--
ALTER TABLE `tblordertrack`
  MODIFY `TrackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblproductreviews`
--
ALTER TABLE `tblproductreviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `ProductID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT for table `tbluserlog`
--
ALTER TABLE `tbluserlog`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
