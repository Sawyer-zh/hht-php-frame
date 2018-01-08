<?php

    namespace APP\Home\Model;

    use HHTCore\Model\Model;

    class UsersModel extends Model {

    	public function __construct() {
    		$this->instanceTable('users'); // 获得users表的实例，就这么简单
    	}
    }