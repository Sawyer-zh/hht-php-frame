<?php
    /*
    系统启动文件
    */

    // 框架核心代码的根目录
    defined('SYS_ROOT_PATH') or define('SYS_ROOT_PATH', dirname(dirname(__FILE__)));
    // 框架的根目录
    defined('FRAME_ROOT_PATH') or define('FRAME_ROOT_PATH', dirname(SYS_ROOT_PATH));
    // 应用（项目）的根目录
    defined('APP_ROOT_PATH') or define('APP_ROOT_PATH', FRAME_ROOT_PATH . '/APP');