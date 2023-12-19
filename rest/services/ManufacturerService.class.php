<?php
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/ManufacturerDao.class.php';

class ManufacturerService extends BaseService{

    public function __construct(){
        parent::__construct(new ManufacturerDao());
    }
}
?>