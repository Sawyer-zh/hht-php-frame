<?php

    /*
    系统启动文件
    */

    // 框架核心代码的根目录(******/HHTCore/)
    defined('SYS_ROOT_PATH') or define('SYS_ROOT_PATH', dirname(dirname(__FILE__)));
    // 框架的根目录(******/hht-php-frame)
    defined('FRAME_ROOT_PATH') or define('FRAME_ROOT_PATH', dirname(SYS_ROOT_PATH));

    // 所有应用的根目录(******/App)
    defined('APPS_ROOT_PATH') or define('APPS_ROOT_PATH', FRAME_ROOT_PATH . '/App');
    // 某个应用（即我们的某个项目的根目录，例如：Home）
    defined('APP_NAME') or define('APP_NAME', isset($_GET['app']) ? $_GET['app'] : 'Home');

    // 引入模板引擎（为了方便，所以放在全局命名空间下）
    include SYS_ROOT_PATH . '/Common/' . 'Smarty/Libs/Smarty.class.php';

    include SYS_ROOT_PATH . '/Controller/Controller.php';
    include SYS_ROOT_PATH . '/Model/Model.php';
    include SYS_ROOT_PATH . '/Cache/CacheInterface.php';
    include SYS_ROOT_PATH . '/Cache/RedisCache.php';
    include 'HHT.php';

    // 自动添加Model类文件
    spl_autoload_register('HHTCore\Common\HHT::autoLoadModel');