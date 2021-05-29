/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.3.29-MariaDB-cll-lve : Database - deckodev_midtrans
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`deckodev_midtrans` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `deckodev_midtrans`;

/*Table structure for table `tb_transaction` */

DROP TABLE IF EXISTS `tb_transaction`;

CREATE TABLE `tb_transaction` (
  `order_id` char(20) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `customer_email` varchar(20) DEFAULT NULL,
  `gross_amount` int(20) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `va_numbers` varchar(50) DEFAULT NULL,
  `status_message` text DEFAULT NULL,
  `pdf_url` text DEFAULT NULL,
  `transaction_status` char(20) DEFAULT NULL,
  `status_code` char(3) DEFAULT NULL,
  `transaction_id` varchar(200) DEFAULT NULL,
  `finish_redirect_url` text DEFAULT NULL,
  `payment_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
