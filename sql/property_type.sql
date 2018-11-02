--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29

DROP TABLE IF EXISTS property_type;

CREATE TABLE property_type(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

--ALTER TABLE property_options OWNER TO group24-- Author: Group 24


INSERT INTO property_options (value, property) VALUES (1, 'Single');

INSERT INTO property_options (value, property) VALUES (2, 'Detached');

INSERT INTO property_options (value, property) VALUES (4, 'Bungalow');

INSERT INTO property_options (value, property) VALUES (8, 'Townhome');

INSERT INTO property_options (value, property) VALUES (16, 'Duplex');