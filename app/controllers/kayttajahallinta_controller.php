<?php

class Kayttajahallinta extends BaseController {

    //tuodaan kirjautumissivu näkyviin
    public static function kirjaudu() {
        View::make('suunnitelmat/kirjaudu.html');
    }

    //kirjautumienen siinä tapauksessa, että käyttäjällä on jo tunnukset
    public static function kasittele_kirjautuminen() {
        $params = $_POST; // tuodaan lomakkeen tiedot
        //tarkistetaan, onko kenttiin syötetty riittävän pitkät syötteet
        $henkilo = new Henkilo(array(
            'username' => $params['username'],
            'password' => $params['password'],
        ));
        //kutsutaan validaattoreita
        $kayttajatunnusvirhe=$henkilo->validoi_kayttajatunnus();
        $salasanavirhe = $henkilo->validoi_salasana();
        //Luodaan validaattoreiden virheilmoituksista lista
        $errors = array_merge($kayttajatunnusvirhe, $salasanavirhe);
        if (count($errors) > 0) {
             View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors)); //, 'etunimivirhe'=>$etunimivirhe));
        }
        
        //Mikäli virheitä ei ollut, niin jatketaaan tietokantaoperaatioihin
        $henkilo = Kirjaudu::Kirjaudu($params['username'], $params['password']);
        if (!$henkilo) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else if (!$henkilo->administrator) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['henkilo'] = $henkilo->id;
            Redirect::to('/henkilo', array('message' => 'Tervetuloa takaisin ' . $henkilo->username . '!'));
        }
    }

    //kirjautuminen siinä tapauksessa, ettei käyttäjällä vielä ole tunnuksia
    public static function luouusikayttaja() {
        View::make('suunnitelmat/luouusikayttaja.html');
        $params = $_POST;
        $kirjaudu = Kirjaudu::Luokayttaja();
        $kirjautumisvirhe = $kirjaudu->validoi_salasanat();
        $errors = array_merge($kirjautumisvirhe);
        if (count($errors) > 0) {
            View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors));
        } else {
            $errors = 'Kirjautuminen onnistui!';
            View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors));
        }
    }

    //public function 
}
