<?php

class Maa extends BaseModel {

//attribuutit
    public $id, $country;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function kaikkiMaat() {
        //tietokantayhteyden alustus
        $query = DB::connection()->prepare('SELECT * From maa');
        // kyselyn suoritus
        $query->execute();
        //haetaan rivit
        $rows = $query->fetchAll();
        $kaikkimaat = array();
        foreach ($rows as $row) {
            $kaikkimaat[] = new Maa(array(
                'id' => $row['id'],
                'country' => $row ['country'])
            );
        }

        return $kaikkimaat;
    }

}

//}

/* COPY master FROM 'D:\demo.csv'  DELIMITER AS ',';
 * 
 * 
CREATE TABLE maa(
        id SERIAL PRIMARY KEY, 
        country varchar(50) NOT NULL
        );

 *  */