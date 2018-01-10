<?php

    namespace HHTCore\Model;

    abstract class Model {
    	private $host = '';
    	private $dbname = '';
    	private $username = '';
    	private $password = '';
    	private $pdo = null;
        private $where = '';

    	public function __construct() {
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
    	}
        
        
        /*
        作用：查找满足条件$this->where的那条记录

        */
    	public function find() {
            if (empty($this->where)) {
                exit('please input the condition of query');
            }

    		$sql = 'SELECT * FROM ' . $this->tbname . $this->where;
    		$stmt = $this->pdo->query($sql);
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $result_nums = count($result);

            if ($result_nums > 1) { // 如果记录数大于1条，那么直接返回这个二维数组
                return $result;
            }
            else if(1 == $result_nums) { // 如果记录数为一条，返回一维数组即可
                return $result[0];
            }
            else { // 查询结果为空，则直接返回这个空数组
                return $result;
            }
    	}
        
        /*
        作用：设置条件
        返回值：某张表的实例
        注意点：这些条件默认是AND的关系
        */
        public function where($field, $operator, $value) {
            if (empty($this->where)) {
                $this->where = ' WHERE ' . $field . ' ' . $operator . ' ' . $value;
            }
            else {
                $this->where .= ' AND ' . $field . ' ' . $operator . ' ' . $value;
            }

            return $this;
        }
    }