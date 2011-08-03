<?php

require_once('class/Customer.class.php');

class CustomerController extends Controller {
    
    protected $model;
    
    public function __construct($id = null) {
        
        $this->model = new Customer();
        
        $this->nameClass = 'CustomerController';
        $this->pathView = 'views/customer/';
        $this->controller = 'customer';
        parent::__construct();
    }
    
    public function index() {
        
        $this->liste();
    }
    
    public function liste() {
        
        $result = $this->model->liste();
        $this->load('list', 'php', $result);
    }
}

