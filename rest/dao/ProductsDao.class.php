<?php
require_once dirname(__FILE__).'/BaseDao.class.php';

class ProductsDao extends BaseDao {
    public function __construct(){
        parent::__construct("products");
    }

    public function get_products_with_manufacturer_names(){

        $stm="SELECT pr.id, m.name, pr.product_desc, pr.price";
        $stm.="FROM products pr";
        $stm.="JOIN manufacturer m ON pr.id = m.id";
        $stm.="ORDER BY id;";
        $result=$this->conn->prepare($stm);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    

    
}





?>