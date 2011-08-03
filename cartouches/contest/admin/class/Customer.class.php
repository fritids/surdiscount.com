<?php

require('Model.class.php');

class Customer extends Model {
    
    protected $id_contest_customer;  
    protected $lastname;
    protected $firstname;
    protected $email;
    protected $adress;
    protected $zip_code;
    protected $city;
    protected $phone;
    protected $year_of_birth;
    protected $newsletter;
    protected $sex;
    
    public function __construct($id = null) {

        parent::__construct($id);
        $this->table = 'contest_customer';
    }
}