<?php

//require 'app/models/Paaohjelma.php';
require 'app/models/hello_world.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('suunnitelmat/index.html');
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
//
//        $Suomi = maa::find(1);
//        $maa = country::all();
//        // Kint-luokan dump-metodi tulostaa muuttujan arvon
//        Kint::dump($Suomi);
//        Kint::dump($maa);
        
//      
        $henkilo = new Henkilo(array(
            'firstnames' => 'ti',
            'familyname' => 'kop',
            'dateofbirth'=> '1.1.1',
            'nationality' => '--valitse--'
                   
        ));
        Kint::dump($errors);
        

}
        
        }


        // Muista sisällyttää malliluokka require-komennolla!
        //  $maa= Game::find(1);
//        $maa = Maa::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
//    Kint::dump($games);
//        Kint::dump($maa);
    
        

//}
