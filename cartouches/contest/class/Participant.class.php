<?php

class Participant extends Model {
    
    protected $id_contest;
    protected $id_customer;
    protected $date_added;
    
    public function __construct($id = null) {
        
        $this->table = 'contest_participants';
        
        parent::__construct($id);
    }
}

?>