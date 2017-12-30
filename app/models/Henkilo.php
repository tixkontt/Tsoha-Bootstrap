<?php

class Henkilo extends BaseModel {

//attribuutit
    public $errors, $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $username, $password, $password2, $administrator;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function tallennaHenkilo() {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, password2, administrator) VALUES (:firstnames, :familyname, :dateofbirth, :gender, :nationality, :mobilephone, :email, :username, :password, :password2, :administrator) RETURNING id ');
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
            'password2' => $this->password2,
            'administrator' => $this->administrator));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    //******************************
        public static function tallennaUusiKayttaja($henkilo) {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO henkilo (username, password) VALUES (:username, :password) RETURNING id ');
        $query->execute(array('username' => $this->username,
            'password' => $this->password
            ));

        $row = $query->fetch();
        $this->id = $row['id'];
    }
//    
    //******************************

    public function paivitahenkilo($id) {
        $query = DB::connection()->prepare('UPDATE henkilo SET (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, username, password, password2,administrator)=
                (:firstnames, :familyname, :dateofbirth, :gender, :nationality, :mobilephone, :email, :username, :password, :password2, :administrator)WHERE id =:id');
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
            'password2' => $this->password2,
            'administrator' => $this->administrator
        ));
    }

    public function poistaHenkilo($id) {
//        $query = DB::connection()->prepare('DELETE FROM valitaulu WHERE henkiloid = :id');
        $query = DB::connection()->prepare('DELETE FROM henkilo WHERE henkilo.id = :id');
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
                'gender' => $row['gender'],
                'nationality' => $row['nationality'],
                'mobilephone' => $row['mobilephone'],
                'email' => $row['email'],
                'username' => $row['username'],
                'password' => $row['password'],
                'password2' => $row['password2'],
                'administrator' => $row['administrator']
            ));
        }
        return $henkilo;
    }

    public static function etsihenkilo($id) {
        //alustetaan tietokantayhteys
        $query = DB::connection()->prepare('SELECT henkilo.id AS id, henkilo.firstnames as firstnames, henkilo.familyname as familyname, henkilo.dateofbirth, henkilo.gender as gender, henkilo.nationality as nationality, henkilo.mobilephone as mobilephone, henkilo.email as email, henkilo.username as username, henkilo.password as password, henkilo.password2 as password2, henkilo.administrator as administrator FROM henkilo WHERE henkilo.id =:id LIMIT 1');
        //Suoritetaan kysely
        $query->execute(array('id' => $id));
        //haetaan rivi
        $row = $query->fetch(); // haetaan vain yksi osuma
        $henkilo = NULL;

        if ($row) {
            //Käydään rivit läpi
            $henkilo = new Henkilo(array(
                'id' => $row['id'],
                'firstnames' => $row['firstnames'],
                'familyname' => $row['familyname'],
                'dateofbirth' => $row['dateofbirth'],
                'gender' => $row['gender'],
                'nationality' => $row['nationality'],
                'mobilephone' => $row['mobilephone'],
                'email' => $row['email'],
                'username' => $row['username'],
                'password' => $row['password'],
                'password2' => $row['password2'],
                'administrator' => $row['administrator']
            ));
            return $henkilo;
        }
        return NULL;
    }
    
    public static function etsiadmin($id){
        $query =DB::connection()->prepare("SELECT id as id, familyname as familyname FROM henkilo where administrator ='t'AND id=:id LIMIT 1");
        $query->execute(array('id'=>$id));
        $row = $query->fetch();
        
        if($row){
            $administrator = new Henkilo(array(
                'administrator'=>$row['administrator']
             ));
            return $administrator;    
                                
        }
        
        return NULL;
    }

    
    public function poistaHenkiloJaHanenMatkat($id) {

        $query = DB::connection()->prepare('DELETE              
            FROM matka
            WHERE matka.id in
            (
                SELECT valitaulu.matkaid
                FROM valitaulu, henkilo
                WHERE valitaulu.henkiloid=henkilo.id
                AND henkilo.id= :id
            )
            ;');
        $query->execute(array('id' => $this->id));
        $query = null;
        $query = DB::connection()->prepare('DELETE FROM henkilo WHERE henkilo.id = :id');
        $query->execute(array('id' => $this->id));
       
 }
}
