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
            parent::__construct();
            
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
                throw new Exception("Invalid field!");
            }
            
            DB::update($this->table_name, $this->user_data['id'], array(
                $name => $value
            ));
            	
            if ($timeline_add)
            {
                DB::insert('timeline', array(
                    'user' => $this->user_data['id'],
                    'field' => $name,
                    'date' => date('Y-n-j'),
                    'value' => $value
                ));
            }
        }
        
        public function update($data, $timeline_add = true)
        {
            if (!$this->logged_in() || !$this->user_data)
            {
                throw new Exception("User nod logged in!");
            }
            
            if (empty($data))
            {
                return;
            }
            
            foreach ($data as $field => $value)
            {
                if (!isset($this->user_data[$field]))
                {
                    throw new Exception("Invalid field!");
                }
                $this->user_data[$field] = $value;
            }
            
            DB::update($this->table_name, $this->user_data['id'], $data);
            
            if ($timeline_add)
            {
                foreach ($data as $field => $value)
                {
                    DB::insert('timeline', array(
                        'user' => $this->user_data['id'],
                        'field' => $field,
                        'date' => date('Y-n-j'),
                        'value' => $value
                    ));
                }
            }
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
        
        public function get_by_id($id = null)
        {       
            if ($this->logged_in && $id == $this->user_data['id'])
            {
                return $this->user_data;
            }
            
            return DB::select($this->table_name, array(
                'id' => $id
            ));
        }
        
        public function get_data()
        {
            if (!$this->logged_in)
            {
                throw new Exception("User must be logged in!");
            }
            
            return $this->user_data;
        }
        
        public function get_by_name($name)
        {
            return DB::select($this->table_name, array(
                'name' => $name
            ));
        }
        
        public function get_trail($id)
        {
            return DB::query(
                "SELECT * FROM `timeline` WHERE
                `user` = '".mysql_real_escape_string($id)."'
                AND `field` = 'address'
                ORDER BY `date` ASC"
            );
        }
        
        public function get_timeline($id)
        {
        	$result = array();
            $data = DB::query(
                "SELECT * FROM `timeline` WHERE 
                `user` = '".mysql_real_escape_string($id)."' 
                ORDER BY `date` ASC",
                false
            );
            
            while ($evt = DB::next($data))
            {
            	$result[] = $evt;
            }
            
            return $result;
        }
        
        public function search($what)
        {
            $result = DB::query(
                "SELECT `id`, `full_name`, `profile` FROM `{$this->table_name}` WHERE
                `full_name` LIKE '%".mysql_real_escape_string($what)."%'
                LIMIT 5", false
            );
            
            if (!$result)
            {
                return false;
            }
            
            $name_list = array();
            while ($person = mysql_fetch_array($result))
            {
                $name_list[$person['id']] = array(
                    'name' => $person['full_name'],
                    'img' => ($person['profile'] ? content($person['profile']) : url('img/pdef.png'))
                );
            }
            
            return empty($name_list) ? false : $name_list;
        }
        
        public function get_range($i, $j, $sort)
        {        	
            return DB::query("SELECT * FROM `{$this->table_name}`
            	WHERE `visible` = 1 
        		ORDER BY `$sort` LIMIT $i, $j",
        		false
        	);	
        }
        
        
        public function get_count()
        {
            $res = DB::query("SELECT COUNT(*) AS count FROM {$this->table_name} WHERE `visible` = 1");
            return $res['count'];
        }
        
        private function initialize($db_data)
        {
            $this->user_data = $db_data;
                      
            $_SESSION['id'] = $this->user_data['id'];
        }
    };

?>
