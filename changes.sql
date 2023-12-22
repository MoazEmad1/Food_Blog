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