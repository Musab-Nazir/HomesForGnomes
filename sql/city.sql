-- File: city.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29
-- Description: SQL file to create city property/value table

DROP TABLE IF EXISTS city;

CREATE TABLE city(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE city OWNER TO group24_admin;

INSERT INTO city (value, property) VALUES (1, 'Ajax');

INSERT INTO city (value, property) VALUES (2, 'Bowmanville');

INSERT INTO city (value, property) VALUES (4, 'Beaverton');

INSERT INTO city (value, property) VALUES (8, 'Oshawa');

INSERT INTO city (value, property) VALUES (16, 'NewCastle');

INSERT INTO city (value, property) VALUES (32, 'Pickering');

INSERT INTO city (value, property) VALUES (64, 'Port Perry');

INSERT INTO city (value, property) VALUES (128, 'Whitby');

INSERT INTO city (value, property) VALUES (256, 'Uxbridge');