<?php

  class BaseController{

    public static function get_user_logged_in(){
      // Toteuta kirjautuneen käyttäjän haku tähän
        
        if(isset($_SESSION['administrator'])){
            $user_id=$_SESSION['administrator'];
            
            //Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $user_id=User::etsikayttaja($user_id);
            
            return $user;
            
        }
      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
            if(!isset($_SESSION['administrator'])){
                Redirect::to('/luouusikayttaja', array('message'=> 'Kirjaudu sisään tai rekisteröidy!'));
            }
        
        
    }

  }
