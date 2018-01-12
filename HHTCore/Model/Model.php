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
        返回值：返回查到的结果集(一条记录是以一维数组的形式返回，多条记录是以二维数组的形式返回)
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
                $this->where = '';
                return $result;
            }
            else if(1 == $result_nums) { // 如果记录数为一条，返回一维数组即可
                $this->where = '';
                return $result[0];
            }
            else { // 查询结果为空，则直接返回这个空数组
                $this->where = '';
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
        
        /*
        作用：更新记录
        返回值：成功：返回更新的记录条数
               失败：返回 -1
        */
        public function update($data = []) {
            if (empty($data)) {
                var_dump('empty');
                return -1;
            }

            if (empty($this->where)) { // 更新一定要给出条件，避免遗漏了条件导致所有的数据都被改变了
                return -1;
            }

            $sql = 'UPDATE ' . $this->tbname . ' SET ';
            $updates = [];

            foreach ($data as $key => $value) {
                if (is_string($value)) { // 注意：顺序不能和is_numeric()调换
                    $updates[] = "{$key} = '{$value}'";
                }
                if (is_numeric($value)) {
                    $updates[] = "{$key} = {$value}";
                }
            }

            $sql .= implode(', ', $updates);
            $sql .= $this->where;

            $nums = $this->pdo->exec($sql);

            $this->where = '';

            if ($nums >= 0) {
                return $nums;
            }
            else {
                return -1;
            }
        }
        
        /*
        作用：删除记录
        返回值：成功：返回删除的记录条数（包括0）
               失败：返回 -1
        */
        public function delete() {
            if (empty($this->where)) { // 更新一定要给出条件，避免遗漏了条件导致所有的数据都被删除了
                return -1;
            }

            $sql = "DELETE FROM {$this->tbname} " . $this->where;
            $nums = $this->pdo->exec($sql);
            $this->where = '';

            if ($nums >= 0) {
                return $nums;
            }
            else {
                return -1;
            }
        }

        /*
        作用：增加一条记录
        返回值：成功：返回插入的记录数
               失败：返回 -1
        */
        public function insert($data = []) {
            if (empty($data)) {
                return -1;
            }

            $sql = "INSERT INTO {$this->tbname} (";

            foreach ($data[0] as $key => $value) { // 拼出字段
                
                if ($key == count($data[0]) - 1) {
                    $sql .= "{$value}";
                }
                else {
                    $sql .= "{$value}, ";
                }
            }

            $sql .= ") VALUES(";

            foreach ($data[1] as $key => $value) { // 拼出字段对应的值
                if (is_string($value)) { // 注意：顺序不能和is_numeric()调换
                    if ($key == count($data[0]) - 1) {
                        $sql .= "'{$value}'";
                    }
                    else {
                        $sql .= "'{$value}', ";
                    }
                }
                if (is_numeric($value)) {
                    if ($key == count($data[0]) - 1) {
                        $sql .= "{$value}";
                    }
                    else {
                        $sql .= "{$value}, ";
                    }
                }
            }

            $sql .= ")";

            $nums = $this->pdo->exec($sql);
            $this->where = '';

            if ($nums > 0) {
                return $nums;
            }
            else {
                return -1;
            }
        }
    }