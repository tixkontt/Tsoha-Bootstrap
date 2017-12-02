<?php

class Kayttajahallinta extends BaseController {
    
     public static function kirjaudu() {
//        $kirjaudu = Kirjaudu::kirjaudu();
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function kasittele_kirjautuminen() {
        $params = $_POST;

        $user = Kirjaudu::authenticate($params['username'], $params['password']);


        if (!$user) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->username;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
        }
    }
    
   //public function 

}
