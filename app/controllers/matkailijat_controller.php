<?php

class MatkailijaKontrolleri extends BaseController{
    
    
    public static function index(){
        $maat = Maa::all();
        View::make('suunnitelmat/matka.html', array('maa'=>$maat));
        
        
    }
}

