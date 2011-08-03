<?php

class Bdd {
    
    private $host;
    private $user;
    private $mdp;
    private $db;
    
    private $PdoInstance = null;
    private static $instance = null;
    
    
    private function __construct() {
        
        $this->host = 'db3070.1and1.fr';
        $this->user = 'dbo358667924';
        $this->mdp = 'cactus4512';
        $this->db = 'db358667924';
        
        $this->PdoInstance = new PDO('mysql:host='.$this->host.';dbname='.$this->db, $this->user, $this->mdp);
    }
    
    public static function getInstance() {
        
        if(is_null(self::$instance)) {
            
            self::$instance = new Bdd();
        }
        
        return self::$instance;
    }

    public function query($query) {
        
        return $this->PdoInstance->query($query);
    }

    public function exec($query) {
        
        return $this->PdoInstance->exec($query);
    }
    
    public function lastInsertId($query) {
        
        $this->PdoInstance->query($query);
        
        return $this->PdoInstance->lastInsertId();
    }
}
