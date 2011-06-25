<?php
class Autoloader {
    
    static private $loadpaths = array(
            '/classes/'
    );
    
    static public function register() {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self, 'autoload'));
    }

    static public function autoload($class) {
        foreach(self::$loadpaths as $paths){
                $fullpath = pwd() . $path . self::class_to_filename($class);
                if(file_exists($fullpath)){
	echo $fullpath;
                    require_once($fullpath);
                }
        }
    }
    
    static private function class_to_filename($class){
        $class = str_replace('_','/',$class);
        $class = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $class));
        return $class . '.php';
    }

}