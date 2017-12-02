<?php

class Kirjaudu extends BaseModel {

//attribuutit
    public $username, $password, $password2, $administrator;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function Kirjaudu($username) {
        $query = DB::connection()->prepare('SELECT * FROM henkilo WHERE username =:username LIMIT 1');
        $query->execute(array('username' => $username));
        $row = $query->fetch();
        
        if($row){
            
            $kirjaudu= new Kirjaudu(array(
                'username'=>$row['username'],
                'name'=>$row['name'],
                'password'=>$row['password'],
                'administrator'=>$row['administrator']        
                ));
            return $kirjaudu;
            
        }
        return null;
    }

}
