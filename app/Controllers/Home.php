<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session();
		// https://codeigniter.com/user_guide/libraries/sessions.html?highlight=session#adding-session-data
		if ($session->has('username')) {
			$data['data'] = model('Database')->selectData("tb_catatan");
			$data['jenis'] = model('Database')->selectData("tb_jenis");
			helper('form');
			echo view('templates/header');
			echo view('home/index', $data);
			echo view('templates/footer');
		}else{
			return redirect()->to(base_url().'/Login');
		}
		
	}

	public function selectData($where)
	{
		return json_encode(model('Database')->selectData("tb_catatan"));
	}

	public function selectDataWhere($where)
	{
		return json_encode(model('Database')->selectDataWhere($where));
	}

	public function addNote()
	{
		$session = \Config\Services::session();
		$data = [
			'title' => $this->request->getPost('title'),
			'isi' => $this->request->getPost('isi'),
			'id_user' => $session->get('id_user'),
			'id_jenis' => '1'
	    ];
	    $result = model('Database')->insertData($data);
	    if ($result) {
   			$session->setFlashdata('insertData', 'success');
	    }else{
	    	$session->setFlashdata('insertData', 'failed');
	    }
	    return redirect()->to(base_url().'/Home');
	}

	public function updateNote()
	{
		$session = \Config\Services::session();
		$data = [
			'id' => $this->request->getPost('id'),
			'title' => $this->request->getPost('edit-title'),
			'isi' => $this->request->getPost('edit-isi'),
			'id_user' => $session->get('id_user'),
			'id_jenis' => '1'

	    ];
		$result = model('Database')->updateData($data);
		if ($result) {
			$session->setFlashdata('updateData', 'success');
		}else{
			$session->setFlashdata('updateData', 'failed');
		}
		return redirect()->to(base_url().'/Home');
	}

	public function deleteNote($id)
	{
		$session = \Config\Services::session();
		$result = model('Database')->deleteData($id);
		if ($result) {
			$session->setFlashdata('deleteData', 'success');
		}else{
			$session->setFlashdata('deleteData', 'failed');
		}
		return redirect()->to(base_url().'/Home');
	}

	//--------------------------------------------------------------------

}
