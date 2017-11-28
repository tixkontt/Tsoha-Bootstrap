<?php

class Henkilo extends BaseModel {

//attribuutit
    public $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $password, $administrator;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function tallennaMatkailija() {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, password, administrator) VALUES (:firstnames, :familyname, :dateofbirth, :gender, :nationality, :mobilephone, :email, :password, :administrator) RETURNING id ');
        $query->execute(array(
            'firstnames' => $this->firstnames,
            'familyname' => $this->familyname,
            'dateofbirth' => $this->dateofbirth,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'mobilephone' => $this->mobilephone,
            'email' => $this->email,
            'password' => $this->password,
            'administrator' => $this->administrator));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_firstnames() {
        //kerätään virheet listalle
        $errors = array();
        if ($this->firstnames == '' || $this->firstnames == null) {
            $errors[] = 'Nimikenttä ei saa olla tyhjä!';
        }
        if (strlen($this->firstnames) < 2) {
            $errors[] = 'Etunimen tulee olla vähintään kahden merkin mittainen!';
        }

        return $errors;
    }

    public function validate_familyname() {
        //kerätään virheet listalle
        $errors = array();
        if ($this->familyname == '' || $this->familyname == null) {
            $errors[] = 'Sukunimikenttä ei saa olla tyhjä!';
        }
        if (strlen($this->familyname) < 2) {
            $errors[] = 'Sukunimen tulee olla vähintään kahden merkin mittainen!';
        }

        return $errors;
    }

    public function validate_dateofbirth() {
        //kerätään virheet listalle
        $errors = array();
        if ($this->dateofbirth == '' || $this->dateofbirth == null) {
            $errors[] = 'Syntymäaikakenttä ei saa olla tyhjä!';
        }
        if (strlen($this->dateofbirth) < 8 || $this->dateofbirth > 10) {
            $errors[] = 'Syntymäajan tulee olla vähintään kahdeksan merkin mittainen, mutta korkeintaan 10 merkkiä!';
        }

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

        return $errors;
    }

}
