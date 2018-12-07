-- File: offensives.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/12/07
-- Description: SQL file to create offensives property/value table

DROP TABLE IF EXISTS offensives;

CREATE TABLE offensives(
user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
listing_id VARCHAR(10) NOT NULL,
reported_on TIMESTAMP (2) without time zone NOT NULL,
status char(1) NOT NULL
);

ALTER TABLE offensives OWNER TO group24_admin;

