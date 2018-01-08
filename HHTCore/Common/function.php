<?php
    
    /*
    *作用：启动项目
    */
    function runApp() {
    	$app = isset($_GET['app']) ? $_GET['app'] : 'Home'; // 默认的应用是Home
	    $controller = isset($_GET['c']) ? $_GET['c'] : 'Index'; // 默认的控制器是Home目录下的IndexController
	    $controller .= 'Controller';

	    $action = isset($_GET['a']) ? $_GET['a'] : 'index'; // 默认的方法是Home目录下的IndexController中的index
	    
	    $file = APPS_ROOT_PATH . '/' . $app . '/Controller/' . $controller . '.php';

	    if (is_file($file)) {
	    	include $file;
	    	$controller = '\APP\Home\Controller\\' . $controller;

	    	$appClassObject = new $controller();
	    	$appClassObject->$action();
	    }
	    else {
	    	echo 'error';
	    }
    }

    function autoLoadModel($classname) {
    	$file_path = FRAME_ROOT_PATH . '/' . $classname . '.php';
    	
    	if (file_exists($file_path)) {
    		include $file_path;
    	}
    	else {
    		try {
    		    throw new \Exception("Model don't find...");
    		} catch (Exception $e) {
    			echo 'Message:' . $e->getMessage() . PHP_EOL;
    		}
    	}
    }
    
	    

    
