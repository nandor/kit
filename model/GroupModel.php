<?php
    /**
        GroupModel
    */
    class GroupModel extends Model
    {
        private $user_table = 'users';
        private $group_table = 'group';		
        private $univ_table = 'university';
		private $groups_per_page = 15;
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function get_users($group_id)
        {
            $group_id = DB::escape($group_id);
            $data = DB::query("SELECT * FROM `users` WHERE `group` = '$group_id'", false);
            $result = array();
            
            while ($user = DB::next($data))
            {
            	$result[] = $user;
			}
            
            return $result;
        }
        
		public function update($id, $data)
        {
            if (empty($data))
            {
                return;
            }
                        
            DB::update($this->group_table, $id, $data);
            
            if (isset($data['name']))
            {
            	DB::query("UPDATE `{$this->user_table}` SET ".
            			  "`group_name` = '{$data['name']}' WHERE `group` = '$id'");
        	}
        }
		
		public function get_data($id)
        {
            return DB::select($this->group_table, array(
                'id' => $id
            ));
        }
        
        public function search($what)
        {
            $result = DB::query(
                "SELECT `id`, `name`, `picture` FROM `{$this->group_table}` WHERE
                `name` LIKE '%".mysql_real_escape_string($what)."%'
                LIMIT 5", false
            );
            
            if (!$result)
            {
                return false;
            }
            
            $group_list = array();
            while ($group = mysql_fetch_array($result))
            {
                $group_list[$group['id']] = array(
                    'name' => $group['name'],
                    'img' => ($group['picture'] ? content($group['picture']) : url('img/gdef.png'))
                );
            }
            return empty($group_list) ? false : $group_list;
		} 
        
        public function get_groups($univ_id)
        {
            return DB::query(
            	"SELECT * FROM `{$this->group_table}` WHERE ".
            	"`university` = '$univ_id' ".
            	"ORDER BY `name` ASC", 
            	false
        	);
        }
        
        public function add($data)
        {
        	$univ = DB::select($this->univ_table, array (
        		'id' => $data['university']
    		));
        	
        	if (!$univ)
        	{
        		throw new Exception ("University not found!");
        	}
        	
        	
            DB::insert($this->group_table, array(
            	'university' => $univ['id'],
            	'university_name' => $univ['name'],
                'name' => $data['name'],
                'promotion' => $data['promotion'],
                'about' => $data['about']
            ));
        }
        
        public function get_num_groups($id)
        {
            $res = DB::query(
            	"SELECT COUNT(id) AS `num_groups` ".
            	"FROM `$this->group_table` ".
            	"WHERE `university` = '$id'", 
            	true
        	);
        	
            return $res['num_groups'];
        }
    };
?>
