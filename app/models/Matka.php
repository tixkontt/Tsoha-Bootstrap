<?php

class Matka extends BaseModel {

//attribuutit
    public $id, $country, $arrivalDate, $departureDate, $address, $postcode, $city;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        //alustetaan tietokantayhteys
        $query = DB::connection()->prepare('SELECT * FROM matkakohde');
        //Suoritetaan kysely
        $query->execute();
        //haetaan rivit
        $rows = $query->fetchAll();
        $matkat = array();

        //Käydään rivit läpi
        foreach ($rows as $row) {
            $maat[] = new Matka(array(
                'id' => $row['id'],
                'country' => $row['country'],
                'arrivalDate' => $row['arrivaldate'],
                'departureDate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']
            ));
        }
        return $maat;
    }

}

/* 

  }
}

 */

