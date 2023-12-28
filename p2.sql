CREATE TABLE IF NOT EXISTS `requests`(
  `id` int NOT NULL AUTO_INCREMENT,
  `is_admin` BOOLEAN,
  `pay` varchar(255),
  `taskdetail` varchar(255),
  `task` varchar(255),
  `reqid` int(122),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `user_info`(
  `id` int NOT NULL AUTO_INCREMENT,
  `is_admin` BOOLEAN,
  `passhash` varchar(255),
  `username` varchar(12),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `ownership`(
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` varchar(255),
  `requestid` varchar(12),
  PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `claimed`(
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int(255),
  `claimid` int(12),
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `bushes`(
    `id` int NOT NULL AUTO_INCREMENT,
    `design` varchar(64),
    `img` varchar(255),
    PRIMARY KEY (`id`)

);

INSERT INTO `bushes`
(`design`, `img`)

VALUES
('sphere', 'linglong.jpg'),
('spiral', 'watersa.jpg'),
('maze', 'mazebsuh.jpg'),
('elephant', 'theelephants.jpg'),
('heart', 'heart.jpg'),
('tall', 'long.jpg');


CREATE TABLE IF NOT EXISTS `current_order`(
    `id` int NOT NULL AUTO_INCREMENT,
    `design` varchar(64),
    `img` varchar(255),
    `user` varchar(255),
    `cost` int(12),
    PRIMARY KEY (`id`)

);



CREATE TABLE IF NOT EXISTS `pastorders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `design` varchar(64),
  `img` varchar(255),
  `user` varchar(255),
  `cost` int(12),

  PRIMARY KEY (`id`)
);