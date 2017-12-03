<?php

class Henkilo extends BaseModel {

//attribuutit
    public $errors, $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $username, $password, $administrator;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function tallennaMatkailija() {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator) VALUES (:firstnames, :familyname, :dateofbirth, :gender, :nationality, :mobilephone, :email, :username, :password, :administrator) RETURNING id ');
        $query->execute(array(
            'firstnames' => $this->firstnames,
            'familyname' => $this->familyname,
            'dateofbirth' => $this->dateofbirth,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'mobilephone' => $this->mobilephone,
            'email' => $this->email,
            'username'=> $this->username,
            'password' => $this->password,
            'administrator' => $this->administrator));
//        validoi_etunimet(firstnames);
        $row = $query->fetch();
        $this->id = $row['id'];
    }

 



}
