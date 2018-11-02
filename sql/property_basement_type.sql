--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29

DROP TABLE IF EXISTS property_basement_type;

CREATE TABLE property_basement_type(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

--ALTER TABLE property_options OWNER TO group24-- Author: Group 24


INSERT INTO property_options (value, property) VALUES (1, 'Finished');

INSERT INTO property_options (value, property) VALUES (2, 'Part-finished');

INSERT INTO property_options (value, property) VALUES (4, 'Walkout');

INSERT INTO property_options (value, property) VALUES (8, 'Walk-up');
