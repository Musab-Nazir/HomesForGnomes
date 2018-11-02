-- File: listing.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/28
-- Description: SQL file to create listing table

drop sequence if exists listing_id_seq;

create sequence listing_id_seq;
select setval('listing_id_seq', 10000);

create table listings (
  user_id VARCHAR(20) NOT NULL REFERENCES users(id),
  status VARCHAR(1) NOT NULL,
  price NUMERIC NOT NULL,
  headline VARCHAR(100),
  description VARCHAR(1000) NOT NULL,
  postal_code CHAR(6) NOT NULL,
  images SMALLINT NOT NULL,
  city INTEGER NOT NULL,
  property_options INTEGER NOT NULL,
  bedrooms INTEGER,
  bathrooms INTEGER,
  year_built,
  style,
  building_type,
  basement_

);
-- ALTER TABLE users OWNER TO group24_admin;
--	PLUS: at least 6 more fields that will all contain INTEGER values (cannot be empty, default values of zero)
