-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Oca 2025, 06:39:36
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `shoppingsystem`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cart`
--

INSERT INTO `cart` (`CartID`, `UserID`, `ProductID`, `Quantity`) VALUES
(14, 1, 1, 3),
(56, 3, 1, 1),
(58, 3, 4, 2),
(59, 3, 3, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Image1` varchar(255) DEFAULT NULL,
  `Image2` varchar(255) DEFAULT NULL,
  `Image3` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Image1`, `Image2`, `Image3`, `Description`, `Price`, `Stock`) VALUES
(1, 'Klasik Tişört', './../images/t-shirt1.jpg', './../images/t-shirt2.jpg', './../images/t-shirt3.jpg', 'Pamuklu, sade tişört.', 99.99, 100),
(2, 'Kot Ceket', './../images/kot1.jpg', './../images/kot2.jpg', './../images/kot3.jpg', 'Siyah, dayanıklı kot ceket.', 299.99, 50),
(3, 'Spor Ayakkabı', './../images/shoe1.jpg', './../images/shoe2.jpg', './../images/shoe3.jpg', 'Rahat ve hafif spor ayakkabı.', 499.99, 30),
(4, 'Kapüşonlu Sweat', './../images/swea1.jpg', './../images/swea2.jpg', './../images/swea3.jpg', 'Yumuşak kumaştan kapüşonlu.', 199.99, 70),
(5, 'Etek', './../images/etek1.jpg', './../images/etek2.jpg', './../images/etek3.jpg', 'Midi boy, desenli etek.', 159.99, 40),
(6, 'Elbise', './../images/elb1.jpg', './../images/elb2.jpg', './../images/elb3.jpg', 'Şık, gece elbisesi.', 599.99, 20),
(7, 'Kazak', './../images/kzk1.jpg', './../images/kzk2.jpg', './../images/kzk3.jpg', 'Sıcacık, örgü kazak.', 249.99, 60),
(8, 'Kot Pantolon', './../images/pant1.jpg', './../images/pant2.jpg', './../images/pant3.jpg', 'Dar kesim, mavi kot pantolon.', 279.99, 80),
(9, 'Atlet', './../images/atl1.jpg', './../images/atl2.jpg', './../images/atl3.jpg', 'Spor, nefes alabilir atlet.', 89.99, 120),
(10, 'Şort', './../images/srt1.jpg', './../images/srt2.jpg', './../images/srt3.jpg', 'Yazlık, rahat şort.', 149.99, 90),
(11, 'Ruh Gömleği', './../images/rhgm1.jpg', './../images/rhgm2.jpg', './../images/rhgm3.jpg', 'can değerini ve iyileştirme etkilerini arttırır ', 2900.99, 450);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `PasswordHash`) VALUES
(1, 'mrtfff', 'asda@a.a', '123123'),
(2, 'mrtfffe', 'mert@mert.e', '$2y$10$dB.VtARpO6nzDvAPon5zy.mMEl/m4XSNuKSFOD3BhmCLkV.0mkTEu'),
(3, 'mert', 'm@m.m', '$2y$10$/wCryxtgiLrbjuhmZhoEwOfx4hli1E3ASwABw.JtGli9XFO.8VCeW'),
(5, 'asdasdasd', 'asdasd@asfas.as', '$2y$10$Uj2Gfde8dgNp5Y7vX/PEG.PDBgVdEbeVqQek91CEMaH1Sj0o/yoqO'),
(6, 'test', 'test@t.com', '$2y$10$Gg7uCEVuZMPMPbC4L8wEc.SOGv88g1KiYrjL/mswPD49SOaewPD/.'),
(7, 'asda', 'asfasd@ug.a', '$2y$10$EUUpsSS10oPHzcw9i.OvQ.3xQYDZBKTHeEwgrUF.iEa6GC8vzilOi'),
(8, 'omer', 'o@o.o', '$2y$10$H8ufc7C7FzjvXVZMSLRiHuTpxnvZDqAV6uB6xU/iP8/novU7DGCOu');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
