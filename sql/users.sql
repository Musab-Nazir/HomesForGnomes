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
-- ALTER TABLE users OWNER TO group24_admin;

INSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access) VALUES(
  'jsmith',
  md5('rover123'),
  'a',
  'john.smith@gmail.com',
  '2017-04-02',
  '2018-09-12');
INSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access) VALUES(
  'sfoster',
  md5('rainbow123'),
  'c',
  'susan.foster@gmail.com',
  '2017-10-05',
  '2018-09-20');
INSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access) VALUES(
  'brush',
  md5('basketball123'),
  'c',
  'brandon.rush@gmail.com',
  '2017-06-23',
  '2018-09-17');
INSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access) VALUES(
  'nminaj',
  md5('barbiedreams123'),
  'c',
  'nicki.minaj@gmail.com',
  '2018-04-02',
  '2018-09-24');
