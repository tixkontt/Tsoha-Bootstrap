<?php

class Kayttajahallinta extends BaseController {

    public static function kirjaudu() {
        $params = $_POST;

        $user = Kirjaudu::authenticate($params['username'], $params['password']);


        if (!$user) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin' . $user->name . '!'));
        }
    }

}
