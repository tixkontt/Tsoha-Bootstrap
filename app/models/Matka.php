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
                'arrivalDate' => $row['arrivaldate'],
                'departureDate' => $row['departuredate'],
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
            'arrivalDate' => $this->arrivalDate,
            'departureDate' => $this->departureDate,
            'address' => $this->address,
            'postcode' => $this->postcode,
            'city' => $this->city));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_country() {
        //kerätään virheet listalle
        $errors = array();
        if ($this->country == '' || $this->country == null) {
            $errors[] = 'Maakenttä ei saa olla tyhjä!';
        }

        return $errors;
    }

    public function validate_arrivaldate() {
        //kerätään virheet listalle
        $errors = array();
        if ($this->arrivalDate == '' || $this->arrivalDate == null) {
            $errors[] = 'Saapumisaikakenttä ei saa olla tyhjä!';
        }
        return $errors;
    }

    public function validate_departuredate() {
        //kerätään virheet listalle
        $errors = array();
        if ($this->departureDate == '' || $this->departureDate == null) {
            $errors[] = 'Poistumispäivämääräkenttä ei saa olla tyhjä!';
        }
        return $errors;
    }

}

/* 

  }
}

 */

