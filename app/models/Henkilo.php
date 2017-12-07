<?php

class Henkilo extends BaseModel {

//attribuutit
    public $errors, $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $username, $password, $administrator;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function tallennaHenkilo() {
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

    public static function paivitahenkilo($id) {
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

    public function poistaHenkilo() {
        $query = DB::connection()->prepare('DELETE FROM henkilo, valitaulu WHERE henkilo.id = :id AND valitaulu.henkiloid= :id');
        $query->execute(array('id' => $this->id));
    }

    
    public static function kaikkiHenkilot() {
        //alustetaan tietokantayhteys
        $query = DB::connection()->prepare('SELECT * FROM henkilo');
        //Suoritetaan kysely
        $query->execute();
        //haetaan rivit
        $rows = $query->fetchAll();
        $henkilo = array();

        //Käydään rivit läpi
        foreach ($rows as $row) {
            $henkilo[] = new Henkilo(array(
                'id' => $row['id'],
                'firstnames' => $row['firstnames'],
                'familyname' => $row['familyname'],
                'dateofbirth' => $row['dateofbirth'],
                'gender'=> $row['gender'],
                'nationality' => $row['nationality'],
                'mobilephone' => $row['mobilephone'],
                'email'=>$row['email'],
                'username' => $row['username'],
                'password' => $row['password'],
                'administrator' => $row['administrator']
            ));
        }
        return $henkilo;
    }
    
        public static function etsihenkilo($id) {
        //alustetaan tietokantayhteys
        $query = DB::connection()->prepare('SELECT henkilo.id AS id, henkilo.firstnames as firstnames, henkilo.familyname as familyname, henkilo.dateofbirth, henkilo.gender as gender, henkilo.nationality as nationality, henkilo.mobilephone as mobilephone, henkilo.email as email, henkilo.username as username, henkilo.password as password, henkilo.administrator as administrator FROM henkilo WHERE henkilo.id =:id LIMIT 1');
        //Suoritetaan kysely
        $query->execute(array('id'=>$id));
        //haetaan rivi
        $row = $query->fetch(); // haetaan vain yksi osuma
        $henkilo = array();

        if($row){
        //Käydään rivit läpi
        $henkilo[] = new Henkilo(array(
                'id' => $row['id'],
                'firstnames' => $row['firstnames'],
                'familyname' => $row['familyname'],
                'dateofbirth' => $row['dateofbirth'],
                'gender'=> $row['gender'],
                'nationality' => $row['nationality'],
                'mobilephone' => $row['mobilephone'],
                'email'=>$row['email'],
                'username' => $row['username'],
                'password' => $row['password'],
                'administrator' => $row['administrator']
            ));
           return $henkilo; 
        }
        return NULL;
    }


}