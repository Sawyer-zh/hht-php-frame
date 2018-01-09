<?php
    
    namespace HHTCore\Controller;

    class Controller {
        public $view_path;

        public function __construct() {
        	$this->view_path = APPS_ROOT_PATH . '/' . APP_NAME . '/View';
        }

    	public function render($view = '', $data = []) {
    		$complete_path = $this->view_path . '/' . $view;

    		if (is_file($complete_path)) {
				ob_start(); // 页面缓存
				ob_implicit_flush(0);
				extract($data, EXTR_OVERWRITE); // 把键值对变成 变量 和 值 的形式
    			include $complete_path;
    			$content = ob_get_clean(); // 获取并清空缓冲区内容
				echo $content;
    		}
    		else {
    			throw new Exception("模板文件不存在");
    		}
    	}
    }