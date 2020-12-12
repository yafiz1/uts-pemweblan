<?php namespace App\Models;

use CodeIgniter\Model;

class Database extends Model {

	protected $table = 'tb_catatan';
	protected $primaryKey = 'id';
	protected $allowedFields = ['title', 'isi', 'id_user', 'id_jenis'];

	public function insertData($data)
	{
		$db = \Config\Database::connect();
		$data = [
				'id' => null,
		        'title' => $data['title'],
		        'isi'  => $data['isi'],
				'id_user' => $data['id_user'],
				'id_jenis' => $data['id_jenis']
		];
		$builder = $db->table($this->table);
		return $builder->insert($data)->connID->affected_rows;
	}

	public function selectData($tabel)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($tabel);
		return $builder->get()->getResult();
	}

	public function selectDataPerUser($table, $id_user)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($table);
		return $builder->getWhere(['id_user' => $id_user])->getResult();
	}

	public function selectDataWhere($where, $id_user)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('view_catatan');
		return $builder->getWhere(['id_jenis' => $where, 'id_user' => $id_user])->getResult();
	}

	public function updateData($data)
	{
		$db = \Config\Database::connect();
		$data = [
				'id' => $data['id'],
		        'title' => $data['title'],
		        'isi'  => $data['isi'],
		        'id_user' => $data['id_user'],
		        'id_jenis' => $data['id_jenis']
		];
		$builder = $db->table($this->table);
		// https://codeigniter.com/user_guide/database/query_builder.html?highlight=query%20builder#updating-data
		return $builder->replace($data)->connID->affected_rows;
	}

	public function deleteData($id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($this->table);
		$builder->where('id', $id);
		return $builder->delete()->connID->affected_rows;
	}
}

 ?>