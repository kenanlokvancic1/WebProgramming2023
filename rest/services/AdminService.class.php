<?php
require_once dirname(__FILE__).'/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/AdminDao.class.php';

class AdminService extends BaseService{

    public function __construct(){
        parent::__construct(new AdminDao());
    }

    public function getAdminByEmail($email){
        return $this->dao->getAdminByEmail($email);
    }
}
