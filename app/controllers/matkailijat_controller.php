<?php

class MatkailijaKontrolleri extends BaseController {

    public static function matkalistaus() {
        $matkat = Matka::all();
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/matkalistaus.html', array('matkat' => $matkat, 'maa' => $maa));
    }

      public static function henkilolistaus() {
        $henkilot = Henkilo::kaikkihenkilot();
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/henkilolistaus.html', array('henkilot' => $henkilot, 'maa' => $maa));
    }
    
    public static function kirjaudu() {
//        $kirjaudu = Kirjaudu::kirjaudu();
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function etusivu() {
        $etusivu = Etusivu::etusivu();
        View::make('suunnitelmat/etusivu.html');
    }

    public static function HaeMatka() {
        $maa = Maa::kaikkiMaat();
        $haematka = HaeMatka::HaeMatka();
        View::make('suunnitelmat/haematka.html', array('maat' => $maa));
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
             $maa = Maa::kaikkiMaat();
            View::make('suunnitelmat/matka.html', array('errors' => $errors,'maat' => $maa )); //, 'etunimivirhe'=>$etunimivirhe));
        } else {
            $matka->tallennaUusiMatka();
//            Redirect::to('/suunnitelmat/matkalistaus.html' . $matka->id, array('message' => 'Matka lisättiin matkatietokantaan'));
//            Redirect::to('/matkalistaus');
            Redirect::to('/matkalistaus', array('message' => 'Matka lisättiin matkatietokantaan'));
        }




        //ohjataan käyttäjä matkalistaukselle
        // Redirect::to('/suunnitelmat/matkalistaus.html' . $matka->id, array('message' => 'Matka lisättiin matkatietokantaan'));
        Redirect::to('/matkalistaus');
    }

    //validointifunktiot
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
           $maa = Maa::kaikkiMaat();
            View::make('suunnitelmat/henkilo.html', array('errors' => $errors, 'maat'=>$maa)); //, 'etunimivirhe'=>$etunimivirhe));
        } else {
            $Henkilo->tallennaMatkailija();
            Redirect::to('/matkalistaus');
        }
    }

    public static function muokkaa_matkaa($id) {
        $matka = HaeMatka::find($id);
        $matkakohde = HaeMatka::haeMatka();

//        View::make('suunnitelmat/matkalistaus.html'), array('id'=> $id, 'travellerid' => $travellerid, 'country'=>$country, 'arrivaldate'=>$arrivaldate, 'departuredate'=>$departuredate, 'address'=>$address, 'postcode=>$postcode', 'city'=>$city));
        View::make('matkalistaus.html', array('id' => $id, 'travellerid' => $travellerid, 'country' => $country, 'arrivaldate' => $arrivaldate, 'departuredate' => $departuredate, 'address' => $address, 'postcode' => $postcode, 'city' => $city));
//           View::make('matka.html', array('id'=> $id, 'travellerid' => $travellerid, 'country'=>$country, 'arrivaldate'=>$arrivaldate, 'departuredate'=>$departuredate, 'address'=>$address, 'postcode'=>$postcode, 'city'=>$city));
    }

    public static function paivitamatka($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'travellerid' => $params['travellerid'],
            'country' => $params['country'],
            'arrivaldate' => $params['arrivaldate'],
            'departuredate' => $params['departuredate'],
            'address' => $params['address'],
            'postcode' => $params['postcode'],
            'city' => $params['city']
        );

        $matka = new Matka($attributes);
//        $errors = $matka->errors();
//        if(count($errors)>0){
//            View::make('suunnitelmat/matka.html', array('errors'=>$errors));
//            
//        }    
        // Redirect::to('suunnitelmat/matka' . array('message'=>'Päivitys onnistui!'));
        Redirect::to('suunnitelmat/matka');
    }

    public static function poistaMatka($id) {
        $matka = new Matka(array('id' => $id));
        $matka->poistaMatka();
        
        Redirect::to('/matkalistaus');
    }
    
      public static function poistaHenkilo($id) {
        $henkilo = new Henkilo(array('id' => $id));
        $henkilo->poistaHenkilo();
        
        Redirect::to('/henkilolistaus');
    }

}
