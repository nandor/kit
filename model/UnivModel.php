<?php

    class UnivModel extends Model
    {
        private $db_to_table = array('name' => 'Name', 'address' => 'Address', 'phone_number' => 'Phone Number');
        private $table_name = "university";
        
        public function __construct()
        {
            parent::__construct();
        }
        
        public function getById($id)
        {
             return DB::select($this->table_name, array(
                  'id' => $id
             ));
        }
        
        public function get_univs($page_num, $univs_per_page)
        {
            return DB::query(
            	"SELECT `name`, `address`, `id`, `phone_number`, `email` FROM `$this->table_name` ".
            	"ORDER BY `name` ASC ".
            	"LIMIT ".(($page_num - 1) * $univs_per_page).", {$univs_per_page}", true);
        }
        
        public function get_num_univs()
        {
            $res = DB::query("SELECT COUNT(*) AS `numUnivs` FROM `{$this->table_name}`", true);
            return $res['numUnivs'];
        }
        
        public function get_univ_data($id)
        {
            return DB::select('university', array('id' => $id));
        }
        
        public function add($data)
        {
            DB::insert($this->table_name, $data);
        }
        
		public function update($id, $data)
        {
            if (empty($data))
            {
                return;
            }
                        
            DB::update($this->table_name, $id, $data);
            
            if (isset($data['name']))
            {
            	DB::query("UPDATE `{$this->user_table}` SET ".
            			  "`university_name` = '{$data['name']}' WHERE `university` = '$id'");
        	}
        }
        
        public function search($what)
        {
            $result = DB::query(
                "SELECT `id`, `name`, `picture` ".
                "FROM `{$this->table_name}` WHERE ".
                "`name` LIKE '%".mysql_real_escape_string($what)."%'
                LIMIT 5", false
            );
            
            if (!$result)
            {
                return false;
            }
            
            $univ_list = array();
            while ($univ = mysql_fetch_array($result))
            {
                $univ_list[$univ['id']] = array(
                    'name' => $univ['name'],
                    'img' => ($univ['picture'] ? content($univ['picture']) : url('img/udef.png'))
                );
            }
            return empty($univ_list) ? false : $univ_list;
		} 
    };
?>
