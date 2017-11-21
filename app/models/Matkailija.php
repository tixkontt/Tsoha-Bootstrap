<?php

class matkailijalista extends BaseModel {

//attribuutit
    public $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $password, $nick;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    

}


