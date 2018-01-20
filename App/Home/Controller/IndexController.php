<?php

    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use HHTCore\Cache\RedisCache;
    use APP\Home\Model\UsersModel;

    class IndexController extends Controller {
    	public function index () {
    		$users = new UsersModel();
            $res = $users->where('id', '=', 1)->find();

            var_dump($res);

            $redis = new RedisCache();
            $redis->add('key1', 'value1', 1);
            $value = $redis->get('key1');
            var_dump($value);

    		$this->assign('name', 'Ned');
    		$this->display('Header/index.tpl');
    	}
    }