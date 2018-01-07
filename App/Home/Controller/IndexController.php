<?php
    namespace APP\Home\Controller;

    use HHTCore\Controller\Controller;

    class IndexController extends Controller {
    	public function index () {
    		$a = array('key1' => 'value1', 'key2' => 'value2');
    		$this->render('Header/index.php', $a);
    	}
    }