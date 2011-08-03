<?php

require('Model.class.php');

class Contest extends Model {
    
    protected $id_contest = null;
    protected $date_start = null;
    protected $date_end = null;
    protected $picture = null;
    
    public function __construct($id = null) {
        
        parent::__construct($id);
        $this->table = 'contest';
    }
    
    public function save($datas, $id = null) {
        
        if(!$id) {
            
            $contentDir = 'views/contest/upload/';
            $tmpFile = $datas['picture']['tmp_name'];
            
            if(!is_uploaded_file($tmpFile)) {
                
                exit('Le fichier est introuvable');
            }
            
            $nameFile = '1-'.$_FILES['picture']['name'];
            
            if(!move_uploaded_file($tmpFile, $contentDir.$nameFile)) {
                
                exit('Impossible de copier le ficher dans : '. $contentDir);
            }
            
            $datas['picture'] = 'upload/'.$nameFile;
        
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
            
            echo 'Faire un update : contest.class.php';
        }
    }

}

?>