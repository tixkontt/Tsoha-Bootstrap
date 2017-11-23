<?php
 class HaeMatka extends BaseModel {

//attribuutit
    public $id, $country, $arrivalDate, $departureDate, $address, $postcode, $city;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function HaeMatka(){
       // echo 'hep!';
        
    }
    
 }