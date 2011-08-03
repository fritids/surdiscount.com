<?php

class Contest {
    
    private $id = null;
    private $lastname = null;
    private $firstname = null;
    private $email = null;
    private $adress = null;
    private $adress_bis = null;
    private $zip_code = null;
    private $city = null;
    private $phone = null;
    private $year_of_birth = null;
    private $newsletter = null;
    private $sex = null;
    
    
    public function __construct($id = null) {
        
        if($id != null) {
            
            $this->id = $id;
            
            $sql = 'SELECT * FROM contest WHERE id = '.$id; 
            $data = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_ASSOC);
            
            print_r($data);
            
            foreach($this as $attr => $i) {
                
                $this->$attr = $data[$attr];                
            }
        }
    }
}

?>