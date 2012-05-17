<?php
    /**
        GroupModel
    */
    class GroupModel extends Model
    {
        private $user_table = 'users';
        private $group_table = 'group';
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function get_users($group_id)
        {
            $group_id = DB::escape($group_id);
            $result = DB::select($this->user_table, array(
                'group' => $group_id
            ));
            
            return $result ? $result : array();
        }
        
		public function update($id, $data)
        {
            if (empty($data))
            {
                return;
            }
                        
            DB::update($this->group_table, $id, $data);
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
                    'img' => ($group['picture'] ? content($group['profile']) : url('img/gdef.png'))
                );
            }
            return empty($group_list) ? false : $group_list;
		}
    };
?>


