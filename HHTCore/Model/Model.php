<?php
    namespace HHTCore\Model;

    class Model {
    	private $host;
    	private $dbname;
    	private $username;
    	private $password;
    	private $pdo = null;

    	public function __construct() {
    		if($this->pdo == null){
    			// 获取用户配置的数据库参数
    			$mysql_conf = include APPS_ROOT_PATH . '/' . APP_NAME . '/Conf/mysql.conf.php';

    			$this->host = $mysql_conf['host'];
    			$this->dbname = $mysql_conf['dbname'];
    			$this->username = $mysql_conf['username'];
    			$this->password = $mysql_conf['password'];

    			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

				try{
					$this->pdo = new \PDO($dsn, $this->username, $this->password);
				}catch(PDOException $e){
					echo '数据库链接失败' . $e->getMessage();
					exit;
				}
			}
    	}
    }