<?php
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/OrdersDao.class.php';

class OrdersService extends BaseService{

    public function __construct(){
        parent::__construct(new OrdersDao());
    }
}
