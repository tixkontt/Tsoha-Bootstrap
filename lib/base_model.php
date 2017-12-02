<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

//    public function __construct($attributes) {
//        parent::construct($attributes);
//        $this->validators = array('validate_StringLengthAndNotNull', 'validate_date');
//    }

    public function __construct($attributes ) {
        // 2 ekaa riviä ylempää
                parent::construct($attributes);
        $this->validators = array('validate_StringLengthAndNotNull', 'validate_date', 'validate_nationality');

//     Käydään assosiaatiolistan avaimet läpi
       foreach ($attributes as $attribute => $value) {
//     Jos avaimen niminen attribuutti on olemassa...
           if (property_exists($this, $attribute)) {
//     ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
     }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();
        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $errors[]=$validate_StringLengthAndNotNull ='tsekkaaStringPituus';
        $errors[]=
        $this->{$validate_StringLengthAndNotNull};
        
            
        }

        return $errors;
    }

//Tee validaattoreista geneeriset
    public function validate_StringLengthAndNotNull($string, $length) {
        //Tarkastetaan, että etunimikenttä ei ole tyhjä
        if ($string == '' || $string == null) {
            $errors[] = 'String ei saa olla tyhjä tai arvoltaan null!';
        }
        //tarkastetaan, että merkkijonon pituus on vähintään parametrin mittainen
        if (strlen($string) <= $length) {
            $errors[] = 'Merkkijonon tulee olla vähintään ' + $length + ' merkin mittainen';
        }

        if (strlen($string) >= $length) {
            $errors[] = 'Merkkijonon maksimipituus on ' + $length + ' merkkiä';
        }
        return $errors;
    }

    public function validate_date($date) {
        //Tarkastetaan, että päiväyskenttä ei ole tyhjä
        if ($date == '' || $date == null) {
            $errors[] = 'Päiväyskenttä ei saa olla tyhjä!';
        }
        //tarkastetaan, että päiväyskentässä on vähintään 8 merkin syöte
        if (strlen($date) < 8) {
            $errors[] = 'Päiväyksen minimipituus on 8 merkkiä!';
        }

        if (strlen($date) > 10) {
            $errors[] = 'Päiväyksen maksimipituus on 10 merkkiä';
        }
        //tähän vielä tarkistus, että päivämäärä on oikeassa muodossa.
        return $errors;
    }
    
        public function validate_nationality() {
        //kerätään virheet listalle
        $errors = array();
        if ($this->nationality == '' || $this->nationality == null) {
            $errors[] = 'Syntymäaikakenttä ei saa olla tyhjä!';
        }
        if (strlen($this->nationality) < 2) {
            $errors[] = 'Kansallisuustunnuksen minimimitta on kaksi merkkiä!';
        }
        
        if ($this->nationality =='--valitse--'){
            
            $errors[]='Valitse kansallisuus!';
        }

        return $errors;
    }

}
