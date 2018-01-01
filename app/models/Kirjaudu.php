<?php

class Kirjaudu extends BaseModel {

//attribuutit

    public $errors, $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $username, $password, $administrator;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_StringLengthAndNotNull', 'validate_date', 'validate_nationality', 'validoi_salasana', 'validoi_kayttajatunnus');
    }

    public static function Kirjaudu($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM henkilo WHERE username = :username AND password = :password  LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $henkilo = new Henkilo(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'administrator' => $row['administrator']
            ));
            return $henkilo;
        }
        return null;
    }

    public static function Luokayttaja($username, $password) {
        //tsekataan, onko käyttäjätunnus jo käytössä
        $query = DB::connection()->prepare('INSERT INTO henkilo VALUES(username = :username, password = :password');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $henkilo = new Henkilo(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'administrator' => $row['administrator']
                    )
            );
            return $henkilo;
        }
        return null;
    }

    public static function tsekkaausername($username) {
        $query = DB::connection()->prepare('SELECT username FROM henkilo WHERE username =:username LIMIT 1');
        $query->execute(array('username' => $username));
        $row = $query->fetch();
        if ($row) {
            $henkilo = new Henkilo(array(
                'username' => $row['username'],
            ));
            return $henkilo;
        }
        return null;
    }

    public static function tsekkaaadministator($id) {
        $query = DB::connection()->prepare("SELECT * FROM henkilo WHERE administrator ='t' AND id =:id LIMIT 1");
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $administrator = new Henkilo(array(
                'administrator' => $row['administrator'],
            ));
            return $administrator;
        }
        return null;
    }

}
