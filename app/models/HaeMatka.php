<?php

class HaeMatka extends BaseModel {

//attribuutit
    public $id, $maa, $matka, $country, $arrivalDate, $departureDate, $address, $postcode, $city;

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
                'travelleridid' => $row['travellerid'],
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
        $query = DB::connection()->prepare('SELECT matka.id as id, matka.travellerid as travellerid, matka.country as country, matka.arrivaldate as arrivaldate, matka.departuredate as departuredate, matka.address as address, matka.postcode as postcode, matka.city as city FROM matka WHERE matka.id= :id LIMIT 1');

        $query->execute(array('id' => $id));
        //haetaan rivi
        $row = $query->fetch(); // haetaan vain yksi osuma

        $matka = array();
        if ($row) {
            $matka[] = new Matka(array(
                'id' => $row['id'],
                'travellerid' => $row['travellerid'],
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
        $row = $query->fetchall();

        $matkat = array();

        foreach ($rows as $row) {
            $matkat = new Matka(array(
                'id' => $row['id'],
                'travelleridid' => $row['travellerid'],
                'country' => $row['country'],
                'arrivaldate' => $row['arrivaldate'],
                'departuredate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']));

            return $matkat;
        }
        return null;
    }

//SELECT valitaulu.travelkey as matka, valitaulu.henkiloid as matkailija, matka.country as matkakohde, matka.arrivaldate as tulopaiva, matka.departuredate as lahtopaiva, henkilo.familyname as sukunimi 
//FROM valitaulu, henkilo, matka
//WHERE valitaulu.henkiloid = henkilo.id
//AND valitaulu.travelkey=matka.id;
}
