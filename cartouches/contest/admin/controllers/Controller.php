<?php

class Controller {
    
    private $vars = null;
    protected $pathView = 'views/';
    protected $nameClass = null;
    protected $controller = null;
    
    public function __construct() {
    
        if(isset($_GET['a']) && $_GET['a'] != '') {

            if(method_exists($this->nameClass, $_GET['a'])) {
                
                $method = $_GET['a'];
                $this->$method();
            }
        }
        else {
            
            $this->index();
        }
    }
    
    public function load($nameView, $ext, $vars = null) {
        
        include($this->pathView.$nameView.'.'.$ext);
    }
    
    
    public function add() {
        
        if(empty($_POST)) {
            
            $this->load('add', 'php');
        }
        else {
            
            if($this->model->save($_POST)) {
                
                $this->liste();
                echo '<script>alert("Concours enregistré");</script>';
            }
            else {
                
                $this->liste();
                echo '<script>alert("Erreur...");</script>';
            }
        }
    }
    
    public function edit() {
        
        $id = $_GET['id'];
        
        if(empty($_POST)) {
            
            if(!empty($id)) {
                
                $result = $this->model->findById($id);
                $this->load('edit', 'php', $result);
            }
            else {
                
                $this->load('add', 'php');
            }
        }
        else {
            
            if($this->model->save($_POST, $id)) {
                
                $this->liste();
                echo '<script>alert("Le concours '. $id .' a bien été mis à jour");</script>';
            }
        }
    }
    
    public function delete() {
        
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            
            if($this->model->delete($_GET['id'])) {
                
                //$this->liste();
                echo '<script>alert("Concours '. $_GET['id'] .' supprimé");</script>';
                $this->redirect('?p='.$this->controller);
                
            }
            else {
                
                //$this->liste();
                echo '<script>alert("Erreur lors de la suppresion du concours '. $_GET['id'] .'");</script>';
                $this->redirect('?p='.$this->controller);
                
            }
        }
    }
    
    public function redirect($url) {
        
        echo '<script>window.location.replace("'. $url .'");</script>';
    }
}

?>