<?php

class maalista extends BaseModel {

//attribuutit
    public $id, $country;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

}

/*
CREATE TABLE maa(
        id SERIAL PRIMARY KEY, 
        country varchar(50) NOT NULL
        );

 *  */