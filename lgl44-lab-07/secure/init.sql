-- IMPORTANT! If you change this file, you will need to manually
-- delete site.sqlite in order to regenerate the database from this file!

BEGIN TRANSACTION;

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
	`netid`TEXT NOT NULL UNIQUE,
	`first_name`TEXT NOT NULL,
	`last_name`TEXT NOT NULL,
	`grade`TEXT
);

-- Students table seed data
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('kjh235','Kyle','Harms','C');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('rad34','Rebecca','Dodd','A');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('sj88','Sharon','Jeong','A');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('mih534','Mike','Homza','D');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('ahj2','Anita','Jackson','F');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('rjr219','Richard','Richard',NULL);
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('as73','Anne','Silea','B');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('tal33','Todd','Brennan','C');

-- TODO: create documents table



-- TODO: add 3 more seed data entries for documents

-- Documents Table
CREATE TABLE `documents` (
	`id`INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`file_name`TEXT NOT NULL ,
	`file_ext`TEXT NOT NULL,
	`description`TEXT ,

);

-- Students table seed data
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('kjh235','Kyle','Harms','C');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('rad34','Rebecca','Dodd','A');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('sj88','Sharon','Jeong','A');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('mih534','Mike','Homza','D');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('ahj2','Anita','Jackson','F');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('rjr219','Richard','Richard',NULL);
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('as73','Anne','Silea','B');
INSERT INTO `students` (netid,first_name,last_name,grade) VALUES ('tal33','Todd','Brennan','C');

-- TODO: create documents table


-- documents seed data
INSERT INTO documents (id, file_name, file_ext, description) VALUES (1, 'gregory.jpg', 'jpg', 'snowy dog');
INSERT INTO documents (id, file_name, file_ext, description) VALUES (2, 'cornell-seal.svg', 'svg', 'Cornell''s seal');
INSERT INTO documents (id, file_name, file_ext, description) VALUES (3, 'blackcat.jpg', 'jpg', 'black cat');
INSERT INTO documents (id, file_name, file_ext, description) VALUES (4, 'dalmatian.jpg', 'jpg', 'dalmatian dog');
INSERT INTO documents (id, file_name, file_ext, description) VALUES (5, 'hamster.jpg', 'jpg', 'hamster');




COMMIT;
