<?php

    class UnivController extends Controller
    {
        private $per_page = 10;
        public $universities, $groups;
    
        public function __construct()
        {
            parent::__construct();
            $this->univ  = Model::load('UnivModel');
            $this->user  = Model::load('UserModel');
            $this->group = Model::load('GroupModel');
        }
        
        public function index()
        {
            global $cfg;
            
            $this->scripts = array(
                url('script/jquery.js'), 
                url('script/univ_table.js')
            );
            
            $this->get_page(1);
            $this->num_univs = count($this->universities);
            $this->num_pages = (int)(($this->univ->get_num_univs() - 1) / $this->per_page + 1);
            
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}/\"",
            	"num_pages" => $this->num_pages
            );
            
            
            $this->render_view('head');
            $this->render_view('univ_index');
        }
        
        private function get_page($page)
        {
            if (!($univs = $this->univ->get_univs($page, $this->per_page)))
            {
                throw new Exception("No universities found in the database!");
            }
                        
            if(!isset($univs[0]))
            {
                $this->universities[0] = $univs;
            }
            else
            {
                $this->universities    = $univs;
            }
        }
        
        public function get_table($page)
        {
            $this->get_page($page);
            echo json_encode($this->universities);
        }
        
        public function profile($id)
        {
            global $cfg;
            
            $this->scripts = array(
                url('script/jquery.js'), 
                url('script/group_table.js')
            );
                        
            $this->univ_profile = $this->univ->get_univ_data($id);
            $this->groups = $this->group->get_groups($id);
            
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}/\""
            );
            
            $this->render_view('head');
            $this->render_view('univ_profile');
        }
        
        public function add_index()
        {
            $this->scripts = array(
                url('script/jquery.js'), 
                url('script/univ_add_edit.js'),
                'https://maps.googleapis.com/maps/api/js?sensor=false'
            );
            
            global $cfg;
            $this->variables = array(
                'base_url' => "\"". $cfg['base_url'] . "\""
            );
            
            $this->render_view('head');
            $this->render_view('univ_add');
        }
        
        public function add_univ()
        {            
            $new_data = array();
            $fields = array(
				'about' => '/^[a-zA-Z0-9 .!?,;:]+$/', 
				'phone_number' => '/^[0-9]+$/', 
				'name' => '/^[a-zA-Z0-9\" ]+$/',
				'address' => '/^[[:alnum:]-, ]+$/', 
				'email' => '/^[a-zA-Z0-9_.]+@[a-zA-Z0-9.]+$/' 
			);
                        
            foreach ($fields as $field => $regex)
            {
            	if (!isset($_POST[$field]) || $_POST[$field] == '')
        		{
        			throw new Exception("All fields must be completed!");
        		}
        		
        		if (!isset($fields[$field]) || !preg_match($regex, $_POST[$field]))
        		{
        			throw new Exception("Invalid value: $field");
        		}
        		
                $new_data[$field] = $_POST[$field];
            }
            
            $this->univ->add($new_data);
            $this->message('University added!');
        	$this->redirect('');
        }
                
        public function edit_index($id)
        {
            $this->scripts = array(
                url('script/jquery.js'),
                url('script/univ_add_edit.js'),
                'https://maps.googleapis.com/maps/api/js?sensor=false'
            );
            
            $this->univ_profile = $this->univ->get_univ_data($id);
            
            global $cfg;
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}/\"",
                'univ_id' => "\"$id\""
            );
            
            $this->render_view('head');
            $this->render_view('univ_edit');
        }
        
        public function save()
        {
            if (!$this->user->logged_in() || !$this->user->university ||
            	!isset($_POST['id']) || $_POST['id'] != $this->user->university)
            {
                throw new Exception("Access denied!");
            }
            
            $new_data = array();
            $fields = array(
				'id' => '/^[0-9 ]+$/', 
				'about' => '/^[a-zA-Z0-9 .!?,;:]+$/', 
				'phone_number' => '/^[0-9]+$/', 
				'name' => '/^[a-zA-Z ]+$/',
				'address' => '/^[[:alnum:], ]+$/', 
				'email' => '/^[a-zA-Z0-9_.]+@[a-zA-Z0-9.]+$/' 
			);
                        
            foreach ($fields as $field => $regex)
            {
            	if (!isset($_POST[$field]) || $_POST[$field] == '')
        		{
        			continue;
        		}
        		
        		if (!isset($fields[$field]) || !preg_match($regex, $_POST[$field]))
        		{
        			throw new Exception("Invalid value");
        		}
        		
                $new_data[$field] = $_POST[$field];
            }
            
            $this->univ->update($_POST['id'], $new_data);
            $this->message('Group changed successfuly!');
        	$this->redirect('univ/edit/'.$this->user->university);
            
        }
    };
?>
