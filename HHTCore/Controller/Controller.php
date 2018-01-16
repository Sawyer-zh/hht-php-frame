<?php
    
    namespace HHTCore\Controller;

    use HHTCore\Common\HHT;

    abstract class Controller {
        private $view_path;
        private $tpl = null;

        public function __construct() {
        	$this->view_path = APPS_ROOT_PATH . '/' . APP_NAME . '/View';
            $this->tpl = HHT::setSmartyObj();
        }

    	public function assign($name, $val) {
            $this->tpl->assign($name, $val);
        }

        public function display($path = '') {
            $this->tpl->display($path);
        }
    }