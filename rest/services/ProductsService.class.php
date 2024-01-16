<?php
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/ProductsDao.class.php';

class ProductsService extends BaseService{

    public function __construct(){
        parent::__construct(new ProductsDao());
    }

    public function getProductsWithManufacturerNames(){
        return $this->dao->get_products_with_manufacturer_names();
    }
}
