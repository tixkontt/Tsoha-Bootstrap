<?php
 class HaeMatka extends BaseModel {

//attribuutit
    public $id, $maa, $matka,$country, $arrivalDate, $departureDate, $address, $postcode, $city;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function HaeMatka(){
        $query= DB::connection()->prepare('SELECT * FROM matka ORDER BY random() LIMIT 1');
        
        $query ->execute();
        $row = $query->fetch();
        
        if($row){
            $matka = new Matka(array(
            'id'=>$row['id'],
            'travelleridid'=>$row['travellerid'],
            'country'=>$row['country'],
            'arrivaldate'=>$row['arrivaldate'],
            'departuredate'=>$row['departuredate'],
            'address'=>$row['address'],
            'postcode'=>$row['postcode'],
            'city' =>$row['city']   ));   
                    
               return $matka;  
     
        }
       return null; 
        
    }
    
    
        public function HaeMatkatYhdestaMaasta(){
        $query= DB::connection()->prepare('SELECT * FROM matka');
        
        $query ->execute();
        $row = $query->fetchall();
        
        $matkat = array();
        
        foreach ($rows as $row){
            $matkat = new Matka(array(
            'id'=>$row['id'],
            'travelleridid'=>$row['travellerid'],
            'country'=>$row['country'],
            'arrivaldate'=>$row['arrivaldate'],
            'departuredate'=>$row['departuredate'],
            'address'=>$row['address'],
            'postcode'=>$row['postcode'],
            'city' =>$row['city']   ));   
                    
               return $matkat;  
     
        }
       return null; 
        
    }
    
    
 }