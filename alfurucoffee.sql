/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `alfurucoffee` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `alfurucoffee`;

CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `salary` int(11) NOT NULL DEFAULT 0,
  `department` varchar(50) DEFAULT NULL,
  `joined_date` date NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `employees`;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`employee_id`, `name`, `job_title`, `salary`, `department`, `joined_date`) VALUES
	(1, 'John Smith', 'Manager', 60000, 'Sales', '2022-01-15'),
	(2, 'Jane Doe', 'Analyst', 45000, 'Marketing', '2022-02-01'),
	(3, 'Mike Brown', 'Developer', 55000, 'IT', '2022-03-10'),
	(4, 'Anna Lee', 'Manager', 65000, 'Sales', '2021-12-05'),
	(5, 'Mark Wong', 'Developer', 50000, 'IT', '2023-05-20'),
	(6, 'Emily Chen', 'Analyst', 48000, 'Marketing', '2023-06-02');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `sales_data` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `sales` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sales_id`),
  KEY `FK__employees` (`employee_id`),
  CONSTRAINT `FK__employees` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `sales_data`;
/*!40000 ALTER TABLE `sales_data` DISABLE KEYS */;
INSERT INTO `sales_data` (`sales_id`, `employee_id`, `sales`) VALUES
	(1, 1, 15000),
	(2, 2, 12000),
	(3, 3, 18000),
	(4, 1, 20000),
	(5, 4, 22000),
	(6, 5, 19000),
	(7, 6, 13000),
	(8, 2, 14000);
/*!40000 ALTER TABLE `sales_data` ENABLE KEYS */;