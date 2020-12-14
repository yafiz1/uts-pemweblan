<?php namespace App\Models;

use CodeIgniter\Model;

class Login extends Model {

	protected $table = 'users_tb';

	public function login($username, $password)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($this->table);
		return $builder->getWhere(['username' => $username, 'password' => $password])->getRow();
	}

	public function register($data)
	{
		$db = \Config\Database::connect();
		$db->table($this->table)->insert($data);
		return $db->affectedRows();
	}

	
}

 ?>