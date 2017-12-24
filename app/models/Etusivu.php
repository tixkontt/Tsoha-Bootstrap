<?php

class Etusivu extends BaseModel {

//attribuutit
   public $id, $maa, $matka, $country, $arrivaldate, $departuredate, $address, $postcode, $city;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
        public static function etusivu(){
           $query = DB::connection()->prepare('SELECT henkilo.id as hid, valitaulu.matkaid as matka, henkilo.familyname as matkailija, matka.country as matkakohde, matka.city as kaupunki, matka.arrivaldate as tulopaiva, matka.departuredate as lahtopaiva, henkilo.username as käyttäjätunnus FROM valitaulu, henkilo, matka
WHERE valitaulu.henkiloid = henkilo.id AND valitaulu.matkaid=matka.id AND matka.arrivaldate <= now() AND matka.departuredate>=now()');
        //Suoritetaan kysely
        $query->execute();
        //haetaan rivit
        $rows = $query->fetchAll();
//        $matkat = array();
        $matka = array();
        //Käydään rivit läpi
        foreach ($rows as $row) {
             $matka[] = new Matka(array(
                'hid' => $row['hid'],
                'matkailija' => $row['matkailija'],
                'matkakohde' => $row['matkakohde'],
                'kaupunki' => $row['kaupunki'],
                'tulopaiva' => $row['tulopaiva'],
                'lahtopaiva' => $row['lahtopaiva'],
            ));
        }
//       Kint::dump($matka);
        return $matka;
    }
        
    }

