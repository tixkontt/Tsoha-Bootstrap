<?php

class MatkailijaKontrolleri extends BaseController {

    public static function matkalistaus() {
        $matkat = Matka::all();
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/matkalistaus.html', array('matkat' => $matkat, 'maa' => $maa));
    }

    public static function kirjaudu() {
//        $kirjaudu = Kirjaudu::kirjaudu();
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
        $params = $_POST;
        $matka = new Matka(array(
            'country' => $params['country'],
            'arrivalDate' => $params['arrivalDate'],
            'departureDate' => $params['departureDate'],
            'address' => $params['address'],
            'postcode' => $params['postcode'],
            'city' => $params['city']
        ));
        //kutsutaan tallenna-metodia

        $matka->tallennaUusiMatka();
        //ohjataan käyttäjä matkalistaukselle
        // Redirect::to('/suunnitelmat/matkalistaus.html' . $matka->id, array('message' => 'Matka lisättiin matkatietokantaan'));
        Redirect::to('/matkalistaus');
    }

    public static function tallennaMatkailija() {
        $params = $_POST;
        $Henkilo = new Henkilo(array(
            'firstnames' => $params['firstnames'],
            'familyname' => $params['familyname'],
            'dateofbirth' => $params['dateofbirth'],
            'gender' => $params['gender'],
            'nationality' => $params['nationality'],
            'mobilephone' => $params['mobilephone'],
            'email' => $params['email'],
            'password' => $params['password'],
            'administrator' => $params['administrator']
        ));
        
        //Tähän väliin tulee henkilö-luokan errors-metodikutsu

        $Henkilo->tallennaMatkailija();

        Redirect::to('/matkalistaus');
    }

}
