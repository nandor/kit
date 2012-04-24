<?php
    /**
        User model
    */
    class UserModel extends Model
    {
        private $id;
        private $logged_in;
        private $user_data;
        private $table_name = 'users';
        
        public function __construct()
        {
            $this->logged_in = false;
            $this->id = null;
            $this->user_data = null;
               
            // retrieve user data from session
            if (isset($_SESSION['id'])) {
                $data = DB::select($this->table_name, array('id' => $_SESSION['id']));
                
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
            
            $data = DB::select($this->table_name, array(
                'name' => $name,
                'pass' => $pass
            ));
            
            if (!$data || !$data['id']) 
            {
                // Login failed
                return false;
            }
                     
            $this->initialize($data);
            return true;
        }
        
        public function logged_in()
        {
            return $this->logged_in;
        }
                
        public function logout()
        {   
            unset($_SESSION['id']);
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
            
            DB::update($this->table_name, $this->user_data['id'], array(
                $name => $value
            ));
            
            DB::insert('timeline', array(
                'user' => $this->user_data['id'],
                'field' => $name,
                'date' => date('Y-n-j'),
                'value' => $value
            ));
        }
        
        public function add($name, $pass)
        {
            if (DB::select($this->table_name, array('name' => $name)))
            {
                throw new Exception("Username already used!");
            }
            
            DB::insert($this->table_name, array(
                'name' => $name, 
                'pass' => sha1($pass),
                'time_registered' => time()
            ));
        }
        
        public function getById($id)
        {            
            return DB::select($this->table_name, array(
                'id' => $id
            ));
        }
        
        public function getByName($name)
        {
            return DB::select($this->table_name, array(
                'name' => $name
            ));
        }
        
        public function get_timeline($id)
        {
            return DB::query(
                "SELECT * FROM `timeline` WHERE 
                `user` = '".mysql_real_escape_string($id)."' 
                ORDER BY `date` ASC"
            );
        }
        
        private function initialize($db_data)
        {
            $this->user_data = $db_data;
            
            $_SESSION['id'] = $this->user_data['id'];
        }
    };

?>
