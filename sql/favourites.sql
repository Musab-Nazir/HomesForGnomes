-- File: favourites.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/12/07
-- Description: SQL file to create favourites property/value table

DROP TABLE IF EXISTS favourites;

CREATE TABLE favourites(
user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
listing_id VARCHAR(10) NOT NULL
);

ALTER TABLE favourites OWNER TO group24_admin;

