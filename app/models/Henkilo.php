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
            'username' => $this->username,
            'password' => $this->password,
            'administrator' => $this->administrator));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function muokkaaMatkailijaa() {
        $query = DB::connection()->prepare('UPDATE henkilo SET firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, administrator)=
                (:firstnames, :familyname, :dateofbirth, :gender, :nationality, :mobilephone, :email, :username, :password, :administrator');
        $query->execute(array('id' => $this->id,
            'firstnames' => $this->firstnames,
            'familyname' => $this->familyname,
            'dateofbirth' => $this->dateofbirth,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'mobilephone' => $this->mobilephone,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'administrator' => $this->administrator
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function poistaMatkailija() {
        $query = DB::connection()->prepare('DELETE FROM henkilo WHERE henkilo.id=:id');
        $query->execute(array('id' => $this->id));
    }

    public static function kaikkihenkilot() {
        //alustetaan tietokantayhteys
        $query = DB::connection()->prepare('SELECT * FROM henkilo');
        //Suoritetaan kysely
        $query->execute();
        //haetaan rivit
        $rows = $query->fetchAll();
        $henkilot = array();

        //Käydään rivit läpi
        foreach ($rows as $row) {
            $henkilot[] = new Henkilo(array(
                'id' => $row['id'],
                'firstnames' => $row['firstnames'],
                'familyname' => $row['familyname'],
                'dateofbirth' => $row['dateofbirth'],
                'nationality' => $row['nationality'],
                'mobilephone' => $row['mobilephone'],
                'username' => $row['username'],
                'password' => $row['password'],
                'administrator' => $row['administrator']
            ));
        }
        return $henkilot;
    }

}
