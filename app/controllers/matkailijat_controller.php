<?php

class MatkailijaKontrolleri extends BaseController {

    public static function matkalistaus() {
        $matkat = Matka::all();
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/matkalistaus.html', array('matkat' => $matkat, 'maa' => $maa));
    }

    public static function kirjaudu() {
        $kirjaudu = Kirjaudu::kirjaudu();
        View::make('suunnitelmat/kirjaudu.html');
    }
    
        public static function etusivu() {
        $etusivu = Etusivu::etusivu();
        View::make('suunnitelmat/etusivu.html');
    }
    
        public static function haematka() {
        $haematka = HaeMatka::haematka();
        View::make('suunnitelmat/haematka.html');
    }

    public static function lisaaMatka() {
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/matka.html', array('maat' => $maa));
    }

    public static function lisaaHenkilo() {
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/henkilo.html', array('maat' => $maa));
    }

    public static function tallennaUusiMatka() {
        $params = $post;
        $matka = new Matka(array(
            'country' => $params['country'],
            'arrivaldate' => $params['arrivaldate'],
            'departuredate' => $params['departuredate'],
            'address' => $params['address'],
            'postcode' => $params['postcode'],
            'city' => $params['city']
        ));
        //kutsutaan tallenna-metodia

        $matka->tallenna();
        //ohjataan käyttäjä matkalistaukselle
        Redirect::to('suunnitelmat/matkalistaus.html' . $matka->id, array('message' => 'Matka lisättiin matkatietokantaan'));
    }

}
