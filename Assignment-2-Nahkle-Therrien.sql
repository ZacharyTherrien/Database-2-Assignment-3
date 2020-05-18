---------------------
-- CREATE DATABASE --
---------------------

DROP DATABASE IF EXISTS `Amiibo_DB`;
CREATE DATABASE `Amiibo_DB`;
USE `Amiibo_DB`;

-------------------
-- CREATE TABLES --
-------------------

CREATE TABLE `product` (
    `id` INTEGER,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(500),
    `price` DECIMAL(5,2) DEFAULT 21.99,
    `stock` INTEGER DEFAULT 0,
	`series` ENUM('Super Smash Bros.','Mario Party',"Yoshi's Wooly World",'Splatoon'),
    `num_sold` INTEGER,
    
    CONSTRAINT `chk_product_valid_price`
    CHECK (`price` >= 0),
    CONSTRAINT `chk_stock_valid_stock`
    CHECK (`stock` >= 0),
    
    CONSTRAINT `pk_product_id`
    PRIMARY KEY(`id`)
);
-- Constraints: 
-- Default values: price -> 21.99, stock -> 0, image -> some TBA img.
-- Not null: name
-- Check: price >= 0, stock >= 0.
-- **the name sould not have a unique constraint as some Amiibo share the same name.

CREATE TABLE `customer` (
    `id` INTEGER,
    `username` VARCHAR(15) NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `registered_on` DATETIME DEFAULT NOW(),
    `birthday_on` DATETIME,
    `location` VARCHAR(500),
    
    CONSTRAINT `chk_customer_username_length`
    CHECK (LENGTH(`username`) > 5),
    CONSTRAINT `chk_customer_password_length` 
    CHECK (LENGTH(`password`) > 0),
    
    CONSTRAINT `pk_customer_id`
    PRIMARY KEY(`id`),

    CONSTRAINT `uq_customer_email`
    UNIQUE (`email`),
    CONSTRAINT `uq_customer_username`
    UNIQUE (`username`)
);
-- Constraints: 
-- Not null: names, email, password, registeered_on.
-- **no default values as the not null ones should be provided mandatorily & others are optional.
-- Check: password length > 0 & check username is at least 6 characters long.
-- Unique email & username.
-- Default registered date to be the current time that they registered.

CREATE TABLE `order` (
    `id` INTEGER,
    `customer_id` INTEGER,
    `made_on` DATETIME DEFAULT NOW(),
    `grand_total` DECIMAL(5,2) NOT NULL,
    
    CONSTRAINT `chk_order_valid_grand_total` 
    CHECK (`grand_total` >= 0),
    
    CONSTRAINT `pk_order_id`
    PRIMARY KEY(`id`),
    
    CONSTRAINT `fk_order_customer_id`
    FOREIGN KEY(`customer_id`) REFERENCES `customer`(`id`)
);
-- Constraints: 
-- Not null: made_on & grand_total.
-- Check: total >= 0.
-- **no default values needed.

CREATE TABLE `order_item`(
	`product_id` INTEGER,
    `order_id` INTEGER,
    `quantity` INTEGER NOT NULL,
    `total` DECIMAL(5,2) NOT NULL,

    CONSTRAINT `chk_order_item_quantity` CHECK (`quantity` >= 0),
    CONSTRAINT `chk_order_item_total` CHECK (`total` >= 0),
    
    CONSTRAINT `pk_product_id_order_id`
    PRIMARY KEY(`product_id`, `order_id`),
    
    CONSTRAINT `fk_order_item_product`
    FOREIGN KEY(`product_id`) REFERENCES `product`(`id`),
    CONSTRAINT `fk_order_item_order`
    FOREIGN KEY(`order_id`) REFERENCES `order`(`id`)
);
-- Constraints:
-- Check: quantity & total >= 0.
-- Not null: ^

CREATE TABLE `cart`(
	`product_id` INTEGER,
    `customer_id` INTEGER,
    `quantity` INTEGER DEFAULT 0,

    CONSTRAINT `chk_cart_quantity` CHECK (`quantity` >= 0),
    
    CONSTRAINT `pk_cart_product_id_customer_id`
    PRIMARY KEY(`product_id`, `customer_id`),
    
    CONSTRAINT `fk_cart_product`
    FOREIGN KEY(`product_id`) REFERENCES `product`(`id`),
    CONSTRAINT `fk_cart_customer`
    FOREIGN KEY(`customer_id`) REFERENCES `customer`(`id`)
);
-- Constraints:
-- Check: quantity >= 0.
-- Not null: ^

CREATE TABLE `game`(
    `id` INTEGER,
    `title` VARCHAR(50) NOT NULL,
    `console` ENUM('3DS', 'Wii U', 'New 3DS', 'Switch') NOT NULL,
    `num_sold` INTEGER,

    CONSTRAINT `pk_collection_id`
    PRIMARY KEY(`id`),

    CONSTRAINT `uq_game_title_console`
    UNIQUE (`title`, `console`)
);
-- Constraints:
-- Not null all other fields.
-- Unique for combination of title and console?
-- No need for default nor check on title.

CREATE TABLE `compatibility`(
    `product_id` INTEGER,
    `game_id` INTEGER,

    CONSTRAINT `pk_compatability_product_id_game_id`
    PRIMARY KEY(`product_id`, `game_id`),

    CONSTRAINT `fk_compatability_product`
    FOREIGN KEY(`product_id`) REFERENCES `product`(`id`),
    CONSTRAINT `fk_compatability_game`
    FOREIGN KEY(`game_id`) REFERENCES `game`(`id`)
);
-- Constraints:


CREATE TABLE `collection`(
	`product_id` INTEGER,
    `customer_id` INTEGER,
    `recent_game` INTEGER,
    `obtained_on` DATETIME NOT NULL,

    CONSTRAINT `pk_collection_product_id_customer_id`
    PRIMARY KEY(`product_id`, `customer_id`),
    
    CONSTRAINT `fk_collection_product`
    FOREIGN KEY(`product_id`) REFERENCES `product`(`id`),
    CONSTRAINT `fk_collection_customer`
    FOREIGN KEY(`customer_id`) REFERENCES `customer`(`id`),
    CONSTRAINT `fk_collection_recent_game`
    FOREIGN KEY(`recent_game`) REFERENCES `game`(`id`)
);
-- RECONSIDER DEIGN OF TABLE?
-- Constraints:
-- Not null: date_obtained.
-- **allow title to be empty, so no need of check. Should default = 'Amiibo Collection'?

CREATE TABLE `review`(
	`product_id` INTEGER,
    `customer_id` INTEGER,
    `rating` INTEGER NOT NULL,
    `comment` VARCHAR(100) NOT NULL,

    CONSTRAINT `chk_review_rating` CHECK (`rating` > 0 AND `rating` <= 5),
    
    CONSTRAINT `pk_review_product_id_customer_id`
    PRIMARY KEY(`product_id`, `customer_id`),
    
    CONSTRAINT `fk_review_product`
    FOREIGN KEY(`product_id`) REFERENCES `product`(`id`),
    CONSTRAINT `fk_review_customer`
    FOREIGN KEY(`customer_id`) REFERENCES `customer`(`id`)
);
-- Constraints:
-- Check: rating > 0 && rating <= 5
-- Not null: rating & comment.

CREATE TABLE `image`(
    `id` INTEGER,
    `product_id` INTEGER,
    `picture` blob,
    `alt_tag` VARCHAR(50),
    
    CONSTRAINT `pk_image_id`
    PRIMARY KEY(`id`),

    CONSTRAINT `fk_image_product_id`
    FOREIGN KEY(`product_id`) REFERENCES `product`(`id`)
);
-- Constraints
-- No need of constraints.

-------------
-- INDEXES --
-------------

-- An index for products.
CREATE INDEX `idx_product_name_series_stock`
ON `product` (`name`, `series`, `stock`);

-- An index for review by ratings.
CREATE INDEX `idx_review_rating_product_id`
ON `review` (`rating`, `product_id`); 

-- An index for customers by location.
CREATE INDEX `idx_customer_location_id`
ON `customer` (`location`, `id`);

-- Create Roles
DROP ROLE IF EXISTS `Registered Customer`;
DROP ROLE IF EXISTS `Administrator`;
CREATE ROLE `Registered Customer`, `Administrator`;

-----------
-- VIEWS --
-----------

-- One view for customers to not see number of products sold.
DROP VIEW IF EXISTS `customer_info_for_product`;

CREATE VIEW `customer_info_for_product` AS
SELECT `id`, `name`, `description`, `price`, `stock`, `series`, `num_sold`
FROM `product`;

-- One view for admins to not see other customers' email, password.
DROP VIEW IF EXISTS `customer_info_for_admin`;

CREATE VIEW `customer_info_for_admin` AS 
SELECT `id`, `username`, `first_name`, `last_name`, `registered_on`, `birthday_on`, `location`
FROM `customer`;

-- One view for customers to not see sales of games.
DROP VIEW IF EXISTS `customer_info_for_game`;

CREATE VIEW `customer_info_for_game` AS 
SELECT `id`, `title`, `console`
FROM `game`;

-- Permissions for roles
-- Registered Customer: customer, cart & order but only with their id, all collections, reviews & products. 
-- Manager: should they have access to everything execpt have a view on customers but just w/o pwd?

---------------------------------------
-- Registered Customer's Permissions --
---------------------------------------

-- Product
GRANT SELECT 
ON `Amiibo_DB`.`customer_info_for_product`
TO `Registered Customer`;

-- Customer
GRANT SELECT, UPDATE, DELETE
ON `Amiibo_DB`.`customer`
TO `Registered Customer`;

-- Orders
GRANT SELECT
ON `Amiibo_DB`.`order`
TO `Registered Customer`;

-- Order Item
GRANT SELECT
ON `Amiibo_DB`.`order_item`
TO `Registered Customer`;

-- Cart
GRANT SELECT, UPDATE, INSERT, DELETE
ON `Amiibo_DB`.`cart`
TO `Registered Customer`;

-- Collection
GRANT SELECT, UPDATE
ON `Amiibo_DB`.`collection`
TO `Registered Customer`;

-- Review
GRANT SELECT, UPDATE, DELETE, INSERT
ON `Amiibo_DB`.`review`
TO `Registered Customer`;

-- Compatibility
GRANT SELECT
ON `Amiibo_DB`.`compatibility`
TO `Administrator`;

-- Game
GRANT SELECT
ON `Amiibo_DB`.`customer_info_for_game`
TO `Administrator`;

---------------------------------
-- Administrator's Permissions --
---------------------------------

-- Product
GRANT ALL
ON `Amiibo_DB`.`product`
TO `Administrator`;

-- Customer
GRANT SELECT, DELETE
ON `Amiibo_DB`.`customer_info_for_admin`
TO `Administrator`;

-- Order
GRANT SELECT
ON `Amiibo_DB`.`order`
TO `Administrator`;

-- Order Item
GRANT SELECT
ON `Amiibo_DB`.`order_item`
TO `Administrator`;

-- Cart
GRANT SELECT
ON `Amiibo_DB`.`cart`
TO `Administrator`;

-- Collection
GRANT SELECT
ON `Amiibo_DB`.`collection`
TO `Administrator`;

-- Review
GRANT ALL
ON `Amiibo_DB`.`review`
TO `Administrator`;

-- Compatibility
GRANT ALL
ON `Amiibo_DB`.`compatibility`
TO `Administrator`;

-- Game
GRANT ALL
ON `Amiibo_DB`.`game`
TO `Administrator`;

-----------------------
-- TRIGGERS (Part 1) --
-----------------------

-- 1. After an order is added to order and then to order_item, add it to the customer's collection.
DROP TRIGGER IF EXISTS `trg_insert_order_item_after`;

DELIMITER $$

CREATE TRIGGER `trg_insert_order_item_after`
AFTER INSERT
ON `order_item` FOR EACH ROW
BEGIN
	DECLARE `currentCustomer` INTEGER;
    
	SELECT `customer_id`
    INTO `currentCustomer`
    FROM `order`
    WHERE `id` = NEW.`order_id`;

    INSERT INTO `collection`(`product_id`, `customer_id`, obtained_on)
    VALUES(NEW.`product_id`, `currentCustomer`, now());

END $$

DELIMITER ;

-- MOCK DATA --

-- Insert mock data for customers
INSERT INTO `customer` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `registered_on`, `birthday_on`, `location`)
VALUES (0001, 'DaT_Bo1', 'Truda', 'Presnall', 'tpresnall0@nba.com', 'QULcsa', '2018-7-28 23:59:59', '1963-1-19 23:59:59', 'Indonesia');
INSERT INTO `customer` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `registered_on`, `birthday_on`, `location`)
VALUES (0002, 'B00000000000BA!', 'Albina', 'Oddboy', 'aoddboy1@a8.net', 'yPZgDBKURGG', '2002-2-2 23:59:59', '1990-6-4 23:59:59', 'Canada');
INSERT INTO `customer` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `registered_on`, `birthday_on`, `location`)
VALUES (0003, 'Noodle_Masta', 'Sam', 'Hendrick', 'shendrick2@oaic.gov.au', 'nz0ONUltL6lo', '2007-6-28 23:59:59', '1958-11-4 23:59:59', 'France');

-- Insert mock data for orders
INSERT INTO `order` (`id`, `customer_id`, `made_on`, `grand_total`)
VALUES (0001, 001, '9999-12-31 23:59:59', '0.99');
INSERT INTO `order` (`id`, `customer_id`, `made_on`, `grand_total`)
VALUES (0020, 002, '9999-12-31 23:59:59', '99.99');
INSERT INTO `order` (`id`, `customer_id`, `made_on`, `grand_total`)
VALUES (0004, 003, '9999-12-31 23:59:59', '25.59');


-- Insert mock data for product
INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `series`)
VALUES (001, 'Mario', "It's a me, Mario!", 21.99, 10, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `stock`, `series`)
VALUES (002, 'Yoshi', 'Tax evasion lol.', 0, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `series`)
VALUES (003, 'Luigi', 'Green Mario.', 18.99, 10, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `series`)
VALUES (004, 'Fox', 'ha ha, reflector goes BLEP frame 1.', 21.99, 10, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `price`, `series`)
VALUES (005, 'Link', "Don't bother, none are left thanks to BotW.", 199.99, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `series`)
VALUES (006, 'Donkey Kong', 'CG, coconut gun!', 28.99, 1, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `series`)
VALUES (007, 'Ness', "Sans. Ha ha, good joke.", 19.99, 10, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `stock`, `series`)
VALUES (008, 'Jigglypuff', 'Jigglypuff? I sleep.', 10, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `price`, `series`)
VALUES (009, 'Pikachu', 'The Pokémon that says its name!', 21.99, 'Super Smash Bros.');
INSERT INTO `product` (`id`, `name`, `description`, `price`, `stock`, `series`)
VALUES (010, 'Waluigi', 'I added all Smash characters and then Waluigi just to make a joke.', 25.99, 10, 'Mario Party');

-- Insert mock data for order items
-- Order 0001 customer 0001 (Truda)
INSERT INTO `order_item` (`product_id`, `order_id`, `quantity`, `total`)
VALUES (001, 0001, 1, 21.99);
INSERT INTO `order_item` (`product_id`, `order_id`, `quantity`, `total`)
VALUES (005, 0001, 1, 199.99);
INSERT INTO `order_item` (`product_id`, `order_id`, `quantity`, `total`)
VALUES (009, 0001, 2, 21.99);
-- Order 0020 customer 0002 (Albina)
INSERT INTO `order_item` (`product_id`, `order_id`, `quantity`, `total`)
VALUES (005, 0020, 5, 995.00);
-- Order 0004 customer 0003 (Sam)
INSERT INTO `order_item` (`product_id`, `order_id`, `quantity`, `total`)
VALUES (010, 0004, 1, 0.99);

--------------------------------------------------------
--                  TRIGGERS (Part 2)                 --
-- (Added after the mock data to not temper with it.) --
--------------------------------------------------------

-- Triggers part 2 (added after mock data to not temper with it).

-- 2. If customer makes (inserts) an order, subtract from product stock.
DROP TRIGGER IF EXISTS `after_order_item_insert_stock`;

CREATE TRIGGER `after_order_item_insert_stock`
AFTER INSERT 
ON `order_item` FOR EACH ROW
    UPDATE`product`
    SET `stock` = `stock` - 1
    WHERE `id` = NEW.`product_id`;

-- 3. If customer (inserts) an order, add to product num_sold.
DROP TRIGGER IF EXISTS `after_order_item_insert_sold`;

CREATE TRIGGER `after_order_item_insert_sold`
AFTER INSERT
ON `order_item` FOR EACH ROW
    UPDATE `product`
    SET `num_sold` = `num_sold` + 1
    WHERE `id` = NEW.`product_id`;