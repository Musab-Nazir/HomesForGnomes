-- File: provinces.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29
-- Description: SQL to create provinces drop down
DROP TABLE IF EXISTS provinces;

CREATE TABLE provinces(
	value CHAR(2)
);

ALTER TABLE provinces OWNER TO group24_admin;

INSERT INTO provinces VALUES ('AB');
INSERT INTO provinces VALUES ('BC');
INSERT INTO provinces VALUES ('MB');
INSERT INTO provinces VALUES ('NB');
INSERT INTO provinces VALUES ('NF');
INSERT INTO provinces VALUES ('NS');
INSERT INTO provinces VALUES ('NT');
INSERT INTO provinces VALUES ('NU');
INSERT INTO provinces VALUES ('ON');
INSERT INTO provinces VALUES ('PE');
INSERT INTO provinces VALUES ('PQ');
INSERT INTO provinces VALUES ('SK');
INSERT INTO provinces VALUES ('YT');