DROP DATABASE IF EXISTS `bihu`;
CREATE DATABASE `bihu`;

USE `bihu`;

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id`       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16)  NOT NULL,
  `password` VARCHAR(16)  NOT NULL,
  `avatar`   TEXT                  DEFAULT NULL,
  `token`    VARCHAR(64)           DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`         INT UNSIGNED NOT NULL,
  `answerCount` INT          NOT NULL DEFAULT 0,
  `recent`      TIMESTAMP    NULL     DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `title`       VARCHAR(32)  NOT NULL,
  `content`     TEXT         NOT NULL,
  `exciting`    INT                   DEFAULT 0,
  `date`        TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`uid`) REFERENCES person (`id`)
)
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id`       INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`      INT UNSIGNED NOT NULL,
  `qid`      INT UNSIGNED NOT NULL,
  `content`  TEXT         NOT NULL,
  `exciting` INT                   DEFAULT 0,
  `best`     BOOLEAN               DEFAULT FALSE,
  `date`     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`uid`) REFERENCES person (`id`),
  FOREIGN KEY (`qid`) REFERENCES question (`id`)
)
  DEFAULT CHARSET = utf8mb4;

