
<?php
class Kirjaudu extends BaseModel {

//attribuutit
    public $kirjaudu,$email, $password, $password2;
 
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function kirjaudu() {
        echo 'hep';
    }

}
