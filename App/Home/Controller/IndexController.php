<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
            $res = $users->where('id', '=', 1)->find();

            var_dump($res);

    		$this->assign('name', 'Ned');
    		$this->display('Header/index.tpl');
    	}
    }