<?php
    
    class TimelineController extends Controller
    {
        public function __construct()
        {
            parent::__construct();            
            $this->user = Model::load('UserModel');
            $this->group = Model::load('GroupModel');
        }
        
        public function user($id = null)
        {
            if ($id == null)
            {
                if (!$this->user->logged_in())
                {
                    throw new Exception("Access denied!");
                }
                
                $id = $this->user->id;
            }
            
            $this->display(array($id => $this->user->get_by_id($id)), $this->user->get_timeline($id));
        }
        
        public function group($id = null)
        {
            if ($id == null && (!$this->user->logged_in() || !($id = $this->user->group)))
            {
                throw new Exception("Access denied!");
            }
            
            $users = $this->group->get_users($id);
            
            $data = array();
            $users_by_id = array();
            
            foreach ($users as $user)
            {
                $data = array_merge($data, $this->user->get_timeline($user['id']));
                $users_by_id[$user['id']] = $user;
            }
            $this->display($users_by_id, $data);
        }

        private function display($users, $events)
        {   
            if (!$events || !$events[0])
            {
                throw new Exception("User / Group not found!");
            }

            usort($events, function ($a, $b)
            {
                return strcasecmp($a['date'], $b['date']);
            });
            
            $this->events = $events;
            $this->users = $users;
            
            $this->scripts = array(
                url('script/jquery.js'),
                url('script/timeline.js')
            );
                
            $this->render_view('head');
            $this->render_view('timeline');
        }
    };

?>
