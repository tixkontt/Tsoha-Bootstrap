--kopioidaan maat alasvetovalikkoon
\copy Maa (country) FROM '/home/tixkontt/htdocs/Tietokantalabra/assets/countries_new.txt'

--lisätään matkoja
INSERT INTO  matka (country, arrivalDate, departureDate, address, postcode, city) VALUES ('Afganistan','2017-1-1','2000-1-1','Kumpula',00250,'Helsinki');
INSERT INTO  matka (country, arrivalDate, departureDate, address, postcode, city) VALUES ('Indonesia', '2017-1-1','2018-1-1','Leppavaara',02650,'Espoo');
INSERT INTO  matka (country, arrivaldate, departuredate, address, postcode, city) VALUES ('Ranska','2017-12-12','2017-11-11','Chateau', 123456,'Chateauroux');
INSERT INTO  matka (country, arrivaldate, departuredate, address, postcode, city) VALUES ('Ruotsi','2018-2-12','2018-3-1','Satamakuja 1', 123456,'Tukholma');
INSERT INTO  matka (country, arrivaldate, departuredate, address, postcode, city) VALUES ('Malediivit','2018-3-12','2018-11-11','Atolli 1', 007,'Malediivit');
INSERT INTO  matka (country, arrivaldate, departuredate, address, postcode, city) VALUES ('Italia','2017-12-12','2018-11-1','Vatikaaninkuja 1', 00001,'Rooma');
INSERT INTO  matka (country, arrivaldate, departuredate, address, postcode, city) VALUES ('Ruotsi','2017-12-10','2018-2-12','Kununkaankujakuja 1', 123456,'Oslo');
INSERT INTO  matka (country, arrivaldate, departuredate, address, postcode, city) VALUES ('Irlanti','2018-1-11','2018-1-21','Old Pub 1', 007,'Tipperary');

---lisätään henkilöitä
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES ('timo', 'konttinen', '2017-12-09','Mies','Suomi','0505501234','timo.konttinen@ankkalinna.fi','motoristi','salasanat',TRUE);
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES ('Trubadurix', 'Gallialainen', '1968-1-1', 'Mies','Ranska','none', 'none','TheSinger','MetalRules',FALSE);
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES ('Pelle', 'Peloton','2017-01-01','Mies','Suomi','050-123456','pelle.peloton@ankkalinna.org','inventor','tekniikkaRulaa', TRUE);
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES ('Lucky', 'Luke', '1968-4-19', 'Mies', 'Yhdysvallat', 'none', 'none','ultrafast','cowboy', FALSE);
INSERT INTO  henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES ('Spacetraveller','StarWars', '2000-1-1','Nainen','Suomi','none','rebels@universum.com','robot12','Chewbacka', TRUE);

-- lisätään välitauluun arvoja
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (1,2);
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (2,1);
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (3,1);
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (4,1);
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (5,1); 
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (6,2);
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (7,3); 
INSERT INTO  valitaulu (matkaid, henkiloid) VALUES (8,4);
