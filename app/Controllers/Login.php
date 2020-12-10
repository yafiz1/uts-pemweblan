<?php namespace App\Controllers;

class Login extends BaseController
{

	public function index()
	{
		helper('form');
		echo view('templates/header');
		echo view('login/index');
		echo view('templates/footer');
	}

	public function login()
	{
		// https://codeigniter.com/user_guide/libraries/sessions.html?highlight=session#initializing-a-session
		$session = \Config\Services::session();
		$username = $this->request->getPost('login-username');
		$password = $this->request->getPost('login-password');
	    $result = model('Login')->login($username, $password);
	    if ($result) {
	    	// https://codeigniter.com/user_guide/libraries/sessions.html?highlight=session#adding-session-data
	    	$session->set([
	    		'id_user' => $result->id,
	    		'username' => $result->username,
	    		'nama' => $result->nama,
	    		'logged_in' => TRUE
	    	]);
	    	// https://codeigniter4.github.io/userguide/general/common_functions.html?highlight=redirect#redirect
   			return redirect()->to(base_url().'/Home');
	    }else{
	    	// https://codeigniter.com/user_guide/libraries/sessions.html?highlight=session#flashdata
	    	$session->setFlashdata('login', 'failed');
			return redirect()->to(base_url().'/Login');
	    }
	}

	public function register()
	{
		$session = \Config\Services::session();
		$dataRegister = [
			'name' => $this->request->getPost('register-name'),
			'username' => $this->request->getPost('register-username'),
			'password' => $this->request->getPost('register-password')
	    ];
		$result = model('Login')->register($dataRegister)->connID->affected_rows;
		if ($result) 
			$session->setFlashdata('register', 'success');
		else
			$session->setFlashdata('register', 'failed');

		return redirect()->to(base_url().'/Login');

	}

	//--------------------------------------------------------------------

}
