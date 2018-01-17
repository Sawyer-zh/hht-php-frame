<?php

    namespace HHTCore\Cache;

    interface CacheInterface {
    	/*
        作用：把给定的键变成规范化的缓存键。
        返回值：规范化的缓存键。
    	*/
    	public function buildKey($key);

    	/*
        作用：从缓存中得到指定键对应的值
    	*/
    	public function get($key);

    	/*
        作用：检查缓存中是否有指定的键
    	*/
    	public function exists($key);

    	/*
        作用：从缓存中得到指定键的多个值
    	*/
    	public function mget($keys);

    	/*
        作用：在缓存中存储键值对
    	*/
    	public function set($key, $value, $duration = 0);

    	/*
        
    	*/
    	public function mset($items, $duration = 0);

    	/*
        作用：如果缓存中不包含此key，那么将key对应的值存储在缓存中
    	*/
    	public function add($key, $value, $duration = 0);


    	public function madd($items, $duration = 0);

    	/*
        作用：从缓存中删除键所对应的值
    	*/
    	public function delete($key);

    	/*
        作用：把缓存中的值全部删除
    	*/
    	public function flush();
    }