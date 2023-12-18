CREATE TABLE `page_user` (
 `uid` int(11) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(255) NOT NULL,
 `last_name` varchar(255) NOT NULL,
 `user_name` varchar(255) NOT NULL,
 `pass` varchar(255) NOT NULL,
 `dob` date NOT NULL,
 PRIMARY KEY (`uid`),
 UNIQUE KEY `user_name` (`user_name`),
 UNIQUE KEY `pass` (`pass`)
);

CREATE TABLE admin(
    adminid int PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(255) NOT NULL,
    pass varchar(255) NOT NULL,
    type_of_authority varchar(255) NOT NULL,
    CONSTRAINT auth_check CHECK((type_of_authority IN ('grocery','main')))
);

CREATE TABLE post(
    pid int PRIMARY KEY AUTO_INCREMENT,
    img_url VARCHAR(2048) NOT NULL,
    title varchar(255) NOT NULL,
    published_at DATETIME NOT NULL,
    is_veg int(1) NOT NULL,
    caption varchar(2048) NOT NULL,
    CONSTRAINT boolVeg CHECK (is_veg IN (1,0))
);

CREATE TABLE postIngredient(
    ingredient_name varchar(255) not null,
   	post_id int NOT NULL,
    PRIMARY KEY (ingredient_name,post_id),
    CONSTRAINT pidFK FOREIGN KEY (post_id) REFERENCES post(pid)
);

CREATE TABLE grocery_item(
    gid int PRIMARY KEY AUTO_INCREMENT,
    quantity int NOT NULL,
    price INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    img_url varchar(2048) NOT NULL,
    is_veg int(1) NOT NULL,
    CONSTRAINT boolVeg CHECK (is_veg IN (1,0))
);

CREATE TABLE ban_table(
    ban_id int PRIMARY KEY AUTO_INCREMENT,
    uid int NOT NULL,
    admin_id INT NOT NULL,
    banned_at DATETIME NOT NULL,
    CONSTRAINT uidFK FOREIGN KEY (uid) REFERENCES page_user(uid),
    CONSTRAINT adIDFK FOREIGN KEY (admin_id) REFERENCES admin(adminid)
);

CREATE TABLE post_like(
    uid int not null,
    pid int not null,
    liked_at datetime not null,
    PRIMARY KEY(uid,pid),
    CONSTRAINT uidFKLike FOREIGN KEY (uid) REFERENCES page_user(uid),
    CONSTRAINT pidFKLike FOREIGN KEY (pid) REFERENCES post(pid)
);

CREATE TABLE post_save(
    uid int not null,
    pid int not null,
    saved_at datetime not null,
    PRIMARY KEY(uid,pid),
    CONSTRAINT uidFKSave FOREIGN KEY (uid) REFERENCES page_user(uid),
    CONSTRAINT pidFKSave FOREIGN KEY (pid) REFERENCES post(pid)
);

CREATE TABLE post_comment(
    uid int not null,
    pid int not null,
    commented_at datetime not null,
    content varchar(2048) not null,
    PRIMARY KEY(uid,pid),
    CONSTRAINT uidFKCom FOREIGN KEY (uid) REFERENCES page_user(uid),
    CONSTRAINT pidFKCom FOREIGN KEY (pid) REFERENCES post(pid)
);

CREATE TABLE item_confirmation(
    admin_id int not null,
    giid int not null,
    item_action varchar(255) not null,
    confirmaiton_time datetime not null,
    quantity_added int,
    CONSTRAINT adIDFKConf FOREIGN KEY (admin_id) REFERENCES admin(adminid),
    CONSTRAINT giidFK FOREIGN KEY (giid) REFERENCES grocery_item(gid)
);

CREATE TABLE receipt(
    receipt_id int PRIMARY KEY AUTO_INCREMENT,
    uid int not null,
    giid int not null,
    total_price int not null,
    quantity_bought int not null,
    total_item_price int not null,
    CONSTRAINT userIDFKRec FOREIGN KEY (uid) REFERENCES page_user(uid),
    CONSTRAINT giidFKRec FOREIGN KEY (giid) REFERENCES grocery_item(gid)
);