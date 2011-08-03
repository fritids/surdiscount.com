<?php

require_once('class/Contest.class.php');

class ContestController extends Controller {
    
    private $model;
    
    public function __construct() {
        
        $this->model = new Contest();
        
        $this->nameClass = 'ContestController';
        $this->pathView = 'views/contest/';
        parent::__construct();
    }
    
    public function index() {
        
        $this->liste();
    }
    
    public function liste() {
        
        $result = $this->model->liste();
        $this->load('list', 'php', $result);
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
    
    public function add() {
        
        if(empty($_POST)) {
            
            $this->load('add', 'php');
        }
        else {
            
            if(isset($_FILES) && !empty($_FILES)) {
                
                $datas = array_merge($_POST, $_FILES);
            }
            else {

                $datas = $_POST;
            }

            if($this->model->save($datas)) { //faire l'upload d'image
                
                $this->liste();
                echo '<script>alert("Concours enregistré");</script>';
            }
           else {
                
                $this->liste();
                echo '<script>alert("Erreur...");</script>';
            }
        }
    }
    
    public function delete() {
        
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            
            if($this->model->delete($_GET['id'])) {
                
                $this->liste();
                echo '<script>alert("Concours '. $_GET['id'] .' supprimé");</script>';
            }
            else {
                
                $this->liste();
                echo '<script>alert("Erreur lors de la suppresion du concours '. $_GET['id'] .'");</script>';
            }
        }
    }
}

?>