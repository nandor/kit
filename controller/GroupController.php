<?php
    /**
        Controller for user groups
    */
    class GroupController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->user = Model::load('UserModel');
            $this->group = Model::load('GroupModel');
        }
		
        public function display($id)
        {
			global $cfg;
			
            if (!preg_match('/^[0-9]+$/', $id))
            {
                throw new Exception("Invalid group ID");
            }
            
            $this->scripts = array();
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}\"",
            );
            
			$this->users = $this->group->get_users($id);	
			$this->group_data = $this->group->get_data($id);
				
            $this->render_view('head');
            $this->render_view('group_view');
        }
        
        /**
            Upload a profile picture for the group 
        */
        function save_picture($ext)
        {
            global $cfg;
            
            if (!$this->user->logged_in() || !$this->user->group)
            {
                throw new Exception("Access denied!");
            }
            
            if (!isset($_SERVER["CONTENT_LENGTH"]))
            {
                throw new Exception("Invalid parameters");
            }
            
            $size = (int)$_SERVER["CONTENT_LENGTH"];
            $file_name = rand().time()."{$this->user->id}.$ext";
            $file_path = "{$cfg['dir']['content']}$file_name";
                        
            
            // Write the new one
            $input = fopen("php://input", "rb");
            $output = fopen($file_path, "wb");
            
            if (!$input || !$output)
            {
                throw new Exception("Cannot open files!");
            }
                
            while ($size > 0)
            {
                $data = fread($input, $size > 1024 ? 1024 : $size);
                $size -= 1024;
                
                fwrite($output, $data);
            }
            
            fclose($input);
            fclose($output);
            
            // Update the profile image
            $this->group->update($this->user->group, array(
            	'picture' => $file_name
			));
        }
        
		public function edit($id)
		{
			global $cfg;
			
			$this->scripts = array(
                url('script/upload.js')
            );
			
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}\"",
            );
            
			$this->group_data = $this->group->get_data($id);
			$this->render_view('head');
			$this->render_view('group_edit');
		}
		
		function save()
        {
            if (!$this->user->logged_in() || !$this->user->group)
            {
                throw new Exception("Access denied!");
            }
            
            $new_data = array();
            $fields = array(
				'name' => '/^[a-zA-Z0-9 ]+$/', 
				'promotion' => '/^[0-9]+$/', 
				'about' => '/^[a-zA-Z0-9 .!?,;:]+$/', 
			);
                        
            foreach ($fields as $field => $regex)
            {
            	if (!isset($_POST[$field]) || $_POST[$field] == '')
        		{
        			continue;
        		}
        		
        		if (!isset($fields[$field]) || !preg_match($regex, $_POST[$field]))
        		{
        			throw new Exception("Invalid value!");
        		}
        		
                $new_data[$field] = $_POST[$field];
            }
            
            $this->group->update($this->user->id, $new_data);
            $this->message('Group changed successfuly!');
        	$this->redirect('group/edit/'.$this->user->group);
        }
        
        public function add_index($univ_id)
        {
            $this->scripts = array(
                url('script/jquery.js'), 
                url('script/group.js')
            );
            
            $this->university = $univ_id;
            
            $this->render_view('head');
            $this->render_view('group_add');
        }
        
        public function add()
        {
            $new_data = array();
            $fields = array(
            	'university' => '/^[0-9]+$/',
				'name' => '/^[a-zA-Z0-9 ]+$/', 
				'promotion' => '/^[0-9]+$/', 
				'about' => '/^[a-zA-Z0-9 .!?,;:]+$/', 
			);
                        
            foreach ($fields as $field => $regex)
            {
            	if (!isset($_POST[$field]) || $_POST[$field] == '')
        		{
        			throw new Exception("All fields must be completed: $field!");
        		}
        		
        		if (!isset($fields[$field]) || !preg_match($regex, $_POST[$field]))
        		{
        			throw new Exception("Invalid value!");
        		}
        		
                $new_data[$field] = $_POST[$field];
            }
            
            $this->group->add($new_data);
            $this->message('Group added successfuly!');
        	$this->redirect('');
        }
    };

?>
