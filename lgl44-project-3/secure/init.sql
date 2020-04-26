-- IMPORTANT! If you change this file, you will need to manually
-- delete site.sqlite in order to regenerate the database from this file!

BEGIN TRANSACTION;

-- Users Table
CREATE TABLE users (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	username TEXT NOT NULL UNIQUE,
	password TEXT NOT NULL
);

CREATE TABLE images (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	location_name TEXT NOT NULL,
	file_name TEXT NOT NULL,
	file_ext TEXT NOT NULL,
	description TEXT,
	user_id INTEGER
);
CREATE TABLE tags (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	tag TEXT NOT NULL UNIQUE

);
CREATE TABLE image_tags (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	image_id TEXT NOT NULL ,
	tag_id TEXT NOT NULL


);


-- Users seed data
INSERT INTO users (id, username, password) VALUES (1, 'lopdf98', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'); -- password: monkey
INSERT INTO users (id, username, password) VALUES (2, 'sally76', '$2y$10$eFBTweRbnJyTNRDLACBMi.15heBWvyR/GyBvbjadUs6lfNWMBHLwm'); -- password: reddawn
INSERT INTO users (id, username, password) VALUES (3, 'bert56', '$2y$10$gxaWl8J4.Lb82ktEbrZJK.0dQr77yJaUc2a0qoVvc6TZOQVjczaC.'); -- password: donkey


INSERT INTO tags (id,tag) VALUES (1,'tropical');
INSERT INTO tags (id,tag) VALUES (2,'affordable');
INSERT INTO tags (id,tag) VALUES (3,'pricy');
INSERT INTO tags (id,tag) VALUES (4,'aquatic');
INSERT INTO tags (id,tag) VALUES (5,'arid');


INSERT INTO image_tags (id,image_id,tag_id) VALUES (1,1,1);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (2,1,3);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (3,2,5);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (4,2,2);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (5,3,4);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (6,3,3);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (7,4,3);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (8,5,2);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (9,5,4);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (10,6,2);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (11,6,5);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (12,7,2);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (13,8,3);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (14,9,3);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (15,9,1);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (16,9,4);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (17,10,2);
INSERT INTO image_tags (id,image_id,tag_id) VALUES (18,10,4);


INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (1,'amazon','amazonrainforest.jpg','jpg',' Located in Brazil
 Source: https://actu.epfl.ch/news/tall-trees-are-crucial-for-the-survival-of-the-ama/');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (2,'grandcanyon','grandcanyon.jpg','jpg','Located in Arizona
 Source: https://www.outsideonline.com/2367261/grand-canyon-travel-guide');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (3,'greatbarrierreef','greatbarrierreef.jpg','jpg','Located below the coasts of Australia Source: https://www.barrierreef.org/');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (4,'mounteverest','mounteverest.jpg','jpg','Located in Nepal
 Source: https://abcnews.go.com/International/china-closes-mount-everest-base-camp-tourists-garbage/story?id=61144089');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (5,'niagarafalls','niagarafalls.jpg','jpg','Located in Canada
 Source: https://twotravelingtexans.com/practical-tips-for-visiting-niagara-falls/');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (6,'paracutin','paracutin.jpg','jpg',' Located in Mexico
Source: https://www.worldatlas.com/articles/paricutin-volcano-mexico.html');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (7,'redwood','redwoodpark.jpg','jpg','An age-old forest in California Source: https://hub.jhu.edu/2017/09/27/redwood-genome-sequencing-project/');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (8,'stonehenge','stonehenge.jpg','jpg','Located in Britain
 Source: https://www.english-heritage.org.uk/visit/places/stonehenge/history-and-stories/history/');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (9,'victoriafalls','victoriafalls.jpg','jpg','Located in Zambia
Source: https://victoriafallstourism.org/');
INSERT INTO images (id,location_name,file_name,file_ext,description) VALUES (10,'yosemitefalls','yosemitefalls.jpg','jpg','Located in Washington Source: https://www.tripsavvy.com/yosemite-waterfalls-overview-4126556');



-- Sessions Table
CREATE TABLE sessions (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	user_id INTEGER NOT NULL,
	session TEXT NOT NULL UNIQUE
);




COMMIT;
