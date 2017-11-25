\copy Maa (country) FROM '/home/tixkontt/htdocs/Tietokantalabra/assets/countries_new.txt'

INSERT INTO  matka (country, arrivalDate, departureDate, address, postcode, city) VALUES (42,'2017-1-1','2000-1-1','Kumpula',00250,'Helsinki');
INSERT INTO  matka (country, arrivalDate, departureDate, address, postcode, city) VALUES(23, '2017-1-1','2018-1-1','Leppavaara',02650,'Espoo');
INSERT INTO  henkilo(firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, password) VALUES ('timo', 'konttinen', '9.9.1958','male','Suomi','0505501234','timo.konttinen@ankkalinna.fi','salasana');
