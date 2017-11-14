<?php


class Matka extends BaseModel {

//attribuutit
    public $id, $country, $arrivalDate, $departureDate, $address, $postcode, $city;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

}

/* 
CREATE TABLE matkakohde(
        id SERIAL PRIMARY KEY,
        country varchar(50) NOT NUll,
        arrivalDate date NOT null,
        departureDate date NOT null,
        address varchar(60),
        postCode varchar(10),
        city varchar(30)
        );

 */

