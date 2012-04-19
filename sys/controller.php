<?php
    
    /**
        Base class for the controllers
    */
    abstract class Controller 
    {
        private $values;
        
        public function __construct()
        {   
            // Only one controller can be loaded, so we can replace
            // the autoload for controllers with the autoload for
            // models     
            spl_autoload_unregister('Router::autoload');
            spl_autoload_register('Model::autoload');  
            
            $this->values = array();
        }
        
        protected function render_view($view_name)
        {
            global $cfg;
            include ("{$cfg['dir']['view']}$view_name.php");
        }
        
        /**
            Redirect to another page
            @param $url         URL of the target page
        */
        public function redirect($url)
        {
            header("Location: ".url($url));
        }
        
        /**
            Getter method - is a member does not exist, it's
            searched in the argument array
            
            @param $name        Name of the member
            @return             The value
        */
        public function __get($name)
        {
            return isset($this->values[$name]) ? $this->values[$name] : null;
        }
        
        /**
            Setter method - set the value of the variable
            in the $value array
            
            @param $name        Name of the variable
            @param $value       New value
        */        
        public function __set($name, $value)
        {
            $this->values[$name] = $value;
        }
    };

?>
