
<?php
class Kirjaudu extends BaseModel {

//attribuutit
    public $email, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    

}
