/*
  Lab1_users.sql
  WEBD3201
  09-29-2018
*/


-- DROP'ping tables clear out any existing data
DROP TABLE IF EXISTS users CASCADE;

-- CREATE the table, note that id has to be unique, and you must have a name
CREATE TABLE users(
  user_id VARCHAR(20) PRIMARY KEY,
  password VARCHAR(32) NOT  NULL,
  user_type VARCHAR(2) NOT NULL,
  email_address VARCHAR(256) NOT NULL,
  enrol_date DATE NOT NULL,
  last_access DATE NOT NULL
);
ALTER TABLE users OWNER TO group24_admin;
