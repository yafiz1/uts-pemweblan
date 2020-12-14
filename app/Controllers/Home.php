<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		helper('form');

		$data['notes'] = model('Database')->selectNotes("notes_view", session()->get('user_id'));
		$data['categories'] = model('Database')->selectCategories("categories_tb");
		
		echo view('templates/header');
		echo view('home/index', $data);
		echo view('templates/footer');
	}

	public function selectData($category_id)
	{
		if ($category_id == -1) {
			$data['notes'] = model('Database')->selectNotes("notes_view", session()->get('user_id'));
			$data['categories'] = model('Database')->selectCategories("categories_tb");
		}else{
			$data['notes'] = model('Database')->selectNotesBasedCategory("notes_view",$category_id,session()->get('user_id'));
			$data['categories'] = model('Database')->selectCategories("categories_tb");
		}
		return view('home/ajax',$data);
	}

	public function addNote()
	{
		$data = [
			'note_header' => $this->request->getPost('note_header'),
			'note_body' => $this->request->getPost('note_body'),
			'user_id' => session()->get('user_id'),
			'category_id' => $this->request->getPost('category')
	    ];
	    $result = model('Database')->insertData("notes_tb",$data);
	    return redirect()->to(base_url().'/Home');
	}

	public function updateNote()
	{
		$data = [
			'note_id' => $this->request->getPost('note_id'),
			'note_header' => $this->request->getPost('note_header'),
			'note_body' => $this->request->getPost('note_body'),
			'user_id' => session()->get('user_id'),
			'category_id' => $this->request->getPost('category')

	    ];
		$result = model('Database')->updateData("notes_tb",$data);
		return redirect()->to(base_url().'/Home');
	}

	public function deleteNote($id)
	{
		$session = \Config\Services::session();
		$result = model('Database')->deleteData("notes_tb", $id);
		return redirect()->to(base_url().'/Home');
	}

	//--------------------------------------------------------------------

}
