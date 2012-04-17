<?php
    
    /**
        Base class for the controllers
    */
    abstract class Controller 
    {
        private $args;
        
        public function __construct()
        {
            
        }
        
        protected function view_args($array)
        {
            if (!is_array($array)) {
                throw new InvalidArgumentException ('Argument must be array');
            }
            
            $this->args = $array;
        }
        
        protected function render_view($view_name)
        {
            global $cfg;
            include ("{$cfg['dir']['view']}$view_name");
        }
        
        public function __get($name)
        {
            return isset($this->args[$name]) ? $this->args[$name] : null;
        }
        
        public function __set($name, $value)
        {
            $this->args[$name] = $value;
        }
    };

?>
