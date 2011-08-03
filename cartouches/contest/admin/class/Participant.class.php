<?php

require('Model.class.php');

class Participant extends Model {
    
    protected $id_contest_participant;
    protected $id_contest;
    protected $id_customer;
    protected $date_added;
    
    public function __construct($id = null) {
        
        parent::__construct($id);
        $this->table = 'contest_participant';
    }
}

?>