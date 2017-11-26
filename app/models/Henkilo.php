<?php

class Henkilo extends BaseModel {

//attribuutit
    public $id, $firstnames, $familyname, $dateofbirth, $gender, $nationality, $mobilephone, $email, $password;

     public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
        public function tallennaMatkailija() {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO henkilo (firstnames, familyname, dateofbirth, gender, nationality, mobilephone, email, password) VALUES (:firstnames, :familyname, :dateofbirth, :gender, :nationality, :mobilephone, :email, :password) RETURNING id ');
        $query->execute(array(
            'firstnames' => $this->firstnames, 
            'familyname' => $this->familyname, 
            'dateofbirth' => $this->dateofbirth, 
            'gender' => $this->gender, 
            //'country' => $this->country, 
            'nationality' => $this->nationality, 
            'mobilephone' => $this->mobilephone,
            'email' => $this->email,
            'password' =>$this->password));
        $row=$query->fetch();
        $this->id=$row['id'];
        
        
    }

}


