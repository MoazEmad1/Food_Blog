/*21/12/2023*/
CREATE TABLE follower(
    follower_id int not null,
    following_id int not null,
    PRIMARY KEY(follower_id,following_id),
    CONSTRAINT flwrFK FOREIGN KEY (follower_id) REFERENCES page_user(uid),
    CONSTRAINT flwingFK FOREIGN KEY (following_id) REFERENCES page_user(uid)
);

ALTER TABLE page_user
ADD COLUMN last_seen datetime not null;

alter table post
add column user_id int not null;


alter table post
add CONSTRAINT uIdPostFK FOREIGN KEY (user_id) REFERENCES page_user(uid)

/*Gender addition in page_user table by ziad mahmoud*/
ALTER TABLE `page_user` ADD `gender` BOOLEAN NOT NULL COMMENT 'male is zero female is one' AFTER `last_seen`;


/*22/12/2023*/
/* M */
CREATE TABLE `cart` (
    `cart_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `item_id` INT,
    `quantity` INT,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`item_id`) REFERENCES `grocery_item` (`gid`)
);