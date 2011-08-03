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
            
            $sql = 'SELECT * FROM contest_customer WHERE id = '.$id; 
            $data = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_ASSOC);
            
            print_r($data);
            
            foreach($this as $i => $attr) {
                
                $this->$i = $data[$i];                
            }
        }
    }
    
    
    public function save($datas, $id = null) {
        
        $query = 'SELECT * FROM contest_customer WHERE email = "'. $datas['email'] . '"';
        $customer = Bdd::getInstance()->query($query)->fetchColumn();
        
        print_r($customer);
        exit();
        
        $sql = 'SELECT * FROM contest ORDER BY id_contest DESC LIMIT 0,1';
        $lastIdContest = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_COLUMN, 1);
        
        if(!empty($customer)) { //L'émail existe déjà
            
            $query = 'SELECT * FROM contest_participant WHERE id_contest_participant = '.$customer['id_contest_customer'].')';
            
        }
        else {
            
            foreach($datas as $i => $data) {
                
                if(property_exists($this, $i)) {
                
                    $columns .= $i.', ';
                    $values .= '"' .$data. '", ';
                }
            }
            
            $columns = substr($columns, 0, -2); 
            $values = substr($values, 0, -2);
    
            $query = 'INSERT INTO contest_customer ('.$columns.') VALUES ('.$values. ')';
            $reponse = Bdd::getInstance()->exec($query);

            $sql = 'SELECT * FROM contest_customer';
            $lastIdCustomer = Bdd::getInstance()->lastInsertId($sql);
            
            return $this->saveParticipation($lastIdCustomer); 
        }
        
        //sql = 'SELECT * FROM contest_customer NATURAL JOIN contest_participant WHERE id_contest = '.$lastIdContest.' AND id_contest_customer = '.$idCustomer;
        
        if(!$id) {
            
            foreach($datas as $i => $data) {
                
                if(property_exists($this, $i)) {
                
                    $columns .= $i.', ';
                    $values .= '"' .$data. '", ';
                }
            }
            
            $columns = substr($columns, 0, -2); 
            $values = substr($values, 0, -2);
    
            $query = 'INSERT INTO contest_customer ('.$columns.') VALUES ('.$values. ')';
            $reponse = Bdd::getInstance()->exec($query);
            
            $sql = 'SELECT * FROM contest_customer';
            $lastIdCustomer = Bdd::getInstance()->lastInsertId($sql);
            
            return $this->saveParticipation($lastIdCustomer); 
        }
    }
    
    public function saveParticipation($lastIdCustomer) {
        
        $sql = 'SELECT * FROM contest ORDER BY id_contest DESC LIMIT 0,1';
        $lastIdContest = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_COLUMN, 1);
        
        $query = 'INSERT INTO contest_participant VALUES ("", "'. $lastIdContest .'", "'. $lastIdCustomer .'", "")';
        
        return Bdd::getInstance()->exec($query);
    }
    
    public function saveParticipation2($idCustomer) {
        
        $sql = 'SELECT * FROM contest ORDER BY id_contest DESC LIMIT 0,1';
        $lastIdContest = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_COLUMN, 1);
        
        $query = 'INSERT INTO contest_participant VALUES ("", "'. $lastIdContest .'", "'. $idCustomer .'", NOW())';
        
        return Bdd::getInstance()->exec($query);
    }
    
    public function count($key, $datas) {
        
        if(!is_array($key) && !is_array($datas)) {
            
            $query = 'SELECT COUNT('.$key.') FROM contest_customer WHERE '. $key . ' = "'. $datas . '"';

        }
        elseif(is_array($key) && is_array($datas)) {
            
            //
        }
        else {
            
            echo 'Erreur ligne : ' . __LINE__ . 'dans le fichier : ' . __FILE__;
        }
        
        return Bdd::getInstance()->query($query)->fetchColumn();
    }
    
    public function count2($key, $datas) {
        
        $query = 'SELECT COUNT('.$key.') FROM contest_customer WHERE '. $key . ' = "'. $datas . '"';
        $count = Bdd::getInstance()->query($query)->fetchColumn();
        
        return $count;
    }
    
    public function save2($datas) {
        
        $query = 'SELECT * FROM contest_customer WHERE email = "'. $datas['email'] . '"';
        $customer = Bdd::getInstance()->query($query)->fetchColumn();
        
        $sql = 'SELECT * FROM contest ORDER BY id_contest DESC LIMIT 0,1';
        $lastIdContest = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_COLUMN, 1);
        
        if(!$this->count2('email', $datas['email'])) { //email n'existe pas on l'ajoute dans customer
            
            foreach($datas as $i => $data) {
                
                if(property_exists($this, $i)) {
                
                    $columns .= $i.', ';
                    $values .= '"' .$data. '", ';
                }
            }
            
            $columns = substr($columns, 0, -2); 
            $values = substr($values, 0, -2);
    
            $query = 'INSERT INTO contest_customer ('.$columns.') VALUES ('.$values. ')';
            $reponse = Bdd::getInstance()->exec($query);
            
            $sql = 'SELECT * FROM contest_customer';
            $lastIdCustomer = Bdd::getInstance()->lastInsertId($sql);
            
            $sql = 'INSERT INTO contest_participant VALUES ("", "'. $lastIdContest .'", "'. $lastIdCustomer .'", NOW()) ';

            if(Bdd::getInstance()->exec($sql)) {
                
                echo 'Merci, votre inscription a bien été prise en compte !';
            }
            else {
                
                echo 'Erreur ligne : ' . __LINE__ . 'dans le fichier : ' . __FILE__;
            }
        }
        else {
            
            $sql = 'SELECT * FROM contest_participant NATURAL JOIN contest_customer WHERE id_contest_customer = '. $customer['id_contest_customer'] .' AND id_contest = '. $lastIdContest;
            $count = Bdd::getInstance()->query($sql)->fetch();
            
            if(empty($count)) { //l'email existe dans contest_customer mais il ne participe pas au dernier concours
                
                if($this->saveParticipation2($customer['id_contest_customer'])) {
                    
                    echo 'Merci, votre inscription a bien été prise en compte !';
                }
            }
            else {
                
                echo 'Vous participez déjà à ce concours !';
            }
        }
    }
}

?>