<?php

    namespace HHTCore\Common;

    class SmartyTpl extends \Smarty {
    	public function __construct () {
		    parent::__construct();
		    $this->setConfigs();
	    }
        
        /*
        作用：对Smarty进行基本的配置
        */
        private function setConfigs() {
        	// 如果没有以下的Templates_c目录，那么会自动生成这个目录
			$this->template_dir = APPS_ROOT_PATH . '/' . APP_NAME . '/' . 'View';
			$this->compile_dir = APPS_ROOT_PATH . '/' . APP_NAME . '/' . 'View/Templates_c';
			
			//设计模板定界符
			$this->left_delimiter = '{';
			$this->right_delimiter = '}';
		}
    }