<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
         View::make('suunnitelmat/mainPage.html');
//        echo 'Tämä on etusivun tekele numero neljä :)!';
    }

    public static function maat() {
        View::make('suunnitelmat/maat.html');
    }

    public static function henkilo() {
        View::make('suunnitelmat/henkilo.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

        public static function matka() {
        View::make('suunnitelmat/matka.html');
    }
    
            public static function matkalistaus() {
        View::make('suunnitelmat/matkalistaus.html');
    }
    
    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }

}
