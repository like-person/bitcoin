-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 10, 2018 at 09:59 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.0

--
-- Database: `stat_bitcoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `coin_history`
--

CREATE TABLE `coin_history` (
  `coin_stat_id` int(11) NOT NULL,
  `coin_stat_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `coin_symbol` varchar(16) NOT NULL,
  `coin_stat_price` double NOT NULL DEFAULT '0',
  `coin_stat_perc` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coin_history`
--

INSERT INTO `coin_history` (`coin_stat_id`, `coin_stat_datetime`, `coin_symbol`, `coin_stat_price`, `coin_stat_perc`) VALUES
(1, '2018-07-10 10:53:50', 'BTC', 6723.59, -0.6),
(2, '2018-07-10 10:53:50', 'ETH', 465.769, -3.77),
(3, '2018-07-10 10:53:50', 'XRP', 0.465918, -2.385),
(4, '2018-07-10 10:53:50', 'LTC', 78.72, -4.345),
(5, '2018-07-10 10:53:50', 'NEO', 35.579350000000005, -7.69);

-- --------------------------------------------------------

--
-- Table structure for table `coin_stat`
--

CREATE TABLE `coin_stat` (
  `coin_stat_id` int(11) NOT NULL,
  `coin_stat_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `coin_symbol` varchar(16) NOT NULL,
  `coin_stat_price` float NOT NULL DEFAULT '0',
  `coin_stat_perc` float NOT NULL DEFAULT '0',
  `old_stat_price` float NOT NULL DEFAULT '0',
  `old_stat_perc` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coin_stat`
--

INSERT INTO `coin_stat` (`coin_stat_id`, `coin_stat_datetime`, `coin_symbol`, `coin_stat_price`, `coin_stat_perc`, `old_stat_price`, `old_stat_perc`) VALUES
(31, '2018-07-10 10:53:50', 'BTC', 6723.59, -0.6, 6723.59, -0.6),
(32, '2018-07-10 10:53:50', 'ETH', 465.769, -3.77, 485.376, -1.95),
(33, '2018-07-10 10:53:50', 'XRP', 0.465918, -2.385, 0.478053, -3.01),
(34, '2018-07-10 10:53:50', 'LTC', 78.72, -4.345, 82.3132, -3.58),
(35, '2018-07-10 10:53:50', 'NEO', 35.5793, -7.69, 38.5403, -4.65);

-- --------------------------------------------------------

--
-- Table structure for table `coin_stat_source`
--

CREATE TABLE `coin_stat_source` (
  `coin_stat_source_id` int(11) NOT NULL,
  `coin_stat_source_name` varchar(64) NOT NULL,
  `coin_stat_source_api` varchar(128) NOT NULL,
  `coin_stat_source_type` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coin_stat_source`
--

INSERT INTO `coin_stat_source` (`coin_stat_source_id`, `coin_stat_source_name`, `coin_stat_source_api`, `coin_stat_source_type`) VALUES
(1, 'CoinMarketCap', 'https://api.coinmarketcap.com/v2/ticker/', 'data'),
(2, 'CoinCap', 'http://coincap.io/front', 'array');

-- --------------------------------------------------------

--
-- Table structure for table `coin_type`
--

CREATE TABLE `coin_type` (
  `coin_symbol` varchar(8) NOT NULL,
  `coin_name` varchar(16) NOT NULL,
  `coin_params` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coin_type`
--

INSERT INTO `coin_type` (`coin_symbol`, `coin_name`, `coin_params`) VALUES
('BTC', 'Bitcoin', ''),
('ETH', 'Ethereum', ''),
('XRP', 'Ripple', ''),
('LTC', 'Litecoin', ''),
('NEO', 'NEO', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coin_history`
--
ALTER TABLE `coin_history`
  ADD PRIMARY KEY (`coin_stat_id`);

--
-- Indexes for table `coin_stat`
--
ALTER TABLE `coin_stat`
  ADD PRIMARY KEY (`coin_stat_id`);

--
-- Indexes for table `coin_stat_source`
--
ALTER TABLE `coin_stat_source`
  ADD PRIMARY KEY (`coin_stat_source_id`);

--
-- Indexes for table `coin_type`
--
ALTER TABLE `coin_type`
  ADD PRIMARY KEY (`coin_symbol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coin_history`
--
ALTER TABLE `coin_history`
  MODIFY `coin_stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coin_stat`
--
ALTER TABLE `coin_stat`
  MODIFY `coin_stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `coin_stat_source`
--
ALTER TABLE `coin_stat_source`
  MODIFY `coin_stat_source_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
