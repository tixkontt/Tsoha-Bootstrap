<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;


    public function __construct($attributes=null) {
        // 2 ekaa riviä ylempää
//        parent::construct($attributes);
        $this->validators = array('validoi_etunimet', 'validoi_sukunimi', 'validoi_paivays', 'validoi_maannimikentta', 'validoi_kayttajatunnus', 'validoi_salasana', 'validoi_maahantulopaiva', 'validoi_maastapoistumispaiva','validoi_matkankesto');

//     Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
//     Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
//     ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function validoi_etunimet() {
        $errors = array();
        //Tarkastetaan, että etunimikenttä ei ole tyhjä
        if ($this->firstnames == '' || $this->firstnames == null) {
            $errors[] = 'Etunimikenttä ei saa olla tyhjä tai arvoltaan null!';
        }
//        tarkastetaan, että merkkijonon pituus on vähintään parametrin mittainen
        if (strlen($this->firstnames) <= 3) {
            $errors[] = 'Merkkijonon tulee olla vähintään kolmen merkin mittainen';
        }

        if (strlen($this->firstnames) >= 20) {
            $errors[] = 'Merkkijonon maksimipituus on 20 merkkiä';
        }
        return $errors;
    }

    public function validoi_sukunimi() {
        $errors = array();
        //Tarkastetaan, että etunimikenttä ei ole tyhjä
        if ($this->familyname == '' || $this->familyname == null) {
            $errors[] = 'Sukunimikenttä ei saa olla tyhjä tai arvoltaan null!';
        }
//        tarkastetaan, että merkkijonon pituus on vähintään parametrin mittainen
        if (strlen($this->familyname) <= 3) {
            $errors[] = 'Merkkijonon tulee olla vähintään kolmen merkin mittainen';
        }

        if (strlen($this->firstnames) >= 50) {
            $errors[] = 'Merkkijonon maksimipituus on 50 merkkiä';
        }
        return $errors;
    }

    public function validoi_paivays() {
        $errors = array();
        //Tarkastetaan, että päiväyskenttä ei ole tyhjä
        if ($this->dateofbirth == '' || $this->dateofbirth == null) {
            $errors[] = 'Päiväyskenttä ei saa olla tyhjä!';
        }
        //tarkastetaan, että päiväyskentässä on vähintään 8 merkin syöte
        if (strlen($this->dateofbirth) < 8) {
            $errors[] = 'Päiväyksen minimipituus on 8 merkkiä!';
        }

        if (strlen($this->dateofbirth) > 10) {
            $errors[] = 'Päiväyksen maksimipituus on 10 merkkiä';
        }
         return $errors;
    }


    public function validoi_salasana() {
        $errors = array();
        //Tarkastetaan, että päiväyskenttä ei ole tyhjä
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Salasanakenttä ei saa olla tyhjä!';
        }
        //tarkastetaan, että päiväyskentässä on vähintään 8 merkin syöte
        if (strlen($this->password) < 8) {
            $errors[] = 'Salasanan minimipituus on 8 merkkiä!';
        }

        if (strlen($this->password) > 30) {
            $errors[] = 'Salasanan maksimipituus on 30 merkkiä';
        }

        return $errors;
    }

    public function validoi_kayttajatunnus() {
        $errors = array();
        //Tarkastetaan, että päiväyskenttä ei ole tyhjä
        if ($this->username == '' || $this->username == null) {
            $errors[] = 'Käyttätunnuskenttä ei saa olla tyhjä!';
        }
        //tarkastetaan, että päiväyskentässä on vähintään 8 merkin syöte
        if (strlen($this->username) < 4) {
            $errors[] = 'Käyttäjätunnuksen minimipituus on 4 merkkiä!';
        }

        if (strlen($this->username) > 20) {
            $errors[] = 'Salasanan maksimipituus on 20 merkkiä';
        }

        return $errors;
    }
    
        public function validoi_maahantulopaiva() {
        $errors = array();
        //Tarkastetaan, että päiväyskenttä ei ole tyhjä
        if ($this->arrivalDate == '' || $this->arrivalDate == null) {
            $errors[] = 'Saapumispäivämäärä ei saa olla tyhjä!';
        }
        //tarkastetaan, että päiväyskentässä on vähintään 8 merkin syöte
        if (strlen($this->arrivalDate) < 8) {
            $errors[] = 'Päiväyksen minimipituus on 8 merkkiä!';
        }

        if (strlen($this->arrivalDate) > 10) {
            $errors[] = 'Päiväyksen maksimipituus on 10 merkkiä';
        }

        return $errors;
    }
    
        public function validoi_maastapoistumispaiva() {
        $errors = array();
        //Tarkastetaan, että päiväyskenttä ei ole tyhjä
        if ($this->departureDate == '' || $this->departureDate == null) {
            $errors[] = 'Poistumispäivämäärä ei saa olla tyhjä!';
        }
        //tarkastetaan, että päiväyskentässä on vähintään 8 merkin syöte
        if (strlen($this->departureDate) < 8) {
            $errors[] = 'Päiväyksen minimipituus on 8 merkkiä!';
        }

        if (strlen($this->departureDate) > 10) {
            $errors[] = 'Päiväyksen maksimipituus on 10 merkkiä';
        }

        return $errors;
    }
    
            public function validoi_matkankesto() {
        $errors = array();
        //Tarkastetaan, että päiväyskenttä ei ole tyhjä
        if ($this->arrivalDate > $this->departureDate) {
            $errors[] = 'Matka ei voi loppua ennnen alkamistaan!';
        }

 
        return $errors;
    }

}
