<?php

class User
{
    protected $db;

    /**
     * User constructor.
     *
     * assigns a $db database connection
     */
    public function __construct()
    {
        $this->db = new Db();
    }

    /**
     * @return array
     *
     * returns a list of all users
     */
    public function findAll()
	{
		$sql = 'SELECT * FROM users ORDER BY login';
		return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}

    /**
     * @param $id
     * @return mixed
     *
     * returns user by id
     */
	public function findByID($id)
	{
		$sql = 'SELECT * FROM users WHERE id=:id';
		$params = ['id' => $id];
		return $this->db->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC)[0];
	}

    /**
     * @param $login
     * @return mixed
     *
     * returns user by login
     */
	public function findByLogin($login)
	{
		$sql = 'SELECT * FROM users WHERE login=:login';
		$params = ['login' => $login];
		return $this->db->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC)[0];
	}

    /**
     * @param $login
     * @return bool
     *
     * checks the existence of the specified user
     */
	public function isExist($login)
	{
		$sql = 'SELECT COUNT(login) as count FROM users WHERE login=:login';
		$params = ['login' => $login];
		$result = $this->db->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC)[0];
		return $result['count'] > 0 ? true : false;
	}

    /**
     * @param $login
     * @param $password
     * @return bool
     *
     * checks if the user is registered
     */
	function check($login, $password)
	{
		$user = $this->findByLogin($login);
		return !empty($user) && $password === $user['password'] ? true : false;
	}

    /**
     * @return null
     *
     * returns the name of the user logged into the site, or null
     */
    public function getCurrentUser()
    {
        if (isset($_SESSION['login']) && true == $this->isExist($_SESSION['login'])) {
            return $_SESSION['login'];
        }
        return null;
    }

    /**
     * @param $data
     *
     * updates user data
     */
	public function update($data)
    {
    	$data = $this->prepareData($data);
        $sql = 'UPDATE users SET login=:login, firstName=:firstName,
                lastName=:lastName, gender=:gender, birthDate=:birthDate WHERE id=:id';
	    $params = [
		    'id' => $data['id'],
		    'login' => $data['login'],
		    'firstName' => $data['firstName'],
		    'lastName' => $data['lastName'],
		    'gender' => $data['gender'],
		    'birthDate' => $data['birthDate'],
	    ];
        $this->db->execute($sql, $params);
    }

    /**
     * @param $data
     * @return bool
     *
     * adds user
     */
    public function add($data)
    {
    	$data = $this->prepareData($data);
        if (false == $this->isExist($data['login'])) {
            $sql = 'INSERT INTO users (`login`, `password`, `firstName`, `lastName`, `gender`, `birthDate`) VALUES 
			(:login, :password, :firstName, :lastName, :gender, :birthDate)';
            $params = [
                'login' => $data['login'],
                'password' => $data['password'],
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'gender' => $data['gender'],
                'birthDate' => $data['birthDate'],
            ];
            $this->db->execute($sql, $params);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     *
     * deletes user
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM users WHERE id=:id';
        $params = ['id' => $id];
        $this->db->execute($sql, $params);
    }

    /**
     * @param $request
     * @return array
     *
     * prepares user data
     */
    private function prepareData($request)
    {
	    return [
		    'id' => isset($request['id']) ? htmlspecialchars(trim($request['id'])) : null,
		    'login' => htmlspecialchars(trim($request['login'])),
		    'password' => isset($request['password']) ? md5($request['password']) : null,
		    'firstName' => htmlspecialchars(trim($request['firstName'])),
		    'lastName' => htmlspecialchars(trim($request['lastName'])),
		    'gender' => htmlspecialchars(trim($request['gender'])),
		    'birthDate' => htmlspecialchars(trim($request['dateOfBirth'])),
	    ];
    }
}