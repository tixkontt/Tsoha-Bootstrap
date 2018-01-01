<?php

class HaeMatka extends BaseModel {

//attribuutit
    public $id, $hid, $vhid, $matkaid, $henkiloid, $maa, $matka, $country, $arrivaldate, $departuredate, $address, $postcode, $city;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function HaeMatka() {
        $query = DB::connection()->prepare('SELECT * FROM matka ORDER BY random() LIMIT 1');

        $query->execute();
        $row = $query->fetch();

        if ($row) {
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
        return null;
    }

    public static function haeYksiMatka($id) {
        // alustetaan tietokantayhteys
        $query = DB::connection()->prepare('SELECT matka.id as id, matka.country as country, matka.arrivaldate as arrivaldate, matka.departuredate as departuredate, matka.address as address, matka.postcode as postcode, matka.city as city FROM matka WHERE matka.id= :id LIMIT 1');
        //suoritetaan kysely
        $query->execute(array('id' => $id));
        //haetaan rivi
        $row = $query->fetch(); // haetaan vain yksi osuma
        //varmistetaan, että objekti $matka on null
        $matka = NULL;

        //Mikäli kysely tuottaa rivin, kootaan tiedot listaksi
        if ($row) {
            $matka = new HaeMatka(array(
                'id' => $row['id'],
                'country' => $row['country'],
                'arrivaldate' => $row['arrivaldate'],
                'departuredate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']
            ));

            return $matka;
        }
        return null;
    }

    public static function HaeMatkatYhdestaMaasta($country) {

        $query = DB::connection()->prepare('SELECT * FROM matka WHERE country = :country');

        $query->execute(array('country' => $country));
        $rows = $query->fetchAll();

        $matkat = array();

        foreach ($rows as $row) {
            $matkat = new Matka(array(
                'id' => $row['id'],
                'country' => $row['country'],
                'arrivaldate' => $row['arrivaldate'],
                'departuredate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']));
        }
        return $matkat;
    }

    public static function HaeYhdenHenkilonMatkat($id) {

        $query = DB::connection()->prepare('SELECT valitaulu.matkaid AS matkaid, 
        matka.country AS country, matka.city AS city, matka.arrivaldate AS arrivaldate, 
        matka.departuredate AS departuredate, matka.address AS address, 
        matka.postcode AS postcode, matka.city AS city 
        FROM matka 
        INNER JOIN valitaulu ON valitaulu.matkaid=matka.id AND valitaulu.henkiloid=:id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $matkalista = array();

        foreach ($rows as $row) {
            $matkalista[] = new HaeMatka(array(
                'id' => $row['matkaid'],
                'country' => $row['country'],
                'arrivaldate' => $row['arrivaldate'],
                'departuredate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']
            ));
        }

        return $matkalista;
    }

}
