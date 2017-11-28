<?php

class Kirjaudu extends BaseModel {

//attribuutit
    public $username, $password, $password2;
 
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function Kirjaudu() {
        echo 'hep';
    }

}
