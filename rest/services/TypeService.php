<?php
require_once dirname(__FILE__).'/BaseService.php';
require_once dirname(__FILE__).'/../dao/TypeDao.class.php';

class TypeService extends BaseService{

    public function __construct(){
        parent::__construct(new TypeDao());
    }
}
?>