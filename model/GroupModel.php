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
    };
?>
