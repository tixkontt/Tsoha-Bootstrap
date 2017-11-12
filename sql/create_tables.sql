CREATE TABLE henkilo(
	id SERIAL PRIMARY KEY, 
	firstNames varchar(50) NOT null,
	familyname varchar(50) NOT null,
	dateOfBirth varchar(10) NOT null,
	gender varchar(12),
	nationality varchar(50) NOT null,
	mobilePhone varchar(25),
	email varchar(30)
	);

CREATE TABLE matkakohde(
	id SERIAL PRIMARY KEY,
--	matkustaja integer  REFERENCES henkilo(id), 
	country varchar(50) NOT NUll,
	arrivalDate date NOT null,
	departureDate date NOT null,
	address varchar(60),
	postCode varchar(10),
	city varchar(30)
	);

CREATE TABLE maa(
	id SERIAL PRIMARY KEY, 
        country varchar(50) NOT NULL
	);

--CREATE TABLE valitaulu(
--	id SERIAL PRIMARY KEY,
--	FOREIGN KEY (countryKey) REFERENCES maa (id),
--	FOREIGN KEY (henkiloId) REFERENCES henkilo (id)
--	);
