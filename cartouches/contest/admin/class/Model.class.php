<?php

class Model {
    
    protected $table;
    
    public function __construct($id = null) {
        
        if($id != null) {
            
            $this->id = $id;
            
            $sql = 'SELECT * FROM '. $this->table .' WHERE id = '.$id; 
            $data = Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_ASSOC);
            
            foreach($this as $attr => $i) {
                
                $this->$attr = $data[$attr];                
            }
        }
        else {
            
            foreach($this as $i => $attr) {
                
                $this->$i = null;
            }
        }
    }

    public function findById($id) {

        $sql = 'SELECT * FROM '. $this->table .' WHERE id_'. $this->table .' = '. $id;
        
        return Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_ASSOC);
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
    
            $query = 'INSERT INTO '. $this->table .' ('.$columns.') VALUES ('.$values. ')';
        
            return Bdd::getInstance()->exec($query);
        }
        
        else {
            
            $query = 'UPDATE '. $this->table .' SET ';
            
            foreach($datas as $i => $data) {
                
                if(property_exists($this, $i)) {
                    
                    $query .= $i . '= "' . $data.'",';
                }
            }
            
            $query = $query = substr($query, 0, -1); 
            $query .= ' WHERE id_'. $this->table .' = '. $id;
            
            return Bdd::getInstance()->exec($query);
        }
        
        return 0;
    }
    
    public function delete($id) {
        
        $query = 'DELETE FROM '. $this->table .' WHERE id_'. $this->table .' = '. $id;
        
        return Bdd::getInstance()->exec($query);
    }
    
    public function liste($datas = null) {
            
        $query = 'SELECT * FROM '. $this->table;
        
        return Bdd::getInstance()->query($query)->fetchAll();
    }
    
    public function find($datas) {
        
        $query = 'SELECT * FROM '. $this->table .' WHERE ';
        
        foreach($datas as $i => $data) {
            
            $query .= $i . ' = ' . $data . ' AND ';
        }
        
        $query = substr($query, 0, -4);
    
        return Bdd::getInstance()->query($query)->fetchAll();
    }
}








/*
 <?php

class Model {
    
    protected $table;
    
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

    public function findById($id) {

        $sql = 'SELECT * FROM contest WHERE id_contest = '. $id;
        
        return Bdd::getInstance()->query($sql)->fetch(PDO::FETCH_ASSOC);
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
    
            $query = 'INSERT INTO contest ('.$columns.') VALUES ('.$values. ')';
        
            return Bdd::getInstance()->exec($query);
        }
        
        else {
            
            $query = 'UPDATE contest SET ';
            
            foreach($datas as $i => $data) {
                
                if(property_exists($this, $i)) {
                    
                    $query .= $i . '= "' . $data.'",';
                }
            }
            
            $query = $query = substr($query, 0, -1); 
            $query .= ' WHERE id_contest = '. $id;
            
            return Bdd::getInstance()->exec($query);
        }
        
        return 0;
    }
    
    public function delete($id) {
        
        $query = 'DELETE FROM contest WHERE id_contest = '. $id;
        
        return Bdd::getInstance()->exec($query);
    }
    
    public function liste() {
        
        $query = 'SELECT * FROM contest';
        
        return Bdd::getInstance()->query($query)->fetchAll();
    }
}
 */
