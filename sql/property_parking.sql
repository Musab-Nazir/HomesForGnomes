--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29

DROP TABLE IF EXISTS property_flooring;

CREATE TABLE property_parking(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_parking OWNER TO group24_admin;-- Author: Group 24


INSERT INTO property_parking (value, property) VALUES (1, 'Single car port');

INSERT INTO property_parking (value, property) VALUES (2, 'Double car port');

INSERT INTO property_parking (value, property) VALUES (4, 'Reserved');

INSERT INTO property_parking (value, property) VALUES (8, 'lor systemt');

