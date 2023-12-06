<?php
require_once dirname(__FILE__).'/BaseService.php';
require_once dirname(__FILE__).'/../dao/ProductsDao.class.php';

class ProductsService extends BaseService{

    public function __construct(){
        parent::__construct(new ProductsDao());
    }
}
?>