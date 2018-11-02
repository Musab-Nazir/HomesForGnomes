drop sequence if exists listing_id_seq;

create sequence listing_id_seq;
select setval('listing_id_seq', 10000);

create table listings (
  listing_idint not null primary key default nextval('listing_id_seq'),
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
o	PLUS: at least 6 more fields that will all contain INTEGER values (cannot be empty, default values of zero)
