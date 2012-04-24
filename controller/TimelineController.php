<?php
    
    class TimelineController extends Controller
    {
        public function __construct()
        {
            parent::__construct();            
            $this->user = Model::load('UserModel');
        }
        
        public function display($list = null)
        {   
            $users = array();
            if (preg_match('/[0-9\/]+/', $list))
            {
                $user_list_expanded = explode('/', $list);
                foreach ($user_list_expanded as $user)
                {
                    $users[] = $this->user->get_timeline($user);
                }
            }
            else
            {        
                $users[] = $this->user->get_timeline($this->user->id);
            }
            
            if (empty($users))
            {
                throw new Exception("No users selected!");
            }            
            
            $timeline_steps = array();
            
            foreach ($users as $user)
            {
                foreach ($user as $event)
                {
                    $timeline_steps[] = $event['date'];
                }
            }
            
            $timeline_steps = array_unique($timeline_steps, SORT_STRING);
            
            $this->timeline_steps = $timeline_steps;
            $this->scripts = array(
                url('script/jquery.js'),
                url('script/timeline.js')
            );
                
            $this->render_view('head');
            $this->render_view('timeline');
        }
    };

?>
