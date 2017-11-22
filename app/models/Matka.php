<?php

class Matka extends BaseModel {

//attribuutit
    public $id, $country, $arrivalDate, $departureDate, $address, $postcode, $city;

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
        $matkat = array();

        //Käydään rivit läpi
        foreach ($rows as $row) {
            $maat[] = new Matka(array(
                'id' => $row['id'],
                'country' => $row['country'],
                'arrivaldate' => $row['arrivaldate'],
                'departurdate' => $row['departuredate'],
                'address' => $row['address'],
                'postcode' => $row['postcode'],
                'city' => $row['city']
            ));
        }
        return $maat;
    }

    public function tallennaUusiMatka() {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO matka (country, arrivaldate, departuredate, address, postcode, city) VALUES (:country, :arrivaldate, :departuredate, :address, :postcode, :city)RETURNING id ');
        $query->execute(array('country' => $this->country, 'arrivaldate' => $this->arrivalDate, 'departuredate' => $this->departureDate, 'address' => $this->address, 'postcode' => $this->postcode, 'city' => $this->city));
        $row=$query->fetch();
        $this->id=$row['id'];
        
        
    }

}

/* 

  }
}

 */

