<?php

require_once('../admin/class/Bdd.class.php');
require_once('../class/ContestCustomer.class.php');


$contestCustomer = new ContestCustomer();

if(isset($_POST) && !empty($_POST)) {
    
    usleep(500000);
    
    foreach($_POST as $key => $value) {
        
        $array[$key] = trim($value);
    }
    
    if($array['newsletter'] == 'on') {
        
        $array['newsletter'] = 1;
    }
    else {
        
        $array['newsletter'] = 0;
    }
    
/*
    if(!$contestCustomer->count('email', $array['email'])) {
        
        if($contestCustomer->save($array)) {
            
            echo 'Merci d\'avoir participé à notre jeu concours';
        }
        else {
            
            echo 'Une erreur s\'est produite, veuillez réessayer';
        }
    }
    else {
        
        echo 'Une erreur s\'est produite, votre email existe déjà';
    }
*/

    $contestCustomer->save2($array);
}

?>

