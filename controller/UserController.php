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
        }
        
        /**
            This controller method handles profile page
        */
        function user()
        {
            $this->scripts = array(
                url('script/jquery.js'), 
                url('script/user.js'),
                'https://maps.googleapis.com/maps/api/js?sensor=false'
            );
            
            $this->render_view('head');
            $this->render_view('profile_edit');
        }
        
        /**
            Controller for other users' profile pages
        */
        function profile($id)
        {
            if (!isset($id) || !$id)
            {
                throw new Exception ("Invalid id");
            }
            
            $this->user_data = $this->user->getForeignData($id);
            
            $this->render_view('head');
            $this->render_view('profile_view');
        }
        
        /**
            Saves changes to the user profile
        */
        function save()
        {
        
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
            if (!$user || strlen($user) > 30 || 
                preg_match('/^[a-zA-Z0-9]+$/', $user) != 1) 
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
    };
?>
