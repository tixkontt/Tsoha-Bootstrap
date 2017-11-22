<?php

class MatkailijaKontrolleri extends BaseController {

    public static function matkalistaus() {
        $matkat = Matka::all();
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/matkalistaus.html', array('matkat' => $matkat, 'maa' => $maa));
    }
    
        public static function kirjaudu() {
        $login = Login::login();
        View::make('suunnitelmat/login.html', array('matkat' => $matkat, 'maa' => $maa));
    }


    public static function lisaaMatka() {
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/matka.html', array('maat' => $maa));
    }
    
        public static function lisaaHenkilo() {
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/henkilo.html', array('maat' => $maa));
    }
    
    public static function tallennaUusiMatka(){
        $params=$post;
        $matka= new Matka(array(
        'country'=>$params['country'],
        'arrivaldate'=>$params['arrivaldate'],
        'departuredate'=>$params['departuredate'],
        'address'=>$params['address'],
        'postcode'=>$params['postcode'],
        'city'=>$params['city']  
         ));
        //kutsutaan tallenna-metodia
        
        $matka ->tallenna();
        //ohjataan käyttäjä matkalistaukselle
        Redirect::to('suunnitelmat/matkalistaus.html' . $matka ->id, array('message' => 'Matka lisättiin matkatietokantaan'));

        
    }

}
