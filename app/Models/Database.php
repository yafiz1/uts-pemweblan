<?php namespace App\Models;

use CodeIgniter\Model;

class Database extends Model {

	public function insertData($table, $data)
	{
		$db = \Config\Database::connect();
		$db->table($table)->insert($data);
		return $db->affectedRows();
	}

	public function selectCategories($tabel)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($tabel);
		return $builder->get()->getResult();
	}

	public function selectNotes($table, $user_id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($table);
		return $builder->getWhere(['user_id' => $user_id])->getResult();
	}

	public function selectNotesBasedCategory($table, $category_id, $user_id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($table);
		return $builder->getWhere(['category_id' => $category_id, 'user_id' => $user_id])->getResult();
	}

	public function updateData($table, $data)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($table)->replace($data);
		return $db->affectedRows();
	}

	public function deleteData($table,$id)
	{
		$db = \Config\Database::connect();
		$builder = $db->table($table)->delete(['note_id' => $id]);
		return $db->affectedRows();
	}
}

 ?>