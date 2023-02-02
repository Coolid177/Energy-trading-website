-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 02 feb 2023 om 19:38
-- Serverversie: 8.0.26-0ubuntu0.20.04.2
-- PHP-versie: 8.0.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Data`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Address`
--

CREATE TABLE `Address` (
  `AddressId` int NOT NULL,
  `Street` varchar(128) NOT NULL,
  `Number` int NOT NULL,
  `City` varchar(128) NOT NULL,
  `Postal_code` int NOT NULL,
  `Country` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Conversations`
--

CREATE TABLE `Conversations` (
  `ConversationId` int NOT NULL,
  `SendingUserId` int NOT NULL,
  `ReceivingUserId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Messages`
--

CREATE TABLE `Messages` (
  `SendByUserId` int NOT NULL,
  `SendTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ConversationId` int NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Ordered_products`
--

CREATE TABLE `Ordered_products` (
  `OrderId` int NOT NULL,
  `ProductId` int NOT NULL,
  `Quantity` int NOT NULL,
  `Price_per_item` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Orders`
--

CREATE TABLE `Orders` (
  `OrderId` int NOT NULL,
  `AddressId` int DEFAULT NULL,
  `Delivery_choice` enum('Delivery','Collect') NOT NULL,
  `CustomerId` int NOT NULL,
  `Orderdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DeliveryDate` date DEFAULT NULL,
  `DeliveryTime` enum('Afternoon','Morning') DEFAULT NULL,
  `HasNotification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Products`
--

CREATE TABLE `Products` (
  `SellerId` int NOT NULL,
  `ProductId` int NOT NULL,
  `Title` varchar(128) NOT NULL,
  `ProductType` enum('Aardgas','Biogas','Butaan','Propaan','Aardolie','Synthetische olie','Pellets','Briketten','Brandhout','Deelbare energie') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Price` int NOT NULL,
  `Origin` varchar(128) NOT NULL,
  `Quantity` mediumint NOT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Product_media`
--

CREATE TABLE `Product_media` (
  `ProductId` int NOT NULL,
  `Media_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Product_notification`
--

CREATE TABLE `Product_notification` (
  `UserId` int NOT NULL,
  `ProductId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Product_statistics`
--

CREATE TABLE `Product_statistics` (
  `ProductId` int NOT NULL,
  `ProductVisits` int NOT NULL DEFAULT '0',
  `ProductSolds` int NOT NULL DEFAULT '0',
  `ProductRevenue` int NOT NULL DEFAULT '0',
  `OwnerId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Reviews`
--

CREATE TABLE `Reviews` (
  `ReviewId` int NOT NULL,
  `ReviewerId` int NOT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Rating` tinyint NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ProductId` int NOT NULL,
  `Title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `UserId` int NOT NULL,
  `Fname` varchar(64) NOT NULL,
  `Lname` varchar(64) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `isVendor` tinyint(1) NOT NULL,
  `AddressId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `User_media`
--

CREATE TABLE `User_media` (
  `UserId` int NOT NULL,
  `Media_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `User_notifications`
--

CREATE TABLE `User_notifications` (
  `UserId` int NOT NULL,
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TypeOfNotification` enum('Product','Review') NOT NULL,
  `ProductId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Vendor`
--

CREATE TABLE `Vendor` (
  `Phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `VendorId` int NOT NULL,
  `Company` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`AddressId`);

--
-- Indexen voor tabel `Conversations`
--
ALTER TABLE `Conversations`
  ADD PRIMARY KEY (`ConversationId`),
  ADD KEY `UserId` (`SendingUserId`),
  ADD KEY `ReceivingUserId` (`ReceivingUserId`);

--
-- Indexen voor tabel `Messages`
--
ALTER TABLE `Messages`
  ADD KEY `ConversationId` (`ConversationId`);

--
-- Indexen voor tabel `Ordered_products`
--
ALTER TABLE `Ordered_products`
  ADD KEY `OrderId` (`OrderId`);

--
-- Indexen voor tabel `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `AddressId` (`AddressId`);

--
-- Indexen voor tabel `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `SellerId` (`SellerId`);

--
-- Indexen voor tabel `Product_media`
--
ALTER TABLE `Product_media`
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexen voor tabel `Product_statistics`
--
ALTER TABLE `Product_statistics`
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexen voor tabel `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`ReviewId`),
  ADD KEY `reviews_ibfk_1` (`ProductId`),
  ADD KEY `reviews_ibfk_2` (`ReviewerId`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexen voor tabel `User_media`
--
ALTER TABLE `User_media`
  ADD KEY `UserId` (`UserId`);

--
-- Indexen voor tabel `Vendor`
--
ALTER TABLE `Vendor`
  ADD KEY `VendorId` (`VendorId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Address`
--
ALTER TABLE `Address`
  MODIFY `AddressId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT voor een tabel `Conversations`
--
ALTER TABLE `Conversations`
  MODIFY `ConversationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT voor een tabel `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT voor een tabel `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT voor een tabel `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `ReviewId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `UserId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Conversations`
--
ALTER TABLE `Conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`SendingUserId`) REFERENCES `Users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`ReceivingUserId`) REFERENCES `Users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`ConversationId`) REFERENCES `Conversations` (`ConversationId`);

--
-- Beperkingen voor tabel `Ordered_products`
--
ALTER TABLE `Ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`OrderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`AddressId`) REFERENCES `Address` (`AddressId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`SellerId`) REFERENCES `Vendor` (`VendorId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Product_media`
--
ALTER TABLE `Product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Product_statistics`
--
ALTER TABLE `Product_statistics`
  ADD CONSTRAINT `product_statistics_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`ProductId`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`ReviewerId`) REFERENCES `Users` (`UserId`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `User_media`
--
ALTER TABLE `User_media`
  ADD CONSTRAINT `user_media_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `Users` (`UserId`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `Vendor`
--
ALTER TABLE `Vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`VendorId`) REFERENCES `Users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
