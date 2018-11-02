-- File: property_options.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29
-- Description: SQL file to create property_options property/value table

DROP TABLE IF EXISTS property_options;

CREATE TABLE property_option(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_options OWNER TO group24-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29_admin;

INSERT INTO property_options (value, property) VALUES (1, 'Garage');

INSERT INTO property_options (value, property) VALUES (2, 'AC');

INSERT INTO property_options (value, property) VALUES (4, 'Pool');

INSERT INTO property_options (value, property) VALUES (8, 'Acreage');

INSERT INTO property_options (value, property) VALUES (16, 'Waterfront');