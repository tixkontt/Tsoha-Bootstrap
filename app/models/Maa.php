<?php

class Maa extends BaseModel {

//attribuutit
    public $id, $country;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function maat(){
     $query=DB::connection()()-->prepare(copy * From /home/tixkontt/Tietokantalabra/Tsoha-Bootstrap/countries.txt DELIMITER as '\n'; )   
        
        
    }

}

/* COPY master FROM 'D:\demo.csv'  DELIMITER AS ',';
 * 
 * 
CREATE TABLE maa(
        id SERIAL PRIMARY KEY, 
        country varchar(50) NOT NULL
        );

 *  */