<?php    
    /**
        User controller
    */
    class UserController extends Controller 
    {
        function __construct()
        {
            parent::__construct();            
            $this->user = Model::load('UserModel');
            $this->group = Model::load('GroupModel');
        }
        
        /**
            This controller method handles profile page
        */
        function user()
        {
            global $cfg;
            
            $this->scripts = array(
                url('script/user.js'),
                url('script/upload.js'),
                'https://maps.googleapis.com/maps/api/js?sensor=false',
                'https://apis.google.com/js/client.js?onload=OnLoadCallback'
            );
            
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}/\""
            );
            
            $this->render_view('head');
            $this->render_view('profile_edit');
        }
        
        /**
            Controller for other users' profile pages
        */
        function profile($id)
        {
        	global $cfg;
        	
            if (!isset($id) || !$id)
            {
                throw new Exception ("Invalid id");
            }
            
            $this->user_data = $this->user->get_by_id($id);
            
            if (!$this->user_data)
            {
            	throw new Exception ("User does not exist!");
            }
            
            if ($this->user_data['visible'] == 0 && !$this->user->logged_in())
            {
            	throw new Exception ("This user's profile is private!");
			}
            
            $this->user_trail = $this->user->get_trail($id);
            
            $this->scripts = array(
                url('script/profile.js'),
                'https://maps.googleapis.com/maps/api/js?sensor=false'
            );
            
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}/\""
            );
            
            
            $this->render_view('head');
            $this->render_view('profile_view');
        }
        
        /**
            Saves changes to the user profile
        */
        function save()
        {
            $new_data = array();
            $user_data = $this->user->get_data();
            $fields = array(
				'address' => '/^[[:alnum:]-, ]+$/', 
				'email' => '/^[a-zA-Z0-9_.]+@[a-zA-Z0-9.]+$/', 
				'full_name' => '/^[a-zA-Z ]+$/', 
				'visible' => '/^(0|1)$/', 
				'workplace' => '/^[a-zA-Z0-9]+$/', 
				'job' => '/^[a-zA-Z0-9]+$/', 
				'hobby' => '/^[a-zA-Z0-9, ]+$/', 
				'birthday' => '/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/'
			);
                        
            foreach ($fields as $field => $regex)
            {
            	if (!isset($_POST[$field]) || $_POST[$field] == '')
        		{
        			continue;
        		}
        		if (!isset($fields[$field]) || !preg_match($regex, $_POST[$field]))
        		{
        			throw new Exception("Invalid field value!");
        		}
        		
                $new_data[$field] = $_POST[$field];
            }
            
            $this->user->update($new_data);
            $this->message('Profile changed successfuly!');
            $this->redirect('user/edit');
        }
        
        /**
            Upload a profile picture for a user  
        */
        function save_picture($ext)
        {
            global $cfg;
            
            if (!$this->user->logged_in())
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
        
        /**
            User login is handled here
        */
        function login()
        {
            global $cfg;
            
            $user = isset($_POST['user']) ? $_POST['user'] : null;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : null;
            
            // Check the username
            if (!$user || !preg_match('/^[a-zA-Z0-9]{4,30}$/', $user)) 
            {
                throw new Exception("Invalid username");
            }
                        
            if (!($user = $this->user->login($user, sha1($pass))))
            {
                throw new Exception("Invalid username/password!");
            }
            
            $this->redirect('');
        }    
        
        /**
            Logout is handled here
        */
        function logout()
        {
            $this->user->logout();
            
            $this->redirect('');
        }
                
        /**
            Do the user registration
        */
        function register()
        {
            if (!isset($_POST['user']) || !preg_match('/^[a-zA-Z0-9]{4,30}$/', $_POST['user']))
            {
                throw new Exception("Invalid username");
            }
                                        
            if (!isset($_POST['pass'], $_POST['cpass']) || !preg_match('/^[a-zA-Z0-9!@#$%^&*]{6,30}$/', $_POST['pass']))
            {
                throw new Exception("Invalid password!");
            }
            
            if ($_POST['pass'] != $_POST['cpass'])
            {
                throw new Exception("Passwords do not match!");
            }
            
            $pass = $_POST['pass'];
            $user = $_POST['user'];
            
            $this->user->logout();            
            $this->user->add($user, $pass);
            $this->message('Registration successful! You can log in now!');
            $this->redirect('');
        }
        
        /**
        	Join a group
		*/
		function join($id)
		{
			if (!$this->user->logged_in())
			{
				throw new Exception("Access denied!");
			}
			
			$group = $this->group->get_data($id);
			
			if (!$group)
			{
				throw new Exception("Group not found!");
			}
			
			$this->user->group = $group['id'];
			$this->user->update(array(
				'group_name' => $group['name']
			), false);
			
            $this->message("You've joined {$group['name']}!");
            $this->redirect('');
		}
    };
?>
