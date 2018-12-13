INSERT INTO `categories` (`categories_name`)
VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

INSERT INTO `users` (`email`, `name`, `password`, `avatar_path`, `token`)
VALUES
('some@gmail.com', 'Ivan', 'somepassword', NULL, NULL),
('some-some@gmail.com', 'Olga', 'somepassword-1', NULL, NULL);



INSERT INTO `lots` (`author_id`, `winner_id`, `category_id`, `name`, `description`,`url_image`, `start_price`, `bet_step`)
VALUES
('1', '2','1', '2014 Rossignol District Snowboard', NULL, 'img/lot-1.jpg', '10999', '1000' ),
('1', '2', '1', 'DC Ply Mens 2016/2017 Snowboard', NULL, 'img/lot-1.jpg', '10999', '500'),
('2', '1', '2', 'Крепления Union Contact Pro 2015 года размер L/XL', NULL, 'img/lot-3.jpg', '8000', '300'),
('1', '2', '3', 'Ботинки для сноуборда DC Mutiny Charocal', NULL, 'img/lot-4.jpg', '10999', '500'),
('2', NULL, '4', 'Куртка для сноуборда DC Mutiny Charocal', NULL, 'img/lot-5.jpg', '7500', '400'),
('2', NULL, '6', 'Маска Oakley  anti_xssCanopy', NULL, 'img/lot-6.jpg', '5400', '300' );

INSERT INTO `wager` (`user_id`, `lot_id`, `user_amount`)
VALUES
('1', '3', '8300'),
('1', '3', '8600');


-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории;
SELECT l.`name`, `start_price`,`url_image`, MAX(w.`user_amount`), categories_name
FROM lots l
JOIN categories c
ON l.category_id = c.id
JOIN wager w
ON w.`lot_id` = l.`id`
GROUP BY w.`lot_id`


-- показать лот по его id. Получите также название категории, к которой принадлежит лот
SELECT l.`name`, `start_price`,`url_image`, categories_name
FROM lots l
JOIN categories c
ON l.category_id = c.id
WHERE l.`id` = '2'


-- обновить название лота по его идентификатору;
UPDATE lots
SET `name` = 'Ботинки для сноуборда'
WHERE `id` = '3'

-- получить список самых свежих ставок для лота по его идентификатору
SELECT l.`name`, `start_price`,`url_image`, c.`name`, `lot_id`, `user_amount`, `dt_placing`
FROM lots l
JOIN categories c
ON l.category_id = c.id
JOIN wager w
ON w.`lot_id` = l.`id`
WHERE `lot_id` = '3'
ORDER BY `dt_placing`