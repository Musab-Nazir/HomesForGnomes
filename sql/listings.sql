drop sequence if exists listing_id_seq;

create sequence listing_id_seq;
select setval('listing_id_seq', 10000);

create table listings (
  listing_id INTEGER NOT NULL PRIMARY KEY DEFAULT nextval('listing_id_seq'),
  user_id VARCHAR(20) NOT NULL REFERENCES users(id),
  status VARCHAR(1) NOT NULL,
  price NUMERIC NOT NULL,
  headline VARCHAR(100),
  description VARCHAR(1000) NOT NULL,
  postal_code CHAR(6) NOT NULL,
  images SMALLINT NOT NULL,
  city INTEGER NOT NULL FOREIGN KEY,
  property_options INTEGER NOT NULL,
  bedrooms INTEGER NOT NULL,
  bathrooms INTEGER NOT NULL,
  property_type INTEGER NOT NULL FOREIGN KEY,
  flooring INTEGER NOT NULL FOREIGN KEY,
  parking INTEGER NOT NULL FOREIGN KEY,
  building_type INTEGER NOT NULL FOREIGN KEY,
  basement_type INTEGER NOT NULL FOREIGN KEY,
  interior_type INTEGER NOT NULL FOREIGN KEY
);
