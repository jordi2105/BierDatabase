<?php

class Beerdatabase {
	public $db = null;
	public $server = 'localhost';
	public $username = 'root';
	public $password = '';
	public $dbname = 'beer_database';

	public function __construct()
	{
		$this->db = new mysqli($this->server, $this->username, $this->password, $this->dbname);

		if ($this->db->connect_error)
		{
    		die('Connection failed: ' . $this->db->connect_error);
		}
	}

	public function getBeers($search_string, $selected_user)
	{
		//$sql = 'SELECT * FROM beer WHERE brand LIKE "%' . $search_string . '%" OR type LIKE "%' . $search_string . '%" ORDER BY date DESC';
		$users = array();
		$sql = 'SELECT * FROM user WHERE name LIKE "%' . $search_string . '%"';
		$results = $this->db->query($sql);

		$final_sql =  'SELECT * FROM beer WHERE (brand LIKE  "%' . $search_string . '%" ' ;
		if ($results->num_rows > 0) {
			foreach ($results->fetch_all() as $user) 
			{
				$final_sql .= ' OR user LIKE "%' . $user[0] . '%" ';
			}
		}
		$final_sql .= ')';
		if($selected_user != "select" && $selected_user != "")
		{
			$final_sql .= 'AND user=' . $selected_user;
		}

		$results = $this->db->query($final_sql);
		if ($results->num_rows > 0) {
    		return $results->fetch_all();
		}
		return array();
	}

	public function getUser($id)
	{
		$sql = 'SELECT Name FROM user WHERE id=' . $id;
		$results = $this->db->query($sql);

		if ($results->num_rows > 0) {
    		return $results->fetch_object()->Name;
		}

		return 'Geen gebuiker gevonden...';
	}

	public function getUsers()
	{
		$sql = 'SELECT * FROM user';
		$results = $this->db->query($sql);

		if ($results->num_rows > 0) {
    		return $results->fetch_all();
		}
	}

	public function addUser($data)
	{
		try 
		{
		    $conn = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $a = $data["brand"];
		    $b = $data["type"];
		    $c = $data["description"];
		    $d = $data["user"];
		    $sql = "INSERT INTO Beer (brand, type, description, user) VALUES ('$a', '$b', '$c', '$d')";
		    $conn->exec($sql);
		    echo "New record created successfully";
		}
		catch(PDOException $e)
	    {
	    	echo $sql . "<br>" . $e->getMessage();
	    }

		$conn = null;
	}

	public function getSearchInput()
	{
		return !empty($_POST['search_input']) ? $_POST['search_input'] : "";
	}

	public function getSelectedUser()
	{
		return !empty($_POST['selected_user']) ? $_POST['selected_user'] : "";
	}

}
