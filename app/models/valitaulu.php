<?php

class Valitaulu extends BaseModel {

//attribuutit
    public $id, $hid, $henkiloid, $matkaid;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function lisaahenkilojamatkavalitauluun($henkiloid, $matkaid){
        
        $query= DB::connection()->prepare('INSERT INTO valitaulu(henkiloid, matkaid) VALUES(:henkiloid, :matkaid)');
        $query->execute(array(
            'matkaid'=>$matkaid,
            'henkiloid'=>$henkiloid
            
        ));
        
        
    }
    }