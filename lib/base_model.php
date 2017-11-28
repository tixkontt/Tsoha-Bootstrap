<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        }

        return $errors;
    }

//Tee validaattoreista geneeriset
    public function validate_etunimet() {
        //Tarkastetaan, että etunimikenttä ei ole tyhjä
        if ($this->firstnames == '' || $this->firstnames == null) {
            $errors[] = 'Etunimikenttä ei saa olla tyhjä';
        }
        //tarkastetaan, että etunimikentässä on vähintään 3 merkin syöte
        if (strlen($this->firstnames) < 3) {
            $errors[] = 'Etunimen tulee olla vähintään 3 merkin mittainen';
        }

        if (strlen($this->firstnames) > 25) {
            $errors[] = 'Etunimen tulee olla enintään 25 merkin mittainen';
        }
        return $errors;
    }
    
        public function validate_sukunimet() {
        //Tarkastetaan, että etunimikenttä ei ole tyhjä
        if ($this->familyname == '' || $this->familyname == null) {
            $errors[] = 'Sukunimikenttä ei saa olla tyhjä';
        }
        //tarkastetaan, että etunimikentässä on vähintään 3 merkin syöte
        if (strlen($this->familyname) < 3) {
            $errors[] = 'Sukunimen tulee olla vähintään 3 merkin mittainen';
        }

        if (strlen($this->etunimet) > 25) {
            $errors[] = 'Etunimen tulee olla enintään 25 merkin mittainen';
        }
        return $errors;
    }

}
