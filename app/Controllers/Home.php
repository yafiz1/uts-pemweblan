<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session();
		// https://codeigniter.com/user_guide/libraries/sessions.html?highlight=session#adding-session-data
		if ($session->has('username')) {
			$this->home();
		}else{
			return redirect()->to(base_url().'/Login');
		}
		
	}

	public function home()
	{
		$data['data'] = model('Database')->selectDataPerUser("view_catatan", session()->get('id_user'));
		$data['categories'] = model('Database')->selectData("tb_jenis");
		helper('form');
		echo view('templates/header');
		echo view('home/index', $data);
		echo view('templates/footer');
	}

	public function selectData()
	{
		return json_encode(model('Database')->selectDataPerUser("view_catatan",session()->get('id_user')));
	}

	public function selectDataWhere($where)
	{
		return json_encode(model('Database')->selectDataWhere($where, session()->get('id_user')));
	}

	public function addNote()
	{
		
		$data = [
			'title' => $this->request->getPost('judul'),
			'isi' => $this->request->getPost('isi'),
			'id_user' => session()->get('id_user'),
			'id_jenis' => $this->request->getPost('jenis')
	    ];
	    $result = model('Database')->insertData($data);
	    return redirect()->to(base_url().'/Home');
	}

	public function updateNote()
	{
		$data = [
			'id' => $this->request->getPost('id'),
			'title' => $this->request->getPost('judul'),
			'isi' => $this->request->getPost('isi'),
			'id_user' => session()->get('id_user'),
			'id_jenis' => $this->request->getPost('jenis')

	    ];
		$result = model('Database')->updateData($data);
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
