-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Nov 27. 20:29
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `raktar`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `aru`
--

CREATE TABLE `aru` (
  `azonosito` int(11) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `beszerzesi_ar` int(11) NOT NULL,
  `szin` varchar(20) NOT NULL,
  `raktar_azonosito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `aru`
--

INSERT INTO `aru` (`azonosito`, `marka`, `nev`, `beszerzesi_ar`, `szin`, `raktar_azonosito`) VALUES
(2, 'Nike', 'Körömvágó olló', 50000, 'fekete', 1),
(3, 'Hell', 'Apple', 200, 'piros', 1),
(11, 'Adidas', 'kukta', 1337, 'zöld', 5),
(13, 'Icukacuki', 'fagylaltgombóc', 6111, 'fekete', 1),
(14, 'Loona', 'lapát', 2000, 'fehér', 1),
(15, 'Ye', 'keringetőszivattyú', 40000, 'kék', 6),
(16, 'Monster', 'Energiaital', 600, 'zöld', 4),
(17, 'BMW', 'M1', 40000000, 'piros', 5),
(18, 'Samsung', 'Telefon', 765400, 'fehér', 2),
(19, 'Coop', 'autó', 50000000, 'ezüst', 5),
(20, 'Terken', 'gyógyszer', 567400, 'fehér', 1),
(21, 'Loop', 'Kerékpár', 15000, 'zöld', 2),
(22, 'Next', 'pumpa', 5000, 'fekete', 4),
(23, 'Ford', 'Lézer', 984500, 'vörös', 5),
(24, 'Apple', 'Tv', 4000, 'ezüst', 6),
(25, 'Lenovo', 'Laptop', 70000, 'fekete', 4),
(26, 'Killa', 'Dohánytermék', 2099, 'fehér', 2),
(27, 'Supreme', 'Sapka', 6000, 'barna', 6),
(28, 'Casio', 'Óra', 12500, 'sárga', 1),
(29, 'Máv', 'Póló', 199, 'narancs', 6),
(30, 'Dakk', 'Busz', 120000000, 'sárga', 5),
(31, 'Icarus', 'Traktor', 8000000, 'fekete', 1),
(32, 'Waze', 'Repülőgép', 73800000, 'fehér', 4),
(33, 'Samsung', 'Telefon', 700000, 'fekete', 1),
(34, 'Audi', 'Autó', 83000000, 'piros', 1),
(35, 'Dm', 'sampon', 400, 'fehér', 4),
(36, 'H&M', 'Pulóver', 4000, 'fekete', 5),
(37, 'Dell', 'Csengő', 7000, 'lila', 6),
(38, 'Suzuki', 'Motorkerékpár', 8000000, 'zöld', 4),
(39, 'Dota', 'Gyógyszer', 700, 'fehér', 4),
(40, 'Fiat', 'Autó', 600000, 'szürke', 1),
(41, 'Intel', 'Processzor', 45000, 'kék', 6),
(42, 'AMD', 'Hűtő', 6700, 'fekete', 4),
(43, 'Dell', 'Hűtőszekrény', 60000, 'zöld', 1),
(44, 'Apple', 'Mosogatógép', 65000, 'barna', 5),
(45, 'Ikea', 'Kárpit', 8000, 'fekete', 6),
(46, 'Lidl', 'Üdítőital', 450, 'vörös', 6),
(47, 'Tesco', 'Sajt', 690, 'lila', 4),
(48, 'Daevoo', 'Hűtő', 70000, 'barna', 6),
(49, 'Samsung', 'Telefon', 700000, 'szürke', 4),
(50, 'Adidas', 'Sapka', 400, 'fekete', 1),
(51, 'Dell', 'Laptop', 50000, 'lila', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `feladat`
--

CREATE TABLE `feladat` (
  `jogkor_nev` varchar(30) NOT NULL,
  `feladat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `feladat`
--

INSERT INTO `feladat` (`jogkor_nev`, `feladat`) VALUES
('Alkalmazott', 'Bármilyen ráhagyott feladat elvégzésére köteles, kis felelősséggel jár.'),
('Főlogisztikus', 'A logisztikai munkákért felelős személyek, nagy felelősség van rajtuk.'),
('Főnök', 'A cég fejese, akinek mindenbe van beleszólása. A legnagyobb felelősség rajta van.'),
('Kisfőnök', 'A főnök távollétében helyettesek, rendszeres munkavégzők kibővített felelősséggel és beleszólással.'),
('Logisztikus', 'A főlogisztikus minionjai, logisztikai munkát végeznek. Fokozott felelősséggel jár.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jogkor`
--

CREATE TABLE `jogkor` (
  `nev` varchar(20) NOT NULL,
  `prioritas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `jogkor`
--

INSERT INTO `jogkor` (`nev`, `prioritas`) VALUES
('Alkalmazott', 1),
('Főlogisztikus', 3),
('Főnök', 5),
('Kisfőnök', 4),
('Logisztikus', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `keszlet`
--

CREATE TABLE `keszlet` (
  `aru_azonosito` int(11) NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `kovetkezo_erkezes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `keszlet`
--

INSERT INTO `keszlet` (`aru_azonosito`, `mennyiseg`, `kovetkezo_erkezes`) VALUES
(2, 500, '2023-01-04'),
(3, 1000, '2022-11-30'),
(11, 10, '2022-12-01'),
(13, 1, '2022-12-01'),
(14, 7, '2022-12-03'),
(15, 40, '2022-12-03'),
(16, 1000, '2022-12-04'),
(17, 37, '2022-12-05'),
(18, 10, '2022-12-03'),
(19, 100, '2022-12-01'),
(20, 40, '2022-12-06'),
(21, 3, '2022-12-07'),
(22, 100, '2022-12-04'),
(23, 1, '2022-12-01'),
(24, 30, '2022-12-08'),
(25, 32, '2023-01-01'),
(26, 2000, '2023-01-02'),
(27, 1, '2022-12-23'),
(28, 50, '2022-12-20'),
(29, 45, '2022-12-09'),
(30, 10, '2022-12-30'),
(31, 10, '2022-10-12'),
(32, 25, '2022-12-30'),
(33, 50, '2022-12-11'),
(50, 100, '2022-12-01'),
(51, 47, '2023-02-10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mozgas`
--

CREATE TABLE `mozgas` (
  `nyugta` int(11) NOT NULL,
  `aru_azonosito` int(11) NOT NULL,
  `hova` varchar(50) NOT NULL,
  `irany` varchar(10) NOT NULL,
  `mennyiseg` int(11) NOT NULL,
  `mikor` date NOT NULL,
  `felugyelo_szigszam` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `mozgas`
--

INSERT INTO `mozgas` (`nyugta`, `aru_azonosito`, `hova`, `irany`, `mennyiseg`, `mikor`, `felugyelo_szigszam`) VALUES
(1, 2, 'Costa Rica', 'kifele', 50, '0000-00-00', '162312NF'),
(2, 16, 'Costa Rica', 'kifele', 50, '2001-06-06', '899966SA'),
(3, 23, 'Nagasaki', 'kifele', 10, '1999-10-10', '162312NF'),
(4, 24, 'Medgyesbodzás', 'befele', 1, '2021-10-14', '162312NF'),
(5, 25, 'Costa Rica', 'befele', 4, '2022-01-01', '899966SA'),
(6, 3, 'Arad', 'kifele', 1, '2022-11-27', '899966SA'),
(7, 28, 'Costa Rica', 'kifele', 1, '2022-03-02', '899966SA'),
(8, 44, 'Nagasaki', 'befele', 2, '1999-04-08', '162312NF'),
(9, 20, 'Medgyesbodzás', 'kifele', 10, '2019-08-22', '162312NF'),
(10, 27, 'Medgyesegyháza', 'kifele', 100, '2022-11-01', '899966SA');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `raktar`
--

CREATE TABLE `raktar` (
  `azonosito` int(11) NOT NULL,
  `orszag` varchar(50) NOT NULL,
  `varos` varchar(50) NOT NULL,
  `irsz` varchar(4) NOT NULL,
  `utca` varchar(60) NOT NULL,
  `hazszam` varchar(5) NOT NULL,
  `kapacitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `raktar`
--

INSERT INTO `raktar` (`azonosito`, `orszag`, `varos`, `irsz`, `utca`, `hazszam`, `kapacitas`) VALUES
(1, 'Magyarország', 'Medgyesegyháza', '5666', 'Sport utca', '6', 500),
(2, 'Costa Rica', 'Medgyesbodzás', '2013', 'Iskola utca', '9', 50000),
(4, 'Magyarország', 'Medgyesbodzás', '5663', 'Iskola utca', '50', 4),
(5, 'Románia', 'Arad', '4312', 'provident utca', '69', 1337),
(6, 'Japán', 'Nagasaki', '6969', 'Adolf utca', '34', 9);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szemelyzet`
--

CREATE TABLE `szemelyzet` (
  `szigszam` varchar(8) NOT NULL,
  `vezeteknev` varchar(50) NOT NULL,
  `keresztnev` varchar(50) NOT NULL,
  `nem` tinyint(1) NOT NULL,
  `szulido` date NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `szemelyzet`
--

INSERT INTO `szemelyzet` (`szigszam`, `vezeteknev`, `keresztnev`, `nem`, `szulido`, `image`) VALUES
('133131IB', 'Szalai', 'Péter', 1, '1991-03-31', 'ezszala.jpg'),
('162312NF', 'Koleráda', 'József', 1, '2001-06-11', ''),
('331292IB', 'Szecsei', 'Valter', 1, '1994-03-31', 'FTh7dTEWQAUg0EA.jpg'),
('412319NE', 'Isztin', 'Martin', 1, '2002-06-25', ''),
('543289LO', 'Kis', 'Attila', 1, '2001-03-15', 'kisati.jpg'),
('672399KJ', 'Krucsó', 'Zsolt', 1, '2003-03-21', 'krucso.jpg'),
('747821IJ', 'Dobroczki', 'Tamás', 1, '2002-12-27', 'dobro.jpg'),
('887213PO', 'Deák', 'Tamás', 1, '2001-10-24', ''),
('899966SA', 'Isztin', 'Rita', 0, '1994-12-20', ''),
('912873HG', 'Barát', 'Kendra', 0, '2004-04-25', ''),
('995432HM', 'Pellei', 'Zalán', 1, '2004-04-17', 'pelleizazi.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szerep`
--

CREATE TABLE `szerep` (
  `jogkor_nev` varchar(20) NOT NULL,
  `szemelyzet_szigszam` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- A tábla adatainak kiíratása `szerep`
--

INSERT INTO `szerep` (`jogkor_nev`, `szemelyzet_szigszam`) VALUES
('Alkalmazott', '162312NF'),
('Alkalmazott', '747821IJ'),
('Alkalmazott', '912873HG'),
('Alkalmazott', '995432HM'),
('Főlogisztikus', '543289LO'),
('Főlogisztikus', '887213PO'),
('Főnök', '412319NE'),
('Kisfőnök', '899966SA'),
('Logisztikus', '133131IB'),
('Logisztikus', '672399KJ');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `aru`
--
ALTER TABLE `aru`
  ADD PRIMARY KEY (`azonosito`),
  ADD KEY `raktar_azonosito` (`raktar_azonosito`);

--
-- A tábla indexei `feladat`
--
ALTER TABLE `feladat`
  ADD PRIMARY KEY (`jogkor_nev`,`feladat`),
  ADD UNIQUE KEY `feladat` (`feladat`);

--
-- A tábla indexei `jogkor`
--
ALTER TABLE `jogkor`
  ADD PRIMARY KEY (`nev`);

--
-- A tábla indexei `keszlet`
--
ALTER TABLE `keszlet`
  ADD PRIMARY KEY (`aru_azonosito`);

--
-- A tábla indexei `mozgas`
--
ALTER TABLE `mozgas`
  ADD PRIMARY KEY (`nyugta`),
  ADD KEY `aru_azonosito` (`aru_azonosito`),
  ADD KEY `felugyelo_szigszam` (`felugyelo_szigszam`);

--
-- A tábla indexei `raktar`
--
ALTER TABLE `raktar`
  ADD PRIMARY KEY (`azonosito`);

--
-- A tábla indexei `szemelyzet`
--
ALTER TABLE `szemelyzet`
  ADD PRIMARY KEY (`szigszam`);

--
-- A tábla indexei `szerep`
--
ALTER TABLE `szerep`
  ADD PRIMARY KEY (`jogkor_nev`,`szemelyzet_szigszam`),
  ADD KEY `szemelyzet_szigszam` (`szemelyzet_szigszam`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `aru`
--
ALTER TABLE `aru`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT a táblához `mozgas`
--
ALTER TABLE `mozgas`
  MODIFY `nyugta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `raktar`
--
ALTER TABLE `raktar`
  MODIFY `azonosito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `aru`
--
ALTER TABLE `aru`
  ADD CONSTRAINT `aru_ibfk_1` FOREIGN KEY (`raktar_azonosito`) REFERENCES `raktar` (`azonosito`);

--
-- Megkötések a táblához `feladat`
--
ALTER TABLE `feladat`
  ADD CONSTRAINT `feladat_ibfk_1` FOREIGN KEY (`jogkor_nev`) REFERENCES `jogkor` (`nev`);

--
-- Megkötések a táblához `keszlet`
--
ALTER TABLE `keszlet`
  ADD CONSTRAINT `keszlet_ibfk_1` FOREIGN KEY (`aru_azonosito`) REFERENCES `aru` (`azonosito`);

--
-- Megkötések a táblához `mozgas`
--
ALTER TABLE `mozgas`
  ADD CONSTRAINT `mozgas_ibfk_1` FOREIGN KEY (`aru_azonosito`) REFERENCES `aru` (`azonosito`),
  ADD CONSTRAINT `mozgas_ibfk_2` FOREIGN KEY (`felugyelo_szigszam`) REFERENCES `szemelyzet` (`szigszam`);

--
-- Megkötések a táblához `szerep`
--
ALTER TABLE `szerep`
  ADD CONSTRAINT `szerep_ibfk_1` FOREIGN KEY (`jogkor_nev`) REFERENCES `jogkor` (`nev`),
  ADD CONSTRAINT `szerep_ibfk_2` FOREIGN KEY (`szemelyzet_szigszam`) REFERENCES `szemelyzet` (`szigszam`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
