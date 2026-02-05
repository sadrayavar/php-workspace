/*
    product table
*/

CREATE TABLE `products` (
    `id` MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT UNIQUE,

    `title` VARCHAR(100) NOT NULL,
    `base_price` DECIMAL(20,4) NOT NULL,
    `sale_price` DECIMAL(20,4) NOT NULL,
    `supply` SMALLINT UNSIGNED DEFAULT 0 NOT NULL,
    `state` ENUM("draft","selling","presale","stopped", "deleted") DEFAULT "draft" NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL,

    INDEX indexed_title (title),
    INDEX indexed_state (state)
);

ALTER TABLE products ADD INDEX indexed_deleted (deleted_at);

ALTER TABLE products DROP COLUMN supply;
ALTER TABLE products ADD COLUMN `stock` SMALLINT UNSIGNED DEFAULT 0 NOT NULL;

ALTER TABLE products ADD COLUMN `thumbnail` VARCHAR(250);

ALTER TABLE products MODIFY `created_at` DATETIME;
ALTER TABLE products MODIFY `updated_at` DATETIME;