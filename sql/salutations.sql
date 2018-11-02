-- File: salutations.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29
-- Description: SQL file to populate the salutations table for the dropdown

DROP TABLE IF EXISTS salutations;

--ALTER TABLE property_options OWNER TO group24_admin;

CREATE TABLE salutations(
  value CHAR(5)
);
INSERT INTO salutations VALUES('');
INSERT INTO salutations VALUES('Mr.');
INSERT INTO salutations VALUES('Ms.');
INSERT INTO salutations VALUES('Mrs.');
INSERT INTO salutations VALUES('Sir');
INSERT INTO salutations VALUES('Lady');
INSERT INTO salutations VALUES('Dr.');
INSERT INTO salutations VALUES('Prof.');