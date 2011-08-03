<?php

require('class/Cartridge.class.php');

$dbh = Bdd::getInstance();
$cartridge = new Cartridge();
$menuItemId = $cartridge->getChildren(102);

if(isset($_POST['nameCartridge']) && $_POST['nameCartridge'] != "") {
    
    $userQuery = $_POST['nameCartridge'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title></title>
       <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" />
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   </head>
   <body>
        <div id="container-main">
            <div id="container-top">
                
                <?php
                    
                    $query = 'SHOW COLUMNS FROM presta_product LIKE "condition"';
                    $result = $dbh->query($query);
                    $result = $result->fetchAll(PDO::FETCH_ASSOC);
                    
                    $tmp = $result[0]['Type'];
                    $tmp = substr($tmp, 5, -1);
                    
                    $tmp = str_replace('\'', '', $tmp);
                    $conditions = explode(',', $tmp);
                
                    foreach($conditions as $condition => $i) {
                        
                        if(!isset($_GET['id_category'])) {
                            
                            echo '<a href="?type='.$i.'">'.$i.'</a>';
                        }
                        else {
                            
                            $idCat = $_GET['id_category'];
                            
                            echo '<a href="?id_category='.$idCat.'&type='.$i.'">'.$i.'</a>';
                        }
                        
                        echo '<br />';
                    }
                
                ?>
                
                <form id="userQuery" action="" method="post">
                    Rechercher une cartouche (par imprimante) : <input type="text" name="nameCartridge" />
                    <input type="submit" name="send" />
                </form>
                
            </div>
            
            <div id="container-left">
                <?
                
                foreach($menuItemId as $item => $i) {
                    
                    $query = 'SELECT name FROM presta_category_lang WHERE id_category = '. $i;
                    $result = $dbh->query($query);
                    $nameCartidge = $result->fetchAll(PDO::FETCH_COLUMN, 0);
                    
                    if(!isset($_GET['type'])) {
                        
                        echo '<a href="?id_category='. $i .'">'. $nameCartidge[0] .'</a>';
                        echo '<br />';
                    }
                    else {
                        
                        $type = $_GET['type'];
                        echo '<a href="?type='.$type.'&id_category='. $i .'">'. $nameCartidge[0] .'</a>';
                        echo '<br />';
                    }

                }
                ?>
            </div>
            
            <div id="container-middle">
                <?php
                
                    if(isset($_GET['id_category'])) {
                        
                        $idCat = intval($_GET['id_category']);
                        $tags = $cartridge->getTagFromCategoryId($idCat);
                        sort($tags);
                        //print_r($tags);
                                          
                        foreach($tags as $tag => $i) {
                            
                            echo '<a href="?id_category='. $idCat .'&id_tag='. urlencode($i) .'">'. $i .'</a>';
                            echo '<br />';
                        }
                    }
                ?>
            </div>
            
            <div id ="container-right">
                <?php
                
                    if(!isset($userQuery)) {
                        
                        if(isset($_GET['id_category']) && isset($_GET['id_tag'])) {
                            
                            $idTag = $_GET['id_tag'];
                            $products = $cartridge->getProductsFromTag($idTag);
                                             
                            foreach($products as $product => $i) {
                                
                                echo $i['id_product'];
                                echo '<br />';
                            }
                        }
                        else if(isset($_GET['id_category']) && !isset($_GET['id_tag'])) {
                            
                            $idCat = $_GET['id_category'];
                            $products = $cartridge->getProductsFromCategoryId($idCat);
    
                            foreach($products as $product => $i) {
                                
                                echo $i['name'];
                                echo '<br />';
                            }
                        }
                    }
                    else {
                        
                        $products = $cartridge->getProductsFromUserQuery($userQuery);

                        foreach($products as $product => $i) {
                            
                            echo $i['name'];
                            echo '<br />';
                        }
                    }
                ?>
            </div>
            
            <div id="bottom">
                
                <?php
                
                    $idCat = array();
                
                    if(isset($_GET['id_category'])) {
                        
                        $idCat[] = $_GET['id_category'];
                        
                        $bestSales = $cartridge->getBestSalesFromCategoryId($idCat);
                    }
                    else {
                        
                        $idCat = $menuItemId;
                        
                        $bestSales = $cartridge->getBestSalesFromCategoryId($idCat);
                        
                        foreach($bestSales as $bestSale) {
                            
                            $bestSale = (Object)$bestSale;
                            
                            //echo $bestSale['id_product'].' : '.$bestSale['name'] .' vendu : '. $bestSale['quantity']. ' fois <br />';
                            echo $bestSale->id_product.' : '.$bestSale->name .' vendu : '. $bestSale->quantity. ' fois <br />';
                        }
                    }                
                ?>

            </div>
            
        </div>
   </body>
</html>