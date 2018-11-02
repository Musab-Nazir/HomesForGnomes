-- File: preferred_contact_method.sql
-- Author: Group 24
--  Kevin Astilla
--  Musab Nazir
--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/28
-- Description: SQL file to create preferred contact method property/value table

DROP TABLE IF EXISTS preferred_contact_method;

CREATE TABLE preferred_contact_method(
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE preferred_contact_method OWNER TO group24_admin;

INSERT INTO preferred_contact_method(value, property) VALUES ('e', 'E-mail');

INSERT INTO preferred_contact_method(value, property) VALUES ('p', 'Phone call');

INSERT INTO preferred_contact_method(value, property) VALUES ('l', 'Letter post');
