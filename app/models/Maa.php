<?php

class Maa extends BaseModel {

//attribuutit
    public $id, $country;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function maat() {
        //tietokantayhteyden alustus
        $query = DB::connection()() -- > prepare('SELECT * From maa');
        // kyselyn suoritus
        $query ->execute();
        //haetaan rivit
        $rows = $query ->fetchAll();
        $maat = array();
        foreach($rows as $row){
            $maat[] = new maat(array(
                'country'=> $row ['Maa'])
            );
        }
        
  return $maat;      
        
    }
    
    public static function findOne($id){
    $query = DB::connection()->prepare('SELECT * FROM maa WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $maa = new Maa(array(
        'id' => $row['id'],
        'country' => $row['country']
      ));

      return $maa;
    }

    return null;
  }
        
  public static function taytaDropDown(){
      // Assume $db is a PDO object
$query = $db->query("SELECT country FROM maa"); // Run your query

echo '<select name="Maat:">'; // Open your drop down box

// Loop through the query results, outputing the options one by one
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
   echo '<option value="'.$row['country'].'">'.$row['Maa'].'</option>';
}

echo '</select>';// Close your drop down box
      
      
      
  }
        
        
        
    }

//}

/* COPY master FROM 'D:\demo.csv'  DELIMITER AS ',';
 * 
 * 
CREATE TABLE maa(
        id SERIAL PRIMARY KEY, 
        country varchar(50) NOT NULL
        );

 *  */