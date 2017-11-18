<?php

class matkailijalista extends BaseModel {

//attribuutit
    public $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $password, $nick;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
   // $Timo = new Matkailijalista(array('id=1'=>1, 'firstnames'=>'Timo','familyname'=>'Konttinen'));

}

/*
  id SERIAL PRIMARY KEY,
  firstNames varchar(50) NOT null,
  familyname varchar(50) NOT null,
  dateOfBirth varchar(10) NOT null,
  gender varchar(12),
  nationality varchar(50) NOT null,
  mobilePhone varchar(25),
  email varchar(30)

 * 
 *  */
