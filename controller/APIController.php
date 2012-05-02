<?php
    /*
        Controller for the REST API
    */
    class APIController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->user = Model::load('UserModel');
        }
        
        /**
            Return all the information for a user
            @param $id          The id or the name of the user
        */
        public function get_user($id)
        {
            $user = null;
            if (preg_match('/^[0-9]+$/', $id))
            {
                $user = $this->user->get_by_id($id);   
            }
            else
            {
                $user = $this->user->get_by_name($id);
            }
            
            if (!$user)
            {
                $this->json_error("User not found!");
                return;
            }
            
            // Process & filter the data returned from the database
            $data = array();
            $data["id"] = $user["id"];
            $data["name"] = $user["name"];
            $data["registered"] = date('Y-n-j H:i:s', $user['time_registered']);
            
            // Print the response
            $this->json_response($data);
        }
        
        /**
            Return a JSON response
            @param $data            Data to be sent to the client
        */
        private function json_response($data)
        {
            header('Content-type: application/json');
            
            echo json_encode(array(
                "status" => "success",
                "message" => "Success",
                "data" => $data
            ));
        }
        
        /**
            Return an error message
            @param $message         Message to be returned
        */
        private function json_error($message)
        {
            header('Content-type: application/json');
            
            echo json_encode(array(
                "status" => "error",
                "message" => $message
            ));
        }
        
        public function search($what = null)
        {
            if ($what == null)
            {
                if (!isset($_POST['what']))
                {
                    throw new Exception("Missing query string!");
                }
                $what = $_POST['what'];
            }
            $response = array();
     
            $response['people'] = $this->user->search ($what);
            
            $this->json_response($response);
        }
    };

?>
