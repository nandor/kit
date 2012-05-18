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
            $this->group = Model::load('GroupModel');
            $this->univ  = Model::load('UnivModel');
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
        
        /**
         * Returns names, pictures and ids of users whose full name
         * contain the search string
         * 
         * @param $what Search String
         */
        public function search($what = null)
        {
            if ($what == null)
            {
                if (!isset($_POST['what']))
                {
                    $this->json_error("Missing query string!");
                    return;
                }
                
                $what = $_POST['what'];
            }
            
            $response = array();
     
            $response['people'] = $this->user->search ($what);
            $response['groups'] = $this->group->search ($what);
            $response['univs'] = $this->univ->search ($what);
            
            $this->json_response($response);
        }
        
        /**
         * Returns user data, filtered by criteria
         */
        public function filter()
        {
            global $cfg;
            
            if (!isset($_POST['filter']))
            {
                $this->json_error("Missing filters!");
                return;
            }
            
            $filter = json_decode($_POST['filter'], true);
            $response = array();
            
            $name = isset($filter['name'], $filter['name']['val']) ? "%".DB::escape($filter['name']['val'])."%" : '%';
            $addr = isset($filter['addr'], $filter['addr']['val']) ? "%".DB::escape($filter['addr']['val'])."%" : '%';
            $edu  = isset($filter['edu' ], $filter['edu' ]['val']) ? "%".DB::escape($filter['edu' ]['val'])."%" : '%';
            $work = isset($filter['work'], $filter['addr']['val']) ? "%".DB::escape($filter['work']['val'])."%" : '%';
            $mail = isset($filter['mail'], $filter['mail']['val']) ? "%".DB::escape($filter['mail']['val'])."%" : '%';
            
            $query = "SELECT * FROM `users` WHERE ".
                        "`full_name` LIKE '$name' AND ".
                        "`address` LIKE '$addr' AND ".
                        "`university_name` LIKE '$edu' AND ".
                        "`workplace` LIKE '$work' AND ".
                        "`email` LIKE '$mail' AND ".
                        "`visible` = 1 ";
            
            if (isset($filter['column'], $filter[$filter['column']]['dir']))
            {
                $column = array(
                    'name' => 'full_name',
                    'addr' => 'address',
                    'edu' => 'university_name',
                    'work' => 'workplace',
                    'mail' => 'email'
                );
                
                $query .= " ORDER BY {$column[$filter['column']]} ".($filter[$filter['column']]['dir'] ? "DESC" : "ASC");
            }
            else
            {
            	$query .= " ORDER BY `full_name` ASC";
            }
            
            if (!isset($filter['page']))
            {
                $this->json_error("Invalid page!");
                return;
            }
            
            $query .= " LIMIT ".(intval($filter['page']) * $cfg['per_page']).", ".($cfg['per_page'] + 1);
            $result = DB::query($query, false);
            
            if (!$result)
            {
            	$this->json_error("Query failed!");
            	return;
			}
			
			$users = array();
			$count = 0;
			
			while ($count < $cfg['per_page'] && ($row = DB::next($result)))
			{
				$users[] = array(
					'id' => $row['id'],
					'name' => $row['full_name'],
					'addr' => $row['address'],
					'work' => $row['workplace'],
					'univ' => $row['university_name'],
					'mail' => $row['email']
				);
				
				$count++;
			}
			
        	$this->json_response(array(
        		'users' => $users,
        		'more' => (DB::next($result) != false)
    		));
        }
    };

?>
