\copy Maa (country) FROM '/home/tixkontt/htdocs/Tietokantalabra/assets/countries_new.txt'

INSERT INTO  matka (country, arrivalDate, departureDate, address, postcode, city) VALUES ('Afganistan','2017-1-1','2000-1-1','Kumpula',00250,'Helsinki');
INSERT INTO  matka (country, arrivalDate, departureDate, address, postcode, city) VALUES('Indonesia', '2017-1-1','2018-1-1','Leppavaara',02650,'Espoo');
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email,username, password,administrator) VALUES ('timo', 'konttinen', '2017-12-09','male','Suomi','0505501234','timo.konttinen@ankkalinna.fi','motoristi','salasanat','y');
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES ('Trubadurix', 'Gallialainen', '1100-1-1', 'male','Celt','none', 'none','The Singer','MetalRules','n');
INSERT INTO  matka (country, arrivaldate, departuredate, address, postcode, city) VALUES ('Ranska','2017-12-12','2017-11-11','Chateau', 123456,'Chateauroux');
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, password, administrator) VALUES ('Pelle', 'Peloton','2017-1-1','male','Suomi','050-123456','pelle.peloton@ankkalinna.org','tekniikkaRulaa','n');
-- lisätään välitauluun arvoja---
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (1,2);
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (2,1);
--INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (3,1);
