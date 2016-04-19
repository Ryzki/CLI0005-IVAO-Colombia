CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(50) NOT NULL,
  `val` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `config` (`key`, `val`) VALUES
('CycleEndDate', '04FEB15'),
('CycleName', '1501'),
('CycleStartDate', '08JAN15');