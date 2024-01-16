<?php
require_once __DIR__.'/BaseDao.class.php';

class AdminDao extends BaseDao {
    public function __construct(){
        parent::__construct("admin");
    }


    public function getAdminByEmail($email){
        return $this->queryUnique("Select * FROM admin WHERE email=:email",['email'=>$email]);
    }

}





?>