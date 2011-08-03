<?php


require_once('admin/class/Bdd.class.php');

$sql = 'SELECT * FROM contest ORDER BY id_contest DESC LIMIT 0,1';
$lastContest = Bdd::getInstance()->query($sql)->fetch();

$dateNow = date('Y-m-d G:i:s');

?>

<html>
    <head>
        <title>Inscription jeux / concours</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="design.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script src="js/jquery.validate.js"></script>
        <script src="js/frontend.js"></script>
    </head>
    
    <?php echo '<body style="background: url(admin/views/contest/'.$lastContest['picture'].')";>' ?>
    
        <?php
        
            if(!isset($_GET['p'])) {
                
                include('views/play.html');
            }
        
            if(isset($_GET['p']) && $_GET['p'] == 'game') {
                
                if($dateNow < $lastContest['date_end']) {
                    
                    include('views/game.html');
                }
               
                else {
                    
                    echo 'Pas de jeux / concours en ce moment';
                }
            }
            
            if(isset($_GET['c'])) {
                
                include('controllers/'.$_GET['c'].'.php');
            }
        ?>
    </body>
</html>