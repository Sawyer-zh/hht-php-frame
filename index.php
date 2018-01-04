<?php

	/*
	应用（项目）的入口文件
	*/

    include 'HHTCore/Common/bootstrap.php';

    $app = isset($_GET['app']) ? $_GET['app'] : 'Home'; // 默认的应用是Home
    $controller = isset($_GET['c']) ? $_GET['c'] : 'Index'; // 默认的控制器是Home目录下的IndexController
    $controller .= 'Controller';

    $action = isset($_GET['a']) ? $_GET['a'] : 'index'; // 默认的方法是Home目录下的IndexController中的index
    
    $file = APP_ROOT_PATH . '/' . $app . '/Controller/' . $controller . '.php';

    if (is_file($file)) {
    	include $file;
    	$controller = '\APP\Home\Controller\\' . $controller;

    	$appClassObject = new $controller();
    	$appClassObject->$action();
    }
    else {
    	echo 'error';
    }
