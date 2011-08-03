<?php

class Loader {
    
    private $pathView;
    
    public function __construct() {
        
        $pathView = './views/';
    }
    
    public function load($nameView, $ext) {
        
        include($pathView.$nameView.$ext);
    }
}

?>