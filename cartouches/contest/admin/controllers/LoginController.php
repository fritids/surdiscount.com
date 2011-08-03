<?php

class LoginController extends Controller {
    
    private $password = 'edwinn29';
    
    public function __construct() {
        
        $this->nameClass = 'LoginController';
        parent::__construct(); 
    }
    
    public function index() {
        
        $vars = array();
        if($_SESSION['admin'] == true) {
            
            $this->load('admin', 'php');
        }
        else {
            
            $this->load('login', 'php', $vars);
        }
    }
    
    public function checkLogin() {
        
        if(isset($_POST['password'])) {
            
            if($_POST['password'] == $this->password) {
                
                $_SESSION['admin'] = true;
                
                echo '<script>window.location.replace("index.php");</script>';
                $this->load('admin', 'php');
            }
            else {
                
                echo 'Mot de passe invalide';
                //$this->load('login', 'php');
            }
        }
    }
}

?>