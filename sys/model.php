<?php
    
    /**
        Abstract base class for the 'model' part
        of the framework
    */
    abstract class Model
    {
        public function __construct()
        {

        }
        
        public static function load($modelName)
        {          
            $model_inst = new $modelName();            
            return $model_inst;
        }
        
        public static function autoload($className)
        {
            global $cfg;
            include ("{$cfg['dir']['model']}$className.php");
        }
    };

?>
