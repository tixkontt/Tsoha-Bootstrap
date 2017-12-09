<?php

class Kayttajahallinta extends BaseController {

    
    //tuodaan kirjautumissivu näkyviin
    public static function kirjaudu() {
        View::make('suunnitelmat/kirjaudu.html');
    }

    //kirjautumienen siinä tapauksessa, että käyttäjällä on jo tunnukset
    public static function kasittele_kirjautuminen() {
        $params = $_POST;

        $kayttaja = Kirjaudu::Kirjaudu($params['username'], $params['password']);

        if (!$kayttaja) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else if (!$kayttaja->administrator) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['henkilo'] = $kayttaja->id;
            Redirect::to('/henkilo', array('message' => 'Tervetuloa takaisin ' . $kayttaja->username . '!'));
        }
    }
    //kirjautuminen siinä tapauksessa, ettei käyttäjällä vielä ole tunnuksia
    public static function luouusikayttaja() {
        View::make('suunnitelmat/luouusikayttaja.html');
//        $params = $_POST;
//        $kirjaudu = Kirjaudu::Luokayttaja();
//        $kirjautumisvirhe = $kirjaudu->validoi_salasanat();
//        $errors = array_merge($kirjautumisvirhe);
//        if (count($errors) > 0) {
//            View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors));
//        } else {
//            $errors = 'Kirjautuminen onnistui!';
//            View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors));
//        }
    }

    //public function 
}
