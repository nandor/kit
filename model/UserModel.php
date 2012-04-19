<?php
    /**
        User model
    */
    class UserModel extends Model
    {
        private $id;
        private $logged_in;
        private $user_data;
        
        public function __construct()
        {
            $this->logged_in = false;
            $this->id = null;
            $this->user_data = null;
               
            // retrieve user data from session
            session_start();     
            if (isset($_SESSION['id'])) {
                $data = DB::select('users', array('id' => $_SESSION['id']));
                
                if ($data && $data['id']) {
                    $this->logged_in = true;
                    $this->initialize($data);
                }
            }
        }
        
        public function login($name, $pass)
        {
            if ($this->logged_in)
            {
                $this->logout();
            }
            
            $data = DB::select('users', array(
                'name' => $name,
                'pass' => $pass
            ));
            
            if (!$data || !$data['id']) 
            {
                // Login failed
                return false;
            }
                     
            $this->initialize($data);
        }
        
        public function logged_in()
        {
            return $this->logged_in;
        }
                
        public function logout()
        {   
            session_destroy();
            $this->logged_in = false;
        }
        
        public function __get($name)
        {
            if (!$this->logged_in() || !$this->user_data)
            {
                return null;
            }
            
            return $this->user_data[$name];
        }
        
        public function __set($name, $value)
        {
            if (!$this->logged_in() || !$this->user_data || 
                !isset($this->user_data[$name]))
            {
                return null;
            }
            
            DB::update('users', $this->user_data['id'], array(
                $name => $value
            ));
        }
        
        private function initialize($db_data)
        {
            $this->user_data = $db_data;
            
            $_SESSION['id'] = $this->user_data['id'];
        }
    };

?>

