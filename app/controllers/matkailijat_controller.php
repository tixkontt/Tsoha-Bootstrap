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
        //$etunimivirhe=$henkilo->validoi_etunimet();
        $tuloaikavirhe = $matka->validoi_maahantulopaiva();
        $poistumisaikavirhe = $matka->validoi_maastapoistumispaiva();
        $matkankesto = $matka->validoi_matkankesto();

        $errors = array_merge($tuloaikavirhe, $poistumisaikavirhe, $matkankesto);
        if (count($errors) > 0) {
//            View::make('suunnitelmat/henkilo.html', array('errors'=>$errors));
            View::make('suunnitelmat/matka.html', array('errors' => $errors)); //, 'etunimivirhe'=>$etunimivirhe));
        } else {
            $matka->tallennaUusiMatka();
//            Redirect::to('/suunnitelmat/matkalistaus.html' . $matka->id, array('message' => 'Matka lisättiin matkatietokantaan'));
//            Redirect::to('/matkalistaus');
  Redirect::to('/matkalistaus.html' , array('message' => 'Matka lisättiin matkatietokantaan'));
            }




        //ohjataan käyttäjä matkalistaukselle
        // Redirect::to('/suunnitelmat/matkalistaus.html' . $matka->id, array('message' => 'Matka lisättiin matkatietokantaan'));
        Redirect::to('/matkalistaus');
    }

    //validointiversio
    public static function tallennaMatkailija() {
        $params = $_POST;
        $henkilo = new Henkilo(array(
            'firstnames' => $params['firstnames'],
            'familyname' => $params['familyname'],
            'dateofbirth' => $params['dateofbirth'],
            'gender' => $params['gender'],
            'nationality' => $params['nationality'],
            'mobilephone' => $params['mobilephone'],
            'email' => $params['email'],
            'username' => $params['username'],
            'password' => $params['password'],
            'administrator' => $params['administrator']
        ));

        //kutsutaan henkilö-luokan validaattoreita
        $etunimivirhe = $henkilo->validoi_etunimet();
        $sukunimivirhe = $henkilo->validoi_sukunimi();
        $syntymaaikavirhe = $henkilo->validoi_paivays();
//        $maavirhe=$Henkilo->validate_nationality();

        $errors = array_merge($etunimivirhe, $sukunimivirhe, $syntymaaikavirhe);
        if (count($errors) > 0) {
//            View::make('suunnitelmat/henkilo.html', array('errors'=>$errors));
            View::make('suunnitelmat/henkilo.html', array('errors' => $errors)); //, 'etunimivirhe'=>$etunimivirhe));
        } else {
            $Henkilo->tallennaMatkailija();
            Redirect::to('/matkalistaus');
        }
    }

}
