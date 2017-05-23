SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `cheapbooks` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cheapbooks`;
CREATE TABLE `author` (
  `ssn` bigint(20) NOT NULL,
  `name` mediumtext NOT NULL,
  `address` longtext NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `author` (`ssn`, `name`, `address`, `phone`) VALUES
(1111222233334444, 'Vakali, Athena', 'Aristotle University of Thessaloniki, Greece', 5555555555),
(2222333344445555, 'Tiziana Catarci', 'England', 3067724007),
(3333444455556666, 'Stephen Kimani', 'Las Vegas', 3435243654),
(4444555566667777, 'Alan Dix', 'San Antonio', 7685434753),
(5555666677778888, 'Alex Berson', 'Texas', 4574563845),
(6666777788889999, 'Lars George', 'Oklahoma', 3284327584);

CREATE TABLE `book` (
  `isbn` bigint(20) NOT NULL,
  `title` mediumtext NOT NULL,
  `year` year(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `publisher` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `book` (`isbn`, `title`, `year`, `price`, `publisher`) VALUES
(9780071744584, 'Master Data Management And Data Governance / Edition 2', 2010, '34.07', 'McGraw-Hill Professional Publishing'),
(9780133887648, 'Web and Network Data Science: Modeling Techniques in Predictive Analytics', 2014, '64.48', 'FT Press'),
(9781449315221, 'HBase: The Definitive Guide: Random Access to Your Planet-Size Data', 2011, '31.99', 'O''Reilly Media, Inc.'),
(9781599042305, 'Web Data Management Practices: Emerging Techniques and Technologies: Emerging Techniques and Technologies', 2001, '69.79', 'IGI Global'),
(9781608452811, 'User-centered Data Management', 2010, '14.85', 'Morgan & Claypool Publishers\r\n');

CREATE TABLE `contains` (
  `isbn` bigint(20) NOT NULL,
  `basketID` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `customer` (
  `username` varchar(14) NOT NULL,
  `address` longtext NOT NULL,
  `email` mediumtext NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`username`, `address`, `email`, `phone`, `password`) VALUES
('admin', 'Arlington', 'xyz@gmail.com', 9999999999, '21232f297a57a5a743894a0e4a801fc3'),
('Jeyanth', '1515 Shamrock Bend Lane, #Apt 3222', 'jeyanth.c2008@gmail.com', 5129552698, '3b777b775721dfa8d36de2a320a03e53');

CREATE TABLE `shippingorder` (
  `isbn` bigint(20) NOT NULL,
  `warehouseCode` int(11) NOT NULL,
  `username` varchar(14) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `shippingorder` (`isbn`, `warehouseCode`, `username`, `number`) VALUES
(9781599042305, 1001, 'Jeyanth', 1),
(9781608452811, 1001, 'admin', 1);

CREATE TABLE `shoppingbasket` (
  `basketID` int(11) NOT NULL,
  `username` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `stocks` (
  `isbn` bigint(20) NOT NULL,
  `warehouseCode` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stocks` (`isbn`, `warehouseCode`, `number`) VALUES
(9780071744584, 1001, 50),
(9780071744584, 1002, 50),
(9780071744584, 1003, 50),
(9781449315221, 1002, 50),
(9781599042305, 1001, 49),
(9781599042305, 1002, 50),
(9781599042305, 1003, 50),
(9781608452811, 1001, 49),
(9781608452811, 1002, 50),
(9781449315221, 1001, 50),
(9780133887648, 1001, 0);

CREATE TABLE `warehouse` (
  `warehouseCode` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `address` longtext NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `warehouse` (`warehouseCode`, `name`, `address`, `phone`) VALUES
(1001, 'Main Warehouse', 'Texas', 8237721435),
(1002, 'Warehouse 2', 'San Fransisco', 3432534352),
(1003, 'Store House', 'Arlington', 2352476345);

CREATE TABLE `writtenby` (
  `ssn` bigint(20) NOT NULL,
  `isbn` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `writtenby` (`ssn`, `isbn`) VALUES
(1111222233334444, 9781599042305),
(2222333344445555, 9781608452811),
(3333444455556666, 9781608452811),
(4444555566667777, 9781608452811),
(5555666677778888, 9780071744584),
(6666777788889999, 9781449315221);

ALTER TABLE `author`
  ADD PRIMARY KEY (`ssn`);

ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`);

ALTER TABLE `contains`
  ADD PRIMARY KEY (`basketID`),
  ADD KEY `Contains_fk0` (`isbn`);

ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `shippingorder`
  ADD KEY `ShippingOrder_fk0` (`isbn`),
  ADD KEY `ShippingOrder_fk1` (`warehouseCode`),
  ADD KEY `ShippingOrder_fk2` (`username`);

ALTER TABLE `shoppingbasket`
  ADD KEY `ShoppingBasket_fk0` (`basketID`),
  ADD KEY `ShoppingBasket_fk1` (`username`);

ALTER TABLE `stocks`
  ADD KEY `Stocks_fk0` (`isbn`),
  ADD KEY `Stocks_fk1` (`warehouseCode`);

ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseCode`);

ALTER TABLE `writtenby`
  ADD KEY `WrittenBy_fk0` (`ssn`),
  ADD KEY `WrittenBy_fk1` (`isbn`);

ALTER TABLE `contains`
  ADD CONSTRAINT `Contains_fk0` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

ALTER TABLE `shippingorder`
  ADD CONSTRAINT `ShippingOrder_fk0` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `ShippingOrder_fk1` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`),
  ADD CONSTRAINT `ShippingOrder_fk2` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

ALTER TABLE `shoppingbasket`
  ADD CONSTRAINT `ShoppingBasket_fk0` FOREIGN KEY (`basketID`) REFERENCES `contains` (`basketID`),
  ADD CONSTRAINT `ShoppingBasket_fk1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

ALTER TABLE `stocks`
  ADD CONSTRAINT `Stocks_fk0` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `Stocks_fk1` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`);

ALTER TABLE `writtenby`
  ADD CONSTRAINT `WrittenBy_fk0` FOREIGN KEY (`ssn`) REFERENCES `author` (`ssn`),
  ADD CONSTRAINT `WrittenBy_fk1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);