CREATE TABLE IF NOT EXISTS `#__labgeneagrogene_exams` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `catid`            INT(11)          NOT NULL,
  `title`            VARCHAR(255)     NOT NULL,
  `code`             INT(11)          NOT NULL,
  `price`            DECIMAL(10, 2)   NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgeneagrogene_requests` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product`          VARCHAR(150)     NOT NULL,
  `deadline`         DATE             NOT NULL,
  `lot`              INT              NOT NULL,
  `reference`        VARCHAR(150)     NOT NULL,
  `amount`           INT              NOT NULL,
  `date_manufacture` DATE             NOT NULL,
  `date_validity`    DATE             NOT NULL,
  `constitution`     INT              NOT NULL,
  `number_products`  INT              NULL,
  `urgent`           BOOLEAN          NOT NULL DEFAULT FALSE,
  `info`             TEXT             NOT NULL,
  `date_reception`   DATE             NULL,
  `situationsid`     INT(11)          NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgeneagrogene_constitutions` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `title`            VARCHAR(255)     NOT NULL,
  `description`      VARCHAR(255)     NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgeneagrogene_situations` (
  `id`               INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `title`            VARCHAR(255)     NOT NULL,
  `description`      VARCHAR(255)     NOT NULL,
  `ordering`         INT(11)          NOT NULL,
  `state`            TINYINT(1)       NOT NULL,
  `checked_out`      INT(11)          NOT NULL,
  `checked_out_time` DATETIME         NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by`       INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__labgeneagrogene_examslist` (
  `requestsid` INT(11) NOT NULL,
  `examsid`   INT(11) NOT NULL,
  PRIMARY KEY (`requestsid`, `examsid`)
)
  DEFAULT COLLATE = utf8_general_ci;