CREATE TABLE `foo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `foo` (`id`, `name`) VALUES
  (1, 'Testing'),
  (2, 'Testing2');
