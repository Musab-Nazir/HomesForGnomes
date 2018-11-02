-- File: salutations.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29
-- Description: SQL file to populate the sallutations table for the dropdow

DROP TABLE IF EXISTS sallutations;

--ALTER TABLE property_options OWNER TO group24_admin;

CREATE TABLE salutations(
  value CHAR(5)
);
INSERT INTO sallutations VALUES('');
INSERT INTO sallutations VALUES('Mr.');
INSERT INTO sallutations VALUES('Ms.');
INSERT INTO sallutations VALUES('Mrs.');
INSERT INTO sallutations VALUES('Sir');
INSERT INTO sallutations VALUES('Lady');
INSERT INTO sallutations VALUES('Dr.');
INSERT INTO sallutations VALUES('Prof.');