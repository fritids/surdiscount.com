<?php

require_once('class/Participant.class.php');

class ParticipantsController extends Controller {
    
    protected $model;
    
    public function __construct($id = null) {
        
        $this->model = new Participant();
        
        $this->nameClass = 'ParticipantsController';
        $this->pathView = 'views/participant/';
        parent::__construct();
    }
    
    public function index() {
        
        $this->liste();
    }
    
    public function liste() {
        
        $result = $this->model->liste();
        $this->load('list', 'php', $result);
    }
    
    public function add() {
        
        if(empty($_POST)) {
            
            $this->load('add', 'php');
        }
        else {
            
            $data['id_contest'] = $_POST['id_contest'];
            $data['id_customer'] = $_POST['id_customer'];
            
            if(!$this->model->find($data)) {
                
                if($this->model->save($_POST)) {
                    
                    $this->liste();
                    echo '<script>alert("Participant enregistré");</script>';
                }
                else {
                    
                    $this->liste();
                    echo '<script>alert("Erreur...");</script>';
                }
            }
            else {
                
                $this->liste();
                echo '<script>alert("L\'utilisateur participe déjà au concours");</script>';
            }
        }
    }
}