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

require('Bdd.class.php');

class Cartridge {
    
    private $dbh;
    
    public function __construct() {
        
        $this->dbh = Bdd::getInstance();
    }
    
    /**
     *
     * id_category = 102 (cartouches imprimantes)
     *
     * Fonction récursive qui permet de parcourir le menu de cartouches en profondeur
     * Recursive public function which is permit to browse the cartridge in depth
     * 
     * @param int $id         Id used in the query
     * @param int $depth      Depth
     *
     * @return array $tab     Array with children
     */
    public function getChildren($id, $depth = 0) {
        
        $tab = array();
        
        if(!$depth)
            $tab[] = $id;
        
        $depth++;
    
        foreach($this->dbh->query('SELECT * FROM presta_category pc NATURAL JOIN presta_category_lang pcl WHERE id_parent = '. $id .' ORDER BY pcl.name') as $i => $row) {
            
            $tab[] = $row['id_category'];
            $tab = array_merge($tab, $this->getChildren($row['id_category'], $depth));
        }
        
        return array_unique($tab);
    }
    
    /**
     *
     * getTagFromProductId -> Return results of tags from id_product
     * 
     * @param int $id         Id used in the query
     *
     * @return array $result  Array of query's results
     */
    public function getTagFromProductId($idProduct) {
        
        if($idProduct) {

            $query = 'SELECT name FROM presta_tag pt WHERE id_tag
                      IN
                      (SELECT id_tag FROM presta_product_tag NATURAL JOIN presta_product WHERE presta_product.active = 1
                      AND id_product = '. $idProduct .')
                      ORDER BY pt.name';
                      
            
            $result = $this->dbh->query($query);
            
            return array_unique($result->fetchAll(PDO::FETCH_COLUMN, 0));
        }
        
        return array();
    }
    
    /**
     *
     * getProductsFromTag ->  return results of products from tag
     * 
     * @param int $id         Id used in the query
     *
     * @return array $result  Array of query's results which contains all information
     * 
     */
    public function getProductsFromTag($tag) {
        
        $query = 'SELECT id_product FROM presta_product_tag WHERE id_tag
                  IN
                  (SELECT id_tag FROM presta_tag WHERE name LIKE "%'.$tag.'%")
                  GROUP BY id_product';

        $result = $this->dbh->query($query);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     *
     * getProductsFromUserQuery ->  return results of products from tag
     * 
     * @param String $userQuery     User query search
     *
     * @return array $result        Array of query's results which contains all information
     * 
     */
    
    
    /*
WHERE ppl.name LIKE "%canon%" OR pt.name LIKE "%canon%" AND pcp.id_category IN (74, 15, 106, 130, 135)
    */
    public function getProductsFromUserQuery($userQuery) {
        
        $categories = $this->getChildren(102, 0);
        
        $query = 'SELECT id_product, name FROM presta_product_lang ppl NATURAL JOIN presta_category_product pcp
                  WHERE ppl.id_product IN 
                  (SELECT DISTINCT id_product FROM presta_tag pt NATURAL JOIN presta_product_tag ppt WHERE pt.name LIKE "%'.$userQuery.'%")
                  AND pcp.id_category IN ('. join(', ', $categories).')
                  GROUP BY id_product';
                  
        $result = $this->dbh->query($query);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    /**
     *
     * getProductsFromCategoryId  ->  return results of products from category_id
     * 
     * @param int $id                 Id used in the query
     * @param string $condition       string of what type of cartridge you want (new, refurbished, generique)
     *
     * @return array $result          Array of query's results which contains all information
     * 
     */
    public function getProductsFromCategoryId($idCat, $condition = 'new') {
        
        $categories = $this->getChildren($idCat, 0);
    
        $query = 'SELECT * 
        FROM presta_category
        LEFT JOIN presta_category_lang ON presta_category.id_category = presta_category_lang.id_category
        LEFT JOIN presta_category_product ON presta_category_product.id_category = presta_category.id_category
        LEFT JOIN presta_product ON presta_category_product.id_product = presta_product.id_product
        LEFT JOIN presta_product_lang ON presta_product_lang.id_product = presta_product.id_product
        WHERE presta_product.condition = "'.$condition.'" AND presta_category.id_category IN ( '. join( ', ', $categories)  .' )
        GROUP BY presta_product.id_product
        ORDER BY presta_product_lang.name';
        
        $result = $this->dbh->query($query);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     *
     * getTagFromCategoryId  ->  return results of tag from id_category
     * 
     * @param int $idCat         Id used in the query
     *
     * @return array $result     Array unique of query's results which contains all information
     * 
     */
    public function getTagFromCategoryId($idCat) {
        
        $tag = array();
        $children = $this->getChildren($idCat);
        
        foreach($children as $child) {
           
            $products = $this->getProductsFromCategoryId($child);
            
            foreach($products as $prod) {
                
                $tag = array_merge($tag, $this->getTagFromProductId($prod['id_product']));
                
            } 
        }
        return array_unique($tag);
    }
    
    
    


    public function getBestSalesFromCategoryId($idCat) {
        
        $query = 'SELECT * FROM presta_category_product pcp NATURAL JOIN presta_product_sale pps NATURAL JOIN presta_product_lang
                  WHERE pcp.id_category IN ('. join(', ', $idCat).')
                  GROUP BY pcp.id_product
                  ORDER BY pps.quantity DESC';
                  
        $result = $this->dbh->query($query);
        
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    /**
     *
     * formatTagCartouche  ->  return results of tag from id_category
     *
     * @param array $data     Array of tags
     *
     * @return array $result  Array of data tags formatted
     * 
     */
    public function formatTagCartouche ($data = array()) {
    
        $new_data = array();
        
        foreach ((array)$data as $item) {
            
            $nb = strlen($item);
            
            $item['name_clean'] = str_replace(' ', '', $item);
            
            $hasSpace = false;
            $tmp_word = '';
            for ($i = 0; $i < $nb; $i++) {
                
                if (!$hasSpace && $i && ((strtoupper( $item[$i] ) == $item[$i] && strtolower($item[$i-1]) == $item[$i-1]))) {
                    $tmp_name = ''.$item[$i];
                }
                
                else {
                    
                    $tmp_name = $item[$i];
                }

                $tmp_word .= $tmp_name;

                if (is_string($item[$i]) && is_numeric($item[$i+1]) && !$hasSpace) {
                    
                    $tmp_word .= '';
                    $hasSpace = true;
                }
            }
            
            $item = $tmp_word;
            $new_data[current(explode(' ', $tmp_word))][] = $item;
        }
        
        return $new_data;
    }
}

