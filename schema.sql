CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci

CREATE TABLE categories(
`id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
`name` char (255) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `name` (`name`)
);

CREATE TABLE lots(
`id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
`author_id` INT unsigned NOT NULL,
`winner_id` INT unsigned NOT NULL,
`category_id` INT unsigned NOT NULL,
`name` char (255) NOT NULL,
`description` text,
`url-image` char (255),
`start-price`  INT unsigned NOT NULL,
`dt_finish` timestamp default current_timestamp NOT NULL,
`bet_step` INT unsigned NOT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE wager(
`id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` INT(11) unsigned NOT NULL,
`lot_id` INT(11) unsigned NOT NULL,
`dt_placing` timestamp default current_timestamp NOT NULL,
`user_amount` INT unsigned NOT NULL,
PRIMARY KEY (`id`),
)

CREATE TABLE users(
`id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
`created_lots_id` INT(11) unsigned NOT NULL,
`wager_id` INT(11) unsigned NOT NULL,
`dt_add` timestamp default current_timestamp NOT NULL,
`email` char (128) NOT NULL,
`name` char (255) NOT NULL,
`password` char(64) NOT NULL,
`avatar_path` char(255),
`token` char(32),
PRIMARY KEY (`id`)
);


