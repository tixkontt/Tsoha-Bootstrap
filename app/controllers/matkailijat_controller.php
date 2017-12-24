<?php

class MatkailijaKontrolleri extends BaseController {

    public static function matkalistaus() {
        $matkat = Matka::all();
        $maa = Maa::kaikkiMaat();
        View::make('suunnitelmat/matkalistaus.html', array('matkat' => $matkat, 'maa' => $maa));
    }

    public static function henkilolistaus() {
        $maa = Maa::kaikkiMaat();
        $henkilo = Henkilo::kaikkiHenkilot();
        View::make('suunnitelmat/henkilolistaus.html', array('henkilo' => $henkilo));
    }

    public static function muokkaahenkiloa($id) {
        $maa = Maa::kaikkiMaat();
        $henkilo = Henkilo::etsihenkilo($id);
//        View::make('suunnitelmat/muokkaahenkiloa.html', array('henkilo' => $henkilo));
        View::make('suunnitelmat/muokkaahenkiloa.html', array('henkilo' => $henkilo, 'maat' => $maa));
    }

    public static function muokkaamatkaa($id) {
        $maa = Maa::kaikkiMaat();
        $matka = Matka::etsimatka($id);
        View::make('suunnitelmat/muokkaamatkaa.html', array('matka' => $matka, 'maat' => $maa));
    }

    //****************************
    public static function paivitahenkilo($id) {
        $maa = Maa::kaikkiMaat();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
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
        );
        //luodaan uusi olio uusilla attribuuteilla
        $henkilo = new Henkilo($attributes);
//        $errors = $henkilo - errors();
        $etunimivirhe = $henkilo->validoi_etunimet();
        $sukunimivirhe = $henkilo->validoi_sukunimi();
        $syntymaaikavirhe = $henkilo->validoi_paivays();
//        $maavirhe=$Henkilo->validate_nationality();

        $errors = array_merge($etunimivirhe, $sukunimivirhe, $syntymaaikavirhe);

        if (count($errors) > 0) {
            $maa = Maa::kaikkiMaat();
            View::make('suunnitelmat/muokkaahenkiloa.html', array('errors' => $errors, 'attributes' => $attributes, 'maa' => $maa)); //, 'etunimivirhe'=>$etunimivirhe));
        } else {
            $maa = Maa::kaikkiMaat();
            $henkilo->paivitahenkilo($id);
//             $henkilo->tallennaHenkilo();
//            Redirect::to('suunnitelmat/henkilolistaus' . $henkilo->id, array('message' => 'henkilotietoja muokattiin onnistuneesti'));
            Redirect::to('/henkilolistaus', array('message' => 'henkilotietoja muokattiin onnistuneesti'));
        }
    }

    //****************************

    public static function hakusivu() {
        $params = $_POST;
        View::make('suunnitelmat/hakusivu.html');
    }

    //********************************
    public static function etusivu() {
        $etusivu = Etusivu::etusivu();
        View::make('suunnitelmat/etusivu.html');
        $matka = Etusivu::ketkaovatmatkallanyt();
        $maa = Maa::kaikkiMaat();
        $matkat = Matka::all();
        View::make('suunnitelmat/etusivu.html', array('matka' => $matka, 'maa' => $maa));
        
    }

    public static function HaeMatka() {
        $maa = Maa::kaikkiMaat();
        $haematka = HaeMatka::HaeMatka();
        View::make('suunnitelmat/haematka.html', array('maat' => $maa));
    }

    public static function haeYksiMatka($id) {
        $maa = Maa::kaikkiMaat();
        $matka = HaeMatka::haeYksiMatka($id);
        View::make('suunnitelmat/muokkaamatkaa.html', array('maat' => $maa, 'matka' => $matka));
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
        $params = $_POST; // Henkilo-id tulee lomakkeen tietojen mukana
        Kint::dump($params);
        $matka = new Matka(array('id' =>$params['id'],
            'hid' =>$params['hid'],
            'country' => $params['country'],
            'arrivaldate' => $params['arrivaldate'],
            'departuredate' => $params['departuredate'],
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
            View::make('suunnitelmat/matka.html', array('errors' => $errors, 'maat' => $maa)); //, 'etunimivirhe'=>$etunimivirhe));
        } else {
        
          
                $matka->tallennaUusiMatka();
                $matkaid =(int)$matka->id;
               $henkiloid =(int)$matka->hid ;
         
                $valitaulu = new Matka(array(
                    'matkaid' =>$matkaid,
                    'henkiloid'=>$henkiloid));
                $valitaulu ->tallennaMatkaValitauluun($matkaid,$henkiloid);

            Redirect::to('/matkalistaus', array('message' => 'Matka lisättiin matkatietokantaan '));
        }




        //ohjataan käyttäjä matkalistaukselle
        // Redirect::to('/suunnitelmat/matkalistaus.html' . $matka->id, array('message' => 'Matka lisättiin matkatietokantaan'));
//        Redirect::to('/matkalistaus');
    }

    //validointifunktiot
    public static function tallennaHenkilo() {
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
            View::make('suunnitelmat/henkilo.html', array('errors' => $errors, 'maat' => $maa)); // 'attributes' =>$attributes)); //, 'etunimivirhe'=>$etunimivirhe));
        } else {
            $henkilo->tallennaHenkilo();
            Redirect::to('/henkilolistaus');
        }
    }


    public static function paivitamatka($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'country' => $params['country'],
            'arrivaldate' => $params['arrivaldate'],
            'departuredate' => $params['departuredate'],
            'address' => $params['address'],
            'postcode' => $params['postcode'],
            'city' => $params['city']
        );

        $matka = new Matka($attributes);
        //kutsutaan validaattorit
        $tuloaikavirhe = $matka->validoi_maahantulopaiva();
        $poistumisaikavirhe = $matka->validoi_maastapoistumispaiva();
        $matkankesto = $matka->validoi_matkankesto();

//        $errors = $matka->errors();
        $errors = array_merge($tuloaikavirhe, $poistumisaikavirhe, $matkankesto);
        if (count($errors) > 0) {
            View::make('suunnitelmat/muokkaamatkaa.html', array('errors' => $errors, 'matka' => $matka));
        } else {
//            Kint::dump($params);
            $matka->paivitamatka($id);
            Redirect::to('/matkalistaus', array('message' => 'Päivitys onnistui!')); //pisteestä pilkuksi
        }
    }

    
        public static function ketkaovatmatkallanyt() {
        $matka = Matka::ketkaovatmatkallanyt();
        $maa = Maa::kaikkiMaat();
        $matkat = Matka::all();
        View::make('suunnitelmat/matkallanyt.html', array('matka' => $matka, 'maa' => $maa));
    }
    
    
    public static function poistaMatka($id) {
        $matka = new Matka(array('id' => $id));
        $matka->poistaMatka();

        Redirect::to('/matkalistaus', array('message' => 'Matkan poistaminen onnistui!'));
    }

    public static function poistaHenkilo($id) {
        $henkilo = new Henkilo(array('id' => $id));
        $henkilo->poistaHenkiloJaHanenMatkat($id);      
        $henkilo = new Henkilo(array('id' => $id));
        $henkilo->poistaHenkilo($id);
        Redirect::to('/henkilolistaus');
    }

}
