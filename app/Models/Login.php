<?php namespace App\Models;

use CodeIgniter\Model;

class Login extends Model {

	protected $table = 'tb_users';
	protected $primaryKey = 'id';
	protected $allowedFields = ['nama', 'username', 'password'];

	public function login($username, $password)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($this->table);
		return $builder->getWhere(['username' => $username, 'password' => $password])->getRow();
	}

	public function register($data)
	{
		$db = \Config\Database::connect();
		$data = [
		        'nama' => $data['name'],
		        'username'  => $data['username'],
		        'password'  => $data['password']
		];
		$builder = $db->table($this->table);
		return $builder->insert($data);
	}
}

 ?>