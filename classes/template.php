<?php
class Template {
	private $path = '';
	
	private function __construct(){}
	
	static public function render($name, $data=array()){
		global $config;
		$path = __DIR__ . '/../tpls/' . $name . '.php';
		extract($data);
		ob_start();
		require $path;
		$result = ob_get_contents();
		ob_end_clean();
		return $result;
	}
}