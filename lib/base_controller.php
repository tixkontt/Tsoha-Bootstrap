<?php
  class BaseController{
    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
        // $_SESSION['henkilo'] = $henkilo->id;
        if(isset($_SESSION['henkilo'])){
            $henkilo_id=$_SESSION['henkilo'];
            
            //Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $henkilo= Henkilo::etsihenkilo($henkilo_id);
            
            return $henkilo;
            
        }
      return null;
    }
    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
            if(!isset($_SESSION['henkilo'])){
                Redirect::to('/kirjaudu', array('message'=> 'Kirjaudu sisään tai rekisteröidy!'));
            }
        
        
    }
    
    public static function haehenkilon_id(){
        if(isset($_SESSION['henkilo'])){
            $henkilo_id = $_SESSION['henkilo'];
            
            return $henkilo_id;
       
        }
        
        return NULL;
    }
  }