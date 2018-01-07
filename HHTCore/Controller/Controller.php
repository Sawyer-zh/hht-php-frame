<?php
    
    namespace HHTCore\Controller;

    class Controller {
        public $view_path;

        public function __construct() {
        	$this->view_path = APPS_ROOT_PATH . '/' . APP_NAME . '/View';
        }

    	public function render($view = '', $data = []) {
    		$complete_path = $this->view_path .= '/' . $view;
    		var_dump($complete_path);

    		if (is_file($complete_path)) {
    			include $complete_path;
    		}
    		else {
    			throw new Exception("模板文件不存在");
    		}
    	}
    }