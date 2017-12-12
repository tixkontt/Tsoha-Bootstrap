<?php

class Matka extends BaseModel {

//attribuutit
    public $id, $hid, $henkiloid, $matkailija, $matkakohde, $kaupunki, $tulopaiva, $lahtopaiva,  $travellerid, $country, $arrivaldate, $departuredate, $address, $postcode, $city;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        //alustetaan tietokantayhteys
        $query = DB::connection()->prepare('SELECT * FROM matka');
        //Suoritetaan kysely
        $query->execute();
        //haetaan rivit
        $rows = $query->fetchAll();
//        $matkat = array();
        $maat = array();

        //Käydään rivit läpi
        foreach ($rows as $row) {
            $maat[] = new Matka(array(
                'id' => $row['id'],
                'country' => $row['country'],
                'arrivaldate' => $row['arrivaldate'],
                'departuredate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']
            ));
        }
        return $maat;
    }

    public function tallennaUusiMatka() {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO matka (country, arrivaldate, departuredate, address, postcode, city) VALUES (:country, :arrivalDate, :departureDate, :address, :postcode, :city)RETURNING id ');
        $query->execute(array(
            'country' => $this->country,
            'arrivaldate' => $this->arrivaldate,
            'departuredate' => $this->departuredate,
            'address' => $this->address,
            'postcode' => $this->postcode,
            'city' => $this->city));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function poistaMatka() {
        $query = DB::connection()->prepare('DELETE FROM matka WHERE matka.id=:id');
        $query->execute(array('id' => $this->id));
    }

    public static function etsimatka($id) {
        $query = DB::connection()->prepare('SELECT matka.id as id, matka.country as country, matka.arrivaldate as arrivaldate, matka.departuredate as departuredate, matka.address as address, matka.postcode as postcode, matka.city as city FROM matka WHERE matka.id =:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        $matka = NULL;

        if ($row) {
            //Käydään rivit läpi
            $matka = new Matka(array(
                'id' => $row['id'],
                'country' => $row['country'],
                'arrivaldate' => $row['arrivaldate'],
                'departuredate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']));
            return $matka;
        }
        return NULL;
    }

    public function paivitamatka($id) {
        $query = DB::connection()->prepare('UPDATE matka SET (country, arrivaldate, departuredate, address, postcode, city) = (:country, :arrivaldate, :departuredate, :address, :postcode, :city) WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,
            'country' => $this->country,
            'arrivaldate' => $this->arrivaldate,
            'departuredate' => $this->departuredate,
            'address' => $this->address,
            'postcode' => $this->postcode,
            'city' => $this->city
        ));
//        $row = $query->fetch();
//        $this->id = $row['id'];
    }

    public static function ketkaovatmatkallanyt() {
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
       Kint::dump($matka);
        return $matka;
    }

}

/* 

  }
}

 */

//paivitamatka($id)