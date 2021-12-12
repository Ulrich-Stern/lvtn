create DATABASE lvtn;

use lvtn;

CREATE TABLE category
(
	cate_id INT NOT NULL AUTO_INCREMENT,
	cate_title VARCHAR(255) NOT NULL,
	PRIMARY KEY (cate_id)
);

INSERT INTO category
VALUES
	( 1, 'Headphone');
INSERT INTO category
VALUES
	( 2, 'Phone');
INSERT INTO category
VALUES
	( 3, 'Tablet');

CREATE TABLE products
(
	product_id INT not null AUTO_INCREMENT,
	product_title varchar (255) NOT NULL,
	product_price int NOT NULL,
	product_image VARCHAR(255) NOT NULL,
	product_desc VARCHAR(255) NOT NULL,
	product_category INT not null,
	primary key	(product_id),
	FOREIGN KEY	(product_category) REFERENCES category(cate_id)
);
INSERT INTO products
VALUES(1, 'Áo thun cổ tròn (trắng)', 185000, '1-1.jpg 1-2.jpg', 'Chất liệu: Cotton Compact 2S<br>Phân loại: Áo thun form rộng<br>Màu: Trắng<br>', 1);
INSERT INTO products
VALUES(2, 'Áo thun cổ tròn (đen)', 185000, '2-1.jpg 2-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Áo thun form rộng<br>Màu: Đen<br>', 1);
INSERT INTO products
VALUES(3, 'Áo thun cổ tròn (Xanh lá)', 185000, '3-1.jpg 3-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Áo thun form rộng<br>Màu: Xanh lá<br>', 1);
INSERT INTO products
VALUES(4, 'Áo thun cổ tròn (Vàng)', 185000, '4-1.jpg 4-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Áo thun form rộng<br>Màu: Vàng<br>', 1);
insert into products values (5, 'Quần jean (nữ)', 210000, '5-1.jpg 5-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Quần jean nữ<br>Màu: xanh dương<br>', 3);
insert into products values (6, 'Quần jean (nam)', 210000, '6-1.jpg 6-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Quần jean nam<br>Màu: xanh dương<br>', 3);
insert into products values (7, 'Quần soóc jean (nữ)', 140000, '7-1.jpg 7-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Quần jean nữ<br>Màu: xanh dương<br>', 3);
insert into products values (8, 'Quần soóc jean (nam)', 240000, '8-1.jpg 8-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Quần jean nam<br>Màu: xanh dương<br>', 3);
insert into products values (9, 'Váy jean (nữ)', 190000, '9-1.jpg 9-2.jpg','Chất liệu: Cotton Compact 2S<br>Phân loại: Quần jean nữ<br>Màu: xanh dương<br>', 3);

CREATE TABLE user
(
	user_id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	name VARCHAR(255) NOT NULL,
	username char(20) NOT NULL,
	phonenumber VARCHAR(10) NOT NULL,
	password varchar(100) NOT NULL,
	PRIMARY KEY(user_id)
);

INSERT INTO user
VALUES
	(1, 'vitran@gmail.com', 'Vi', 'vi','0334567819', '698d51a19d8a121ce581499d7b701668');
INSERT INTO user
VALUES
	(2, 'truongnguyen@gmail.com', 'Truong', 'truong','016346789', 'bcbe3365e6ac95ea2c0343a2395834dd');
INSERT INTO user
VALUES
	(3, 'thenguyen@gmail.com', 'Nguyen', 'nguyen','0643456389', '310dcbbf4cce62f762a2aaa148d556bd');
INSERT INTO user
VALUES
	(4, 'khoanguyen@gmail.com', 'Khoa', 'khoa', '0143438782', '9a3e61b6bcc8abec08f195526c3132d5a4a98cc0');

CREATE TABLE user_profile
(
	email VARCHAR(255) NOT NULL,
	name VARCHAR(255) NOT NULL,
	username char(20) NOT NULL,
	address varchar(250),
	phonenumber char(11),
	avatar varchar(255) default 'user-icon.png',
	gender char(3),
	PRIMARY KEY(username)
);

INSERT INTO user_profile
VALUES
	('vitran@gmail.com', 'Trần Long Vĩ', 'vi', 'KTX Khu A ĐHQG, TP.HCM', '0341321339', 'user-icon.png', 'Nam');
INSERT INTO user_profile
VALUES
	('truongnguyen@gmail.com', 'Nguyễn Hữu Trường', 'truong', 'KTX Khu B ĐHQG, TP.HCM', '0333444555', 'user-icon.png', 'Nam');
INSERT INTO user_profile
VALUES
	('truongnguyen@gmail.com', 'Thế Nguyên', 'nguyen', null, null, 'user-icon.png', 'Nam');
INSERT INTO user_profile
VALUES
	('truongnguyen@gmail.com', 'Khoa Nguyễn', 'khoa', null, null, 'user-icon.png', 'Nam');

create trigger create_update_user
after INSERT
on user for each row
	INSERT into user_profile
	VALUES (NEW.email, NEW.name, NEW.username, null, null, 'user-icon.png', null);

create table rating
(
	rate_id INT NOT NULL AUTO_INCREMENT,
	username varchar(100) not null,
	product_id int not null,
	review char(8) not null,
	comment varchar(255) not null,
	primary key(rate_id),
	foreign key(product_id) REFERENCES products(product_id)
);

INSERT into rating (username, product_id, review, comment)
VALUES ('vi', 1, 'Tốt', 'Áo mặc rất đẹp, nhân viên rep nhanh. Tương lai sẽ còn mua hàng ở đây.');
INSERT into rating(username, product_id, review, comment)
VALUES ('truong', 1, 'Rất tốt', 'Áo mặc rất đẹp, nhân viên rep nhanh. Tương lai sẽ còn mua hàng ở đây.');
INSERT into rating(username, product_id, review, comment)
VALUES ('vi', 2, 'Tạm', 'Cũng được.');
INSERT into rating(username, product_id, review, comment)
VALUES ('truong', 2, 'Tốt', 'Áo mặc rất đẹp, nhân viên rep nhanh. Tương lai sẽ còn mua hàng ở đây.');
INSERT into rating(username, product_id, review, comment)
VALUES ('vi', 3, 'Tốt', 'Áo mặc rất đẹp, nhân viên rep nhanh. Tương lai sẽ còn mua hàng ở đây.');
INSERT into rating(username, product_id, review, comment)
VALUES ('truong', 3, 'Tốt', 'Áo mặc rất đẹp, nhân viên rep nhanh. Tương lai sẽ còn mua hàng ở đây.');
INSERT into rating(username, product_id, review, comment)
VALUES ('vi', 4, 'Tốt', 'Áo mặc rất đẹp, nhân viên rep nhanh. Tương lai sẽ còn mua hàng ở đây.');
INSERT into rating(username, product_id, review, comment)
VALUES ('truong', 4, 'Tốt', 'Áo mặc rất đẹp, nhân viên rep nhanh. Tương lai sẽ còn mua hàng ở đây.');


CREATE TABLE cart
(
	cart_id int not null AUTO_INCREMENT,
	product_id int NOT NULL,
	quantity int NOT NULL,
	username char(20) NOT NULL,
	status char(10) not null,
	PRIMARY KEY(cart_id),
	foreign key(product_id) REFERENCES products(product_id)
);

insert into cart
values (1, 1, 1, 'vi', 'Unpaid');
insert into cart
values (2, 2, 2, 'vi', 'Paid');
insert into cart
values (3, 3, 1, 'vi', 'Paid');
insert into cart
values (4, 4, 1, 'vi', 'Unpaid');
