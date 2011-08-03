<?php

session_start();

require_once('class/Bdd.class.php');
require_once('controllers/Controller.php');

$password = 'edwinn29';

print_r($_SESSION);

?>

<html>
    <head>
        <title>Inscription jeux / concours</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="design.css" />
        <link rel="stylesheet" href="jquery-ui-1.8.14.custom.css" />
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src="js/jquery-ui-1.8.14.custom.min.js"></script>
        <script src="js/jquery-ui-timepicker-addon.js"></script>
        <script src="js/backend.js"></script>

    </head>
    <body>
        <?php
            
            if(isset($_GET['p']) && $_GET['p'] != '' && $_SESSION['admin'] == true) {
                
                if(is_file($_GET['p'].'.php')) {
                    
                    include($_GET['p'].'.php');
                }
                else {
                    
                    echo 'Controller inexistant. Vérifier que '. $_GET['p'].'.php existe à la racine de admin';
                }
            }
            else {
                
                include('login.php');
            }
        
        ?>
    </body>
</html>