<?php
    /**
        Class for the URL routing interface. It matches
        urls to url patterns and calls controller functions
        mapped to their corresponding patterns.
        
        It uses a trie-like structure to do quick lookup
    */    
    class Router {     
        /// The root of the trie   
        private $root; 
        
        /**
            Creates a new url router
        */
        public function __construct()
        {
            session_start();     
            
            $this->root = array(
                'route' => null,
                'children' => array()
            );
        }
        
        /**
            Insert an url pattern into the trie
            URL patterns are composed of tokens separated by '/'
            If an error occurs, an exception will be thrown
            Variables begin with :
            
            @param $url          The url pattern
            @param $control      class::function format
        */
        public function pattern($url, $control)
        {
            $tokens = explode('/', $url);
            $node = &$this->root;
            
            // Loop through the tokens and insert them into the trie
            foreach ($tokens as $token) 
            {
                if (!$token)
                {
                    // We simply discard empty tokens
                    continue;
                }
                
                if (!isset($node['children'][$token])) 
                {
                    if ($token[0] == '$') 
                    {
                        // We're dealing with a variable token.
                        // We have to check if we have other $ tokens
                        foreach ($node['children'] as $other_token => $data) 
                        {
                            if ($other_token[0] == '$') 
                            {
                                throw new Exception('Two variable tokens!');
                            }
                        }
                    }
                    
                    $node['children'][$token] = array(
                        'route' => null,
                        'children' => array()
                    );
                }
                
                $node = &$node['children'][$token];
            }
            
            if ($node['route'] != null) 
            {
                throw new Exception('Duplicate route: $url');
            }
                        
            $node['route'] = $control;
        }
        
        /**
            Parse the url and call a matching controller
            If no controller is found, an exception will
            be thrown.
            
            @param $url         URL to be parsed
        */
        public function route($url)
        {
            global $cfg;
            
            // remove the base url from the route
            $pos = strpos($url, $cfg['base_url']);
            
            if ($pos !== 0) 
            {
                throw new Exception('URL does not begin with \'base_url\'!');
            }
            
            $url = substr($url, strlen($cfg['base_url']));
            
            // Explode the url into tokens
            $tokens = explode('/', $url);
            $node = $this->root;
            $params = array();
            
            foreach ($tokens as $token) {
                if (!$token)
                {
                    continue;
                }
                
                if (!$node['children'])
                {
                    throw new Exception('Route does not exist!');
                }
                            
                if (isset($node['children'][$token])) 
                {
                    $node = $node['children'][$token]; 
                    continue;               
                }
                 
                $routeFound = false;   
                foreach ($node['children'] as $key => $next)
                {
                    if ($key[0] == '$')
                    {
                        $params[substr($key, 1)] = $token;
                        $node = $node['children'][$key];
                        $routeFound = true;
                        break;                    
                    }
                }
                
                if (!$routeFound)
                {
                    throw new Exception('Page does not exist'); 
                }
            }
            
            if (!$node['route'])
            {
                throw new Exception('Page does not exist');
            }
            $this->call_controller($node['route'], $params);
        }
        
        /**
            Call the specified controller
            @param $controller          Controller file
            @param $function            Function from the controller
            @param $params              Parameters passed to the controller
        */  
        private function call_controller($control, $params)
        {
            $ctrl = preg_split('/::/', $control);
            if (count ($ctrl) != 2) {
                throw new Exception('Invalid controller description');
            }
            
            $class = $ctrl[0];
            $func = $ctrl[1];
            
            // Easy includes
            set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);    
    
            spl_autoload_register('Router::autoload');
            
            $ctrl_inst = new $class();
            
            if (!is_callable(array($ctrl_inst, $func))) {
                throw new Exception("Controller $class does not have a $func method!");
            }
                        
            call_user_func_array(array($ctrl_inst, $func), $params);
            
            spl_autoload_unregister('Model::autoload');            
        } 
        
        /**
            Autoload method for controllers
            @param $className           Name of the class
        */
        private static function autoload($className)
        {
            global $cfg;
            include ("{$cfg['dir']['controller']}$className.php");
        }
    };

?>
