CREATE TABLE henkilo(
	id SERIAL PRIMARY KEY, 
	firstNames varchar(50) NOT null,
	familyname varchar(50) NOT null,
	dateOfBirth varchar(10) NOT null,
	gender varchar(12),
	nationality varchar(50) NOT null,
	mobilePhone varchar(25),
	email varchar(30),
	password varchar(30),
        administrator boolean DEFAULT 'false'
	);

CREATE TABLE maa(
	id SERIAL PRIMARY KEY, 
        country varchar(50) NOT NULL
	);

CREATE TABLE matka(
	id SERIAL PRIMARY KEY,
--	country integer REFERENCES maa(id) NOT NUll,
        country varchar (30) not null,
	arrivalDate date NOT null,
	departureDate date NOT null,
	address varchar(60),
	postCode varchar(10),
	city varchar(30)
	);

CREATE TABLE valitaulu(
	travelkey integer REFERENCES matka (id),
	henkiloid integer REFERENCES henkilo (id)
	);
