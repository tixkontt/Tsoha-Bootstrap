\copy Maa (country) FROM '/home/tixkontt/htdocs/Tietokantalabra/assets/countries_new.txt'

INSERT INTO  matka (travellerid, country, arrivalDate, departureDate, address, postcode, city) VALUES (1,'Afganistan','2017-1-1','2000-1-1','Kumpula',00250,'Helsinki');
INSERT INTO  matka (travellerid, country, arrivalDate, departureDate, address, postcode, city) VALUES(1,'Indonesia', '2017-1-1','2018-1-1','Leppavaara',02650,'Espoo');
INSERT INTO  henkilo(firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email,username, password,administrator) VALUES ('timo', 'konttinen', '9.9.1958','male','Suomi','0505501234','timo.konttinen@ankkalinna.fi','motorist','salasana','y');
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES ('Trubadurix', 'Gallialainen', '1100-1-1', 'male','Celt','none', 'none','The Singer','MetalRules','n');
INSERT INTO  matka (travellerid, country, arrivaldate, departuredate, address, postcode, city) VALUES (2,'Ranska','2017-12-12','2017-11-11','Chateau', 123456,'Chateauroux');
INSERT INTO  henkilo(firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, password, administrator) VALUES ('Pelle', 'Peloton','1.1.2017','male','Suomi','050-123456','pelle.peloton@ankkalinna.org','tekniikkaRulaa','n');
-- lisätään välitauluun arvoja---
INSERT INTO  valitaulu(travelkey, henkiloid) VALUES (1,2);
INSERT INTO  valitaulu (travelkey, henkiloid) VALUES (2,1);
INSERT INTO  valitaulu (travelkey, henkiloid) VALUES (3,1);
