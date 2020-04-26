-- IMPORTANT! If you change this file, you will need to manually
-- delete site.sqlite in order to regenerate the database from this file!

BEGIN TRANSACTION;

-- Users Table
CREATE TABLE users (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	username TEXT NOT NULL UNIQUE,
	password TEXT NOT NULL
);

-- Users seed data
INSERT INTO users (id, username, password) VALUES (1, 'kjh235', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (2, 'rad34', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (3, 'sj88', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (4, 'mih534', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (5, 'ahj2', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (6, 'rjr219', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (7, 'as73', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (8, 'tal33', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey

-- Sessions Table
CREATE TABLE sessions (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	user_id INTEGER NOT NULL,
	session TEXT NOT NULL UNIQUE
);

-- Software Table
CREATE TABLE `software` (
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`name` TEXT NOT NULL
);

-- Software table seed data
INSERT INTO `software` (name) VALUES ('MySQL');
INSERT INTO `software` (name) VALUES ('SQLite');
INSERT INTO `software` (name) VALUES ('PostgreSQL');
INSERT INTO `software` (name) VALUES ('MongoDB');
INSERT INTO `software` (name) VALUES ('Oracle 12c');
INSERT INTO `software` (name) VALUES ('Microsoft SQL Server');
INSERT INTO `software` (name) VALUES ('MariaDB');
INSERT INTO `software` (name) VALUES ('DB2');

-- Reviews Table
CREATE TABLE `reviews` (
	`id`INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`reviewer`TEXT NOT NULL,
	`rating`INTEGER NOT NULL,
	`product_name`TEXT NOT NULL,
	`comment`TEXT
);

-- Reviews table seed data
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('js8282@cornell.edu',3,'Flyknit','These run smaller.');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('jd1234@cornell.edu',4,'Flyknit','These are so comfy they don''t even feel like shoes!');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('alm119@cornell.edu',4,'Air Zoom',NULL);
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('ppl33@cornell.edu',3,'Roshe','Nice.');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('lol88@cornell.edu',2,'Flyknit','Not a fan. They seem kind of flimsy.');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('sos111@cornell.edu',3,'Lunar Guide','Solid shoe.');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('heh101@cornell.edu',5,'Airforce','Will buy again! Recommending to all my friends!');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('dj1004@cornell.edu',4,'Roshe',NULL);
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('hmm21@cornell.edu',5,'Airforce','Got mine last week and I loved them! Just ordered my second pair!');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('kid14@cornell.edu',3,'Roshe','Not sure how I feel about these but they''re alright.');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('man12@cornell.edu',4,'Roshe','It came faster than expected!');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('wat11@cornell.edu',4,'Air Zoom','The color was just as pretty in the photo!');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('apo96@cornell.edu',4,'Lunar Guide','I got these for my son and he loved them! Just make sure you check the size, I don''t know if these run big but I had to go back and exchange it for half a size smaller');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('brb9@cornell.edu',4,'Lunar Guide','Sweet kicks.');
INSERT INTO `reviews` (reviewer,rating,product_name,comment) VALUES ('kk34@cornell.edu',3,'Flyknit','');

-- Students Table
CREATE TABLE `students` (
	`id`INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`user_id`TEXT NOT NULL UNIQUE,
	`first_name`TEXT NOT NULL,
	`last_name`TEXT NOT NULL,
	`grade`TEXT
);

-- Students table seed data
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (1,'Kyle','Harms','C');
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (2,'Rebecca','Dodd','A');
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (3,'Sharon','Jeong','A');
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (4,'Mike','Homza','D');
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (5,'Anita','Jackson','F');
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (6,'Richard','Richard',NULL);
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (7,'Anne','Silea','B');
INSERT INTO `students` (user_id,first_name,last_name,grade) VALUES (8,'Todd','Brennan','C');

CREATE TABLE documents (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	user_id INTEGER NOT NULL,
	file_name TEXT NOT NULL,
	file_ext TEXT NOT NULL,
	description TEXT
);

-- documents seed data
INSERT INTO documents (id, user_id, file_name, file_ext, description) VALUES (1, 1, 'gregory.jpg', 'jpg', 'snowy dog');
INSERT INTO documents (id, user_id, file_name, file_ext, description) VALUES (2, 2, 'cornell-seal.svg', 'svg', 'Cornell''s seal');

COMMIT;
