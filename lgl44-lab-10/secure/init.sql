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

-- Animals Table
CREATE TABLE animals (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	name TEXT NOT NULL UNIQUE,
	count INTEGER NOT NULL DEFAULT 0,
	description TEXT,
	source TEXT
);

-- Animals data
INSERT INTO animals (id, name, count, description, source) VALUES (1, 'Triceratops', 1, 'Triceratops is a genus of herbivorous ceratopsid dinosaur that first appeared during the late Maastrichtian stage of the late Cretaceous period, about 68 million years ago (mya) in what is now North America.', 'https://en.wikipedia.org/wiki/Triceratops');
INSERT INTO animals (id, name, count, description, source) VALUES (2, 'Lobster', 8, 'Lobsters have long bodies with muscular tails, and live in crevices or burrows on the sea floor.', 'https://en.wikipedia.org/wiki/Lobster');
INSERT INTO animals (id, name, count, description, source) VALUES (3, 'Hippopotamus', 2, 'The common hippopotamus (Hippopotamus amphibius), or hippo, is a large, mostly herbivorous, semiaquatic mammal native to sub-Saharan Africa.', 'https://en.wikipedia.org/wiki/Hippopotamus');
INSERT INTO animals (id, name, count, description, source) VALUES (4, 'Monkey', 5, 'Monkey is a common name that may refer to groups or species of mammals, in part, the simians of infraorder Simiiformes.', 'https://en.wikipedia.org/wiki/Monkey');
INSERT INTO animals (id, name, count, description, source) VALUES (5, 'Bee', 80000, 'Bees are flying insects closely related to wasps and ants, known for their role in pollination and, in the case of the best-known bee species, the western honey bee, for producing honey and beeswax.', 'https://en.wikipedia.org/wiki/Bee');
INSERT INTO animals (id, name, count, description, source) VALUES (6, 'Penguin', 12, 'Penguins (order Sphenisciformes, family Spheniscidae) are a group of aquatic flightless birds.', 'https://en.wikipedia.org/wiki/Penguin');
INSERT INTO animals (id, name, count, description, source) VALUES (7, 'Polar Bear', 3, 'The polar bear (Ursus maritimus) is a hypercarnivorous bear whose native range lies largely within the Arctic Circle, encompassing the Arctic Ocean, its surrounding seas and surrounding land masses.', 'https://en.wikipedia.org/wiki/Polar_bear');
INSERT INTO animals (id, name, count, description, source) VALUES (8, 'Pig', 7, 'A pig is any of the animals in the genus Sus, within the even-toed ungulate family Suidae.', 'https://en.wikipedia.org/wiki/Pig');

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
	`id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`user_id` TEXT NOT NULL UNIQUE,
	`first_name` TEXT NOT NULL,
	`last_name` TEXT NOT NULL,
	`grade` TEXT
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

-- bank accounts table
CREATE TABLE `bank_accounts` (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	user_id TEXT NOT NULL UNIQUE,
	balance REAL NOT NULL
);

-- bank accounts seed data
INSERT INTO bank_accounts (user_id, balance) VALUES (1, '1000.0');
INSERT INTO bank_accounts (user_id, balance) VALUES (2, '10000.0');
INSERT INTO bank_accounts (user_id, balance) VALUES (3, '12000.1');
INSERT INTO bank_accounts (user_id, balance) VALUES (4, '10.20');
INSERT INTO bank_accounts (user_id, balance) VALUES (5, '300.0');
INSERT INTO bank_accounts (user_id, balance) VALUES (6, '525.25');
INSERT INTO bank_accounts (user_id, balance) VALUES (7, '612.87');
INSERT INTO bank_accounts (user_id, balance) VALUES (8, '8792.28');

COMMIT;
