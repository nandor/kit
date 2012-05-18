<?php
    /**
        Controller for user groups
    */
    class MessageController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->user = Model::load('UserModel');
            $this->group = Model::load('GroupModel');
        }
        
        public function create($who, $type)
        {
        
        }
        
        public function send()
        {

		}
		
		public function inbox($type)
		{
		
		}
    };
?>
