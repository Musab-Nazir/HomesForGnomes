/*
  Deliverable2_persons.sql
  WEBD3201
  10-28-2018
*/

DROP TABLE IF EXISTS persons;

--ALTER TABLE persons OWNER TO group24_admin;
CREATE TABLE persons(
  user_id VARCHAR(20) PRIMARY KEY NOT NULL REFERENCES users (user_id),
  salutation VARCHAR(10),
  first_name VARCHAR(128) NOT NULL,
  last_name VARCHAR(128) NOT NULL,
  street_address1 VARCHAR(128),
  street_address2 VARCHAR(128),
  city VARCHAR(64),
  province CHAR(2),
  postal_code CHAR(6),
  primary_phone_number VARCHAR(15) NOT NULL,
  secondary_phone_number VARCHAR(15),
  fax_number VARCHAR(15),
  preferred_contact_method CHAR(1) NOT NULL
);
