<?php

class matkailijalista extends BaseModel {

//attribuutit
    public $id, $firstNames, $familyname, $dateOfBirth, $gender, $nationality, $mobilePhone, $email;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

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
