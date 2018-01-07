<?php
    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;
    use HHTCore\Model\Model;

    class IndexController extends Controller {
    	public function index () {
    		$model = new Model();
    		$a = array('key1' => 'value1', 'key2' => 'value2');
    		$this->render('Header/index.php', $a);
    	}
    }