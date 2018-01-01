<?php

class MatkailijaKontrolleri extends BaseController {

    public static function matkalistaus() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $matkat = Matka::all();
            $maa = Maa::kaikkiMaat();
            View::make('suunnitelmat/matkalistaus.html', array('matkat' => $matkat, 'maa' => $maa));
        }
    }

    public static function HaeMatkatYhdestaMaasta() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

            $maa = Maa::kaikkiMaat();
            $matka = HaeMatka::HaeMatkatYhdestaMaasta();
            Kint::dump($matka);
        }
    }

    public static function henkilolistaus() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $maa = Maa::kaikkiMaat();
            $henkilo = Henkilo::kaikkiHenkilot();
            View::make('suunnitelmat/henkilolistaus.html', array('henkilo' => $henkilo));
        }
    }

    public static function muokkaahenkiloa($id) {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

            $maa = Maa::kaikkiMaat();
            $henkilo = Henkilo::etsihenkilo($id);
//        View::make('suunnitelmat/muokkaahenkiloa.html', array('henkilo' => $henkilo));
            View::make('suunnitelmat/muokkaahenkiloa.html', array('henkilo' => $henkilo, 'maat' => $maa));
        }
    }

    public static function muokkaamatkaa($id) {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

            $maa = Maa::kaikkiMaat();
            $matka = Matka::etsimatka($id);
            View::make('suunnitelmat/muokkaamatkaa.html', array('matka' => $matka, 'maat' => $maa));
        }
    }

    //****************************
    public static function paivitahenkilo($id) {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

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
                Redirect::to('/henkilolistaus', array('errors' => $errors, 'attributes' => $attributes, 'maa' => $maa)); //, 'etunimivirhe'=>$etunimivirhe));
            } else {
                $maa = Maa::kaikkiMaat();
                $henkilo->paivitahenkilo($id);
//             $henkilo->tallennaHenkilo();
//            Redirect::to('suunnitelmat/henkilolistaus' . $henkilo->id, array('message' => 'henkilotietoja muokattiin onnistuneesti'));
                Redirect::to('/henkilolistaus', array('message' => 'henkilotietoja muokattiin onnistuneesti'));
            }
        }
    }

    //****************************

    public static function hakusivu() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $params = $_POST;
            $maa = Maa::kaikkiMaat();
            View::make('suunnitelmat/hakusivu.html', array('maat' => $maa));
        }
    }

    //********************************
    public static function etusivu() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $etusivu = Etusivu::etusivu();
            View::make('suunnitelmat/etusivu.html');
            $matka = Etusivu::ketkaovatmatkallanyt();
            $maa = Maa::kaikkiMaat();
            $matkat = Matka::all();
            View::make('suunnitelmat/etusivu.html', array('matka' => $matka, 'maa' => $maa));
        }
    }

    public static function HaeMatka() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $maa = Maa::kaikkiMaat();
            $haematka = HaeMatka::HaeMatka();
            View::make('suunnitelmat/haematka.html', array('maat' => $maa));
        }
    }

    public static function HaeMatkalaisetYhdestaMaasta() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {


            $params = $_POST;
            Kint::dump($params);
//        $country =>$params['country'];
            $matkalainen = new Matka(array(
                'country' => $params['country']
            ));


            $matkalaiset = Matka::ketkaovatnyttietyssamaassa($matkalainen);
//        Kint::dump($matkalaiset);
//        $maa = Maa::kaikkiMaat();
//        Kint::dump($matkalaiset);
//        Redirect::to('suunnitelmat/haematka.html', array('matkalaiset'=>$matkalaiset)); 
        }
    }

    public static function haeYhdenHenkilonMatkat($id) {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

            $matkalista = HaeMatka::HaeYhdenHenkilonMatkat($id);
            $matkamaara = count($matkalista);
            $maa = Maa::kaikkiMaat();
            View::make('suunnitelmat/henkilonmatkat.html', array('matkalista' => $matkalista, 'matkamaara' => $matkamaara));
        }
    }

    public static function haeYksiMatka($id) {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $maa = Maa::kaikkiMaat();
            $matka = HaeMatka::haeYksiMatka($id);
            View::make('suunnitelmat/muokkaamatkaa.html', array('maat' => $maa, 'matka' => $matka));
        }
    }

    public static function lisaaMatka() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $maa = Maa::kaikkiMaat();
            View::make('suunnitelmat/matka.html', array('maat' => $maa));
        }
    }

    public static function lisaaHenkilo() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {
            $maa = Maa::kaikkiMaat();
//        $administrator= Henkilo::etsiadmin();
            View::make('suunnitelmat/henkilo.html', array('maat' => $maa));
        }
    }

    public static function tallennaUusiMatka() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

            $params = $_POST; // Henkilo-id tulee lomakkeen tietojen mukana
            $matka = new Matka(array(//'id' =>$params['id'],
                'hid' => $params['hid'],
                'country' => $params['country'],
                'arrivaldate' => $params['arrivaldate'],
                'departuredate' => $params['departuredate'],
                'address' => $params['address'],
                'postcode' => $params['postcode'],
                'city' => $params['city']
            ));


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
                $matkaid = (int) $matka->id;
                $henkiloid = (int) $matka->hid;

                $valitaulu = new Matka(array(
                    'matkaid' => $matkaid,
                    'henkiloid' => $henkiloid));
                $valitaulu->tallennaMatkaValitauluun($matkaid, $henkiloid);

                Redirect::to('/matkalistaus', array('message' => 'Matka lisättiin matkatietokantaan '));
            }
        }
    }

    //validointifunktiot
    public static function tallennaHenkilo() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

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
                $_SESSION['henkilo'] = $henkilo->id; // Tässä lisätään assosiaatiolistaan kirjautuneen henkilön id.
                Redirect::to('/henkilolistaus');
            }
        }
    }

    public static function paivitamatka($id) {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

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
                $maa = Maa::kaikkiMaat();
                View::make('suunnitelmat/muokkaamatkaa.html', array('errors' => $errors, 'matka' => $matka, 'maat' => $maa));
            } else {
//            Kint::dump($params);
                $matka->paivitamatka($id);
                Redirect::to('/matkalistaus', array('message' => 'Päivitys onnistui!')); //pisteestä pilkuksi
            }
        }
    }

    public static function ketkaovatmatkallanyt() {
        $henkilo_id = self::haehenkilon_id();
        $user_logged_in = self::get_user_logged_in();
        if ($user_logged_in == NULL || $henkilo_id == NULL) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Et ole kirjautunut sisään!'));
        } else {

            $matka = Matka::ketkaovatmatkallanyt();
            $maa = Maa::kaikkiMaat();
            $matkat = Matka::all();
            View::make('suunnitelmat/matkallanyt.html', array('matka' => $matka, 'maa' => $maa));
        }
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
