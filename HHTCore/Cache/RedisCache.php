<?php

    namespace HHTCore\Cache;

    use HHTCore\Cache\CacheInterface;

    class RedisCache implements CacheInterface {
        private $redis = null;
        private $host = '';
        private $port = '';

        public function __construct() {
        	$redis_conf_file = APPS_ROOT_PATH . '/' . APP_NAME . '/Conf/redis.conf.php';
        	if (file_exists($redis_conf_file)) {
        		$redis_conf = include $redis_conf_file;
        		$this->host = $redis_conf['host'];
        		$this->port = $redis_conf['port'];

        		$this->redis = new \Redis();
        		if ($this->redis->connect($this->host, $this->port) === false) {
        			exit('connect redis fail');
        		}
        	}
        	else {
        		exit('no configure file');
        	}
        }

    	/*
        作用：把给定的键变成规范化的缓存键。
        返回值：规范化的缓存键。
    	*/
    	public function buildKey($key) {
    		if (!is_string($key)) {
    			$key = json_encode($key);
    		}

    		return md5($key);
    	}

    	/*
        作用：从缓存中得到指定键对应的值
    	*/
    	public function get($key) {
    		$key = $this->buildKey($key);

    		return $this->redis->get($key);
    	}

    	/*
        作用：检查缓存中是否有指定的键
    	*/
    	public function exists($key) {
    		$key = $this->buildKey($key);

    		return $this->redis->exists($key);
    	}

    	/*
        作用：从缓存中得到指定键的多个值
    	*/
    	public function mget($keys) {
    		$nums = count($keys);

    		for ($i = 0; $i < $nums; ++$i) {
    			$keys[$i] = $this->buildKey($keys[$i]);
    		}

    		return $this->redis->mGet($keys);
    	}

    	/*
        作用：在缓存中存储键值对
    	*/
    	public function set($key, $value, $duration = 0) {
    		$key = $this->buildKey($key);
    		if (0 !== $duration) {
    			$expire = (int)$duration * 1000;

    			return $this->redis->set($key, $value, $expire);
    		}
    		else {
    			return $this->redis->set($key, $value);
    		}
    	}

    	/*
        
    	*/
    	public function mset($items, $duration = 0) {
    		$failed_keys = [];

    		foreach ($items as $key => $value) {
    			if ($this->set($key, $value, $duration)) {
    				$failed_keys[] = $key;
    			}
    		}

    		return $failed_keys;
    	}

    	/*
        作用：如果缓存中不包含此key，那么将key对应的值存储在缓存中
    	*/
    	public function add($key, $value, $duration = 0) {
    		if (!$this->exists($key)) {
    			return $this->set($key, $value, $duration);
    		}
    		else {
    			return false;
    		}
    	}

        /*
        作用：批量add
        */
    	public function madd($items, $duration = 0) {
    		$failed_keys = [];

    		foreach ($items as $key => $value) {
    			if ($this->add($key, $value, $duration) === false) {
    				$failed_keys[] = $key;
    			}
    		}

    		return $failed_keys;
    	}

    	/*
        作用：从缓存中删除键所对应的值
    	*/
    	public function delete($key) {
    		$key = $this->buildKey($key);

    		return $this->redis->delete($key);
    	}

    	/*
        作用：把缓存中的值全部删除
    	*/
    	public function flush() {
    		$this->redis->flushDb();
    	}
    }