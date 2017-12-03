<?php

class Kayttajahallinta extends BaseController {

    public static function kirjaudu() {
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function kasittele_kirjautuminen() {
        $params = $_POST;
        $administrator = Kirjaudu::Kirjaudu($params['username'], $params['password']);

        if (!$administrator) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'userame' => $params['username']));
        } else {
            $_SESSION['administrator'] = $administrator->administrator;
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $administrator->username . '!'));
        }
    }

    //public function 
}
