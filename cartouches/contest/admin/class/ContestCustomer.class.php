<?php

class ContestCustomer {
    
    private $id = null;
    private $lastname = null;
    private $firstname = null;
    private $email = null;
    private $adress = null;
    private $zip_code = null;
    private $city = null;
    private $phone = null;
    private $year_of_birth = null;
    private $newsletter = null;
    private $sex = null;
    
    
    public function __construct($id = null) {
        
        if($id != null) {
            
            $this->id = $id;
            
            $sql = 'SELECT * FROM contest_customers WHERE id = '.$id; 
            $data = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_ASSOC);
            
            print_r($data);
            
            foreach($this as $i => $attr) {
                
                $this->$i = $data[$i];                
            }
        }
    }
    
    
    public function save($datas, $id = null) {
        
        if(!$id) {
            
            foreach($datas as $i => $data) {
                
                if(property_exists($this, $i)) {
                
                    $columns .= $i.', ';
                    $values .= '"' .$data. '", ';
                }
            }
            
            $columns = substr($columns, 0, -2); 
            $values = substr($values, 0, -2);
    
            $query = 'INSERT INTO contest_customers ('.$columns.') VALUES ('.$values. ')';
        
            return Bdd::getInstance()->query($query);
        }
    }
    
    public function count($key, $datas) {
        
        if(!is_array($key) && !is_array($datas)) {
            
            $query = 'SELECT COUNT('.$key.') FROM contest_customers WHERE '. $key . ' = "'. $datas . '"';
        }
        elseif(is_array($key) && is_array($datas)) {
            
            //
        }
        else {
            
            echo 'Erreur ligne : ' . __LINE__ . 'dans le fichier : ' . __FILE__;
        }
        
        return Bdd::getInstance()->query($query)->fetchColumn();
    }
}

?>