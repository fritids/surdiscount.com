<?php

/*********************************************************************************************************************
*   Tables utiles                                                                                                    *
*                                                                                                                    *
*   Category de départ 102                                                                                           *
*                                                                                                                    *
*   presta_product     ====   champs condition (pour permettre de choisir cartouche (généric ou marque)              *
*                                               gain generic > gain marque)                                          *
*   presta_product_lang                                                                                              *
*   presta_product_tag                                                                                               *
*   presta_tag                                                                                                       *
*   presta_category                                                                                                  *
*   presta_category_lang                                                                                             *
*   presta_category_product                                                                                          *
*                                                                                                                    *
*                                                                                                                    *
*********************************************************************************************************************/

class Cartridge {
    
    
    /**
     *
     * Connexion à la base de donnée Surdiscount.com
     * 
     * @return $dbh     Instance de connexion à la bdd
     * 
     */
    public function connect() {
        
        try {
        
        $dbh = new PDO('mysql:host=db3070.1and1.fr;dbname=db358667924', 'dbo358667924', 'cactus4512');
        
        } catch(PDOException $e) {
            
            echo 'Erreur de connexion à la base de donnée';
            die();
        }
        
        return $dbh;
    }
    
    /**
     *
     * id_category = 102 (cartouches imprimantes)
     *
     * Fonction récursive qui permet de parcourir le menu de cartouches en profondeur
     * Recursive public function which is permit to browse the cartridge in depth
     * 
     * @param PDO $dbh        Instance of PDO connection for BDD
     * @param int $id         Id used in the query
     * @param int $depth      Depth
     *
     * @return array $tab     Array with children
     */
    public function getChildren(PDO $dbh, $id, $depth) {
        
        $tab = array();
        
        if(!$depth)
            $tab[] = $id;
        
        $depth++;
    
        foreach($dbh->query('SELECT * FROM presta_category WHERE id_parent = '. $id) as $row) {
            
            $tab[] = $row['id_category'];
            echo str_repeat('&nbsp;', 10*$depth);
            echo $row['id_category']. ' -> ' .$row['name'] .'<br />';
            $tab = array_merge($tab, getChildren($dbh, $row['id_category'], $depth));
        }
        
        return $tab;
    }
    
    /**
     *
     * getTagFromIdProduct -> Return results of tags from id_product
     * 
     * @param PDO $dbh        PDO instance of database connection
     * @param int $id         Id used in the query
     *
     * @return array $result  Array of query's results
     */
    public function getTagFromIdProduct(PDO $dbh, $idProduct) {
        
        $query = 'SELECT name FROM presta_tag WHERE id_tag
                  IN
                  (SELECT id_tag FROM presta_product_tag NATURAL JOIN presta_product WHERE id_product = '. $idProduct .')';
                  
        $result = $dbh->query($query);
        
        return array_unique($result->fetchAll(PDO::FETCH_COLUMN, 0));
    }
    
    /**
     *
     * getProductsFromTag ->  return results of products from tag
     * 
     * @param PDO $dbh        PDO instance of database connection
     * @param int $id         Id used in the query
     *
     * @return array $result  Array of query's results which contains all information
     */
    public function getProductFromTag(PDO $dbh, $tag) {
        
        $query = 'SELECT id_product FROM presta_product_tag WHERE id_tag
                  IN
                  (SELECT id_tag FROM presta_tag WHERE name LIKE "%'.$tag.'%")';
        
        $result = $dbh->query($query);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    /**
     *
     * getProductsFromId  ->  return results of products from id
     * 
     * @param PDO $dbh        PDO instance of database connection
     * @param int $id         Id used in the query
     *
     * @return array $result  Array of query's results which contains all information
     */
    public function getProductsFromIdCategory(PDO $dbh, $idCat) {
        
        $categories = getChildren($dbh, $idCat, 0);
    
        $query = 'SELECT * 
        FROM presta_category
        LEFT JOIN presta_category_lang ON presta_category.id_category = presta_category_lang.id_category
        LEFT JOIN presta_category_product ON presta_category_product.id_category = presta_category.id_category
        LEFT JOIN presta_product ON presta_category_product.id_product = presta_product.id_product
        LEFT JOIN presta_product_lang ON presta_product_lang.id_product = presta_product.id_product
        WHERE presta_category.id_category IN ( '. join( ', ', $categories)  .' )
        GROUP BY presta_product.id_product';
        
        $result = $dbh->query($query);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     *
     * getTagFromIdCategory  ->  return results of tag from id_category
     * 
     * @param PDO $dbh        PDO instance of database connection
     * @param int $idCat      Id used in the query
     *
     * @return array $result  Array unique of query's results which contains all information
     */
    public function getTagFromIdCategory(PDO $dbh, $idCat) {
        
        $tag = array();
        
        $products = getProductsFromIdCategory($dbh, $idCat);
        
        foreach($products as $prod) {
            
               $tag = array_merge($tag, getTagFromIdProduct($dbh, $prod['id_product']));
        }
        
        return array_unique($tag);
    }
    
    /**
     *
     * formatTagCartouche  ->  return results of tag from id_category

     * @param array $data     Array of tags
     *
     * @return array $result  Array of data tags formatted
     */
    public function formatTagCartouche ( $data = array() ) {
    
        $new_data = array();
        foreach ( (array)$data as $item ) {
                $nb = strlen( $item );
                
                $item['name_clean'] = str_replace( ' ', '', $item );
                
                $hasSpace = false;
                $tmp_word = '';
                for ( $i = 0; $i < $nb; $i++ ) {
                        if (!$hasSpace && $i
                                && (
                                        ( strtoupper( $item[$i] ) == $item[$i] && strtolower( $item[$i-1] ) == $item[$i-1] )
                                )
                        ) {
                                $tmp_name = ''.$item[$i];
                        }
                        else {
                                $tmp_name = $item[$i];
                        }

                        $tmp_word .= $tmp_name;

                        if ( is_string( $item[$i] ) && is_numeric( $item[$i+1] ) && !$hasSpace ) {
                                $tmp_word .= '';
                                
                                $hasSpace = true;
                        }
                }
                
                $item = $tmp_word;
                
                $new_data[current( explode( ' ', $tmp_word ) )][] = $item;
        }
        
        return $new_data;
    }
}

