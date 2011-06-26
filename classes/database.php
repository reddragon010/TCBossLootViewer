<?php

/**
* 
*/
class Database
{
	private static $instance;
	
	private $connection;
	
	public static function start(){
		if(!isset($instance)){
			self::$instance = new Database();
		}
	}
	
	private function __construct()
	{
		global $config;
		$this->connect($config['db']['host'], $config['db']['port'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
	}
	
	private function connect($host,$port,$user,$pass,$db){
		$this->connection = new PDO("mysql:host={$host};port={$port};dbname={$db}", $user, $pass);
		$this->connection->query("SET NAMES 'utf8'");
	}
	
	public static function query($sql){
		self::start();
				//echo $sql . '<br />' . "\n";
		$result = self::$instance->connection->query($sql);
		if($result){
			return $result;
		} else {
			throw new Exception('SQL ERROR: ' . var_export(self::$instance->connection->errorInfo(),true));
		}
		return ;
	}
}
