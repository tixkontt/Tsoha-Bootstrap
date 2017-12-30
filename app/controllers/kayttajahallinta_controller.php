<?php

class Kayttajahallinta extends BaseController {

    //tuodaan kirjautumissivu näkyviin
    public static function kirjaudu() {
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function kirjaudu_ulos() {
        $_SESSION['henkilo'] = NULL;
        View::make('suunnitelmat/kirjaudu.html', array('message' => 'Olet kirjautunut ulos'));
    }

    //kirjautumienen siinä tapauksessa, että käyttäjällä on jo tunnukset

    public static function kasittele_kirjautuminen() {
        $params = $_POST; // tuodaan lomakkeen tiedot
        $henkilo = new Henkilo(array(
//            'id' =>$params['id'],
            'username' => $params['username'],
            'password' => $params['password'],
        ));
        //kutsutaan validaattoreita
        $kayttajatunnusvirhe = $henkilo->validoi_kayttajatunnus();
        $salasanavirhe = $henkilo->validoi_salasana();
        //Luodaan validaattoreiden virheilmoituksista lista
        $errors = array_merge($kayttajatunnusvirhe, $salasanavirhe);
        if (count($errors) > 0) {
            View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors)); //, 'etunimivirhe'=>$etunimivirhe));
        }
        //Mikäli virheitä ei ollut, niin jatketaaan tietokantaoperaatioihin

        $henkilo = Kirjaudu::Kirjaudu($params['username'], $params['password']);
        if (!$henkilo) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Käyttäjää ei ole tietokannassa'));
        } else if (!$henkilo->administrator) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['henkilo'] = $henkilo->id; // Tässä lisätään assosiaatiolistaan kirjautuneen henkilön id.
            Redirect::to('/matkallanyt', array('message' => 'Tervetuloa takaisin ' . $henkilo->username . '!'));
        }
    }

    //tuodaan kirjautumissivu näkyviin
    public static function luouusikayttajalomake() {
        View::make('suunnitelmat/luouusikayttaja.html');
    }

    //kirjautuminen siinä tapauksessa, ettei käyttäjällä vielä ole tunnuksia
    public static function luouusikayttaja() {
        $params = $_POST; // tuodaan lomakkeen tiedot
//        View::make('suunnitelmat/luouusikayttaja.html');
        $henkilo = new Henkilo(array(
//            'id' =>$params['id'],
            'username' => $params['username'],
            'password' => $params['password'],
            'password2' => $params['password2']
        ));
        //kutsutaan validaattoreita
//        $kayttajatunnusvirhe = $henkilo->validoi_kayttajatunnus();
//        $salasanavirhe = $henkilo->validoi_salasana();
        $kayttajatunnusvirhe = $henkilo->validoi_kayttajatunnus();
        $kirjautumisvirhe = $henkilo->validoi_salasanat();
        $errors = array_merge($kayttajatunnusvirhe, $kirjautumisvirhe);
        if (count($errors) > 0) {
            View::make('suunnitelmat/luouusikayttaja.html', array('errors' => $errors));
        } else {
            //Mikäli virheitä ei ollut, niin jatketaaan tietokantaoperaatioihin
            $attributes = array(
                'username' => $params['username'],
                'password' => $params['password']
            );

            if (Kirjaudu::tsekkaausername($params['username']) != NULL) {
                View::make('suunnitelmat/luouusikayttaja.html', array('error' => 'Käyttäjätunnus on jo käytössä!'));
            }
            else{
            $maa = Maa::kaikkiMaat();
            $message = 'Täydennä tiedot!';
//            Kint::dump($attributes);
            View::make('suunnitelmat/taydennahenkilotiedot.html', array('errors' => $errors, 'attributes' => $attributes, 'maat' => $maa));


            tallennaUusiKayttaja($username, $password);
            View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors));
        }
        }
            
    }

    public static function tallennaUusiKayttaja($henkilo) {
        //lisätään returning id tietokantakyselyn loppuun, niin saadaan se talteen
        $query = DB::connection()->prepare('INSERT INTO henkilo (username, password, administrator) VALUES (:username, :password, :administrator) RETURNING id ');
        $query->execute(array(
            'username' => $this->username,
            'password' => $this->password,
//            'administrator' => $this->administrator));
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
