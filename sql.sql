CREATE TABLE `s85_countries` (
  `country_code` varchar(2) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`country_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `s85_countries` (`country_code`, `country_name`) VALUES 
('AR', 'Аргентина'),
('AU', 'Австралия'),
('BR', 'Бразилия'),
('CA', 'Канада'),
('CN', 'Китай'),
('IN', 'Индия'),
('KZ', 'Казахстан'),
('RU', 'Россия'),
('SD', 'Судан'),
('US', 'США');