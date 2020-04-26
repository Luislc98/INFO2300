BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS `Software` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`name`	TEXT NOT NULL
);
INSERT INTO `Software` (id,name) VALUES (1,'MySQL');
INSERT INTO `Software` (id,name) VALUES (2,'SQLite');
INSERT INTO `Software` (id,name) VALUES (3,'PostgreSQL');
INSERT INTO `Software` (id,name) VALUES (4,'MongoDB');
INSERT INTO `Software` (id,name) VALUES (5,'Oracle 12c');
INSERT INTO `Software` (id,name) VALUES (6,'Microsoft SQL Server');
INSERT INTO `Software` (id,name) VALUES (7,'MariaDB');
INSERT INTO `Software` (id,name) VALUES (8,'DB2');
COMMIT;
