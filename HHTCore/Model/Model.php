<?php

    namespace HHTCore\Model;

    class Model {
    	private $host;
    	private $dbname;
    	private $username;
    	private $password;
    	private $pdo = null;
    	private $tbname;
    	private $tb_object;

    	public function __construct($tb = '') {
            // 连接数据库部分
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
				}catch(\PDOException $e){
					echo 'database link fail:' . $e->getMessage();
					exit;
				}
			}

			if (empty($tb)) {
				exit("you should commit the table name");
			}
			else {
				$this->tbname = $tb;
			}
    	}
        
        /*
        作用：获得$tbname表的实例
        */
    	public function instanceTable($tbname) {
    		$this->tb_object = new Model($tbname);
    	}

    	public function get() {
    		return $this->tb_object;
    	}
        
        /*
        作用：查找主键为$id的那条记录
        */
    	public function find($id) {
    		if ($id <= 0) {
    			exit('please commit the correct id');
    		}

    		$sql = 'SELECT * FROM ' . $this->tbname . ' WHERE id = ' . $id;
    		$stmt = $this->pdo->query($sql);
			$result = $stmt->fetch(\PDO::FETCH_ASSOC);

			return $result;
    	}
    }