<?php
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/PaymentsDao.class.php';

class PaymentsService extends BaseService{

    public function __construct(){
        parent::__construct(new PaymentsDao());
    }


}
?>