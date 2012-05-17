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
            if (!preg_match('/^[0-9]+$/', $id))
            {
                throw new Exception("Invalid group ID");
            }
            
            $this->scripts = array();
            
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
            
            if (!$this->user->logged_in() || $this->user->group)
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
            $this->user->profile = $file_name;
        }
		public function edit($id)
		{
			$this->scripts = array(
                url('script/upload.js')
            );
			
			$this->group_data = $this->group->get_data($id);
			$this->render_view('head');
			$this->render_view('group_edit');
		}
		
		function save()
        {
            $new_data = array();
            $group_data = $this->group->get_data();
            $fields = array('name', 'promotion', 'about');
            
            foreach ($fields as $field)
            {
                if (isset($_POST[$field]) && $_POST[$field] != '' &&
                    $_POST[$field] != $group_data[$field])
                {
                    $new_data[$field] = $_POST[$field];
                }
            }
            
            $this->group->update($new_data);
            $this->message('Group profile changed successfuly!');
            $this->redirect('/group');
        }
    };

?>
