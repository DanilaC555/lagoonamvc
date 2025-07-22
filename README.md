# lagoonamvc

![screenshot site](img/lagoona.png)

## description
-- 1. Таблица пользователей
CREATE TABLE `users` (
  `id`          INT(11) NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255) NOT NULL,
  `email`       VARCHAR(255) NOT NULL,
  `password`    VARCHAR(255) NOT NULL,
  `created_at`  TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role`        ENUM('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_users_email` (`email`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- 2. Таблица отелей
CREATE TABLE `hotels` (
  `id`              INT(11) NOT NULL AUTO_INCREMENT,
  `name`            VARCHAR(255) NOT NULL,
  `city`            VARCHAR(255) NOT NULL,
  `country`         VARCHAR(255) NOT NULL,
  `price_per_night` DECIMAL(10,2) NOT NULL,
  `rating`          TINYINT     NOT NULL,
  `image_path`      VARCHAR(255) NOT NULL,
  `created_at`      DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`      DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP
                                  ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- 3. Таблица броней
CREATE TABLE `bookings` (
  `id`         INT(11) NOT NULL AUTO_INCREMENT,
  `user_id`    INT(11) NOT NULL,
  `hotel_id`   INT(11) NOT NULL,
  `status`     ENUM('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` DATE        NOT NULL,
  `end_date`   DATE        NOT NULL,
  `guests`     INT(11)     NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `idx_bookings_user`  (`user_id`),
  KEY `idx_bookings_hotel` (`hotel_id`),
  CONSTRAINT `fk_bookings_user`
    FOREIGN KEY (`user_id`)  REFERENCES `users`  (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_bookings_hotel`
    FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- 4. Таблица заявок (контактов)
CREATE TABLE `requests` (
  `id`         INT(11)     NOT NULL AUTO_INCREMENT,
  `user_id`    INT(11)     DEFAULT NULL,
  `name`       VARCHAR(255) NOT NULL,
  `email`      VARCHAR(255) NOT NULL,
  `tel`        VARCHAR(50)  NOT NULL,
  `message`    TEXT,
  `status`     ENUM('pending','approved') NOT NULL DEFAULT 'pending',
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
                                  ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_requests_user` (`user_id`),
  CONSTRAINT `fk_requests_user`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE SET NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;
